<?php
/**
* Model class from artical part of cms insert,update,delete..
* @author Nimatullah
* @copyright 2013
* @since march 15, 2013
* @version 1.0.0
*/
class Artical_model extends CI_Model
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
    * function to artical to database
    * @param array records
    */
    function insertArtical($records=array())
    {
        if(is_array($records) && count($records)>0)
        {
            $this->cms_db->trans_start();
            $this->cms_db->insert('cms_artical',$records);
            $this->cms_db->trans_complete();
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    /**
    * function to list all artical
    * 
    * @param mixed $offset
    * @param mixed $nrecords
    * @param mixed $istotal
    */
    function getArtical($offset,$nrecords,$istotal=FALSE)
    {                         
        $this->cms_db->select("*");
        $this->cms_db->from("cms_artical");
        if($istotal == TRUE)
        {
            $this->cms_db->limit($nrecords,$offset);
        }
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
    * function to list all artical where the artical is active
    * 
    * @param mixed $offset
    * @param mixed $nrecords
    * @param mixed $istotal
    */
    function getArtical1($offset,$nrecords,$istotal=FALSE)
    {                         
        $this->cms_db->select("*");
        $this->cms_db->from("cms_artical");
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
    * read the selected artical from database where the status is active
    * 
    * @param mixed $id
    */
    function readAritcal1($id = 0)
    {
        $this->cms_db->select("*");
        $this->cms_db->from("cms_artical");
        $this->cms_db->where("id",$id);
        $this->cms_db->where("status","a");
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
    * read the selected artical from database
    * 
    * @param mixed $id
    */
    function readAritcal($id = 0)
    {
        $this->cms_db->select("*");
        $this->cms_db->from("cms_artical");
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
    
    function countAllArtical()
    {
        $this->cms_db->select("COUNT(*) AS total");
        $this->cms_db->from("cms_artical");
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
    function countAllArtical1()
    {
        $this->cms_db->select("COUNT(*) AS total");
        $this->cms_db->from("cms_artical");
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
    * function to get articals from database
    */
    function toGetAllArtical()
    {
        $this->cms_db->select("*");
        $this->cms_db->from("cms_artical");
        $this->cms_db->where("status","a");
        $this->cms_db->limit(6);
        $this->cms_db->order_by('id','desc');
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
    * function to delet artical 
    */
    function deleteArtical($id =0)
    {
        if(!empty($id)){
            $this->cms_db->trans_start();
            $this->cms_db->where('id',$id);
            $this->cms_db->delete("cms_artical");
            $this->cms_db->trans_complete();
            return TRUE;
        }
        ELSE
        {
            return FALSE;
        }
    }
}