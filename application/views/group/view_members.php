<br /><div class="center_me"><?php echo anchor('group/view', 'Back to Groups', 'class="button"'); ?></div><br />

<div class="content_box">

	<div class="form_title">Group "<?php echo $groupname; ?>"</div>

	
	
	<table style="width:100%;">
	
	<tr>
		<td>Users in Group (<?php echo count($members); ?>)</td>
		<td></td>
		<td>Available to be added (<?php echo count($available); ?>)</td>
	</tr>
	
	<tr>
	
	<td><?php echo form_open('group/view_members/'.$groupid, 'class="my_form"'); ?>
	
	<select name="in_group[]" multiple style="width:100%;" size="20"><?php 
	
	foreach ($members as $user)
	{
		echo '<option value="'.$user['id'].'">'.$user['firstname'].' '.$user['lastname'].' ('.$user['email'].')</option>';
	}
	
	?></select></td>
	
	<td style="text-align: center;">
	<input type="submit" name="remove" value="Remove >>>" /><br />
	<input type="submit" name="add" value="<<< Add" />
	</td>
	
	<td><select name="available[]" multiple style="width:100%;" size="20"><?php 
	
	foreach ($available as $user)
	{
		echo '<option value="'.$user['id'].'">'.$user['firstname'].' '.$user['lastname'].' ('.$user['email'].')</option>';
	}
	
	?></select></td>
	
	
	
	</form>
	
	</tr></table>
	
</div>
