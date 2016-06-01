<?php
  /**
* Model Class for CMS
* @author Nimatullah Razmjo
* @version 1.0.0
* @date 02-March-2013
* Using CodeIgniter Active Records
*/
class pic_model extends CI_Model
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
    //-- function to get images by its typ
    function getImages($type=0)
    {
        if(empty($type)){
            return;
        }
        if($type != 1){
            $this->cms_db->limit(1);
        }
        $this->cms_db->select("*")
                     ->from("cms_attachment")
                     ->where("type",$type)
                     ->order_by("registerdate","desc");
        $query=$this->cms_db->get();
        //echo $this->cms_db->last_query(); exit;
        if($query->num_rows()>0){
            return $query;
        }
    }
    //-- function to get images by its typ
    function getImages1($type=0)
    {
        if(empty($type)){
            return;
        }
        if($type != 1){
            $this->cms_db->limit(1);
        }
        $this->cms_db->select("*")
                     ->from("cms_attachment")
                     ->where("type",$type)
                     ->order_by("registerdate","desc");
        $query=$this->cms_db->get();
        //echo $this->cms_db->last_query(); exit;
        if($query->num_rows()>0){
            return $query->result_array();
        }
    }
    //---function to check if number of images is 1 for logo,banner,right donnate
    function checkImages($type=0)
    {
        if(empty($type)){
            return ;
        }
        $query=$this->cms_db->select("*")
                            ->from("cms_attachment")
                            ->where("type",$type)
                            ->get();
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
     /**
    * function insert the attachment records into database
    */
    function insertAttachment($records=array())
    {
        if(is_array($records) && count($records)>0)
        {
            $this->cms_db->trans_start();
            $this->cms_db->insert('cms_attachment',$records);
            $this->cms_db->trans_complete();
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    //---function to update the records
    function updateRecords($id =0,$records =array())
    {
        
        if(is_array($records) && count($records)>0 && !empty($id)){
            $this->cms_db->trans_start();
            $this->cms_db->where("id",$id);
            $this->cms_db->update("cms_attachment",$records);
            $this->cms_db->trans_complete();
            return TRUE;
        }
    }
    //---get one records
    function getOneRecords($table,$fields="*",$field="",$id =0 )
    {
        if(empty($table) && empty($fields) && empty($field) && empty($id)){
            return;
        }
         $query=$this->cms_db->select($fields)
                              ->from($table)
                              ->where($field,$id)
                              ->get();
         if($query->num_rows()>0){
             return $query->result_array();
         }else{
             return FALSE;
         }
                        
    }
}
//endo of pic_model.php
