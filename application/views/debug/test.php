<h3>TEST PAGE</h3>

<p>Test of pull when data is older.</p>

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

echo $userid;

?>
