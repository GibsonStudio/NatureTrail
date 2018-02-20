<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="tile_title" style="text-align:center;margin-top:20px;"><?php
	echo count($templates).' Templates';
?></div>

<div style="text-align:center;margin-bottom:20px;"><?php echo anchor('email/add_template', 'Add Template', 'class="button"'); ?></div>

<?php 


foreach ($templates as $template)
{
	
	echo '<div class="content_box">';
	
	echo '<div class="content_box_title">'.$template['name'].'</div>';
	
	echo '<table style="width: 100%;">';
	
	echo '<tr><td class="field_title align_left" colspan="2">Content</td></tr>';
	echo '<tr><td class="field_value" style="background:#ffffff; padding: 10px; border: 1px solid #333333;" colspan="2">'.$template['content'].'</td></tr>';
	
	echo '<tr><td class="field_title">Sort</td>';
	echo '<td class="field_value">'.$template['sort'].'</td></tr>';
	
	echo '</table>';
	
	//buttons
	echo '<div style="text-align: right;">';
	echo anchor('email/edit_template/'.$template['id'], lang('edit'), 'class="button_small"');
	echo anchor('email/delete_template/'.$template['id'], lang('delete'), 'class="button_small"');
	echo '</div>';
	
	echo '</div>';
	
}


/*
foreach ($blocks as $block)
{
	
	$extra_class = $block['active'] == 0 ? ' block_inactive' : '';
	
	echo '<div class="content_box'.$extra_class.'">';
	
	echo '<div class="content_box_title">'.$block['title'].'</div>';
	echo '<table style="width: 100%;">';
	
	echo '<tr><td class="field_title">'.lang('active').'</td>';
	echo '<td class="field_value">'.$block['active'].'</td></tr>';
	
	echo '<tr><td class="field_title">'.lang('position').'</td>';
	echo '<td class="field_value">'.$block['position'].'</td></tr>';
	
	echo '<tr><td class="field_title">'.lang('show_content_only').'</td>';
	echo '<td class="field_value">'.$block['show_content_only'].'</td></tr>';
	
	echo '<tr><td class="field_title">'.lang('sort').'</td>';
	echo '<td class="field_value">'.$block['sort'].'</td></tr>';
	
	echo '<tr><td class="field_value" colspan="2">'.$block['content'].'</td></tr>';
	
	echo '</table>';
	
	//buttons
	echo '<div style="text-align: right;">';
	echo anchor('block/edit/'.$block['id'], lang('edit'), 'class="button_small"');
	echo anchor('block/delete/'.$block['id'], lang('delete'), 'class="button_small"');	
	echo '</div>';
	
	
	
	echo '</div>';
	
}
*/


?>