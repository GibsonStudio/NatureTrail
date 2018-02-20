<?php if (!defined('BASEPATH')) exit('No direct script access allowed!');

class Availability_model extends CI_Model {

	public function __construct ()
	{
		parent::__construct();
	}
	
	
	public function get ($id = 0)
	{
		
		if ($id != 0)
		{
				
			//specific
			$sql = 'SELECT * FROM {pre}availability WHERE id=?';
			$data = array($id);
			$query = $this->db->query($sql, $data);
			return $query->row();
				
		}
		else
		{
				
			//all
			$sql = 'SELECT * FROM {pre}availability ORDER BY sort ASC, name';
			$query = $this->db->query($sql);
			return $query->result_array();
				
		}
		
	}
	
	
	
	
	public function insert ()
	{
	
		$name	= $this->input->post('name');
		$sort	= $this->input->post('sort');
	
		$sql = 'INSERT INTO {pre}availability (name, sort) VALUES (?,?)';
	
		$data = array($name, $sort);
	
		$this->db->query($sql, $data);
	
		if ($this->db->affected_rows() > 0)
		{
			return $this->db->insert_id();
		}
	
		return false;
	
	}
	
	
	
	
	public function update ($id = 0)
	{
	
		$name	= $this->input->post('name');
		$sort	= $this->input->post('sort');
	
		$sql = 'UPDATE {pre}availability SET name=?, sort=? WHERE id=?';
	
		$data = array($name, $sort, $id);
	
		$this->db->query($sql, $data);
	
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
	
		return false;
	
	}
	
	
	public function delete ($id)
	{
	
		$this->db->query('DELETE FROM {pre}availability WHERE id=?', array($id));
	
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
			
		return false;
	
	}
	
	
	
	
	public function get_name ($id = 0)
	{
		
		$availability = $this->get($id);
		
		if (!$availability)
		{
			return 'ERROR: id='.$id.' does not exist';
		}
		
		$name = $availability->name;
		return $name;
		
	}
	
	
	
	public function get_select ($selected = 0)
	{
	
		$select = '<select name="availability">';
	
		$availabilities = $this->get();
	
		foreach ($availabilities as $availability)
		{
			$select .= '<option value="'.$availability['id'].'"';
				
			if ($availability['id'] == $selected)
			{
				$select .= ' selected ';
			}
				
			$select .= '>'.$availability['name'].'</option>';
		}
	
		$select .= '</select>';
	
		return $select;
	
	}
	
	
	
	
}

?>