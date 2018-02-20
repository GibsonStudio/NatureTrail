<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {
	
	
	public function view ()
	{
		
		$this->user_model->require_permission('manage_groups');
		
		$this->lang->load('group');
		$this->load->model('group_model');
		
		$this->load->view('template/header');
		
		$data['groups'] = $this->group_model->get();
		$this->load->view('group/view', $data);
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	public function add ()
	{
		
		$this->user_model->require_permission('manage_groups');
		
		$this->load->model('group_model');
		$this->lang->load('group');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('description', lang('description'), 'trim');

		
		$this->load->view('template/header');
		
		if ($this->form_validation->run() === false)
		{
			$this->load->view('group/add');
		}
		else
		{
				
			$result = $this->group_model->insert();
		
			if ($result)
			{
				
				$groupname = $this->data_model->get_value('group', 'name', $result);
				$this->log_model->add('add_group', $result.': '.$groupname);
				
				$data = array('message_text' => 'Group '.lang('added_ok'),
						'buttons' => array(array('button_text' => lang('view').' Groups', 'link' => 'group/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Group '.lang('not_added'),
						'buttons' => array(array('button_text' => lang('view').' Groups', 'link' => 'group/view')));
				$this->load->view('message', $data);
			}
				
				
		}
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	
	
	
	
	
	
	public function edit ($id = 0)
	{
	
		$this->user_model->require_permission('manage_groups');
	
		$this->load->model('group_model');
		$this->lang->load('group');
	
		$this->load->helper('form');
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('description', lang('description'), 'trim');	
	
		$this->load->view('template/header');
	
		if ($this->form_validation->run() === false)
		{
			$data['group'] = $this->group_model->get($id);
			$this->load->view('group/edit', $data);
		}
		else
		{
	
			$result = $this->group_model->update($id);
	
			if (!is_null($result))
			{
	
				$groupname = $this->data_model->get_value('group', 'name', $id);
				$this->log_model->add('update_group', $id.': '.$groupname);
	
				$data = array('message_text' => 'Group '.lang('updated_ok'),
						'buttons' => array(array('button_text' => lang('view').' Groups', 'link' => 'group/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Group '.lang('not_updated'),
						'buttons' => array(array('button_text' => lang('view').' Groups', 'link' => 'group/view')));
				$this->load->view('message', $data);
			}
		
		}
	
		$this->load->view('template/footer');
	
	}
	
	
	
	
	
	
	
	
	
	
	
	public function delete ($id = 0, $confirm = 0)
	{
	
		$this->user_model->require_permission('manage_groups');
	
		$this->lang->load('group');
		$this->load->model('group_model');
		
		$groupname = $this->data_model->get_value('group', 'name', $id);
		
		if ($confirm == 1)
		{
			
			//execute delete action
			$result = $this->group_model->delete($id);
	
			if ($result)
			{
	
				//deleted ok
	
				$this->log_model->add('delete_group', $id.': '.$groupname);
	
				$data = array('message_text' => 'Group '.lang('deleted_ok'),
						'buttons' => array(array('button_text' => lang('view').' Groups', 'link' => 'group/view')));
	
			}
			else
			{
	
				//not deleted
				$data = array('message_text' => 'Group '.lang('not_deleted'),
						'buttons' => array(array('type' => 'back', 'back_level' => 2)));
	
			}
	
		}
		else
		{
			//confirm delete
			$data = array(
					'message_text' => lang('confirm_delete').' <b>'.$groupname.'</b><br />'.lang('not_undoable'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'group/delete/'.$id.'/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));
	
		}
	
		$this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');
	
	}
	
	
	
	
	
	public function view_members ($groupid = 0)
	{
		
		$this->user_model->require_permission('manage_groups');
		
		$this->load->view('template/header');
		
		$this->load->model('group_model');
		$this->load->helper('form');

		
		if ($this->input->post('remove') && $this->input->post('in_group'))
		{
			
			//remove from group
			$ids = $this->input->post('in_group');
			$t = '<b>Removing users....</b><br /><br />';
			
			foreach ($ids as $userid)
			{
				
				$t .= $this->data_model->get_name($userid).'....';
				
				$result = $this->group_model->remove_user_from_group($userid, $groupid);
				
				if ($result)
				{
					$t .= 'OK';
				}
				else
				{
					$t .= 'FAILED!';
				}
				
				$t .= '<br />';
				
			}
			
			$data['message_text'] = $t;
			$this->load->view('message', $data);

			
		}
		else if ($this->input->post('add') && $this->input->post('available'))
		{
			
			//add to group
			$ids = $this->input->post('available');
			$t = '<b>Adding users....</b><br /><br />';
				
			foreach ($ids as $userid)
			{
			
				$t .= $this->data_model->get_name($userid).'....';
			
				$result = $this->group_model->add_user_to_group($userid, $groupid);
			
				if ($result)
				{
					$t .= 'OK';
				}
				else
				{
					$t .= 'FAILED!';
				}
			
				$t .= '<br />';
			
			}
				
			$data['message_text'] = $t;
			$this->load->view('message', $data);
			
		}
		
		
		$data['members'] = $this->group_model->get_members($groupid);
		$data['available'] = $this->group_model->get_not_in_group($groupid);
		$data['groupid'] = $groupid;
		$data['groupname'] = $this->data_model->get_value('group', 'name', $groupid);
		$this->load->view('group/view_members', $data);
		
		$this->load->view('template/footer');
		
	}
	
	
	

	
	
	public function import_groups ()
	{
		
		$this->user_model->require_permission('do_anything');
		$this->load->model('group_model');
		
		$this->load->view('template/header');
		
		$t = '<h3>Importing Groups....</h3>';
		
		$users = $this->user_model->get_users(false, 1000); //('all');
		
		foreach ($users as $user)
		{
			
			if ($user['groupid'])
			{
				
				$t .= '<b>Adding</b> user '.$user['id'].' to group '.$user['groupid'].'....';
				
				$result = $this->group_model->add_user_to_group($user['id'], $user['groupid']);
				
				if ($result)
				{
					$t.= 'OK';
				}
				else
				{
					$t .= '<span style="color:#df0000;">FAILED</span>';
				}
				
				$t .= '<hr />';
			}
			
		}
		
		$data['message_text'] = $t;
		$this->load->view('message', $data);
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	
	
	
}


?>