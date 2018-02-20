<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {
	
	
	public function view_templates ()
	{
		
		$this->user_model->require_permission('manage_email_templates');
		
		$this->load->model('email_model');		
		
		$this->load->view('template/header');
		
		$data['templates'] = $this->email_model->get_templates();
		$this->load->view('email/view_templates', $data);
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	public function load_template ()
	{
		
		$this->user_model->require_permission('manage_email_templates');
		$this->load->model('email_model');
		$template_id = $this->input->post('template_id');
		$template = $this->email_model->get_template($template_id);
		
		echo $template->content;		
		
	}
	
	
	
	
	
	public function add_template ()
	{
		
		$this->user_model->require_permission('manage_email_templates');
		
		$this->load->model('email_model');
		$this->lang->load('email');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('content', lang('content'), 'trim|required');
		$this->form_validation->set_rules('sort', lang('sort'), 'required');
		
		$this->load->view('template/header');
		
		if ($this->form_validation->run() === false)
		{
			$this->load->view('email/template_add');
		}
		else
		{
		
			$result = $this->email_model->add_template();
		
			if ($result)
			{
				
				$name = $this->data_model->get_value('email_template', 'name', $result);
				$this->log_model->add('add_email_template', $result.': '.$name);
				
				$data = array('message_text' => lang('template_add_ok'),
						'buttons' => array(array('button_text' => lang('view_templates'), 'link' => 'email/view_templates')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => lang('template_add_fail'),
						'buttons' => array(array('button_text' => lang('view_templates'), 'link' => 'email/view_templates')));
				$this->load->view('message', $data);
			}
		
		}
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	public function edit_template ($id)
	{
		
		$this->user_model->require_permission('manage_email_templates');
		
		$this->load->model('email_model');
		$this->lang->load('email');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('content', lang('content'), 'trim|required');
		$this->form_validation->set_rules('sort', lang('sort'), 'required');
		
		$this->load->view('template/header');
		
		if ($this->form_validation->run() === false)
		{
			$data['template'] = $this->email_model->get_template($id);
			$this->load->view('email/template_edit', $data);
		}
		else
		{
				
			$result = $this->email_model->update_template($id);
				
			if ($result === true)
			{
				
				$name = $this->data_model->get_value('email_template', 'name', $id);
				$this->log_model->add('edit_email_template', $id.': '.$name);
				
				$data = array('message_text' => lang('template_update_ok'),
						'buttons' => array(array('button_text' => lang('view_templates'), 'link' => 'email/view_templates')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => lang('template_update_fail'),
						'buttons' => array(array('button_text' => lang('view_templates'), 'link' => 'email/view_templates')));
				$this->load->view('message', $data);
			}
				
		}
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	
	
	public function delete_template ($id = 0, $confirm = 0)
	{
		
		$this->user_model->require_permission('manage_email_templates');
		
		$this->load->model('email_model');
		$this->lang->load('email');
		
		if ($confirm == 1)
		{
	
			$name = $this->data_model->get_value('email_template', 'name', $id);
			
			//execute delete action
			$result = $this->email_model->delete_template($id);
	
			if ($result)
			{
	
				//deleted ok				
				$this->log_model->add('delete_email_template', $id.': '.$name);
				
				$data = array('message_text' => lang('template_delete_ok'),
						'buttons' => array(array('button_text' => lang('view_templates'), 'link' => 'email/view_templates')));
	
			}
			else
			{
	
				//not deleted
				$data = array('message_text' => lang('template_delete_fail'),
						'buttons' => array(array('type' => 'back', 'back_level' => 2)));
	
			}
	
		}
		else
		{
			//confirm delete
			$data = array(
					'message_text' => lang('confirm_template_delete'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'email/delete_template/'.$id.'/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));
	
		}
	
		$this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');	
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}


?>