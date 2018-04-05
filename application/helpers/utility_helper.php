<?php

function image_path ()
{
    return base_url().'images/';
}


function css_path ()
{
    return base_url().'css/';
}



function js_path ()
{
	return base_url().'javascript/';
}


function object_dir ()
{
	return BASEPATH.'../images/objects/';
}


function use_tinymce ()
{
	$code = '<script type="text/javascript" src="'.js_path().'tinymce/tinymce.min.js"></script>';
  $code .= '<script type="text/javascript" src="'.js_path().'tinyMCE_config.js"></script>';
	echo $code;
}



function get_help ($help_text = '')
{

	$html = '<div class="help" onClick="show_message(\''.$help_text.'\')"></div>';
	return $html;

}


function get_mini_help ($help_text = '')
{

	$html = '<div class="minihelp" onClick="show_message(\''.$help_text.'\')"></div>';
	return $html;

}




function check_profile_status ($status, $info)
{

	if ($status == 0)
	{
		return '<li>'.$info.' needs to be completed.</li>';
	}
	else if ($status == 2)
	{
		return '<li>Update your '.$info.'</li>';
	}

	return '';

}


function display_date ($date)
{

	$time = strtotime($date);
	$newformat = date('F jS Y',$time);
	return $newformat;

}



function timestamp_to_string ($timestamp)
{

	if (is_null($timestamp) OR ($timestamp == 0))
	{
		return false;
	}

	$newformat = date('F jS Y, H:i',$timestamp);
	return $newformat;
}



function timestamp_to_datetimelocal ($timestamp = 0)
{
	//1974-01-14T14:50

	if ($timestamp == 0) {
		return '';
	}

	$newformat = date('Y-m-d\TH:i', $timestamp);
	return $newformat;
}




function display_field_value ($field = array())
{

	if ($field['input_type'] == 'BOOLEAN')
	{
		return get_boolean_string(trim($field['value']));
	}
	else if ($field['input_type'] == 'DATE')
	{
		return display_date($field['value']);
	}

	return nl2br($field['value']);

}




function get_age ($dob)
{

	//takes a date of birth in the format YYYY-MM-DD and return s an age in the format YY Years MM months

	$y = 60 * 60 * 24 * 365;
	$m = $y / 12;

	$age = time() - strtotime($dob);

	//years
	$years = (int) ($age / $y);

	//months
	$months = $age % $y;
	$months = (int) ($months / $m);

	//set units
	if ($years == 1) {
		$years_suffix = lang('suffix_year');
	} else {
		$years_suffix = lang('suffix_years');
	}

	if ($months == 1) {
		$months_suffix = lang('suffix_month');
	} else {
		$months_suffix = lang('suffix_months');
	}


	return $years.' '.$years_suffix.' '.$months.' '.$months_suffix;

}



function time_until ($timestamp = 0)
{

	$time = $timestamp - time();

	if ($time < 0)
	{
		return 'Expired';
	}

	$m = 60;
	$h = $m * 60;
	$d = $h * 24;

	//days
	$days = (int) ($time / $d);

	//hours
	$hours = $time % $d;
	$hours = (int) ($hours / $h);

	//mins
	$mins = $time % $h;
	$mins = (int) ($mins / $m);

	if ($days == 1) {
		$days_suffix = 'day';
	} else {
		$days_suffix = 'days';
	}

	if ($hours == 1) {
		$hours_suffix = 'hr';
	} else {
		$hours_suffix = 'hrs';
	}

	if ($mins == 1) {
		$mins_suffix = 'min';
	} else {
		$mins_suffix = 'mins';
	}

	return $days.' '.$days_suffix.' '.$hours.' '.$hours_suffix.' '.$mins.' '.$mins_suffix;

}





function get_boolean_string ($val)
{

	if ($val == 1)
	{
		return 'Yes';
	}
	else
	{
		return 'No';
	}

}




function get_label_position_select ($selected = 0)
{

	$options = array('Do not show', 'Before', 'After');

	$select = '<select name="label_position">';

	for ($i = 0; $i < count($options); $i++)
	{

	$option_number = $i;
	$option = $options[$i];

	if ($option_number == $selected) {
	$select .= '<option value="'.$option_number.'" selected>'.$option.'</option>';
	} else {
	$select .= '<option value="'.$option_number.'">'.$option.'</option>';
	}

	}

	$select .= '</select>';

	return $select;

}




function label_position_to_text ($label_position)
{
	$options = array('Do not show', 'Before', 'After');
	return $options[$label_position];
}







/* **** file picker **** */

function file_picker ($args = array())
{

	$name = isset($args['name']) ? $args['name'] : 'filepicker'; //name of input
	$type = isset($args['type']) ? $args['type'] : 'images';
	$basedir = isset($args['basedir']) ? $args['basedir'] : FCPATH.'images/';
	$subfolder = isset($args['subfolder']) ? $args['subfolder'] : '';

	if (!empty($subfolder))
	{
		$subfolder .= '/';
	}

	$selected = isset($args['selected']) ? $args['selected'] : ''; //selected file
	$include_subfolders = isset($args['include_subfolders']) ? $args['include_subfolders'] : true;
	$include_none = isset($args['indlude_none']) ? $args['include_none'] : true;

	$select = '<select name="'.$name.'">';

	//override basedir as type is set?
	if ($type == 'views')
	{
		$basedir = FCPATH.'application/views/';
	}
	else if ($type == 'program_homepages')
	{
		$basedir = FCPATH.'application/views/program_homepages/';
	}


	//include none?
	if ($include_none == true)
	{
		$select .= '<option value="">None</option>';
	}

	//add files in base folder
	$select .= file_picker_add_files(array('basedir' => $basedir, 'include_subfolders' => $include_subfolders, 'selected' => $selected, 'subfolder' => $subfolder));

	$select .= '</select>';

	return $select;

}




function file_picker_add_files ($args = array())
{

	$basedir = isset($args['basedir']) ? $args['basedir'] : '';
	$subfolder = isset($args['subfolder']) ? $args['subfolder'] : '';
	$include_subfolders = isset($args['include_subfolders']) ? $args['include_subfolders'] : true;
	$selected = isset($args['selected']) ? $args['selected'] : ''; //selected file

	$select = '';

	$files = array();

	if (is_dir($basedir.'/'.$subfolder))
	{
		$files = scandir($basedir.'/'.$subfolder);
	}


	//add files
	foreach ($files as $file)
	{

		$my_file = $subfolder.$file;

		if (!is_dir($basedir.$my_file))
		{

			$select .= '<option value="'.$my_file.'"';

			if ($my_file == $selected)
			{
				$select .= ' selected';
			}

			$select .= '>'.$file.'</option>';

		}

	}


	//add subfolders
	if ($include_subfolders)
	{

		foreach ($files as $file)
		{

			$my_file = $subfolder.$file;

			if (is_dir($basedir.$my_file))
			{

				if ($file != '.' && $file != '..')
				{

					$select .= '<optgroup label="'.$my_file.'">';
					$select .= file_picker_add_files(array('basedir' => $basedir, 'subfolder' => $subfolder.$file.'/', 'selected' => $selected));
					$select .= '</optgroup>';
				}

			}

		}

	}


	return $select;

}

?>
