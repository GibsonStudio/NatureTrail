<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="center_me"><div class="form_container">

<div style="font-weight: bold; font-size: 48px; color:#df0000; text-align: left;">404</div>

<div style="text-align: left;">Whoops! I don't seem to have that page, so here's a nice image instead. :)</div>

<?php

$img = image_path().'404/404_'.rand(1,6).'.jpg';
echo '<img src="'.$img.'" alt="404 Image" style="border: 1px solid #333333; margin:20px;" />';

?>

</div></div>