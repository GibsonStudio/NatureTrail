<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trail extends CI_Controller {
	
	
	
	
	public function view ($id = 0)
	{
		
		$this->user_model->require_permission('view_trail');
		$this->load->model('trail_model');
		
		$this->load->view('template/header');
		
		$trail = $this->trail_model->get($id);
		$objects = $this->trail_model->get_objects($id); 
		
		$data['trail'] = $trail;
		$data['objects'] = $objects;
		$this->load->view('trail/view', $data);
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	public function viewall ()
	{
		
		$this->user_model->require_permission('view_trail');
		$this->load->model('trail_model');
		$this->load->model('availability_model');
		
		$this->load->view('template/header');
		
		$data['trails'] = $this->trail_model->get();
		$this->load->view('trail/viewall', $data);
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	public function add ()
	{
		
		$this->user_model->require_permission('manage_trails');		
		$this->load->model('trail_model');
		$this->load->model('availability_model');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim');
		$this->form_validation->set_rules('availability', 'Availability', 'trim|required');

		
		$this->load->view('template/header');
		
		if ($this->form_validation->run() === false)
		{
			$this->load->view('trail/add');
		}
		else
		{
				
			$result = $this->trail_model->insert();
		
			if ($result)
			{
				
				$trailname = $this->data_model->get_value('trail', 'name', $result);
				$this->log_model->add('add_trail', $result.': '.$trailname);
				
				$data = array('message_text' => 'Trail '.lang('added_ok'),
						'buttons' => array(array('button_text' => lang('view').' Trails', 'link' => 'trail/viewall')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Trail '.lang('not_added'),
						'buttons' => array(array('button_text' => lang('view').' Trails', 'link' => 'trail/viewall')));
				$this->load->view('message', $data);
			}
								
		}
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	
	
	
	
	
	
	public function edit ($id = 0)
	{
	
		$this->user_model->require_permission('manage_trails');	
		$this->load->model('trail_model');
		$this->load->model('availability_model');
	
		$this->load->helper('form');
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim');
		$this->form_validation->set_rules('availability', 'Availability', 'trim|required');	
	
		$this->load->view('template/header');
	
		if ($this->form_validation->run() === false)
		{
			$data['trail'] = $this->trail_model->get($id);
			$this->load->view('trail/edit', $data);
		}
		else
		{
	
			$result = $this->trail_model->update($id);
	
			if (!is_null($result))
			{
	
				$trailname = $this->data_model->get_value('trail', 'name', $id);
				$this->log_model->add('update_trail', $id.': '.$trailname);
	
				$data = array('message_text' => 'Trail '.lang('updated_ok'),
						'buttons' => array(array('button_text' => lang('view').' Trails', 'link' => 'trail/viewall')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Trail '.lang('not_updated'),
						'buttons' => array(array('button_text' => lang('view').' Trails', 'link' => 'trail/viewall')));
				$this->load->view('message', $data);
			}
		
		}
	
		$this->load->view('template/footer');
	
	}
	
	
	
	
	
	
	
	
	
	
	
	public function delete ($id = 0, $confirm = 0)
	{
	
		$this->user_model->require_permission('manage_trails');
		$this->load->model('trail_model');
		
		$trailname = $this->data_model->get_value('trail', 'name', $id);
		
		if ($confirm == 1)
		{
			
			//execute delete action
			$result = $this->trail_model->delete($id);
	
			if ($result)
			{
	
				//deleted ok
	
				$this->log_model->add('delete_trail', $id.': '.$trailname);
	
				$data = array('message_text' => 'trail '.lang('deleted_ok'),
						'buttons' => array(array('button_text' => lang('view').' Trails', 'link' => 'trail/viewall')));
	
			}
			else
			{
	
				//not deleted
				$data = array('message_text' => 'trail '.lang('not_deleted'),
						'buttons' => array(array('type' => 'back', 'back_level' => 2)));
	
			}
	
		}
		else
		{
			//confirm delete
			$data = array(
					'message_text' => lang('confirm_delete').' <b>'.$trailname.'</b><br />'.lang('not_undoable'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'trail/delete/'.$id.'/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));
	
		}
	
		$this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');
	
	}
	
	
	
	
	
	
	

	public function view_objects ($trailid = 0)
	{
	
		$this->user_model->require_permission('manage_trail');
	
		$this->load->view('template/header');
	
		$this->load->model('trail_model');
		$this->load->helper('form');
	
	
		if ($this->input->post('remove') && $this->input->post('in_trail'))
		{
				
			//remove from group
			$ids = $this->input->post('in_trail');
			$t = '<b>Removing objects....</b><br /><br />';
				
			foreach ($ids as $objectid)
			{
	
				$t .= $objectid.'....';
	
				$result = $this->trail_model->remove_object_from_trail($objectid, $trailid);
	
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
			$t = '<b>Adding objects....</b><br /><br />';
	
			foreach ($ids as $objectid)
			{
					
				$t .= $objectid.'....';
					
				$result = $this->trail_model->add_object_to_trail($objectid, $trailid);
					
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
	
	
		$data['objects'] = $this->trail_model->get_objects($trailid);
		$data['available'] = $this->trail_model->get_not_in_trail($trailid);
		$data['trailid'] = $trailid;
		$data['trailname'] = $this->data_model->get_value('trail', 'name', $trailid);
		$this->load->view('trail/view_objects', $data);
	
		$this->load->view('template/footer');
	
	}
	
	
	
	
	
	
	
	
}


?>