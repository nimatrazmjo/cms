<?php
/**
* Model Class for CMS
* @author Nimatullah Razmjo
* @version 1.0.0
* @date 02-March-2013
* Using CodeIgniter Active Records
*/
class Cms_model extends CI_Model
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
        /**
        * function to get mwnu from database
        */
        function getMenu($parent = 0)
        {
            $query=$this->cms_db->query("SELECT 
                                       a.id, 
                                       a.label, 
                                       cml.link, 
                                       Deriv1.Count FROM cms_menu a 
                                       LEFT OUTER JOIN ( 
                                                SELECT 
                                                    parent_id, 
                                                    COUNT(*) AS Count 
                                                FROM cms_menu 
                                                GROUP BY parent_id) 
                                                Deriv1 ON 
                                                a.id = Deriv1.parent_id 
                                       LEFT JOIN cms_menu_link as cml ON cml.menu_id = a.id
                                       WHERE a.parent_id=".$parent."");
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
        * function to get all parent menu where parent_id=0
        */
        function getParentMenu()
        {
            $this->cms_db->select(" cm.id, 
                                    cm.label, 
                                    cml.link,
                                  ");
            $this->cms_db->from("cms_menu as cm");
            $this->cms_db->join("cms_menu_link as cml","cml.menu_id = cm.id","left");
            $this->cms_db->where('parent_id',0);
            $this->cms_db->order_by('id','asc');
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
}//end of model.php