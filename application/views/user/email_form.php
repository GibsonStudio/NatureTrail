<script type="text/javascript">

function load_template (base_url)
{
	
	var template_id = $('#template').val();
	tinyMCE.activeEditor.setContent('Loading....');


	$.ajax({
		url: base_url + 'index.php/email/load_template',
		type: 'POST',
		data: {template_id:template_id}
	}).error(function (e1, e2, e3) {

		tinyMCE.activeEditor.setContent('<b>ERROR:</b> ' + e1 + ': ' + e2 + ': ' + e3);
		
	}).done(function (data) {
	
		tinyMCE.activeEditor.setContent(data);
		
	});
	
	
}

</script>


<div class="content_box">

<?php
use_tinymce();
echo form_open('user/send_bulk_email', 'class="my_form"');
?>

<table class="form_table" style="width: 100%;">

	<tr>
		<td class="form_title" style="">Send Bulk Email</td>
	</tr>
		
    <tr>
        <td class="form_required_message" colspan="2"><?php echo lang('required_message'); ?></td>
    </tr>
        
    <tr>
    	<td class="field_title">Load Template:</td>
    	<td><?php echo $this->email_model->get_template_select(); ?></td>
    </tr>
    
    <tr>
        <td class="field_title form_required">Subject:</td>            
        <td class="field_value"><input type="text" class="my_input" name="subject" value="<?php echo set_value('subject'); ?>" /></td>
    </tr>
    <?php if (form_error('subject')) { echo '<tr><td class="form_error" colspan="2"'.form_error('subject').'</td></tr>'; } ?>
    
    
    <tr>
        <td class="field_title form_required" colspan="2" style="text-align:left;">Email Contents:</td>  
    </tr>
    <tr>          
        <td class="field_value" colspan="2"><textarea class="my_textarea use_tinymce" name="content" rows="10"><?php echo set_value('content'); ?></textarea></td>
    </tr>
    <?php if (form_error('content')) { echo '<tr><td class="form_error" colspan="2"'.form_error('content').'</td></tr>'; } ?>

</table>

<input type="submit" value="Send" class="button" />

</form>

</div>