<?php
/**
* Login user for cms
* @author : Nimatullah Razmjo < nimatullah.razmjo@gmail.com>
*/
class Home extends CI_Controller
{
    //---define
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("admin/admin_model");
        $this->load->library('cms_auth');
        $this->load->library('session');
    }
    function index()
    {
        //check form validation
        //set validation rules
        $this->form_validation->set_rules('name','Name', 'required|trim|xss_clean');    
        $this->form_validation->set_rules('pass', "Password", 'trim|required|xss_clean');  
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('login',''); 
        }
        else
        {
           if($this->cms_auth->login($this->input->post('name'),$this->input->post('pass')) == TRUE)
            {
                redirect('admin/home','refresh');
            }
            else
            {
                $this->session->set_flashdata('msg',"<h4 class=\"alert_error\">Invalide Username And Password...</h4>");
                redirect("home","refresh");
            }  
        }
    }
    /**
    * function to logout the admin user
    */
    function logOut()
    {
        //---check the user is logged in
        if(!$this->cms_auth->is_logged_in())
        {
            //---redirect to login page
           redirect("home","refresh"); 
        }else{
            //---class logout function 
            $this->cms_auth->logOut();
            redirect("home","refresh"); 
        }
        
    }
}