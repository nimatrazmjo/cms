<?php
/**
* Model class from news part of cms insert,update,delete..
* @author Nimatullah
* @copyright 2013
* @since 15 march 2013
* @version 1.0.0
*/
class Content_model extends CI_Model
{
    private $cms_db;
    //===define constructor
    function __construct()
    {
        parent::__construct();
        //-----load databas
        $this->cms_db=$this->load->database("cms",TRUE);
       // $this->ad_db=$this->load->database("advertisement",TRUE);
    }
    //---define destructor
    function __destruct()
    {
        //--no code just remove from memory
    }
    /**
    * function to news to database
    * @param mixed $records
    */
    function insertContent($records=array())
    {
        if(is_array($records) && count($records)>0)
        {
            $this->cms_db->trans_start();
            $this->cms_db->insert('cms_content',$records);
            $this->cms_db->trans_complete();
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    /**
    * function to get news from database
    */
    function getContent($offset,$nrecords,$istotal=FALSE)
    {                         
        $this->cms_db->select("*");
        $this->cms_db->from("cms_content");
         $this->cms_db->order_by("regdate","desc");
        if($istotal == TRUE)
        {
            $this->cms_db->limit($nrecords,$offset);
        }
       
        $query=$this->cms_db->get();
        
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
    * function to read the Content from specifiec records
    */
    function readContent($id = 0)
    {
        $this->cms_db->select("*");
        $this->cms_db->from("cms_content");
        $this->cms_db->where("id",$id);
        $query=$this->cms_db->get();
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
    * function count all Content from database
    */
    function countAllContent()
    {
        $this->cms_db->select("COUNT(*) AS total");
        $this->cms_db->from("cms_content");
        $query=$this->cms_db->get();
        if($query)
        {
            if($query->num_rows()>0)
            {
               return $query->row()->total; 
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
    * function to delet Content 
    */
    function deleteContent($id =0)
    {
        if(!empty($id)){
            $this->cms_db->trans_start();
            $this->cms_db->where('id',$id);
            $this->cms_db->delete("cms_content");
            $this->cms_db->trans_complete();
            return TRUE;
        }
        ELSE
        {
            return FALSE;
        }
    }
    /**
    * function to delet Content 
    */
    function upateContent($id =0,$records=array())
    {
        if(!empty($id) && is_array($records) && count($records)>0){
            $this->cms_db->trans_start();
            $this->cms_db->where('id',$id);
            $this->cms_db->update("cms_content",$records);
            $this->cms_db->trans_complete();
            return TRUE;
        }
        ELSE
        {
            return FALSE;
        }
    }
    
     /**
    * function toget Onrecords from the database
    * 
    * @param mixed $table
    * @param mixed $fields
    * @param mixed $field
    * @param mixed $id
    */
    function getOneRecords($table="" , $fields="*", $field="",$id=0)
    {
        if(!empty($table) && $fields !="" && $id != 0){
            $this->cms_db->select($fields);
            $this->cms_db->from($table);
            $this->cms_db->where($field,$id);
            $query=$this->cms_db->get();
            if($query){
                if($query->num_rows()>0){
                    return $query->result_array();
                }
                else{
                    return FALSE;
                }
            }
            else{
                return FALSE;
            }
        }
        else{
            return FALSE;
        }
    }
}