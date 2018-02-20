<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="content_box">

<?php echo form_open('user/select', 'class="my_form"'); ?>

<span class="field_title">Role:</span> <?php echo $this->data_model->get_select('accesslevel', set_value('accesslevel'), 'name', null, '<option value="0">Any</option>'); ?><br />
<span class="field_title">Name:</span> <input type="text" name="name" value="<?php echo set_value('name'); ?>" /><br />
<span class="field_title">Email Confirmed:</span> <?php echo $this->data_model->get_boolean_select('email_confirmed', set_value('email_confirmed', -1), 1); ?><br />

<input type="submit" value="Search" class="button" />

</form>

<?php 

if ($show_action_buttons == 1)
{
	
	echo '<hr />';
	echo anchor('user/send_bulk_email', 'Bulk Email', 'class="button_small"');
	
}

?>
</div>

<hr />