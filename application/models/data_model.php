<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model {

    public function __construct ()
    {
        parent::__construct();
    }
    
    
    public function get_value ($table, $field, $idvalue, $idfield = 'id', $default = '')
    {
        
        $this->db->from($table);
        $this->db->where(array($idfield => $idvalue));
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->row()->$field;
        }
        else
        {
            return $default;
        }
        
    }
    
    
    
    
    
    public function record_exists ($table = '', $idvalue = 0, $idfield = 'id')
    {
        
        $this->db->from($table);
        $this->db->where(array($idfield => $idvalue));
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return TRUE;
        }

        return FALSE;
        
    }
    
    
    
    
    public function get_select ($table = '', $selected = 0, $field = 'name', $name = NULL, $first_entry = '')
    {
        
    	if (is_null($name))
    	{
    		$name = $table;
    	}
    	
        $select = '<select name="'.$name.'">';
        
        if (!empty($first_entry))
        {
        	$select .= $first_entry;
        }
        
        $query = $this->db->get($table);
        
        foreach ($query->result() as $row)
        {
            
            if ($row->id == $selected)
            {
                $select .= '<option value="'.$row->id.'" selected>'.$row->$field.'</option>';
            }
            else
            {
                $select .= '<option value="'.$row->id.'">'.$row->$field.'</option>';
            }
            
        }
        
        $select .= '</select>';
        
        return $select;
        
    }
    
    
    
    
    
        
    
    public function get_boolean_select ($name = '', $selected = 0, $include_any = 0)
    {
        
        $select = '<select name="'.$name.'">';
        
        if ($include_any = 1)
        {
        	$select .= '<option value="-1"';
        	if ($selected == -1) { $select .= ' selected'; }
        	$select .= '>Any</option>';
        }
        
        
        //Yes
        $select .= '<option value="1"';
        if ($selected == 1) { $select .= ' selected'; }
        $select .= '>Yes</option>';        
        
        //No
        $select .= '<option value="0"';
        if ($selected == 0) { $select .= ' selected'; }
        $select .= '>No</option>';
        
        $select .= '</select>';
        
        return $select;
        
    }
    
       
    
     
    
    
    
    public function get_name ($userid = 0)
    {
    	
    	$query = $this->db->query('SELECT firstname, lastname FROM {pre}user WHERE id=?', array($userid));
    	
    	if ($query->num_rows() > 0) {
    		return $query->row()->firstname.' '.$query->row()->lastname;
    	}
    	
    	return ''; //lang('error_user_not_found');
    	
    }
    

    
    
    public function get_position_select ($name = '', $selected = 0)
    {
    
    	$select = '<select name="'.$name.'">';
    
    	//Yes
    	$select .= '<option value="1"';
    	if ($selected == 1) {
    		$select .= ' selected';
    	}
    	$select .= '>Right</option>';
    
    	//No
    	$select .= '<option value="0"';
    	if ($selected == 0) {
    		$select .= ' selected';
    	}
    	$select .= '>Left</option>';
    
    	$select .= '</select>';
    
    	return $select;
    
    }
    
    
    
    
    public function get_position_string ($position = 0)
    {
    
    	switch ($position)
    	{
    		
    		case 1:
    			return 'Right';
    			break;
    		default:
    			return 'Left';
    	}
    	
    }
    
    
    
    
    public function get_users_with_permission ($permission = '')
    {
    	
    	$sql = 'SELECT * FROM {pre}user
    			WHERE accesslevel IN
    			(
    			SELECT id FROM {pre}accesslevel
    			WHERE FIND_IN_SET( (SELECT id FROM {pre}permissions WHERE name=?) , permissions)
    			)
    			OR
    			accesslevel IN
    			(
    			SELECT id FROM {pre}accesslevel
    			WHERE FIND_IN_SET( (SELECT id FROM {pre}permissions WHERE name="do_anything") , permissions)
    			);';
    	
    	$data = array($permission);
    	
    	$result = $this->db->query($sql, $data);
    	return $result->result_array();
    	
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>