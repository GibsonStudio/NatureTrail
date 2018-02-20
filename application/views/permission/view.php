<div class="center_me">
	<?php echo anchor('permission/add', lang('add').' Permission', 'class="button"'); ?>
</div>

<div class="data_table_container">
    
    <table class="data_table">
        
        <tr>
            <td class="data_table_title" colspan="8"><?php echo count($permissions).' '.lang('title_permissions_table'); ?></td>
        </tr>
        
        <tr>
            <td class="data_table_heading"><?php echo lang('id'); ?></td>
            <td class="data_table_heading"><?php echo lang('sort'); ?></td>
            <td class="data_table_heading"><?php echo lang('name'); ?></td>
            <td class="data_table_heading"><?php echo lang('description'); ?></td>
            <td class="data_table_heading"></td>
        </tr>
        
        <?php
        
            //1 row for each user
            foreach ($permissions as $permission)
            {
            	
            	if ($permission['heading'] == 1)
            	{
            		
            		echo '<tr><td colspan="4" class="permission_heading">';
            		echo $permission['name'];
            		echo '</td>';
            		
            		echo '<td>';
            		echo anchor('permission/edit/'.$permission['id'], lang('edit'), 'class="button_small"');
            		echo anchor('permission/delete/'.$permission['id'], lang('delete'), 'class="button_small"');            		 
            		echo '</td>';
            		
            		echo '</tr>';
            		
            	}
            	else
            	{
            		            	
            	echo '<tr>';
            	
            	                
	                echo '<td style="vertical-align: top;">'.$permission['id'].'</td>';
	                echo '<td style="vertical-align: top;">'.$permission['sort'].'</td>';
	                echo '<td style="vertical-align: top; font-weight: bold;">'.$permission['name'].'</td>';
	                echo '<td style="font-size: 10px;">'.nl2br($permission['description']).'</td>';
	                
	   
	                echo '<td>';
	                echo anchor('permission/edit/'.$permission['id'], lang('edit'), 'class="button_small"');
	                echo anchor('permission/delete/'.$permission['id'], lang('delete'), 'class="button_small"');
	    
	                
	                echo '</td>';
	                echo '</tr>';
	                
            	}
            	
            }
            
        ?>        
        
    </table>
    
</div>