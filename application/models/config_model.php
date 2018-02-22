<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}




	public function get ($id = 0)
	{

		if ($id == 0)
		{

			$query = $this->db->get('config');
			return $query->result_array();

		}
		else
		{

			$this->db->select('*');
			$this->db->from('config');
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->row_array();

		}

	}



  public function insert ()
  {

    $var = $this->input->post('var');
    $value = $this->input->post('value');
    $sql = 'INSERT INTO {pre}config (var,value) VALUES (?,?)';
    $data = array($var, $value);
    $this->db->query($sql, $data);

    if ($this->db->affected_rows() > 0) {
      return $this->db->insert_id();
    }

    return false;

  }


  public function delete ($id)
  {
    $this->db->query('DELETE FROM {pre}config WHERE id=?', array($id));
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}

		return false;
  }


	public function get_config ($var = '', $default = '')
	{

		$this->db->from('config');
		$this->db->where(array('var' => $var));
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->value;
		}

		return $default;

	}




	public function update ($id = 0)
	{

    $var = $this->input->post('var');
		$value = $this->input->post('value');

		$sql = 'UPDATE {pre}config SET var=?, value=? WHERE id=?';

		$data = array($var, $value, $id);

		$this->db->query($sql, $data);

		if ($this->db->affected_rows() > 0)
		{
			return true;
		}

		return false;

	}




}

?>
