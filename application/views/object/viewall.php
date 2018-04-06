<div class="center_me">
<?php echo anchor('object/add', lang('add').' Object', 'class="button"'); ?>
</div>
<br />
<?php

foreach ($objects as $object)
{
	echo $this->object_model->draw_object_tile($object['id']);
}

?>

    <!-- show page selector -->
    <div class="clearfix"></div>
    <div class="center_block">

    <?php

    $page_count = ceil($object_count / $objects_per_page);

    if ($page_count > 1)
    {

    	$script = '<script>function go_page() { window.location.href=($("#page_num").val()); }</script>';
    	echo $script;

    	$p = '<select id="page_num" onchange="go_page()">';

    	for ($i = 1; $i <= $page_count; $i++)
    	{

    		$link = site_url('object/viewall/'.$i);

    		if ($page == $i)
    		{
    			$p .= '<option value="'.$link.'" selected>'.$i.'</option>';
    		}
    		else
    		{
    			$p .= '<option value="'.$link.'">'.$i.'</option>';
    		}

    	}

    	$p .= '</select>';

    	echo '<div class="center_me">Page '.$p.' of '.$page_count.'</div>';

    }

    ?>

	</div>
