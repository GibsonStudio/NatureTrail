<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role_model extends CI_Model {
	
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	
	
	
	public function get ($id = 0)
	{
		
		if ($id == 0)
		{
			
			$result = $this->db->query('SELECT * FROM {pre}accesslevel ORDER BY level DESC, name');
    		return $result->result_array();
			
		}
		else
		{
			
			$sql = 'SELECT * FROM {pre}accesslevel WHERE id=?';
			$data = array($id);
			$result = $this->db->query($sql, $data);
			return $result->row();
			
		}
		
		
	}
	
	
	
	
	
	public function insert ()
	{
		 
		$name 			= $this->input->post('name');
		$level			= $this->input->post('level');
		$description	= $this->input->post('description');	
		 
		$sql = 'INSERT INTO {pre}accesslevel (name, level, description) VALUES (?,?,?)';
		 
		$data = array($name, $level, $description);
		 
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
		$level			= $this->input->post('level');
		$description	= $this->input->post('description');
		 
		$sql = 'UPDATE {pre}accesslevel SET name=?, level=?, description=? WHERE id=?';
		 
		$data = array($name, $level, $description, $id);
		 
		$this->db->query($sql, $data);
		 
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		 
		return false;
		 
	}
	
	
	
	public function delete ($id)
	{
		 
		$this->db->query('DELETE FROM {pre}accesslevel WHERE id=?', array($id));
		 
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
	
		return false;
		 
	}
	
	
	
	
	
	
	public function get_role_permissions ($roleid = 0)
	{
		
		$role_permissions = $this->data_model->get_value('accesslevel', 'permissions', $roleid);
		$role_permissions = explode(",", $role_permissions);
		return $role_permissions;
		
	}
	
	
	
	
	
	
	public function set_permissions ($roleid = 0, $permissions = '')
	{
		
		$sql = 'UPDATE {pre}accesslevel SET permissions=? WHERE id=?';
		$data = array($permissions, $roleid);
		
		$this->db->query($sql, $data);
			
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
			
		return false;
		
	}
	
	
	
	
	
	public function get_select ($selected = 0)
	{
		
		$select = '<select name="accesslevel">';
		
		$sql = 'SELECT * FROM {pre}accesslevel WHERE level<=? ORDER BY level DESC, name';
		
		$userrole = $this->user_model->get()->accesslevel;
		$userlevel = $this->data_model->get_value('accesslevel', 'level', $userrole);
		$data = array($userlevel);
		$query = $this->db->query($sql, $data);
		$roles = $query->result_array();
		
		foreach ($roles as $role)
		{
			
			$select .= '<option value="'.$role['id'].'"';
			
			if ($role['id'] == $selected)
			{
				$select .= ' selected ';
			}
			
			$select .= '>'.$role['name'].'</option>';
			
		}
		
		$select .= '</select>';
		
		return $select;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
}

?>
