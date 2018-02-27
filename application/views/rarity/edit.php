<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="center_me">

<?php
iniForm(array('title'=>'Edit Rarity '.$rarity->id, 'controller'=>'rarity', 'action'=>'edit', 'id'=>$rarity->id));
addField(array('name'=>'value', 'type'=>'number', 'value'=>$rarity->value, 'label'=>'Value:', 'required'=>true));
addField(array('name'=>'name', 'value'=>$rarity->name, 'label'=>'Name:', 'required'=>true));
addButtons(array('returnPath'=>'rarity/view/'));
?>

</div>
