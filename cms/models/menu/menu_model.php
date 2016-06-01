<?php
/**
* Model Class for menu model using codeIgniter
* @author         Nimatullah Razmjo 
* @since          10 March 2013
* @copyright      Copyright (c) 2013
* @version        1.0.0       
* Using CodeIgniter Active Records
*/
class Menu_model extends CI_Model
{
    private $cms_db;
    //---load constructor
    function __construct()
    {
        parent::__construct();
        $this->cms_db= $this->load->database('cms',TRUE);
    }
    //---define destructor
    function __destruct()
    {
        //---no code just remove from memory
    }
    //-------get all menu from database
    function getAllMenu($offset,$nrecords,$isTotal= FALSE)
    {
        $this->cms_db->select("*");
        $this->cms_db->from("cms_menu");
        if($isTotal == TRUE)
        {
            $this->cms_db->limit($nrecords,$offset);
        }
        $this->cms_db->order_by("id","asc");
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
                    return $query;
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
    /**
    * function to update the records
    * 
    * @param mixed $id
    * @param mixed $records
    */
    function update($id=0,$records=array())
    {
        
        if($id && is_array($records) && count($records)>0)
        {
            
            $this->cms_db->trans_start();
            $this->cms_db->where('id',$id);
            $this->cms_db->update('cms_menu',$records);
            $this->cms_db->trans_complete();
            
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    /**
    * function to add menu
    * 
    * @param mixed $records
    */
    function addMenu($records =array())
    {
        if(is_array($records) && count($records)>0)
        {
            $this->cms_db->trans_start();
            $this->cms_db->insert('cms_menu',$records);
            $this->cms_db->trans_complete();
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    /**
    * delete the selected menu
    * 
    * @param mixed $id
    */
    function deleteRecords($id)
    {
        $this->cms_db->trans_start();
        $this->cms_db->where('id',$id);
        $this->cms_db->delete('cms_menu');
        $this->cms_db->trans_complete();
        return TRUE;
    }
    /**
    * function to get name of the menu
    * 
    * @param mixed $id
    */
    function getParentName($id)
    {
        $query=$this->cms_db->select("label")
                     ->from("cms_menu")
                     ->where("id",$id)
                     ->get();
        if($query->num_rows()>0){
            return $query->row()->label;
        }else{
            return FALSE;
        }
                     
    }
    /**
    * function get those who does not have link
    * 
    */
    function getLinkMenu()
    {                        
        $query = $this->cms_db->query("
                    SELECT * from cms_menu as cm
                    WHERE NOT EXISTS(
                          SELECT * FROM cms_menu_link AS cml
                          WHERE cml.menu_id = cm.id
                    )
                    ");
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return FALSE;
        }
    }
    
     /**
    * function to add link
    * 
    * @param mixed $records
    */
    function addLink($records =array())
    {
        if(is_array($records) && count($records)>0)
        {
            $this->cms_db->trans_start();
            $this->cms_db->insert('cms_menu_link',$records);
            $this->cms_db->trans_complete();
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    /**
    * function to add link
    * 
    * @param mixed $records
    */
    function updateLink($id=0,$records =array())
    {
        if($id && is_array($records) && count($records)>0)
        {
            $this->cms_db->trans_start();
            $this->cms_db->where('id',$id);
            $this->cms_db->update('cms_menu_link',$records);
            $this->cms_db->trans_complete();
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    function getAllLinks($offset,$nrecords,$istotal=FALSE)
    {
        if($istotal){
           $query= $this->cms_db->limit($nrecords,$offset);
        }
       $query= $this->cms_db->select("cml.id,cml.link,cm.label")
                             ->from("cms_menu AS cm")
                             ->join("cms_menu_link as cml","cml.menu_id = cm.id","left")
                             ->order_by("cm.id","asc")
                             ->get();
//       /echo $this->cms_db->last_query(); exit;
       if($query->num_rows()){
           return $query;
       }else{
           return FALSE;
       }
    }
    
    function getContent($menu_id)
    {
        if($menu_id == '1'){
            $table="cms_artical";
        }else if($menu_id == '2'){
            $table="cms_news";
        }else if($menu_id == '3'){
            $table="cms_content";
        }else{
            return;
        }

        $query=$this->cms_db->select("id,title")
                            ->from($table)
                            ->where("status","a")
                            ->order_by("title","ASC")
                            ->get();
        //            /echo $this->cms_db->last_query(); exit;
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return FALSE;;
        }
    }
    /**
    * delete the selected menu
    * 
    * @param mixed $id
    */
    function deleteLink($id)
    {
        $this->cms_db->trans_start();
        $this->cms_db->where('id',$id);
        $this->cms_db->delete('cms_menu_link');
        $this->cms_db->trans_complete();
        return TRUE;
    }
}