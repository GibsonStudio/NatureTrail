<div class="center_me">
<?php echo anchor('rarity/add', lang('add').' Rarity', 'class="button"'); ?>
</div>

<div class="data_table_container">    
    
    <table class="data_table">
        
        <tr>
            <td class="data_table_title" colspan="8"><?php echo count($rarities); ?> Rarities</td>
        </tr>
        
        <tr>
            <!-- <td class="data_table_heading">ID</td> -->
            <td class="data_table_heading">Value</td>
            <td class="data_table_heading">Name</td>
            <td class="data_table_heading"></td>
        </tr>
        
        <?php 
        
        foreach ($rarities as $rarity)
        {
        	
        	echo '<tr>';
        	//echo '<td>'.$rarity['id'].'</td>';
        	echo '<td>'.$rarity['value'].'</td>';
        	echo '<td>'.$rarity['name'].'</td>';
        	
        	echo '<td>';
        	echo anchor('rarity/edit/'.$rarity['id'], lang('edit'), 'class="button_small"');
        	echo anchor('rarity/delete/'.$rarity['id'], lang('delete'), 'class="button_small"');
        	echo '</td>';
        	
        	echo '</tr>';
        	
        }
        
        
        ?>
        
        
	</table>
	
</div>