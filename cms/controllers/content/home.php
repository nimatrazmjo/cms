<?php  
/**
* Controller class for Content Of CMS 
* @author Nimatullah Razmjo < nimatullah.razmjo@gmail.com>
* @version 1.0.0
* @date 01-03-2013
*/
class Home Extends CI_Controller
{
  
        //===define constructor
        function __construct()
        {
              parent::__construct();
              //---load model
              $this->load->model('cms/cms_model');
              $this->load->model('content/content_model');
              $this->load->model('artical/artical_model');
              //----load helper
              $this->load->helper('template');
              $this->load->helper('function');
              //---load library files
              $this->load->library('form_validation');
              $this->load->library('upload');
              $this->load->library('session');
              $this->load->library('ajax_pagination');
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
             //=====get the all reports shedules from database
            $recPerPage=$this->config->item('recperpage');
            $starting=$this->input->post('starting');
            if(!$starting)
            {
                $starting =0;
            }   
            $getAllContent = $this->content_model->getContent($starting,$recPerPage,TRUE);
            $AllContent = $this->content_model->getContent($starting,$recPerPage,FALSE);
            if($getAllContent){
                $data['records'] = $getAllContent;
            }else{
                $data['records'] = "";
            }
             $str_post_str ="&ajax=1";
            $this->ajax_pagination->make_search(
            $AllContent->num_rows(),
            $starting,
            $recPerPage,
            'First',
            'Last',
            'Previous',
            'Next',
            'Page',
            'Of',
            'Total',
            base_url()."content/home",
            'content_list',
            $str_post_str
            );
           $data['page']      = $starting;
           $data['links']     = $this->ajax_pagination->anchors;
           $data['total']     = $this->ajax_pagination->total;
           if($this->input->post('ajax') == 1)
           {
               $this->load->view('content/content_list',$data);
               return ;
           } 
            //---load header
            header_admin();
            //----load banner
            banner_admin();
            //---load bar
            bar_admin();
            //---load left side admin
            left_admin();
            $content=$this->load->view('content/content_list',$data,TRUE);
            //---load content
            content_admin($content);
            //--load footer
            footer_admin();
            //---end of footer
        }
        /**
        * add new content to database
        */
        function addRecords()
        {
            //check for form validation
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
                $content=$this->load->view('content/content_add','',TRUE);
                //---load content
                content_admin($content);
                //--load footer
                footer_admin();
                //---end of footer
            }
            else
            {
               //get the posted records from form
                $arr=array(
                            'title'         => $this->input->post('title'),
                            'desc'          => $this->input->post('desc'),
                            'status'        => $this->input->post('status'),
                            'regdate'       => date('Y-m-d H:m:s')
                          ); 
                // send the records to database
                if($this->content_model->insertContent($arr) == TRUE)
                {
                    redirect('content/home/','refresh');
                }
                else
                {
                    redirect('content/home/addRecords','refresh');
                }
            }
        }
        /**
        * function is used to update the selected content
        * 
        * @param mixed $id
        */
        function updatecontent($id=0)
        {
            if(empty($id)){
                return;
            }
           $getOneRecords=getOneRecords("cms_content","*","id",$id);
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
                $content=$this->load->view('content/content_update',$data,TRUE);
                //---load content
                content_admin($content);
                //--load footer
                footer_admin();

            }else{
                //get the posted records from form
                $arr=array(
                            'title'     => $this->input->post('title'),
                            'status'    => $this->input->post('status'),
                            'desc'      => $this->input->post('desc')
                            );  
                //print_r($_POST); exit;
                // send the records to database
                if($this->content_model->upateContent($id,$arr) == TRUE){
                    $this->session->set_flashdata('msg',"<h4 class=\"alert_success\"> Content updated Successfully</h4>");
                    redirect('content/home','refresh');
                }else{
                     $this->session->set_flashdata('msg',"<h4 class=\"alert_error\"> Content Not update Successfully</h4>");
                    redirect('content/home','refresh');
                }
            }
        }
        /**
        * function to read the selecte Content
        * 
        * @param mixed $id
        */
        function readContent($id =0)
        {
            if($id != 0)
            {
                  //---get the news by selected id
                  $getContentRecords=getOneRecords("cms_content","*","id",$id);
                 // print_r($getContentRecords); exit;
                  if($getContentRecords)
                  {
                      foreach($getContentRecords AS $row){
                          $data['contentRecords'] = $row;
                      }
                  }
                  else
                  {
                      $data['contentRecords'] = NULL;
                  }
                  header_admin();
                  //----load banner
                  banner_admin();
                  //---load bar
                  bar_admin();
                  //---load left side admin
                  left_admin();
                  $content=$this->load->view('content/content_view',$data,TRUE);
                  //---load content
                  content_admin($content);
                  //--load footer
                  footer_admin();
            }
        }
         /**
        * function to delete the copy right from database
        * 
        * @param mixed $id  
        */
        function deletecontent($id=0)
        {
            if(empty($id)){
                return;
            }
            if($this->content_model->deleteContent($id) == TRUE){
                $this->session->set_flashdata('msg',"<h4 class=\"alert_success\">Selected Content Deleted Successfully</h4>");
                redirect("content/home","refresh");
            }
            else
            {
                $this->session->set_flashdata('msg',"<h4 class=\"alert_error\">Selected Content Not deleted</h4>");
                redirect("content/home","refresh");
            }
        }
}
