<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
    }//end constract 
    
    public function insert($data){
        
        $this->db->set($data);
        $res=$this->db->insert('avcd_subscription');
        
        return $res;
        
    }//end function

    public function getViewRecord($subs_sn){
        
        $this->db->select('UNIX_TIMESTAMP(tmp.`update_date`) AS update_date, t.subs_sn,t.cust_sn, c.cust_first_name,c.cust_id, c.cust_card_id,c.cust_mobile,
        t.cmpn_sn,p.cmpn_name,t.subs_type, tmp.num_of_months AS cmpn_expire_duration, 
        UNIX_TIMESTAMP(t.subs_date) AS subs_date,  UNIX_TIMESTAMP(t.expire_date) AS expire_date,
        t.cust_balance, t.subs_bill_no,  t.subs_bill_amount,t.car_number, 
        t.car_color, t.car_model,t.remark, t.user_sn, u.user_name, o.ol_name, u.ol_sn');
        $this->db->from('avcd_subscription AS t');
        $this->db->join('avcd_customer AS c ','c.cust_sn=t.cust_sn','LEFT');
        $this->db->join('avcd_campaign as p','p.cmpn_sn=t.cmpn_sn','LEFT');
        $this->db->join('avcd_user AS u','u.user_sn=t.user_sn','LEFT');
        $this->db->join('avcd_outlet AS o','o.ol_sn=u.ol_sn','LEFT');
        $this->db->join('avcd_subscription_tmp AS tmp','tmp.tmp_subs_sn=t.ref_no','LEFT');
        $this->db->where('t.subs_sn',$subs_sn);        
        $res=$this->db->get();
                
        return $res->result_array();
        
    }//end function
    
    /**
     * GET ALL PAST RECEIPT INCLUDING PENDING
     * GET ALL RECEIPT MADE BY CURRENT USER LOGGED IN
     * 
     * @param type $limit
     * @return type
     */
    public function getPastReceipts($limit){
        
        /*
        $this->db->select('s.*, UNIX_TIMESTAMP(s.subs_date) as start_date, UNIX_TIMESTAMP(s.expire_date) as end_date,
            UNIX_TIMESTAMP(s.req_date) as req_date, c.`cust_first_name`, p.`cmpn_name`,p.`cmpn_expire_duration` ');
        $this->db->from('avcd_subscription AS s');
        $this->db->join('avcd_customer AS c ','c.cust_sn=s.cust_sn','LEFT');
        $this->db->join('avcd_campaign as p','p.cmpn_sn=s.cmpn_sn','LEFT');
        $this->db->join('avcd_user AS u','u.user_sn=s.user_sn','LEFT');
        $this->db->join('avcd_outlet AS o','o.ol_sn=u.ol_sn','LEFT');
        $this->db->limit($limit);
        $this->db->order_by('s.subs_sn','DESC');
        //$this->db->where('s.subs_sn',$subs_sn);        
        */
        
        $_cu_sn=$this->session->userdata('ou_sn');
        
        $sql    ='(SELECT s.tmp_subs_sn AS subs_sn, "pending" AS subs_status, UNIX_TIMESTAMP(s.update_date) AS req_date,  s.cust_sn,c.`cust_first_name`, p.`cmpn_name`, ';
        $sql    .='UNIX_TIMESTAMP(s.subs_date) AS start_date, UNIX_TIMESTAMP(s.expire_date) AS end_date, p.`cmpn_expire_duration`, ';
        $sql    .='s.cust_balance, s.subs_bill_no, s.subs_bill_amount ';
        $sql    .='FROM `avcd_subscription_tmp` AS s ';
        $sql    .='LEFT OUTER JOIN avcd_customer AS c ON c.cust_sn=s.cust_sn ';
        $sql    .='LEFT OUTER JOIN avcd_campaign AS p ON p.cmpn_sn=s.cmpn_sn ';
        $sql    .='LEFT OUTER JOIN avcd_user AS u ON u.user_sn=s.user_sn ';
        $sql    .='LEFT OUTER JOIN avcd_outlet AS o ON o.ol_sn=u.ol_sn  ';
        $sql    .='WHERE u.ol_sn="'.$_cu_sn.'" and s.status =0 LIMIT 50) ';
        $sql    .='UNION ';
        $sql    .='(SELECT s.subs_sn AS subs_sn,"approved"  AS subs_status, UNIX_TIMESTAMP(s.req_date) AS req_date, s.cust_sn, c.`cust_first_name`, p.`cmpn_name`, ';
        $sql    .='UNIX_TIMESTAMP(s.subs_date) AS start_date, UNIX_TIMESTAMP(s.expire_date) AS end_date, p.`cmpn_expire_duration`,  ';
        $sql    .='s.cust_balance, s.subs_bill_no, s.subs_bill_amount ';
        $sql    .='FROM avcd_subscription AS s ';
        $sql    .='LEFT OUTER JOIN avcd_customer AS c ON c.cust_sn=s.cust_sn ';        
        $sql    .='LEFT OUTER JOIN avcd_campaign AS p ON p.cmpn_sn=s.cmpn_sn ';
        $sql    .='LEFT OUTER JOIN avcd_user AS u ON u.user_sn=s.user_sn ';        
        $sql    .='LEFT OUTER JOIN avcd_outlet AS o ON o.ol_sn=u.ol_sn ';
        $sql    .='WHERE u.ol_sn="'.$_cu_sn.'" LIMIT 50) ';
        $sql    .='ORDER BY `req_date` DESC ';        
        
        $res=$this->db->query($sql);
        
        //echo $this->db->last_query();
        //exit();
        return $res->result_array();
        
    }//end function;
    
    public function getReceipt($subs_sn){
        
        $this->db->select('s.subs_sn, s.`subs_type`, s.`subs_date`, s.`expire_date`, s.`cust_balance`, t.`update_date` AS req_date, s.`car_number`, s.`car_model`, s.`car_color`, s.`subs_bill_no`, s.`subs_bill_amount`,
            c.`cust_id`, c.`cust_sn`, c.`cust_first_name`, c.`cust_phone`, c.`cust_email`, c.`cust_card_id`, c.`cust_zip`,c.`cust_country`,s.remark,
            p.`cmpn_name`, p.`cmpn_expire_duration`, s.`ref_no`, t.`old_balance`, t.`tran_value`, t.`redemption`, o.ol_name, u.user_name');
        $this->db->from('avcd_subscription AS s'); 
        $this->db->join('avcd_customer AS c ','c.cust_sn=s.cust_sn','LEFT');
        $this->db->join('avcd_campaign as p','p.cmpn_sn=s.cmpn_sn','LEFT');
        $this->db->join('avcd_user AS u','u.user_sn=s.user_sn','LEFT');
        $this->db->join('avcd_outlet AS o','o.ol_sn=u.ol_sn','LEFT');
        $this->db->join('avcd_subscription_tmp AS t','t.tmp_subs_sn=s.ref_no','LEFT');
        $this->db->where('s.subs_sn',$subs_sn);
        
        $res=$this->db->get();
        
        return $res->result_array();
        
        
    }//end function
    
     public function getTempReceipt($subs_sn){
        /*
        $this->db->select('s.subs_sn, s.`subs_type`, s.`subs_date`, s.`expire_date`, s.`cust_balance`, t.`update_date` AS req_date, s.`car_number`, s.`car_model`, s.`car_color`, s.`subs_bill_no`, s.`subs_bill_amount`,
           c.`cust_id`, c.`cust_sn`, c.`cust_first_name`, c.`cust_phone`, c.`cust_email`, c.`cust_city`, c.`cust_zip`,c.`cust_country`,
            p.`cmpn_name`, p.`cmpn_expire_duration`, s.`ref_no`, t.`old_balance`, t.`tran_value`, t.`redemption`, o.ol_name, u.user_name');
        $this->db->from('avcd_subscription AS s'); 
        $this->db->join('avcd_customer AS c ','c.cust_sn=s.cust_sn','LEFT');
        $this->db->join('avcd_campaign as p','p.cmpn_sn=s.cmpn_sn','LEFT');
        $this->db->join('avcd_user AS u','u.user_sn=s.user_sn','LEFT');
        $this->db->join('avcd_outlet AS o','o.ol_sn=u.ol_sn','LEFT');
        $this->db->join('avcd_subscription_tmp AS t','t.tmp_subs_sn=s.ref_no','LEFT');
        
        $this->db->where('s.subs_sn',$subs_sn);
        */

         $sql='SELECT 	s.`tmp_subs_sn` AS subs_sn, s.`subs_type`, s.`subs_date`, s.`expire_date`, s.`cust_balance`, s.`update_date` AS req_date, s.`car_number`, ';
         $sql.='s.car_model, s.car_color, s.subs_bill_no, s.subs_bill_amount,s.tran_value, s.redemption, s.remark, ';
         $sql.='s.old_balance, c.cust_id, c.cust_sn, c.cust_first_name, c.cust_phone,  ';
         $sql.='c.cust_email, c.cust_card_id, c.cust_zip,c.cust_country,p.cmpn_name, p.cmpn_expire_duration,o.ol_name, u.user_name ';
         $sql.='FROM `avcd_subscription_tmp` AS s ';
         $sql.='LEFT OUTER JOIN avcd_customer AS c ON c.cust_sn=s.cust_sn ';
         $sql.='LEFT OUTER JOIN avcd_campaign AS p ON p.cmpn_sn=s.cmpn_sn ';
         $sql.='LEFT OUTER JOIN  avcd_user AS u ON u.user_sn=s.user_sn ';
         $sql.='LEFT OUTER JOIN avcd_outlet AS o ON o.ol_sn=u.ol_sn ';
         $sql.='WHERE s.tmp_subs_sn="'.$subs_sn.'"';
                                   
        $res=$this->db->query($sql);
        
        return $res->result_array();
        
        
    }//end function

    /**
     * 
     * @param type $cust_sn
     * @param type $cmpn_sn
     */
    public function getCustomerCampaignDetails($cust_sn, $subs_sn){
        
        $sql='SELECT cust.`cust_sn`, cust.`cust_first_name`,s.`subs_sn`, cust.`cust_id`, cust.`cust_car_no`,cust.`cust_card_id`, c.`cmpn_name`,c.`cmpn_type`, UNIX_TIMESTAMP(s.`expire_date`) AS expire_date, IFNULL(s.`cust_balance`,0) AS cust_balance, c.cmpn_duration_type, c.cmpn_expire_duration, u.user_name, o.ol_name ';
        $sql.='FROM `avcd_customer` AS cust ';
        $sql.='LEFT OUTER JOIN avcd_subscription AS s ON s.`cust_sn`=cust.`cust_sn` ';
        $sql.='LEFT OUTER JOIN avcd_campaign AS c ON c.`cmpn_sn`=s.`cmpn_sn` ';
        $sql.='LEFT OUTER JOIN avcd_user AS u ON s.user_sn=u.user_sn ';
        $sql.='LEFT OUTER JOIN avcd_outlet AS o ON o.ol_sn=u.ol_sn ';
        //$sql.='WHERE cust.`cust_sn`='.$cust_sn.' AND c.`cmpn_sn`='.$subs_sn;        
        $sql.='WHERE s.`subs_sn`='.$subs_sn;        
        
        $query =  $this->db->query($sql);        
        return $query->result_array();
        
    }//end function getCustomerCampaignDetails
    
    public function getCustomerCampaignDetailsAjax($cust_sn, $cmpn_sn){
        
        $sql='SELECT cust.`cust_sn`, cust.`cust_first_name`,s.`subs_sn`, cust.`cust_id`, cust.`cust_car_no`,cust.`cust_card_id`, c.`cmpn_name`,c.`cmpn_type`, UNIX_TIMESTAMP(s.`expire_date`) AS expire_date, IFNULL(s.`cust_balance`,0) AS cust_balance, c.cmpn_duration_type, c.cmpn_expire_duration ';
        $sql.='FROM `avcd_customer` AS cust ';
        $sql.='LEFT OUTER JOIN `avcd_subscription` AS s ON s.`cust_sn`=cust.`cust_sn` ';
        $sql.='LEFT OUTER JOIN `avcd_campaign` AS c ON c.`cmpn_sn`=s.`cmpn_sn` ';
        $sql.='WHERE cust.`cust_sn`='.$cust_sn.' AND c.`cmpn_sn`='.$cmpn_sn.' ';        
        $sql.='ORDER BY s.`subs_sn` DESC LIMIT 1 ';
        
        //$sql.='WHERE s.`subs_sn`='.$subs_sn;        
        
        $query =  $this->db->query($sql);        
        return $query->result_array();
        
    }//end function getCustomerCampaignDetails
    
    public function add_transection($data){
        
        //TRANSECTIN
        $this->db->trans_start();
        
        $this->db->set($data);
        $this->db->insert('avcd_transection');
        $newid=$this->db->insert_id();
        $value=$data['tran_value'];
        $type=$data['tran_type'];
        $subs_sn=$data['subs_sn'];
        
        $balance=$this->getSubscriptionBalance($subs_sn);
        //UPDATE BALANCE        
        if($type=='add'){
            $balance=$balance+$value;
        }elseif($type=='deduct'){
            $balance=$balance-$value;
        }
        
        $this->db->set('cust_balance',$balance);
        $this->db->where('subs_sn', $subs_sn);
        $this->db->update('avcd_subscription');
        

        //complete transection
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === TRUE)
        {
            //TRANS SUCCESS
            $res['new_id']=$newid;
            $res['status']=TRUE;
            $res['balance']=$balance;            
        }else
        {
            //GENERATE ERROR
            $res['status']=FALSE;
        }  
        return $res;
        
        
    }//end function add_transection
    
    
    public function addTransectionOnly($tran){
        
        $this->db->set($tran);
        $res=$this->db->insert('avcd_transection');        
        
        return $res;
        
    }//end function
    
    
    public function removeTransection($trn_sn){
        
        $this->db->where('trn_sn',$trn_sn);
        $this->db->delete('avcd_transection');
        
    }//end function
    
    public function removeSubscription($subs_sn){
        
        $this->db->where('subs_sn',$subs_sn);
        $this->db->delete('avcd_subscription');
        
    }//end function

    public function approveSubscriptionTmp($subs_sn){
        
        $update=array('status'=>1);
        $this->db->where('tmp_subs_sn',$subs_sn);        
        $this->db->update('avcd_subscription_tmp',$update);
        
    }//end function
    

    public function getSubscriptionRequestHistory($cust_sn){
        
        $sql='(SELECT s.subs_sn,  UNIX_TIMESTAMP(s.subs_date) AS subs_date,  s.subs_type,  s.cust_sn,  c.cust_first_name,  s.subs_type,  s.cmpn_sn,  p.cmpn_name,  t.num_of_months AS cmpn_expire_duration, s.cust_balance,  s.expire_date,  s.subs_bill_amount,"Approved" AS _status, s.user_sn, u.user_name, u.ol_sn, o.ol_name ';
        $sql.='FROM avcd_subscription AS s ';
        $sql.='LEFT OUTER JOIN avcd_subscription_tmp AS t ON t.tmp_subs_sn=s.ref_no ';
        $sql.='LEFT OUTER JOIN avcd_customer c ON c.cust_sn=s.cust_sn ';
        $sql.='LEFT OUTER JOIN avcd_campaign p ON p.cmpn_sn=s.cmpn_sn ';
        $sql.='LEFT OUTER JOIN avcd_user     u ON u.user_sn=s.user_sn ';
        $sql.='LEFT OUTER JOIN `avcd_outlet` o ON o.ol_sn=u.`ol_sn` ';
        $sql.='WHERE s.cust_sn='.$cust_sn.') ';
        $sql.='UNION ';
        $sql.='(SELECT  t.tmp_subs_sn AS subs_sn, UNIX_TIMESTAMP(t.subs_date) AS subs_date,  t.subs_type,  t.cust_sn,  c.cust_first_name,  t.subs_type,  t.cmpn_sn,  p.cmpn_name,  t.num_of_months AS cmpn_expire_duration, t.cust_balance,  t.expire_date,  t.subs_bill_amount, "Pending" AS _status, t.user_sn, u.user_name, u.ol_sn, o.ol_name ';
        $sql.='FROM avcd_subscription_tmp AS t ';
        $sql.='LEFT OUTER JOIN avcd_customer c ON c.cust_sn=t.cust_sn ';
        $sql.='LEFT OUTER JOIN avcd_campaign p ON p.cmpn_sn=t.cmpn_sn ';
        $sql.='LEFT OUTER JOIN avcd_user     u ON u.user_sn=t.user_sn ';
        $sql.='LEFT OUTER JOIN avcd_outlet   o ON o.ol_sn=u.ol_sn ';
        $sql.='WHERE t.status =0 AND t.cust_sn='.$cust_sn.')';
        $sql.='UNION ';
        $sql.='(SELECT  t.tmp_subs_sn AS subs_sn, UNIX_TIMESTAMP(t.subs_date) as subs_date,  t.subs_type,  t.cust_sn,  c.cust_first_name,  t.subs_type,  t.cmpn_sn,  p.cmpn_name,  t.num_of_months AS cmpn_expire_duration, t.cust_balance,  t.expire_date,  t.subs_bill_amount, "Rejected" AS _status, t.user_sn, u.user_name, u.ol_sn, o.ol_name ';
        $sql.='FROM avcd_subscription_tmp AS t ';
        $sql.='LEFT OUTER JOIN avcd_customer c ON c.cust_sn=t.cust_sn ';
        $sql.='LEFT OUTER JOIN avcd_campaign p ON p.cmpn_sn=t.cmpn_sn ';
        $sql.='LEFT OUTER JOIN avcd_user     u ON u.user_sn=t.user_sn ';
        $sql.='LEFT OUTER JOIN `avcd_outlet` o ON o.ol_sn=u.`ol_sn` ';
        $sql.='WHERE t.status =2 AND t.cust_sn='.$cust_sn.')';
        
        $res = $this->db->query($sql);
        
        //echo $this->db->last_query();
        return $res->result_array();
        
        
    }//end function getSubscriptionRequestHistory

    public function getCustomerTransections($subs_sn){
        
        $sql='SELECT t.`trn_sn`,t.`subs_sn`, UNIX_TIMESTAMP(t.`trn_date`) AS trn_date, t.`tran_value`, t.`tran_activity`, t.`tran_description`, u.`user_name` ';
        $sql.='FROM `avcd_transection` AS t ';
        $sql.='LEFT OUTER JOIN `avcd_user` AS u ON u.`user_sn`=t.`user_sn` ';
        $sql.='WHERE t.`subs_sn` = '.$subs_sn;
        $sql.=' ORDER BY trn_sn DESC ';
        $query =  $this->db->query($sql);        
        return $query->result_array();
        
    }//end function

    private function getSubscriptionBalance($subs_sn){
        
        $this->db->select('cust_balance');
        $this->db->from('avcd_subscription');
        $this->db->where('subs_sn',$subs_sn);
        $res=$this->db->get();
        
        $balance=$res->result_array();
        
        return $balance[0]['cust_balance'];
        
    }//end function

    /**
     * 
     * @param type $cust_sn
     * @param type $cmpn_sn
     * @return type
     */
    public function getCurrentBalance($cust_sn,$cmpn_sn){
        
        $sql='SELECT IFNULL(cust_balance,0) AS cust_balance ';
        $sql.='FROM avcd_subscription ';
        $sql.='WHERE cust_sn='.$cust_sn.' AND cmpn_sn='.$cmpn_sn;
        $query =  $this->db->query($sql);        
        return $query->result_array();
        
    }//end function

    /**
     * UPDATE CUSTOEMR COMMISION BALANCE
     * @param type $cust_sn
     * @param type $cmpn_sn
     
    public function updateBalance($cust_sn,$cmpn_sn){
        
        
    }//end function
    */
    
    /**
     * THIS FUNCTION SHOULD RETURN RESULT BASED ON  Subscription no.. not other
     * @param type $cust_sn
     * @param type $campaign_type
     * @return type
     */
    public function getCustomerSubscriptions($cust_sn, $campaign_type){
        
        $sql='SELECT c.`cmpn_sn`, c.`cmpn_name`,IFNULL(s.cust_balance,0) cust_balance, c.`cmpn_type`, s.`subs_sn`, UNIX_TIMESTAMP(s.`expire_date`) AS expire_date, cust.`cust_sn`, cust.`cust_first_name` ';
        $sql.='FROM `avcd_subscription` as s ';
        $sql.='LEFT OUTER JOIN `avcd_campaign` AS c ON c.`cmpn_sn`=s.`cmpn_sn` ';
        $sql.='LEFT OUTER JOIN `avcd_customer` AS cust ON s.`cust_sn`=cust.`cust_sn` ';
        $sql.='WHERE cust.`cust_sn`='.$cust_sn.' AND c.`cmpn_type`="'.$campaign_type.'" ';
        //$sql.='WHERE s.subs_sn='.$subs_sn.' ';
        $sql.='AND s.expire_date > now() ';
		/**
		 * UPDATED 	ORDER BY from DESC to ASC
		 * REASON: 	To sort Campaigns Subscribe (***) to in Customer Details view and match it with Customer
		 * 			Subscription Requests
		 * DATE: 	21st April, 2015
		 */
        $sql.='ORDER BY s.subs_sn ASC ';
                
        $query =  $this->db->query($sql);        
        return $query->result_array();
    }//end function
    
    public function getUnsubscribedCampaigns($cust_sn){
        
        $sql='SELECT c.`cmpn_sn`, c.`cmpn_name`, c.`cmpn_duration_type`, c.`cmpn_expire_duration`, c.`cmpn_type` ';
        $sql.='FROM `avcd_campaign` AS c ';
        $sql.='WHERE c.`cmpn_sn` NOT IN (SELECT cmpn_sn FROM `avcd_subscription` WHERE cust_sn ='.$cust_sn.') ';
        $sql.='ORDER BY c.`cmpn_sn` DESC ';
        //echo 'SQL: '.$sql;
        $query =  $this->db->query($sql);
        //echo 'last query: '.$this->db->last_query();
        return $query->result_array();
    }//end function
    
   public function getSubscribedCampaigns($cust_sn){
        
        $sql='SELECT c.`cmpn_name`, UNIX_TIMESTAMP(s.`subs_date`) as subs_date , UNIX_TIMESTAMP(s.`expire_date`) as expire_date ';
        $sql.='FROM `avcd_subscription` AS s ';
        $sql.='LEFT OUTER JOIN `avcd_campaign` AS c ON c.`cmpn_sn` =s.`cmpn_sn`';
        $sql.='WHERE s.`cust_sn`='.$cust_sn.' ';
        $sql.='ORDER BY s.`subs_date` ';        
        $query =  $this->db->query($sql);
        
        return $query->result_array();
    }//end function
    
    
    /**
     * GET ALL SUBSCRIPTIONS WHICH ARE EXPIRED BY TODAY
     * @param type $cust_sn
     * @return type
     */
    public function getSubscriptionHistory($cust_sn){
        
        $sql='SELECT c.`cmpn_name`, UNIX_TIMESTAMP(s.`subs_date`) as subs_date , s.subs_sn, s.subs_type,
            UNIX_TIMESTAMP(s.`expire_date`) as expire_date, s.cust_balance, s.subs_bill_no, s.subs_bill_amount ';
        $sql.='FROM `avcd_subscription` AS s ';
        $sql.='LEFT OUTER JOIN `avcd_campaign` AS c ON c.`cmpn_sn` =s.`cmpn_sn`';
        $sql.='WHERE s.`cust_sn`='.$cust_sn.' AND expire_date < now()';
        $sql.='ORDER BY s.`subs_date`';
        $query =  $this->db->query($sql);
        
        return $query->result_array();
        
        
    }//end function

    

    /**
     * 
     * @param type $cust_sn
     * @param type $cmpn_sn
     * @return type
     */
    public function unsubscribe($cust_sn,$cmpn_sn){
        //WARNING:  TO UPDATE THIS FUNCTION TO REMOVE WITH subs_sn
        
        $this->db->where('cust_sn',$cust_sn);
        $this->db->where('cmpn_sn',$cmpn_sn);
        $res=$this->db->delete('avcd_subscription');             
        
        return $res;
    }//end function
    
    
    public function remove_transection($trn_sn){
        
         //TRANSECTIN
        $this->db->trans_start();
        
        $this->db->select('subs_sn, tran_value, tran_type');
        $this->db->from('avcd_transection');
        $this->db->where('trn_sn',$trn_sn);
        
        $query=$this->db->get();        
        $res=$query->result_array();
        
        $value  =$res[0]['tran_value'];
        $type   =$res[0]['tran_type'];
        $subs_sn=$res[0]['subs_sn'];
        
        $this->db->where('trn_sn',$trn_sn);
        $this->db->delete('avcd_transection');
                
        
        $balance=$this->getSubscriptionBalance($subs_sn);
        //UPDATE BALANCE        
        if($type=='add'){
            $balance=$balance-$value;
        }elseif($type=='deduct'){
            $balance=$balance+$value;
        }
        
        $this->db->set('cust_balance',$balance);
        $this->db->where('subs_sn', $subs_sn);
        $this->db->update('avcd_subscription');
        

        //complete transection
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === TRUE)
        {
            //TRANS SUCCESS
            $res=$balance;            
        }else
        {
            //GENERATE ERROR
            $res=false;
        }  
        return $res;
        
    }//end function
    
    
        
    public function updateExpireDate($data,$subs_sn){
    
        $this->db->where('subs_sn',$subs_sn);
        $res = $this->db->update('avcd_subscription',$data);
        return $res;
        
    }//end function
    
    
    public function get_print_receipt($trn_sn){

//		2015-04-06 ADDED a sub query for cust_balance to get new balance of all subscriptions.
        $this->db->select('t.trn_sn, UNIX_TIMESTAMP(t.trn_date) as trn_date,t.tran_value, c.cmpn_name, cust.cust_first_name,
        cust.cust_last_name, cust.cust_card_id, cust.cust_car_no, t.tran_activity, t.tran_value,
        (SELECT SUM(ss.cust_balance)  FROM avcd_subscription as ss WHERE ss.cust_sn=cust.cust_sn GROUP BY cust_sn) AS cust_balance,
        UNIX_TIMESTAMP(s.expire_date) as expire_date') ;
        $this->db->from('avcd_transection AS t');
        $this->db->join('avcd_subscription AS s','s.subs_sn=t.subs_sn','LEFT OUTER');
        $this->db->join('avcd_campaign AS c','c.cmpn_sn=s.cmpn_sn','LEFT OUTER');
        $this->db->join('avcd_customer AS cust','cust.cust_sn= s.cust_sn','LEFT OUTER');
        $this->db->where('t.trn_sn',$trn_sn);

		/**
		 * Next where added to avoid free subscription point in calculation
		 * campaign is active[1] | campaign is not free[0]
		 *
		 * Date		21st April, 2015
		 */
        $this->db->where('c.cmpn_group',1);

        $res=$this->db->get();

//		echo $this->db->last_query();
//		exit();
        
        return $res->result_array();
        
    }//end function    
    
    public function hasExpired($_cust_sn,$_cmpn_sn){
        
        $sql='SELECT expire_date FROM avcd_subscription ';
        $sql.='WHERE cust_sn='.$_cust_sn.' AND cmpn_sn='.$_cmpn_sn.' AND expire_date > now()';                
        $res=$this->db->query($sql);

        if($res->num_rows()==0){
            return true;
        }else{
            return FALSE;
        }
        
    }//end function
    
    public function addTempSubscription($data){
    
        $this->db->set($data);
        $this->db->insert('avcd_subscription_tmp');
        $newid=$this->db->insert_id();
        
        return $newid;
        
    }//end function


	public function getSubscriptionTrashHistory($cust_sn){

		$this->db->select('s.subs_sn, c.cmpn_name, c.cmpn_type, t.*');
		$this->db->from('avcd_subscription_tmp as t');
		$this->db->join('avcd_campaign as c', 'c.cmpn_sn = t.cmpn_sn', 'LEFT');
		$this->db->join('avcd_subscription as s', 's.ref_no = t.tmp_subs_sn', 'LEFT');
		$this->db->where('t.cust_sn', $cust_sn);

		$res = $this->db->get();

		/*echo $this->db->last_query();
		var_dump($res->result_array());
		exit();*/

		return $res->result_array();

	}//end function


	public function reopen($tmp_subs_sn){


		$this->db->where('tmp_subs_sn', $tmp_subs_sn);
		$res = $this->db->update('avcd_subscription_tmp', array('status'=>0));
		return $res;


	}//end function
    
}//end class
