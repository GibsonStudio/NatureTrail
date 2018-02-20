<?php if (!defined('BASEPATH')) exit('No direct script access allowed!');

class Rarity_model extends CI_Model {

	public function __construct ()
	{
		parent::__construct();
	}
	
	
	public function get ($id = 0)
	{
		
		if ($id != 0)
		{
				
			//specific
			$sql = 'SELECT * FROM {pre}rarity WHERE id=?';
			$data = array($id);
			$query = $this->db->query($sql, $data);
			return $query->row();
				
		}
		else
		{
				
			//all
			$sql = 'SELECT * FROM {pre}rarity ORDER BY value DESC, name';
			$query = $this->db->query($sql);
			return $query->result_array();
				
		}
		
	}
	
	
	
	
	public function insert ()
	{
	
		$name	= $this->input->post('name');
		$value	= $this->input->post('value');
	
		$sql = 'INSERT INTO {pre}rarity (name, value) VALUES (?,?)';
	
		$data = array($name, $value);
	
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
		$value	= $this->input->post('value');
	
		$sql = 'UPDATE {pre}rarity SET name=?, value=? WHERE id=?';
	
		$data = array($name, $value, $id);
	
		$this->db->query($sql, $data);
	
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
	
		return false;
	
	}
	
	
	public function delete ($id)
	{
	
		$this->db->query('DELETE FROM {pre}rarity WHERE id=?', array($id));
	
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
			
		return false;
	
	}
	
	
	
	
	public function get_name ($id = 0)
	{
		
		$rarity = $this->get($id);
		
		if (!$rarity)
		{
			return 'ERROR: id='.$id.' does not exist';
		}
		
		$name = '('.$rarity->value.') '.$rarity->name;
		return $name;
		
	}
	
	
	
	public function get_select ($selected = 0)
	{
	
		$select = '<select name="rarity">';
	
		$rarities = $this->get();
	
		foreach ($rarities as $rarity)
		{
			$select .= '<option value="'.$rarity['id'].'"';
				
			if ($rarity['id'] == $selected)
			{
				$select .= ' selected ';
			}
				
			$select .= '>('.$rarity['value'].') '.$rarity['name'].'</option>';
		}
	
		$select .= '</select>';
	
		return $select;
	
	}
	
	
	
	
}

?>