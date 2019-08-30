<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscription extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        if(($this->session->userdata('is_logged_in')==TRUE) ||
            ($this->session->userdata('is_front_logged_in')==TRUE)){            
                
            $this->load->library('template');
        } else {
            redirect('signin');
        }

        no_cache();
    }

//end constractor

//end index


	/**
	 * call from http://pacapp.dev/customer/edit/$id
	 * customer_subscribe.js
	 */
	public function reopen(){

		$tmp_subs_sn = $this->input->post('tmp_subs_sn');

		$this->load->model('subscription_model');
		$res = $this->subscription_model->reopen($tmp_subs_sn);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('result'=>$res)));
//		echo json_encode($res);

	}//end function

    public function receipt(){
        
        $data = site_data();
        $data['_page_title'] = 'SUBSCRIPTION RECEIPT';
        $tmp_sn = $this->uri->segment(3);

        $_status=$this->input->get('status');
                        
        $this->load->model('subscription_model');
        
        if($_status=='approved'){
            $_record = $this->subscription_model->getReceipt($tmp_sn);
        }elseif ($_status=='pending'){
            $_record = $this->subscription_model->getTempReceipt($tmp_sn);
        }

        $_cust['cust_first_name']           =$_record[0]['cust_first_name'];
        $_cust['cust_card_id']              =$_record[0]['cust_card_id'];//cast_id
        $_cust['cust_id']                   =$_record[0]['cust_id'];//cust_sn
        $_cust['cust_phone']                =$_record[0]['cust_phone'];
        $_cust['cust_email']                =$_record[0]['cust_email'];
        $_cust['cust_city']                 =$_record[0]['cust_city'];
        $_cust['cust_zip']                  =$_record[0]['cust_zip'];
        $_cust['cust_country']              =$_record[0]['cust_country'];

        $_subs['user_sn']                   =$_record[0]['user_sn'];
        $_subs['cmpn_sn']                   =$_record[0]['cmpn_sn'];

        $_subs['car_number']                =$_record[0]['car_number'];
        $_subs['car_model']                 =$_record[0]['car_model'];
        $_subs['car_color']                 =$_record[0]['car_color'];
        $_subs['subs_type']                 =$_record[0]['subs_type'];
        $_subs['update_date']               =$_record[0]['req_date'];
        $_subs['subs_date']                 =$_record[0]['subs_date'];
        $_subs['tran_value']                =$_record[0]['tran_value'];
        $_subs['cust_balance']              =$_record[0]['cust_balance'];
        $_subs['expire_date']               =$_record[0]['expire_date'];
        $_subs['subs_bill_no']              =$_record[0]['subs_bill_no'];
        $_subs['subs_bill_amount']          =$_record[0]['subs_bill_amount'];
        $_subs['old_balance']               =$_record[0]['old_balance'];
        $_subs['remark']                    =$_record[0]['remark'];
        $_subs['redemption']                =$_record[0]['redemption'];
        $_subs['user_name']                 =$_record[0]['user_name'];
        $_subs['ol_name']                   =$_record[0]['ol_name'];

        $data['_cust']       = $_cust;
        $data['_subs']       = $_subs;
        $data['user_sn']    = $_subs['user_sn'];
        $data['cmpn_sn']    = $_subs['cmpn_sn'];

        $this->template->subscription_receipt($data);
        
    }//end function
    
    public function view() {

        $data = site_data();
        $data['_page_title'] = 'Subscribe View';
        $tmp_sn = $this->uri->segment(3);
        $this->load->model('subscription_model');
        $data['_record'] = $this->subscription_model->getViewRecord($tmp_sn);
        
        // var_dump($data);
        // die();
        $this->template->subscription_view($data);
    } //end function view
    

} //end class
