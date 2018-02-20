<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {
	
	public function view ()
	{
		
		$this->user_model->require_permission('manage_roles');
		
		$this->lang->load('role');
		$this->load->model('role_model');
		
		$this->load->view('template/header');
		
		$data['roles'] = $this->role_model->get();
		$this->load->view('role/view', $data);
		
		$this->load->view('template/footer');		
		
	}
	
	
	
	
	public function add ()
	{
	
		$this->user_model->require_permission('manage_roles');
	
		$this->lang->load('role');
		$this->load->model('role_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('level', lang('level'), 'required');
		$this->form_validation->set_rules('description', lang('description'), 'trim|required');
		 
		$this->load->view('template/header');
	
		if ($this->form_validation->run() === false)
		{
				
			$this->load->view('role/add');
				
		}
		else
		{
				
			$result = $this->role_model->insert();
				
			if ($result)
			{
				
				$rolename = $this->data_model->get_value('accesslevel', 'name', $result);
				$this->log_model->add('add_role', $result.': '.$rolename);
				
				$data = array('message_text' => 'Role '.lang('added_ok'),
						'buttons' => array(array('button_text' => lang('view').' Roles', 'link' => 'role/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Role '.lang('not_added'),
						'buttons' => array(array('button_text' => lang('view').' Roles', 'link' => 'role/view')));
				$this->load->view('message', $data);
			}
				
				
		}
	
		$this->load->view('template/footer');
	
	}
	
	
	
	
	public function edit ($id)
	{
	
		$this->user_model->require_permission('manage_roles');
	
		$this->lang->load('role');
		$this->load->model('role_model');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('level', lang('level'), 'required');
		$this->form_validation->set_rules('description', lang('description'), 'trim|required');		
	
		$this->load->view('template/header');
	
		if ($this->form_validation->run() === false)
		{
				
			$data['role'] = $this->role_model->get($id);
			$this->load->view('role/edit', $data);
	
		}
		else
		{
	
			$result = $this->role_model->update($id);
	
			if ($result === true)
			{
				
				$rolename = $this->data_model->get_value('accesslevel', 'name', $id);
				$this->log_model->add('edit_role', $id.': '.$rolename);
				
				$data = array('message_text' => 'Role '.lang('updated_ok'),
						'buttons' => array(array('button_text' => lang('view').' Roles', 'link' => 'role/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Role '.lang('not_updated'),
						'buttons' => array(array('button_text' => lang('view').' Roles', 'link' => 'role/view')));
				$this->load->view('message', $data);
			}
	
	
		}
	
		$this->load->view('template/footer');
	
	}
	
	
	
	
	public function delete ($id = 0, $confirm = NULL)
	{
	
		$this->user_model->require_permission('manage_roles');
	
		$this->lang->load('role');
		$this->load->model('role_model');
	
		if ($confirm == 1)
		{
	
			//execute delete action
			$rolename = $this->data_model->get_value('accesslevel', 'name', $id);
			$result = $this->role_model->delete($id);
	
			if ($result)
			{
	
				//deleted ok
				
				
				$this->log_model->add('delete_role', $id.': '.$rolename);
				
				$data = array('message_text' => 'Role '.lang('deleted_ok'),
						'buttons' => array(array('button_text' => lang('view').' Roles', 'link' => 'role/view')));
	
			}
			else
			{
	
				//not deleted
				$data = array('message_text' => 'Role'.lang('not_deleted'),
						'buttons' => array(array('type' => 'back', 'back_level' => 2)));
	
			}
	
		}
		else
		{
			//confirm delete
			$name = $this->data_model->get_value('accesslevel', 'name', $id);
			$data = array(
					'message_text' => lang('confirm_delete').' <b>'.$name.'</b><br />'.lang('not_undoable'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'role/delete/'.$id.'/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));
	
		}
	
		$this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');
	
	}
	
	
	
	
	
	
	
	
	public function assign_permissions ($roleid = 0)
	{
		
		$this->user_model->require_permission('manage_roles');
		
		$this->lang->load('role');
		$this->load->model('role_model');	
		$this->load->model('permission_model');	
		
		$this->load->view('template/header');
		
		$data['role_permissions'] = $this->role_model->get_role_permissions($roleid);
		$permissions = $this->permission_model->get();
		$data['permissions'] = $permissions;
		$data['roleid'] = $roleid;
		$data['role_name'] = $this->data_model->get_value('accesslevel', 'name', $roleid);
		
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('roleid', lang('id'), 'required');
		//$this->form_validation->set_rules('name', lang('name'), 'trim|required');
		
		foreach ($permissions as $permission)
		{
			$this->form_validation->set_rules($permission['id'], $permission['id'], '');
		}
		
		
		if ($this->form_validation->run() === false)
		{
			
			$this->load->view('role/assign_permissions', $data);
			
		}
		else
		{
			
			//process data and set {pre}accesslevel.roles
			
			$role_permissions = '';
			
			foreach ($permissions as $permission)
			{
								
				if ($this->input->post($permission['id']))
				{
					
					if (!empty($role_permissions))
					{
						$role_permissions .= ',';
					}
					
					$role_permissions .= $permission['id'];
					
				}
				
			}
			
			
			$result = $this->role_model->set_permissions($roleid, $role_permissions);
			

			
			if (!is_null($result))
			{
				
				$rolename = $this->data_model->get_value('accesslevel', 'name', $roleid);
				$this->log_model->add('assign_permissions', $roleid.': '.$rolename);
				
				$data = array('message_text' => 'Role '.lang('updated_ok'),
						'buttons' => array(array('button_text' => lang('view').' Roles', 'link' => 'role/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Role '.lang('not_updated'),
						'buttons' => array(array('button_text' => lang('view').' Roles', 'link' => 'role/view')));
				$this->load->view('message', $data);
			}
			
			
			
			
		}
		
		$this->load->view('template/footer');		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}



?>
