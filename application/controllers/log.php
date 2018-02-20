<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log extends CI_Controller {
	
	
	public function index ()
	{
		redirect('log/view');
	}
	
	
	
	public function view ($page = 1, $userid = 0) {
		
		$this->user_model->require_login();
		$this->user_model->require_permission('view_logs');
		
		$this->load->view('template/header');
		
		$log_count = $this->log_model->get_count($userid);
		
		$logs_per_page = 20;
		$offset = ($page - 1) * $logs_per_page;
		
		$data['logs'] = $this->log_model->get_logs($logs_per_page, $offset, $userid);
		
		$data['userid'] = $userid;
		$data['page'] = $page;
		$data['logs_per_page'] = $logs_per_page;
		$data['log_count'] = $log_count;
		
		$this->load->view('log/viewall', $data);
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	public function purge ($confirm = 0)
	{
		
		$this->user_model->require_login();
		$this->user_model->require_permission('purge_logs');
		
		$this->load->view('template/header');
		
		//get logs to delete
		$sql = 'SELECT * FROM {pre}log WHERE timestamp<?';
		$time = time() - (30 * 60 * 60 * 24);
		$data = array($time);
		$query = $this->db->query($sql, $data);
		$logs = $query->result_array();
		
		
		
		if ($confirm != 1)
		{
			
			//confirm purge
			$data = array(
					'message_text' => 'Confirm purge logs?<br /><br />Do not do this unless you know what the implications are!!!',
					'buttons' => array(array('button_text' => lang('confirm'), 'link' => 'log/purge/1'),
							array('button_text' => lang('cancel'), 'type' => 'back')));
			$this->load->view('message', $data);
			
			
			//show logs that will be deleted
			$t = '<b>Logs to be deleted....</b><br /><br />';
				
			foreach ($logs as $log)
			{			
				$t .= $log['id'].' '.$log['action'].' '.$log['data'].'<br />';					
			}
				
			$data['message_text'] = $t;
			$data['buttons'] = array();
			$this->load->view('message', $data);
			
			
			
			
			
		}
		else
		{
			
			//run purge action
			$t = '<b>Deleting logs....</b><br /><br />';			
			
			foreach ($logs as $log)
			{
				
				$t .= '<b>Deleting log:</b> '.$log['id'].' '.$log['action'].' '.$log['data'].'<br />';	

				$this->db->query('DELETE FROM {pre}log WHERE id=?', array($log['id']));
				
				if ($this->db->affected_rows() > 0)
				{
					$t .= 'Log deleted.';
				}
				else
				{
					$t .= '<span style="color:#df0000;">NOT DELETED!</span>';
				}
				$t .= '<hr />';
					
			}
			
			$t .= 'Done.';
			
			$data['message_text'] = $t;
			$this->load->view('message', $data);			
			
		}
		
		
		
		
		$this->load->view('template/footer');
		
	}
	
	
	
	
	
	
	
	
}

?>