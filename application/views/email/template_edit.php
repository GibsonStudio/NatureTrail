<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php use_tinymce(); ?>

<div class="center_me">

	<div class="form_container">
	    
	    <div class="form_title"><?php echo lang('edit_template'); ?></div>
	    
		<?php echo form_open('email/edit_template/'.$template->id, 'class="my_form"'); ?>
		
		<table class="form_table">
  
		    <tr>
		        <td class="form_required_message" colspan="2"><?php echo lang('required_message'); ?></td>
		    </tr>		    
		   
		    <tr>
		        <td class="field_title form_required"><?php echo lang('name'); ?></td>        
		        <td class="field_value"><input type="text" class="my_input" name="name" value="<?php echo set_value('name', $template->name); ?>" /></td>
		    </tr>
		    <?php if (form_error('name')) { echo '<tr><td class="form_error" colspan="2">'.form_error('name').'</td></tr>'; } ?>

		    		    
		    <tr><td class="field_title form_required" colspan="2" style="text-align: left;"><?php echo lang('content'); ?></td></tr>
		    <tr><td class="field_value" colspan="2"><textarea class="my_textarea use_tinymce" style="width: 400px; height: 300px;" name="content"><?php echo set_value('content', $template->content); ?></textarea></td></tr>
		    <?php if (form_error('content')) { echo '<tr><td class="form_error" colspan="2">'.form_error('content').'</td></tr>'; } ?>
		    
		    <tr>
		        <td class="field_title form_required"><?php echo get_mini_help(lang('sort_help')).lang('sort'); ?></td>        
		        <td class="field_value"><input type="number" name="sort" value="<?php echo set_value('sort', $template->sort); ?>" /></td>
		    </tr>
		    <?php if (form_error('sort')) { echo '<tr><td class="form_error" colspan="2">'.form_error('sort').'</td></tr>'; } ?>

		    <tr>
		    	<td colspan="2" style="padding: 10px; text-align: left;"><?php echo lang('var_help'); ?></td>
		    </tr>
		    
		</table>
		
		<div class="table_buttons">
			<input type="submit" value="<?php echo lang('submit'); ?>" class="button" />
			<?php echo anchor('email/view_templates/', lang('cancel'), 'class="button"'); ?>
		</div>
		
		</form>
		
	</div>
    
</div>