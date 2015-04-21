<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
    //var $photo_path;
    
    public function __construct()
    {
        parent::__construct();
    }//end constract
    
    
    public function insert($data=null){
    
        $res =$this->db->insert('avcd_user', $data); 
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
        
        $this->db->select('u.user_sn,u.user_id, u.user_email, u.user_name, u.user_role_sn, ur.user_role');        
        $this->db->limit($per_page,$offset);
        $this->db->from('avcd_user as u');
        $this->db->join('avcd_user_role as ur','ur.user_role_sn=u.user_role_sn','LEFT OUTER');
        $this->db->order_by('u.user_sn','DESC');
        $res=$this->db->get();
        
        //echo $this->db->last_query();
        return $res->result_array();
        
    }//end function
    
        
    public function signin($data){
        
        $user_id=$data['user_id'];
        $user_pass=md5($data['user_pass']);
        
        $this->db->select('u.user_sn,u.user_id, u.user_email, u.user_name, u.user_role_sn, u.user_pin, ur.user_role');
        $this->db->from('avcd_user AS u');
        $this->db->join('avcd_user_role AS ur','ur.user_role_sn= u.user_role_sn','LEFT OUTER');
        $this->db->where('u.user_email',$user_id);
        $this->db->where('u.user_pass',$user_pass);
        //$this->db->where('user_status','active');
        $res=$this->db->get();
        //echo $this->db->last_query();
        return $res->result_array();
    }//end function
    
    public function getRecord($_sn=NULL){
        
        $this->db->select('u.user_sn, u.user_name, u.user_pin, u.user_role_sn, u.ol_sn, r.user_role, o.ol_name as outlet, u.user_id, u.user_email');
        $this->db->from('avcd_user as u');
        $this->db->join('avcd_user_role as r','r.user_role_sn=u.user_role_sn','LEFT OUTER');
        $this->db->join('avcd_outlet as o','o.ol_sn=u.ol_sn','LEFT OUTER');
        $this->db->where('u.user_sn',$_sn);        
        $res=$this->db->get();
        
        return $res->result_array();
        
    }//end function
    
    public function update($data, $_sn){
        
        //$this->db->set($data);
        $this->db->where('user_sn',$_sn);   
        $res=$this->db->update('avcd_user',$data);
        return $res;
        
    }//end function
    
    public function delete($data=null){
        
        $res= $this->db->delete('avcd_user', array('user_sn' => $data));         
        return $res;
        
    }//end function

    public function getTotalNum(){
        
        $this->db->select('ol_sn');
        $this->db->from('avcd_user');
        $res=$this->db->get();
        return $res->num_rows;
    }//end function
    
    public function getAllRecords(){
        $this->db->select('u.`user_sn`, u.`user_id`, u.`user_email`, u.`user_name`, u.`user_role_sn`, o.`ol_sn`, o.`ol_name`, o.`ol_phone`, o.`ol_country`, o.`ol_city`');
        $this->db->from('`avcd_user` AS u');
        $this->db->join('`avcd_outlet` AS o','o.ol_sn=u.`ol_sn`','LEFT');
        $this->db->order_by('ol_name');
        $res=$this->db->get();
        
        return $res->result_array();
    }//end function
    
    
    public function getAllRoles(){
        $this->db->select('*');
        $this->db->from('avcd_user_role');
        $this->db->order_by('rank');
        $res=$this->db->get();
        
        return $res->result_array();
    }//end function
    
    public function loginWithPIN($data){
        
        $this->db->select('u.user_sn, u.user_name, u.user_pin, u.user_role_sn, u.ol_sn, r.user_role, o.ol_name as outlet, u.user_id, u.user_email');
        $this->db->from('avcd_user as u');
        $this->db->join('avcd_user_role as r','r.user_role_sn=u.user_role_sn','LEFT OUTER');
        $this->db->join('avcd_outlet as o','o.ol_sn=u.ol_sn','LEFT OUTER');
        $this->db->where('u.user_pin',$data['user_pin']);        
        //$this->db->limit('1');
        
        $res=$this->db->get();  
        
        //echo 'sql: '.$this->db->last_query();
        //echo '<br>';
        //print_r($res->result_array());
        //exit();
        return $res->result_array();
        
    }//end function
    
    public function changepassword($data,$user_sn){
    
        $this->db->where('user_sn', $user_sn);
        $res =$this->db->update('avcd_user', $data); 
        
        return $res;
    }//end function            
    
}//end class