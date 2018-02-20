<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Block extends CI_Controller {
	
	
	public function viewall ()
	{
		
		$this->user_model->require_permission('manage_blocks');
		
		$this->load->model('block_model');
		$this->lang->load('block');
		
		$this->load->view('template/header');
		
		$data['blocks'] = $this->block_model->get();
		$this->load->view('block/viewall', $data);
		
		$this->load->view('template/footer');		
		
	}
	
	
	
	
	
	
	
	
	public function add ()
	{

		$this->user_model->require_permission('manage_blocks');
		
		$this->load->model('block_model');
		$this->lang->load('block');
		
		$this->load->helper(array('form', 'myform'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('active', lang('active'), 'required');
		$this->form_validation->set_rules('position', lang('position'), 'required');
		$this->form_validation->set_rules('title', lang('title'), 'trim|required');
		$this->form_validation->set_rules('content', lang('content'), 'trim|required');
		$this->form_validation->set_rules('show_content_only', lang('show_content_only'), 'required');
		$this->form_validation->set_rules('sort', lang('sort'), 'required');
		
		$this->load->view('template/header');
		
		if ($this->form_validation->run() === false)
		{
			$this->load->view('block/add');
		}
		else
		{
			
			$result = $this->block_model->insert();
				
			if ($result === true)
			{
				$data = array('message_text' => 'Block '.lang('added_ok'),
						'buttons' => array(array('button_text' => lang('view').' Blocks', 'link' => 'block/viewall')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Block '.lang('not_added'),
						'buttons' => array(array('button_text' => lang('view').' Blocks', 'link' => 'block/viewall')));
				$this->load->view('message', $data);
			}
			
			
		}
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	
	
	
	
	public function edit ($block_id = 0)
	{

		$this->user_model->require_permission('manage_blocks');
		
		$this->load->model('block_model');
		$this->lang->load('block');
		
		$this->load->helper(array('form', 'myform'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('active', lang('active'), 'required');
		$this->form_validation->set_rules('position', lang('position'), 'required');
		$this->form_validation->set_rules('title', lang('title'), 'trim|required');
		$this->form_validation->set_rules('content', lang('content'), 'trim|required');
		$this->form_validation->set_rules('show_content_only', lang('show_content_only'), 'required');
		$this->form_validation->set_rules('sort', lang('sort'), 'required');
		
		$this->load->view('template/header');
		
		if ($this->form_validation->run() === false)
		{
			$data['block'] = $this->block_model->get(array('id' => $block_id));
			$this->load->view('block/edit', $data);
		}
		else
		{
			
			$result = $this->block_model->update($block_id);
			
			if (!is_null($result))
			{
				
				$this->log_model->add('edit_block');
				
				$data = array('message_text' => 'Block '.lang('updated_ok'),
						'buttons' => array(array('button_text' => lang('view').' Blocks', 'link' => 'block/viewall')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Block '.lang('not_updated'),
						'buttons' => array(array('button_text' => lang('view').' Blocks', 'link' => 'block/viewall')));
				$this->load->view('message', $data);
			}
			
		}
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	
	
	
	public function delete ($block_id = 0, $confirm = 0)
	{

		$this->user_model->require_permission('manage_blocks');
	
		$this->lang->load('block');
		$this->load->model('block_model');
	
		if ($confirm == 1)
		{
	
			//execute delete action
			$result = $this->block_model->delete($block_id);
	
			if ($result)
			{
	
				//deleted ok
				
				$this->log_model->add('delete_block');
				
				$data = array('message_text' => 'Block '.lang('deleted_ok'),
						'buttons' => array(array('button_text' => lang('view').' Blocks', 'link' => 'block/viewall')));
	
			}
			else
			{
	
				//not deleted
				$data = array('message_text' => 'Block '.lang('not_deleted'),
						'buttons' => array(array('type' => 'back', 'back_level' => 2)));
	
			}
	
		}
		else
		{
			//confirm delete
			$data = array(
					'message_text' => lang('confirm_delete').' Block: '.$block_id.'<br />'.lang('not_undoable'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'block/delete/'.$block_id.'/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));
	
		}
	
		$this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');
	
	}
	
	
	
	
	
	
	
	
	
}

?>