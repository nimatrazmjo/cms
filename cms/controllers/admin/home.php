<?php
/**
* Cms website admin Controller
* @author Nimatullah Razmjo
* @since 3 april 2013
* @access public
* @version 1.0.0
*/
class Home Extends CI_Controller
{
    //---define constructor
    function __construct()
    {
      parent::__construct();
      //---load templates----
      $this->load->helper("template");
      $this->load->library('ajax_pagination');
      $this->load->library('form_validation');
      $this->load->library('cms_auth');
      $this->load->library('session');
      //---load model
      $this->load->model("menu/menu_model");
      $this->load->model("cms/cms_model");
      $this->load->model("news/news_model");
      $this->load->model("admin/admin_model");
      $this->load->model('pic/pic_model');
      $this->load->helper("function");
      //---check if the user id logged in
      userLoggedIn();
      //--- load helper
    }
    //---define destructor
    function __destruct()
    {
      // no code
    }
    function index()
    {
       //=====get the all reports shedules from database
        $recPerPage=$this->config->item('recperpage');
        $starting=$this->input->post('starting');
        if(!$starting){
            $starting =0;
        }                 
        //------read all news from database and listed on a page
        $getArtical=$this->menu_model->getAllMenu($starting,$recPerPage,TRUE);
        if($getArtical){
          $data['records'] = $getArtical;
          //to count number of records
          $totalRecords = $this->menu_model->getAllMenu($starting,$recPerPage,FALSE);
          $total = $totalRecords->num_rows();
        }else{
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
        base_url()."admin/home/index",
        'menuAjax',
        $str_post_str
        );
       $data['page']      = $starting;
       $data['links']     = $this->ajax_pagination->anchors;
       $data['total']     = $this->ajax_pagination->total;
      //---load header
      /*$getNews=$this->news_model->getNews(0,0,FALSE);
      $news="";
      if($getNews)
      {
          if($getNews->num_rows()>0)
          {
              foreach($getNews->result() as $item)
              {
                    $news .="<div class=\"newsec\">
                            <span>".$item->title."</span><br />".substr($item->description,0,60)." <a href=\"".base_url()."cms/home/readNews/".$item->id."\">>></a>
                            </div>";   
              }
          }
      }       */
      //---- get ;ogo
      //---GET logo
      $geLogo=$this->getImages(3);
      $data['logo']= $geLogo;
      //---get banner
      $geBanner=$this->getImages(2);
      $data['banner']= $geBanner;
      //-----
      if($this->input->post('ajax') == 1){
          $this->load->view("admin/menu_list",$data);
          return;
      }
      header_admin();
      //----load banner
      banner_admin();
      //---load bar
      bar_admin();
      //---load left side admin
      left_admin();
      $content=$this->load->view('admin/index',$data,TRUE);
      //---load content
      content_admin($content);
      //--load footer
      footer_admin();
      //---end of footer 
    }
     function getImages($type)
    {
        $getLogo=$this->pic_model->getImages($type);
        $html="";
        $i=0;
        if($getLogo){
            if($getLogo->num_rows()>0){
                foreach($getLogo->result() as $row){$i++;
                        $html.="<div class=\"imagepanel\">
                                            <a href=\"#\" class=\"imgborder\">
                                                <img src=\"".base_url()."uploads/".$row->name."".$row->ext."\" alt=\"\"> 
                                            </a>
                                  </div>
                                  <div>
                                   <h2><a href=\"".base_url()."pic/home/updateRecords/".$row->id."\" > Update </a></h2>
                                   </div>
                                ";
                }
            }
        }
        return $html;
    }
    /**
    * add copy right of the websites                      
    */
    function getCopy()
    {
        $getCopy=$this->admin_model->getCopyRight();
        if($getCopy){
            $data['isTRUE'] = TRUE;
            $data['copy'] = $getCopy;
        }else {
            $data['isTRUE'] = FALSE;
            $data['copy'] = "";
        }
        header_admin();
        //----load banner
        banner_admin();
        //---load bar
        bar_admin();
        //---load left side admin
        left_admin();
        $content=$this->load->view('admin/copy_list',$data,TRUE);
        //---load content
        content_admin($content);
        //--load footer
        footer_admin();
        //---end of footer  
    }
    /**
    * function add Copy  into databas
    */
    function addCopyRight()
    {
           //===check form validation
          $this->form_validation->set_rules('name','name','required');
          if($this->form_validation->run() == FALSE){
                //---load header
                header_admin();
                //----load banner
                banner_admin();
                //---load bar
                bar_admin();
                //---load left side admin
                left_admin();
                $content=$this->load->view('admin/copy_add','',TRUE);
                //---load content
                content_admin($content);
                //--load footer
                footer_admin();
          }else{
                //get the posted records from form
                $arr=array(
                            'name'  => $this->input->post('name'),
                            'regdate'=> date('Y-m-d H:m:s')
                            );  
                //print_r($_POST); exit;
                // send the records to database
                if($this->admin_model->addCopyRight($arr) == TRUE){
                    $this->session->set_flashdata('msg',"<h4 class=\"alert_success\"> Copy Right inserted Successfully</h4>");
                    redirect('admin/home/getCopy','refresh');
                }else{
                     $this->session->set_flashdata('msg',"<h4 class=\"alert_error\"> Copy Right Not inserted Successfully</h4>");
                    redirect('admin/home/getCopy','refresh');
                }
          
          }
    }
    /**
    * function update Copy  into databas
    */
    function updatecopy($id)
    {
           if(empty($id)){
                return;
           }
           $getOneRecords=getOneRecords("cms_copyright","*","id",$id);
           if(empty($getOneRecords)){
               return;
           }else{
               foreach($getOneRecords as $index=>$row)
               $data['copy'] = $row;
           }
           $data['id']  = $id;
           //===check form validation
          $this->form_validation->set_rules('name','name','required');
          if($this->form_validation->run() == FALSE)
          {
                //---load header
                header_admin();
                //----load banner
                banner_admin();
                //---load bar
                bar_admin();
                //---load left side admin
                left_admin();
                $content=$this->load->view('admin/copy_update',$data,TRUE);
                //---load content
                content_admin($content);
                //--load footer
                footer_admin();
           
          }
          else
          {
                //get the posted records from form
                $arr=array(
                            'name'  => $this->input->post('name')
                            );  
                // send the records to database
                if($this->admin_model->updateCopyRight($id,$arr) == TRUE){
                    $this->session->set_flashdata('msg',"<h4 class=\"alert_success\"> Copy Right updated Successfully</h4>");
                    redirect('admin/home/getCopy','refresh');
                }else{
                     $this->session->set_flashdata('msg',"<h4 class=\"alert_error\"> Copy Right Not updated Successfully</h4>");
                    redirect('admin/home/getCopy','refresh');
                }
          
          }
    }
    /**
    * function to delete the copy right from database
    * 
    * @param mixed $id  
    */
    function deletecopy($id=0)
    {
        if(empty($id)){
            return;
        }
        if($this->admin_model->deletecopy($id) == TRUE){
            $this->session->set_flashdata('msg',"<h4 class=\"alert_success\">Selected Copy right Deleted Successfully</h4>");
            redirect("admin/home/getcopy","refresh");
        }
        else
        {
            $this->session->set_flashdata('msg',"<h4 class=\"alert_error\">Selected Copy right Not deleted</h4>");
            redirect("admin/home/getcopy","refresh");
        }
    }

}//end of home.php


