<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="center_me">

<?php
iniForm(array('title'=>'Add Availaility', 'controller'=>'availability', 'action'=>'add'));
addField(array('name'=>'sort', 'type'=>'number', 'label'=>'Sort:', 'required'=>true));
addField(array('name'=>'name', 'label'=>'Name:', 'required'=>true));
addButtons(array('returnPath'=>'availability/view/'));
?>

</div>
