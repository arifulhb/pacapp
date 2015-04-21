<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
    }//end constract
    
    
    public function insert($data=null){
    
        $res =$this->db->insert('avcd_campaign', $data); 
        if($res==true){
            $res=array('status'=>true,'new_id'=>$this->db->insert_id());
        }else{
            
        }
        return $res;
    }//end function
    
    
    public function insert_session($data=null,$session=null){
    
        $this->db->trans_start();
        
        $res =$this->db->insert('avcd_campaign', $data); 
        $new_id=$this->db->insert_id();
        //print_r($session);
        //$new_id=10;
        
        $_sredem=array();
        foreach($session as $row):
            array_push($_sredem,
                            array('cmpn_sn'=>$new_id,                                                                
                                'red_sessions'=>$row['red_sessions'],
                                'red_name'=>$row['red_name'],
                                'red_description'=>$row['red_description']
                                ));
        endforeach;
        //echo '<pre>';
        //print_r($_sredem);
        //echo '</pre>';
        //exit();
        $this->db->insert_batch('avcd_campaign_session_redem', $_sredem); 
                
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === TRUE)
        {
            //TRANS SUCCESS
            $res=array('status'=>true,'new_id'=>$new_id);
            
        }else
        {
            //GENERATE ERROR
            $res=array('status'=>FALSE);
        }  
        return $res;
        
    }//end function        

    public function getList($per_page,$offset){
        if($offset==''){
            $offset=0;
        }
        /*
        $this->db->select('cmpn_sn, cmpn_name, (SELECT COUNT(s.cust_sn) FROM `avcd_subscription` AS s WHERE s.cmpn_sn=c.`cmpn_sn`) AS subs ');
        $this->db->limit($per_page,$offset);
        $this->db->from('avcd_campaign');
        $this->db->order_by('cmpn_sn','DESC');
        $res=$this->db->get();
        */
        $sql='SELECT `cmpn_sn`, `cmpn_type`, `cmpn_name`, (SELECT COUNT(s.cust_sn) FROM `avcd_subscription` AS s WHERE s.cmpn_sn=c.`cmpn_sn`) AS subs, ';
        $sql.='(SELECT COUNT(t.trn_sn) FROM `avcd_transection` AS t LEFT OUTER JOIN `avcd_subscription` s ON s.subs_sn=t.subs_sn WHERE s.cmpn_sn=c.cmpn_sn) AS trns ';
        $sql.='FROM avcd_campaign AS c ';
        $sql.='ORDER BY c.`cmpn_sn`  ';
        $sql.='DESC LIMIT '.$offset.','.$per_page;               
        $res=$this->db->query($sql);
//        echo $this->db->last_query();
  //      exit();
        return $res->result_array();
        
    }//end function

    public function getRecord($_sn=NULL){
        
        $this->db->select('*');
        $this->db->from('avcd_campaign');
        $this->db->where('cmpn_sn',$_sn);        
        $res=$this->db->get();
        
        return $res->result_array();
        
    }//end function
    
    public function getSessionRecord($_sn=NULL){
        
        $this->db->select('*');
        $this->db->from('avcd_campaign_session_redem');
        $this->db->where('cmpn_sn',$_sn);        
        $res=$this->db->get();
        
        return $res->result_array();
        
    }//end function
    
    public function update($data, $_sn){
                
        $this->db->where('cmpn_sn',$_sn);   
        $res=$this->db->update('avcd_campaign',$data);
        return $res;
        
    }//end function
    
    public function update_session($data, $_sn,$session=null){
        
        //trans start
        $this->db->trans_start();
        
            //Update session
            $this->db->where('cmpn_sn',$_sn);   
            $res=$this->db->update('avcd_campaign',$data);
        
            //update redim
            foreach($session as $row):
                
                if($row['redem_sn']==''){
                    //ADD
                    $item=array('cmpn_sn'=>$_sn,
                                'red_sessions'=>$row['red_sessions'],
                                'red_name'=>$row['red_name'],
                                'red_description'=>$row['red_description']);
                    $this->db->insert('avcd_campaign_session_redem',$item);
                    //echo '<br>added: ';
                    //print_r($item);
                }else{
                    //UPDATE
                    //echo '<br>------------------------<br>';
                    //print_r($row);
                    
                    $item=array('red_sessions'=>$row['red_sessions'],
                                'red_name'=>$row['red_name'],
                                'red_description'=>$row['red_description']);
                    
                    //$this->db->where();
                    $this->db->update('avcd_campaign_session_redem',$item,array('redem_sn'=>$row['redem_sn']));
                    //echo '<br>updated status: ';
                    //print_r($ur);
                    //echo '<br>';
                    //print_r($item);
                    //echo '<br>------------------------<br>';
                }
                
            endforeach;
            
        //trans complete
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === TRUE)
        {
            //TRANS SUCCESS
            //echo 'trans success: ';
            $res=array('status'=>TRUE);
            
        }else
        {
            //GENERATE ERROR
            //echo 'trans error: ';
            $res=array('status'=>FALSE);
        }  
        //exit();
        return $res;
        
    }//end function

    public function delete($data=null){
        
        $this->db->trans_start();
        
            $this->db->delete('avcd_campaign', array('cmpn_sn' => $data)); 
            $this->db->delete('avcd_campaign_session_redem', array('cmpn_sn' => $data)); 
            
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === TRUE)
        {            
            $res=TRUE;
            
        }else
        {
            //GENERATE ERROR            
            $res=FALSE;
        }          
        
        return $res;
        
    }//end function

    public function getTotalNum(){
        
        $this->db->select('cmpn_sn');
        $this->db->from('avcd_campaign');
        $res=$this->db->get();
        return $res->num_rows;
        
    }//end function
    
    public function getAllRecords(){
        $this->db->select('*');
        $this->db->from('avcd_campaign');
        $this->db->order_by('cmpn_name');
        $res=$this->db->get();
        
        return $res->result_array();
    }//end function   
    
    public function delete_sesred($redem_sn){
        
        $res =$this->db->delete('avcd_campaign_session_redem', array('redem_sn' => $redem_sn)); 
        return $res;
    }//end function
    
}//end class