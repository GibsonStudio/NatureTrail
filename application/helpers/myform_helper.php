<?php

function get_input ($field)
{


	$value = isset($field['value']) ? $field['value'] : trim($field['defaultvalue']);


	if ($field['input_type'] == 'TEXTAREA')
	{

		//return a TEXTAREA
		$input = '<TEXTAREA class="my_textarea" name="'.strip_spaces($field['id']).'"';

		if ($field['input_var1'] != '') {
			$input .= ' cols="'.$field['input_var1'].'"';
		}

		if ($field['input_var2'] != '') {
			$input .= ' rows="'.$field['input_var2'].'"';
		}

		$input .= '>'.set_value(strip_spaces($field['id']), $value).'</TEXTAREA>';

		return $input;



	}
	else if ($field['input_type'] == 'BOOLEAN')
	{

		$input = '<select name="'.$field['id'].'">';

		$input .= '<option value="0"';
		if (set_value($field['id'], $value) == 0) { $input .= ' selected'; }
		$input .= '>No</option>';

		$input .= '<option value="1"';
		if (set_value($field['id'], $value) == 1) { $input .= ' selected'; }
		$input .= '>Yes</option>';

		$input .= '</select>';
		return $input;

	}
	else if ($field['input_type'] == 'DROPDOWN')
	{

		$input = '<select name="'.$field['id'].'">';

		$options = explode("\n", $field['dropdown']);

		foreach ($options as $option)
		{

			$input .= '<option value="'.trim($option).'"';

			if (set_value($field['id'], $value) == trim($option)) {
				$input .= ' selected';
			}

			$input .= '>'.trim($option).'</option>';

		}

		$input .= '</select>';
		return $input;

	}
	else
	{

		//return standard input
		if ($field['class'] == '') { $field['class'] = 'class="my_input"'; }

		$input = '<input '.$field['class'].' type="'.$field['input_type'].'" name="'.strip_spaces($field['id']).'" value="'.set_value(strip_spaces($field['id']), $value).'"';

		if (!is_null($field['input_var1'])) {
			$input .= ' min="'.$field['input_var1'].'"';
		}

		if (!is_null($field['input_var2']) && ($field['input_var2'] != 0)) {
			$input .= ' max="'.$field['input_var2'].'"';
		}

		$input .= '/>';

		return $input;


	}


}





function strip_spaces ($text)
{

	return str_replace(' ', '', $text);

}





function add_required_class ($validation_rule = '')
{

	if (strpos($validation_rule, 'required') !== false) {
		return ' form_required';
	}

	return  '';

}


















?>
