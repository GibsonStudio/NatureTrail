<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bug_tracker extends CI_Controller {


	public function index()
	{

	}



	public function view ($include_fixed = 0)
	{

		$this->user_model->require_permission('manage_bug_tracker');

		$this->load->model('bug_tracker_model');
		$this->lang->load('bug_tracker');

		$this->load->view('template/header');

		if ($include_fixed == 1) {
			$data['bugs'] = $this->bug_tracker_model->get();
		}
		else
		{
			$data['bugs'] = $this->bug_tracker_model->get_open();
		}

		$this->load->view('bug_tracker/view', $data);

		$this->load->view('template/footer');

	}




	public function add ()
	{

		$this->user_model->require_permission('manage_bug_tracker');

		$this->load->model('bug_tracker_model');
		$this->lang->load('bug_tracker');

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('comment', lang('comment'), 'trim|required');
		$this->form_validation->set_rules('priority', lang('priority'), 'required');

		$this->load->view('template/header');


		if ($this->form_validation->run() === false)
		{

			$this->load->view('bug_tracker/add');

		}
		else
		{

			$result = $this->bug_tracker_model->insert();

			if ($result === TRUE)
			{
        redirect('bug_tracker/view');
			}
			else
			{
				$data = array('message_text' => 'Bug '.lang('not_added'),
						'buttons' => array(array('button_text' => lang('back'), 'link' => 'bug_tracker/view')));
				$this->load->view('message', $data);
			}

		}

		$this->load->view('template/footer');

	}







	public function edit ($id = 0)
	{

		$this->user_model->require_permission('manage_bug_tracker');

		$this->load->model('bug_tracker_model');
		$this->lang->load('bug_tracker');

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('comment', lang('comment'), 'trim|required');
		$this->form_validation->set_rules('priority', lang('priority'), 'required');
		$this->form_validation->set_rules('fixed', lang('fixed'), 'required');

		$this->load->view('template/header');

		if ($this->form_validation->run() === false)
		{

			//show edit form
			$data['bug'] = $this->bug_tracker_model->get($id);
			$this->load->view('bug_tracker/edit', $data);

		}
		else
		{

			//run update query
			$result = $this->bug_tracker_model->update($id);

			if (!is_null($result))
			{
				redirect('bug_tracker/view');
			}
			else
			{
				$data = array('message_text' => 'Bug '.lang('not_updated'),
						'buttons' => array(array('button_text' => lang('back'), 'link' => 'bug_tracker/view')));
				$this->load->view('message', $data);
			}

		}

		$this->load->view('template/footer');

	}










	public function delete ($id = 0, $confirm = 0)
	{

		$this->user_model->require_permission('manage_bug_tracker');

		$this->lang->load('bug_tracker');
		$this->load->model('bug_tracker_model');

		if ($confirm == 1)
		{

			//execute delete action
			$result = $this->bug_tracker_model->delete($id);

			if ($result)
			{

				//deleted ok
				redirect('bug_tracker/view');

			}
			else
			{

				//not deleted
				$data = array('message_text' => 'Bug '.lang('not_deleted'),
						'buttons' => array(array('type' => 'back', 'back_level' => 2)));

			}

		}
		else
		{
			//confirm delete
			$data = array(
					'message_text' => lang('confirm_delete').' Bug: '.$id.'<br />'.lang('not_undoable'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'bug_tracker/delete/'.$id.'/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));

		}

		$this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');

	}







	public function purge ($confirm = 0)
	{

		$this->user_model->require_permission('manage_bug_tracker');

		$this->lang->load('bug_tracker');
		$this->load->model('bug_tracker_model');

		if ($confirm == 1)
		{

			//execute purge
			$purge_count = $this->bug_tracker_model->purge();

			$data = array('message_text' => $purge_count.lang('bug_purge_ok'),
						'buttons' => array(array('button_text' => lang('back'), 'link' => 'bug_tracker/view')));




		}
		else
		{

			//get purge confirmation
			$data = array(
					'message_text' => lang('confirm_bug_purge'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'bug_tracker/purge/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));

		}

		$this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');

	}















}

?>
