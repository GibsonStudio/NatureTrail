<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page_title">Search Results: <?php echo count($users); ?> Users Selected</div>
<div class="content_box">

<?php 

foreach ($users as $user)
{		
	
	echo anchor('user/view/'.$user['id'], $this->data_model->get_name($user['id']).' '.$user['email']);
	echo '<br />';	
	
}

?>

</div>