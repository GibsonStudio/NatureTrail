<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php use_tinymce(); ?>

<div class="center_me">

	<div class="form_container">

	    <div class="form_title"><?php echo lang('edit').' Object '.$object['id']; ?></div>

		<?php echo form_open_multipart('object/edit/'.$object['id'], 'class="my_form"'); ?>

		<table class="form_table">

		    <tr>
		        <td class="form_required_message" colspan="2"><?php echo lang('required_message'); ?></td>
		    </tr>

			<tr>
		        <td class="field_title form_required">Name:</td>
		        <td class="field_value"><input type="text" class="my_input" name="name" value="<?php echo set_value('name', $object['name']); ?>" /></td>
		    </tr>
		    <?php if (form_error('name')) { echo '<tr><td class="form_error" colspan="2">'.form_error('name').'</td></tr>'; } ?>




		    <tr><td class="field_title form_required" colspan="2" style="text-align: left;">Description:</td></tr>
		    <tr><td class="field_value" colspan="2"><textarea class="my_textarea use_tinymce" style="width: 400px; height: 100px;" name="description"><?php echo set_value('description', $object['description']); ?> </textarea></td></tr>
		    <?php if (form_error('description')) { echo '<tr><td class="form_error" colspan="2">'.form_error('description').'</td></tr>'; } ?>





		     <tr>
		    	<td colspan="2" class="form_field_required" style="text-align: left; padding-top: 20px;">
		    		<input type="file" name="my_file" />
		    	</td>
		    </tr>
		    <?php if (isset($upload_errors)) { echo '<tr><td class="form_error" colspan="2">'.$upload_errors.'</td></tr>'; } ?>



		    <tr>
			    <td class="field_title form_required">Rarity</td>
			    <td class="field_value"><?php echo $this->rarity_model->get_select(set_value('rarity', $object['rarity'])); ?></td>
			</tr>
			<?php if (form_error('rarity')) { echo '<tr><td class="form_error" colspan="2">'.form_error('rarity').'</td></tr>'; } ?>


		</table>

		<div class="table_buttons">
			<input type="submit" value="<?php echo lang('submit'); ?>" class="button" />
			<?php echo anchor('object/viewall/', lang('cancel'), 'class="button"'); ?>
		</div>

		</form>

	</div>

</div>
