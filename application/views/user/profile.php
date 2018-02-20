<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $user->profileimage = isset($user->profileimage) ? $user->profileimage : 'default.jpg';
    if ($user->profileimage == '' || $user->profileimage == NULL) { $user->profileimage = 'default.jpg'; }
    if (!file_exists(BASEPATH.'../images/profile/'.$user->profileimage)) { $user->profileimage = 'missing.jpg'; }
?>

<div style="text-align: center;">

	<div class="content_box">
	    
	    <table style="width:100%;">
	                
	        <tr>
	            <td>
	                <?php
	 
	                    $img = '<img src="'.image_path().'profile/'.$user->profileimage.'" alt="'.$user->profileimage.'" class="profile_pic" />';
	                    if ($this->user_model->has_permission('upload_profile_image'))
	                    {
	                        echo anchor('user/uploadprofileimage/'.$user->id, $img, 'title="'.lang('upload_image').'"');
	                    }
	                    else
	                    {
	                        echo $img;
	                    }
	                ?>
	            </td>
	            <td class="profile_name"><?php echo $user->firstname.' '.$user->middlenames.' '.$user->lastname; ?></td>
	        </tr>
	        
	        <?php if (!empty($user->knownas)) { ?>  
	        <tr>
	            <td class="field_title"><?php echo lang('knownas'); ?></td>
	            <td class="field_value"><?php echo $user->knownas; ?></td>
	        </tr>
	        <?php } ?>
	             
	        <tr>
	            <td class="field_title"><?php echo lang('email'); ?></td>
	            <td class="field_value"><?php echo $user->email; ?></td>
	        </tr>
	        
	        <tr>
	            <td class="field_title"><?php echo lang('accesslevel'); ?></td>
	            <td class="field_value"><?php echo $this->data_model->get_value('accesslevel', 'name', $user->accesslevel); ?></td>
	        </tr>        
	        
	        
	        <?php if (count($groups) > 0) { ?>
	        <tr>
	        	<td class="field_title align_top">Groups</td>
	            <td class="field_value"><?php 
	            
	            foreach ($groups as $group)
	            {
	            	echo $group['name'].'<br />';
	            }
	            
	            ?></td>
	        </tr>
	        <?php } ?>
	
	        
	    </table>
	    
	    <div class="table_buttons">
	    	<?php    	
	    	if (!$this->user_model->email_confirmed($user->id))
	    	{
	    		echo anchor('user/request_send_confirm_email/'.$user->id, lang('confirm_email'), 'class="button_small"');
	    	}
	    	
	    	echo anchor('user/edit/'.$user->id, lang('edit'), 'class="button_small"');
	    	
	    	if ($this->user_model->has_permission('email_user'))
	    	{
	    		echo '<a href="mailto:'.$user->email.'" class="button_small">'.lang('email').'</a>';
	    	}
	    	
	    	?>
	    </div>
	    
	    <?php if ($this->user_model->has_permission('see_modifier')) { ?>    
	    <table class="table_modified">
	    
	    	<tr>
		    	<td class="field_title"><?php echo lang('timemodified'); ?></td>
		    	<td class="field_value"><?php echo timestamp_to_string($user->timemodified); ?></td>
		    </tr>
		    
		    <tr>
		    	<td class="field_title"><?php echo lang('modifierid'); ?></td>
		    	<td class="field_value"><?php echo $this->data_model->get_name($user->modifierid); ?></td>
		    </tr>
		    
		</table>
		<?php } ?>
	
		
	    <?php if ($this->user_model->has_permission('see_login_details')) { ?>    
	    <table class="table_modified">
	    	    
		    <tr>
		    	<td class="field_title"><?php echo lang('lastlogin'); ?></td>
		    	<td class="field_value"><?php echo timestamp_to_string($user->lastlogin); ?></td>
		    </tr>
	
		    <tr>
		    	<td class="field_title"><?php echo lang('lastlogout'); ?></td>
		    	<td class="field_value"><?php echo timestamp_to_string($user->lastlogout); ?></td>
		    </tr>
		    
		    <tr>
		    	<td class="field_title"><?php echo lang('lastip'); ?></td>
		    	<td class="field_value"><?php echo $user->lastip; ?></td>
		    </tr>        
	        
	    </table>    
	    <?php } ?>
	    
	</div>

</div>












