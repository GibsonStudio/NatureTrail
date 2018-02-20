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
    	
    	echo '<div class="page_numbers_container"><span style="font-weight: bold; float: left; padding: 5px;">Page:</span>';
    	
	    for ($i = 1; $i <= $page_count; $i++)
	    {
	    	
	    	if ($page == $i)
	    	{
	    		echo '<span class="page_number current_page">'.$i.'</span>';
	    	}
	    	else
	    	{
	    		echo anchor('object/viewall/'.$i, $i, 'class="page_number"');	
	    	}
	    	
	    }   

	    echo '</div>';
	    
    }
    ?>
    
	</div>