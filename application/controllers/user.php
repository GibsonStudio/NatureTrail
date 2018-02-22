<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {


    public function view ($userid = 0)
    {

        $this->lang->load('user');

        $this->user_model->require_login();
        $this->load->view('template/header');

        if ($userid == 0)
        {
        	$userid = $this->user_model->get()->id;
        }

	    //make sure user exists
	    if (!$this->data_model->record_exists('user', $userid))
	    {

	     	$data = array('message_text' => 'This user does not exist, was probably deteted!');
	       	$this->load->view('message', $data);
	       	$this->load->view('template/footer');
	       	return;

	    }



        $logged_in_user_id = $this->session->userdata('id');

        if ($logged_in_user_id != $userid)
        {
            //trying to view another user - check permission
            $this->user_model->require_permission('view_all_profiles');
        }

        //profile
        $data['user'] = $this->user_model->get(array('id' => $userid));
        $this->load->view('user/profile', $data);

        //footer
        $this->load->view('template/footer');

    }





    public function viewall ($page = 1)
    {

        $this->user_model->require_permission('view_all_profiles');

        $this->lang->load('user');

        $this->load->view('template/header');

        $user_count = $this->user_model->get_count();

        $users_per_page = 20;
        $offset = ($page - 1) * $users_per_page;

        $data['users'] = $this->user_model->get_users(true, $users_per_page, $offset);

        $data['page'] = $page;
        $data['users_per_page'] = $users_per_page;
        $data['user_count'] = $user_count;

        $this->load->view('user/viewall', $data);
        $this->load->view('template/footer');

    }








    public function add ()
    {

    	$this->user_model->require_permission('add_user');

    	$this->lang->load('user');

    	$this->load->helper('form');
    	$this->load->library('form_validation');

    	$this->form_validation->set_rules('firstname', lang('firstname'), 'trim|required');
    	$this->form_validation->set_rules('middlenames', lang('middlenames'), 'trim');
    	$this->form_validation->set_rules('lastname', lang('lastname'), 'trim|required');
    	$this->form_validation->set_rules('knownas', lang('knownas'), 'trim');
    	$this->form_validation->set_rules('password', lang('password'), 'trim|required');
    	$this->form_validation->set_rules('passconf', lang('password_confirm'), 'trim|required|matches[password]');
    	$this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email|callback_email_check');

    	$this->load->view('template/header');

    	if ($this->form_validation->run() === false)
    	{
    		$this->load->view('user/add');
    	}
    	else
    	{

    		$result = $this->user_model->insert();

    		if ($result)
    		{

    			$username = $this->data_model->get_name($result);
    			$this->log_model->add('add_user', $result.': '.$username);

    			$data =  array(
    					'message_text' => lang('user_created_ok'),
    					'buttons' => array(
    							array('button_text' => lang('view_users'), 'link' => 'user/viewall')
    					)
    			);

    			$this->load->view('message', $data);

    		}

    	}

    	$this->load->view('template/footer');

    }





    public function search ()
    {

    	$this->user_model->require_permission('view_all_profiles');

    	$this->lang->load('user');

    	$this->load->view('template/header');

    	$this->load->view('user/search');

    	$this->load->view('template/footer');

    }





    public function ajax_search_ACTIVE ()
    {

    	$search_string		= trim($this->input->post('search_string'));
    	$include_deleted	= $this->input->post('include_deleted');
    	$user_wildcards		= $this->input->post('user_wildcards');

    	$terms = explode(" ", $search_string);

    	$this->db->select('user.id,
				user.firstname,
				user.lastname,
				user.knownas,
				user.email,
				user.deleted,
				accesslevel.name AS accesslevel');

    	$this->db->from('user');
    	$this->db->join('accesslevel', 'accesslevel.id = user.accesslevel');

    	foreach ($terms as $term)
    	{
    		$this->db->or_like('firstname', $term);
    		$this->db->or_like('lastname', $term);
    		$this->db->or_like('knownas', $term);
    		$this->db->or_like('email', $term);
    		$this->db->or_like('accesslevel.name', $term);
    	}

    	$query = $this->db->get();
    	$users = $query->result_array();

    	$output = '<div class="usersearch_user_count">';


    	if (count($users) == 1) {
    		$output .= '1 user found.';
    	} else {
    		$output .= count($users).' users found.';
    	}

    	$output .= '</div>';
    	$output .= '<div class="usersearch_users_list">';

    	foreach ($users as $user)
    	{

    		$class = '';

    		if ($user['deleted'] == 1)
    		{
    			$class = ' usersearch_user_deleted';
    		}

    		$txt = $user['firstname'].' '.$user['lastname'];

    		if (!empty($user['knownas']))
    		{
    			$txt .= ' ('.$user['knownas'].')';
    		}

    		if (!empty($user['accountnumber']))
    		{
    			$txt .= ' '.$user['accountnumber'];
    		}

    		$txt .= ' ('.$user['email'].') ('.$user['accesslevel'].')';

    		$output .= '<div class="usersearch_user_default'.$class.'">'.anchor('user/view/'.$user['id'], $txt).'</div>';

    	}

    	$output .= '</div>';

    	echo $output;

    }




    public function ajax_search ()
    {

    	$search_string		= trim($this->input->post('search_string'));
    	$include_deleted	= $this->input->post('include_deleted');
    	$user_wildcards		= $this->input->post('user_wildcards');

    	$terms = explode(" ", $search_string);

    	$sql = 'SELECT
    			{pre}user.id,
				{pre}user.firstname,
				{pre}user.lastname,
				{pre}user.knownas,
				{pre}user.email,
				{pre}user.deleted,
				{pre}accesslevel.name AS accesslevel
    	 		FROM {pre}user
    	 		JOIN {pre}accesslevel ON {pre}accesslevel.id = {pre}user.accesslevel
    			WHERE ';

    	//add where
    	$add_or = '';
    	foreach ($terms as $term)
    	{
    		$sql .= $add_or;
    		$add_or = ' AND ';
    		$sql .= '(firstname LIKE ? OR lastname LIKE ? OR knownas LIKE ? OR email LIKE ? OR {pre}accesslevel.name LIKE ?)';
    	}

    	if ($include_deleted != 1)
    	{
    		$sql .= ' AND deleted<>1';
    	}

    	$data = array();

    	foreach ($terms as $term)
    	{

    		if ($user_wildcards != 1)
    		{
    			$term = '%'.$term.'%';
    		}

    		for ($i = 1; $i <= 6; $i++)
    		{
    			array_push($data, $term);
    		}

    	}

    	$users = $this->db->query($sql, $data)->result_array();

    	$output = '<div class="usersearch_user_count">';

    	if (count($users) == 1) {
    		$output .= '1 user found.';
    	} else {
    		$output .= count($users).' users found.';
    	}

    	$output .= '</div>';
    	$output .= '<div class="usersearch_users_list">';

    	foreach ($users as $user)
    	{

    		$class = '';

    		if ($user['deleted'] == 1)
    		{
    			$class = ' usersearch_user_deleted';
    		}

    		$txt = $user['firstname'].' '.$user['lastname'];

    		if (!empty($user['knownas']))
    		{
    			$txt .= ' ('.$user['knownas'].')';
    		}

    		if (!empty($user['accountnumber']))
    		{
    			$txt .= ' '.$user['accountnumber'];
    		}

    		$txt .= ' ('.$user['email'].') ('.$user['accesslevel'].')';

    		$output .= '<div class="usersearch_user_default'.$class.'">'.anchor('user/view/'.$user['id'], $txt).'</div>';

    	}

    	$output .= '</div>';

    	echo $output;

    }







    public function delete ($id = NULL, $confirm = false, $permanently_delete = false)
    {

        $this->user_model->require_permission('delete_user');

        $this->lang->load('user');

        $this->load->view('template/header');

        //last permission check - are they trying to edit a higher power?
        if (!$this->user_model->can_edit_user($id))
        {
        	redirect('access_denied');
        }

        //stop user from deleting themself

        if ($this->user_model->get()->id == $id)
        {
            $data = array('message_text' => lang('cannot_delete_self'),
                'buttons' => array(array('type' => 'back')));
        }
        else if ($confirm == 1)
        {

        	$username = $this->data_model->get_name($id);

            //execute delete action
            if ($permanently_delete == 1)
            {
            	$this->log_model->add('permanently_delete_user', $id.': '.$username);
            	$result = $this->user_model->delete_from_database($id);
            }
            else
            {
            	$this->log_model->add('delete_user', $id.': '.$username);
            	$result = $this->user_model->delete($id);
            }

            if ($result)
            {


                //deleted ok
                $data = array('message_text' => lang('user_deleted_ok'),
                    'buttons' => array(array('button_text' => lang('back'), 'link' => 'user/viewall')));

            }
            else
            {

                //not deleted
                $data = array('message_text' => lang('user_delete_failed'),
                    'buttons' => array(array('type' => 'back', 'back_level' => 2)));

            }

        }
        else
        {


        	if ($permanently_delete == 1)
        	{

        		//confirm permanently delete
        		$data = array(
        				'message_text' => lang('confirm_user_permanent_delete'),
        				'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'user/delete/'.$id.'/1/1'),
        						array('button_text' => lang('cancel'), 'type' => 'back')));

        	}
        	else
        	{

	            //confirm delete
	            $data = array(
	                'message_text' => lang('confirm_user_delete').' '.$id,
	                'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'user/delete/'.$id.'/1'),
	                    array('button_text' => lang('cancel'), 'type' => 'back')));

        	}



        }

        $this->load->view('message', $data);
        $this->load->view('template/footer');

    }





    public function edit ($userid = NULL)
    {

        $this->lang->load('user');

        //check permission
        $this->user_model->require_login();
        $userid = isset($userid) ? $userid : $this->input->post('id');

        if ($this->user_model->get()->id == $userid)
        {
        	//can edit themself?
            $this->user_model->require_permission('edit_profile');
        }
        else
        {

        	//trying to edit another user
        	$user_type = $this->data_model->get_value('user', 'accesslevel', $userid);
        	$user_type = $this->data_model->get_value('accesslevel', 'name', $user_type);

        	if (($user_type == 'Customer') && (!$this->user_model->has_permission('edit_all_profiles')))
        	{
        		$this->user_model->require_permission('edit_customer_profiles');
        	}
        	else
        	{
        		$this->user_model->require_permission('edit_all_profiles');
        	}

        }

        //last permission check - are they trying to edit a higher power?
        if (!$this->user_model->can_edit_user($userid))
        {
        	redirect('access_denied/index/higher_user_level');
        }

        $this->load->model('role_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->view('template/header');

        $this->form_validation->set_rules('firstname', lang('firstname'), 'trim|required');
        $this->form_validation->set_rules('middlenames', lang('middlenames'), 'trim');
        $this->form_validation->set_rules('lastname', lang('lastname'), 'trim|required');
        $this->form_validation->set_rules('knownas', lang('knownas'), 'trim');
        $this->form_validation->set_rules('password', lang('password'), 'matches[passconf]');
        $this->form_validation->set_rules('passconf', lang('password_confirm'), 'matches[password]');
        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email|callback_email_check['.$userid.']');
        $this->form_validation->set_rules('accesslevel', lang('accesslevel'), '');

        if ($this->form_validation->run() === false)
        {
            $data['user'] = $this->user_model->get(array('id' => $userid));
            $this->load->view('user/edit', $data);
        }
        else
        {

        	$email_updated = false;

        	if ($this->input->post('email') != $this->data_model->get_value('user', 'email', $userid))
        	{
        		$email_updated = true;
        	}

            $result = $this->user_model->update($userid);

            if ($result)
            {

            	if ($email_updated)
            	{
            		$this->send_confirm_email($this->input->post('id'));
            	}

            	if ($userid != $this->user_model->get()->id)
            	{
            		$username = $this->data_model->get_name($userid);
            		$this->log_model->add('edit_user', $userid.':'.$username);
            	}

                $data =  array(
                    'message_text' => lang('profile_update_ok'),
                    'buttons' => array(
                        array('button_text' => lang('view_user'), 'link' => 'user/view/'.$userid)
                    )
                );
                $this->load->view('message', $data);
            }

        }

        $this->load->view('template/footer');

    }


    public function register ()
    {

    	if ($this->config_model->get_config('allow_registration') != 1)
    	{
    		redirect("access_denied/index/registration_disabled");
    	}

        $this->lang->load('user');

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->view('template/header');

        $this->form_validation->set_rules('firstname', lang('firstname'), 'trim|required');
        $this->form_validation->set_rules('middlenames', lang('middlenames'), 'trim');
        $this->form_validation->set_rules('lastname', lang('lastname'), 'trim|required');
        $this->form_validation->set_rules('knownas', lang('knownas'), 'trim');
        $this->form_validation->set_rules('password', lang('password'), 'trim|required');
        $this->form_validation->set_rules('passconf', lang('password_confirm'), 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email|callback_email_check');

        if ($this->user_model->is_logged_in())
        {
        	//$this->load->view('template/header');
            $data =  array('message_text' => lang('already_registered'));
            $this->load->view('message', $data);
        }
        else if ($this->form_validation->run() == FALSE)
        {
        	//$this->load->view('template/header');
            $this->load->view('user/register');
        }
        else
        {

            $result = $this->user_model->insert();

            if ($result)
            {

            	//get new account and log in
            	$user = $this->user_model->get(array('id' => $result));
            	$this->session->set_userdata($user);

            	//send confirm email address email
            	$email_sent = $this->send_confirm_email($user->id);

            	if ($email_sent != 1)
            	{
            		$data = array('message_text' => 'Could not send email confirm!!');
            		$this->load->view('message', $data);
            	}

            	//inform user
            	$message = '<p>'.lang('greeting').' '.$user->firstname.lang('thanks').'</p><p>'.lang('registration_message').'</p>';

                $data =  array(
                    'message_text' => $message,
                    'buttons' => array(
                        array('button_text' => lang('view_my_profile'), 'link' => 'user/view')
                    )
                );

                $this->load->view('message', $data);

            }

        }

        $this->load->view('template/footer');

    }






    /*
    public function email ($userid = 0)
    {

    	$this->user_model->require_permission('email_user');

    	$this->load->view('template/header');





    	$this->load->view('template/footer');

    }
    */








    public function select ()
    {

    	$this->user_model->require_permission('select_users');

    	$this->load->view('template/header');

    	$this->load->helper(array('form', 'myform'));
    	$this->load->library('form_validation');

    	$this->form_validation->set_rules('accesslevel', 'Role', '');
    	$this->form_validation->set_rules('name', 'Name', '');
    	$this->form_validation->set_rules('email_confirmed', 'Email Confirmed', '');

    	//show search form
    	$this->form_validation->run();

    	$users = $this->session->userdata('selected_users') ? $this->session->userdata('selected_users') : array();
    	$data['users'] = $users;
    	$data['show_action_buttons'] = 0;


    	if ($users)
    	{
    		$data['show_action_buttons'] = 1;
    	}

    	//show search results
    	if ($this->form_validation->run() !== false)
    	{

    		$users = $this->user_model->search();
    		$data['users'] = $users;
    		$this->session->set_userdata(array('selected_users' => $users));

    		if ($users)
    		{
    			$data['show_action_buttons'] = 1;
    		}

    	}

    	//load views
    	$this->load->view('user/search_form', $data);
    	$this->load->view('user/search_results', $data);

    	$this->load->view('template/footer');

    }






    public function send_bulk_email ()
    {

    	$this->user_model->require_permission('send_bulk_emails');

    	$this->load->helper('form');
    	$this->load->library('form_validation');

    	$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
    	$this->form_validation->set_rules('content', 'Content', 'trim|required');

    	$users  = $this->session->userdata('selected_users') ? $this->session->userdata('selected_users') : array();
    	$data['users'] = $users;

    	$this->load->view('template/header');

    	if ($this->form_validation->run() === false)
    	{

    		//show email form
    		$this->load->model('email_model');
    		$data['templates'] = $this->email_model->get_templates();
    		$this->load->view('user/email_form', $data);

    		//show selected users
    		$this->load->view('user/send_bulk_email', $data);




    	}
    	else
    	{

    		//send emails
    		$message = '<h3>Sending email to '.count($users).' users....</h3>';
    		$this->load->view('message', array('message_text' => $message));

    		$subject = $this->input->post('subject');
    		$content = $this->input->post('content');

    		foreach ($users as $user)
    		{

    			$my_content = $content;

    			//replace any predefind vars
    			$my_content = $this->replace_email_vars($content, $user);

    			$username = $this->data_model->get_name($user['id']);
    			$message = 'Sending message to <b>'.$username.'</b> ('.$user['email'].')....<br />';
    			$sent = $this->send_email_to_user($user['email'], $subject, $my_content);

    			if ($sent == 1)
    			{
    				$message .= 'Email sent OK.';
    			}
    			else
    			{
    				$message .= 'Email Send FAILED!';
    			}

    			$this->load->view('message', array('message_text' => $message));

    		}


    	}

    	$this->load->view('template/footer');

    }




    private function replace_email_vars ($content = '', $user = array())
    {

    	$content = str_replace('[[NAME]]', $this->data_model->get_name($user['id']), $content);
    	$content = str_replace('[[FIRSTNAME]]', $user['firstname'], $content);
    	$content = str_replace('[[LASTNAME]]', $user['lastname'], $content);
    	$content = str_replace('[[EMAIL]]', $user['email'], $content);

    	return $content;

    }






    private function send_email_to_user ($email = '', $subject = 'NO SUBJECT', $content = 'NO CONTENT')
    {

    	$this->load->library('email');
    	$this->email->from('noreply@programs.caeoxfordinteractive.com', $this->user_model->get()->email);
    	$this->email->to($email);
    	$this->email->set_mailtype("html");
    	$this->email->subject($subject);

    	$message = '';
    	$message .= '<!DOCTYPE html>';
    	$message .= '<html>';
    	$message .= '<head><style>body{font-family:"Arial";}</style></head>';
    	$message .= '<body>';
    	$message .= $content;
    	$message .= '</body></html>';

    	$this->email->message($message);

    	if ($this->email->send())
    	{

    		//email sent ok
    		return 1;

    	}

    	return 0; //email send failed


    }






    private function send_confirm_email ($userid = 0)
    {

    	//get or set key, key is a 22 char random string

    	$key = trim($this->data_model->get_value('user', 'email_confirmed', $userid));
    	$email = $this->data_model->get_value('user', 'email', $userid);

    	if (empty($key))
    	{

    		$key = random_string('alpha', 22);
    		$result = $this->user_model->write_email_confirm_key($key, $userid);

    	}

    	//compose and send email

    	$this->load->library('email');
    	$this->email->from('noreply@programs.caeoxfordinteractive.com', 'caeoxfordinteractive.com Admin');
    	$this->email->to($email);
    	$this->email->set_mailtype("html");
    	$this->email->subject('programs.caeoxfordinteractive.com Confirm Email Address');
    	$confirm_link = base_url().'index.php/user/confirm_email/'.$key;

    	$message = '';
    	$message .= '<!DOCTYPE html>';
    	$message .= '<html>';
    	$message .= '<head><style>body{font-family:"Arial";}</style></head>';
    	$message .= '<body>';
    	$message .= '<h3>Confirm Email Address for programs.caeoxfordinteractive.com</h3>';
    	$message .= '<p>Please click the following link to confirm your email address and activate your account:</p>';
    	$message .= '<p><a href="'.$confirm_link.'">'.$confirm_link.'</a></p>';
    	$message .= '</body></html>';

    	$this->email->message($message);

    	if ($this->email->send())
    	{

    		//email sent ok
    		return 1;

    	}

    	return 0; //email send failed

    }





    public function confirm_email ($key = '')
    {

    	$this->lang->load('user');
    	$this->load->view('template/header');

    	$confirm = $this->user_model->confirm_email($key);

    	if ($confirm == 1)
    	{

    		//email confirmed ok
    		$data = array('message_text' => lang('email_confirm_ok'));

    		$programid = $this->session->userdata('programid') ? $this->session->userdata('programid') : '';

    		if (!empty($programid))
    		{
    			$buttons = array(array('button_text' => lang('continue_application'), 'link' => 'application/apply/'.$programid));
    			$data['buttons'] = $buttons;
    		}

    	}
    	else
    	{

    		//email confirm failed
    		$data = array('message_text' => lang('email_confirm_fail'));

    	}

    	$this->load->view('message', $data);
    	$this->load->view('template/footer');

    }




    public function request_send_confirm_email ($userid = NULL)
    {

    	$this->lang->load('user');
    	$this->load->view('template/header');

    	if ($this->user_model->get()->id != $userid)
    	{
    		$this->user_model->require_permission('send_confirm_email');
    	}

    	 //make sure that their email is not already confirmed
    	 if ($this->user_model->email_confirmed($userid))
    	 {

    	 	$data = array('message_text' => lang('email_already_confirmed'));
    	 	$this->load->view('message', $data);

    	 }
    	 else
    	 {

    	 	$email_sent = $this->send_confirm_email($userid);

    	 	if ($email_sent == 1)
    	 	{
    	 		$data = array('message_text' => lang('confirm_email_sent'));
    	 		$this->load->view('message', $data);
    	 	}
    	 	else
    	 	{
    	 		$data = array('message_text' => 'Could not send email confirm!!');
    	 		$this->load->view('message', $data);
    	 	}

    	 }

    	 $this->load->view('template/footer');

    }







    public function uploadprofileimage ($id)
    {

    	$this->user_model->require_login();

        $this->lang->load('user');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'required');

        $this->load->view('template/header');

        if ($this->user_model->has_permission('upload_profile_image'))
        {
            $this->load->view('user/upload_profile_image', array('id' => $id, 'error' => '' ));
        }
        else
        {
            $this->load->view('access_denied');
        }
        $this->load->view('template/footer');

    }



    function do_upload_profile_image ()
    {

        $this->user_model->require_permission('upload_profile_image');

        $this->lang->load('user');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->run();

        $id = $this->input->post('id');

        $config = array(
                'upload_path' => BASEPATH.'../images/profile/',
                'file_name' => 'user_'.$id,
                'allowed_types' => 'jpg|png',
                'max_size'	=> '1000KB',
                'max_width'  => '1000',
                'max_height'  => '1000',
                'overwrite' => TRUE
            );

	$this->load->library('upload', $config);

        $this->load->view('template/header');

        if ($this->upload->do_upload())
        {

            //upload image
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];

            //change value in user.profileimage
            $result = $this->user_model->update_profileimage($id, $filename);

            //delete any files with same name but different extension
            foreach (glob(BASEPATH.'../images/profile/'.$upload_data['raw_name'].'.*') as $my_file)
            {
                if (substr($my_file, -4) != $upload_data['file_ext'])
                {
                    //delete file
                    unlink($my_file);
                }
            }

            //render view
            $data =  array(
                'message_text' => lang('image_update_ok'),
                'buttons' => array(
                    array('button_text' => 'OK', 'link' => 'user/view/'.$id)
                )
            );
            $this->load->view('message', $data);

        }
        else
        {
            $data = array('error' => $this->upload->display_errors());
            $this->load->view('user/upload_profile_image', $data);
        }

        $this->load->view('template/footer');

    }




    public function email_check ($email, $userid = 0)
    {

        //emails will be used as login id so must be unique

        $sql = "SELECT * FROM {pre}user WHERE email=? AND id<>?";
        $query = $this->db->query($sql, array($email, $userid));

        if ($query->num_rows() == 0)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('email_check', 'Email must be unique.');
            return false;
        }

    }














    /* **** authentication **** */


    public function login ()
    {

        $this->lang->load('user');
        $this->load->helper('form');
        $this->load->library('form_validation');

        //set validation rules
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            //$this->load->view('template/header');
            $this->load->view('user/login');
        }
        else
        {

            //all data submitted, so check that it is valid

            $email = set_value('email');
            $passhash = md5(set_value('password'));

            if ($this->user_model->valid_login($email, $passhash))
            {

                //valid details so log in if not deleted

                $user = $this->user_model->get(array('email' => $email));

                //is user account deleted?
                if ($user->deleted == 1)
                {
                    //$this->load->view('template/header');
                    $data = array('message_text' => lang('account_deleted'));
                    $this->load->view('message', $data);
                }
                else
                {

                	//log in
                    $this->session->set_userdata($user);
                    $this->user_model->set_login_data($user->id);
                    $this->load->view('template/header');

                    //do we need to now redirect to desired url?
                    $url = $this->session->userdata('url_after_login') ? $this->session->userdata('url_after_login') : '';

                    if (!empty($url))
                    {
                    	$buttons = array(array('button_text' => 'Continue', 'link' => $url));
                    }
                    else
                    {
                    	$buttons = array(array('button_text' => 'Home', 'link' => 'home'));
                    }

                    $data = array('message_text' => lang('login_message'), 'buttons' => $buttons);
                    $this->load->view('message', $data);

                }

            }
            else
            {
                //invalid log in
                //$this->load->view('template/header');

                $error = '';
                $error .= '<div class="login_error_message">'.lang('invalid_login').'</div><br /><br />';
                $error .= anchor('user/forgotten_password', lang('forgotten_password')).'<br />';

                $data = array('error' => $error);
                $this->load->view('user/login', $data);
            }

        }

        //$this->load->view('template/footer');

    }






    public function logout ($confirm = NULL)
    {

    	if ($confirm == 1)
    	{

    		//logout
    		$this->user_model->set_logout_data($this->user_model->get()->id);
    		$this->session->sess_destroy();
    		$this->load->view('template/header');
    		$data = array('message_text' => lang('logout_message'),
    				'buttons' => array(array('button_text' => lang('home'), 'link' => 'home')));
    		$this->load->view('message', $data);

    	}
    	else
    	{

    		//show confirmation message
    		$this->load->view('template/header');
    		$data = array('message_text' => lang('confirm_logout'),
    				'buttons' => array(
    						array('button_text' => lang('confirm'), 'link' => 'user/logout/1'),
    						array('type' => 'back', 'button_text' => lang('cancel'))
    						));
    		$this->load->view('message', $data);

    	}

    	$this->load->view('template/footer');

    }







    public function forgotten_password ()
    {

    	$this->load->view('template/header');

    	$this->lang->load('user');
    	$this->load->helper(array('form', 'myform'));
    	$this->load->library('form_validation');

    	$this->form_validation->set_rules('email', lang('email'), 'required|callback_email_reset_check');

    	if ($this->form_validation->run() === false)
    	{

    		$this->load->view('user/forgotten_password');

    	}
    	else
    	{

    		$email = $this->input->post('email');
    		$key = trim($this->data_model->get_value('user', 'password_reset_key', $email, 'email'));

    		if (empty($key))
    		{

	    		$key = random_string('alpha', 22);
	    		$result = $this->user_model->write_key($key, $email);

	    		if ($result != 1)
	    		{

	    			//key not added to database so warn user and abort email send - this shouldn't ever happen
	    			$data = array('message_text' => lang('reset_key_fail'),
	    					'buttons' => array(array('type' => 'back')));
	    			$this->load->view('message', $data);
	    			$this->load->view('template/footer');
	    			return;

	    		}

    		}


    		//send reset link to user
    		$this->load->library('email');
    		$this->email->from('noreply@programs.caeoxfordinteractive.com', 'caeoxfordinteractive.com Admin');
    		$this->email->to($email);
    		$this->email->set_mailtype("html");
    		$this->email->subject('programs.caeoxfordinteractive.com password reset');
    		$reset_link = base_url().'index.php/user/reset_password/'.$key;

    		$message = '';
    		$message .= '<!DOCTYPE html>';
    		$message .= '<html>';
    		$message .= '<head><style>body{font-family:"Arial";}</style></head>';
    		$message .= '<body>';
    		$message .= '<h3>Password Reset for programs.caeoxfordinteractive.com</h3>';
    		$message .= '<p>Please click the following link to reset your password:</p>';
    		$message .= '<p><a href="'.$reset_link.'">'.$reset_link.'</a></p>';
    		$message .= '<p>If you did not request this password reset please inform a site admin: <a href="mailto:jon.williams@cae.com">jon.williams@cae.com</a></p>';
    		$message .= '</body></html>';

    		$this->email->message($message);

    		if ($this->email->send())
    		{

    			//email sent ok
    			$data = array('message_text' => lang('reset_email_ok'),
    					'buttons' => array(array('button_text' => lang('login'), 'link' => 'login')));

    		}
    		else
    		{

    			//email not sent
    			$data = array('message_text' => lang('reset_email_fail'),
    					'buttons' => array(array('type' => 'back')));


    		}

    		$this->load->view('message', $data);

    	}

    	$this->load->view('template/footer');

    }





    private function email_reset_check ($email = NULL)
    {

    	//emails will be used as login id so must be unique

    	$sql = "SELECT * FROM {pre}user WHERE email=?";
    	$query = $this->db->query($sql, array($email));

    	if ($query->num_rows() == 1)
    	{
    		return true;
    	}
    	else
    	{
    		$this->form_validation->set_message('email_reset_check', lang('account_not_exist'));
    		return false;
    	}

    }








    public function reset_password ($key = '')
    {

    	$this->lang->load('user');
    	$this->load->helper(array('form', 'myform'));
    	$this->load->library('form_validation');

    	$this->form_validation->set_rules('password', lang('password'), 'trim|required');
        $this->form_validation->set_rules('passconf', lang('password_confirm'), 'trim|required|matches[password]');

    	$this->load->view('template/header');

    	if ($this->form_validation->run() === false)
    	{

    		$data['key'] = $key;
    		$this->load->view('user/reset_password', $data);

    	}
    	else
    	{

    		$result = $this->user_model->reset_password(); //send back a result string
    		$data = array('message_text' => $result, 'buttons' => array(array('button_text' => lang('login'), 'link' => 'user/login')));
    		$this->load->view('message', $data);

    	}


    	$this->load->view('template/footer');


    }

















}

?>
