<?php
class Transaction extends CI_Controller {

    
    public function __construct()
    {
            parent::__construct();
            
            if(($this->session->userdata('is_logged_in')==TRUE) ||
                ($this->session->userdata('is_front_logged_in')==TRUE)    )
            {
                $this->load->library('template');
                
            }else{                
                redirect('login');
            }
            
            no_cache();            
                        
    }//end constractor
    
    
    public function receipt_giftcard(){
    
        if($this->session->userdata('is_front_logged_in')==TRUE){
            
            
            $new_data=array();
            $new_data['subs_sn']=$this->input->post('subs_sn');
            $date = new DateTime();        
            $new_data['trn_date']=$date->format("Y-m-d H:i:s");
            $new_data['user_sn']=$this->session->userdata('user_sn_front');                                   
            $new_data['tran_value']=$this->input->post('value');
            $new_data['tran_activity']='Deducted amount '.$new_data['tran_value'];            
            $new_data['tran_type']='deduct';//DEDUCT FROM CUSTOMER
            $new_data['tran_description']='Added in Frontend';
                        
            $this->load->model('subscription_model');        
            $res=$this->subscription_model->add_transection($new_data);            
            
            if($res['status']==TRUE){
                $data=  site_data();
                $data['_page_title']="Membership Receipt";
                $data['_record']=$this->subscription_model->get_print_receipt($res['new_id']);                                
                $this->template->front_campaign_giftcard_receipt($data);  
                
            }else{
                //Datbase add fail
            }                      
        
            
        }else{
            //user not logged in
            //FRONT END LOGIN
            redirect('login');
            
        }//end else
        
        
    }//end function
    
    public function receipt_session(){
    
        if($this->session->userdata('is_front_logged_in')==TRUE){
            
            
            $new_data=array();
            $new_data['subs_sn']=$this->input->post('subs_sn');
            $date = new DateTime();        
            $new_data['trn_date']=$date->format("Y-m-d  H:i:s");
            
            $new_data['user_sn']=$this->session->userdata('user_sn_front');
            
            $new_data['tran_value']=$this->input->post('_redeem');
            $new_data['tran_activity']='Redeem '.$new_data['tran_value'].' "'.$this->input->post('_red_name').'"';            
            $new_data['tran_type']='deduct';//REDEEM = DEDUCT FROM CUSTOMER
            $new_data['tran_description']='Added in Frontend';
                        
            $this->load->model('subscription_model');        
            $res=$this->subscription_model->add_transection($new_data);            
            
            if($res['status']==TRUE){
                $data=  site_data();
                $data['_page_title']="Membership Receipt";
                $data['_record']=$this->subscription_model->get_print_receipt($res['new_id']);                                
                $this->template->front_campaign_session_receipt($data);
                
            }else{
                //Datbase add fail
				echo "Database Failed to add transaction";
            }                      
        
            
        }else{
            //user not logged in
            //FRONT END LOGIN
            redirect('login');
            
        }//end else
        
        
    }//end function
    
    public function receipt_visit(){
    
        if($this->session->userdata('is_front_logged_in')==TRUE){
            
            
            $new_data=array();
            $new_data['subs_sn']=$this->input->post('subs_sn');
            $date = new DateTime();        
            $new_data['trn_date']=$date->format("Y-m-d H:i:s");
            $new_data['user_sn']=$this->session->userdata('user_sn_front');                                   
            $new_data['tran_activity']='Check In 1 Visit';
            $new_data['tran_value']=1;
            $new_data['tran_type']='add';            
            $new_data['tran_description']='Added '.$new_data['tran_value'];
                 
            $this->load->model('subscription_model');        
            $res=$this->subscription_model->add_transection($new_data);
            
            
            if($res['status']==TRUE){
                $data=  site_data();
                $data['_page_title']="Membership Receipt";
                $data['_record']=$this->subscription_model->get_print_receipt($res['new_id']);                                
                $this->template->front_campaign_visit_receipt($data);  
                
            }else{
                
            }            
            
        }else{
            //user not logged in
            //FRONT END LOGIN
            redirect('login');
            
        }//end else
        
        
    }//end function
    
}//end class