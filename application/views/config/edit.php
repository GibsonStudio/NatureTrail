<div class="data_table_container">
    
    <?php echo form_open('config/edit/'.$config['id'], 'class="my_form"'); ?>
    
	    <table class="data_table">
	        
	        <tr>
	            <td class="data_table_title" colspan="2">Set Config:</td>
	        </tr>
	        
	        <tr>
	            <td><?php echo $config['var']; ?></td>
	            <td><input type="text" class="my_input" name="value" value="<?php echo set_value('value', $config['value']); ?>" /></td>
	        </tr>   
	           
	        <?php if (form_error('value')) { echo '<tr><td class="form_error" colspan="2">'.form_error('value').'</td></tr>'; } ?>
	        
	        <tr>
	        	<td colspan="2" class="table_buttons">
	        		<input type="submit" value="<?php echo lang('submit'); ?>" class="button" />
					<?php echo anchor('config/view/', lang('cancel'), 'class="button"'); ?>
	        	</td>
	        </tr>
	        	
	    </table>
		
	</form>
	
</div>