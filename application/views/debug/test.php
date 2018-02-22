<h3>TEST PAGE</h3>

<?php

$allow = $this->config_model->get_config('allow_registration');

if ($allow)
{
	echo 'Registration allowed';
}
else
{
	echo 'Registration denied';
}

echo '<hr />';

echo $this->config_model->get_config('testVar', 'DEFAULT VALUE');
?>
