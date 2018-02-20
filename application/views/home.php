<?php if ( !defined('BASEPATH')) exit('No direct script access allowed'); ?>

<link href="<?php echo css_path(); ?>/programs.css" type="text/css" rel="stylesheet" />

<table style="width:100%;"><tr>

<!-- left blocks -->
<?php 
if (count($blocks_left) > 0)
{
	
	echo '<td class="blocks">';
	foreach ($blocks_left as $block)
	{
		echo $this->block_model->render($block);
	}
	echo '</td>';
}
?>




<!-- content -->
<td class="content_cell">

My Home Page

</td>

<!-- right blocks -->
<?php 
if (count($blocks_right) > 0)
{
	
	echo '<td class="blocks">';
	foreach ($blocks_right as $block)
	{
		echo $this->block_model->render($block);
	}
	echo '</td>';
}
?>


</tr>

</table>