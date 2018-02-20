<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index ()
    {
        
    	$this->load->model('block_model');
    	
        $this->load->view('template/header');

        $data['blocks_left'] = $this->block_model->get(array('position' => 0));
        $data['blocks_right'] = $this->block_model->get(array('position' => 1));
        $this->load->view('home', $data);
        $this->load->view('template/footer');
        
    }
    
}

?>