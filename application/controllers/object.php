<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Object extends CI_Controller {


	public function index ()
	{
		$this->load->view('template/header');
		$this->load->view('template/footer');
	}







	public function viewall ($page = 1)
	{

		$this->user_model->require_permission('manage_objects');

		$this->load->view('template/header');

        $object_count = $this->object_model->get_count();

        $objects_per_page = 20;
        $offset = ($page - 1) * $objects_per_page;

        $data['objects'] = $this->object_model->get_objects($objects_per_page, $offset);

        $data['page'] = $page;
        $data['objects_per_page'] = $objects_per_page;
        $data['object_count'] = $object_count;

        $this->load->view('object/viewall', $data);
        $this->load->view('template/footer');

	}





	public function view ($id = 0)
	{

		$this->load->view('template/header');

		$object = $this->object_model->get($id);
		$data['object'] = $object;
		$this->load->view('object/view', $data);

		$this->load->view('template/footer');

	}









	public function add ()
	{

		$this->user_model->require_permission('add_object');
		$this->load->helper('form');
		$this->load->library('form_validation');

		//ini form validation
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim');
		$this->form_validation->set_rules('rarity', 'Rarity', 'trim|required');

		//ini file upload
		$upload_dir = object_dir();
		$file_ext = $this->config_model->get_config('allowed_image_extensions');

		$config = array(
				'upload_path' => $upload_dir,
				'allowed_types' => $file_ext
		);

		$this->load->library('upload', $config);

		$this->load->view('template/header');

		$form_valid = $this->form_validation->run();
		$show_form = true;
		$data = [];


		//has form been submitted?
		if ($this->input->post('submit'))
		{

			if ($form_valid)
			{

				if ($this->upload->do_upload('my_file'))
				{

					//add data to database
					$insert_id = $this->object_model->insert();



					//upload and rename file
					if ($insert_id)
					{

						$upload_data = $this->upload->data();
						$filename = $upload_data['file_name'];
						$new_name = $insert_id.'_'.$filename;

						//delete any files with same name but different extension
						/*
						foreach (glob($upload_dir.$new_name) as $my_file)
						{
							if (substr($my_file, -4) != $upload_data['file_ext'])
							{
								//delete file
								unlink($my_file);
							}
						}
						*/

						//rename file
						$upload_ok = rename($upload_dir.$filename, $upload_dir.$new_name);


					}
					else
					{
						$upload_ok = false;
					}



					//update filename in database
					if ($insert_id && $upload_ok)
					{
						$update_ok = $this->object_model->set_filename($insert_id, $new_name);
					}
					else
					{
						$update_ok = false;
					}


					//report success / errors to user
					if ($insert_id && $upload_ok && $update_ok)
					{

            redirect("object/viewall");
            
						//$name = $this->data_model->get_value('object', 'name', $insert_id);
						//$this->log_model->add('add_object', $insert_id.': '.$name);

						//$data = array('message_text' => 'Object '.lang('added_ok'),
						//		'buttons' => array(array('button_text' => lang('view').' Objects', 'link' => 'object/viewall')));
						//$this->load->view('message', $data);

					}
					else
					{

						$message = 'Object '.lang('not_added').'<br />';
						$message .= 'insert_id: '.$insert_id.'<br />';
						$message .= 'upload_ok: '.$upload_ok.'<br />';
						$message .= 'update_ok: '.$update_ok.'<br />';
						$data = array('message_text' => $message,
								'buttons' => array(array('button_text' => lang('view').' Objects', 'link' => 'object/viewall')));
						$this->load->view('message', $data);

					}

					$show_form = false;



				}
				else
				{
					$data['upload_errors'] = $this->upload->display_errors();
				}

			}

		}







		//show form?
		if ($show_form)
		{
			$this->load->view('object/add', $data);
		}

		$this->load->view('template/footer');

	}












	public function edit ($id = 0)
	{

		$this->user_model->require_permission('edit_object');

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim');
		$this->form_validation->set_rules('rarity', 'Rarity', 'trim|required');

		$this->load->view('template/header');

		if ($this->form_validation->run() === false)
		{
			$data['object'] = $this->object_model->get($id);
			$this->load->view('object/edit', $data);
		}
		else
		{

			if (!empty($_FILES['my_file']['name']))
			{

				//TODO need to upload new file and update database
				$upload_dir = object_dir();
				$file_ext = $this->config_model->get_config('allowed_image_extensions');

				$config = array(
						'upload_path' => $upload_dir,
						'allowed_types' => $file_ext
				);

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('my_file'))
				{

					$upload_data = $this->upload->data();
					$filename = $upload_data['file_name'];
					$new_name = $id.'_'.$filename;

					if (file_exists(object_dir().$new_name))
					{
						unlink(object_dir().$new_name);
					}

					//delete current file
					$current_file = object_dir().$this->data_model->get_value('object', 'filename', $id);
					if (file_exists($current_file))
					{
						unlink($current_file);
					}

					//rename file
					$upload_ok = rename($upload_dir.$filename, $upload_dir.$new_name);

					//update filename in database
					if ($upload_ok)
					{
						$update_ok = $this->object_model->set_filename($id, $new_name);
					}
					else
					{
						$update_ok = false;
					}

				}
				else
				{
					$upload_ok = false;
					echo $this->upload->display_errors();
				}

			}
			else {
				$upload_ok = true;
				$update_ok = true;
			}


			$result = $this->object_model->update($id);

			$message = '';
			if ($upload_ok == false)
			{
				$message .= '<br />ERROR: upload failed!';
			}
			if ($update_ok == false)
			{
				$message .= '<br />ERROR: file rename failed!';
			}

			if (!is_null($result))
			{

        redirect("object/viewall");

			}
			else
			{
				$data = array('message_text' => 'Object '.lang('not_updated').$message,
						'buttons' => array(array('button_text' => lang('view').' Objects', 'link' => 'object/viewall')));
				$this->load->view('message', $data);
			}

		}

		$this->load->view('template/footer');


	}









	public function delete ($id = 0, $confirm = 0)
	{

		$this->user_model->require_permission('delete_object');

		$name = $this->data_model->get_value('object', 'name', $id);

		if ($confirm == 1)
		{


			//delete image file
			$file = $this->data_model->get_value('object', 'filename', $id);
			if (!empty($file))
			{
				$file = object_dir().$file;
				if (file_exists($file))
				{
					unlink($file);
				}
			}


			//execute delete action
			$result = $this->object_model->delete($id);

			if ($result)
			{

				//deleted ok

				$this->log_model->add('delete_object', $id.': '.$name);

				$data = array('message_text' => 'Object '.lang('deleted_ok'),
						'buttons' => array(array('button_text' => lang('view').' Objects', 'link' => 'object/viewall')));

			}
			else
			{

				//not deleted
				$data = array('message_text' => 'Object '.lang('not_deleted'),
						'buttons' => array(array('type' => 'back', 'back_level' => 2)));

			}

		}
		else
		{
			//confirm delete
			$data = array(
					'message_text' => lang('confirm_delete').' <b>'.$name.'</b><br />'.lang('not_undoable'),
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'object/delete/'.$id.'/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));

		}

		$this->load->view('template/header');
		$this->load->view('message', $data);
		$this->load->view('template/footer');

	}










}


?>
