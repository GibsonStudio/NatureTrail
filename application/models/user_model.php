<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct ()
    {
        parent::__construct();
    }
    
    
    
    
    public function can_edit_user ($userid = 0)
    {
    	
    	$userrole = $this->user_model->get()->accesslevel;
    	$userlevel = $this->data_model->get_value('accesslevel', 'level', $userrole);
    	
    	$editrole = $this->user_model->get(array('id' => $userid))->accesslevel;
    	$editlevel = $this->data_model->get_value('accesslevel', 'level', $editrole);
    	
    	if ($userlevel >= $editlevel)
    	{
    		return true;
    	}
    	
    	return false;
    	
    }
    
    
    
    
    
    
    public function search ()
    {
    	
    	//get post data
    	$accesslevel		= $this->input->post('accesslevel');
    	$name				= $this->input->post('name');
    	$terms				= explode(" ", $name);
    	$email_confirmed	= $this->input->post('email_confirmed');
    	
    	$sql = 'SELECT * FROM {pre}user'; 
    	$data = array();
    	$where = ' WHERE ';
    	$and = '';
    	
    	if ($accesslevel != 0)
    	{
    		$sql .=  $where.$and.'accesslevel=?';
    		array_push($data, $accesslevel);
    		$where = '';
    		$and = ' AND ';
    	}
    	
    	$add_or = '';
    	foreach ($terms as $term)
    	{
    		
    		$sql .= $where.$and.'(firstname LIKE ? OR lastname LIKE ? OR knownas LIKE ? OR email LIKE ?)';
    		$where = '';
    		$and = ' AND ';    		
    		
    		for ($i = 1; $i <= 4; $i++)
    		{
    			array_push($data, '%'.$term.'%');
    		}
    		
    	}
    	
    	
    	if ($email_confirmed != -1)
    	{
    		
    		$sql .= $where.$and.'email_confirmed=?';
    		$where = '';
    		$and = ' AND ';
    		array_push($data, $email_confirmed);
    		
    	}
    	
    	
    	$query = $this->db->query($sql, $data);
    	return $query->result_array();
    	
    }
    
    
    
    
    
    
    
    
    public function get ($arg = false)
    {
    
    	if (isset($arg['id']))
    	{
    		$sql = 'SELECT * FROM {pre}user WHERE id=?';
    		$result = $this->db->query($sql, array($arg['id']));
    		return $result->row();
    	}
    	else if (isset($arg['email']))
    	{
    		$sql = 'SELECT * FROM {pre}user WHERE email=?';
    		$result = $this->db->query($sql, array($arg['email']));
    		return $result->row();
    	}
    	else if ($arg == 'all')
    	{
    		//get and return all users
    		$result = $this->db->get('user');
    		return $result->result_array();

    		
    	}
    	else
    	{
    		//default, return current user
    		$sql = 'SELECT * FROM {pre}user WHERE id=?';
    		$result = $this->db->query($sql, array($this->session->userdata('id')));
    		return $result->row();
    	}
    
    }
    
    
    
    
    public function insert ()
    {
        
        $email          = $this->input->post('email');
        $password       = md5($this->config->item('salt').md5($this->input->post('password')));
        $firstname      = $this->input->post('firstname');
        $middlenames    = $this->input->post('middlenames');
        $knownas		= $this->input->post('knownas');
        $lastname       = $this->input->post('lastname');  
        $timecreated    = time();
        
        $sql = 'INSERT INTO {pre}user
                (email, password, firstname, middlenames, lastname, knownas, timecreated)
                VALUES
                (?,?,?,?,?,?,?)';
        
        $data = array($email, $password, $firstname, $middlenames, $lastname, $knownas, $timecreated);
        
        $this->db->query($sql, $data);
        
        if ($this->db->affected_rows() === 1)
        {
            return $this->db->insert_id();
        }
        
    }
    
    
    
    
    public function delete ($id = NULL)
    {
        
        $deletedby = $this->user_model->get()->id;
        $timedeleted = time();
        
        $sql = 'UPDATE {pre}user SET deleted=1, deletedby=?, timedeleted=? WHERE id=?';
        $data = array($deletedby, $timedeleted, $id);
        $this->db->query($sql, $data);
        
        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        
        return false;
        
    }
    
    
    
    
    public function delete_from_database ($userid = NULL)
    {

    	//Remove any group memberships
    	$this->db->query('DELETE FROM {pre}group_membership WHERE userid=?', array($userid));
    	
    	
    	
    	//remove from user
    	$this->db->query('DELETE FROM {pre}user WHERE id=?', array($userid));
    	
    	if ($this->db->affected_rows() > 0)
    	{
    		return true;
    	}
    	
    	return false;
    	
    }
    
    
    
    
    
    
    public function update ($id = 0)
    {
        
        $firstname      = $this->input->post('firstname');
        $middlenames    = $this->input->post('middlenames');
        $lastname       = $this->input->post('lastname');
        $knownas		= $this->input->post('knownas');
        $password       = $this->input->post('password');
        $email          = $this->input->post('email');
        $accountnumber  = $this->input->post('accountnumber');
        $accesslevel    = $this->input->post('accesslevel');
        //$group			= $this->input->post('group');
        $deleted        = $this->input->post('deleted');
        $timemodified   = time();
        $modifierid      = $this->user_model->get()->id;
        
        //echo '['.$accesslevel.']';
        
        //start query and data
        $sql = 'UPDATE {pre}user SET ';
        $data = array();
        
        //is email being changed? If it is, we need to reset email_confirmed
        if ($email != $this->data_model->get_value('user', 'email', $id))
        {
        	array_push($data, 0);
        	$sql .= ' email_confirmed=?, ';
        }
        
        //include required fields
        $sql .= ' firstname=?, ';
        array_push($data, $firstname);
        $sql .= ' middlenames=?, ';
        array_push($data, $middlenames);
        $sql .= ' lastname=?, ';
        array_push($data, $lastname);
        $sql .= ' knownas=?, ';
        array_push($data, $knownas);
        $sql .= ' email=?, ';
        array_push($data, $email);
        $sql .= ' timemodified=?, ';
        array_push($data, $timemodified);
        $sql .= ' modifierid=? '; //no comma after last required field
        array_push($data, $modifierid);
        
        
       
        
        //include password?
        if ($password != '')
        {
            $password = md5($this->config->item('salt').md5($this->input->post('password')));
            $sql .= ', password=? ';
            array_push($data, $password);
        }
        
        //include accountnumber?       
        if (!empty($accountnumber))
        {
            $sql .= ', accountnumber=? ';
            array_push($data, $accountnumber);
        } 
        
        //include accesslevel?       
        if (!empty($accesslevel))
        {
            $sql .= ', accesslevel=? ';
            array_push($data, $accesslevel);
        }        
        
        //include group?
        /*
        if (!empty($group))
        {
        	$sql .= ', groupid=? ';
        	array_push($data, $group);
        }
        */
        
        //deleted
        if (!empty($deleted) OR $deleted == 0)
        {
            $sql .= ', deleted=? ';
            array_push($data, $deleted);
        } 
        
        //add WHERE
        $sql .= ' WHERE id=?';
        array_push($data, $id);
        
        //run query
        $this->db->query($sql, $data);
        
        if ($this->db->affected_rows() > 0)
        {
            
            //rebuild session data?
            if ($this->user_model->get()->id == $id)
            {
                $this->session->set_userdata(array('email' => $email));
                if ($password != '') { $this->session->set_userdata(array('password' => $password)); }
                $this->session->set_userdata(array('firstname' => $firstname));
                $this->session->set_userdata(array('middlenames' => $middlenames));
                $this->session->set_userdata(array('lastname' => $lastname));
                if (!is_null($accesslevel)) { $this->session->set_userdata(array('accesslevel' => $accesslevel)); }
            }            
            
            return true;
            
        }
        
        return false;        
        
    }
    
    
    
    
    
    /*
    public function generate_account_number ($firstname, $lastname)
    {
    
    	//generates a customer account number
    	//the number generated should be unique, but if it isn't, '0' will be returned
    	$account_prefix = strtoupper($firstname[0]).strtoupper($lastname[0]);
    	$account_suffix = 100;
    
    	//get all existing account numbers with same prefix
    	$this->db->from('user');
    	$this->db->like('accountnumber', $account_prefix, 'after');
    	$result = $this->db->get();
    
    	foreach ($result->result() as $row)
    	{
    
    		$this_suffix = (int) preg_replace("/[^0-9]/", "", $row->accountnumber);
    
    		if ($this_suffix > $account_suffix)
    		{
    			$account_suffix = $this_suffix;
    		}
    
    	}
    
    	$account_suffix++;
    
    	//add leading zero?
    	if ($account_suffix <= 999)
    	{
    		$account_suffix = '0'.$account_suffix;
    	}
    
    	$accountnumber = $account_prefix.$account_suffix;
    
    	//check that account number does not already exist
    	$this->db->from('user');
    	$this->db->where(array('accountnumber' => $accountnumber));
    	$exists = $this->db->get();
    
    	if ($exists->num_rows() > 0)
    	{
    		$accountnumber = '0';
    	}
    
    	return $accountnumber;
    
    }
    */
    
    
    
    public function update_profileimage ($id, $filename)
    {
        
        $data = array('profileimage' => $filename);
        $this->db->where('id', $id);
        $this->db->update('{pre}user', $data);
        
        if ($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
        
    }
    
    
    
    
    
    
    
    
    /*
    public function add_account_number($userid, $accountnumber)
    {
        
        $sql = 'UPDATE {pre}user SET accountnumber=? WHERE id=?';
        $data = array($accountnumber, $userid);
        
        $this->db->query($sql, $data);
        
        if ($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        
        return FALSE;
        
    }
    */
    
    
    
    
   
    public function valid_login ($email, $passhash)
    {
        
        $sql = 'SELECT * FROM {pre}user WHERE email=? AND password=?';
        $data = array($email, md5($this->config->item('salt').$passhash));
        
        $result = $this->db->query($sql, $data);
        
        if ($result->num_rows() >= 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
        
    }
    
    
    
   
    
    public function set_login_data ($userid = 0)
    {
    	
    	$time = time();
    	$ip = $this->session->userdata('ip_address');
    	
    	$sql = "UPDATE {pre}user SET lastlogin=?, lastip=? WHERE id=?";
    	$data = array($time, $ip, $userid);
    	
    	$this->db->query($sql, $data);
    	
    	if ($this->db->affected_rows() === 1)
    	{
    		return true;
    	}
    	
    }
    
    
    
    
    public function set_logout_data ($userid = 0)
    {
    	 
    	$time = time();
    	 
    	$sql = "UPDATE {pre}user SET lastlogout=? WHERE id=?";
    	$data = array($time, $userid);
    	 
    	$this->db->query($sql, $data);
    	 
    	if ($this->db->affected_rows() === 1)
    	{
    		return true;
    	}
    	 
    }
    
    
    
    
    public function get_users ($include_deleted = false, $limit = 0, $offset = 0)
    {
        
        $this->db->from('user');
        
        if ($include_deleted == false)
        {
            $this->db->where(array('deleted <>' => 1));
        }
        
        $this->db->order_by('lastname');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query->result_array();
        
    }
    
    
    
    public function get_count ($userid = 0)
    {
    	 
    	return $this->db->count_all('user');
    	 
    }
    
    
       

    
    
    public function is_logged_in ()
    {
        
        $email = trim($this->session->userdata('email'));
        $password = trim($this->session->userdata('password'));    
        
        if ($email == '' || $email == NULL || $password == '' || $password == NULL)
        {
            return FALSE;
        }
        
        
        
        $sql = 'SELECT * FROM {pre}user WHERE email=? AND password=? AND deleted<>1';
        $data = array($email, $password);
        $result = $this->db->query($sql, $data);
        
        if ($result->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }       
        
    }
    
    
    
    public function require_login ()
    {
    	
    	$this->session->set_userdata(array('url_after_login' => current_url()));
    	
        if (!$this->is_logged_in())
        {
            redirect('login');
        }
    }
    
    
    
    public function require_permission ($permission_name = 'undefined')
    {
        
    	$this->require_login();
    	
        if ($this->has_permission($permission_name))
        {
            return true;
        }
        else
        {
            redirect("access_denied/index/$permission_name");
        }
        
    }
    
    
    
    
    
    
    public function has_permission ($permission_name)
    {
    	
    	$user = $this->user_model->get();
    	
    	if (count($user) < 1)
    	{
    		//no user found - not logged in
    		return false;
    	}
    	
    	//user is logged in, do they jave the required permission?
    	$sql = 'SELECT * FROM {pre}user WHERE accesslevel IN
    	(
    	SELECT id FROM {pre}accesslevel WHERE FIND_IN_SET( (SELECT id FROM {pre}permissions WHERE name=?), permissions)
    	OR FIND_IN_SET( (SELECT id FROM {pre}permissions WHERE name=\'do_anything\'), permissions)
    	)
    	
    	AND email=?';
    	$data = array($permission_name, $this->session->userdata('email'));
    	$result = $this->db->query($sql, $data);
    	
    	if ($result->num_rows() > 0)
    	{
    		return true;
    	}
    	
    	return false;
    	
    }
    
    
    
    
      
    
    
    
    /*
    public function get_user_info_status ($table = '', $userid = 0, $ignore_time_limit = false)
    {
    	
    	//0 = not completed
    	//1 = completed within 90 days
    	//2 = completed but longer ago than 90 days
    	
    	$time_limit = 90; //number of days after which data must be updated
    	
    	$sql = 'SELECT * FROM {pre}'.$table.' WHERE userid=?';
    	$data = array($userid);
    	$result = $this->db->query($sql, $data);
    	
    	if ($result->num_rows() > 0)
    	{
    		
    		if ($ignore_time_limit)
    		{
    			return 1;	
    		}
    		
    		//data exists, is it newer than $time_limit days
    		$data = $result->row();
    		if ((time() - $data->timemodified) < ($time_limit * 24 * 60 * 60))
    		{
    			return 1;
    		}
    		
    		return 2;
    		
    	}
    	
    	return 0;
    	
    }
    */
    
    
    
    
    
    public function reset_password ()
    {
    	
    	$key		= $this->input->post('key');
    	$password	= md5($this->config->item('salt').md5($this->input->post('password')));
    	
    	$sql = 'UPDATE {pre}user SET password_reset_key=?, password=? WHERE password_reset_key=?';
    	$data = array('', $password, $key);
    	
    	$this->db->query($sql, $data);
    	
    	if ($this->db->affected_rows() == 1)
    	{
    		return lang('password_reset_ok');
    	}
    	else
    	{
    		return lang('password_reset_fail');
    	}
    	
    	
    }
    
    
    
    
    
    
    
    public function write_key ($key = '', $email = '')
    {
    
    	$sql = 'UPDATE {pre}user SET password_reset_key=? WHERE email=?';
    	$data = array($key, $email);
    	$this->db->query($sql, $data);
    	 
    	return $this->db->affected_rows();
    		
    }
    
    
    
    
    public function email_confirmed ($userid = NULL)
    {
    	
    	$sql = 'SELECT * FROM {pre}user WHERE id=?';
    	$data = array($userid);
    	$query = $this->db->query($sql, $data);
    	$row = $query->row();
    	
    	if ($row->email_confirmed == 1)
    	{
    		return true;
    	}
    	
    	return false;
    	
    }
    
    
    
    public function write_email_confirm_key ($key = '', $userid = '')
    {
    
    	$sql = 'UPDATE {pre}user SET email_confirmed=? WHERE id=?';
    	$data = array($key, $userid);
    	$this->db->query($sql, $data);
    
    	return $this->db->affected_rows();
    
    }
    
   
    
    
    
    public function confirm_email ($key = '')
    {
    	
    	if (empty($key)){
    		return 0;
    	}
    	
    	$sql = 'UPDATE {pre}user SET email_confirmed=? WHERE email_confirmed=?';
    	$data = array(1, $key);
    	$this->db->query($sql, $data);
    	
    	return $this->db->affected_rows();
    	
    }
    

    
    
    /*
    public function change_owner ($userid = 0)
    {
    	
    	$owner = $this->input->post('ownerid');
    	
    	$sql = 'UPDATE {pre}user SET owner=? WHERE id=?';
    	
    	$data = array($owner, $userid);
    	
    	$this->db->query($sql, $data);
    	
    	if ($this->db->affected_rows() > 0)
    	{
    		return true;
    	}
    	
    	return false;
    }
    */
    
    
    /*
    public function take_ownership ($userid = 0)
    {
    	
    	$action_user = $this->user_model->get()->id;
    	$sql = 'UPDATE {pre}user SET owner=? WHERE id=?';
    	$data = array($action_user, $userid);
    	
    	$this->db->query($sql, $data);
    	 
    	if ($this->db->affected_rows() > 0)
    	{
    		return true;
    	}
    	
    	return false;
    	
    }
    */
    
    
    
    
    
    /*
    public function get_owner_select ($selected = '')
    {
    	
    	$select = '<select name="ownerid">';
    	
    	$select .= '<option value=""></option>';
    	
    	$users = $this->data_model->get_users_with_permission('own_user');
    	
    	foreach ($users as $user)
    	{
    		$select .= '<option value="'.$user['id'].'"';
    		
    		if ($user['id'] == $selected)
    		{
    			$select .= ' selected ';
    		}
    		
    		$select .= '>'.$this->data_model->get_name($user['id']).'</option>';
    	}
    	
    	$select .= '</select>';
    	
    	return $select;
    	
    }
    */
    
    
    
    
    
    public function can_edit_profile ($userid = 0)
    {
    	
    	if ($userid == $this->user_model->get()->id)
    	{
    		//edit self
    		if ($this->user_model->has_permission('edit_profile'))
    		{
    			return true;	
    		}
    		
    	}
    	else 
    	{
    		
    		//edit another user
    		$user_type = $this->data_model->get_value('user', 'accesslevel', $userid);
    		$user_type = $this->data_model->get_value('accesslevel', 'name', $user_type);
    		 
    		if (($user_type == 'Customer') && (!$this->user_model->has_permission('edit_customer_profiles')))
    		{
    			return $this->user_model->can_edit_user($userid);
    			//return true;
    		}
    		else if ($this->user_model->has_permission('edit_all_profiles'))
    		{
    			return $this->user_model->can_edit_user($userid);
    			//return true;
    		}
    		
    		
    	}
    	
    	return false;
    	
    }
    
    
    
    
    public function can_delete_user ($userid = 0)
    {
    	
    	if ($userid == $this->user_model->get()->id)
    	{
    		//delete self
    		return false;
    	
    	}
    	else
    	{
    	
    		//delete other user
    		$user_type = $this->data_model->get_value('user', 'accesslevel', $userid);
    		$user_type = $this->data_model->get_value('accesslevel', 'name', $user_type);
    		 
    		if (($user_type == 'Customer') && ($this->user_model->has_permission('delete_customer')))
    		{
    			return $this->user_model->can_edit_user($userid);
    			//return true;
    		}
    		else if ($this->user_model->has_permission('delete_user'))
    		{
    			return $this->user_model->can_edit_user($userid);
    			//return true;
    		}
    	
    	
    	}
    	 
    	return false;
    	
    }
    
    
    
    
    
}

?>