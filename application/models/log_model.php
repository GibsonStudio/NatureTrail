<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_model extends CI_Model {

    public function __construct ()
    {
        parent::__construct();
    }
    
    
    
    public function get_logs ($limit = 10, $offset = 0, $userid = 0)
    {
    	
    	$this->db->select('*');
    	$this->db->from('log');
    	
    	if ($userid != 0)
    	{
    		$this->db->where('userid', $userid);
    	}
    	
    	$this->db->order_by('timestamp', 'DESC');
    	$this->db->limit($limit, $offset);
    	
    	$query = $this->db->get();
    	return $query->result_array();
    	
    }
    
    
    
    
    
    public function add ($action = 'undefined', $data = '')
    {
    	 
    	if (empty($data))
    	{
    		$data = uri_string();
    	}
    	 
    	$userid = $this->user_model->get() ? $this->user_model->get()->id : 0;
    	 
    	if ($userid)
    	{
    
    		$sql = 'INSERT INTO {pre}log (userid, action, data, timestamp) VALUES (?,?,?,?)';
    		$query_data = array($userid, $action, $data, time());
    		$this->db->query($sql, $query_data);
    
    		if ($this->db->affected_rows() > 0)
    		{
    			return true;
    		}
    		 
    	}
    	 
    	return false;
    	 
    }
    
    
    
    
    
    
    
    
    public function get_count ($userid = 0)
    {
    	
    	$this->db->select('*');
    	$this->db->from('log');
    	
    	if ($userid != 0)
    	{
    		$this->db->where('userid', $userid);
    	}
    	
    	return $this->db->count_all_results();
    	
    }
    
    
    
    
    
}
    
?>