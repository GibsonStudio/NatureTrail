<div style="text-align: center;">

	<div class="content_box">

	<?php 
	
	echo $object['name'].'<hr />';
	
	$img = image_path().'objects/'.$object['filename'];
	echo '<img src="'.$img.'" alt="'.$img.'" style="max-width:90%; border: 1px solid #333333;"  />';
	
	if (!empty($object['description']))
	{
		echo '<div style="">'.$object['description'].'</div>';
	}
	
	echo $this->rarity_model->get_name($object['rarity']);
	
	echo '<div style="">';
	echo anchor('object/edit/'.$object['id'], lang('edit'), 'class="button_small"');
	echo anchor('object/delete/'.$object['id'], lang('delete'), 'class="button_small"');
	echo '</div>';
	
	?>
	</div>
	
</div>