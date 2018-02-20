<div style="text-align:center;margin-bottom:20px;">

<?php echo anchor('group/add', lang('add').' Group', 'class="button"'); ?></div>

<div class="data_table_container">
    
    <table class="data_table">
        
        <tr>
            <td class="data_table_title" colspan="8"><?php echo count($groups).' Groups'; ?></td>
        </tr>
        
        <tr>
            <td class="data_table_heading">Name</td>
            <td class="data_table_heading">Description</td>
            <td class="data_table_heading">Member Count</td>
            <td class="data_table_heading"></td>
        </tr>
        
        <?php
        
            //1 row for each user
            foreach ($groups as $group)
            {
            	
            	echo '<tr>';
            	echo '<td>'.$group['name'].'</td>';
                echo '<td>'.$group['description'].'</td>';
                echo '<td>'.$this->group_model->member_count($group['id']).'</td>';
                
                //buttons
                echo '<td>';
                echo anchor('group/view_members/'.$group['id'], 'Manage Members', 'class="button_small"');
                echo anchor('group/edit/'.$group['id'], lang('edit'), 'class="button_small"');
                echo anchor('group/delete/'.$group['id'], lang('delete'), 'class="button_small"');
                echo '</td>';
                
                echo '</tr>';
            }
            
        ?>        
        
    </table>
    
</div>