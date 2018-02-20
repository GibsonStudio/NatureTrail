
<div class="center_block">

<div class="trail_title"><?php echo $trail->name; ?></div>
<div class="trail_description"><?php echo $trail->description; ?></div>
<div class="trail_creator">Created by: <?php echo $this->data_model->get_name($trail->createdby); ?></div>

<?php 
foreach ($objects as $object)
{
	
	echo $this->object_model->draw_object_for_trail($object['id']);
	
}
?>

</div>