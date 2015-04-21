<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pending_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
    }//end constract
             

    public function getList($per_page,$offset){
        if($offset==''){
            $offset=0;
        }        
        $sql='SELECT s.`tmp_subs_sn`,UNIX_TIMESTAMP(s.update_date) as subs_date, UNIX_TIMESTAMP(s.subs_date) as start_date, s.num_of_months, s.update_date as req_date,s.cust_sn,cust.`cust_first_name`,s.cmpn_sn, c.`cmpn_name`,c.`cmpn_type`,c.cmpn_expire_duration, s.`subs_type`, s.`tran_value`, s.`cust_balance`,UNIX_TIMESTAMP(s.`expire_date`) as expire_date, o.`ol_name`,u.`user_name`, u.user_sn, s.subs_bill_no, s.subs_bill_amount, s.remark, s.car_number, s.car_color, s.car_model ';
        
        $sql.='FROM `avcd_subscription_tmp` AS s ';
        $sql.='LEFT OUTER JOIN `avcd_campaign` AS c ON c.`cmpn_sn`=s.`cmpn_sn` ';
        $sql.='LEFT OUTER JOIN `avcd_customer` AS cust ON cust.`cust_sn`=s.`cust_sn` ';
        $sql.='LEFT OUTER JOIN `avcd_user` AS u ON u.`user_sn`=s.`user_sn` ';
        $sql.='LEFT OUTER JOIN `avcd_outlet` AS o ON o.`ol_sn`=u.`ol_sn` ';
        $sql.='WHERE s.status=0 ';
        $sql.='ORDER BY s.`tmp_subs_sn`  ';
        $sql.='DESC LIMIT '.$offset.','.$per_page;               
        $res=$this->db->query($sql);
//        echo $this->db->last_query();
  //      exit();
        return $res->result_array();
        
    }//end function
    
    
    
    public function getRecord($_sn=NULL){
        
        $this->db->select('t.tmp_subs_sn,UNIX_TIMESTAMP(t.subs_date) as subs_date,t.cust_sn,c.cust_first_name, c.cust_id, c.cust_card_id,
            t.subs_type,t.cmpn_sn,cm.cmpn_name,  cm.`cmpn_expire_duration`,  t.old_balance, t.redemption, t.num_of_months,
            t.tran_value,t.cust_balance,UNIX_TIMESTAMP(t.expire_date) as expire_date,  t.user_sn, u.user_name, u.ol_sn, o.ol_name, 
            t.subs_bill_no, t.subs_bill_amount, t.car_number, t.car_color, t.car_model,t.remark, ');
        $this->db->from('avcd_subscription_tmp AS t');
        $this->db->join('avcd_customer AS c ','c.cust_sn=t.cust_sn','LEFT');
        $this->db->join('avcd_campaign as cm','cm.cmpn_sn=t.cmpn_sn','LEFT');
        $this->db->join('avcd_user AS u','u.user_sn=t.user_sn','LEFT');
        $this->db->join('avcd_outlet AS o','o.ol_sn=u.ol_sn','LEFT');
        $this->db->where('t.tmp_subs_sn',$_sn);        
        $res=$this->db->get();
        
        return $res->result_array();
        
    }//end function
    
    public function getViewRecord($_sn=null){
        
        $this->db->select('t.tmp_subs_sn,t.cust_sn,c.cust_first_name,c.cust_id, c.cust_card_id,c.cust_mobile,
            t.cmpn_sn,p.cmpn_name,t.subs_type, p.cmpn_expire_duration, t.num_of_months,
            UNIX_TIMESTAMP(t.subs_date) AS subs_date,  UNIX_TIMESTAMP(t.expire_date) AS expire_date,
            t.redemption, t.old_balance,t.tran_value, t.cust_balance, t.status, 
            t.subs_bill_no,  t.subs_bill_amount,t.car_number, 
            t.car_color, t.car_model,t.remark, UNIX_TIMESTAMP(t.update_date) AS update_date,
            t.user_sn, u.user_name, o.ol_name, u.ol_sn');
        $this->db->from('avcd_subscription_tmp AS t');
        $this->db->join('avcd_customer AS c ','c.cust_sn=t.cust_sn','LEFT');
        $this->db->join('avcd_campaign as p','p.cmpn_sn=t.cmpn_sn','LEFT');
        $this->db->join('avcd_user AS u','u.user_sn=t.user_sn','LEFT');
        $this->db->join('avcd_outlet AS o','o.ol_sn=u.ol_sn','LEFT');        
        $this->db->where('t.tmp_subs_sn',$_sn);        
        $res=$this->db->get();
        
        return $res->result_array();
        
    }//end function

    public function update($data, $_sn){
                
        $this->db->where('tmp_subs_sn',$_sn);   
        $res=$this->db->update('avcd_subscription_tmp',$data);
        return $res;
        
    }//end function
    

    public function delete($data=null){
                
//        $res=  $this->db->delete('avcd_subscription_tmp', 
//                array('tmp_subs_sn' => $data)); 
        
        $reject=array('status'=>2);
        
        $this->db->where('tmp_subs_sn',$data);           
        $res=$this->db->update('avcd_subscription_tmp',$reject);
        
        return $res;
        
    }//end function

    public function getTotalNum(){
        
        $this->db->select('tmp_subs_sn');
        $this->db->from('avcd_subscription_tmp');
        $this->db->where('status',0);
        $res=$this->db->get();
        return $res->num_rows;
        
    }//end function
    
    public function getAllRecords(){
        $this->db->select('*');
        $this->db->from('avcd_subscription_tmp');
        $this->db->where('status',0);
        $this->db->order_by('tmp_subs_sn','DESC');
        $res=$this->db->get();
        
        return $res->result_array();
    }//end function   
    
    
}//end class