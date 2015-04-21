<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Outlet_model extends CI_Model
{
    //var $photo_path;
    
    public function __construct()
    {
        parent::__construct();
    }//end constract
    
    
    public function insert($data=null){
    
        $res =$this->db->insert('avcd_outlet', $data); 
        if($res==true){
            $res=array('status'=>true,'new_id'=>$this->db->insert_id());
        }else{
            
        }
        return $res;
    }//end function
        

    public function getList($per_page,$offset){
        if($offset==''){
            $offset=0;
        }
        
        $this->db->select('ol_sn, ol_name, ol_phone, ol_email');        
        $this->db->limit($per_page,$offset);
        $this->db->from('avcd_outlet');
        $this->db->order_by('ol_sn','DESC');
        $res=$this->db->get();
        
        //echo $this->db->last_query();
        return $res->result_array();
        
    }//end function
    
    public function getRecord($_sn=NULL){
        
        $this->db->select('*');
        $this->db->from('avcd_outlet');
        $this->db->where('ol_sn',$_sn);        
        $res=$this->db->get();
        
        return $res->result_array();
        
    }//end function
    
    public function update($data, $_sn){
        
        //$this->db->set($data);
        $this->db->where('ol_sn',$_sn);   
        $res=$this->db->update('avcd_outlet',$data);
        return $res;
        
    }//end function
    
    public function delete($data=null){
        
        $res= $this->db->delete('avcd_outlet', array('ol_sn' => $data)); 
        
        return $res;
        
    }//end function

    public function getTotalNum(){
        
        $this->db->select('ol_sn');
        $this->db->from('avcd_outlet');
        $res=$this->db->get();
        return $res->num_rows;
    }//end function
    
    public function getAllRecords(){
        $this->db->select('ol_sn, ol_name');
        $this->db->from('avcd_outlet');
        $this->db->order_by('ol_name');
        $res=$this->db->get();
        
        return $res->result_array();
    }//end function
    
}//end class