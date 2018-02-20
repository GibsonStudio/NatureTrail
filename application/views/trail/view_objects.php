<br /><div class="center_me"><?php echo anchor('trail/viewall', 'Back to Trails', 'class="button"'); ?></div><br />

<div class="content_box">

	<div class="form_title">Group "<?php echo $trailname; ?>"</div>

	
	
	<table style="width:100%;">
	
	<tr>
		<td>Obects in Trail (<?php echo count($objects); ?>)</td>
		<td></td>
		<td>Available to be added (<?php echo count($available); ?>)</td>
	</tr>
	
	<tr>
	
	<td><?php echo form_open('trail/view_objects/'.$trailid, 'class="my_form"'); ?>
	
	<select name="in_trail[]" multiple style="width:100%;" size="20"><?php 
	
	foreach ($objects as $object)
	{
		echo '<option value="'.$object['id'].'">'.$object['name'].'</option>';
	}
	
	?></select></td>
	
	<td style="text-align: center;">
	<input type="submit" name="remove" value="Remove >>>" /><br />
	<input type="submit" name="add" value="<<< Add" />
	</td>
	
	<td><select name="available[]" multiple style="width:100%;" size="20"><?php 
	
	foreach ($available as $object)
	{
		echo '<option value="'.$object['id'].'">'.$object['name'].'</option>';
	}
	
	?></select></td>
	
	
	
	</form>
	
	</tr></table>
	
</div>
