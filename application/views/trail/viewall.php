<div style="text-align:center;margin-bottom:20px;">

<?php echo anchor('trail/add', lang('add').' Trail', 'class="button"'); ?></div>

<div class="data_table_container">
    
    <table class="data_table">
        
        <tr>
            <td class="data_table_title" colspan="8"><?php echo count($trails).' Trails'; ?></td>
        </tr>
        
        <tr>
            <td class="data_table_heading">Name</td>
            <td class="data_table_heading">Description</td>
            <td class="data_table_heading">Created By</td>
            <td class="data_table_heading">Availability</td>
            <td class="data_table_heading">Object Count</td>
            <td class="data_table_heading">Time Created</td>
            <td class="data_table_heading"></td>
        </tr>
        
        <?php
        
            //1 row for each trail
            foreach ($trails as $trail)
            {
            	
            	echo '<tr>';
            	echo '<td>'.$trail['name'].'</td>';
                echo '<td>'.$trail['description'].'</td>';
                echo '<td>'.$trail['createdby'].'</td>';
                echo '<td>'.$this->availability_model->get_name($trail['availability']).'</td>';
                echo '<td>'.$this->trail_model->object_count($trail['id']).'</td>';
                echo '<td>'.$trail['timestamp'].'</td>';
                
                //buttons
                echo '<td>';
                echo anchor('trail/view_objects/'.$trail['id'], 'Manage Objects', 'class="button_small"');
                echo anchor('trail/view/'.$trail['id'], lang('view'), 'class="button_small"');
                echo anchor('trail/edit/'.$trail['id'], lang('edit'), 'class="button_small"');
                echo anchor('trail/delete/'.$trail['id'], lang('delete'), 'class="button_small"');
                echo '</td>';
                
                echo '</tr>';
            }
            
        ?>        
        
    </table>
    
</div>