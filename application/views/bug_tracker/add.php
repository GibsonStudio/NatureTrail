<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php use_tinymce(); ?>

<div class="center_me">

	<div class="form_container">
	    
	    <div class="form_title"><?php echo lang('add').' Bug'; ?></div>
	    
		<?php echo form_open('bug_tracker/add', 'class="my_form"'); ?>
		    
		<table class="form_table">
  
		    <tr>
		        <td class="form_required_message" colspan="2"><?php echo lang('required_message'); ?></td>
		    </tr>
		    
		    <tr>
		        <td class="field_title form_required align_left" colspan="2"><?php echo lang('comment'); ?></td>
		    </tr>
		    <tr>        
		        <td class="field_value" colspan="2">
		        	<textarea class="my_textarea use_tinymce" style="width:400px; height:200px;" name="comment"><?php echo set_value('comment'); ?></textarea>
		        </td>
		    </tr>
		    <?php if (form_error('comment')) { echo '<tr><td class="form_error" colspan="2">'.form_error('comment').'</td></tr>'; } ?>		    
		    
		    <tr>
		        <td class="field_title"><?php echo lang('priority'); ?></td>  
		        <td class="field_value"><input type="number" name="priority" min="0" max="10" value="<?php echo set_value('priority', 0); ?>" /></td>    
		    </tr>
		    <?php if (form_error('priority')) { echo '<tr><td class="form_error" colspan="2">'.form_error('priority').'</td></tr>'; } ?>	
		    
		</table>
		
		<div class="table_buttons">
			<input type="submit" value="<?php echo lang('submit'); ?>" class="button" />
			<?php echo anchor('bug_tracker/view/', lang('cancel'), 'class="button"'); ?>
		</div>
		
		</form>
		
	</div>
    
</div>