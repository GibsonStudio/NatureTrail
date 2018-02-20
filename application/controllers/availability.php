<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Availability extends CI_Controller {
	
	
	public function view ()
	{
		
		$this->user_model->require_login();
		$this->user_model->require_permission('manage_availability');
		$this->load->model('availability_model');
		
		$this->load->view('template/header');
		
		$data['availabilities'] = $this->availability_model->get();
		$this->load->view('availability/view', $data);
		
		$this->load->view('template/footer');

		
	}
	
	
	
	
	
	public function add ()
	{
		
		$this->user_model->require_login();
		$this->user_model->require_permission('manage_availability');
		$this->load->model('availability_model');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
				
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('sort', 'Sort', 'trim|required');
		 
		$this->load->view('template/header');
		
		if ($this->form_validation->run() === false)
		{
				
			$this->load->view('availability/add');
				
		}
		else
		{
				
			$result = $this->availability_model->insert();
				
			if ($result)
			{
		
				$name = $this->data_model->get_value('availability', 'name', $result);
				$this->log_model->add('add_availability', $result.': '.$name);
		
				$data = array('message_text' => 'Availability '.lang('added_ok'),
						'buttons' => array(array('button_text' => lang('view').' Availabilities', 'link' => 'availability/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Availability '.lang('not_added'),
						'buttons' => array(array('button_text' => lang('view').' Availabilities', 'link' => 'availability/view')));
				$this->load->view('message', $data);
			}
				
				
		}
		
		$this->load->view('template/footer');
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	public function edit ($id = 0)
	{
	
		$this->user_model->require_permission('manage_availabilty');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('availability_model');
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('sort', 'Sort', 'trim|required');
		
		$this->load->view('template/header');
		
		if ($this->form_validation->run() === false)
		{
			$data['availability'] = $this->availability_model->get($id);
			$this->load->view('availability/edit', $data);
		}
		else
		{
		
			$result = $this->availability_model->update($id);
		
			if (!is_null($result))
			{
		
				$availability = $this->data_model->get_value('availability', 'name', $id);
				$this->log_model->add('update_availability', $id.': '.$availability);
		
				$data = array('message_text' => 'Availability '.lang('updated_ok'),
						'buttons' => array(array('button_text' => lang('view').' Availabilities', 'link' => 'availability/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Availability '.lang('not_updated'),
						'buttons' => array(array('button_text' => lang('view').' Availabilities', 'link' => 'availability/view')));
				$this->load->view('message', $data);
			}
		
		}
		
		$this->load->view('template/footer');
		
	
	}
	
	
	
	
	
	
	
	
	
	
	
	public function delete ($id = 0, $confirm = 0)
	{
	
		$this->user_model->require_permission('manage_availability');		
		$this->load->model('availability_model');
		$name = $this->data_model->get_value('availability', 'name', $id);
		
		if ($confirm == 1)
		{
				
			//execute delete action
			$result = $this->availability_model->delete($id);
		
			if ($result)
			{
		
				//deleted ok
		
				$this->log_model->add('delete_availability', $id.': '.$name);
		
				$data = array('message_text' => 'Availability '.lang('deleted_ok'),
						'buttons' => array(array('button_text' => lang('view').' Availabilities', 'link' => 'availability/view')));
		
			}
			else
			{
		
				//not deleted
				$data = array('message_text' => 'Availability '.lang('not_deleted'),
						'buttons' => array(array('type' => 'back', 'back_level' => 2)));
		
			}
		
		}
		else
		{
			//confirm delete
			$data = array(
					'message_text' => lang('confirm_delete').' <b>'.$name.'</b><br />'.lang('not_undoable'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'availability/delete/'.$id.'/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));
		
		}
		
		$this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');
	
	}
	
	
	
	
	
	
	
	
	
	
}


?>