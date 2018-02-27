<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="center_me">

<?php
iniForm(array('title'=>'Add Rarity', 'controller'=>'rarity', 'action'=>'add'));
addField(array('name'=>'value', 'type'=>'number', 'label'=>'Value:', 'required'=>true));
addField(array('name'=>'name', 'label'=>'Name:', 'required'=>true));
addButtons(array('returnPath'=>'rarity/view/'));
?>

</div>
