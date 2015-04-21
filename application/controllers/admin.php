<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    
    public function __construct()
    {
           parent::__construct();                        
           
           if(($this->session->userdata('is_logged_in')==TRUE) )
            {
                $this->load->library('template');
            }else{
                redirect('signin');
            } 
            
            no_cache();            

    }//end constractor
    
    public function index()
    {
        if($this->session->userdata('is_logged_in')==TRUE){            
            $data=  site_data();
            $data['_page_title']='Admin';
            $this->template->admin_home($data);                        
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
        
    }//end index
        
}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */