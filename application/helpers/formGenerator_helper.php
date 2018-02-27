<?php


function iniForm ($args = array())
{

  $title = isset($args['title']) ? $args['title'] : 'MyForm';
  $controller = isset($args['controller']) ? $args['controller'] : 'home';
  $action = isset($args['action']) ? $args['action'] : 'add';
  $id = isset($args['id']) ? $args['id'] : 0;

  $html = '<div class="form_container">';
  $html .= '<div class="form_title">'.$title.'</div>';
  $html .= form_open($controller.'/'.$action.'/'.$id, 'class="my_form"');
  $html .= '<table class="form_table">';
  $html .= '<tr>';
  $html .= '<td class="form_required_message" colspan="2">'.lang('required_message').'</td>';
  $html .= '</tr>';

  echo $html;

}


function getFieldHTML ($args = array())
{

  $name = isset($args['name']) ? $args['name'] : '';
  $type = isset($args['type']) ? $args['type'] : 'text';
  $value = isset($args['value']) ? $args['value'] : '';
  $label = isset($args['label']) ? $args['label'] : '';
  $required = isset($args['required']) ? $args['required'] : false;

  $html = '<tr>';
  $html .= '<td class="field_title';
  if ($required) { $html .= ' form_required'; }
  $html .= '">'.$label.'</td>';
  $html .= '<td class="field_value">';
  $html .= '<input type="'.$type.'" class="my_input" name="'.$name.'" ';
  $html .= 'value="'.set_value($name, $value).'" /></td>';
  $html .= '</tr>';
  if (form_error($name)) {
    $html .= '<tr><td class="form_error" colspan="2">'.form_error($name).'</td></tr>';
  }

  return $html;

}


function addField ($args = array())
{
  echo getFieldHTML($args);
}






function addButtons ($args = array())
{

  $returnPath = isset($args['returnPath']) ? $args['returnPath'] : '';

  $html = '</table><div class="table_buttons">';
  $html .= '<input type="submit" value="'.lang('submit').'" class="button" />';
  $html .= anchor($returnPath, lang('cancel'), 'class="button"');
  $html .= '</div>';
  $html .= '</form>';
  $html .= '</div>';

  echo $html;

}








/*

class MyForm {

  public function __construct($args = array()) {

    $this->title = isset($args['title']) ? $args['title'] : 'myForm';
    $this->controller = isset($args['controller']) ? $args['controller'] : 'home';
    $this->action = isset($args['action']) ? $args['action'] : 'add';
    $this->returnPath = isset($args['returnPath']) ? $args['returnPath'] : $this->controller.'/view';
    $this->fields = isset($args['fields']) ? $args['fields'] : array();
    $this->buttons = isset($args['buttons']) ? $args['buttons'] : $this->getButtonsAdd();

    form_open($this->controller.'/'.$this->action, 'class="my_form"');

    return $this;

  }


  public function addField ($args = array()) {

    $args['action'] = $this->action;
    $thisField = new MyField($args);
    array_push($this->fields, $thisField);

  }


  public function getHTML ()
  {

    $html = '<div class="form_container">';
    $html .= '<div class="form_title">'.$this->title.'</div>';
    //$html .= form_open($this->controller.'/'.$this->action, 'class="my_form"');
    $html .= '<table class="form_table">';
    $html .= '<tr><td class="form_required_message" colspan="2">'.lang('required_message').'</td></tr>';

    // add fields
    foreach ($this->fields as $field) {
      $html .= $field->getHTML();
    }

    // close table
    $html .= '</table>';

    // add buttons
    $html .= '<div class="table_buttons">'.$this->buttons.'</div>';

    // close form
    $html .= '</form></div>';

    return $html;

  }


  public function getButtonsAdd () {
    $html = '<input type="submit" value="'.lang('submit').'" class="button" />';
    $html .= anchor($this->returnPath, lang('cancel'), 'class="button"');
    return $html;
  }

}






class MyField {

  public function __construct ($args = array()) {

    $this->value = isset($args['value']) ? $args['value'] : '';
    $this->name = isset($args['name']) ? $args['name'] : 'myField';
    $this->type = isset($args['type']) ? $args['type'] : 'text';
    $this->label = isset($args['label']) ? $args['label'] : 'myLabel';
    $this->required = isset($args['required']) ? $args['required'] : false;
    $this->action = isset($args['action']) ? $args['action'] : 'add';
    return $this;

  }


  public function getHTML() {

    $html = '<tr>';
    $html .= '<td class="field_title';
    if ($this->required) { $html .= ' form_required'; }
    $html .= '">'.$this->label.'</td>';
    $html .= '<td class="field_value"><input type="'.$this->type.'" ';
    $html .= 'class="my_input" name="'.$this->name.'" ';

    if ($this->action == 'edit') {
      $html .= 'value="'.set_value($this->name, $this->value).'" /></td>';
    } else {
      $html .= 'value="'.set_value($this->name).'" /></td>';
    }

    $html .= '</tr>';
    if (form_error($this->name)) {
      $html .= '<tr><td class="form_error" colspan="2">'.form_error($this->name).'</td></tr>';
    }

    return $html;

  }


}

*/


?>
