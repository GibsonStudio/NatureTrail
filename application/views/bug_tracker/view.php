<div class="center_me"><?php echo anchor('bug_tracker/purge', lang('purge'), 'class="button"'); ?></div>

<style>
.bug { width:400px; background-color:#F0B323; border-radius:10px; min-height:120px; display:inline-block; padding:10px; padding-bottom:40px; margin:10px; text-align:left; position:relative; vertical-align:top; }
.bug-user { font-weight:bold; font-size:16px; margin-right:20px; }
.bug-date {}
.bug-tick { position:absolute; right:4px; bottom:0px; width:80px; height:80px; z-index:2; background-image:url('../../images/fixed_tick.png'); }
.bug-buttons { text-align:center; position:absolute; width:400px; bottom:10px; }
.bug-low-priority { background-color:#c3edc2; }
.bug-high-priority { background-color:#ff8181; }
.bug-fixed { background-color:#f6f6f6; color:#c2c2c2; }
</style>


<div style="text-align:center;">
<?php

foreach ($bugs as $bug)
{

  echo '<div class="bug';
  if ($bug['fixed'] == 1) { echo ' bug-fixed';}
  else if ($bug['priority'] == 0) { echo ' bug-low-priority'; }
  else if ($bug['priority'] == 2) { echo ' bug-high-priority'; }
  echo '">';
  echo '<div>';
  echo '<span class="bug-user">'.$this->data_model->get_name($bug['raiserid']).'</span>';
  echo '<span class-"bug-date">'.timestamp_to_string($bug['timeraised']).'</span>';
  echo '</div>';
  echo '<div>'.nl2br($bug['comment']).'</div>';

  // fixed?
  if ($bug['fixed'] == 1) { echo '<div class="bug-tick"></div>'; }

  // buttons
  echo '<div class="bug-buttons">';
  echo anchor('bug_tracker/edit/'.$bug['id'], lang('edit'), 'class="button_small"');
  echo anchor('bug_tracker/delete/'.$bug['id'], lang('delete'), 'class="button_small"');
  echo '</div>';
  echo '</div>';

}

?>

</div>
