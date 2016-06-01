<?php
    /**
    * Function helper for the cms websites
    * @copyright 2013
    * @author Nimatullah Razmjo <nimatullah.razmjo#gmail.com>
    * @version 1.0.0
    * @since march 2013
    * @access public
    */
    /** 
    * function get menu from datase and
    */
    function getMenu($parent,$level,$selected)
    {
       $CI=& get_instance();
       $CI->load->library("clean_encrypt");
      $CI->load->model('cms/cms_model');
      $getMenu=$CI->cms_model->getMenu($parent);
      $html="<ul>";
      $i=2;
      if($getMenu){
          if($getMenu->num_rows()>0){
              foreach($getMenu->result() as $item){
                  $i ==2 && $level==0 ? $link="cms/home/index/".$item->id:$link=$item->link."/".$item->id;
                   if ($item->Count > 0){
                       if($item->id == $selected) $html.="<li><a href='".base_url()."".$link."' selected=\"selected\" >" . $item->label . "</a>";
                       else                       $html.="<li><a href='".base_url()."".$link."'  >" . $item->label . "</a>";
                        $html.=getMenu($item->id, $level + 1,$selected);
                        $html.="</li>";
                   }elseif ($item->Count==0){
                       if($item->id == $selected){
                            $html.="<li><a href='".base_url()."".$link."' class=\"selected\" >" . $item->label. "</a></li>";
                       }else{
                            $html.="<li><a href='".base_url()."".$link."'  >" . $item->label. "</a></li>";
                       }
                   }
                   $i++;
              }
          }
      }
      $html.="</ul>";
      return $html;
    }

    /**
    * function to read news from database
    */
    function getNews()
    {
          $CI=& get_instance();
          $CI->load->model('news/news_model');
          $getNews=$CI->news_model->getNews1(0,0,FALSE);
          $news="";
          if($getNews)
          {
              if($getNews->num_rows()>0)
              {
                  foreach($getNews->result() as $item)
                  {
                        $news .="<div class=\"newsec\">
                                <span>".$item->title."</span><br />".substr($item->description,0,60)." <a href=\"".base_url()."cms/home/readNews/".$item->id."/0\">>></a>
                                </div>";   
                  }
              }
          }
          return $news;
    }

    /**
    * function helper for cms websites
    * @copyright 2013 www.novatis.af
    * @author Nimatullah Razmjo
    * @since 17 march 2013
    */
    if(!function_exists('pre'))
    {
        function pre()
        {
            echo "<pre />";
        }
    }
    /**
    * get one records from database
    * 
    * @param mixed $table
    * @param mixed $fields
    * @param mixed $field   
    * @param mixed $id
    */
    if(!function_exists('getOneRecords'))
    {
        function getOneRecords($table="",$fields="*",$field="",$id=0)
        {
            $CI=& get_instance();
            $CI->load->model("news/news_model");
            $getquery=$CI->news_model->getOneRecords($table,$fields,$field,$id);
            return $getquery;
        }
    }
    /**
    * check for the user logged in
    */
    if(!function_exists('userLoggedIn'))
    {
        function userLoggedIn()
        {
            $CI=& get_instance();
            $CI->load->library("cms_auth");
            if(!$CI->cms_auth->is_logged_in()){
                redirect("home","refresh");
            }
        }
    }