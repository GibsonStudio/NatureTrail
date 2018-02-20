<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {
	
	
	
	public function view ()
	{
		
		$this->user_model->require_permission('change_config');
		
		$this->load->view('template/header');
		
		$data['config'] = $this->config_model->get();
		$this->load->view('config/view', $data);
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	
	
	
	public function edit ($id = 0)
	{
		
		$this->user_model->require_permission('change_config');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('value', 'Value', 'trim');
		
		$this->load->view('template/header');
		
		if ($this->form_validation->run() === false)
		{
			
			$data['config'] = $this->config_model->get($id);
			$this->load->view('config/edit', $data);
			
		}
		else
		{
			
			$result = $this->config_model->update($id);
				
			if (!is_null($result))
			{
			
				$this->log_model->add('edit_config', $id.':'.$this->input->post('value'));
			
				$data = array('message_text' => 'Config '.lang('updated_ok'),
						'buttons' => array(array('button_text' => lang('view').' Config', 'link' => 'config/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Config '.lang('not_updated'),
						'buttons' => array(array('button_text' => lang('view').' Config', 'link' => 'config/view')));
				$this->load->view('message', $data);
			}
			
		}
		
		
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	
	
	
	
}


?>