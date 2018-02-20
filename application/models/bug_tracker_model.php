<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bug_tracker_model extends CI_Model {
	
	
	public function __construct ()
	{
		parent::__construct();
	}
	
	
	
	public function insert ()
	{
		
		$timeraised = time();
		$raiserid = $this->user_model->get()->id;
		$comment = $this->input->post('comment');
		$priority = $this->input->post('priority');
		
		$sql = 'INSERT INTO {pre}bug_tracker (timeraised, raiserid, comment, priority) VALUES (?,?,?,?)';
		$data = array($timeraised, $raiserid, $comment, $priority);
		$this->db->query($sql, $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		
		return false;
		
	}
	
	
	
	public function update ($id = 0)
	{
		
		$comment = $this->input->post('comment');
		$priority = $this->input->post('priority');
		$fixed = $this->input->post('fixed');
		$timefixed = time();
		
		$sql = 'UPDATE {pre}bug_tracker SET comment=?, priority=?, fixed=?';
		$data = array($comment, $priority, $fixed);
		
		//has it been fixed?
		if ($fixed == 1)
		{
			$sql .= ', timefixed=?, fixerid=?';
			array_push($data, $timefixed);
			array_push($data, $this->user_model->get()->id);
		}
		
		//complete query
		$sql .= ' WHERE id=?';
		array_push($data, $id);
		
		//run query
		$this->db->query($sql, $data);
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		
		return false;
		
	}
	
	
	
	public function delete ($id = NULL)
	{
		
		$sql = 'DELETE FROM {pre}bug_tracker WHERE id=?';
		$this->db->query($sql, array($id));
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		
		return false;
		
	}
	
	
	
	
	
	public function get ($id = 0)
	{
		
		if ($id == 0)
		{
			
			//get all
			$result = $this->db->query('SELECT * FROM {pre}bug_tracker ORDER BY priority DESC, id DESC');
			return $result->result_array();
			
		}
		else
		{
			
			//get specific
			$sql = 'SELECT * FROM {pre}bug_tracker WHERE id=?';
			$result = $this->db->query($sql, array($id));
			return $result->row();			
			
		}
		
		
	}
	
	
	
	
	
	public function get_open ()
	{
		$result = $this->db->query('SELECT * FROM {pre}bug_tracker WHERE fixed=0 ORDER BY priority DESC, id DESC');
		return $result->result_array();
	}
	
	
	
	
	
	
	
	public function purge ()
	{
		
		$days = 30;
		$purge_time = time() - ($days * 24 * 60 * 60);
		$sql = 'DELETE FROM {pre}bug_tracker WHERE fixed=1 AND timefixed<?';
		$data = array($purge_time);
		$this->db->query($sql, $data);
		return $this->db->affected_rows();
		
	}
	
	
	
	
}

?>