<?php
/**
* home Controller Class  cms website
* @author Nimatullah Razmjo < nimatullah.razmjo@gmail.com>
* @access public
* @version 1.0.0
*/
class Home Extends CI_Controller
{
  
        //===define constructor
        function __construct()
        {
              parent::__construct();
              //---load model
              $this->load->model('cms/cms_model');
              $this->load->model('news/news_model');
              $this->load->model('artical/artical_model');
              //----load helper
              $this->load->helper('template');
              $this->load->helper('function');
              //---load library files
              $this->load->library('form_validation');
              $this->load->library('clean_encrypt');
              $this->load->library('upload');
              $this->load->library('session');
              $this->load->library('ajax_pagination');
        }
        //====define Destructor
        function __destruct()
        {
            //no code just remove temprary records after execution
        }
        function index($id=0)
        {
             //====load templates template
             header_tpl();
             //---load banner template
             banner_tpl();
             //---load navigation button template
             navigation_tpl($id);
             //---load right template
             right_tpl();
             //-------get featured news from database
             $data['html'] = $this->getFeaturedNews();
             $data['slideshoww'] = $this->getSlideShowImages();
             //--------get artical from database
             $data['artical'] = $this->getArtical();
             //---load left template
             $content=$this->load->view('template/left',$data,TRUE);;
             //$content=$this->load->view('admin/admin',$data,TRUE);;
             content_tpl($content);
             //----load footer template
             footer_tpl();
        }
        /**
        * function to read the selected artical
        * @param int id
        */
        function readArtical($id =0,$tapid=0)
        {
            if($id != 0)
            {
                  //---get the news by selected id
                  $getArticalRecords=$this->artical_model->readAritcal1($id);
                  if($getArticalRecords)
                  {
                      $data['articalRecords'] = $getArticalRecords->row_array();
                  }
                  else
                  {
                      $data['articalRecords'] = NULL;
                  }
                  //====load templates template
                  header_tpl();
                  //---load banner template
                  banner_tpl();
                  //---load navigation button template
                  navigation_tpl($tapid);
                  //---load right template
                  right_tpl();
                  //---load left template
                  $content=$this->load->view('artical/artical_view',$data,TRUE);
                  content_tpl($content);
                  //----load footer template
                  footer_tpl();
            }
        }
        /**
        * function to read the news details
        */
        function readNews($id=0,$tapid=0)
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
                  //====load templates template
                  header_tpl();
                  //---load banner template
                  banner_tpl();
                  //---load navigation button template
                  navigation_tpl($tapid);
                  //---load right template
                  right_tpl();
                  //---load left template
                  $data=$this->load->view('news/news_view',$data,TRUE);
                  content_tpl($data);
                  //----load footer template
                  footer_tpl();
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
            $getNews=$this->news_model->getNews1($starting,$recPerPage,TRUE);
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
            $this->news_model->countAllNews1(),
            $starting,
            $recPerPage,
            'First',
            'Last',
            'Previous',
            'Next',
            'Page',
            'Of',
            'Total',
            base_url()."cms/home/getAllNews",
            'news',
            $str_post_str
            );
           $data['page']      = $starting;
           $data['links']     = $this->ajax_pagination->anchors;
           $data['total']     = $this->ajax_pagination->total;
           if($this->input->post('ajax') == 1)
           {
               $this->load->view('news/news_list',$data);
           } 
           else
           {
               //====load templates template
               header_tpl();
               //---load banner template
               banner_tpl();
               //---load navigation button template
               navigation_tpl(0);
               //---load right template
               right_tpl();
               //---load left template
               $data=$this->load->view('news/news_list',$data,TRUE);
               content_tpl($data);
               //----load footer template
               footer_tpl();
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
            $getArtical=$this->artical_model->getArtical1($starting,$recPerPage,TRUE);
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
            $this->artical_model->countAllArtical1(),
            $starting,
            $recPerPage,
            'First',
            'Last',
            'Previous',
            'Next',
            'Page',
            'Of',
            'Total',
            base_url()."cms/home/getAllArtical",
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
               //====load templates template
               header_tpl();
               //---load banner template
               banner_tpl();
               //---load navigation button template
               navigation_tpl(0);
               //---load right template
               right_tpl();
               //---load left template
               $data=$this->load->view('artical/artical_list',$data,TRUE);
               content_tpl($data);
               //----load footer template
               footer_tpl();
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
                        $html .= "<li><a href=\"".base_url()."cms/home/readNews/".$row->id."\">".$row->title."</a></li>";  
                    }
                }
            }
            $html .="<ul>";
            return $html;
        }
        function getArtical()
        {
               //-----get all featured news from database
            $artical=$this->artical_model->toGetAllArtical();
            $html="<ul>";
            if($artical)
            {
                if($artical->num_rows()>0)
                {
                    foreach($artical->result() as $row)
                    {
                        $html .= "<li><a href=\"".base_url()."cms/home/readArtical/".$row->id."\">".$row->title."</a></li>";  
                    }
                }
            }
            $html .="<ul>";
            return $html;
        }
        
        /**
        * function to upload images into database for slide show
        * 
        * @param mixed $id
        */
        function do_upload($id="")
        {
            if($_FILES)
            {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name']  =$id.'_'.rand(999,10000).'_'.date('YmdHis');
                $this->upload->initialize($config);
                if (! $this->upload->do_upload('image'))
                {
                    $this->upload->display_errors();
                   return FALSE;
                }
                else
                {
                     $this->file_info=$this->upload->data();
                     return TRUE;
                }
            }
        }
        /**
        * get images from database from slide show
        */
        function getSlideShowImages()
        {
            //---get images from database
            $getimages=$this->pic_model->getImages(1);
            $images="";
            if($getimages){
                if($getimages->num_rows()>0){
                    foreach($getimages->result() as $item){
                        $images .=" <li><img src=\"".base_url()."uploads/".$item->name."".$item->ext."\" height=\"250px\"  width=\"500px\" /></a><span>".$item->file_name."</span></li>";
                    }
                    
                }
            }
            return $images;
        }
        /**
        * function to get the content dynamicall 
        */
        function getContent($id)
        {
            $decoded_id= $id;// $this->clean_encrypt->decode($id);
            if(empty($decoded_id)){
                return;
            }
            //====load templates template
             header_tpl();
             //---load banner template
             banner_tpl();
             //---load navigation button template
             navigation_tpl($id);
             //---load right template
             right_tpl();   
              //---load left template
            $content="";
            content_tpl($content);
            //----load footer template
            footer_tpl();  
        }
}
//end of home.php