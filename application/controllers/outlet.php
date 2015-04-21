<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outlet extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if(($this->session->userdata('is_logged_in')==TRUE))
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

          //Load pagination library
            $this->load->library('pagination');

            //set pagination configuration
            $config=  getPaginationConfig();//this function is from helpers/ahb_helper.php file
            $config['base_url'] = base_url().'outlet/index';
            $this->load->model('outlet_model');    

            $config['total_rows'] = $this->outlet_model->getTotalNum();        
            $config['use_page_numbers']=true;
            $config['per_page'] = 20;
            $config['num_links'] = 5;        
            $config['uri_segment'] = 3;                        
            $this->pagination->initialize($config);


            $data['_total_rows']=$config['total_rows'];

            if($this->uri->segment(3)!=''){

                $last=$this->uri->segment(3)*$config['per_page']>$config['total_rows']?$config['total_rows']:$this->uri->segment(3)*$config['per_page'];

                $data['_pagi_msg']=  (($this->uri->segment(3)-1)*($config['per_page']+1)).' - '.$last;            

                $data['_list']=$this->outlet_model->getList($config['per_page'],($config['per_page']*($this->uri->segment(3)-1)));
            }else{                
                if($config['total_rows']>$config['per_page']){                    
                    $last=$config['per_page'];      
                }else{                    
                    $last=$config['total_rows'];      
                }

              $data['_pagi_msg'] = '1 - '.$last;              

              $data['_list']=$this->outlet_model->getList($config['per_page'],$this->uri->segment(3));
            }

            $data['_page_title']='Outlet';
            $this->template->outlet_index($data);   
                
        
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
        
    }//end index
    
    public function add(){
        
        if($this->session->userdata('is_logged_in')==TRUE){
        
            $data=  site_data();
            $data['_page_title']='Add Outlet';
            $data['_action']='add';
            $data['_country']=  getCountry();
            $this->template->outlet_add($data);                        

        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
        
    }//end function
    
    public function edit(){
        if($this->session->userdata('is_logged_in')==TRUE){
        
            $data=  site_data();
            $data['_page_title']='Edit Outlet';
            $data['_action']='update';
            $data['_sn']=$this->uri->segment(3);
            $this->load->model('outlet_model');
            $data['_record']=$this->outlet_model->getRecord($data['_sn']);
            $data['_country']=  getCountry();
            $this->template->outlet_edit($data);                        

        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
    }//end function
    
    public function details(){
        if($this->session->userdata('is_logged_in')==TRUE){
            
            $data=  site_data();
            $data['_page_title']='Outlet Details';
            $data['_sn']=$this->uri->segment(3);
            $this->load->model('outlet_model');
            $data['_record']=$this->outlet_model->getRecord($data['_sn']);
            $data['_country']=  getCountry();

            $this->template->outlet_view($data);     
        
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
    }//end function
    
    public function save(){
        if($this->session->userdata('is_logged_in')==TRUE){
            
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('inputOutletName', 'Outlet Name', 'trim|required|max_length[250]|xss_clean');
        $this->form_validation->set_rules('inputOutletPhoneNumber', 'Phone Number', 'trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('inputEmail', 'Email Address', 'trim|valid_email|max_length[50]|xss_clean');
        $this->form_validation->set_rules('inputAddress', 'Address Line 1', 'trim|required|max_length[250]|xss_clean');
        $this->form_validation->set_rules('inputAddress2', 'Address Line 2', 'trim|required|max_length[250]|xss_clean');
        $this->form_validation->set_rules('inputCity', 'City', 'trim|max_length[50]|xss_clean');
        $this->form_validation->set_rules('inputZipcode', 'Zip', 'trim|max_length[20]|xss_clean');
        $this->form_validation->set_rules('inputCountry', 'Country', 'trim|max_length[2]|xss_clean');
        
        $data['ol_name']=$this->input->post('inputOutletName');
        $data['ol_phone']=$this->input->post('inputOutletPhoneNumber');
        $data['ol_email']=$this->input->post('inputEmail');
        $data['ol_address_line1']=$this->input->post('inputAddress');
        $data['ol_address_line2']=$this->input->post('inputAddress2');
        $data['ol_city']=$this->input->post('inputCity');
        $data['ol_zip']=$this->input->post('inputZipcode');
        $data['ol_country']=$this->input->post('inputCountry');
        $_action=$this->input->post('_action');
        //$data['']=$this->input->post('');
        //$data['']=$this->input->post('');
        
        if ($this->form_validation->run() == true)
        {             
            $res=false;
            $this->load->model('outlet_model');
            if($_action=='add'){
                $res= $this->outlet_model->insert($data);    
                if($res['status']==TRUE){
                    redirect('outlet/details/'.$res['new_id']);  
                }else{
                    //show error message
                }
            }else{
                $id=$this->input->post('_sn');
                $res=$this->outlet_model->update($data,$id);                   
                if($res==TRUE){
                    redirect('outlet/details/'.$id);  
                }else{
                    //show error message
                }
            }//end else
            
            //RETURN THE RESULT            
            //return $res;
            
        }//end if
        else{
            
            //echo validation_errors();
            //exit();
             $data=  site_data();
             
            //echo 'error: '.  validation_errors();
            $data['_error']=  validation_errors();
            $data['_record'][0]['ol_name']=$this->input->post('inputOutletName');
            $data['_record'][0]['ol_phone']=$this->input->post('inputOutletPhoneNumber');
            $data['_record'][0]['ol_email']=$this->input->post('inputEmail');
            $data['_record'][0]['ol_address_line1']=$this->input->post('inputAddress');
            $data['_record'][0]['ol_address_line2']=$this->input->post('inputAddress2');
            $data['_record'][0]['ol_city']=$this->input->post('inputCity');
            $data['_record'][0]['ol_zip']=$this->input->post('inputZipcode');
            $data['_record'][0]['ol_country']=$this->input->post('inputCountry');
            $_action=$this->input->post('_action');
            
            if($_action=='add'){
                $data['_page_title']='Add Outlet';
                $data['_action']='add';                                
                $data['_country']=  getCountry();
                $this->template->outlet_add($data);  
            }else{
                
                $data['_sn']=$this->input->post('_sn');
                
                $data['_page_title']='Update Outlet';
                $data['_action']='update';                                
                $data['_country']=  getCountry();
                $this->template->outlet_add($data);  
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
        $this->load->model('outlet_model');
        $res= $this->outlet_model->delete($data['_sn']);
        
        echo $res;
        }else{
            //user not logged in
            //redirect to login
            redirect('signin');
            
        }//end else
    }//end function
    
}//end class
