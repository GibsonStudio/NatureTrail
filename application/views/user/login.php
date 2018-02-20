<!DOCTYLE HTML>

<html>

<head>
  <title>CAE OAA Applications</title>
  <link href="<?php echo css_path(); ?>/login.css" type="text/css" rel="stylesheet" />
  <script src="<?php echo js_path(); ?>jquery-1.10.1.min.js" type="text/javascript"></script>
  <script src="<?php echo js_path(); ?>global.inc.js" type="text/javascript"></script>
</head>

<body>

	<div id="container">
		<div id="container-inner">
			<div id="login-box">
				<div id="login-message">Welcome to the<br />CAE Application Portal</div>

				<?php echo form_open('login', 'class="my_form"'); ?>

					<div id="username" class="login-field">
						<div class="field-icon" id="email-icon"></div>
						<input type="text" name="email" value="<?php echo set_value('email'); ?>" class="login_input" />
					</div>

					<div id="password" class="login-field">
						<div class="field-icon" id="password-icon"></div>
						<input type="password" name="password" value="<?php echo set_value('password'); ?>" class="login_input" />
					</div>

					<!--<div id="submit">SIGN IN</div>-->
					<input id="submit" type="submit" value="SIGN IN" />

				</form>


				<div id="login-links">
					<?php
					echo anchor('user/forgotten_password', 'Forgotten your username or password?');
					echo anchor('user/register', 'Create a new account');
					?>
				</div>

			</div>
		</div>
	</div>

</body>

</html>


<!--

<div class="block_login">

	<div class="block_title">
		<?php echo lang('login'); ?>
	</div>

	<div class="login_links">
		<?php

		/*
		echo anchor('user/register', lang('register_account'));

		if (isset($error))
		{
			echo '<br />'.anchor('user/forgotten_password', lang('forgotten_password'));
		}
		*/
		?>
	</div>

	<div class="login_content">

		<?php //echo form_open('login', 'class="my_form"'); ?>

		<div class="login_labels">Email:</div>
		<input type="text" name="email" value="<?php //echo set_value('email'); ?>" class="login_input" /><br />

		<div class="login_labels">Password:</div>
		<input type="password" name="password" value="<?php //echo set_value('password'); ?>" class="login_input" /><br />

		<div class="login_buttons">
			<input type="submit" value="<?php //echo lang('login'); ?>" class="button" />
		</div>

		</form>

	</div>

	<?php
	/*
	if (isset($error)) {
		echo '<div class="login_error">';
		echo $error;
		echo '</div>';
	}
	*/
	?>

</div>
-->
