<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="center_me">

	<div class="form_container">
	    
	    <div class="form_title"><?php echo lang('edit').' Role'; ?></div>
	    
		<?php echo form_open('role/edit/'.$role->id, 'class="my_form"'); ?>
		
		<table class="form_table">
  
		    <tr>
		        <td class="form_required_message" colspan="2"><?php echo lang('required_message'); ?></td>
		    </tr>		    
		   
		    <tr>
		        <td class="field_title form_required"><?php echo lang('name'); ?></td>        
		        <td class="field_value"><input type="text" class="my_input" name="name" value="<?php echo set_value('name', $role->name); ?>" /></td>
		    </tr>
		    <?php if (form_error('name')) { echo '<tr><td class="form_error" colspan="2">'.form_error('name').'</td></tr>'; } ?>
		    
		    <tr>
		        <td class="field_title form_required"><?php echo lang('level'); ?></td>        
		        <td class="field_value"><input type="number" class="my_input" name="level" value="<?php echo set_value('level', $role->level); ?>" /></td>
		    </tr>
		    <?php if (form_error('level')) { echo '<tr><td class="form_error" colspan="2">'.form_error('level').'</td></tr>'; } ?>
		    
		    <tr>
		        <td colspan="2" class="field_title form_required" style="text-align: left;"><?php echo lang('description'); ?></td> 
		    </tr>
		    
		    <tr>       
		        <td colspan="2" class="field_value">
		        	<textarea class="my_textarea" style="width:400px; height:100px;" name="description"><?php echo set_value('description', $role->description); ?></textarea>
		        </td>
		    </tr>
		    <?php if (form_error('description')) { echo '<tr><td class="form_error" colspan="2">'.form_error('description').'</td></tr>'; } ?>

		</table>
		
		<div class="table_buttons">
			<input type="submit" value="<?php echo lang('submit'); ?>" class="button" />
			<?php echo anchor('role/view/', lang('cancel'), 'class="button"'); ?>
		</div>
		
		</form>
		
	</div>
    
</div>