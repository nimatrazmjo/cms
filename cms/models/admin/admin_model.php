<?php
/**
* function for admin model using codeIgniter
* @author         Nimatullah Razmjo 
* @since          March 10, 2013
* @copyright      Copyright (c) 2013
* @version        1.0.0       
* using CodeIgnier Active Records
*/
class Admin_model extends CI_Model
{
    private $cms_db;
    //===define constructor
    function __construct()
    {
        parent::__construct();
        //-----load databas
        $this->cms_db=$this->load->database("cms",TRUE);
    }
    //---define destructor
    function __desctrut()
    {
       //---remove the temparary records from memory after execution 
    }
    //---get all section
    function getSection()
    {
        $query= $this->cms_db->select("*")
                              ->from("cms_section")
                              ->order_by("id","asc")
                              ->get();
        if($query)
        {
            if($query->num_rows()>0)
            {
                return $query;
            }
            else
            {
                return FALSE;
            }
        }  
        else
        {
            return FALSE;
        }
    }
   
    /**
    * login the user of the user is avaible
    */
    function loginUsers($username="",$password="")
    {
        $query= $this->cms_db->select("*")
                 ->from("cms_users")
                 ->where("username",$username)
                 ->where("password",md5($password))
                 ->get();
        if($query->num_rows() == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    /**
    * get copy right from database
    */
    function getCopyRight()
    {
        $query= $this->cms_db->select("*")
                 ->from("cms_copyright")
                 ->get();
        if($query->num_rows() >0){
            return $query->row_array();
        }else{
            return FALSE;
        } 
    }
    /**
    * add copy right to database
    * 
    * @param mixed $records
    */
    function addCopyRight($records =array())
    {
        if(is_array($records) && count($records)>0)
        {
            $this->cms_db->trans_start();
            $this->cms_db->insert('cms_copyright',$records);
            $this->cms_db->trans_complete();
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    /**
    * function which is used to update the selected copyright fields
    * 
    * @param mixed $id
    * @param mixed $records
    */
    function updateCopyRight($id=0,$records=array())
    {
        if($id && is_array($records) && count($records)>0){
            $this->cms_db->trans_start();
            $this->cms_db->where('id',$id);
            $this->cms_db->update('cms_copyright',$records);
            $this->cms_db->trans_complete();
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
    * delete the selected menu
    * 
    * @param mixed $id
    */
    function deletecopy($id)
    {
        $this->cms_db->trans_start();
        $this->cms_db->where('id',$id);
        $this->cms_db->delete('cms_copyright');
        $this->cms_db->trans_complete();
        return TRUE;
    }
}//--end of admin_model.php
//end of admin_model.php