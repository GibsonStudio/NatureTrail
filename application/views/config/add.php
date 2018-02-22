<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="center_me">

	<div class="form_container">

    <div class="form_title">Add Config Var</div>

    <?php echo form_open('config/add', 'class="my_form"'); ?>

		<table class="form_table">

		    <tr>
		        <td class="form_required_message" colspan="2"><?php echo lang('required_message'); ?></td>
		    </tr>

        <tr>
            <td class="field_title form_required">Var:</td>
            <td class="field_value"><input type="text" class="my_input" name="var" value="<?php echo set_value('var'); ?>" /></td>
        </tr>
        <?php if (form_error('var')) { echo '<tr><td class="form_error" colspan="2">'.form_error('var').'</td></tr>'; } ?>

		   <tr>
		        <td class="field_title form_required">Value:</td>
		        <td class="field_value"><input type="text" class="my_input" name="value" value="<?php echo set_value('value'); ?>" /></td>
		    </tr>
		    <?php if (form_error('value')) { echo '<tr><td class="form_error" colspan="2">'.form_error('value').'</td></tr>'; } ?>

		</table>

		<div class="table_buttons">
			<input type="submit" value="<?php echo lang('submit'); ?>" class="button" />
			<?php echo anchor('config/view/', lang('cancel'), 'class="button"'); ?>
		</div>

		</form>

	</div>

</div>
