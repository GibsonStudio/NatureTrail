<div class="data_table_container">
    
    <table class="data_table">
        
        <tr>
            <td class="data_table_title" colspan="9"><?php echo $user_count.' '.lang('title_users_table'); ?></td>
        </tr>
        
        <tr>
            <td class="data_table_heading"><?php echo lang('id'); ?></td>
            <td class="data_table_heading"><?php echo lang('email'); ?></td>
            <td class="data_table_heading"><?php echo lang('firstname'); ?></td>
            <td class="data_table_heading"><?php echo lang('middlenames'); ?></td>
            <td class="data_table_heading"><?php echo lang('lastname'); ?></td>
            <td class="data_table_heading"><?php echo lang('accesslevel'); ?></td>
            <td class="data_table_heading"></td>
        </tr>
        
        <?php
        
            //1 row for each user
            foreach ($users as $user)
            {
                
                if ($user['deleted'] == 1)
                {
                    echo '<tr class="data_table_deleted">';
                }
                else
                {
                    echo '<tr>';
                }
                
                echo '<td>'.$user['id'].'</td>';
                echo '<td>'.$user['email'].'</td>';
                echo '<td>'.$user['firstname'].'</td>';
                echo '<td>'.$user['middlenames'].'</td>';
                echo '<td>'.$user['lastname'].'</td>';
                echo '<td>'.$this->data_model->get_value('accesslevel', 'name', $user['accesslevel']).'</td>';
                echo '<td>';
                
                echo anchor('user/view/'.$user['id'], lang('view'), 'class="button_small"');
                                
                if ($this->user_model->can_edit_profile($user['id']))
                {
                	echo anchor('user/edit/'.$user['id'], lang('edit'), 'class="button_small"');
                }
                
                if ($this->user_model->can_delete_user($user['id']))
                {
                	
	                if ($user['deleted'] != 1)
	                {
	                	echo anchor('user/delete/'.$user['id'], lang('delete'), 'class="button_small"');
	                }
	                else 
	                {
	                	//permanently delete
	                	echo anchor('user/delete/'.$user['id'].'/0/1', lang('delete_permanent'), 'class="button_small"');
	                }
	                
                }                
                
                
                if ($this->user_model->has_permission('email_user'))
                {
                	echo '<a href="mailto:'.$user['email'].'" class="button_small">'.lang('email').'</a>';
                	//echo anchor('user/email/'.$user['id'], lang('email'), 'class="button_small"');
                }
                
                
                echo '</td>';
                echo '</tr>';
            }
            
        ?>        
        
    </table>
    
    <!-- show page selector -->
    
    <?php 
    
    $page_count = ceil($user_count / $users_per_page);
    
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
	    		echo anchor('user/viewall/'.$i, $i, 'class="page_number"');	
	    	}
	    	
	    }   

	    echo '</div>';
	    
    }
    ?>
    
</div>