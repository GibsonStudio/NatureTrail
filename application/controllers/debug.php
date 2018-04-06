<?php

class Debug extends CI_Controller {


    public function index ()
    {

        $this->user_model->require_permission('view_debug');

        $this->load->view('template/header');

        $data = array('message_text' => 'Debug Index');
        $this->load->view('message', $data);

        $this->load->view('template/footer');

    }




    public function view_session_data ()
    {

        $this->user_model->require_permission('view_debug');

        $this->load->view('template/header');

        $data['all_data'] = $this->session->all_userdata();
        $this->load->view('debug/view_session_data', $data);

        $this->load->view('template/footer');

    }





    public function update_database ($confirm = 0)
    {

    	$this->user_model->require_permission('update_database');

    	$this->load->view('template/header');

    	if ($confirm != 1)
    	{

    		$data = array(
    				'message_text' => 'Confirm update database?<br /><br />Do not do this unless you know what the implications are!!!',
    				'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'debug/update_database/1'),
    						array('button_text' => lang('cancel'), 'type' => 'back')));
    		$this->load->view('message', $data);

    	}
    	else
    	{

        //$sql = 'ALTER TABLE nt_bug_tracker MODIFY fixerid INT DEFAULT 0';
        //$result = $this->db->simple_query($sql);
        //$data = array('message_text' => $sql.'<hr />'.$result);
    		//$this->load->view('message', $data);


        //$sql = 'ALTER TABLE nt_object ADD createdBy INT AFTER rarity, ADD modifiedBy INT AFTER createdBy';
        //$result = $this->db->simple_query($sql);
        //$data = array('message_text' => $sql.'<hr />'.$result);
    		//$this->load->view('message', $data);

        //$sql = 'ALTER TABLE nt_object ADD timemodified INT AFTER createdBy';
        //$result = $this->db->simple_query($sql);
        //$data = array('message_text' => $sql.'<hr />'.$result);
    		//$this->load->view('message', $data);

        $sql = 'ALTER TABLE nt_object CHANGE timestamp timecreated INT';
        $result = $this->db->simple_query($sql);
        $data = array('message_text' => $sql.'<hr />'.$result);
    		$this->load->view('message', $data);

    	}

    	$this->load->view('template/footer');

    }





    public function view_changelog ()
    {

    	$this->user_model->require_permission('see_admin_menu');

    	$this->load->view('template/header');
    	$this->load->view('debug/changelog');
    	$this->load->view('template/footer');

    }








    public function test ()
    {

    	$this->load->view('template/header');

      $data['userid'] = $this->session->userdata['id'];

    	$this->load->view('debug/test', $data);
    	$this->load->view('template/footer');

    }








}

?>
