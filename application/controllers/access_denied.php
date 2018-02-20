<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_denied extends CI_Controller {

    public function index ($permission_name = '')
    {
        
        $this->load->model('user_model');
        $this->load->view('template/header');
        
        $message = lang('access_denied').$permission_name;
        
        $this->log_model->add('Access Denied', $permission_name);
        
        $data = array('message_text' => $message,
            'buttons' => array(array('type' => 'back')));
        $this->load->view('message', $data);
        
        $this->load->view('template/footer');
        
    }
    
    
}

?>