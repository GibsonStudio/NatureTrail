<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>  

<div class="center_me">

<div class="form_container">
    
    <div class="form_title"><?php echo lang('reset_password'); ?></div>  
    
<?php echo form_open('user/reset_password/'.$key, 'class="my_form"'); ?>
    
<table class="form_table">
 
 	<input type="hidden" name="key" value="<?php echo $key; ?>" />
 	
    <tr>
        <td class="field_title form_required"><?php echo lang('password'); ?></td>        
        <td class="field_value"><input type="password" name="password" value="<?php echo set_value('password'); ?>" size="50" /></td>
    </tr>
    <?php if (form_error('password')) { echo '<tr><td class="form_error" colspan="2">'.form_error('password').'</td></tr>'; } ?>
    
    <tr>
        <td class="field_title form_required"><?php echo lang('password_confirm'); ?></td>        
        <td class="field_value"><input type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" /></td>
    </tr>
    <?php if (form_error('passconf')) { echo '<tr><td class="form_error" colspan="2">'.form_error('passconf').'</td></tr>'; } ?>

    <tr>
        <td colspan="2" class="table_buttons"><input type="submit" value="<?php echo lang('submit'); ?>" class="button" /></td>
    </tr>
    
</table>

</form>
</div>
    
</div>