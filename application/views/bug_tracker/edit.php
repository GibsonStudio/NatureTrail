<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
use_tinymce();
$id = isset($bug->id) ? $bug->id : set_value('id');
?>

<div class="center_me">

	<div class="form_container">

		<div class="form_title"><?php echo lang('edit').' Bug '.$id; ?></div>

		<?php echo form_open('bug_tracker/edit/'.$id, 'class="my_form"'); ?>

		<table class="form_table">

		    <tr>
		        <td class="form_required_message" colspan="2"><?php echo lang('required_message'); ?></td>
		    </tr>

		    <tr>
		        <td class="field_title form_required align_left" colspan="2"><?php echo lang('comment'); ?></td>
		    </tr>
		    <tr>
		        <td class="field_value" colspan="2">
		        	<textarea class="my_textarea use_tinymce" style="width:400px; height:200px;" name="comment"><?php echo set_value('comment', $bug->comment); ?></textarea>
		        </td>
		    </tr>
		    <?php if (form_error('comment')) { echo '<tr><td class="form_error" colspan="2">'.form_error('comment').'</td></tr>'; } ?>

		    <tr>
		        <td class="field_title"><?php echo lang('priority'); ?></td>
            <td class="field_value"><?php echo $this->bug_tracker_model->get_priority_select(set_value('priority', $bug->priority)); ?></td>
		    </tr>
		    <?php if (form_error('priority')) { echo '<tr><td class="form_error" colspan="2">'.form_error('priority').'</td></tr>'; } ?>

		    <tr>
		        <td class="field_title"><?php echo lang('fixed'); ?></td>
		        <td class="field_value"><?php echo $this->data_model->get_boolean_select('fixed', $bug->fixed); ?></td>
		    </tr>

		</table>

		<div class="table_buttons">
			<input type="submit" value="<?php echo lang('submit'); ?>" class="button" />
			<?php echo anchor('bug_tracker/view/', lang('cancel'), 'class="button"'); ?>
		</div>

		</form>

	</div>

</div>
