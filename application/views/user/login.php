<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="center_me">

<div class="form_container">
    
    <div class="form_title"><?php echo lang('login'); ?></div>  
    
<?php echo form_open('login', 'class="my_form"'); ?>
    
<table class="form_table">
    
    <tr>
        <td class="field_title form_required"><?php echo lang('email'); ?></td>        
        <td class="field_value"><input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" /></td>
    </tr>
    <?php if (form_error('email')) { echo '<tr><td class="form_error" colspan="2">'.form_error('email').'</td></tr>'; } ?>
    
    <tr>
        <td class="field_title form_required"><?php echo lang('password'); ?></td>        
        <td class="Field_value"><input type="password" name="password" value="<?php echo set_value('password'); ?>" size="50" /></td>
    </tr>
    <?php if (form_error('password')) { echo '<tr><td class="form_error" colspan="2">'.form_error('password').'</td></tr>'; } ?>
    
    <tr>
        <td colspan="2" class="table_buttons"><input type="submit" value="<?php echo lang('login'); ?>" class="button" /></td>
    </tr>
    
    <tr>
        <td colspan="2" class="form_message"><?php
        	
        	if (isset($error)) {
            	echo $error;
            }

            if ($this->config_model->get_config('allow_registration') == 1)
            {
            	echo anchor('user/register', lang('register_account'));
            }        	
        	
        ?></td>
    </tr>

</table>

</form>

</div>
    
</div>