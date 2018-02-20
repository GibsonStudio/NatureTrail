<script src="<?php echo js_path(); ?>usersearch.js" type="text/javascript"></script>

<div class="content_box">

	<div class="content_box_title"><?php echo lang('title_usersearch'); ?></div>
	
		<?php echo get_help(lang('search_help')); ?>
		
		<span class="usersearch_label">Search String:</span>
		<input type="text" id="usersearch" name="usersearch" autocomplete="off" onkeyup="usersearch('<?php echo base_url(); ?>');" class="usersearch_input" />
		
		<span class="usersearch_label">Include Deleted:</span>
		<input type="checkbox" id="include_deleted" onclick="usersearch('<?php echo base_url(); ?>');" />&nbsp;&nbsp;&nbsp;&nbsp;
		
		<span class="usersearch_label">User Wildcards:</span>
		<input type="checkbox" id="user_wildcards" onclick="usersearch('<?php echo base_url(); ?>');" />

	<div id="usersearch_output"></div>

</div>