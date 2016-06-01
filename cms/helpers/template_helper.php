<?php
/**
  * template helper for the cms websites
  * @copyright 2013 
  * @author Nimatullah Razmjo <nimatullah.razmjo@gmail.com>
  * @version 1.0.0
  * @since march 2013
  * @access public
  */
/**
* looad header file
*/
//echo "I am Hwerw";exit;
if(!function_exists('header_tpl'))
{
    function header_tpl()
    {
       $CI=& get_instance();                                                               
       $CI->load->view('template/header');
    }
}
/**
* load banner files
*/
if(!function_exists('banner_tpl'))
{
    function banner_tpl()
    {
       $CI=& get_instance();
        $CI->load->library('cms_auth');
        //---get the logo for the websites
        $getLogo=$CI->cms_auth->getLogo();
        $imagePath = "";
        if($getLogo){
            $row=$getLogo->row();
            $imagePath=base_url()."uploads/".$row->name."".$row->ext;
        }
        //---get the banner for the website
        $getBanner=$CI->cms_auth->getBanner();
        $imageBannerPath="";
        if($getBanner){
            $item=$getBanner->row();
            $imageBannerPath=base_url()."uploads/".$item->name."".$item->ext;
        }
        $data['bannerPath'] = $imageBannerPath;
        $data['imagePath'] = $imagePath;
        $CI->load->view('template/banner',$data);
    }
}
/**
* load navigation button
*/
if(!function_exists('navigation_tpl'))
{
    function navigation_tpl($id)
    {
        $CI=& get_instance();
        $CI->load->helper("function");
        $data['menu']=getMenu(0,0,$id);
        $CI->load->view('template/navigation',$data);
    }
}
/**
* load content files
* @param string left
* @param string right
*/
if(!function_exists('content_tpl'))
{
    function content_tpl($content=NULL)
    {
       $CI=& get_instance();
       if(!empty($content))
       {
           $data['content'] = $content;
           $CI->load->view('template/content',$data);
       }
       else
       {
           $data['content'] = "";
           $CI->load->view('template/content',$data);
       }
    }
}
/**
* load right files
*/
if(!function_exists('right_tpl'))
{
    function right_tpl()
    {
        $CI=& get_instance();
        //----load library
        $CI->load->library('cms_auth');
        $data['news']=getNews();
        //--get images
        $getImages=$CI->cms_auth->getRightImage();
        $imagePath ="";
        if($getImages){
            $item=$getImages->row();
            $imagePath=base_url()."uploads/".$item->name."".$item->ext;
        }
        $data['imagePath'] = $imagePath;
        $CI->load->view('template/right',$data);
    }
}

/**
* load footer files
*/
if(!function_exists('footer_tpl'))
{
    function footer_tpl()
    {
        $CI=& get_instance();
        $CI->load->library('cms_auth');
        $parentMenu=$CI->cms_auth->getParentMenu();
        //pre();
        //print_r($parentMenu->result_array()); exit;
        $i=2;
        $menu="";
        if($parentMenu)
        {
            if($parentMenu->num_rows()>0)
            {
                foreach($parentMenu->result() as $row)
                {
                     $i ==2 ? $link="cms/home/index/".$row->id:$link=$row->link."/".$row->id;
                    $menu .="<a href=\"".base_url()."".$link."\">".$row->label."</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;";
                    $i++;
                }
            }
        }
        $data['footer'] = $menu;
        $getCopyrigt= $CI->cms_auth->getCopyRight();
        if($getCopyrigt){
            $data['copyright'] = $getCopyrigt['name'];
        }else{
            $data['copyright']  ="";
        }
        $CI->load->view('template/footer',$data);
    }
}
/**
* function to get main and left tempaltes
* 
*/
if(!function_exists('left_tpl'))
{
    function left_tpl()
    {
        $CI=& get_instance();
        $CI->load->library('cms_auth');
        $html="<ul>";
        $featuredNews=$CI->cms_auth->getFeaturedNews();
        if($featuredNews)
        {
            if($featuredNews->num_rows()>0)
            {
                foreach($featuredNews->result() as $row)
                {
                    $html .= "<li><a href=\"\">".$row->title."</a></li>";  
                }
            }
        }
        $html .="<ul>";
        $data['html']= $html;
        $CI->load->view('template/left',$data);
    }
}
/**
* ----------------------------admin tamplates-----------------------------------------------
*/
if(!function_exists('header_admin'))
{
    function header_admin()
    {
       $CI=& get_instance();
        $CI->load->view('admin/header');
    }
}
/**
* load banner files
*/
if(!function_exists('banner_admin'))
{
    function banner_admin()
    {
       $CI=& get_instance();
        $CI->load->view('admin/banner');
    }
}
/**
* load navigation button
*/
if(!function_exists('bar_admin'))
{
    function bar_admin()
    {
        $CI=& get_instance();
        $CI->load->view('admin/bar');
    }
}
/**
* load content files
* @param string left
* @param string right
*/
if(!function_exists('content_admin'))
{
    function content_admin($content=NULL)
    {
       $CI=& get_instance();
       if(!empty($content))
       {
           $data['content'] = $content;
           $CI->load->view('admin/content',$data);
       }
       else
       {
           $data['content'] = "";
           $CI->load->view('admin/content',$data);
       }
    }
}
/**
* load footer files
*/
if(!function_exists('footer_admin'))
{
    function footer_admin()
    {
        $CI=& get_instance();
        $CI->load->view('admin/footer');
    }
}
/**
* function to get main and left tempaltes
* 
*/
if(!function_exists('left_admin'))
{
    function left_admin()
    {
        $CI=& get_instance();
        $CI->load->library('cms_auth');
        $getSection= $CI->cms_auth->getAllSection();
        $html="";
        if($getSection){
            if($getSection->num_rows()>0){
                foreach($getSection->result() as $item){
                   $html .="<h3><a href=\"".base_url()."".$item->link."\">".$item->name."</a></h3>";
                }
            }
        }
        $data['section'] = $html;
        $CI->load->view('admin/left',$data);
    }
}