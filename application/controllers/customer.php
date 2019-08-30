<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
    
    public function __construct()
    {
            parent::__construct();
            
            if(($this->session->userdata('is_logged_in')==TRUE) ||
                ($this->session->userdata('is_front_logged_in')==TRUE))
            {
                $this->load->library('template');                                
            }else{                
                redirect('login');                
            }                     
            no_cache();

    }//end constractor
    
    
    public function index()
    {
        if($this->session->userdata('is_logged_in')==TRUE){

            $data=  site_data();

          //Load pagination library
            $this->load->library('pagination');

            //set pagination configuration
            $config=  getPaginationConfig();//this function is from helpers/ahb_helper.php file
            $config['base_url'] = base_url().'customer/index';
            $this->load->model('customer_model');    

            $config['total_rows'] = $this->customer_model->getTotalNum();        
            $config['use_page_numbers']=true;
            $config['per_page'] = 20;
            $config['num_links'] = 5;        
            $config['uri_segment'] = 3;                        
            $this->pagination->initialize($config);


            $data['_total_rows']=$config['total_rows'];

            if($this->uri->segment(3)!=''){

                $last=$this->uri->segment(3)*$config['per_page']>$config['total_rows']?$config['total_rows']:$this->uri->segment(3)*$config['per_page'];

                $data['_pagi_msg']=  (($this->uri->segment(3)-1)*($config['per_page']+1)).' - '.$last;            

                $data['_list']=$this->customer_model->getList($config['per_page'],($config['per_page']*($this->uri->segment(3)-1)));
            }else{                
                if($config['total_rows']>$config['per_page']){                    
                    $last=$config['per_page'];      
                }else{                    
                    $last=$config['total_rows'];      
                }

              $data['_pagi_msg'] = '1 - '.$last;              

              $data['_list']=$this->customer_model->getList($config['per_page'],$this->uri->segment(3));
            }

            $data['_page_title']='Customer';
            $this->template->customer_index($data);                
        
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
        
    }//end index
    
    public function search(){
        
        if($this->session->userdata('is_logged_in')==TRUE){
            
            $keyword    = $this->input->get('s');
            $search_by  = $this->input->get('by');
            
            $data=  site_data();

          //Load pagination library
            $this->load->library('pagination');

            //set pagination configuration
            $config=  getPaginationConfig();//this function is from helpers/ahb_helper.php file
            
            $config['base_url'] = base_url().'customer/search?by='.$search_by.'&s='.$keyword;
            $this->load->model('customer_model');    

            $config['total_rows'] = $this->customer_model->getTotalSearchNum($keyword,$search_by);//total search result        
            $config['use_page_numbers']=true;
            $config['per_page'] = 20;
            $config['num_links'] = 5;        
            $config['uri_segment'] = 3;                        
            $config['page_query_string'] = TRUE;
            $this->pagination->initialize($config);
            
            $_page=$this->input->get('per_page');

            $data['_total_rows']=$config['total_rows'];                        
                        
            $this->load->model('customer_model');    
            
             if($_page!=''){

                $last=$this->uri->segment(3)*$config['per_page']>$config['total_rows']?$config['total_rows']:$_page*$config['per_page'];                              
                $data['_list']= $this->customer_model->search($keyword,$search_by,$config['per_page'],($config['per_page']*($_page-1)));
            }else{                
                if($config['total_rows']>$config['per_page']){                    
                    $last=$config['per_page'];      
                }else{                    
                    $last=$config['total_rows'];      
                }

              $data['_pagi_msg'] = '1 - '.$last;              

              //$data['_list']=$this->customer_model->getList($config['per_page'],$this->uri->segment(3));
              $data['_list']= $this->customer_model->search($keyword,$search_by,$config['per_page'],$_page);
              
            }//end else
                        
            
           $data['_page_title']='Search Result';
           $this->template->customer_index($data);       
              
        }else{            
            redirect('signin');
            
        }//end else
    }//end function
    
    public function add(){
        
        if($this->session->userdata('is_logged_in')==TRUE){
            $data=  site_data();
            $data['_page_title']='Add Customer';
            $data['_action']='add';
            $data['_country']=  getCountry();

            $this->template->customer_add($data);                        
        
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
        
    }//end function
    
    public function edit(){

        if($this->session->userdata('is_logged_in')==TRUE){
        
            $data=  site_data();
            $data['_page_title']='Edit Customer';
            $data['_action']='update';
            $data['_sn']=$this->uri->segment(3);

            $this->load->model('customer_model');
            $data['_record']=$this->customer_model->getRecord($data['_sn']);
            $data['_card_ids']=$this->customer_model->getCardListByCustomer($data['_sn']);
            //$data['_country']=  getCountry();

            $this->load->model('subscription_model');
            $data['_subscribe']=$this->subscription_model->getUnsubscribedCampaigns($data['_sn']);
            $data['_cust_campaign']=$this->subscription_model->getSubscriptionHistory($data['_sn']);
//

            $data['_visit_subs']=$this->subscription_model->getCustomerSubscriptions($data['_sn'],'visit');
            $data['_session_subs']=$this->subscription_model->getCustomerSubscriptions($data['_sn'],'session');
            $data['_gift_subs']=$this->subscription_model->getCustomerSubscriptions($data['_sn'],'giftcard');


			$data['_tmp_history']	= $this->subscription_model->getSubscriptionTrashHistory($data['_sn']);

//            $data['_country']=  getCountry();


            $this->template->customer_edit($data);
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
    }//end function
    
    
    public function view_transactions(){
        
        if($this->session->userdata('is_logged_in')==TRUE){
            
            $data=  site_data();
            $data['_page_title']='View Customer Transactions';
            $data['_sn']=$this->uri->segment(3);            
            $data['_subs_sn']=$this->uri->segment(4);
            //print_r($data);
            //exit();
            
            $this->load->model('subscription_model');
            $data['_record']=$this->subscription_model->getCustomerCampaignDetails($data['_sn'],$data['_subs_sn']);
            
            //$subs_sn=$data['_record'][0]['subs_sn'];
            
            //$data['_session_subs']=$this->subscription_model->getCustomerSubscriptions($data['_sn'],'session');
            //$data['_gift_subs']=$this->subscription_model->getCustomerSubscriptions($data['_sn'],'giftcard');
            
            $data['_transections']=$this->subscription_model->getCustomerTransections($data['_subs_sn']);
            

            $this->template->customer_transactions($data);   
            
            
        }else{
            
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }
        
        
    }//end function


    public function details(){
        
        if($this->session->userdata('is_logged_in')==TRUE){
 
            $data=  site_data();                        
            $data['_page_title']='Customer Details';
            
            
            $data['_sn']=$this->uri->segment(3);
            $this->load->model('customer_model');
            $data['_record']=$this->customer_model->getRecord($data['_sn']);
            $data['_card_ids']=$this->customer_model->getCardListByCustomer($data['_sn']);

			/**
			 * Issue: http://pm.appiolab.com/issues/54
			 */
			$data['_history'] = $this->customer_model->getHistory($data['_sn']);


			/**
			 * Issue: http://pm.appiolab.com/issues/56
			 */
			$data['_card_ids']=$this->customer_model->getCardListByCustomer($data['_sn']);


			$this->load->model('subscription_model');
            $data['_visit_subs']=$this->subscription_model->getCustomerSubscriptions($data['_sn'],'visit');
            $data['_session_subs']=$this->subscription_model->getCustomerSubscriptions($data['_sn'],'session');
            $data['_gift_subs']=$this->subscription_model->getCustomerSubscriptions($data['_sn'],'giftcard');

            $data['_request_history']=$this->subscription_model->getSubscriptionRequestHistory($data['_sn']);

//            echo  '<pre>';
//            var_dump($data['_request_history']);
//            exit();
            
            $data['_country']=  getCountry();


            $this->template->customer_view($data);  
            
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
    }//end function
    
    public function details_campaign(){
        
        if($this->session->userdata('is_logged_in')==TRUE){
 
            $data=  site_data();
            $data['_page_title']='Customer Details Campaign';
            $data['_sn']=$this->uri->segment(3);
            //$data['_cmpn_sn']=$this->uri->segment(4);
            $data['_subs_sn']=$this->uri->segment(4);
                        
            
            $this->load->model('subscription_model');
            $data['_record']=$this->subscription_model->getCustomerCampaignDetails($data['_sn'],$data['_subs_sn']);

            $subs_sn=$data['_record'][0]['subs_sn'];
            
            $data['_session_subs']=$this->subscription_model->getCustomerSubscriptions($data['_sn'],'session', $data['_subs_sn']);
            $data['_gift_subs']=$this->subscription_model->getCustomerSubscriptions($data['_sn'],'giftcard', $data['_subs_sn']);
            $data['_transections']=$this->subscription_model->getCustomerTransections($data['_subs_sn']);

            $this->template->customer_campaign($data);   
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
    }//end function details_campaign
    
    public function save(){
        
        if($this->session->userdata('is_logged_in')==TRUE){
            
        $this->load->library('form_validation');
        
        $_action = $this->input->post('_action');                
        
        /**
         * IF Customer id is provided, than validate add/update the Customer ID
         */
        $_cust_id            =$this->input->post('inputIDNumber');                
        if($_cust_id!=''){            
            $this->form_validation->set_rules('inputIDNumber', 'ID Number',     'trim|max_length[255]|xss_clean|is_unique[avcd_customer.cust_id]');
            $data['cust_id']            =$this->input->post('inputIDNumber');
        }

        $this->form_validation->set_rules('inputFirstName', 'First Name',   'trim|required|max_length[50]|xss_clean');
        //$this->form_validation->set_rules('inputLastName', 'Last Name',     'trim|required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('inputMobileNo', 'Mobile No',     'trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('inputPhoneNumber', 'Phone Number', 'trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('inputEmail', 'Email',            'trim|max_length[50]|valid_email|xss_clean');
        $this->form_validation->set_rules('inputBirthday', 'Date of Birth', 'trim|max_length[12]|xss_clean');//BIRTHDATE
        $this->form_validation->set_rules('inputAddress', 'Address Line 1', 'trim|max_length[255]|xss_clean');
        $this->form_validation->set_rules('inputAddress2', 'Address Line 2', 'trim|max_length[255]|xss_clean');
        $this->form_validation->set_rules('inputCity', 'City',              'trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('inputZipcode', 'Zip',            'trim|max_length[20]|xss_clean');
        $this->form_validation->set_rules('inputCountry', 'Country',        'trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('inputCarNumber', 'Car Number',   'trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('inputCarModel', 'Car Model',     'trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('inputCarColor', 'Car Color',     'trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('inputAdditionalInfo', 'Additional Info', 'trim|max_length[3000]|xss_clean');
        
        
        $data['cust_first_name']    =$this->input->post('inputFirstName');
        //$data['cust_last_name']     =$this->input->post('inputLastName');
        $data['cust_mobile']        =$this->input->post('inputMobileNo');
        $data['cust_phone']         =$this->input->post('inputPhoneNumber');
        $data['cust_email']         =$this->input->post('inputEmail');
        //$data['cust_dob']           = date('Y-m-d', strtotime($this->input->post('inputBirthday',TRUE)));
                
        if($this->input->post('inputBirthday',TRUE)!=''){
             
            $data['cust_dob']           = date('Y-m-d', strtotime(convertMyDate($this->input->post('inputBirthday',TRUE))));
        }else{
            $data['cust_dob']           =NULL;
        }
        
        $data['cust_address_line1'] =$this->input->post('inputAddress');
        $data['cust_address_line2'] =$this->input->post('inputAddress2');
        //$data['cust_city']           =$this->input->post('inputCity');
        $data['cust_zip']           =$this->input->post('inputZipcode');
        $data['cust_country']       =$this->input->post('inputCountry');
        $data['cust_car_no']        =$this->input->post('inputCarNumber');
        $data['cust_car_model']     =$this->input->post('inputCarModel');
        $data['cust_car_color']     =$this->input->post('inputCarColor');
        $data['cust_additional']    =$this->input->post('inputAdditionalInfo');
        
        $this->load->model('customer_model');
        
        if($_action=='add'){         
                        
            $this->form_validation->set_rules('inputCardID', 'Card ID', 'trim|required|max_length[255]|xss_clean|callback_cardid_check['.$this->input->post('inputCardID').']');            
            $data['cust_card_id']       =$this->input->post('inputCardID');
            $data['date_added']         = date("Y-m-d H:i:s");        
                        
            
        }//end if
        
        if ($this->form_validation->run() == true)
        {             
            $res=false;
            
            if($_action=='add'){
                $res= $this->customer_model->insert($data);    
                if($res['status']==TRUE){
                    $_engine=$this->input->post('_engine');
                    if($_engine=='frontend'){
                        redirect('home');  
                    }else{
                        redirect('customer/details/'.$res['new_id']);  
                    }
                    
                }else{
                    //show error message
                }
            }else{
                $id=$this->input->post('_sn');
                $res=$this->customer_model->update($data,$id);                   
                if($res==TRUE){
                    redirect('customer/details/'.$id);  
                }else{
                    //show error message
                }
            }//end else
            
        }//end if
        else{
            
            //echo validation_errors();
            //exit();
             $data=  site_data();
             
            //echo 'error: '.  validation_errors();
            $data['_error']=  validation_errors();                    
            $data['_record'][0]['cust_card_id']=$this->input->post('inputCardID');
            $data['_record'][0]['cust_id']=$this->input->post('inputIDNumber');
            $data['_record'][0]['cust_first_name']=$this->input->post('inputFirstName');
            $data['_record'][0]['cust_last_name']=$this->input->post('inputLastName');
            $data['_record'][0]['cust_mobile']=$this->input->post('inputMobileNo');
            $data['_record'][0]['cust_phone']=$this->input->post('inputPhoneNumber');
            $data['_record'][0]['cust_email']=$this->input->post('inputEmail');
            $data['_record'][0]['cust_dob']=$this->input->post('inputBirthday');
            $data['_record'][0]['cust_address_line1']=$this->input->post('inputAddress');
            
            $data['_record'][0]['cust_dob']=$this->input->post('inputBirthday');
            
            $data['_record'][0]['cust_address_line2']=$this->input->post('inputAddress2');
            $data['_record'][0]['cust_city']=$this->input->post('inputCity');
            $data['_record'][0]['cust_zip']=$this->input->post('inputZipcode');
            $data['_record'][0]['cust_country']=$this->input->post('inputCountry');
            $data['_record'][0]['cust_car_no']=$this->input->post('inputCarNumber');
            $data['_record'][0]['cust_car_model']=$this->input->post('inputCarModel');
            $data['_record'][0]['cust_car_color']=$this->input->post('inputCarColor');
            $data['_record'][0]['cust_additional']=$this->input->post('inputAdditionalInfo');            
            
            $_action=$this->input->post('_action');
            
            if($_action=='add'){
                $data['_page_title']='Add Customer';
                $data['_action']='add';                                
                $data['_country']=  getCountry();
                $this->template->customer_add($data);  
            }else{
                
                $data['_sn']=$this->input->post('_sn');
                
                $data['_page_title']='Update Customer';
                $data['_action']='update';                                
                $data['_country']=  getCountry();
                $this->template->customer_add($data);  
            }
            
        }//end else        
        
        
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
        
    }//end function
    
    public function delete(){
        if($this->session->userdata('is_logged_in')==TRUE){
        
            $data['_sn']=$this->input->post('_sn');        
            $this->load->model('customer_model');
            $res= $this->customer_model->delete($data['_sn']);

            echo $res;
        
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
    }//end function
    
    public function subscribe_campaign(){
        
        if($this->session->userdata('is_logged_in')==TRUE){

            $data['cmpn_sn']=$this->input->post('_cmpn_sn');        
            $data['cust_sn']=$this->input->post('_cust_sn');        
            $date = new DateTime();        
            $data['subs_date']=$date->format("Y-m-d");
            $data['expire_date']=$this->input->post('_expire');
            
            $data['req_date']=$date->format("Y-m-d H:i:s");
            //print_r($data);
            $this->load->model('subscription_model');
            $res= $this->subscription_model->insert($data);

            echo $res;
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
    }//end function
    
    public function unsubscribe(){
        
        $_cmpn_sn   = $this->input->post('_cmpn_sn');
        $_cust_sn   = $this->input->post('_cust_sn');
        $subs_sn    = $this->input->post('subscription_sn');
        
        $this->load->model('subscription_model');        
        $res=$this->subscription_model->unsubscribe($_cust_sn, $_cmpn_sn, $subs_sn);
        
        echo $res;
        
        
    }//end function

    /**
     * CALL FROM transection.js
     * 
     * PAGE REF: customer/details_campaign/cust_sn/subs_sn
     * 
     */
    public function addTransection(){                
    
        //FRONT END 
        //OR 
        //BACK END
        
        //&_from=backend
        
        $from          = $this->input->post('_from');
        
        $data['subs_sn']=$this->input->post('_subs_sn');
        $date = new DateTime();        
        $data['trn_date']=$date->format("Y-m-d H:i:s");        
        
        //must specify front end or backend user making the request
        if($from=='backend'){
            //if from backend, user_sn=backend user sn
            $data['user_sn']=$this->session->userdata('user_sn');   
        }else{
            //else front end user sn
            $data['user_sn']=$this->session->userdata('user_sn');   
        }
        
        $data['tran_activity']='Check In';        
        $data['tran_value']=$this->input->post('_value');
        $data['tran_type']=$this->input->post('_tran_type');
        
        if($data['tran_type']=='add'){
            $data['tran_activity']='Added '.$data['tran_value'];                    
        }else{
            $data['tran_activity']='Deducted '.$data['tran_value'];        
        }                        
        $data['tran_description']='Transaction in Backend';
        
        $this->load->model('subscription_model');        
        $res=$this->subscription_model->add_transection($data);
                
        echo $res['balance'];
                
    }//end function
    
    public function deleteTransection(){

        if($this->session->userdata('is_logged_in')==TRUE){        
        
            $trn_sn=$this->input->post('_sn');
            
            $this->load->model('subscription_model');        
            $res=$this->subscription_model->remove_transection($trn_sn);
        
            echo $res;            
            exit();
        }else{
            //user not logged in
            //FRONT END LOGIN
            redirect('login');
            
        }//end else
        
    }//end function deleteTransection
    
    /**
     * USED IN /home/ -> scan card function
     * 
     */
    public function campaign_list(){
        
        if($this->session->userdata('is_front_logged_in')==TRUE){
            
            $data=  site_data();
            $data['_page_title']='Customer Campaign List';
            $cust_id=$this->input->post('customer_card_id');
            
            if($cust_id!=''){

                $this->load->library('form_validation');
                        
                $this->form_validation->set_rules('customer_card_id', 'This card is suspended, Pls approach management',
                        'trim|max_length[255]|xss_clean|is_unique[avcd_card_block.card_id]');
                                        
                if ($this->form_validation->run() == true)
                {
                    //proceed
                    $this->load->model('customer_model');
                    $data['_cl']=$this->customer_model->getCampaignlist($cust_id);
                    
                    if(count($data['_cl'])>0){                        
                        $this->template->front_campaign_list($data);      
                    }else{
                        
                        //$this->session->set_flashdata('item');
                        $this->session->set_flashdata('_error',TRUE);
                        redirect('home');
                    }                
                    
                }else{
                    //error
                    $this->session->set_flashdata('_card_suspended',  validation_errors());
                    redirect('home');
                }                      
                
            }else{
                //echo 'Customer ID NOT FOUND';
                 redirect('home');
            }
   
                                  
        }else{
            //user not logged in
            //FRONT END LOGIN
            redirect('login');
            
        }//end else
        
    }//end function
    
    public function campaign_visit_activate(){
        
        if($this->session->userdata('is_front_logged_in')==TRUE){
            
            $data=  site_data();
            $data['subs_sn']        = $this->input->post('subs_sn');
            $data['cmpn_sn']        = $this->input->post('cmpn_sn');
            $data['cmpn_type']      = $this->input->post('cmpn_type');
            $data['cmpn_name']      = $this->input->post('cmpn_name');
            $data['cust_sn']        = $this->input->post('cust_sn');
            $data['cust_name']      = $this->input->post('cust_name');
            $data['cust_card_no']   = $this->input->post('cust_card_no');
            $data['cust_car_no']    = $this->input->post('cust_car_no');            
            $data['cust_balance']    = $this->input->post('balance');            
            $data['cmpn_visit_active_button']= $this->input->post('cmpn_visit_active_button');
                        
            $this->load->model('subscription_model');                        
            $is_expired=$this->subscription_model->hasExpired($data['cust_sn'],$data['cmpn_sn']);
            if($is_expired==1){
                //error message subscription_expired
                $this->template->front_subscription_expired($data);  
            }else{
                $this->template->front_campaign_activate_visit($data);  
            }                     
            
            
        }else{
            //user not logged in
            //FRONT END LOGIN
            redirect('login');
            
        }//end else
    }//end function
    
    
    
    public function campaign_sessions_redeem(){
        
        if($this->session->userdata('is_front_logged_in')==TRUE){
            
            //echo 'COUNT: '.count($_POST);
            //exit();
            //$this->load->library('validation');
            //$this->load->library('form_validation');

            $data=  site_data();
            $data['subs_sn']        = $this->input->post('subs_sn');
            $data['cmpn_sn']        = $this->input->post('cmpn_sn');
            $data['cmpn_type']      = $this->input->post('cmpn_type');
            $data['cmpn_name']      = $this->input->post('cmpn_name');
            $data['cust_sn']        = $this->input->post('cust_sn');
            $data['cust_name']      = $this->input->post('cust_name');
            $data['cust_card_no']   = $this->input->post('cust_card_no');
            $data['cust_car_no']    = $this->input->post('cust_car_no');            
            $data['cust_balance']    = $this->input->post('balance');            
            $this->load->model('subscription_model');            
            $is_expired=$this->subscription_model->hasExpired($data['cust_sn'],$data['cmpn_sn']);            
            if($is_expired==1){                
                $this->template->front_subscription_expired($data);  
            }else{

                $this->load->model('campaign_model');            
                $data['_sessions']=$this->campaign_model->getSessionRecord($data['cmpn_sn']);                        
                $this->template->front_campaign_session_redeem($data); 
            }

            
        } else{
             redirect('login');
            
        }
        
    }//end function
    
    
    
    public function campaign_giftcard(){
        
        if($this->session->userdata('is_front_logged_in')==TRUE){
            $data=  site_data();
            $data['_page_title']='Gift Card Campaign';
            $data['subs_sn']        = $this->input->post('subs_sn');
            $data['cmpn_sn']        = $this->input->post('cmpn_sn');
            $data['cmpn_type']      = $this->input->post('cmpn_type');
            $data['cmpn_name']      = $this->input->post('cmpn_name');
            $data['cust_sn']        = $this->input->post('cust_sn');
            $data['cust_name']      = $this->input->post('cust_name');
            $data['cust_card_no']   = $this->input->post('cust_card_no');
            $data['cust_car_no']    = $this->input->post('cust_car_no');            
            $data['cust_balance']    = $this->input->post('balance');            
            
            $this->load->model('subscription_model');                                                                        
            $is_expired=$this->subscription_model->hasExpired($data['cust_sn'],$data['cmpn_sn']);
            
            if($is_expired==1){
                
                $this->template->front_subscription_expired($data);  
            }else{
               $data['_cust_balance']      =$this->subscription_model->getCurrentBalance($data['cust_sn'],$data['cmpn_sn']);                                                            
              $this->template->front_campaign_giftcard($data); 
            }                     
                                  
        }else{
             redirect('login');
            
        }
        
    }//end function
    
    public function confirmation(){
        
        
        $data=  site_data();
        $data['_page_title']='Confirmation';
        
        $this->load->model('campaign_model');
        $data['_campaigns']=$this->campaign_model->getAllRecords();
        
        $is_existing=$this->session->flashdata('_existing');
        
        if($is_existing==true){
            //echo 'existing true';
            
            $cust=$this->session->flashdata('_customer');
            //print_r($cust);
            $data['_action']            = 'update';

            $data['cust_id']            = $cust[0]['cust_id'];
            $data['cust_sn']            = $cust[0]['cust_sn'];
            $data['cust_card_id']       = $cust[0]['cust_card_id'];


            $data['cust_first_name']    = $cust[0]['cust_first_name'];
            $data['cust_mobile']        = $cust[0]['cust_mobile'];
            $data['cust_phone']         = $cust[0]['cust_phone'];
            $data['cust_email']         = $cust[0]['cust_email'];
            if($cust[0]['cust_dob']!=''){
                $data['cust_dob']           = $cust[0]['cust_dob'];
            }else{
                $data['cust_dob']           ='';
            }
            $data['cust_address_line1'] = $cust[0]['cust_address_line1'];
            $data['cust_address_line2'] = $cust[0]['cust_address_line2'];
            //$data['cust_city']          = $cust[0]['cust_city'];
            $data['cust_zip']           = $cust[0]['cust_zip'];
            $data['cust_country']       = $cust[0]['cust_country'];
            $data['cust_car_no']        = $cust[0]['cust_car_no'];
            $data['cust_car_model']     = $cust[0]['cust_car_model'];
            $data['cust_car_color']     = $cust[0]['cust_car_color'];
            $data['cust_additional']    = $cust[0]['cust_additional'];
           //echo '<pre>' ;
            //print_r($data);
           // echo '</pre>' ;
            
        }
        else{                    
            
            //CARD ID           /cust_card_id
            //CARD ID NUMBER    /cust_id

            $this->load->library('form_validation');        
            $this->form_validation->set_rules('inputIDNumber', 'ID Number', 'trim|required|is_unique[avcd_customer.cust_id]|xss_clean');        
            $this->form_validation->set_rules('inputCardID', 'Card ID', 'trim|required|is_unique[avcd_customer.cust_card_id]|xss_clean');                    
            
            if ($this->form_validation->run() == FALSE)
            {
                    //'ERROR: <BR>';
                    //echo validation_errors();                    
                    $this->session->set_flashdata('errors', validation_errors());
                    $_record[0]['cust_card_id']=$this->input->post('inputCardID');
                    $_record[0]['cust_id']=$this->input->post('inputIDNumber');
                    
                    $_record[0]['cust_first_name']  =$this->input->post('inputFirstName');        
                    $_record[0]['cust_mobile']  =$this->input->post('inputMobileNo');
                    $_record[0]['cust_phone']  =$this->input->post('inputPhoneNumber');
                    $_record[0]['cust_email']  =$this->input->post('inputEmail');
                    $_record[0]['cust_dob']  =$this->input->post('inputBirthday');
                    
                    $_record[0]['cust_address_line1'] =$this->input->post('inputAddress');
                    $_record[0]['cust_address_line2'] =$this->input->post('inputAddress2');
            
                    $_record[0]['cust_zip']           =$this->input->post('inputZipcode');
                    $_record[0]['cust_country']       =$this->input->post('inputCountry');
                    $_record[0]['cust_car_no']        =$this->input->post('inputCarNumber');
                    $_record[0]['cust_car_model']     =$this->input->post('inputCarModel');
                    $_record[0]['cust_car_color']     =$this->input->post('inputCarColor');
                    
                    
                    $this->session->set_flashdata('errors', validation_errors());
                    $this->session->set_flashdata('_record', $_record);
                    redirect('home/addCustomer');
            }
            
            $data['_action']            =$this->input->post('_action');
            $data['cust_id']            =$this->input->post('inputIDNumber');               

            $data['cust_card_id']       =$this->input->post('inputCardID');
            $data['cust_first_name']    =$this->input->post('inputFirstName');        
            $data['cust_mobile']        =$this->input->post('inputMobileNo');
            $data['cust_phone']         =$this->input->post('inputPhoneNumber');
            $data['cust_email']         =$this->input->post('inputEmail');
            if($this->input->post('inputBirthday',TRUE)!=''){
                $data['cust_dob']           = date('Y-m-d', strtotime(convertMyDate($this->input->post('inputBirthday',TRUE))));        
            }else{
                $data['cust_dob']           ='';
            }
            $data['cust_address_line1'] =$this->input->post('inputAddress');
            $data['cust_address_line2'] =$this->input->post('inputAddress2');
            //$data['cust_city']          =$this->input->post('inputCity');
            $data['cust_zip']           =$this->input->post('inputZipcode');
            $data['cust_country']       =$this->input->post('inputCountry');
            $data['cust_car_no']        =$this->input->post('inputCarNumber');
            $data['cust_car_model']     =$this->input->post('inputCarModel');
            $data['cust_car_color']     =$this->input->post('inputCarColor');
            
        }//end else
       
        
        
        $this->template->customer_confirm($data); 
        
    }//end if
    
    public function confirm_final_control(){                
        
        $_action    = $this->input->post('_action');                
        
        
        if($this->input->post('save')){
        
            
            /**
             * IF Customer id is provided, than validate add/update the Customer ID
             */

            $_cust_id            =$this->input->post('inputIDNumber');                
            if($_cust_id!=''){             
                $data['inputIDNumber']            =$this->input->post('inputIDNumber');
            }
            $data['inputCardID']            = $this->input->post('inputCardID');
            $data['_action']                = $this->input->post('_action');
            $data['inputFirstName']         = $this->input->post('inputFirstName');        
            $data['inputMobileNo']          = $this->input->post('inputMobileNo');
            $data['inputPhoneNumber']       = $this->input->post('inputPhoneNumber');
            $data['inputEmail']             = $this->input->post('inputEmail');

            if($this->input->post('inputBirthday',TRUE)!=''){
            $data['inputBirthday']           = $this->input->post('inputBirthday',TRUE);//date('Y-m-d', strtotime($this->input->post('inputBirthday',TRUE)));
            }else{
            $data['inputBirthday']          = '';
            }

            $data['inputAddress']           = $this->input->post('inputAddress');
            $data['inputAddress2']          = $this->input->post('inputAddress2');
            $data['inputCity']              = $this->input->post('inputCity');
            $data['inputZipcode']           = $this->input->post('inputZipcode');
            $data['inputCountry']           = $this->input->post('inputCountry');
            $data['inputCarNumber']         = $this->input->post('inputCarNumber');
            $data['inputCarModel']          = $this->input->post('inputCarModel');
            $data['inputCarColor']          = $this->input->post('inputCarColor');

            $data['inputplan']              = $this->input->post('inputplan');       //cmpn_sn

            $data['new_start_date']         = $this->input->post('new_start_date');
            $data['inputType']              = $this->input->post('inputType');
            $data['new_expire_date']        = $this->input->post('new_expire_date');
                        
            $data['inputDuration']        	= $this->input->post('inputDuration');
            
            $data['inputNumberOfSessions']  = $this->input->post('inputNumberOfSessions');
            $data['inputNewBalance']        = $this->input->post('inputNewBalance');        
            $data['user_sn']                = $this->session->userdata('user_sn'); 

            $data['inputBillNo']            = $this->input->post('inputBillNo');
            $data['inputBillAmount']        = $this->input->post('inputBillAmount');

            $data['inputCarNumber']         = $this->input->post('inputCarNumber');
            $data['inputCarColor']          = $this->input->post('inputCarColor');
            $data['inputCarModel']          = $this->input->post('inputCarModel');
            $data['inputAdditionalInfo']    = $this->input->post('inputAdditionalInfo');                

            $data['inputNumberOfRedemption'] = $this->input->post('inputNumberOfRedemption');
            $data['inputOldCardBalance']     = $this->input->post('inputOldCardBalance');
            $data['inputcustsn']             = $this->input->post('inputcustsn');

            
            if($_action=='update'){
                //echo 'call existing';                
                $this->save_front_existing($data);
            }else{                
                //echo 'call add new';
                $this->save_front($data);
            }//end action
            
        }///end save
        
        if($this->input->post('back')){
            
            //PREPARE FOR BACK TO confirmation
            
            $data['_action']            = $this->input->post('_action');
            $data['cust_id']            = $this->input->post('inputIDNumber');
            
            $data['cust_sn']            = $this->input->post('inputcustsn');
            $data['cust_card_id']       = $this->input->post('inputCardID');
            $data['cust_first_name']    = $this->input->post('inputFirstName'); 
            $data['cust_mobile']        = $this->input->post('inputMobileNo');
            $data['cust_phone']         = $this->input->post('inputPhoneNumber');
            $data['cust_email']         = $this->input->post('inputEmail');
            if($this->input->post('inputBirthday',TRUE)!=''){
                $data['cust_dob']           = $this->input->post('inputBirthday',TRUE);;
            }else{
                $data['cust_dob']           ='';
            }
            $data['cust_address_line1'] = $this->input->post('inputAddress');
            $data['cust_address_line2'] = $this->input->post('inputAddress2');
            //$data['cust_city']          = $this->input->post('inputCity');
            $data['cust_zip']           = $this->input->post('inputZipcode');
            $data['cust_country']       = $this->input->post('inputCountry');
            $data['cust_car_no']        = $this->input->post('inputCarNumber');
            $data['cust_car_model']     = $this->input->post('inputCarModel');
            $data['cust_car_color']     = $this->input->post('inputCarColor');
            
            $data['cust_additional']    = $this->input->post('inputAdditionalInfo');
            
            //ADD SUBSCRIBE DATA
            
            $data['subs_cmpn_sn']          = $this->input->post('inputplan');       //cmpn_sn
            $data['subs_type']             = $this->input->post('inputType');
            $data['subs_new_start_date']   = $this->input->post('new_start_date');
            $data['subs_new_expire_date']  = $this->input->post('new_expire_date');
            $data['subs_OldCardBalance']   = $this->input->post('inputOldCardBalance');
            $data['subs_NumberOfRedemption'] = $this->input->post('inputNumberOfRedemption');
            $data['subs_NumberOfSessions'] = $this->input->post('inputNumberOfSessions');            
            $data['subs_NewBalance']       = $this->input->post('inputNewBalance'); 
            $data['subs_BillNo']           = $this->input->post('inputBillNo');
            $data['subs_BillAmount']       = $this->input->post('inputBillAmount');
                                               
            $this->session->set_flashdata('_existing',TRUE);
            $this->session->set_flashdata('_isback',TRUE);
            $this->session->set_flashdata('_customer',$data);
            
            redirect('customer/confirmation');
            
            
        }//end back
        
        
        
    }//end functioin

    public function confirm_final(){
    
        
        $data=  site_data();
        $data['_page_title']='Final Confirmation';
        
            $this->load->model('campaign_model');
            $data['_campaigns']=$this->campaign_model->getAllRecords();
            
            $data['_record'][0]['_action']            =$this->input->post('_action'); 
            
            
            //PLAN
            $data['_record'][0]['_cmpn_sn']=$this->input->post('inputplan');
            $data['_record'][0]['_type']=$this->input->post('inputType');                        
            $data['_record'][0]['_subs_start_date'] = convertMyDate($this->input->post('new_start_date',TRUE));
            $data['_record'][0]['_subs_expire_date']=$this->input->post('new_expire_date');            
            
            $data['_record'][0]['_subs_num_of_months']=$this->input->post('inputNumberOfMonths');            
            
            $data['_record'][0]['_old_card_balance']=$this->input->post('inputOldCardBalance');
            $data['_record'][0]['_total_redemption']=$this->input->post('inputNumberOfRedemption');
            $data['_record'][0]['_number_of_amount']=$this->input->post('inputNumberOfSessions');
            $data['_record'][0]['_new_balance']=$this->input->post('inputNewBalance');
            $data['_record'][0]['_bill_no']=$this->input->post('inputBillNo');
            $data['_record'][0]['_bill_amount']=$this->input->post('inputBillAmount');
            
            
            //CUSTOMER
            if($data['_record'][0]['_action']=='update'){
                $data['_record'][0]['cust_sn']            =$this->input->post('inputcustsn');                   
            }
            $data['_record'][0]['cust_id']            =$this->input->post('inputIDNumber');               
            $data['_record'][0]['cust_card_id']       =$this->input->post('inputCardID');

            $data['_record'][0]['cust_first_name']    =$this->input->post('inputFirstName');        
            $data['_record'][0]['cust_mobile']        =$this->input->post('inputMobileNo');
            $data['_record'][0]['cust_phone']         =$this->input->post('inputPhoneNumber');
            $data['_record'][0]['cust_email']         =$this->input->post('inputEmail');
            if($this->input->post('inputBirthday',TRUE)!=''){
                //$data['cust_dob']           = date('Y-m-d', strtotime(convertMyDate($this->input->post('inputBirthday',TRUE))));        
                $data['_record'][0]['cust_dob']           = $this->input->post('inputBirthday',TRUE);        
            }else{
                $data['_record'][0]['cust_dob']           ='';
            }
            $data['_record'][0]['cust_address_line1'] =$this->input->post('inputAddress');
            $data['_record'][0]['cust_address_line2'] =$this->input->post('inputAddress2');
            $data['_record'][0]['cust_city']          =$this->input->post('inputCity');
            $data['_record'][0]['cust_zip']           =$this->input->post('inputZipcode');
            $data['_record'][0]['cust_country']       =$this->input->post('inputCountry');
            $data['_record'][0]['cust_car_no']        =$this->input->post('inputCarNumber');
            $data['_record'][0]['cust_car_model']     =$this->input->post('inputCarModel');
            $data['_record'][0]['cust_car_color']     =$this->input->post('inputCarColor');
            $data['_record'][0]['additional_info']     =$this->input->post('inputAdditionalInfo');
        
        $this->template->customer_confirm_final($data); 
        
        
        
        
        
    }//end function confirm_final


    private function save_front($mypost){
        
        //print_r($mypost);
        
        $_action = $mypost['_action'];//$this->input->post('_action');                
        
        /**
         * IF Customer id is provided, than validate add/update the Customer ID
         */
        $_cust_id            = $mypost['inputIDNumber'];//$this->input->post('inputIDNumber');                
        if($_cust_id!=''){                        
            $data['cust_id']            = $mypost['inputIDNumber'];//$this->input->post('inputIDNumber');
        }
        
        $data['cust_first_name']    = $mypost['inputFirstName'];//$this->input->post('inputFirstName');        
        $data['cust_mobile']        = $mypost['inputMobileNo'];// $this->input->post('inputMobileNo');
        $data['cust_phone']         = $mypost['inputPhoneNumber'];//$this->input->post('inputPhoneNumber');
        $data['cust_email']         = $mypost['inputEmail'];//$this->input->post('inputEmail');                
        $data['cust_dob']           = $mypost['inputBirthday'];//$this->input->post('inputBirthday',TRUE);//date('Y-m-d', strtotime($this->input->post('inputBirthday',TRUE)));                
        $data['cust_address_line1'] = $mypost['inputAddress'];//$this->input->post('inputAddress');
        $data['cust_address_line2'] = $mypost['inputAddress2'];//$this->input->post('inputAddress2');       
        $data['cust_zip']           = $mypost['inputZipcode'];//$this->input->post('inputZipcode');
        $data['cust_country']       = $mypost['inputCountry'];//$this->input->post('inputCountry');
        $data['cust_car_no']        = $mypost['inputCarNumber'];//$this->input->post('inputCarNumber');
        $data['cust_car_model']     = $mypost['inputCarModel'];//$this->input->post('inputCarModel');
        $data['cust_car_color']     = $mypost['inputCarColor'];//$this->input->post('inputCarColor');

//        Update Card ID if New Customer (action==add)
        if($_action=='add'){                        
            $data['cust_card_id']   = $mypost['inputCardID'];//$this->input->post('inputCardID');
            $data['date_added']     = date("Y-m-d H:i:s");        
        }//end if
        
        $data['cust_additional']     = $mypost['inputAdditionalInfo'];//$this->input->post('inputCarColor');
        
        $subs['cmpn_sn']            = $mypost['inputplan'];//$this->input->post('inputplan');       //cmpn_sn
        
        $subs['subs_date']          = $mypost['new_start_date'];//$this->input->post('new_start_date');
        $subs['subs_type']          = $mypost['inputType'];//$this->input->post('inputType');
        $subs['expire_date']        = $mypost['new_expire_date'];//$this->input->post('new_expire_date');
        
        
        //new
        $subs['num_of_months']      = $mypost['inputDuration'];
        
        $subs['tran_value']         = $mypost['inputNumberOfSessions'];//$this->input->post('inputNumberOfSessions');
        $subs['cust_balance']       = $mypost['inputNewBalance'];//$this->input->post('inputNewBalance');        
        
        $subs['user_sn']            =  $this->session->userdata('user_sn_front'); //updated in 25th May, to make it save by only front end user
        
        $subs['subs_bill_no']       = $mypost['inputBillNo'];//$this->input->post('inputBillNo');
        $subs['subs_bill_amount']   = $mypost['inputBillAmount'];//$this->input->post('inputBillAmount');
        
        $subs['car_number']         = $mypost['inputCarNumber'];//$this->input->post('inputCarNumber');
        $subs['car_color']          = $mypost['inputCarColor'];//$this->input->post('inputCarColor');
        $subs['car_model']          = $mypost['inputCarModel'];//$this->input->post('inputCarModel');
        $subs['remark']             = $mypost['inputAdditionalInfo'];//$this->input->post('inputAdditionalInfo');        
        $subs['status']             = 0;
        $subs['update_date']        = date("Y-m-d H:i:s");
        
        $subs['redemption']         = $mypost['inputNumberOfRedemption'];//$this->input->post('inputNumberOfRedemption');
        $subs['old_balance']        = $mypost['inputOldCardBalance'];//$this->input->post('inputOldCardBalance');
        
        $subs_receipt['redemption'] = $mypost['inputNumberOfRedemption'];//$this->input->post('inputNumberOfRedemption');
        $subs_receipt['old_balance']= $mypost['inputOldCardBalance'];//$this->input->post('inputOldCardBalance');        
        
        
       // $_engine= $mypost['_engine'];//$this->input->post('_engine');
                            
        $res = false;
        $this->load->model('customer_model');

        if($_action=='add'){

            $res = $this->customer_model->insert($data);

            if($res['status']==TRUE){
                //customer added successuflly    

                //Add Temp value which will wait for Approval
                $this->load->model('subscription_model');
                $subs['cust_sn']=$res['new_id'];
                $this->subscription_model->addTempSubscription($subs);
                
                /*  Append Subscriptioin request additional info into customer additional info
                 *  Chagne request 23 May, 2014 by Eric                 *
                 */
                //$res=$this->appendAdditionalCustomerInfo($res['new_id'], $mypost['inputAdditionalInfo']);
                

                //REDIRECT TO customer/subscription_receipt for print
                
                $this->session->set_flashdata('cust',$data);
                $this->session->set_flashdata('subs',$subs);
                $this->session->set_flashdata('subs_res',$subs_receipt);
                $this->session->set_flashdata('user_sn',$subs['user_sn']);
                $this->session->set_flashdata('cmpn_sn',$subs['cmpn_sn']);
                redirect('customer/subscription_receipt');
            }else{
                //show error message
                echo 'ERROR IN private customer->save_front();';
            }//end else

        }//if action==add
                      
                        
    }//end function
    
    /**
     * This function call by front end
     */
    public function subscription_receipt(){
        
        $data=  site_data();
        $data['_page_title']='Subscription Receipt';
        
        
        $data['_record'][0]['cust']=$this->session->flashdata('cust');
        $data['_record'][0]['subs']=$this->session->flashdata('subs');
        $data['_record'][0]['subs_res']=$this->session->flashdata('subs_res');
        
        $this->load->model('user_model');        
        $data['_record'][0]['user']=$this->user_model->getRecord($this->session->flashdata('user_sn'));
        
        $this->load->model('campaign_model');        
        $data['_record'][0]['campaign']=$this->campaign_model->getRecord($this->session->flashdata('cmpn_sn'));
        //cmpn_sn
        $this->template->customer_receipt($data); 
        
    }//end function subscription_receipt
    
    

    private function save_front_existing($mypost){
        
        //print_r($mypost);
        //echo '<br>';
        $_cust_id            =$mypost['inputIDNumber'];//$this->input->post('inputIDNumber');                
        if($_cust_id!=''){ 
            $data['cust_id']        = $mypost['inputIDNumber'];//$this->input->post('inputIDNumber');
        }
        
        $data['cust_first_name']    = $mypost['inputFirstName'];//$this->input->post('inputFirstName');        
        $data['cust_mobile']        = $mypost['inputMobileNo'];//$this->input->post('inputMobileNo');
        $data['cust_phone']         = $mypost['inputPhoneNumber'];//$this->input->post('inputPhoneNumber');
        $data['cust_email']         = $mypost['inputEmail'];//$this->input->post('inputEmail');              
        
        $data['cust_address_line1'] = $mypost['inputAddress'];//$this->input->post('inputAddress');
        $data['cust_address_line2'] = $mypost['inputAddress2'];//$this->input->post('inputAddress2');
       // $data['cust_city']          = $mypost['inputCity'];//$this->input->post('inputCity');
        $data['cust_zip']           = $mypost['inputZipcode'];//$this->input->post('inputZipcode');
        $data['cust_country']       = $mypost['inputCountry'];//$this->input->post('inputCountry');
        $data['cust_car_no']        = $mypost['inputCarNumber'];//$this->input->post('inputCarNumber');
        $data['cust_car_model']     = $mypost['inputCarModel'];//$this->input->post('inputCarModel');
        $data['cust_car_color']     = $mypost['inputCarColor'];//$this->input->post('inputCarColor');
        
        
        $subs['subs_type']          = $mypost['inputType'];//$this->input->post('inputType');
        $subs['cust_sn']            = $mypost['inputcustsn'];//$this->input->post('inputcustsn');//cust sn        
        $subs['subs_date']          = $mypost['new_start_date'];//$this->input->post('new_start_date');
        $subs['cmpn_sn']            = $mypost['inputplan'];//$this->input->post('inputplan');       //cmpn_sn
        
        $subs['expire_date']        = $mypost['new_expire_date'];//$this->input->post('new_expire_date');
        $data['num_of_months']        = $this->input->post('inputDuration');
        $subs['tran_value']         = $mypost['inputNumberOfSessions'];//$this->input->post('inputNumberOfSessions');
        $subs['cust_balance']       = $mypost['inputNewBalance'];//$this->input->post('inputNewBalance');
        
        $subs['user_sn']            = $this->session->userdata('user_sn_front'); 
        $subs['subs_bill_no']       = $mypost['inputBillNo'];//$this->input->post('inputBillNo');
        $subs['subs_bill_amount']   = $mypost['inputBillAmount'];//$this->input->post('inputBillAmount');                
        $subs['car_number']         = $mypost['inputCarNumber'];//$this->input->post('inputCarNumber');
        $subs['car_color']          = $mypost['inputCarColor'];//$this->input->post('inputCarColor');
        $subs['car_model']          = $mypost['inputCarModel'];//$this->input->post('inputCarModel');
        $subs['remark']             = $mypost['inputAdditionalInfo'];//$this->input->post('inputAdditionalInfo');
        $subs['redemption']         = $mypost['inputNumberOfRedemption'];//$this->input->post('inputNumberOfRedemption');
        $subs['num_of_months']      = $mypost['inputDuration'];
        $subs['old_balance']         = $mypost['inputOldCardBalance'];//$this->input->post('inputOldCardBalance');        
        $subs['status']             = 0;
        $subs['update_date']        = date("Y-m-d H:i:s");
        
        $subs_receipt['redemption'] = $mypost['inputNumberOfRedemption'];//$this->input->post('inputNumberOfRedemption');
        $subs_receipt['old_balance']= $mypost['inputOldCardBalance'];//$this->input->post('inputOldCardBalance');


        //Add Temp value which will wait for Approval
        $this->load->model('subscription_model');
        
        $this->subscription_model->addTempSubscription($subs);
        
        $res =$this->appendAdditionalCustomerInfo($mypost['inputcustsn'], $mypost['inputAdditionalInfo']);
        
        //$this->session->set_flashdata('front_save',true);
        //redirect('home');    
        $this->session->set_flashdata('cust',$data);
        $this->session->set_flashdata('subs',$subs);
        $this->session->set_flashdata('subs_res',$subs_receipt);
        $this->session->set_flashdata('user_sn',$subs['user_sn']);
        $this->session->set_flashdata('cmpn_sn',$subs['cmpn_sn']);
        redirect('customer/subscription_receipt');
        
    }//end function

    
    /**
     * Chagne Card ID
     */
    public function changecardid(){
        
        $this->load->library('form_validation');
        
        //$this->form_validation->set_rules('_new_card_id', 'Card ID already exist',     'trim|max_length[255]|xss_clean|is_unique[avcd_customer.cust_card_id]');
        $this->form_validation->set_rules('_new_card_id', 'Card ID already exist',     'trim|max_length[255]|xss_clean|callback_cardid_check['.$this->input->post('_new_card_id').']');
        
        $data['cust_sn']        = $this->input->post('_cust_sn');
        $data['old_card_id']    = $this->input->post('_old_card_id');
        $data['new_card_id']    = $this->input->post('_new_card_id');
        
        if ($this->form_validation->run() == true)
        {
           
            //1. Check if new id is not blocked
            //2. add the new id to customer table
            //3. add the old id to customere id table
            $this->load->model('customer_model');
            if($this->customer_model->isCardBan($data['new_card_id'])==FALSE){
                
                $res=$this->customer_model->changeCardID($data);                            
                echo $res;                
                
            }else{
                //card id is blocked
                echo 'blocked';
            }   
        }
        else{
            //Card ID Already exisit
            echo validation_errors();
        }      
        
    }//end functioin
   
    
    
    public function removecardid(){
        
        $data['cust_sn']        = $this->input->post('_cust_sn');
        $data['card_id']    = $this->input->post('_card_id');
        
        
        $this->load->model('customer_model');
        $res=$this->customer_model->removeCardID($data);
                
        echo $res;
        //json_encode($res);
        
    }//end function
    
    /**
     * CARD ID CHECK
     * 
     * CHECK IF A CARD ID IS BAN OR ALREADY EXIST
     * @param type $cardid
     * @return boolean
     */
    
    public function cardid_check($cardid){
        
        $this->load->model('customer_model');
                
                
        if($this->customer_model->isCardIDUnique($cardid)>0){            
                        
            $this->form_validation->set_message('cardid_check', 'Card ID Already exist');
            return FALSE;
            
        }else{
            
            if($this->customer_model->isCardBan($cardid)==TRUE){
                $this->form_validation->set_message('cardid_check', 'Card ID is in Ban List');
                return FALSE;    
            }else{
                return TRUE;
            }
            
        }
        
    }//end function
    
    
    public function blockcardid(){
        if($this->session->userdata('is_logged_in')==TRUE){
            $data=  site_data();
            $data['_page_title']='Block Card ID';
            
            $this->load->model('customer_model');            
            $data['_block_ids'] =   $this->customer_model->getBlockIDList();
            
            $this->template->customer_bci($data);  
        }else{
            redirect('signin');
        }
    }//end function
    
    /**
     * Add A ID into block list
     */
    public function addidinblocklist(){
        
        
        $data['card_id']=$this->input->post('_card_id');
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('_card_id', 'Card ID',   'trim|required|max_length[50]|xss_clean|is_unique[avcd_card_block.card_id]');
        
        if ($this->form_validation->run() == true)
        {             
            $this->load->model('customer_model');
            $res= $this->customer_model->addCardIDtoBlockList($data);        
            echo $res;
            
        }else{
            echo validation_errors();
        }                
        
    }//end function
    
    
    public function unbancardid(){
        if($this->session->userdata('is_logged_in')==TRUE){            
        
            $this->load->model('customer_model');
            $card_id=$this->input->post('_card_id');
            $res= $this->customer_model->unbancardid($card_id);        
            echo $res;
            
        }else{
            redirect('signin');
        }
        
    }//end function
    
    
    public function changeIdNumber(){
        
        if($this->session->userdata('is_logged_in')==TRUE){
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('_id_number', 'ID Number',   'trim|required|max_length[255]|xss_clean|is_unique[avcd_customer.cust_id]');

            if ($this->form_validation->run() == true)
            {
                $this->load->model('customer_model');
                $data['cust_id']   = $this->input->post('_id_number');
                $cust_sn    = $this->input->post('_cust_sn');

                $res= $this->customer_model->changeIdNumber($data,$cust_sn);        

                echo $res;

            }else{
                echo validation_errors();
            }        
            
        }else{
            redirect('signin');
        }
    }//end function 
    
    
    public function changepassword(){
        
          if($this->session->userdata('is_logged_in')==TRUE){
            
            $this->load->library('form_validation');            
            $this->form_validation->set_rules('_pass', 'Password',      'trim|max_length[12]|matches[_repass]|xss_clean');
            $this->form_validation->set_rules('_repass', 'Confirm Password', 'trim|required|max_length[12]|xss_clean');
            
            
            if ($this->form_validation->run() == true)
            {
                $this->load->model('customer_model');
                $data['cust_password']   = md5($this->input->post('_pass'));
                $cust_sn    = $this->input->post('_cust_sn');

                $res= $this->customer_model->changepassword($data,$cust_sn);        

                echo $res;

            }else{
                echo validation_errors();
            }        
            
        }else{
            redirect('signin');
        }
    }//end changepasswrod
    

    public function getExistingByCard(){
        
        $card_id    =   $this->input->post('customer_card_id');
        $this->load->model('customer_model');
        
        
        
        $res=$this->customer_model->getRecordByCardId($card_id);
        
        
        if(count($res)>0){
            //echo 'found';
            $this->session->set_flashdata('_existing',TRUE);
            $this->session->set_flashdata('_customer',$res);
            redirect('customer/confirmation');
        }else{
            $this->session->set_flashdata('_not_found',TRUE);
            $this->session->set_flashdata('_id',$card_id);
            //echo 'not found';
            redirect('home/existingCustomer');
        }        
        
        
    }//end function
    
    
    public function getCampaignDetails(){
        
       //echo json_encode(array('test val',TRUE));
        //exit();
        $_cmpn_sn=$this->input->post('_cmpn_sn');        
        
        $this->load->model('campaign_model');                
        $res=$this->campaign_model->getRecord($_cmpn_sn);    
        
       echo json_encode($res);
       //echo 'test';
       exit();
        
    }//END FUNCTION
    
       
    public function getCampaignByCustomer(){
        
        
        $_cmpn_sn=$this->input->post('_cmpn_sn');  //sent $_cmpn_sn as subs_sn      
        $_cust_sn=$this->input->post('_cust_sn');        
        
        $this->load->model('subscription_model');                
        $res=$this->subscription_model->getCustomerCampaignDetails($_cust_sn,$_cmpn_sn); 
       
        echo json_encode($res);
        exit();
        
    }//end function
    
    
    public function getCampaignByCustomerAjax(){
                
        $_cmpn_sn=$this->input->post('_cmpn_sn');  //sent $_cmpn_sn as subs_sn      
        $_cust_sn=$this->input->post('_cust_sn');        
        
        $this->load->model('subscription_model');                
        $res=$this->subscription_model->getCustomerCampaignDetailsAjax($_cust_sn,$_cmpn_sn); 
       
        echo json_encode($res);
        exit();
        
    }//end function
    
    /**
     * Update Customer Additional Info
     * 
     * @param type $cust_sn
     * @param type $info
     * @return type
     */
    private function appendAdditionalCustomerInfo($cust_sn,$info){
        
       $this->load->model('customer_model');
       
       $rec=$this->customer_model->getRecord($cust_sn);
       
       
       $data['cust_additional']  =$rec[0]['cust_additional'].'<br>';//append new data
       $data['cust_additional']  .='<i>Append on '.date("j M, Y h:i a").'</i><br>';
       $data['cust_additional']  .=$info; 
       
       $res = $this->customer_model->updateCustomerInfo($data,$cust_sn);
       
       
       return $res;
       
    }//end function
    
}//end class