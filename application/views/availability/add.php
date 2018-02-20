<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php use_tinymce(); ?>

<div class="center_me">

	<div class="form_container">
	    
	    <div class="form_title"><?php echo lang('add').' Availability'; ?></div>
	    
		<?php echo form_open('availability/add', 'class="my_form"'); ?>
		    
		<table class="form_table">
  
		    <tr>
		        <td class="form_required_message" colspan="2"><?php echo lang('required_message'); ?></td>
		    </tr>		    
		   
		   <tr>
		        <td class="field_title form_required">Sort:</td>        
		        <td class="field_value"><input type="number" class="my_input" name="sort" value="<?php echo set_value('value'); ?>" /></td>
		    </tr>
		    <?php if (form_error('sort')) { echo '<tr><td class="form_error" colspan="2">'.form_error('sort').'</td></tr>'; } ?>
		   
		    <tr>
		        <td class="field_title form_required">Name:</td>        
		        <td class="field_value"><input type="text" class="my_input" name="name" value="<?php echo set_value('name'); ?>" /></td>
		    </tr>
		    <?php if (form_error('name')) { echo '<tr><td class="form_error" colspan="2">'.form_error('name').'</td></tr>'; } ?>

		</table>
		
		<div class="table_buttons">
			<input type="submit" value="<?php echo lang('submit'); ?>" class="button" />
			<?php echo anchor('rarity/view/', lang('cancel'), 'class="button"'); ?>
		</div>
		
		</form>
		
	</div>
    
</div>