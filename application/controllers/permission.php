<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission extends CI_Controller {
	
	public function view ()
	{
		
		$this->user_model->require_permission('manage_permissions');
		
		$this->lang->load('permission');
		$this->load->model('permission_model');
		
		$this->load->view('template/header');
		
		$data['permissions'] = $this->permission_model->get();
		$this->load->view('permission/view', $data);
		
		$this->load->view('template/footer');		
		
	}
	
	
	
	
	public function add ()
	{
	
		$this->user_model->require_permission('manage_permissions');
	
		$this->lang->load('permission');
		$this->load->model('permission_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('description', lang('description'), 'trim|required');
		$this->form_validation->set_rules('heading', lang('heading'), 'trim|required');
		$this->form_validation->set_rules('sort', lang('sort'), '');
		 
		$this->load->view('template/header');
	
		if ($this->form_validation->run() === false)
		{
				
			$this->load->view('permission/add');
				
		}
		else
		{
				
			$result = $this->permission_model->insert();
				
			if ($result)
			{
				
				$name = $this->data_model->get_value('permissions', 'name', $result);
				$this->log_model->add('add_permission', $result.': '.$name);
				
				$data = array('message_text' => 'Permission '.lang('added_ok'),
						'buttons' => array(array('button_text' => lang('view').' Permissions', 'link' => 'permission/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Permission '.lang('not_added'),
						'buttons' => array(array('button_text' => lang('view').' Permissions', 'link' => 'permission/view')));
				$this->load->view('message', $data);
			}
				
				
		}
	
		$this->load->view('template/footer');
	
	}
	
	
	
	
	public function edit ($id)
	{
	
		$this->user_model->require_permission('manage_permissions');
	
		$this->lang->load('permission');
		$this->load->model('permission_model');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('description', lang('description'), 'trim|required');
		$this->form_validation->set_rules('heading', lang('heading'), 'trim|required');
		$this->form_validation->set_rules('sort', lang('sort'), '');
	
		$this->load->view('template/header');
	
		if ($this->form_validation->run() === false)
		{
				
			$data['permission'] = $this->permission_model->get($id);
			$this->load->view('permission/edit', $data);
	
		}
		else
		{
	
			$result = $this->permission_model->update($id);
	
			if (!is_null($result))
			{
				
				$name = $this->data_model->get_value('permissions', 'name', $id);
				$this->log_model->add('edit_permission', $id.': '.$name);
				
				$data = array('message_text' => 'Permission '.lang('updated_ok'),
						'buttons' => array(array('button_text' => lang('view').' Permissions', 'link' => 'permission/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Permission '.lang('not_updated'),
						'buttons' => array(array('button_text' => lang('view').' Permissions', 'link' => 'permission/view')));
				$this->load->view('message', $data);
			}
	
	
		}
	
		$this->load->view('template/footer');
	
	}
	
	
	
	public function delete ($id = 0, $confirm = NULL)
	{
	
		$this->user_model->require_permission('manage_permissions');
	
		$this->lang->load('permission');
		$this->load->model('permission_model');
	
		if ($confirm == 1)
		{
			
			$name = $this->data_model->get_value('permissions', 'name', $id);
			
			//execute delete action
			$result = $this->permission_model->delete($id);
	
			if ($result)
			{
	
				//deleted ok
				$this->log_model->add('delete_permission', $id.': '.$name);
				
				$data = array('message_text' => 'Permission '.lang('deleted_ok'),
						'buttons' => array(array('button_text' => lang('view').' Permissions', 'link' => 'permission/view')));
	
			}
			else
			{
	
				//not deleted
				$data = array('message_text' => 'Permission '.lang('not_deleted'),
						'buttons' => array(array('type' => 'back', 'back_level' => 2)));
	
			}
	
		}
		else
		{
			//confirm delete
			$name = $this->data_model->get_value('permissions', 'name', $id);
			$data = array(
					'message_text' => lang('confirm_delete').' <b>'.$name.'</b><br />'.lang('not_undoable'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'permission/delete/'.$id.'/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));
	
		}
	
		$this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');
	
	}
	
	
	
	
	
	
	
	
	
	
}



?>
