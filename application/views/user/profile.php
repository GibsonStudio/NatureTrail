<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $user->profileimage = isset($user->profileimage) ? $user->profileimage : 'default.jpg';
    if ($user->profileimage == '' || $user->profileimage == NULL) { $user->profileimage = 'default.jpg'; }
    if (!file_exists(BASEPATH.'../images/profile/'.$user->profileimage)) { $user->profileimage = 'missing.jpg'; }
?>

<div id="profile-box-container">

  <div id="profile-box">

    <!-- profile image -->
    <?php

        $img = '<img src="'.image_path().'profile/'.$user->profileimage.'" alt="'.$user->profileimage.'" class="profile-pic" />';
        if ($this->user_model->has_permission('upload_profile_image'))
        {
            echo anchor('user/uploadprofileimage/'.$user->id, $img, 'title="'.lang('upload_image').'"');
        }
        else
        {
            echo $img;
        }
    ?>


    <!-- name -->
    <div id="profile-name"><?php echo $user->firstname.' '.$user->middlenames.' '.$user->lastname; ?></div>

    <!-- details -->
    <?php if (!empty($user->knownas)) { ?>
      <div><?php echo lang('knownas'); ?></div>
      <div><?php echo $user->knownas; ?></div>
    <?php } ?>
    <div><?php echo lang('email'); ?></div>
    <div><?php echo $user->email; ?></div>
    <div><?php echo lang('accesslevel'); ?></div>
    <div><?php echo $this->data_model->get_value('accesslevel', 'name', $user->accesslevel); ?></div>


    <!-- user modified logs -->
    <?php if ($this->user_model->has_permission('see_modifier')) { ?>
      <div><?php echo lang('timemodified'); ?></div>
      <div><?php echo timestamp_to_string($user->timemodified); ?></div>
      <div><?php echo lang('modifierid'); ?></div>
      <div><?php echo $this->data_model->get_name($user->modifierid); ?></div>
    <?php } ?>

    <!-- user log in logs -->
    <?php if ($this->user_model->has_permission('see_login_details')) { ?>
      <div><?php echo lang('lastlogin'); ?></div>
      <div><?php echo timestamp_to_string($user->lastlogin); ?></div>
      <div><?php echo lang('lastlogout'); ?></div>
      <div><?php echo timestamp_to_string($user->lastlogout); ?></div>
      <div><?php echo lang('lastip'); ?></div>
      <div><?php echo $user->lastip; ?></div>
    <?php } ?>


    <!-- buttons -->
    <div id="buttons-container">
      <?php
      if (!$this->user_model->email_confirmed($user->id))
      {
        echo anchor('user/request_send_confirm_email/'.$user->id, lang('confirm_email'), 'class="button"');
      }

      echo anchor('user/edit/'.$user->id, lang('edit'), 'class="button"');

      if ($this->user_model->has_permission('email_user'))
      {
        echo '<a href="mailto:'.$user->email.'" class="button">'.lang('email').'</a>';
      }
      ?>
    </div> <!-- #buttons-container -->

  </div> <!-- #profile-box -->

</div> <!-- #profile-box-container -->
