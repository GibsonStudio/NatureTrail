<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="tile_title" style="text-align:center;margin-top:20px;"><?php
	echo count($blocks).' '.lang('title_blocks');
?></div>

<div style="text-align:center;margin-bottom:20px;">

<?php echo anchor('block/add', lang('add').' Block', 'class="button"'); ?></div>

<?php 

foreach ($blocks as $block)
{
	
	echo '<div class="content_box">';
	
	echo $this->block_model->render($block);
	
	//block info
	echo '<table style="width: 100%;">';
	
	echo '<tr><td class="field_title">'.lang('active').'</td>';
	echo '<td class="field_value">'.$block['active'].'</td></tr>';
	
	echo '<tr><td class="field_title">'.lang('position').'</td>';
	echo '<td class="field_value">'.$this->data_model->get_position_string($block['position']).'</td></tr>';
	
	echo '<tr><td class="field_title">'.lang('show_content_only').'</td>';
	echo '<td class="field_value">'.$block['show_content_only'].'</td></tr>';
	
	echo '<tr><td class="field_title">'.lang('sort').'</td>';
	echo '<td class="field_value">'.$block['sort'].'</td></tr>';
	
	echo '</table>';
	
	
	//buttons
	echo '<div style="text-align: right;">';
	echo anchor('block/edit/'.$block['id'], lang('edit'), 'class="button_small"');
	echo anchor('block/delete/'.$block['id'], lang('delete'), 'class="button_small"');
	echo '</div>';
	echo '</div>';
	
}

?>