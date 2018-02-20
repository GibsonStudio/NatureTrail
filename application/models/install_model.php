<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install_model extends CI_Model {

    public function __construct ()
    {
        parent::__construct();
    }
    
    

    public function create_table ($table_name, $table)
    {
        
        echo '<b>Creating "'.$table_name.'" table....</b><br />';  
        
        $sql = 'CREATE TABLE IF NOT EXISTS '.$table_name.' ('.$table.')';
        
        $result = $this->db->query($sql);
        
        if ($result === TRUE)
        {
            echo $table_name.' table created ok....';
        }
        else
        {
            echo $result;
        }
        
        echo '<hr />';
        
    }
    
    
    
    
    
    
    public function insert_user ($args = array())
    {
        
        $email = isset($args['email']) ? $args['email'] : '';
        $password = isset($args['password']) ? $args['password'] : '';
        $firstname = isset($args['firstname']) ? $args['firstname'] : '';
        $middlenames = isset($args['middlenames']) ? $args['middlenames'] : '';
        $lastname = isset($args['lastname']) ? $args['lastname'] : '';
        $accountnumber = isset($args['accountnumber']) ? $args['accountnumber'] : '';
        $accesslevel = isset($args['accesslevel']) ? $args['accesslevel'] : '1';
        $profileimage = isset($args['profileimage']) ? $args['profileimage'] : '';
        $timecreated = isset($args['timecreated']) ? $args['timecreated'] : time();
        $timemodified = isset($args['timemodified']) ? $args['timemodified'] : '';
        $modifierid = isset($args['modifierid']) ? $args['modifierid'] : '';
        
        //hash password
        $password = md5($this->config->item('salt').md5($password));
        
        //does user already exist?
        if ($this->data_model->get_value ('{pre}user', 'id', $email, 'email', 0) != 0) {
            
            echo 'Skipping User "'.$email.'", already exists....<br />';
            
        }
        else
        {

            $sql = 'INSERT INTO {pre}user
                    (email, password, firstname, middlenames, lastname, accountnumber, accesslevel, profileimage, timecreated, timemodified, modifierid)
                    VALUES
                    (?,?,?,?,?,?,?,?,?,?,?)';

            $data = array($email, $password, $firstname, $middlenames, $lastname, $accountnumber, $accesslevel, $profileimage, $timecreated, $timemodified, $modifierid);

            $this->db->query($sql, $data);

            if ($this->db->affected_rows() === 1)
            {
                echo 'User "'.$email.'" created ok....<br />';
            }
            else
            {
                echo 'User "'.$email.'" NOT created!<br />';
            }
        
        }
        
    }
    
    
    
    
    
    
    public function add_accesslevel ($args = array())
    {
        
        $id = isset($args['id']) ? $args['id'] : '';
        $name = isset($args['name']) ? $args['name'] : '';
        $permissions = isset($args['permissions']) ? $args['permissions'] : '';
        
        
        //does user already exist?
        if ($this->data_model->get_value ('{pre}accesslevel', 'id', $id, 'id', 0) != 0) {
            
            echo 'Skipping User Level "'.$id.'", already exists....<br />';
            
        }
        else
        {        

            $sql = 'INSERT INTO {pre}accesslevel (id, name, permissions) VALUES (?,?,?)';
            $data = array($id, $name, $permissions);

            $this->db->query($sql, $data);

            if ($this->db->affected_rows() === 1)
            {
                echo 'User Level "'.$id.'" created ok....<br />';
            }
            else
            {
                echo 'User Level "'.$id.'" NOT created!<br />';
            }
        
        }
        
        
    }
    
    
    
    
    
    public function add_permission ($args = array())
    {
        
        $id = isset($args['id']) ? $args['id'] : '';
        $name = isset($args['name']) ? $args['name'] : '';
        $description = isset($args['description']) ? $args['description'] : '';
        
        
        //does user already exist?
        if ($this->data_model->get_value ('{pre}permissions', 'id', $id, 'id', 0) != 0) {
            
            echo 'Skipping Permission "'.$id.'", already exists....<br />';
            
        }
        else
        {        

            $sql = 'INSERT INTO {pre}permissions (id, name, description) VALUES (?,?,?)';
            $data = array($id, $name, $description);

            $this->db->query($sql, $data);

            if ($this->db->affected_rows() === 1)
            {
                echo 'Permission "'.$id.'" created ok....<br />';
            }
            else
            {
                echo 'Permission "'.$id.'" NOT created!<br />';
            }
        
        }        
        
    }

    
    
    
    
    public function add_country ($args = array())
    {
        
        $id = isset($args['id']) ? $args['id'] : '';
        $name = isset($args['name']) ? $args['name'] : '';
        
        
        //does user already exist?
        if ($this->data_model->get_value ('{pre}country', 'id', $id, 'id', 0) != 0) {
            
            echo 'Skipping Country "'.$id.'", already exists....<br />';
            
        }
        else
        {        

            $sql = 'INSERT INTO {pre}country (id, name) VALUES (?,?)';
            $data = array($id, $name);

            $this->db->query($sql, $data);

            if ($this->db->affected_rows() === 1)
            {
                echo 'Country "'.$id.'" created ok....<br />';
            }
            else
            {
                echo 'Country "'.$id.'" NOT created!<br />';
            }
        
        }        
        
    }
    
    
    
    
    
    public function add_nationality ($args = array())
    {
        
        $id = isset($args['id']) ? $args['id'] : '';
        $name = isset($args['name']) ? $args['name'] : '';
        
        
        //does nationality already exist?
        if ($this->data_model->get_value ('{pre}nationality', 'id', $id, 'id', 0) != 0) {
            
            echo 'Skipping Nationality "'.$id.'", already exists....<br />';
            
        }
        else
        {        

            $sql = 'INSERT INTO {pre}nationality (id, name) VALUES (?,?)';
            $data = array($id, $name);

            $this->db->query($sql, $data);

            if ($this->db->affected_rows() === 1)
            {
                echo 'Nationality "'.$id.'" created ok....<br />';
            }
            else
            {
                echo 'Nationality "'.$id.'" NOT created!<br />';
            }
        
        }        
        
    }
    
    
    
    
    
    public function add_gender ($args = array())
    {
        
        $id = isset($args['id']) ? $args['id'] : '';
        $name = isset($args['name']) ? $args['name'] : '';
        
        
        //does gender already exist?
        if ($this->data_model->get_value ('{pre}gender', 'id', $id, 'id', 0) != 0) {
            
            echo 'Skipping Gender "'.$id.'", already exists....<br />';
            
        }
        else
        {        

            $sql = 'INSERT INTO {pre}gender (id, name) VALUES (?,?)';
            $data = array($id, $name);

            $this->db->query($sql, $data);

            if ($this->db->affected_rows() === 1)
            {
                echo 'Gender "'.$id.'" created ok....<br />';
            }
            else
            {
                echo 'Gender "'.$id.'" NOT created!<br />';
            }
        
        }        
        
    }
    
    
    
    
    
    
    
    public function add_grade ($args = array())
    {
        
        $id = isset($args['id']) ? $args['id'] : '';
        $name = isset($args['name']) ? $args['name'] : '';
        
        
        //does gender already exist?
        if ($this->data_model->get_value ('{pre}qualification_grade', 'id', $id, 'id', 0) != 0) {
            
            echo 'Skipping Grade "'.$id.'", already exists....<br />';
            
        }
        else
        {        

            $sql = 'INSERT INTO {pre}qualification_grade (id, name) VALUES (?,?)';
            $data = array($id, $name);

            $this->db->query($sql, $data);

            if ($this->db->affected_rows() === 1)
            {
                echo 'Grade "'.$id.'" created ok....<br />';
            }
            else
            {
                echo 'Grade "'.$id.'" NOT created!<br />';
            }
        
        }        
        
    }
    
    
    
    
    
    public function add_level ($args = array())
    {
        
        $id = isset($args['id']) ? $args['id'] : '';
        $name = isset($args['name']) ? $args['name'] : '';
        
        
        //does gender already exist?
        if ($this->data_model->get_value ('{pre}qualification_level', 'id', $id, 'id', 0) != 0) {
            
            echo 'Skipping Level "'.$id.'", already exists....<br />';
            
        }
        else
        {        

            $sql = 'INSERT INTO {pre}qualification_level (id, name) VALUES (?,?)';
            $data = array($id, $name);

            $this->db->query($sql, $data);

            if ($this->db->affected_rows() === 1)
            {
                echo 'Level "'.$id.'" created ok....<br />';
            }
            else
            {
                echo 'Level "'.$id.'" NOT created!<br />';
            }
        
        }        
        
    }
    
    
    
    
    
    
    public function add_subject ($args = array())
    {
        
        $id = isset($args['id']) ? $args['id'] : '';
        $name = isset($args['name']) ? $args['name'] : '';
        
        
        //does gender already exist?
        if ($this->data_model->get_value ('{pre}qualification_subject', 'id', $id, 'id', 0) != 0) {
            
            echo 'Skipping Subject "'.$id.'", already exists....<br />';
            
        }
        else
        {        

            $sql = 'INSERT INTO {pre}qualification_subject (id, name) VALUES (?,?)';
            $data = array($id, $name);

            $this->db->query($sql, $data);

            if ($this->db->affected_rows() === 1)
            {
                echo 'Subject "'.$id.'" created ok....<br />';
            }
            else
            {
                echo 'Subject "'.$id.'" NOT created!<br />';
            }
        
        }        
        
    }
    
    
    
}

?>