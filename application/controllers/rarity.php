<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rarity extends CI_Controller {


	public function view ()
	{

		$this->user_model->require_login();
		$this->user_model->require_permission('manage_rarity');

		$this->load->view('template/header');

		$data['rarities'] = $this->rarity_model->get();
		$this->load->view('rarity/view', $data);

		$this->load->view('template/footer');


	}





	public function add ()
	{

		$this->user_model->require_login();
		$this->user_model->require_permission('manage_rarity');

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('value', 'Value', 'trim|required');

		$this->load->view('template/header');

		if ($this->form_validation->run() === false)
		{

			$this->load->view('rarity/add');

		}
		else
		{

			$result = $this->rarity_model->insert();

			if ($result)
			{

				$name = $this->data_model->get_value('rarity', 'name', $result);
				$this->log_model->add('add_rarity', $result.': '.$name);

				$data = array('message_text' => 'Rarity '.lang('added_ok'),
						'buttons' => array(array('button_text' => lang('view').' Rarities', 'link' => 'rarity/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Rarity '.lang('not_added'),
						'buttons' => array(array('button_text' => lang('view').' Rarities', 'link' => 'rarity/view')));
				$this->load->view('message', $data);
			}


		}

		$this->load->view('template/footer');


	}











	public function edit ($id = 0)
	{

		$this->user_model->require_permission('manage_rarity');

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('value', 'Value', 'trim|required');

		$this->load->view('template/header');

		if ($this->form_validation->run() === false)
		{
      $data['id'] = $id;
			$data['rarity'] = $this->rarity_model->get($id);
      print_r($data);
			$this->load->view('rarity/edit', $data);
		}
		else
		{

			$result = $this->rarity_model->update($id);

			if (!is_null($result))
			{

				$rarity = $this->data_model->get_value('rarity', 'name', $id);
				$this->log_model->add('update_rarity', $id.': '.$rarity);

				$data = array('message_text' => 'Rarity '.lang('updated_ok'),
						'buttons' => array(array('button_text' => lang('view').' Raritites', 'link' => 'rarity/view')));
				$this->load->view('message', $data);
			}
			else
			{
				$data = array('message_text' => 'Rarity '.lang('not_updated'),
						'buttons' => array(array('button_text' => lang('view').' Rarities', 'link' => 'rarity/view')));
				$this->load->view('message', $data);
			}

		}

		$this->load->view('template/footer');


	}











	public function delete ($id = 0, $confirm = 0)
	{

		$this->user_model->require_permission('manage_rarity');
		$name = $this->data_model->get_value('rarity', 'name', $id);

		if ($confirm == 1)
		{

			//execute delete action
			$result = $this->rarity_model->delete($id);

			if ($result)
			{

				//deleted ok

				$this->log_model->add('delete_rarity', $id.': '.$name);

				$data = array('message_text' => 'Rarity '.lang('deleted_ok'),
						'buttons' => array(array('button_text' => lang('view').' Rarities', 'link' => 'rarity/view')));

			}
			else
			{

				//not deleted
				$data = array('message_text' => 'Rarity '.lang('not_deleted'),
						'buttons' => array(array('type' => 'back', 'back_level' => 2)));

			}

		}
		else
		{
			//confirm delete
			$data = array(
					'message_text' => lang('confirm_delete').' <b>'.$name.'</b><br />'.lang('not_undoable'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'rarity/delete/'.$id.'/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));

		}

		$this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');

	}










}


?>
