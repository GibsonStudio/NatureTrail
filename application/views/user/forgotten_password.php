<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="center_me">

<div class="form_container">
    
    <div class="form_title"><?php echo lang('reset_password'); ?></div>  
    
<?php echo form_open('user/forgotten_password', 'class="my_form"'); ?>
    
<table class="form_table">
    
    <tr>
        <td class="field_title form_required"><?php echo lang('email'); ?></td>        
        <td class="field_value"><input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" /></td>
    </tr>
    <?php if (form_error('email')) { echo '<tr><td class="form_error" colspan="2">'.form_error('email').'</td></tr>'; } ?>

    <?php if (isset($error)) { ?>
    <tr>
        <td colspan="2" class="form_message"><?php echo $error; ?></td>
    </tr>
    <?php } ?>
    
    <tr>
        <td colspan="2" class="table_buttons"><input type="submit" value="<?php echo lang('reset'); ?>" class="button" /></td>
    </tr>
    
</table>

</form>

</div>
    
</div>