<!DOCTYPE HTML>
<html>

    <head>
        <title>Nature Trail</title>
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

        <ul>

            <li style="z-index: 9999;"><?php echo anchor('home', 'Home'); ?></li>



            <!-- my profile menu -->
            <li style="z-index: 9998;"><div class="no_link no_select" onClick="return true">My Profile</div>
                <ul>
                    <?php if ($this->user_model->is_logged_in()) { ?>

                        <li><?php echo anchor('user/view/'.$this->session->userdata('id'), 'View Profile'); ?></li>
                        <li><?php echo anchor('logout', 'Log Out'); ?></li>

                    <?php } else { ?>

                        <li><?php echo anchor('login', 'Log In'); ?></li>

                        <?php if ($this->config_model->get_config('allow_registration') == 1) { ?>
                        	<li><?php echo anchor('user/register', 'Register'); ?></li>
                        <?php } ?>

                    <?php } ?>
                </ul>
            </li>




            <!-- admin menu -->
            <?php if ($this->user_model->has_permission('see_admin_menu')) { ?>
            <li style="z-index: 9997;"><div class="no_link no_select" onClick="return true">Admin</div>
                <ul>

                	<!-- users -->
                	<?php if ($this->user_model->has_permission('view_all_profiles') || $this->user_model->has_permission('add_user')) { ?>

                		<li><div class="menu_title no_select">Users</div></li>

                		<?php if ($this->user_model->has_permission('view_all_profiles')) { ?>
                			<li><?php echo anchor('user/viewall', 'View All'); ?></li>
                			<li><?php echo anchor('user/search', 'Search Users'); ?></li>
                		<?php } ?>

                		<?php if ($this->user_model->has_permission('add_user')) { ?>
                			<li><?php echo anchor('user/add', 'Add User'); ?></li>
                		<?php } ?>

                		<?php if ($this->user_model->has_permission('select_users')) { ?>
                			<li><?php echo anchor('user/select', 'Select Users'); ?></li>
                		<?php } ?>

                		<?php if ($this->user_model->has_permission('manage_roles')) { ?>
                			<li><?php echo anchor('role/view', 'Manage Roles'); ?></li>
                		<?php } ?>

                		<?php if ($this->user_model->has_permission('manage_permissions')) { ?>
                			<li><?php echo anchor('permission/view', 'Manage Permissions'); ?></li>
                		<?php } ?>

                	<?php } ?>
                	
                	<!-- blocks -->
                	<?php if ($this->user_model->has_permission('manage_blocks')) { ?>
                		<li><div class="menu_title no_select">Frontpage Blocks</div></li>
                		<li><?php echo anchor('block/viewall', 'Manage Blocks'); ?></li>
                	<?php } ?>

                	<!-- trails -->
                	<?php if ($this->user_model->has_permission('manage_objects')) { ?>
                		<li><div class="menu_title no_select">Trails</div></li>
                		<li><?php echo anchor('object/viewall', 'Manage Objects'); ?></li>
                		<li><?php echo anchor('trail/viewall', 'Manage Trails'); ?></li>
                	<?php } ?>


                	<!-- misc -->
                	<li><div class="menu_title no_select">Misc</div></li>
                   	<li><?php echo anchor('debug/view_changelog', 'View Change Log'); ?></li>

                   	<?php if ($this->user_model->has_permission('manage_rarity')) { ?>
                		<li><?php echo anchor('rarity/view', 'Manage Rarities'); ?></li>
                	<?php } ?>

                   	<?php if ($this->user_model->has_permission('manage_availability')) { ?>
                		<li><?php echo anchor('availability/view', 'Manage Availabilities'); ?></li>
                	<?php } ?>

                   	<?php if ($this->user_model->has_permission('manage_email_templates')) { ?>
                		<li><?php echo anchor('email/view_templates', 'Manage Email Templates'); ?></li>
                	<?php } ?>

                	<?php if ($this->user_model->has_permission('view_logs')) { ?>
                		<li><?php echo anchor('log', 'View Logs'); ?></li>
                	<?php } ?>

                	<?php if ($this->user_model->has_permission('change_config')) { ?>
                		<li><?php echo anchor('config/view', 'Config'); ?></li>
                	<?php } ?>

                </ul>
            </li>
            <?php } ?>



            <!-- debug menu -->
            <?php if ($this->user_model->has_permission('view_debug')) { ?>
            <li style="z-index: 9992;"><div class="no_link no_select" onClick="return true">Debug</div>
                <ul>
                    <li><?php echo anchor('debug/view_session_data', 'View Session Data'); ?></li>

            		<?php if ($this->user_model->has_permission('update_database')) { ?>
            		<li><?php echo anchor('debug/update_database', 'Update Database'); ?></li>
            		<?php } ?>

            		<li><?php echo anchor('debug/test', 'Test'); ?></li>

                </ul>
            </li>
            <?php } ?>



            <!-- bug tracker menu -->
            <?php if ($this->user_model->has_permission('manage_bug_tracker')) { ?>
            <li style="z-index: 9991;"><div class="no_link no_select" onClick="return true">Bug Tracker</div>
            	<ul>
            		<li><?php echo anchor('bug_tracker/view', 'View Open'); ?></li>
            		<li><?php echo anchor('bug_tracker/view/1', 'View All'); ?></li>
            		<li><?php echo anchor('bug_tracker/add', 'Add Bug'); ?></li>
            		<li><?php echo anchor('bug_tracker/purge', 'Purge Bugs'); ?></li>
            	</ul>
            </li>
            <?php } ?>







            <?php if (isset($menu)) { echo $menu; } ?>

        </ul>

        <div style="clear: both;"></div>

    </div>

    <div id="content">
