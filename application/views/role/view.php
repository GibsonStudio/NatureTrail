<div class="center_me">
	<?php echo anchor('role/add', lang('add').' Role', 'class="button"'); ?>
</div>

<div class="data_table_container">
    
    <table class="data_table">
        
        <tr>
            <td class="data_table_title" colspan="8"><?php echo count($roles).' '.lang('title_roles_table'); ?></td>
        </tr>
        
        <tr>
            <td class="data_table_heading"><?php echo lang('id'); ?></td>
            <td class="data_table_heading"><?php echo lang('name'); ?></td>
            <td class="data_table_heading"><?php echo lang('level'); ?></td>
            <td class="data_table_heading"><?php echo lang('description'); ?></td>
            <td class="data_table_heading"></td>
        </tr>
        
        <?php
        
            //1 row for each user
            foreach ($roles as $role)
            {
            	
            	echo '<tr>';
            	
            	                
                echo '<td style="vertical-align: top;">'.$role['id'].'</td>';
                echo '<td style="vertical-align: top; font-weight: bold;">'.$role['name'].'</td>';
                echo '<td style="vertical-align: top;">'.$role['level'].'</td>';
                echo '<td>'.nl2br($role['description']).'</td>';
                
   
                echo '<td>';
                echo anchor('role/assign_permissions/'.$role['id'], lang('assign_permissions'), 'class="button_small"');
                echo anchor('role/edit/'.$role['id'], lang('edit'), 'class="button_small"');
                echo anchor('role/delete/'.$role['id'], lang('delete'), 'class="button_small"');
    
                
                echo '</td>';
                echo '</tr>';
            }
            
        ?>        
        
    </table>
    
</div>