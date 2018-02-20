<div class="content_box"><b>Email will be sent to <?php echo count($users) ?> users:</b><hr />
<?php
foreach ($users as $user)
{
	
	echo $this->data_model->get_name($user['id']).' ('.$user['email'].')<br />';
	
}
?>
</div>