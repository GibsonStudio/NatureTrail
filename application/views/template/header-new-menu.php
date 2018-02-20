<!DOCTYPE HTML>
<html>
    
    <head>
        <title>CAE OAA Applications</title>
        <link href="<?php echo css_path(); ?>/style.css" type="text/css" rel="stylesheet" />
        <script src="<?php echo js_path(); ?>jquery-1.10.1.min.js" type="text/javascript"></script>
        <script src="<?php echo js_path(); ?>global.inc.js" type="text/javascript"></script>
    </head>
    
<body>

	
    <div id="overlay">
    	<div id="overlay_message"></div>
    	<div id="hide_message" onClick="hide_message()"></div>
    </div>
    
    <div id="header">
    
    	<div id="header_logo"></div>
    	
        <div id="header_login">
        
            <?php
            
            echo '<a href="javascript:toggle_menu();">Menu</a> | ';
            
            if ($this->user_model->is_logged_in())
            {
                
                // user is logged in
                $name = $this->session->userdata('firstname').' ';
                $name .= $this->session->userdata('lastname');
                $userid = $this->session->userdata('id');
                echo anchor('user/view/'.$userid, $name, 'title="'.lang('view_profile').'"');
                echo ' | ';
                echo anchor('logout', lang('logout'));
                
            }
            else
            {
                
                //show link to log in
                echo anchor('login', lang('login'));
                
                if ($this->config_model->get_config('allow_registration') == 1)
                {
                	
                	echo ' | ';
                	echo anchor('user/register', lang('register_account'));
                	
                }
                
            }
            ?>
        
        </div> 
    </div>

        
    
    <div id="menu">
        
        <?php 
        
        //profile menu -->
        echo '<div class="menu_heading">Profile</div>';
        
        if ($this->user_model->is_logged_in()) {
        	
        	echo anchor('user/view/'.$this->session->userdata('id'), '<button>View Profile</button>');
        	echo anchor('logout', '<button>Log Out</button>');
        	
        } else {

        	echo anchor('login', 'Log In');
        	
        	if ($this->config_model->get_config('allow_registration') == 1) {
        		echo anchor('user/register', '<button>Register</button>');
        	}
        	
        }
        
        
        //admin menu
        echo '<div class="menu_heading">Admin</div>';
        
        if ($this->user_model->has_permission('see_admin_menu')) {
        	
        	//users
        	if ($this->user_model->has_permission('view_all_profiles') || $this->user_model->has_permission('add_user')) {
        		
        		echo '<div class="menu_sub_heading">Users</div>';
        		
        		if ($this->user_model->has_permission('view_all_profiles')) {
        			echo anchor('user/viewall', '<button>View All</button>');
        			echo anchor('user/search', '<button>Search Users</button>');
        		}
        		
        		if ($this->user_model->has_permission('add_user')) {
        			echo anchor('user/add', '<button>Add User</button>');
        		}
        		
        		if ($this->user_model->has_permission('select_users')) {
        			echo anchor('user/select', '<button>Select Users</button>');
        		}
        		
        		if ($this->user_model->has_permission('manage_roles')) {
        			echo anchor('role/view', '<button>Manage Roles</button>');
        		}
        		
        		if ($this->user_model->has_permission('manage_permissions')) {
        			echo anchor('permission/view', '<button>Manage Permissions</button>');
        		}
        		
        		//groups
        		if ($this->user_model->has_permission('manage_groups')) {
        			echo '<br /><div class="menu_sub_heading">Groups</div>';
        			echo anchor('group/view', '<button>Manage Groups</button>');
        		}

        		//blocks
        		if ($this->user_model->has_permission('manage_blocks')) {
        			echo '<br /><div class="menu_sub_heading">Frontpage Blocks</div>';
        			echo anchor('block/viewall', '<button>Manage Blocks</button>');
        		}

        		//misc
        		echo '<br /><div class="menu_sub_heading">Misc</div>';
        		
        		if ($this->user_model->has_permission('manage_email_templates')) {
        			echo anchor('email/view_templates', '<button>Manage Email Templates</button>');
        		}

        		if ($this->user_model->has_permission('view_logs')) {
        			echo anchor('debug/view_changelog', '<button>View Change Log</button>');
        			echo anchor('log', '<button>View Logs</button>');
        		}

        		if ($this->user_model->has_permission('change_config')) {
        			echo anchor('config/view', '<button>Config</button>');
        		}        		
        	
            }
            
        }
        
        
        
        //debug menu
        if ($this->user_model->has_permission('view_debug')) {
            	
          	echo '<div class="menu_heading">Debug</div>';            	
           	echo anchor('debug/view_session_data', '<button>View Session Data</button>');
            	
           	if ($this->user_model->has_permission('update_database')) {
           		echo anchor('debug/update_database', '<button>Update Database</button>');
           	}
            	
           	echo anchor('debug/test', '<button>Test</button>');
           	
        }
            
            
            
        //bug tracker menu
        if ($this->user_model->has_permission('manage_bug_tracker')) {
            	
           	echo '<div class="menu_heading">Bug Tracker</div>';
           	echo anchor('bug_tracker/view', '<button>View Open</button>');
           	echo anchor('bug_tracker/view/1', '<button>View All</button>');
           	echo anchor('bug_tracker/add', '<button>Add Bug</button>');
           	echo anchor('bug_tracker/purge', '<button>Purge Bugs</button>');
            	
        }
		?>
        
        <div style="clear: both;"></div>
        
    </div>   
    
    <div id="content">