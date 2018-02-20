<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_model {
	
	
	function __construct ()
    {
        parent::__construct();
    }
    
	
	
	
	
	
	public function get_templates ()
	{
		
		$this->db->select('*');
		$this->db->from('email_template');
		$this->db->order_by('sort');
		$query = $this->db->get();
		
		return $query->result_array();		
		
	}
	
	
	
	
	public function get_template ($id = 0)
	{
		
		$sql = 'SELECT * FROM {pre}email_template WHERE id=?';
		$result = $this->db->query($sql, $id);
		return $result->row();
		
	}
	
	
	
	
	public function add_template ()
	{
	
		$name		= $this->input->post('name');
		$content	= $this->input->post('content');
		$sort		= $this->input->post('sort');
	
		$sql = 'INSERT INTO {pre}email_template (name, content, sort) VALUES (?,?,?)';	
		$data = array($name, $content, $sort);
	
		$this->db->query($sql, $data);
	
		if ($this->db->affected_rows() > 0)
		{
			return $this->db->insert_id();
		}
	
		return false;
	
	}
	
	
	
	
	public function update_template ($id)
	{

		$name		= $this->input->post('name');
		$content	= $this->input->post('content');
		$sort		= $this->input->post('sort');
		
		$sql = 'UPDATE {pre}email_template SET
		name=?, content=?, sort=?
		WHERE id=?';
		
		$data = array($name, $content, $sort, $id);
		
		$this->db->query($sql, $data);
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		
		return false;		
		
	}
	
	
	
	
	public function get_template_select ()
	{
		
		$select = '<select id="template" name="template" onchange="load_template(\''.base_url().'\')">';
		$select .= '<option value="">None</option>';
		
		$templates = $this->get_templates();
		
		foreach ($templates as $template)
		{
			$select .= '<option value="'.$template['id'].'">'.$template['name'].'</option>';
		}
		
		$select .= '</select>';
		
		return $select;
		
	}
	
	
	
	public function delete_template ($id = 0)
	{
		
		$this->db->query('DELETE FROM {pre}email_template WHERE id=?', array($id));
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
			
		return false;
		
	}
	
	
	
	
	
	
}


?>