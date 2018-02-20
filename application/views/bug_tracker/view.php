<div class="center_me"><?php echo anchor('bug_tracker/purge', lang('purge'), 'class="button"'); ?></div>

<div class="data_table_container">

<?php 

foreach ($bugs as $bug)
{
	
	echo '<table class="bug_table';
	
	if ($bug['fixed'] == 1) {
		echo ' bug_fixed';
	}
	
	echo '">';
	
	echo '<tr>';
	echo '<td class="field_value">'.$bug['priority'].'</td>';
	echo '<td class="field_value">'.timestamp_to_string($bug['timeraised']).'</td>';
	echo '<td class="field_value">'.$this->data_model->get_name($bug['raiserid']).'</td>';
	echo '</tr>';
	
	echo '<tr><td class="field_value bug_comment" colspan="3">'.nl2br($bug['comment']).'</td></tr>';
	
	echo '<tr>';
	echo '<td class="field_value">'.get_boolean_string($bug['fixed']).'</td>';
	echo '<td class="field_value">'.timestamp_to_string($bug['timefixed']).'</td>';
	echo '<td class="field_value">'.$this->data_model->get_name($bug['fixerid']).'</td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td class="item_table_buttons" colspan="3">';
	echo anchor('bug_tracker/edit/'.$bug['id'], lang('edit'), 'class="button_small"');
	echo anchor('bug_tracker/delete/'.$bug['id'], lang('delete'), 'class="button_small"');
	echo '</td>';
	echo '</tr>';
	
	echo '</table>';
	
	
}

?>
    
</div>