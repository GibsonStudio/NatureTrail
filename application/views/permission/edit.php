<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="center_me">

	<div class="form_container">
	    
	    <div class="form_title"><?php echo lang('edit').' Permission'; ?></div>
	    
		<?php echo form_open('permission/edit/'.$permission->id, 'class="my_form"'); ?>
		
		<table class="form_table">
  
		    <tr>
		        <td class="form_required_message" colspan="2"><?php echo lang('required_message'); ?></td>
		    </tr>		    
		   
		    <tr>
		        <td class="field_title form_required"><?php echo lang('name'); ?></td>        
		        <td class="field_value"><input type="text" class="my_input" name="name" value="<?php echo set_value('name', $permission->name); ?>" /></td>
		    </tr>
		    <?php if (form_error('name')) { echo '<tr><td class="form_error" colspan="2">'.form_error('name').'</td></tr>'; } ?>
		    
		    <tr>
		        <td class="field_title form_required"><?php echo lang('heading'); ?></td>        
		        <td class="field_value"><?php echo $this->data_model->get_boolean_select('heading', set_value('heading', $permission->heading)); ?></td>
		    </tr>
		    <?php if (form_error('heading')) { echo '<tr><td class="form_error" colspan="2">'.form_error('heading').'</td></tr>'; } ?>
		    
		    
		    <tr>
		        <td class="field_title form_required"><?php echo lang('sort'); ?></td>        
		        <td class="field_value"><input type="number" class="my_input" name="sort" value="<?php echo set_value('sort', $permission->sort); ?>" /></td>
		    </tr>
		    <?php if (form_error('sort')) { echo '<tr><td class="form_error" colspan="2">'.form_error('sort').'</td></tr>'; } ?>
		    
		    
		    <tr>
		        <td colspan="2" class="field_title form_required" style="text-align: left;"><?php echo lang('description'); ?></td> 
		    </tr>
		    
		    <tr>       
		        <td colspan="2" class="field_value">
		        	<textarea class="my_textarea" style="width:400px; height:100px;" name="description"><?php echo set_value('description', $permission->description); ?></textarea>
		        </td>
		    </tr>
		    <?php if (form_error('description')) { echo '<tr><td class="form_error" colspan="2">'.form_error('description').'</td></tr>'; } ?>

		</table>
		
		<div class="table_buttons">
			<input type="submit" value="<?php echo lang('submit'); ?>" class="button" />
			<?php echo anchor('permission/view/', lang('cancel'), 'class="button"'); ?>
		</div>
		
		</form>
		
	</div>
    
</div>