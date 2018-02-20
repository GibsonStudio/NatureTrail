<div class="data_table_container">
    
    <table class="data_table">
        
        <tr>
            <td class="data_table_title" colspan="8"><?php
            
            echo $log_count.' Log Entries';
            
            if ($userid != 0)
            {
            	echo ' for '.$this->data_model->get_name($userid);
            	echo ' ('.anchor('log/view/', 'Show all logs').')';
            }
            
            ?></td>
        </tr>
        
        <tr>
            <td class="data_table_heading">User</td>
            <td class="data_table_heading">Action</td>
            <td class="data_table_heading">Data</td>
            <td class="data_table_heading">Timestamp</td>
        </tr>
        
        <?php
        
            //1 row for each user
            foreach ($logs as $log)
            {
            	
            	echo '<tr>';
            	//echo '<td>'.$this->data_model->get_name($log['userid']).' ('.$log['userid'].')</td>';
            	$name = $log['userid'] != 0 ? $this->data_model->get_name($log['userid']) : 'Guest';
            	echo '<td>'.anchor('log/view/1/'.$log['userid'], $name).'</td>';
            	
                echo '<td>'.$log['action'].'</td>';
                echo '<td>'.$log['data'].'</td>';
                echo '<td>'.timestamp_to_string($log['timestamp']).'</td>';
                echo '</tr>';
            }
            
        ?>        
        
    </table>
    <br />
    
    <!-- show page selector -->
    
    <?php 
    
    $page_count = ceil($log_count / $logs_per_page);
    
    if ($page_count > 1)
    {
    	
    	$script = '<script>function go_page() { window.location.href=($("#page_num").val()); }</script>';
    	echo $script;    	
    	
    	$p = '<select id="page_num" onchange="go_page()">';
    	
    	for ($i = 1; $i <= $page_count; $i++)
    	{
    	
    		$link = site_url('log/view/'.$i.'/'.$userid);
    		
    		if ($page == $i)
    		{
    			$p .= '<option value="'.$link.'" selected>'.$i.'</option>';
    		}
    		else
    		{
    			$p .= '<option value="'.$link.'">'.$i.'</option>';
    		}
    	
    	}
    		
    	$p .= '</select>';
    	
    	echo '<div class="center_me">Page '.$p.' of '.$page_count.'</div>';
    	
    }
    
    
    
    
    /*
    if ($page_count > 1)
    {
    	
    	echo '<div class="page_numbers_container"><span style="font-weight: bold; float: left; padding: 5px;">Page:</span>';
    	
	    for ($i = 1; $i <= $page_count; $i++)
	    {
	    	
	    	if ($page == $i)
	    	{
	    		echo '<span class="page_number current_page">'.$i.'</span>';
	    	}
	    	else
	    	{
	    		echo anchor('log/view/'.$i.'/'.$userid, $i, 'class="page_number"');	
	    	}
	    	
	    }   

	    echo '</div>';
	    
    }
    */
    
    ?>

    
</div>