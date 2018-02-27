<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyForm {

  public function __construct ($args = array())
  {
    $this->name = isset($args['name']) ? $args['name'] : 'LOAD';
    return $this;
  }

  public function testMe () {
    return 'ALL OF EM';
  }

  public function newForm ($args = array())
  {
    $this->name = isset($args['name']) ? $args['name'] : 'LOAD';
    return $this;
  }

}


?>
