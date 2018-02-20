<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission_model extends CI_Model {
	
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	
	
	
	public function get ($id = 0)
	{
		
		if ($id == 0)
		{
			
			$result = $this->db->query('SELECT * FROM {pre}permissions ORDER BY sort, heading DESC, name');
    		return $result->result_array();
			
		}
		else
		{
			
			$sql = 'SELECT * FROM {pre}permissions WHERE id=?';
			$data = array($id);
			$result = $this->db->query($sql, $data);
			return $result->row();
			
		}
		
		
	}
	
	
	
	
	
	public function insert ()
	{
		 
		$name 			= $this->input->post('name');
		$description	= $this->input->post('description');
		$heading		= $this->input->post('heading');
		$sort 			= $this->input->post('sort');	
		 
		$sql = 'INSERT INTO {pre}permissions (name, description, heading, sort) VALUES (?,?,?,?)';
		 
		$data = array($name, $description, $heading, $sort);
		 
		$this->db->query($sql, $data);
		 
		if ($this->db->affected_rows() > 0)
		{
			return $this->db->insert_id();
		}
		 
		return false;
		 
	}
	
	
	
	
	public function update ($id = 0)
	{

		$name 			= $this->input->post('name');
		$description	= $this->input->post('description');
		$heading		= $this->input->post('heading');
		$sort 			= $this->input->post('sort');
		 
		$sql = 'UPDATE {pre}permissions SET name=?, description=?, heading=?, sort=? WHERE id=?';
		 
		$data = array($name, $description, $heading, $sort, $id);
		 
		$this->db->query($sql, $data);
		 
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		 
		return false;
		 
	}
	
	
	
	public function delete ($id)
	{
		 
		$this->db->query('DELETE FROM {pre}permissions WHERE id=?', array($id));
		 
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
	
		return false;
		 
	}
	
	
	
	
}

?>
