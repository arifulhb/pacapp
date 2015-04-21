<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->library('template');

    }//end constractor

    public function index()
    {
      
        $data=  site_data();
        $data['_page_title']='Signin';
        $this->template->admin_login($data);                        

    }//end index
    
     public function signin_validation(){
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('user_id', 'User Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('user_pass', 'Password', 'trim|required|xss_clean');

        
        $data['user_id']=$this->input->post('user_id');
        
        if($this->form_validation->run()==TRUE){
            $data['user_pass']=$this->input->post('user_pass');
            
            $this->load->model('user_model');
            
            $user=$this->user_model->signin($data);
            
            if(count($user)==1){                
                //pass                
                    $user_ses = array(
                            'user_sn' => $user[0]['user_sn'],                            
                            'user_id' => $user[0]['user_id'],                            
                            'user_name' => $user[0]['user_name'],                                                        
                            'user_role' => $user[0]['user_role'],                                                        
                            'is_logged_in' => true
                    );
                    $this->session->set_userdata($user_ses);
                    
                    redirect('admin');
            
            }else{
                //Signin Auth fail
                //echo 'signin auth fail';                
                $this->session->set_flashdata('user_id', $data['user_id']);
                $this->session->set_flashdata('notice', 'User or Password does not match!' );
                redirect ('signin');
            }
            
        }//end run validation
        else{
            //if validatin fail
            echo 'do what to do in validation fail<br>';
        }//end if validation fail
        
    }//end function
    
 
    
}//end class
?>