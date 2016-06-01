<?php
/**
* class to add menu dynamicall
* @author Nimatullah Razmjo <nimatullah.razmjo@gmail.com>
* @since 07 March 2013
* @version 1.0.0
*/
class home extends CI_Controller
{
    //---load constructor
    function __construct()
    {
      parent::__construct();
      //--- load library
      $this->load->library('ajax_pagination');
      $this->load->library('form_validation');
      $this->load->library('session');
      //---load model
      $this->load->model("menu/menu_model");
      $this->load->model("cms/cms_model");
      $this->load->model("artical/artical_model");
      //--- load helper
      $this->load->helper("template");
      $this->load->helper("function");
      //---check if the user id logged in
      userLoggedIn();
    }
    //---define destructor
    function __destruct()
    {
      //---no code just remove from memory
    }
    function index()
    {
       //=====get the all reports shedules from database
        $recPerPage=$this->config->item('recperpage');
        $starting=$this->input->post('starting');
        if(!$starting)
        {
            $starting =0;
        }                 
        //------read all news from database and listed on a page
        $getArtical=$this->menu_model->getAllMenu($starting,$recPerPage,TRUE);
        if($getArtical)
        {
          $data['records'] = $getArtical;
          //to count number of records
          $totalRecords = $this->menu_model->getAllMenu($starting,$recPerPage,FALSE);
          $total = $totalRecords->num_rows();
        }
        else
        {
          $data['records'] = "";
          $total  = "";
        }
        $str_post_str ="&ajax=1";
        $this->ajax_pagination->make_search(
        $total,
        $starting,
        $recPerPage,
        'First',
        'Last',
        'Previous',
        'Next',
        'Page',
        'Of',
        'Total',
        base_url()."menu/home/index",
        'menuAjax',
        $str_post_str
        );
       $data['page']      = $starting;
       $data['links']     = $this->ajax_pagination->anchors;
       $data['total']     = $this->ajax_pagination->total;
       if($this->input->post('ajax') == 1)
       {
           $this->load->view('admin/menu_list',$data);
       } 
       else
       {
          header_admin();
          //----load banner
          banner_admin();
          //---load bar
          bar_admin();
          //---load left side admin
          left_admin();
          $content=$this->load->view('admin/menu_list',$data,TRUE);
          //---load content
          content_admin($content);
          //--load footer
          footer_admin();
          //---end of footer 
       }
    }
    /**
    * function to add new menu into database
    * 
    */
    function addMenu()
    {
      $this->formValidation();
      if($this->form_validation->run()  == FALSE)
      {
          //---get All Menu from database
          $getMenu= $this->menu_model->getAllMenu(0,0,FALSE);
          $menu="";
          if($getMenu)
          {
              if($getMenu->num_rows()>0)
              {
                  foreach($getMenu->result() AS $row)
                  {
                      $menu.="<option value=\"".$row->id."\" ".set_value('parent_menu',$row->id,0).">".$row->label."</option>";
                  }
              }
          }
          $data['menu'] = $menu;
          //--header
          header_admin();
          //----load banner
          banner_admin();
          //---load bar
          bar_admin();
          //---load left side admin
          left_admin();
          $content=$this->load->view('menu/menu_add',$data,TRUE);
          //---load content
          content_admin($content);
          //--load footer
          footer_admin();
      }
      else
      {
          
          $form_records= array(
                               'label'      => $this->input->post('name'), 
                               'parent_id'  => $this->input->post('parent_menu'), 
                                );
          if($this->menu_model->addMenu($form_records) == TRUE )
          {
              redirect('menu/home','refresh');
          }
          else
          {
              echo "records no inserted";
          }
      }
    }

    //---check form validation
    function formValidation()
    {
      $this->form_validation->set_rules('parent_menu','parent_menu','');
      $this->form_validation->set_rules('name','name','required');
    }
    /**
    * UPATE THE SELECTED MENU
    * 
    * @param mixed $id
    */
    function updateMenu($id = 0)
    {
      if($id != 0)
      {
          $getMenu= $this->menu_model->getOneRecords("cms_menu","*","id",$id);
          //echo "<pre>";
          //print_r($getMenu->result_array()); exit;
          if($getMenu)
          {
              $row = $getMenu->row();
              $menu_id= $row->parent_id;
              $data['id'] = $id;
              //echo $menu; exit;
              $data['records'] = $getMenu->row_array();
              $this->formValidation();
              if($this->form_validation->run()  == FALSE)
              {
                      //---get All Menu from database
                      $getMenu= $this->menu_model->getAllMenu(0,0,FALSE);
                      $menu="";
                      if($getMenu){
                          if($getMenu->num_rows()>0){
                              foreach($getMenu->result() AS $row){
                                  //echo $menu;exit;
                                  if($row->id == $menu_id){
                                      $menu.="<option value=\"".$row->id."\" selected=\"selected\">".$row->label."</option>";
                                  }else{
                                      $menu.="<option value=\"".$row->id."\" ".set_value('parent_menu',$row->id,0).">".$row->label."</option>";
                                  }
                              }
                          }
                      }
                      $data['menu'] = $menu;
                     //--header
                      header_admin();
                      //----load banner
                      banner_admin();
                      //---load bar
                      bar_admin();
                      //---load left side admin
                      left_admin();
                      $content=$this->load->view('menu/menu_update',$data,TRUE);
                      //---load content
                      content_admin($content);
                      //--load footer
                      footer_admin();
              }
              else
              {
                  
                  $form_records= array(
                                       'label'      => $this->input->post('name'), 
                                       'parent_id'  => $this->input->post('parent_menu'), 
                                        );
                  //echo $id; exit;
                  if($this->menu_model->update($id,$form_records) == TRUE )
                  {
                      redirect('menu/home','refresh');
                  }
                  else
                  {
                      echo "records no inserted";
                  }
              }
          }
      }
    }
    /**
    * function to delete the menu
    * 
    * @param mixed $id
    */
    function deleteMenu($id = 0)
    {
      if($id != 0)
      {
          if($this->menu_model->deleteRecords($id) == TRUE)
          {
              redirect('menu/home','refresh');
          }
          else
          {
              echo "not deleted";
          }
          
      }
    }
    //-----menu link
    /**
    * function get menu link
    */
    function menuLink()
    {
        //---check form validation
        $this->form_validation->set_rules('menu','menu','required');
        $this->form_validation->set_rules('menu_content','menu_content','required');
        $this->form_validation->set_rules('lnk','lnk','required');
        if($this->form_validation->run() == FALSE){
            $getMenu= $this->menu_model->getLinkMenu();
            if(empty($getMenu)){
                return;
            }
            $opt="";
            foreach($getMenu as $row){
                $opt.= "<option value=\"".$row['id']."\" >".$row['label']."</option>";
            }
            $content= "<option value=\"1\" ".set_select("menu_content",1,0)." >Artical</option>";
            $content.= "<option value=\"2\" ".set_select("menu_content",2,0)." >News</option>";
            $content.= "<option value=\"3\" ".set_select("menu_content",3,0)." >Content</option>";
            $data['opt'] = $opt;
            $data['content'] = $content;
            header_admin();
            //----load banner
            banner_admin();
            //---load bar
            bar_admin();
            //---load left side admin
            left_admin();
            $content=$this->load->view('menu/menu_link',$data,TRUE);
            //---load content
            content_admin($content);
            //--load footer
            footer_admin();
            //---end of footer 
        }else{
           $contentid = $this->input->post("menu_content");
           $id = $this->input->post("lnk");
            if($contentid == '1'){
                $link ="cms/home/readArtical/".$id;
            }else if($contentid == '2')
            {
                $link ="cms/home/readNews/".$id;
            }else if($contentid == '3')
            {
                $link ="cms/home/readContent/".$id;
            }else{
                $link ="#";
            }
            
            $form_array=array(
                        "menu_id" => $this->input->post("menu"),
                        "link"    => $link,
                        "section_id"    => $id,
                        "section"    => $contentid
                        );
            if($this->menu_model->addLink($form_array) == TRUE){
                  $this->session->set_flashdata('msg',"<h4 class=\"alert_success\">Link Inserted Successfully</h4>");
                  redirect('menu/home/getLinks','refresh');
            }else{
                $this->session->set_flashdata('msg',"<h4 class=\"alert_error\">Link is Not Inserted</h4>");
                redirect('menu/home/getLinks','refresh');
            }
        }
    }

    /**
    * function get menu link
    */
    function updateLink( $id=0)
    {
        if(empty($id)){
            return;
        }
        
        $getOneRecords= getOneRecords("cms_menu_link","*","id",$id);
        if(!empty($getOneRecords)){
            foreach($getOneRecords AS $idex=>$val){
                $row_record=$val;
            }
            $data['records'] = $getOneRecords;
        }else{
            return;
        }
        $data['id'] = $id;
        //---check form validation
        $this->form_validation->set_rules('menu','menu','required');
        $this->form_validation->set_rules('menu_content','menu_content','required');
        $this->form_validation->set_rules('lnk','lnk','required');
        if($this->form_validation->run() == FALSE){
            $getMenu= $this->menu_model->getAllMenu(0,0,FALSE);
            if(empty($getMenu)){
                return;
            }
            $opt="";
            if($getMenu->num_rows()>0){
                foreach($getMenu->result() as $row){   
                    if($row->id == $row_record['menu_id']){
                        $opt.= "<option value=\"".$row->id."\" selected=\"selected\" >".$row->label."</option>";
                    }
                }
            }
            $arr=array('1' => 'Artical','2' => 'News','3' => 'Content');
            $content="";
            for($i=1;$i<=3;$i++){
                if($i == $row_record['section']){
                    $content.= "<option value=\"".$i."\" ".set_select("menu_content",$i,TRUE)." >".$arr[$i]."</option>";
                }else{
                    $content.= "<option value=\"".$i."\" ".set_select("menu_content",$i,FALSE)." >".$arr[$i]."</option>";
                }
            }
            $data['opt'] = $opt;
            $data['content'] = $content;
            header_admin();
            //----load banner
            banner_admin();
            //---load bar
            bar_admin();
            //---load left side admin
            left_admin();
            $content=$this->load->view('menu/menu_link_update',$data,TRUE);
            //---load content
            content_admin($content);
            //--load footer
            footer_admin();
            //---end of footer 
        }else{
           $contentid = $this->input->post("menu_content");
           $id1 = $this->input->post("lnk");
            if($contentid == '1'){
                $link ="cms/home/readArtical/".$id1;
            }else if($contentid == '2')
            {
                $link ="cms/home/readNews/".$id1;
            }else if($contentid == '3')
            {
                $link ="cms/home/readContent/".$id1;
            }else{
                $link ="#";
            }
            
            $form_array=array(
                        "menu_id"       => $this->input->post("menu"),
                        "link"          => $link,
                        "section"       => $contentid,
                        "section_id"       => $id1
                        );
            if($this->menu_model->updateLink($id,$form_array) == TRUE)
            {
                  $this->session->set_flashdata('msg',"<h4 class=\"alert_success\">Link Update Successfully</h4>");
                  redirect('menu/home/getLinks','refresh');
            }else{
                $this->session->set_flashdata('msg',"<h4 class=\"alert_error\">Link is Not Update</h4>");
                redirect('menu/home/getLinks','refresh');
            }
        }
    }

    /**
    * list of menu and its link
    */
    function getLinks()
    {
        //=====get the all reports shedules from database
        $recPerPage=$this->config->item('recperpage');
        $starting=$this->input->post('starting');
        if(!$starting){
            $starting =0;
        } 
        // check if menu is exist to add link to it
        $getMenu= $this->menu_model->getLinkMenu();
        if(empty($getMenu)){
            $data['menu'] = FALSE;
        }else{
            $data['menu'] = TRUE;
        }
        
        $getQuery= $this->menu_model->getAllLinks($starting,$recPerPage,TRUE);
        $getQueryTotal= $this->menu_model->getAllLinks($starting,$recPerPage,FALSE);
        if(empty($getQuery)){
            return ;
        }else{
            $data['records'] = $getQuery;
        }
        $str_post_str ="&ajax=1";
        $this->ajax_pagination->make_search(
        $getQueryTotal->num_rows(),
        $starting,
        $recPerPage,
        'First',
        'Last',
        'Previous',
        'Next',
        'Page',
        'Of',
        'Total',
        base_url()."menu/home/getLinks",
        'menuAjax1',
        $str_post_str
        );
       $data['page']      = $starting;
       $data['links']     = $this->ajax_pagination->anchors;
       $data['total']     = $this->ajax_pagination->total;
       if($this->input->post("ajax") == 1){
           $this->load->view('menu/menu_Link_list',$data);
           return;
        }
        //---get links from database
        header_admin();
        //----load banner
        banner_admin();
        //---load bar
        bar_admin();
        //---load left side admin
        left_admin();
        $content=$this->load->view('menu/menu_Link_list',$data,TRUE);
        //---load content
        content_admin($content);
        //--load footer
        footer_admin();
        //---end of footer      
    }

    /**
    * get the contetn
    */
    function getTypeOfContent()
    {
        $menu_id=$this->input->post('menu_id');
        if(empty($menu_id)){
            return;
        }
        $getContent=$this->menu_model->getContent($menu_id);
        if(empty($getContent)){
            return;
        }
        
        $opt="<select name=\"lnk\" id=\"lnk\">";
        $opt .="<option value=\"\"> Select An Item </option>";
        foreach($getContent AS $item){
            $opt .="<option value=\"".$item['id']."\" >".$item['title']."</option>";
        }
        $opt .="</select>";
        echo $opt;
          
    }
    /**
    * function used to delete the selected link
    */
    function deleteLink($id =0 )
    {
        if(empty($id)){
           return;
        }
        if($this->menu_model->deleteLink($id) == TRUE){
            $this->session->set_flashdata('msg',"<h4 class=\"alert_success\">Link Deleted Successfully</h4>");
            redirect('menu/home/getLinks','refresh');
        }else{
            $this->session->set_flashdata('msg',"<h4 class=\"alert_error\">Link Not Deleted Successfully</h4>");
            redirect('menu/home/getLinks','refresh');
        }
    }
}

