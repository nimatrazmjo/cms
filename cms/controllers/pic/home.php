<?php
  /**
* Controller class for managing news part of website which provide,insert,update,delete and list
* @author Nimatullah Razmjo<nimatullah.razmjo@gmail.com>
* @copyright    Copyright (c) 2013.
 * @since        Version 1.0
 * @filesource
*/
class Home Extends CI_Controller
{
    
    
    //===define constructor
    function __construct()
    {
          parent::__construct();
          //---load model
          $this->load->model('cms/cms_model');
          $this->load->model('pic/pic_model');
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
        //---GET logo
        $geLogo=$this->getImages(3);
        $data['logo']= $geLogo;
        //---get banner
        $geBanner=$this->getImages(2);
        $data['banner']= $geBanner;
        $geSide=$this->getImages(4);
        
        $data['rightSide']= $geSide;
        $geSlide=$this->getImages(1);
        $data['slideshow']= $geSlide;
        
        //---header
        header_admin();
        //----load banner
        banner_admin();
        //---load bar
        bar_admin();
        //---load left side admin
        left_admin();
        $content=$this->load->view('pic/list_pic',$data,TRUE);
        //---load content
        content_admin($content);
        //--load footer
        footer_admin();
    }
    function addPicture()
    {
        $this->form_validation->set_rules('pic_type', 'pic_type', 'required');
        $this->form_validation->set_error_delimiters('<span class="error redcolor">', '</span>');
        if($this->form_validation->run() == FALSE)
        {
            //----images type
             $image_type="";
             $image_type .= "<option value=\"1\" > Slide Show</option>";
             if($this->pic_model->checkImages(2) == FALSE){
                    $image_type .="<option value=\"2\" >Banner</option>" ;
                }
            if($this->pic_model->checkImages(3) == FALSE){
                    $image_type .="<option value=\"3\" >Logo</option>" ;
                }
            if($this->pic_model->checkImages(4) == FALSE){
                    $image_type .="<option value=\"4\" >Donate Right Side</option>" ;
                }
            $data['pictures']= $image_type;
            //---header
            header_admin();
            //----load banner
            banner_admin();
            //---load bar
            bar_admin();
            //---load left side admin
            left_admin();
            $content=$this->load->view('pic/add_pic',$data,TRUE);
            //---load content
            content_admin($content);
            //--load footer
            footer_admin();
        }
        else
        {
           
            if($this->do_upload('image') == TRUE)
            {
                $pics=$this->file_info['raw_name'];
                $ext=$this->file_info['file_ext'];
                $size=$this->file_info['file_size'];
                $arrayAttachment=array(
                                'name'          => $pics,
                                'ext'           => $ext,
                                'size'          => $size,
                                'type'          => $this->input->post('pic_type'),
                                'registerdate'  => date('Y-m-d H:m:s'),
                                );
                //----insert the records int database
                if($this->pic_model->insertAttachment($arrayAttachment) == TRUE)
                {
                    redirect('pic/home/','refresh');
                }
            }
            else
            {
                redirect('cms/home/addPicture','refresh');
            }
        }   
    }
    /**
    * function which provide to update the selected images
    * 
    * @param mixed $id
    */
    function updateRecords($id = 0)
    {
        if(empty($id)){
            return ;
        }
        //---get the selected records from database
        $getRecords=$this->pic_model->getOneRecords("cms_attachment","*","id",$id);
        if(!$getRecords){
            return;
        }
        foreach($getRecords as $item){
            $row=$item;
        }
        $this->form_validation->set_rules('pic_type', 'pic_type', 'required');
        $this->form_validation->set_error_delimiters('<span class="error redcolor">', '</span>');
        if($this->form_validation->run() == FALSE){
            //----images type
             $image_type="";
             if($row['type'] == 1){
                $image_type .= "<option value=\"1\" > Slide Show</option>";
             }
             if($row['type'] == 2){
                  $image_type .="<option value=\"2\" >Banner</option>" ;
            }
            if($row['type'] == 3){
                $image_type .="<option value=\"3\" >Logo</option>" ;
            }
            if($row['type'] == 4){
                $image_type .="<option value=\"4\" >Donate Right Side</option>" ;
            }
            $data['pictures']= $image_type;
            $data['recordss'] =$row;
            $data['id']  = $id;
            //---header
            header_admin();
            //----load banner
            banner_admin();
            //---load bar
            bar_admin();
            //---load left side admin
            left_admin();
            $content=$this->load->view('pic/update_pic',$data,TRUE);
            //---load content
            content_admin($content);
            //--load footer
            footer_admin();
        }
        else
        {
           
            if($_FILES['image']['size'] >0){
                if($this->do_upload('image') == TRUE){
                    $pics=$this->file_info['raw_name'];
                    $ext=$this->file_info['file_ext'];
                    $size=$this->file_info['file_size'];
                    $arrayAttachment=array(
                                    'name'          => $pics,
                                    'ext'           => $ext,
                                    'size'          => $size,
                                    'type'          => $this->input->post('pic_type'),
                                    'registerdate'  => date('Y-m-d H:m:s'),
                                    );
                    //----insert the records int database
                    if($this->pic_model->updateRecords($id,$arrayAttachment) == TRUE)
                    {
                        redirect('pic/home/','refresh');
                    }
                }
            }
            else
            {
              
                redirect('pic/home/','refresh');
            }
        }
    }
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
    function getImages($type)
    {
        $getLogo=$this->pic_model->getImages($type);
        $html="";
        $i=0;
        if($getLogo){
            if($getLogo->num_rows()>0){
                foreach($getLogo->result() as $row){$i++;
                        $html.="    <div class=\"imagepanel\">
                                            <a href=\"".base_url()."pic/home/updateRecords/".$row->id."\" class=\"imgborder\">
                                                <img src=\"".base_url()."uploads/".$row->name."".$row->ext."\" alt=\"\" title=\"Update\"> 
                                            </a>
                                           
                                       </div>
                                   ";
                }
            }
        }
        return $html;
    }
}
