<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $data=array();
    
    public function __construct()
    {
        parent::__construct();                
        /**
         * IF USER IS NOT LOGGED IN/ REDIRECT TO LOGIN AUTOMATICALLY
         */                                
        
        //$this->data['user'] = 'Joost';
        if($this->session->userdata('is_logged_in') == FALSE){     
            
           //SET MESSAGE
           //$this->session->set_flashdata('pc_message', 'Current Password doesnt match');
           
           //uri_string()=='signin'||redirect('signin');
           
        }//end if is_logged_in

        no_cache();
        
    }//end constractor
    
}//end controller