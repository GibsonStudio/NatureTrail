<?php


// user profile
$lang['id'] = 'ID';
$lang['knownas'] = 'Known As (Nickname)';
$lang['email'] = 'Email';
$lang['email_extra'] = '(This will be used as your login ID)';
$lang['firstname'] = 'First Name';
$lang['middlenames'] = 'Middle Name(s)';
$lang['lastname'] = 'Last Name';
$lang['password'] = 'Password';
$lang['password_confirm'] = 'Confirm Password';
$lang['accesslevel'] = 'User Level';
$lang['group'] = 'Group';
$lang['lastlogin'] = 'Last Log In';
$lang['lastlogout'] = 'Last Log Out';
$lang['lastip'] = 'Last IP';
$lang['deleted'] = 'Deleted';
$lang['a-z'] = '(a-z)';


//
$lang['title_users_table'] = 'Users';
$lang['title_profile'] = 'User Profile';
$lang['edit_user'] = 'Edit User';
$lang['profile_update_ok'] = 'User Profile Updated OK.';
$lang['register'] = 'Register a New Account';
$lang['upload_user_profile_image'] = 'Upload User Profile Image';
$lang['image_update_ok'] = 'Image Updated OK.';
$lang['already_registered'] = 'You are already registered, and logged in.<br /><br />If you need a new account, please log out and try again.';
$lang['cannot_delete_self'] = 'You cannot delete yourself!!';
$lang['confirm_user_delete'] = 'Confirm deletion of user:';
$lang['confirm_user_permanent_delete'] = 'Confirm permanent deletion of user.<br /><br />This will completely remove the user from the database,
including all profile data. It will NOT delete any applications.<br /><br /><b>This cannot be undone!</b>';
$lang['user_deleted_ok'] = 'User deleted OK.';
$lang['user_delete_failed'] = 'User deleted falied (Don\'t know why)';
$lang['account_deleted'] = 'This user account has been deleted.';
$lang['accountnumber_added_ok'] = 'Account number %s added ok.';
$lang['accountnumber_not_added'] = 'Account number %s NOT added!! (Sorry).';
$lang['view_applications'] = 'View Applications';
$lang['add_user'] = 'Add New User Account';
$lang['user_created_ok'] = 'User account created OK.';
$lang['view_users'] = 'View Users';
$lang['profile_image_constraints'] = '<p>The following limits apply to uploaded images:</p>
<ul>
<li>Format: jpg or png</li>
<li>File size: 1 MB or less</li>
<li>Size: 1000 px x 1000 px or less</li>
</ul>';



// general messages
$lang['greeting'] = 'Hi';
$lang['thanks'] = '.<br /><br />Thanks for registering.';
$lang['no_changes_made'] = 'No changes made.';
$lang['registration_message'] = '';
$lang['view_my_profile'] = 'View My Profile';
$lang['title_usersearch'] = 'Seach Users';


//password reset
$lang['reset'] = 'Reset';
$lang['reset_password'] = 'Reset Password';
$lang['reset_key_fail'] = 'Reset key could not be generated, please try again (sorry).';
$lang['reset_email_ok'] = 'A password reset email has been sent. Please check your inbox.';
$lang['reset_email_fail'] = 'Email could not be sent. Please try again.';
$lang['forgotten_password'] = 'Forgotten Password';
$lang['password_reset_ok'] = 'Password reset OK';
$lang['password_reset_fail'] = 'Password reset failed (sorry)';
$lang['account_not_exist'] = 'Account does not exist.';


//help message
$h = '<p><b>Search Help</b></p>';
$h .= '<p>Searches are <b>LIKE</b> searches. That means if you enter a search value of <b>jo</b> All users with <b>jo</b> anywhere in their profile fields ';
$h .= 'will be returned. The searched profile fields are:</p>';
$h .= '<ul><li>firstname</li><li>lastname</li><li>knownas</li><li>email</li><li>accountnumber</li><li>accesslevel</li></ul>';
$h .= '<p><b>User Wildcards</b></p>';
$h .= '<p>By selecting <b>User Wildcards</b> you can define how the search is matched. The wildcard character is <b>%</b></p>';
$h .= '<p><b>Example:</b> To search for all users whose name starts with <b>jo</b>, enter <b>jo%</b>.</p>';
$h .= '<p><b>Example:</b> To search for all users whose name ends with <b>jo</b>, enter <b>%jo</b>.</p>';
$h .= '<p><b>Example:</b> To search for all users whose name contains <b>jo</b>, enter <b>%jo%</b>. This is the same as the default search with User Wildcards not selected.</p>';
$lang['search_help'] = $h;

$lang['confirm_email'] = 'Confirm Email';
$lang['email_confirm_ok'] = 'Email confirmed OK.';
$lang['email_confirm_fail'] = 'Email NOT confirmed. Please go to your profile and retry.';
$lang['email_already_confirmed'] = 'This email address is already confirmed!';
$lang['confirm_email_sent'] = 'A confirmation email has been sent to you. If you don not receive it, check the emaill address in your profile and try again.';


?>