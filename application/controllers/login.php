<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


    public function __construct()
    {
            parent::__construct();
            $this->load->library('template');

            $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
            $this->output->set_header("Pragma: no-cache");

    }//end constractor

    public function index(){


        $data=  site_data();
        $data['_page_title']='Login';
        $this->template->front_login($data);


    }//end function

    public function verification(){

        $data['user_pin']   = $this->input->post('inputPin');
        //$data['user_pass']  = $this->input->post('');

        $this->load->model('user_model');

        $user= $this->user_model->loginWithPIN($data);

        if(count($user)>0){
            //echo user found
           $user_ses = array(
            'user_sn' => $user[0]['user_sn'],
            'user_sn_front' => $user[0]['user_sn'],
            'user_id' => $user[0]['user_id'],
            'user_id_front' => $user[0]['user_id'],
            'user_name' => $user[0]['user_name'],
            'user_name_front' => $user[0]['user_name'],
            'user_role' => $user[0]['user_role'],
            'outlet' => $user[0]['outlet'],
            'outlet_front' => $user[0]['outlet'],
            'ou_sn' => $user[0]['ol_sn'],
            'ou_sn_front' => $user[0]['ol_sn'],
            'is_front_logged_in' => true
            );
            $this->session->set_userdata($user_ses);

            redirect('home');
        }else{
            //Flash MESSAGE
            redirect('login');
        }//else

    }//end function verification

    public function logout(){

        $this->session->set_userdata(array('is_front_logged_in'=>'','user_name'=>''));
        $this->session->sess_destroy();

        //$this->cache->clean();
        redirect('login');

    }//end function

}//end home