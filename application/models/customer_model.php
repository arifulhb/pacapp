<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
    }//end constract
    
    
    public function insert($data=null){
    
        $res =$this->db->insert('avcd_customer', $data); 
        if($res==true){
            $res=array('status'=>true,'new_id'=>$this->db->insert_id());
        }else{
            $res=array('status'=>FALSE);
        }
        return $res;
    }//end function
    
    public function search($keyword, $search_by,$limit,$offset){
        
        if($offset==''){
            $offset=0;
        }
        
        $sql='SELECT c.cust_sn, c.cust_card_id, cust_first_name, cust_last_name, cust_mobile, cust_car_no, IFNULL(UNIX_TIMESTAMP(c.date_added),0) as date_added, ';
        $sql.='(SELECT GROUP_CONCAT(n.cmpn_name SEPARATOR ", ") FROM avcd_subscription AS s LEFT OUTER JOIN avcd_campaign AS n ON n.cmpn_sn=s.cmpn_sn WHERE s.cust_sn=c.cust_sn ) AS cmpn_name ';
        $sql.='FROM (avcd_customer AS c) ';
        //$sql.='';        
        switch ($search_by):
            case 'name':
                $sql.='WHERE c.cust_first_name LIKE "%'.$keyword.'%" OR c.cust_last_name LIKE"%'.$keyword.'%" ';
                
                break;
            case 'card_number':
                //search including old id
                $sql.='LEFT OUTER JOIN avcd_customer_id AS i ON i.cust_sn = c.cust_sn ';
                $sql.='WHERE c.cust_card_id LIKE "%'.$keyword.'%" ';
                $sql.='OR i.cust_card_id LIKE  "%'.$keyword.'%" ';
                break;
            case 'nric':
                $sql.='WHERE c.cust_id LIKE "%'.$keyword.'%" ';
                break;
            case 'car_number':
                $sql.='WHERE c.cust_car_no LIKE "%'.$keyword.'%" ';
                break;
        endswitch;
                $sql.='GROUP BY c.cust_sn ';
                $sql.='ORDER BY c.cust_first_name ';
                $sql.='LIMIT '.$offset.', '.$limit;
                
         $res=$this->db->query($sql);
         
         //echo 'SQL: '.$this->db->last_query();         
         //exit();
         
         return $res->result_array();
        
    }//end function
    
    public function getTotalSearchNum($keyword, $search_by){
        
        
        $sql='SELECT cust_sn ';
        //$sql.='(SELECT GROUP_CONCAT(n.cmpn_name SEPARATOR ", ") FROM avcd_subscription AS s LEFT OUTER JOIN avcd_campaign AS n ON n.cmpn_sn=s.cmpn_sn WHERE s.cust_sn=c.cust_sn ) AS cmpn_name ';
        $sql.='FROM (avcd_customer AS c) ';
        //$sql.='';        
        switch ($search_by):
            case 'name':
                $sql.='WHERE c.cust_first_name LIKE "%'.$keyword.'%" OR c.cust_last_name LIKE"%'.$keyword.'%" ';
                
                break;
            case 'card_number':
                $sql.='WHERE c.cust_card_id LIKE "%'.$keyword.'%" ';
                break;
            case 'nric':
                $sql.='WHERE c.cust_id LIKE "%'.$keyword.'%" ';
                break;
            case 'car_number':
                $sql.='WHERE c.cust_car_no LIKE "%'.$keyword.'%" ';
                break;
        endswitch;
        
         $res=$this->db->query($sql);         
         
         return $res->num_rows();
        
    }//end function

    public function insert_session($data=null,$session=null){
    
        $this->db->trans_start();
        
        $res =$this->db->insert('avcd_customer', $data); 
        $new_id=$this->db->insert_id();
        //print_r($session);
        //$new_id=10;
        
        $_sredem=array();
        foreach($session as $row):
            array_push($_sredem,
                            array('cust_sn'=>$new_id,                                                                
                                'red_sessions'=>$row['red_sessions'],
                                'red_name'=>$row['red_name'],
                                'red_description'=>$row['red_description']
                                ));
        endforeach;
        //echo '<pre>';
        //print_r($_sredem);
        //echo '</pre>';
        //exit();
        $this->db->insert_batch('avcd_customer_session_redem', $_sredem); 
                
        
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
        
        $sql='SELECT `cust_sn`, `cust_card_id`, `cust_first_name`, `cust_last_name`, `cust_mobile`, `cust_car_no`, IFNULL(UNIX_TIMESTAMP(c.date_added),0) as date_added, cust_additional,';
        $sql.='(SELECT GROUP_CONCAT(n.cmpn_name SEPARATOR ", ") FROM avcd_subscription AS s LEFT OUTER JOIN avcd_campaign AS n ON n.cmpn_sn=s.cmpn_sn WHERE s.cust_sn=c.cust_sn ) AS cmpn_name ';
        $sql.='FROM (`avcd_customer` AS c) ';
        $sql.='GROUP BY `c`.`cust_sn` ';
        $sql.='ORDER BY `c`.`date_added` DESC ';
        $sql.='LIMIT '.$offset.','.$per_page;       
        $res=$this->db->query($sql);
        //echo $this->db->last_query();
        //print_r($res->result_array());
        //exit();
        return $res->result_array();
        
    }//end function
    
        public function getListFilter($per_page,$offset,$filter){
            
        if($offset==''){
            $offset=0;
        }
        
        $sql='SELECT `cust_sn`, `cust_card_id`, `cust_first_name`, `cust_last_name`, `cust_mobile`, `cust_car_no`, IFNULL(UNIX_TIMESTAMP(c.date_added),0) as date_added, cust_additional,';
        $sql.='(SELECT GROUP_CONCAT(n.cmpn_name SEPARATOR ", ") FROM avcd_subscription AS s LEFT OUTER JOIN avcd_campaign AS n ON n.cmpn_sn=s.cmpn_sn WHERE s.cust_sn=c.cust_sn ) AS cmpn_name ';
        $sql.='FROM (`avcd_customer` AS c) ';
        $sql.='WHERE c.date_added >= "'.$filter['from'].' 00:00:00" ';
        $sql.='AND c.date_added <= "'.$filter['to'].' 23:59:59" ';
        $sql.='GROUP BY `c`.`cust_sn` ';
        $sql.='ORDER BY `c`.`date_added` DESC ';        
        $sql.=' LIMIT '.$offset.','.$per_page;       
        $res=$this->db->query($sql);
        //echo $this->db->last_query();
        //print_r($res->result_array());
        //exit();
        return $res->result_array();
        
    }//end function
    
    /**
     * SHOW TRANSACTIONS REPORT
     * 
     * 
     * @param type $per_page
     * @param int $offset
     * @param type $filter
     */
    public function getListTransactions($per_page,$offset,$filter){
            
        if($offset==''){
            $offset=0;
        }
        
        $sql ='SELECT t.trn_sn, UNIX_TIMESTAMP(t.trn_date) as trn_date,  cu.cust_sn, s.subs_sn,s.cmpn_sn, CONCAT(cu.cust_first_name," ", cu.cust_last_name) AS cust_name, c.cmpn_name, ';
        $sql.='t.tran_activity, t.tran_value, u.user_name AS recorded_by, o.ol_name,t.tran_description ';
        $sql.='FROM avcd_transection AS t ';
        $sql.='LEFT OUTER JOIN avcd_subscription AS s ON s.subs_sn = t.subs_sn ';
        $sql.='LEFT OUTER JOIN avcd_customer AS cu ON cu.cust_sn=s.cust_sn ';
        $sql.='LEFT OUTER JOIN avcd_campaign AS c ON c.cmpn_sn=s.cmpn_sn ';
        $sql.='LEFT OUTER JOIN avcd_user AS u ON t.user_sn=u.user_sn ';
        $sql.='LEFT OUTER JOIN avcd_outlet AS o ON u.ol_sn=o.ol_sn ';
        $sql.='WHERE t.trn_date >= "'.$filter['from'].' 00:00:00" ';
        $sql.='AND t.trn_date <= "'.$filter['to'].' 23:59:59" ';        
        $sql.='ORDER BY trn_sn DESC ';
        $sql.=' LIMIT '.$offset.','.$per_page;       
        $res=$this->db->query($sql);
        //echo $this->db->last_query();
        //print_r($res->result_array());
        //exit();
        return $res->result_array();
        
    }//end function
        
    public function getRecord($_sn=NULL){
        
        $sql='SELECT cust_sn, cust_card_id, cust_id, CONCAT (cust_first_name, '."' '".' ,IFNULL(cust_last_name," ")) AS cust_first_name, cust_mobile, cust_phone, ';
        $sql.='cust_email, cust_dob, cust_address_line1, cust_address_line2, cust_city, cust_zip, cust_country,  ';
        $sql.='cust_car_no, cust_car_model, cust_car_color, cust_additional ';
        $sql.='FROM avcd_customer ';
        $sql.='WHERE cust_sn ='.$_sn;
        $res=$this->db->query($sql);
        
        
        return $res->result_array();
        
    }//end function

    public function getRecordByCardId($_sn=NULL){
        
        $sql='SELECT c.cust_sn, c.cust_card_id, cust_id, CONCAT (cust_first_name, '."' '".' ,IFNULL(cust_last_name," ")) AS cust_first_name, cust_mobile, cust_phone, ';
        $sql.='cust_email, cust_dob, cust_address_line1, cust_address_line2, cust_city, cust_zip, cust_country,  ';
        $sql.='cust_car_no, cust_car_model, cust_car_color, cust_additional ';
        $sql.='FROM avcd_customer as c ';
        $sql.='LEFT OUTER JOIN avcd_customer_id AS i ON i.cust_sn= c.cust_sn ';
        $sql.='WHERE c.cust_card_id = "'.$_sn.'" OR i.`cust_card_id`="'.$_sn.'" ';
        $res=$this->db->query($sql);
        
        //$sql.=' ';
        
        /*
        $this->db->select('cust_sn, cust_card_id, cust_id, CONCAT (cust_first_name,  cust_last_name) AS cust_first_name, cust_mobile, cust_phone, 
            cust_email, cust_dob, cust_address_line1, cust_address_line2, cust_city, cust_zip, cust_country, 
            cust_car_no, cust_car_model, cust_car_color, cust_additional');
        $this->db->from('avcd_customer');
        $this->db->where('cust_sn',$_sn);*/
        //$res=$this->db->get();
        
        return $res->result_array();
        
    }//end function
    
    public function getSessionRecord($_sn=NULL){
        
        $this->db->select('*');
        $this->db->from('avcd_customer_session_redem');
        $this->db->where('cust_sn',$_sn);        
        $res=$this->db->get();
        
        return $res->result_array();
        
    }//end function
    
    public function update($data, $_sn){
        
        
        $this->db->where('cust_sn',$_sn);   
        $res=$this->db->update('avcd_customer',$data);
        return $res;
        
    }//end function
    
    public function update_session($data, $_sn,$session=null){
        
        //trans start
        $this->db->trans_start();
        
            //Update session
            $this->db->where('cust_sn',$_sn);   
            $res=$this->db->update('avcd_customer',$data);
        
            //update redim
            foreach($session as $row):
                
                if($row['redem_sn']==''){
                    //ADD
                    $item=array('cust_sn'=>$_sn,
                                'red_sessions'=>$row['red_sessions'],
                                'red_name'=>$row['red_name'],
                                'red_description'=>$row['red_description']);
                    $this->db->insert('avcd_customer_session_redem',$item);
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
                    $this->db->update('avcd_customer_session_redem',$item,array('redem_sn'=>$row['redem_sn']));
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
        
            $this->db->delete('avcd_customer', array('cust_sn' => $data)); 
            $this->db->delete('avcd_subscription', array('cust_sn' => $data));             
            
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
        
        $this->db->select('cust_sn');
        $this->db->from('avcd_customer');
        $res=$this->db->get();
        return $res->num_rows;
    }//end function
    
    public function getTotalNumFilter($filter){
        
        $this->db->select('cust_sn');
        $this->db->from('avcd_customer');        
        $this->db->where('date_added >=',$filter['from'].' 00:00:00 ');
        $this->db->where('date_added <=',$filter['to'].' 23:59:59 ');
        $res=$this->db->get();
        return $res->num_rows;
    }//end function
    
    public function getTotalTransectionNum($filter){
        
        $this->db->select('trn_sn');
        $this->db->from('avcd_transection');        
        $this->db->where('trn_date >=',$filter['from'].' 00:00:00 ');
        $this->db->where('trn_date <=',$filter['to'].' 23:59:59 ');
        $res=$this->db->get();
        return $res->num_rows;
    }//end function
    
    public function getAllRecords(){
        $this->db->select('*');
        $this->db->from('avcd_outlet');
        $this->db->order_by('avcd_customer');
        $res=$this->db->get();
        
        return $res->result_array();
    }//end function

    /**
     *
     * Table `avcd_customer_id` is used to keep record of previous card_id if a new card_id is added
     *
	 *
     * @param $card_id
     *
     * @return mixed
     */
    public function getCampaignlist($card_id){

		//2015-03-27 SUM (cust_balance) is added in SELECT to show total of balance as per request of Nehru
		//2015-04-06 MAX (s.subs_sn) is added in SELECT to get the latest subscription no to solve receipt bug per request of Nehru

        $this->db->select('MAX(s.subs_sn) AS subs_sn, c.cust_first_name,c.cust_sn, IFNULL(SUM(s.cust_balance),0) AS cust_balance ,UNIX_TIMESTAMP(s.expire_date) as expire_date,
            m.cmpn_visit_active_button, c.cust_card_id, c.cust_car_no, s.cmpn_sn, m.cmpn_name, m.cmpn_type',FALSE);
        $this->db->from('avcd_customer AS c ');
        $this->db->join('avcd_subscription AS s ','s.cust_sn=c.cust_sn','LEFT OUTER');
        $this->db->join('avcd_campaign AS m','s.cmpn_sn = m.cmpn_sn','LEFT OUTER');
        $this->db->join('avcd_customer_id AS i','i.cust_sn=c.cust_sn','LEFT OUTER');
		$this->db->where('c.cust_card_id',$card_id);    //CARD ID NUMBER
		$this->db->where('m.cmpn_group',1);    //campaign is active[1] | campaign is not free[0]
//		$this->db->where('s.expire_date >=', date("Y-m-d",strtotime("now")));    //ADDED ON MARCH 27, 2015 - TO remove wrong balance in frontend
        $this->db->or_where('c.cust_id',$card_id);      //ID NUMBER
        $this->db->or_where('i.cust_card_id',$card_id);      //cust_card_id ID from history
        $this->db->group_by('c.cust_card_id');          //ADDED ON FEB 17, 2015 ON REQUEST OF Nehru at Whatsapp
		$this->db->order_by('s.subs_sn', 'desc');
        $res=$this->db->get();
//        echo $this->db->last_query();
//        exit();
        return $res->result_array();

    }//end function
    
    public function isCardBan($card_id){
        
        $this->db->select('card_id');
        $this->db->from('avcd_card_block');
        $this->db->where('card_id',$card_id);
        $res=$this->db->get();
        
        if($res->num_rows()>0){
            return TRUE;    
        }else{
            return FALSE;
        }
                
    }//end function
    
    /**
     * -> Update New Card ID
     * -> Add old Card ID to CustomerCardID table
     * @param type $data
     */
    public function changeCardID($data){
        
        $this->db->trans_start();
        
            //Update Card ID
            //$item=array();
            $this->db->where('cust_sn',$data['cust_sn']);   
            $res=$this->db->update('avcd_customer',array('cust_card_id'=>$data['new_card_id']));
        
            $item_res=FALSE;
            
            if($res==TRUE){
                $item = array(
                    'cust_sn' => $data['cust_sn'],
                    'cust_card_id' => $data['old_card_id']
                 );
                
                 $item_res=$this->db->insert('avcd_customer_id', $item); //may add a check if the id already in table
            }
               
        
            if($res==TRUE && $item_res==true){
                   //trans complete
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === TRUE)
                    {
                        //TRANS SUCCESS            
                        //$myres=array('status'=>TRUE,'data'=>$data);
                        $myres=TRUE;

                    }else
                    {
                        //GENERATE ERROR            
                        $myres=FALSE;
                    } 
            }else{
                //GENERATE ERROR            
                $myres=FALSE;
            }            
    
        return $myres;
    }//end function
    
    public function getCardListByCustomer($cust_sn){
        
        $this->db->select('cust_card_id');
        $this->db->from('avcd_customer_id');
        $this->db->where('cust_sn',$cust_sn);
        $res=$this->db->get();
        
        return $res->result_array();
        
    }//end function
    
    
    public function removeCardID($data){
        
        //$this->db->delete('mytable', array('id' => $id)); 
        $this->db->where('cust_sn', $data['cust_sn']);
        $this->db->where('cust_card_id', $data['card_id']);
        $res=$this->db->delete('avcd_customer_id'); 
        
        return $res;
        
    }//end function
    
    public function isCardIDUnique($card_id){
        
        $sql='(SELECT cust_card_id FROM avcd_customer WHERE cust_card_id='.$card_id.' ORDER BY cust_card_id) ';
        $sql.='UNION ';
        $sql.='(SELECT cust_card_id FROM avcd_customer_id WHERE cust_card_id='.$card_id.' ORDER BY cust_card_id)';        
        
        $res=$this->db->query($sql);
        
        return $res->num_rows();
        
    }//end if
    
    public function addCardIDtoBlockList($data){
        
        $res=$item_res=$this->db->insert('avcd_card_block', $data);
        return $res;
        
    }//end function
    
    public function getBlockIDList(){
        $this->db->select('card_id');
        $this->db->from('avcd_card_block');
        $res=$this->db->get();
        
        return $res->result_array();        
    }
    
    public function unbancardid($card_id){
        
        $this->db->where('card_id', $card_id);
        $res=$this->db->delete('avcd_card_block'); 
        return $res;
    }
    
    public function changeIdNumber($data,$cust_sn){
        
        $this->db->where('cust_sn',$cust_sn);   
        $res=$this->db->update('avcd_customer',$data);
        
        return $res;
        
    }//end function
    
    public function changepassword($data,$cust_sn){
        $this->db->where('cust_sn',$cust_sn);   
        $res=$this->db->update('avcd_customer',$data);
        
        return $res;
    }
    
    /**
     * Update any customer info sent through data
     * @param type $data
     * @param type $cust_sn
     */
    public function updateCustomerInfo($data,$cust_sn){
        
        $this->db->where('cust_sn',$cust_sn);   
        $res=$this->db->update('avcd_customer',$data);
        
        return $res;
    }//end function
    
}//end class