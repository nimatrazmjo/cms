<?php
  /**
  * cms management Authentication for the cms websites
  * 
  * @copyright 2013 
  * @author Nimatullah Razmjo < nimatullah.razmjo@gmail.com>
  * @version 1.0.0
  * @since march 2013
  * @access public
  * 
  */
class Cms_auth
{  
      function __construct()
      {
          $this->ci =& get_instance();
          //$this->ci->load->model('user_model');
      }
      
      /**
      * login the users
      */
      function login($login="",$password="")
      {
          $this->ci->load->model('admin/admin_model');
          if(strlen($login)==0 && strlen($password)==0){
              return FALSE;
          }
          if($this->ci->admin_model->loginUsers($login,$password) == TRUE)
          {
              $this->ci->session->set_userdata(array(
                                'name'      => $login,
                                'status'        => TRUE
                        ));  
              return TRUE;
          }else{
              return FALSE;
          }
      }
      /**
      * check if the user is logged in?
      */
      //check if this user is logged in return bool 
        function is_logged_in()
        {
            if($this->ci->session->userdata('status') =='1' AND $this->ci->session->userdata('status') !='')
            {
              return TRUE;
            }
            else
            {
              return FALSE;
            }
        }
        /**
        * function for the user who wanna log out from the system
        */
        function logOut()
        {
             //unset user data 
            $this->ci->session->set_userdata(array('username' => '','status' => ''));
            //destroy all ci sessions
            $this->ci->session->sess_destroy();
        }
      /**
      * function to get featured news from databas
      * 
      */
      function getFeaturedNews()
      {
          $this->ci->load->model('news/news_model');
          $getFeaturedNews=$this->ci->news_model->getFeaturedNews();
          return $getFeaturedNews;
      }
      /**
      * getartical from database
      * 
      */
      function getArtical()
      {
          $this->ci->load->model('cms/cms_model');
          $getFeaturedNews=$this->ci->cms_model->toGetAllArtical();
          return $getFeaturedNews;
      }
      /**
      * function to get all all parent menu from database
      */
      function getParentMenu()
      {
          $this->ci->load->model('cms/cms_model');
          $getFeaturedNews=$this->ci->cms_model->getParentMenu();
          return $getFeaturedNews;
      }
      /**
      * function to get all section from database
      */
      function getAllSection()
      {
          $this->ci->load->model('admin/admin_model');
          $getSection=$this->ci->admin_model->getSection();
          return $getSection;
      }
      /**
      * function to get logo picture from database
      */
      function getLogo()
      {
          $this->ci->load->model('pic/pic_model');
          return $this->ci->pic_model->getImages(3);
      }
      /**
      * function get banner
      */
      function getBanner()
      {
         $this->ci->load->model('pic/pic_model');
         return $this->ci->pic_model->getImages(2);  
      }
      /**
      * function getrightMenuImages
      * 
      */
      function getRightImage()
      {
          $this->ci->load->model('pic/pic_model');
         return $this->ci->pic_model->getImages(4);  
      }
      /**'
      * get parent name of the menu
      */
      function  getParentName($id)
      {
          $this->ci->load->model('menu/menu_model');
          return $this->ci->menu_model->getParentName($id);
      }
      
     /**
     * Clear all attempt records for given IP-address and login
     * (if attempts to login is being counted)
     *
     * @param    string
     * @return    void
     */
     private function clear_login_attempts($login)
     {
        if ($this->ci->config->item('login_count_attempts', 'cms_auth')) {
            $this->ci->user_model->clear_attempts(
                    $this->ci->input->ip_address(),
                    $login,
                    $this->ci->config->item('login_attempt_expire', 'mng_auth'));
        }
     }  
     /**
     * get copy right of the website
     */
     function getCopyRight()
     {
          $this->ci->load->model('admin/admin_model');
          return $this->ci->admin_model->getCopyRight();
     } 
}