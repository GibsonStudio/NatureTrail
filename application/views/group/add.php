<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php use_tinymce(); ?>

<div class="center_me">

	<div class="form_container">
	    
	    <div class="form_title"><?php echo lang('add').' Group'; ?></div>
	    
		<?php echo form_open('group/add', 'class="my_form"'); ?>
		    
		<table class="form_table">
  
		    <tr>
		        <td class="form_required_message" colspan="2"><?php echo lang('required_message'); ?></td>
		    </tr>		    
		   
		    <tr>
		        <td class="field_title form_required"><?php echo lang('name'); ?></td>        
		        <td class="field_value"><input type="text" class="my_input" name="name" value="<?php echo set_value('name'); ?>" /></td>
		    </tr>
		    <?php if (form_error('name')) { echo '<tr><td class="form_error" colspan="2">'.form_error('name').'</td></tr>'; } ?>
		    		    	    
		    <tr><td class="field_title" colspan="2" style="text-align: left;"><?php echo lang('description'); ?></td></tr>
		    <tr><td class="field_value" colspan="2"><textarea class="my_textarea use_tinymce" style="width: 400px; height: 300px;" name="description"><?php echo set_value('description'); ?></textarea></td></tr>
		    <?php if (form_error('description')) { echo '<tr><td class="form_error" colspan="2">'.form_error('description').'</td></tr>'; } ?>
		    
		</table>
		
		<div class="table_buttons">
			<input type="submit" value="<?php echo lang('submit'); ?>" class="button" />
			<?php echo anchor('group/view/', lang('cancel'), 'class="button"'); ?>
		</div>
		
		</form>
		
	</div>
    
</div>