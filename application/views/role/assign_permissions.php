<?php 

echo form_open('role/assign_permissions/'.$roleid, 'class="my_form"');
echo '<input type="hidden" name="roleid" value="'.$roleid.'" />';

?>


<div class="data_table_container">
    
    <table class="data_table">
        
        <tr>
            <td class="data_table_title" colspan="8"><?php echo lang('title_assign_permissions_table').' '.$role_name; ?></td>
        </tr>
        
        <tr>
            <td class="data_table_heading"><?php echo lang('name'); ?></td>
            <td class="data_table_heading"><?php echo lang('allow'); ?></td>
            <td class="data_table_heading"><?php echo lang('description'); ?></td>
        </tr>
        
        <?php
        
            //1 row for each permission
            foreach ($permissions as $permission)
            {
            	
            	if ($permission['heading'] == 1)
            	{
            		
            		echo '<tr><td colspan="3" class="permission_heading">';
            		echo $permission['name'];
            		echo '</td>';            		
            		echo '</tr>';
            		
            	}
            	else
            	{
            		
	            	echo '<tr>';            	
	            	                
	                echo '<td style="vertical-align: top; font-weight: bold;">'.$permission['name'].'</td>';
	                echo '<td style="text-align: center;">';
	                
	                //add checkbox
	                $checked = '';
	                
	                if (in_array($permission['id'], $role_permissions))
	                {
	                	$checked = ' checked ';
	                }
	                                
	                echo '<input type="checkbox" name="'.$permission['id'].'" value="1" '.$checked.' />';
	                
	                
	                echo '</td>';
	
	                echo '<td style="font-size: 10px;">'.nl2br($permission['description']).'</td>';
	
	                echo '</tr>';
	                
            	}
            	
            }
            
        ?>        
        
        <tr>
        	<td class="table_buttons" colspan="3" style="text-align: center;"><input type="submit" value="<?php echo lang('set_permissions'); ?>" class="button" /></td>
        </tr>
        
        
    </table>
    
</div>

</form>