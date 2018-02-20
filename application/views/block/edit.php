<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php use_tinymce(); ?>

<div class="center_me">

	<div class="form_container">
	    
	    <div class="form_title"><?php echo lang('edit').' Block'; ?></div>
	    
		<?php echo form_open('block/edit/'.$block->id, 'class="my_form"'); ?>
		
		<table class="form_table">
  
		    <tr>
		        <td class="form_required_message" colspan="2"><?php echo lang('required_message'); ?></td>
		    </tr>		    
		   
		    <tr>
		        <td class="field_title form_required"><?php echo lang('title'); ?></td>        
		        <td class="field_value"><input type="text" class="my_input" name="title" value="<?php echo set_value('title', $block->title); ?>" /></td>
		    </tr>
		    <?php if (form_error('title')) { echo '<tr><td class="form_error" colspan="2">'.form_error('title').'</td></tr>'; } ?>
		    
		    <tr><td class="form_message" colspan="2" style="padding: 20px;"><?php echo lang('image_help'); ?></td></tr>
		    		    
		    <tr><td class="field_title form_required" colspan="2" style="text-align: left;"><?php echo lang('content'); ?></td></tr>
		    <tr><td class="field_value" colspan="2"><textarea class="my_textarea use_tinymce" style="width: 400px; height: 300px;" name="content"><?php echo set_value('content', $block->content); ?></textarea></td></tr>
		    <?php if (form_error('content')) { echo '<tr><td class="form_error" colspan="2">'.form_error('content').'</td></tr>'; } ?>
		    
		     <tr>
		        <td class="field_title form_required"><?php echo lang('active'); ?></td>        
		        <td class="field_value"><?php echo $this->data_model->get_boolean_select('active', set_value('active', $block->active)); ?></td>
		    </tr>
		    <?php if (form_error('active')) { echo '<tr><td class="form_error" colspan="2">'.form_error('active').'</td></tr>'; } ?>
		    
		    <tr>
		        <td class="field_title form_required"><?php echo lang('position'); ?></td>        
		        <td class="field_value"><?php echo $this->data_model->get_position_select('position', set_value('position', $block->position)); ?></td>
		    </tr>
		    <?php if (form_error('position')) { echo '<tr><td class="form_error" colspan="2">'.form_error('position').'</td></tr>'; } ?>
		    		    
		    <tr>
		        <td class="field_title form_required"><?php echo lang('show_content_only'); ?></td>        
		        <td class="field_value"><?php echo $this->data_model->get_boolean_select('show_content_only', set_value('show_content_only', $block->show_content_only)); ?></td>
		    </tr>
		    <?php if (form_error('show_content_only')) { echo '<tr><td class="form_error" colspan="2">'.form_error('show_content_only').'</td></tr>'; } ?>
		    
		    <tr>
		        <td class="field_title form_required"><?php echo get_mini_help(lang('sort_help')).lang('sort'); ?></td>        
		        <td class="field_value"><input type="number" name="sort" value="<?php echo set_value('sort', $block->sort); ?>" /></td>
		    </tr>
		    <?php if (form_error('sort')) { echo '<tr><td class="form_error" colspan="2">'.form_error('sort').'</td></tr>'; } ?>
		    	
		    
		    
		    
		    
		</table>
		
		<div class="table_buttons">
			<input type="submit" value="<?php echo lang('submit'); ?>" class="button" />
			<?php echo anchor('block/viewall/', lang('cancel'), 'class="button"'); ?>
		</div>
		
		</form>
		
	</div>
    
</div>