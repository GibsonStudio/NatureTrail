<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$id = isset($user->id) ? $user->id : set_value('id'); ?>

<div class="center_me">

<div class="form_container">    
    
    <div class="form_title"><?php echo lang('edit_user'); ?> <?php echo $id; ?></div>
    
<?php echo form_open('user/edit/'.$user->id, 'class="my_form"'); ?>
        
<table style="width:100%;">
    
    <!-- horrible hack because Google Chrome is Sugar Honey Ice Tea -->
    <input style="display:none">
	<input type="password" style="display:none">
	<!--  -->
	
    <tr>
        <td class="field_title form_required"><?php echo lang('firstname'); ?> <span class="form_constraint"><?php echo lang('a-z'); ?></span></td>        
        <td class="field_value"><input type="text" name="firstname" value="<?php echo set_value('firstname', $user->firstname); ?>" /></td>
    </tr>
    <?php if (form_error('firstname')) { echo '<tr><td class="form_error" colspan="2">'.form_error('firstname').'</td></tr>'; } ?>
    
    <tr>
        <td class="field_title form_a-z"><?php echo lang('middlenames'); ?> <span class="form_constraint"><?php echo lang('a-z'); ?></span></td>        
        <td class="field_value"><input type="text" name="middlenames" value="<?php echo set_value('middlenames', $user->middlenames); ?>" /></td>
    </tr>
    <?php if (form_error('middlenames')) { echo '<tr><td class="form_error" colspan="2">'.form_error('middlenames').'</td></tr>'; } ?>
    
    <tr>
        <td class="field_title form_required"><?php echo lang('lastname'); ?> <span class="form_constraint"><?php echo lang('a-z'); ?></span></td>        
        <td class="field_value"><input type="text" name="lastname" value="<?php echo set_value('lastname', $user->lastname); ?>" /></td>
    </tr>
    <?php if (form_error('lastname')) { echo '<tr><td class="form_error" colspan="2">'.form_error('lastname').'</td></tr>'; } ?>
    
    <tr>
        <td class="field_title"><?php echo lang('knownas'); ?> <span class="form_constraint"><?php echo lang('a-z'); ?></span></td>        
        <td class="field_value"><input type="text" name="knownas" value="<?php echo set_value('knownas', $user->knownas); ?>" autocomplete="off" /></td>
    </tr>
    <?php if (form_error('knownas')) { echo '<tr><td class="form_error" colspan="2">'.form_error('knownas').'</td></tr>'; } ?>
    
    
    <tr>
        <td class="field_title form_required"><?php echo lang('password'); ?></td>        
        <td class="field_value"><input type="password" name="password" value="<?php echo set_value('password'); ?>" autocomplete="off" /></td>
    </tr>
    <?php if (form_error('password')) { echo '<tr><td class="form_error" colspan="2">'.form_error('password').'</td></tr>'; } ?>
    
    <tr>
        <td class="field_title form_required"><?php echo lang('password_confirm'); ?></td>        
        <td class="field_value"><input type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" /></td>
    </tr>
    <?php if (form_error('passconf')) { echo '<tr><td class="form_error" colspan="2">'.form_error('passconf').'</td></tr>'; } ?>
    
    <tr>
        <td class="field_title form_required"><?php echo lang('email'); ?></td>        
        <td class="field_value"><input type="text" name="email" value="<?php echo set_value('email', $user->email); ?>" /></td>
    </tr>
    <?php if (form_error('email')) { echo '<tr><td class="form_error" colspan="2">'.form_error('email').'</td></tr>'; } ?>
    
    
    <?php if ($this->user_model->has_permission('assign_level') && ($user->id != $this->user_model->get()->id)) { ?>
    <tr>
        <td class="field_title form_required"><?php echo lang('accesslevel'); ?></td>        
        <td class="field_value"><?php echo $this->role_model->get_select(set_value('accesslevel', $user->accesslevel)); ?></td>
    </tr>
    <?php if (form_error('accesslevel')) { echo '<tr><td class="form_error" colspan="2">'.form_error('accesslevel').'</td></tr>'; } ?>
    <?php } ?>
    
    <?php if ($user->deleted == 1 && $this->user_model->has_permission('undelete_user')) { ?>
    <tr>
        <td class="field_title form_required"><?php echo lang('deleted'); ?></td>        
        <td class="field_value"><?php echo $this->data_model->get_boolean_select('deleted', set_value('deleted', $user->deleted)); ?></td>
    </tr>
    <?php if (form_error('deleted')) { echo '<tr><td class="form_error" colspan="2">'.form_error('deleted').'</td></tr>'; } ?>
    <?php } ?>    
    
    <tr>
        <td colspan="2" class="table_buttons">
            <input type="submit" value="<?php echo lang('save'); ?>" class="button" />
            <?php echo anchor('user/view/'.$id, lang('cancel'), 'class="button"'); ?>            
        </td>
    </tr>
    
</table>

</form>

</div>
    
</div>