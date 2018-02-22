<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trail_model extends CI_Model {

	function __construct ()
    {
        parent::__construct();
    }



	public function get ($id = 0)
	{

		if ($id != 0)
		{

			//specific trail
			$sql = 'SELECT * FROM {pre}trail WHERE id=?';
			$data = array($id);
			$query = $this->db->query($sql, $data);
			return $query->row();

		}
		else
		{

			//all trails
			$sql = 'SELECT * FROM {pre}trail';
			$query = $this->db->query($sql);
			return $query->result_array();

		}


	}




	public function insert ()
	{

		$name 			= $this->input->post('name');
		$description	= $this->input->post('description');
		$createdby		= $this->user_model->get()->id;
		$availability	= $this->input->post('availability');
		$timestamp		= time();

		$sql = 'INSERT INTO {pre}trail (name, description, createdby, availability, timestamp) VALUES (?,?,?,?,?)';

		$data = array($name, $description, $createdby, $availability, $timestamp);

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
		$availability	= $this->input->post('availability');

		$sql = 'UPDATE {pre}trail SET name=?, description=?, availability=? WHERE id=?';

		$data = array($name, $description, $availability, $id);

		$this->db->query($sql, $data);

		if ($this->db->affected_rows() > 0)
		{
			return true;
		}

		return false;

	}







	public function delete ($id)
	{

		$this->db->query('DELETE FROM {pre}trail WHERE id=?', array($id));

		if ($this->db->affected_rows() > 0)
		{
			return true;
		}

		return false;

	}







	public function get_objects ($trailid = 0)
	{

		//returns a result_array of user.*

		$sql = 'SELECT * FROM {pre}object WHERE id IN (SELECT objectid FROM {pre}trail_objects WHERE trailid=?)';
		$data = array($trailid);
		$query = $this->db->query($sql, $data);
		return $query->result_array();

	}






	public function get_not_in_trail ($trailid = 0)
	{

		//returns a result_array of user.*

		$sql = 'SELECT * FROM {pre}object WHERE id NOT IN (SELECT objectid FROM {pre}trail_objects WHERE trailid=?)';
		$data = array($trailid);
		$query = $this->db->query($sql, $data);

		return $query->result_array();

	}




	/*
	public function get_user_trails ($userid = 0)
	{

		//returns a result_array of trail.id and trail.name

		$sql = 'SELECT {pre}trail.id, {pre}trail.name FROM {pre}trail_membership
				JOIN {pre}trail ON {pre}trail.id = {pre}trail_membership.trailid
				WHERE userid=?';
		$data = array($userid);
		$query = $this->db->query($sql, $data);
		return $query->result_array();

	}
	*/





	public function object_in_trail ($objectid = 0, $trailid = 0)
	{

		//returns an integer

		$this->db->from('trail_objects');
		$this->db->where('objectid', $objectid);
		$this->db->where('trailid', $trailid);

		if ($this->db->count_all_results() > 0)
		{
			return true;
		}

		return false;

	}






	public function object_count ($trailid = 0)
	{

		//returns an integer

		$this->db->from('trail_objects');
		$this->db->where('trailid', $trailid);
		return $this->db->count_all_results();

	}






	public function add_object_to_trail ($objectid = 0, $trailid = 0)
	{

		if (!$this->object_in_trail($objectid, $trailid))
		{

			$sql = 'INSERT INTO {pre}trail_objects (objectid, trailid) VALUES (?,?)';
			$data = array($objectid, $trailid);
			$this->db->query($sql, $data);

			if ($this->db->affected_rows() > 0)
			{
				return true;
			}

		}

		return false;

	}






	public function remove_object_from_trail ($objectid = 0, $trailid = 0)
	{

		$sql = 'DELETE FROM {pre}trail_objects WHERE objectid=? AND trailid=?';
		$data = array($objectid, $trailid);

		$this->db->query($sql, $data);

		if ($this->db->affected_rows() > 0)
		{
			return true;
		}

		return false;

	}









}


?>
