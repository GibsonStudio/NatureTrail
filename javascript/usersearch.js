function usersearch (my_path) { 
	
	var val = $('#usersearch').val();
	var include_del = 0;
	var user_wildcards = 0;

	if ($('#include_deleted').prop('checked')) {
		include_del = 1;
	}
	
	if ($('#user_wildcards').prop('checked')) {
		user_wildcards = 1;
	}
	
	if (val.length >= 2)
	{
		
		$.ajax({
			url: my_path + 'index.php/user/ajax_search',
			type: 'POST',
			data: {search_string:val, include_deleted:include_del, user_wildcards:user_wildcards}
		}).error(function (e1, e2, e3) {
		
			$('#usersearch_output').html('<b>ERROR:</b> ' + e1 + ': ' + e2 + ': ' + e3);
			
		}).done(function (data) {
		
			$('#usersearch_output').html(data);
			
		});
		
	} else {
	
		$('#usersearch_output').html('');
	
	}
	
}