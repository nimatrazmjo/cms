<?php
/**
* Home Class for Artical Of  website admin Controller
* @author Nimatullah Razmjo <nimatullah.razmjo@gmail.com>
* @access public
* @version 1.0.0
*/
class Home extends CI_Controller
{
     //===define constructor
    function __construct()
    {
          parent::__construct();
          //---load model
          $this->load->model('artical/artical_model');
          //----load helper
          $this->load->helper('template');
          $this->load->helper('function');
          //---load library files
          $this->load->library('form_validation');
          $this->load->library('upload');
          $this->load->library('ajax_pagination');
          $this->load->library('session');
          //---check if the user id logged in
          userLoggedIn();
    }
    //====define Destructor
    function __destruct()
    {
        //no code just remove temprary records after execution
    }
    function index()
    {
        $this->getAllArtical();    
    }
    /**
    * list all artical
    */
    function getAllArtical()
    {
       //=====get the all reports shedules from database
        $recPerPage=$this->config->item('recperpage');
        $starting=$this->input->post('starting');
        if(!$starting)
        {
            $starting =0;
        }                 
        //------read all news from database and listed on a page
        $getArtical=$this->artical_model->getArtical($starting,$recPerPage,TRUE);
        if($getArtical)
        {
          $data['records'] = $getArtical;
        }
        else
        {
          $data['records'] = "";
        }
        $str_post_str ="&ajax=1";
        $this->ajax_pagination->make_search(
        $this->artical_model->countAllArtical(),
        $starting,
        $recPerPage,
        'First',
        'Last',
        'Previous',
        'Next',
        'Page',
        'Of',
        'Total',
        base_url()."artical/home/getAllArtical",
        'artical',
        $str_post_str
        );
       $data['page']      = $starting;
       $data['links']     = $this->ajax_pagination->anchors;
       $data['total']     = $this->ajax_pagination->total;
       if($this->input->post('ajax') == 1)
       {
           $this->load->view('artical/artical_list_admin',$data);
       } 
       else
       {
            //---load header
            header_admin();
            //----load banner
            banner_admin();
            //---load bar
            bar_admin();
            //---load left side admin
            left_admin();
            $content=$this->load->view('artical/artical_list_admin',$data,TRUE);
            //---load content
            content_admin($content);
            //--load footer
            footer_admin();
           
      } 
    }
    
    /**
    * function add articals into databas
    */
    function addArtical()
    {
           //===check form validation
          $this->form_validation->set_rules('title','title','required|max_length[50]');
          $this->form_validation->set_rules('desc','desc','required');
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
                $content=$this->load->view('artical/artical_add','',TRUE);
                //---load content
                content_admin($content);
                //--load footer
                footer_admin();
           
          }
          else
          {
                //get the posted records from form
                $arr=array(
                            'title'  => $this->input->post('title'),
                            'status'  => $this->input->post('status'),
                            'desc'  => $this->input->post('desc'),
                            'registerdate'=> date('Y-m-d H:m:s')
                            );  
                //print_r($_POST); exit;
                // send the records to database
                if($this->artical_model->insertArtical($arr) == TRUE){
                    $this->session->set_flashdata('msg',"<h4 class=\"alert_success\"> Artical inserted Successfully</h4>");
                    redirect('artical/home','refresh');
                }else{
                     $this->session->set_flashdata('msg',"<h4 class=\"alert_success\"> Artical Not inserted Successfully</h4>");
                    redirect('artical/home','refresh');
                }
          
          }
    }
    function updateArtical($id=0)
    {
        if(empty($id)){
            return;
        }
       $getOneRecords=getOneRecords("cms_artical","*","id",$id);
       if(empty($getOneRecords)){
           return;
       }
       foreach($getOneRecords as $item=>$row){
          $data['records'] = $row; 
       }
       $html="";
       if($row['status'] == 'a'){
            $html.="<option value=\"b\"> Not Active</option>";
            $html.="<option selected=\"selected\" value=\"a\" > Active</option>";
       }else{
            $html.="<option value=\"b\" \"selected\"> Not Active</option>";
            $html.="<option value=\"a\" > Active</option>";
       }
        $data['status'] = $html;
       $data['id'] = $id;
        //===check form validation
        $this->form_validation->set_rules('title','title','required|max_length[50]');
        $this->form_validation->set_rules('desc','desc','required');
        if($this->form_validation->run() == FALSE){
            //---load header
            header_admin();
            //----load banner
            banner_admin();
            //---load bar
            bar_admin();
            //---load left side admin
            left_admin();
            $content=$this->load->view('artical/artical_update',$data,TRUE);
            //---load content
            content_admin($content);
            //--load footer
            footer_admin();

        }else{
            //get the posted records from form
            $arr=array(
                        'title'  => $this->input->post('title'),
                        'status'  => $this->input->post('status'),
                        'desc'  => $this->input->post('desc'),
                        'registerdate'=> date('Y-m-d H:m:s')
                        );  
            //print_r($_POST); exit;
            // send the records to database
            if($this->artical_model->insertArtical($arr) == TRUE){
                $this->session->set_flashdata('msg',"<h4 class=\"alert_success\"> Artical updated Successfully</h4>");
                redirect('artical/home','refresh');
            }else{
                 $this->session->set_flashdata('msg',"<h4 class=\"alert_success\"> Artical Not update Successfully</h4>");
                redirect('artical/home','refresh');
            }
        }
    }
    
    /**
    * function to read the selected artical
    * @param int id
    */
    function readArtical($id =0)
    {
        if($id != 0)
        {
              //---get the news by selected id
              $getArticalRecords=$this->artical_model->readAritcal($id);
              if($getArticalRecords)
              {
                  $data['articalRecords'] = $getArticalRecords->row_array();
              }
              else
              {
                  $data['articalRecords'] = NULL;
              }
              //====load templates template
              /*header_tpl();
              //---load banner template
              banner_tpl();
              //---load navigation button template
              navigation_tpl();
              //---load right template
              right_tpl();
              //---load left template
              $content=$this->load->view('artical/artical_view',$data,TRUE);
              content_tpl($content);
              //----load footer template
              footer_tpl(); */
              
               header_admin();
                //----load banner
                banner_admin();
                //---load bar
                bar_admin();
                //---load left side admin
                left_admin();
                $content=$this->load->view('artical/artical_view',$data,TRUE);
                //---load content
                content_admin($content);
                //--load footer
                footer_admin();
        }
    }
    function deleteArtical($id=0)
    {
        if(empty($id)){
            return;
        }
        if($this->artical_model->deleteArtical($id) == TRUE){
            $this->session->set_flashdata('msg',"<h4 class=\"alert_success\">Selected Artical Deleted Successfully</h4>");
            redirect("artical/home","refresh");
        }
        else
        {
            $this->session->set_flashdata('msg',"<h4 class=\"alert_error\">Selected Artical Not deleted</h4>");
            redirect("artical/home","refresh");
        }
    }
}