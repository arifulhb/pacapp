<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pending extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (($this->session->userdata('is_logged_in') == TRUE)) {
            $this->load->library('template');
        } else {
            redirect('signin');
        }

        no_cache();
    }

//end constractor

    public function index() {
        if ($this->session->userdata('is_logged_in') == TRUE) {

            $data = site_data();

            $this->load->library('pagination');
            $data['_page_title'] = 'Pending Subscriptions';
            //set pagination configuration
            $config = getPaginationConfig(); //this function is from helpers/ahb_helper.php file
            $config['base_url'] = base_url() . 'pending/index';
            $this->load->model('pending_model');

            $config['total_rows'] = $this->pending_model->getTotalNum();
            $config['use_page_numbers'] = true;
            $config['per_page'] = 30;
            $config['num_links'] = 5;
            $config['uri_segment'] = 3;
            $this->pagination->initialize($config);


            $data['_total_rows'] = $config['total_rows'];

            if ($this->uri->segment(3) != '') {

                $last = $this->uri->segment(3) * $config['per_page'] > $config['total_rows'] ? $config['total_rows'] : $this->uri->segment(3) * $config['per_page'];

                $data['_pagi_msg'] = (($this->uri->segment(3) - 1) * ($config['per_page'] + 1)) . ' - ' . $last;

                $data['_list'] = $this->pending_model->getList($config['per_page'], ($config['per_page'] * ($this->uri->segment(3) - 1)));
            } else {
                if ($config['total_rows'] > $config['per_page']) {
                    $last = $config['per_page'];
                } else {
                    $last = $config['total_rows'];
                }

                $data['_pagi_msg'] = '1 - ' . $last;

                $data['_list'] = $this->pending_model->getList($config['per_page'], $this->uri->segment(3));
                
            }
            
            $this->template->pending_index($data);
        } else {
            //user not logged in
            //redirect to login
            redirect('signin');
        }//end else
    }

//end index

    public function view() {

        $data = site_data();
        $data['_page_title'] = 'Pending View';
        $tmp_sn = $this->uri->segment(3);
        $this->load->model('pending_model');
        $data['_record'] = $this->pending_model->getViewRecord($tmp_sn);

        //print_r($data['_record']);
        //exit();
        $this->template->pending_view($data);
    }

//end function view

    public function approve() {

        if ($this->session->userdata('is_logged_in') == TRUE) {

            $tempsn                     = $this->input->post('_tempsn');

            $data['cust_sn']            = $this->input->post('_cust_sn');
            $data['subs_type']          = $this->input->post('_subs_type');
            $data['subs_date']          = $this->input->post('_date');
            $data['cmpn_sn']            = $this->input->post('_cmpn_sn');            
            $data['expire_date']        = $this->input->post('_expire_date');
            $data['cust_balance']       = $this->input->post('_cust_balance');
            $data['subs_bill_no']       = $this->input->post('_bill_no');
            $data['subs_bill_amount']   = $this->input->post('_bill_amount');
            $data['user_sn']            = $this->input->post('_user_sn');
            $data['remark']             = $this->input->post('_remark');
            $data['car_number']         = $this->input->post('_car_number');
            $data['car_color']          = $this->input->post('_car_color');
            $data['car_model']          = $this->input->post('_car_model');
            $data['req_date']           = $this->input->post('_req_date');
            $data['ref_no']             = $tempsn;
            
            $this->load->model('subscription_model');

            $res = $this->subscription_model->insert($data);

            if ($res == true) {
//                $tran['subs_sn'] = $this->db->insert_id(); //get new subscription id
                $tran['subs_sn'] = $res;

                $date = new DateTime();
                $tran['trn_date'] = $date->format("Y-m-d H:i:s");
                
                $tran['user_sn'] = $this->input->post('_user_sn');
                $tran['tran_value'] = $this->input->post('_tran_value');
                $tran['tran_description'] = 'Approved Initial Transaction';
                $tran['tran_activity'] = 'Added ' . $tran['tran_value'];
                //$tran['tran_type'] = 'add';
                //$this->load->model('');
                $tres = $this->subscription_model->addTransectionOnly($tran);
                if ($tres == true) {
                    $this->subscription_model->approveSubscriptionTmp($tempsn);
                    echo TRUE;
                } else {

                    //INSERT APPROVED TRANSECTION WAS NOT SUCCESSFUL

                    $tran_sn = $this->db->insert_id();
                    $this->subscription_model->removeTransection($tran_sn);
                    $this->subscription_model->removeSubscription($tran['subs_sn']);

                    echo FALSE;
                }//end else
            }//end if
            else {
                //INSERT APPROVED SUBSCRIPTION WAS NOT SUCCESSFUL
                echo FALSE;
            }
        } else {
            //user not logged in
            //redirect to login
            redirect('signin');
        }//end else 
    }

//end function

    public function add() {

        if ($this->session->userdata('is_logged_in') == TRUE) {

            $data = site_data();
            $data['_page_title'] = 'Add Campaign';
            $data['_action'] = 'add';
            $this->template->campaign_add($data);
        } else {
            //user not logged in
            //redirect to login
            redirect('signin');
        }//end else
    }

//end function

    public function save() {

        if ($this->session->userdata('is_logged_in') == TRUE) {

            $tmpsn = $this->input->post('_sn');
            $data['subs_type'] = $this->input->post('inputType');
            //$data['cust_sn']      = $this->input->post('');
            $data['subs_date'] = convertMyDate($this->input->post('inputSubsDate'));
            $data['cmpn_sn'] = $this->input->post('inputCampaign');
            $data['num_of_months']        = $this->input->post('number_of_months');
            $data['expire_date'] = convertMyDate($this->input->post('inputExpireDate'));
            $data['cust_balance'] = $this->input->post('inputNewBalance');
            //$data['user_sn'] = $this->input->post('inputUser');
            $data['tran_value'] = $this->input->post('inputTranValue');
            $data['redemption'] = $this->input->post('inputRedemption');
            $data['old_balance'] = $this->input->post('inputOldBalance');
            
            $data['subs_bill_no'] = $this->input->post('inputBillNo');
            $data['subs_bill_amount'] = $this->input->post('inputBillAmount');
            
            $data['car_number'] = $this->input->post('inputCarNumber');
            $data['car_model'] = $this->input->post('inputCarModel');
            $data['car_color'] = $this->input->post('inputCarColor');            
            $data['remark'] = $this->input->post('inputRemark');
            

            $this->load->model('pending_model');
            $res = $this->pending_model->update($data, $tmpsn);

            if ($res == true) {
                $this->session->set_flashdata('_success', TRUE);
                redirect('pending');
            } else {

                redirect('pending');
            }
            //print_r($data);
        } else {
            //user not logged in
            //redirect to login
            redirect('signin');
        }//end else
    }

//end function   

    public function delete() {

        if ($this->session->userdata('is_logged_in') == TRUE) {
            
            $data['_sn'] = $this->input->post('_sn');
            $this->load->model('pending_model');
            $res = $this->pending_model->delete($data['_sn']);

            echo $res;
            
        } else {
            //user not logged in
            //redirect to login
            redirect('signin');
        }//end else
    }

//end function

    public function edit() {

        if ($this->session->userdata('is_logged_in') == TRUE) {

            $data = site_data();
            $data['_page_title'] = 'Edit a Pending Subscription';
            $id = $this->uri->segment(3);
            $this->load->model('pending_model');
            $data['_record'] = $this->pending_model->getRecord($id);

            $this->load->model('campaign_model');
            $data['_campaign'] = $this->campaign_model->getAllRecords();

            $this->load->model('user_model');
            $data['_users'] = $this->user_model->getAllRecords();

            $this->template->pending_edit($data);
        } else {
            //user not logged in
            //redirect to login
            redirect('signin');
        }//end else
    }

//end function

    /*
      public function details(){


      if($this->session->userdata('is_logged_in')==TRUE){

      $data=  site_data();
      $data['_page_title']='Campaign Details';

      $this->template->campaign_details($data);

      }else{
      //user not logged in
      //redirect to login
      redirect('signin');

      }//end else
      }//end function
     */
}

//end class
