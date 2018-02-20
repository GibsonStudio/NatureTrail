<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>  

<div class="center_me">

<div class="form_container">
    
    <div class="form_title"><?php echo lang('add_user'); ?></div>  
    
<?php echo form_open('user/add', 'class="my_form"'); ?>
    
<table class="form_table">
    
    <tr>
        <td class="field_title form_required"><?php echo lang('firstname'); ?> <span class="form_constraint"><?php echo lang('a-z'); ?></span></td>        
        <td class="field_value"><input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" size="50" /></td>
    </tr>
    <?php if (form_error('firstname')) { echo '<tr><td class="form_error" colspan="2">'.form_error('firstname').'</td></tr>'; } ?>
    
    <tr>
        <td class="field_title form_a-z"><?php echo lang('middlenames'); ?> <span class="form_constraint"><?php echo lang('a-z'); ?></span></td>        
        <td class="field_value"><input type="text" name="middlenames" value="<?php echo set_value('middlenames'); ?>" size="50" /></td>
    </tr>
    <?php if (form_error('middlenames')) { echo '<tr><td class="form_error" colspan="2">'.form_error('middlenames').'</td></tr>'; } ?>
    
    <tr>
        <td class="field_title form_required"><?php echo lang('lastname'); ?> <span class="form_constraint"><?php echo lang('a-z'); ?></span></td>        
        <td class="field_value"><input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" size="50" /></td>
    </tr>
    <?php if (form_error('lastname')) { echo '<tr><td class="form_error" colspan="2">'.form_error('lastname').'</td></tr>'; } ?>
    
    <tr>
        <td class="field_title"><?php echo lang('knownas'); ?> <span class="form_constraint"><?php echo lang('a-z'); ?></span></td>        
        <td class="field_value"><input type="text" name="knownas" value="<?php echo set_value('knownas'); ?>" size="50" /></td>
    </tr>
    <?php if (form_error('knownas')) { echo '<tr><td class="form_error" colspan="2">'.form_error('knownas').'</td></tr>'; } ?>
    
    
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
        <td class="field_title form_required"><?php echo lang('email'); ?></td>        
        <td class="field_value"><input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" /></td>
    </tr>
	<?php if (form_error('email')) { echo '<tr><td class="form_error" colspan="2">'.form_error('email').'</td></tr>'; } ?>
	
    <tr>
        <td colspan="2" class="table_buttons"><input type="submit" value="<?php echo lang('submit'); ?>" class="button" /></td>
    </tr>
    
</table>

</form>
</div>
    
</div>