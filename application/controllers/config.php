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




  public function add ()
  {

    $this->user_model->require_permission('add_config_var');

    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('var', 'Var', 'required|trim');
    $this->form_validation->set_rules('value', 'Value', 'required|trim');

    $this->load->view('template/header');

    if ($this->form_validation->run() === false) {
      $this->load->view('config/add');
    } else {

      $result = $this->config_model->insert();

      if ($result) {

        $username = $this->data_model->get_name($result);
        $this->log_model->add('add_config_var', $result.': '.$username);
        redirect('config/view');

      }

    }

    $this->load->view('template/footer');

  }


  public function delete ($id = 0, $confirm = 0)
  {

    $this->user_model->require_permission('change_config');
    $name = $this->data_model->get_value('config', 'var', $id);

    if ($confirm) {

      $result = $this->config_model->delete($id);

      if ($result) {
        // deleted OK
        $this->log_model->add('delete_config', $id.': '.$name);
				redirect('config/view');
      } else {
        // not deleted
        //not deleted
				$data = array('message_text' => 'Config Var '.lang('not_deleted'),
						'buttons' => array(array('type' => 'back', 'back_level' => 2)));
      }

    } else {
      //confirm delete
			$data = array(
					'message_text' => lang('confirm_delete').' <b>'.$name.'</b><br />'.lang('not_undoable'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'config/delete/'.$id.'/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));
    }

    $this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');


  }



	public function edit ($id = 0)
	{

		$this->user_model->require_permission('change_config');

		$this->load->helper('form');
		$this->load->library('form_validation');

    $this->form_validation->set_rules('var', 'Var', 'trim|required');
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
        redirect('config/view');

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
