<?php if (!defined('BASEPATH')) exit ('No direct access allowed!');

class Object_model extends CI_Model {
	
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	

	public function get_count ($userid = 0)
	{	
		return $this->db->count_all('object');	
	}
	
	
	
	
	public function get_objects ($limit = 0, $offset = 0)
	{
	
		$this->db->from('object');
		
		$this->db->order_by('id');
		$this->db->limit($limit, $offset);
	
		$query = $this->db->get();
		return $query->result_array();
	
	}
	
	
	
	public function get ($id = 0)
	{
		
		if ($id == 0)
		{
			
			//return all
			$query = $this->db->get('object');
			return $query->result_array();
			
		}
		else
		{
			
			//get specific
			$this->db->select('object.*'); //, rarity.name AS rarity_string');
			$this->db->from('object');
			$this->db->where('object.id', $id);			
			//$this->db->join('rarity', 'rarity = rarity.id');
			$result = $this->db->get();
			return $result->row_array();
			
		}
		
	}
	
	
	
	
	
	public function insert ()
	{
		
		//get data
        $name	        = $this->input->post('name');        
        $description	= $this->input->post('description');
        $rarity			= $this->input->post('rarity');
        $timestamp		= time();

        
        //execute insert query
        $sql = 'INSERT INTO {pre}object
                (
        		name,
                description,
                rarity,
                timestamp
        		)
                VALUES
                (?,?,?,?)';
        
        $data = array(
            $name,
            $description,
            $rarity,
            $timestamp
            );
        
        $this->db->query($sql, $data);
        
        if ($this->db->affected_rows() > 0)
        {
            return $this->db->insert_id();
        }
        
        return false;
		
	}
	
	
	
	
	
	
	public function set_filename ($id = 0, $filename = 0)
	{
		
		$sql = 'UPDATE {pre}object SET filename=? WHERE id=?';
		
		$data = array($filename, $id);
		
		$this->db->query($sql, $data);
		
		if ($this->db->affected_rows() > 0)
		{
			return $id;
		}
		
		return false;
		
	}
	
	
	
	
	
	
	
	public function update ($id = 0)
	{
		
        $name			= $this->input->post('name');
        $description	= $this->input->post('description');
        $rarity			= $this->input->post('rarity');
        $timestamp		= time();
		
		$sql = 'UPDATE {pre}object SET name=?, description=?, rarity=?, timestamp=? WHERE id=?';
		
		$data = array($name, $description, $rarity, $timestamp, $id);
		
		$this->db->query($sql, $data);
		
		if ($this->db->affected_rows() > 0)
		{
			return $id;
		}
		
		return false;
		
	}
	
	
	
	
	public function delete ($id)
	{
			
		//remove from database
		$this->db->query('DELETE FROM {pre}object WHERE id=?', array($id));
	
		if ($this->db->affected_rows() > 0)
		{
			return $id;
		}
			
		return false;
	
	}
	
	
	
	
	
	public function draw_object_tile ($object_id)
	{
		
		$object = $this->get($object_id);
		
		$html = '<div class="object_tile">';
		$html .= '<div class="object_tile_image"><img src="'.image_path().'objects/'.$object['filename'].'" alt="'.$object['filename'].'" /></div>';
		$html .= '<div class="object_tile_name">'.$object['name'].'</div>';
		
		if (!empty($object['description'])) {
			$html .= '<div class="object_tile_description">'.$object['description'].'</div>';
		}
		
		$html .= '<div class="object_tile_rarity">'.$this->rarity_model->get_name($object['rarity']).'</div>';
		
		//buttons
		$html .= '<div class="object_tile_buttons">';
		$html .= anchor('object/view/'.$object['id'], lang('view'), 'class="button_small"');
		$html .= anchor('object/edit/'.$object['id'], lang('edit'), 'class="button_small"');
		$html .= anchor('object/delete/'.$object['id'], lang('delete'), 'class="button_small"');
		$html .= '</div>';
		
		$html .= '</div>';
		
		return $html;
		
	}
	
	
	
	public function draw_object_for_trail ($object_id)
	{
		
		$object = $this->get($object_id);
		
		$html = '<div class="object_trail" id="object_'.$object_id.'" onclick="toggle_object_found(\'object_'.$object_id.'\');">';
		
		//add image
		$html .= '<div class="object_trail_image"><img src="'.image_path().'objects/'.$object['filename'].'" alt="'.$object['filename'].'" /></div>';
		
		//scrolling area
		$html .= '<div class="object_trail_scrolling">';
		
		//add name
		$html .= '<div class="object_trail_name">'.$object['name'].' '.$this->rarity_model->get_name($object['rarity']).'</div>';
		
		//add description
		$html .= '<div class="object_trail_description">'.$object['description'].'</div>';
		
		$html .= '</div></div>';
		
		return $html;
		
	}
	
	
	
	
	
	

	
	
	
	
	
	
}

?>