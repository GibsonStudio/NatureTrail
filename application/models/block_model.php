<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Block_model extends CI_Model {	
	
	function __construct ()
    {
        parent::__construct();
    }
	
	

	public function get ($args = array())
	{
		
		if (isset($args['id']))
		{
			
			//get specific block
			$sql = 'SELECT * FROM {pre}block WHERE id=?';
			$result = $this->db->query($sql, array($args['id']));
			return $result->row();
			
		}
		else if (isset($args['position']))
		{
			
			$sql = 'SELECT * FROM {pre}block WHERE position=? AND active=1 ORDER BY sort';
			$data = array($args['position']);
			$result = $this->db->query($sql, $data);
			return $result->result_array();
			
		}
		else
		{
			
			//get all blocks			
			$result = $this->db->query('SELECT * FROM {pre}block ORDER BY sort');
    		return $result->result_array();
	
		}
				
	}

	
	
	
	public function insert ()
	{
		
		$active 			= $this->input->post('active');
		$position			= $this->input->post('position');
		$title				= $this->input->post('title');
		$content			= $this->input->post('content');
		$show_content_only	= $this->input->post('show_content_only');
		$sort				= $this->input->post('sort');
		
		
		$sql = 'INSERT INTO {pre}block
				(active, position, title, content, show_content_only, sort)
				VALUES
				(?,?,?,?,?,?)';
		
		$data = array($active, $position, $title, $content, $show_content_only, $sort);
		
		$this->db->query($sql, $data);
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		
		return false;
		
	}
	
	
	
	
	
	public function update ($id = 0)
	{

		$active 			= $this->input->post('active');
		$position			= $this->input->post('position');
		$title				= $this->input->post('title');
		$content			= $this->input->post('content');
		$show_content_only	= $this->input->post('show_content_only');
		$sort				= $this->input->post('sort');
		
		$sql = 'UPDATE {pre}block SET
				active=?, position=?, title=?, content=?, show_content_only=?, sort=?
				WHERE id=?';
		
		$data = array($active, $position, $title, $content, $show_content_only, $sort, $id);
		
		$this->db->query($sql, $data);
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		
		return false;
		
	}
	
	
	
	
	
	
	
	public function delete ($block_id)
	{
		
		$this->db->query('DELETE FROM {pre}block WHERE id=?', array($block_id));
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
			
		return false;
		
	}
	
	
	
	public function render ($block)
	{
		
		$html = '<div class="block">';
		$html .= '<div class="block_heading">'.$block['title'].'</div>';
		$html .= '<div class="block_content">'.$block['content'].'</div>';
		$html .= '</div>';
		
		if ($block['show_content_only'] == 1)
		{
			$html = $block['content'];
		}
		
		return $html;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}


?>