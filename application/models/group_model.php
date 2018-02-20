<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_model extends CI_Model {	
	
	function __construct ()
    {
        parent::__construct();
    }
	
	

	public function get ($id = 0)
	{
		
		if ($id != 0)
		{
			
			//specific group
			$sql = 'SELECT * FROM {pre}group WHERE id=?';
			$data = array($id);
			$query = $this->db->query($sql, $data);
			return $query->row();
			
		}
		else
		{
			
			//all groups
			$sql = 'SELECT * FROM {pre}group';
			$query = $this->db->query($sql);
			return $query->result_array();			
			
		}

				
	}

	
	
	
	public function insert ()
	{
		
		$name 			= $this->input->post('name');
		$description	= $this->input->post('description');		
		
		$sql = 'INSERT INTO {pre}group (name, description) VALUES (?,?)';
		
		$data = array($name, $description);
		
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
		
		$sql = 'UPDATE {pre}group SET name=?, description=? WHERE id=?';
		
		$data = array($name, $description, $id);
		
		$this->db->query($sql, $data);
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		
		return false;
		
	}
	
	
	
	
	
	
	
	public function delete ($id)
	{
		
		//Remove any group memberships
		$this->db->query('DELETE FROM {pre}group_membership WHERE groupid=?', array($id));
		
		
		$this->db->query('DELETE FROM {pre}group WHERE id=?', array($id));
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
			
		return false;
		
	}
		
	
	
	
	

	public function get_select ($selected = 0)
	{
		
		$select = '<select name="group">';
		$select .= '<option value="0">None / All</option>';
		
		$groups = $this->get();
		
		foreach ($groups as $group)
		{
			$select .= '<option value="'.$group['id'].'"';
			
			if ($group['id'] == $selected)
			{
				$select .= ' selected ';
			}
			
			$select .= '>'.$group['name'].'</option>';
		}
		
		$select .= '</select>';
		
		return $select;
		
	}
	
	
	
	
	
	
	
	public function get_members ($groupid = 0)
	{
		
		//returns a result_array of user.*
		
		$sql = 'SELECT * FROM {pre}user WHERE id IN (SELECT userid FROM {pre}group_membership WHERE groupid=?) ORDER BY lastname';
		$data = array($groupid);
		$query = $this->db->query($sql, $data);
		return $query->result_array();
		
	}
	
	
	
	
	
	
	public function get_not_in_group ($groupid = 0)
	{
		
		//returns a result_array of user.*
		
		$sql = 'SELECT * FROM {pre}user WHERE id NOT IN (SELECT userid FROM {pre}group_membership WHERE groupid=?) ORDER BY lastname';
		$data = array($groupid);
		$query = $this->db->query($sql, $data);
		
		return $query->result_array();
		
	}
	
	
	
	
	
	public function get_user_groups ($userid = 0)
	{
		
		//returns a result_array of group.id and group.name
		
		$sql = 'SELECT {pre}group.id, {pre}group.name FROM {pre}group_membership
				JOIN {pre}group ON {pre}group.id = {pre}group_membership.groupid
				WHERE userid=?';
		$data = array($userid);
		$query = $this->db->query($sql, $data);
		return $query->result_array();		
		
	}
	
	
	
	
	
	
	public function user_in_group ($userid = 0, $groupid = 0)
	{
		
		//returns an integer
		
		$this->db->from('group_membership');
		$this->db->where('userid', $userid);
		$this->db->where('groupid', $groupid);
		
		if ($this->db->count_all_results() > 0)
		{
			return true;
		}
		
		return false;
		
	}
	
	
	
	
	
	
	public function member_count ($groupid = 0)
	{

		//returns an integer
		
		$this->db->from('group_membership');
		$this->db->where('groupid', $groupid);
		return $this->db->count_all_results();
		
	}
	
	
	
	
	
	
	public function add_user_to_group ($userid = 0, $groupid = 0)
	{
		
		if (!$this->user_in_group($userid, $groupid))
		{
		
			$sql = 'INSERT INTO {pre}group_membership (userid, groupid) VALUES (?,?)';
			$data = array($userid, $groupid);
			$this->db->query($sql, $data);
			
			if ($this->db->affected_rows() > 0)
			{
				return true;
			}
		
		}
		
		return false;
		
	}
	
	
	
	
	
	
	public function remove_user_from_group ($userid = 0, $groupid = 0)
	{
		
		$sql = 'DELETE FROM {pre}group_membership WHERE userid=? AND groupid=?';
		$data = array($userid, $groupid);
		
		$this->db->query($sql, $data);
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		
		return false;
		
	}
	
	
	
	
	
	
	
	
	
	
	
}


?>