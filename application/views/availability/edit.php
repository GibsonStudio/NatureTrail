<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="center_me">

  <?php
  iniForm(array('title'=>'Edit Availability '.$availability->id, 'controller'=>'availability', 'action'=>'edit', 'id'=>$availability->id));
  addField(array('name'=>'sort', 'type'=>'number', 'value'=>$availability->sort, 'label'=>'Sort:', 'required'=>true));
  addField(array('name'=>'name', 'value'=>$availability->name, 'label'=>'Name:', 'required'=>true));
  addButtons(array('returnPath'=>'availability/view/'));
  ?>

</div>
