<?php
/**
* Model class from news part of cms insert,update,delete..
* @author Nimatullah
* @copyright 2013
* @since 15 march 2013
* @version 1.0.0
*/
class News_model extends CI_Model
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
    function insertNews($records=array())
    {
        if(is_array($records) && count($records)>0)
        {
            $this->cms_db->trans_start();
            $this->cms_db->insert('cms_news',$records);
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
    function getNews($offset,$nrecords,$istotal=FALSE)
    {                         
        $this->cms_db->select("*");
        $this->cms_db->from("cms_news");
        if($istotal == TRUE)
        {
            $this->cms_db->limit($nrecords,$offset);
        }
        //$this->cms_db->where("status","a");
        $this->cms_db->order_by("registerdate","desc");
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
    * function to get news from database  where the status is active
    */
    function getNews1($offset,$nrecords,$istotal=FALSE)
    {                         
        $this->cms_db->select("*");
        $this->cms_db->from("cms_news");
        if($istotal == TRUE)
        {
            $this->cms_db->limit($nrecords,$offset);
        }
        $this->cms_db->where("status","a");
        $this->cms_db->order_by("registerdate","desc");
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
    * function to read the news from specifiec records
    */
    function readNews($id = 0)
    {
        $this->cms_db->select("*");
        $this->cms_db->from("cms_news");
        $this->cms_db->where("status","a");
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
    * get the impartant news
    * 
    */
    function getFeaturedNews()
    {
        $this->cms_db->select("*");
        $this->cms_db->from("cms_news");
        $this->cms_db->where("featured",1);
        $this->cms_db->where("status","a");
        $this->cms_db->limit(8);
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
    * function count all news from database
    */
    function countAllNews()
    {
        $this->cms_db->select("COUNT(*) AS total");
        $this->cms_db->from("cms_news");
       // $this->cms_db->where("status","a");
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
    * function count all news from database  where the status is active
    */
    function countAllNews1()
    {
        $this->cms_db->select("COUNT(*) AS total");
        $this->cms_db->from("cms_news");
        $this->cms_db->where("status","a");
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
    * function to delet news 
    */
    function deleteNews($id =0)
    {
        if(!empty($id)){
            $this->cms_db->trans_start();
            $this->cms_db->where('id',$id);
            $this->cms_db->delete("cms_news");
            $this->cms_db->trans_complete();
            return TRUE;
        }
        ELSE
        {
            return FALSE;
        }
    }
    /**
    * function to delet news 
    */
    function upateNews($id =0,$records=array())
    {
        if(!empty($id) && is_array($records) && count($records)>0){
            $this->cms_db->trans_start();
            $this->cms_db->where('id',$id);
            $this->cms_db->update("cms_news",$records);
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