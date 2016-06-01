<?php
/**
* Controller class for managing news part of website which provide,insert,update,delete and list
* @author Nimatullah Razmjo <nimatullah.razmjo@gmail.com>
* @copyright    Copyright (c) 2013.
 * @since        Version 1.0
 * @filesource
*/
class Home extends CI_Controller
{
    //===define constructor
    function __construct()
    {
          parent::__construct();
          //---load model
          $this->load->model('cms/cms_model');
          $this->load->model('news/news_model');
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
         $this->getAllNews();
    }
    /**
    * function to add news into database
    */
    function addNews()
    {
          //===check form validation
          $this->form_validation->set_rules('title','title','required|max_length[50]');
          $this->form_validation->set_rules('desc','desc','required');
          if($this->form_validation->run() == FALSE)
          {
                //====load templates template
                header_admin();
                //----load banner
                banner_admin();
                //---load bar
                bar_admin();
                //---load left side admin
                left_admin();
                $content=$this->load->view('news/news_add','',TRUE);
                //---load content
                content_admin($content);
                //--load footer
                footer_admin();
          }
          else
          {                       
                //get the posted records from form
                $arr=array(
                            'title'         =>  $this->input->post('title'),
                            'featured'      =>  $this->input->post('featured_news'),
                            'status'        =>  $this->input->post('status'),
                            'description'   =>  $this->input->post('desc'),
                            'registerdate'  =>  date('Y-m-d H:m:s')
                            );   
                // send the records to database
                if($this->news_model->insertNews($arr) == TRUE)
                {
                    $this->session->set_flashdata('msg',"<h4 class=\"alert_success\">News Inserted Successfully</h4>");
                    redirect('news/home','refresh');
                }
                else
                {
                    $this->session->set_flashdata('msg',"<h4 class=\"alert_error\">News Not Inserted</h4>");
                    redirect('news/home/addNews','refresh');
                }
          
          }
    }
    /**
    * function to read the news details
    */
    function readNews($id)
    {
          if($id !=0)
          {
              //---get the news by selected id
              $getNewsRecords=$this->news_model->readNews($id);
              if($getNewsRecords)
              {
                  $data['newsRecords'] = $getNewsRecords->row_array();
              }
              else
              {
                  $data['newsRecords'] = NULL;
              }
              
              header_admin();
              //----load banner
              banner_admin();
              //---load bar
              bar_admin();
              //---load left side admin
              left_admin();
              $content=$this->load->view('news/news_view',$data,TRUE);
              //---load content
              content_admin($content);
              //--load footer
              footer_admin();
             /* 
              //====load templates template
              header_tpl();
              //---load banner template
              banner_tpl();
              //---load navigation button template
              navigation_tpl();
              //---load right template
              right_tpl();
              //---load left template
              $data=$this->load->view('news/news_view',$data,TRUE);
              content_tpl($data);
              //----load footer template
              footer_tpl();   */
          }
    }
    /**
    * function to get all news from database 
    */
    function getAllNews()
    {
       //=====get the all reports shedules from database
        $recPerPage=$this->config->item('recperpage');
        $starting=$this->input->post('starting');
        if(!$starting)
        {
            $starting =0;
        }                 
        //------read all news from database and listed on a page
        $getNews=$this->news_model->getNews($starting,$recPerPage,TRUE);
        if($getNews)
        {
          $data['records'] = $getNews;
        }
        else
        {
          $data['records'] = "";
        }
        $str_post_str ="&ajax=1";
        $this->ajax_pagination->make_search(
        $this->news_model->countAllNews(),
        $starting,
        $recPerPage,
        'First',
        'Last',
        'Previous',
        'Next',
        'Page',
        'Of',
        'Total',
        base_url()."news/home/getAllNews",
        'news',
        $str_post_str
        );
       $data['page']      = $starting;
       $data['links']     = $this->ajax_pagination->anchors;
       $data['total']     = $this->ajax_pagination->total;
       if($this->input->post('ajax') == 1)
       {
           $this->load->view('news/news_list_admin',$data);
       } 
       else
       {
           //====load templates template
           /*header_tpl();
           //---load banner template
           banner_tpl();
           //---load navigation button template
           navigation_tpl();
           //---load right template
           right_tpl();
           //---load left template
           $data=$this->load->view('news/news_list',$data,TRUE);
           content_tpl($data);
           //----load footer template
           footer_tpl(); */
           
           //--header
          header_admin();
          //----load banner
          banner_admin();
          //---load bar
          bar_admin();
          //---load left side admin
          left_admin();
          $content=$this->load->view('news/news_list_admin',$data,TRUE);
          //---load content
          content_admin($content);
          //--load footer
          footer_admin();
      }
    }

    function deletnews($id=0)
    {
        if(empty($id)){
            return;
        }
        if($this->news_model->deleteNews($id) == TRUE){
            $this->session->set_flashdata('msg',"<h4 class=\"alert_success\">Selected News Deleted Successfully</h4>");
            redirect("news/home/getAllNews","refresh");
        }
        else
        {
            $this->session->set_flashdata('msg',"<h4 class=\"alert_error\">Selected News Not deleted</h4>");
            redirect("news/home/getAllNews","refresh");
        }
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
        $getArtical=$this->cms_model->getArtical($starting,$recPerPage,TRUE);
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
        $this->cms_model->countAllArtical(),
        $starting,
        $recPerPage,
        'First',
        'Last',
        'Previous',
        'Next',
        'Page',
        'Of',
        'Total',
        base_url()."news/home/getAllArtical",
        'artical',
        $str_post_str
        );
       $data['page']      = $starting;
       $data['links']     = $this->ajax_pagination->anchors;
       $data['total']     = $this->ajax_pagination->total;
       if($this->input->post('ajax') == 1)
       {
           $this->load->view('artical/artical_list',$data);
       } 
       else
       {
           
         //--header
          header_admin();
          //----load banner
          banner_admin();
          //---load bar
          bar_admin();
          //---load left side admin
          left_admin();
          $content=$this->load->view('artical/artical_list',$data,TRUE);
          //---load content
          content_admin($content);
          //--load footer
          footer_admin(); 
           //====load templates template
          /* header_tpl();
           //---load banner template
           banner_tpl();
           //---load navigation button template
           navigation_tpl();
           //---load right template
           right_tpl();
           //---load left template
           $data=$this->load->view('artical/artical_list',$data,TRUE);
           content_tpl($data);
           //----load footer template
           footer_tpl();                      */
      } 
    }

    /**
    * function get featured news from database
    * 
    */
    function getFeaturedNews()
    {
        //-----get all featured news from database
        $featuredNews=$this->news_model->getFeaturedNews();
        $html="<ul>";
        if($featuredNews)
        {
            if($featuredNews->num_rows()>0)
            {
                foreach($featuredNews->result() as $row)
                {
                    $html .= "<li><a href=\"".base_url()."news/home/readNews/".$row->id."\">".$row->title."</a></li>";  
                }
            }
        }
        $html .="<ul>";
        return $html;
    }
    function updateNews($id = 0)
    {
        if(empty($id)){
            return;
        }
        //----get the selected records from database
        $getOneRecords=$this->news_model->getOneRecords("cms_news","*","id",$id);
        foreach($getOneRecords as $index=>$val){
            $row=$val;
        }
        $getOneRecords = $val;
        //get the news from database for update
        //===check form validation
        $this->form_validation->set_rules('title','title','required|max_length[50]');
        $this->form_validation->set_rules('desc','desc','required');
        if($this->form_validation->run() == FALSE)
        {     
            $data['id']=$id;
            //---check if the news is featured or not
            $featured="";
            if($getOneRecords['featured'] == 1){
               $featured .="<option value=\"0\"> Not Featured</option>";
               $featured .="<option value=\"1\" selected=\"selected\"> Featured</option>";
            }
            else{
                $featured .="<option value=\"0\" selected=\"selected\"> Not Featured</option>";
               $featured .="<option value=\"1\" > Featured</option>";
            }
            //check weather the news is active or not active
            $status="";
            if($getOneRecords['status'] == 'a'){
               $status .="<option value=\"b\">Not Active</option>";
               $status .="<option value=\"a\" selected=\"selected\">Active</option>";
            }
            else{
                $status .="<option value=\"b\" selected=\"selected\">Not Active</option>";
                $status .="<option value=\"a\" >Active</option>";
            }
            $data['featured'] = $featured;
            $data['status'] = $status;
            $data['recordss'] = $getOneRecords;
            //--header
            header_admin();
            //----load banner
            banner_admin();
            //---load bar
            bar_admin();
            //---load left side admin
            left_admin();
            $content=$this->load->view('news/news_update',$data,TRUE);
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
                            'featured'  => $this->input->post('featured_news'),
                            'status'  => $this->input->post('status'),
                            'description'  => $this->input->post('desc'),
                            'registerdate'=> date('Y-m-d H:m:s')
                            );    
            // send the records to database
            if($this->news_model->upateNews($id,$arr) == TRUE)
            {
                $this->session->set_flashdata('msg',"<h4 class=\"alert_success\">Selected News Updated Successfully</h4>");
                redirect('news/home','refresh');
            }
            else
            {
                $this->session->set_flashdata('msg',"<h4 class=\"alert_error\">Selected News Not Updated Successfully</h4>");
                redirect('news/home','refresh');
            }
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
          {     /*
                //====load templates template
                header_tpl();
                //---load banner template
                banner_tpl();
                //---load navigation button template
                navigation_tpl();
                //---load right template
                right_tpl();
                //---load left template
                //$data=$this->load->view('news/news_add','',TRUE);
                $data=$this->load->view('artical/artical_add','',TRUE);
                content_tpl($data);
                //----load footer template
                footer_tpl();  */
                
                //--header
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
                            'desc'  => $this->input->post('desc'),
                            'registerdate'=> date('Y-m-d H:m:s')
                            );  
                // send the records to database
                if($this->cms_model->insertArtical($arr) == TRUE)
                {
                    redirect('news/home/','refresh');
                }
                else
                {
                    redirect('news/home/addNews','refresh');
                }
          
          }
    }
    function getArtical()
    {
           //-----get all featured news from database
        $artical=$this->cms_model->toGetAllArtical();
        $html="<ul>";
        if($artical)
        {
            if($artical->num_rows()>0)
            {
                foreach($artical->result() as $row)
                {
                    $html .= "<li><a href=\"".base_url()."news/home/readArtical/".$row->id."\">".$row->title."</a></li>";  
                }
            }
        }
        $html .="<ul>";
        return $html;
    }  

}