function show_message (message)
{
	$('#overlay_message').html(message);
	$('#overlay').show();	
}


function hide_message ()
{
	$('#overlay_message').html('');	
	$('#overlay').hide();	
}


function toggle_object_found (id)
{

	$('#' + id).toggleClass('object_found');
	
}