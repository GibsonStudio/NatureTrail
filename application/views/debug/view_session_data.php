<div class="user_profile">
    
    <table style="width:100%;">
        
        <?php
        foreach ($all_data as $key => $value)
        {
        	
        	if (is_array($value))
        	{
        		$value = serialize($value);
        	}
        	
            echo '<tr>';
            echo '<td class="field_title">'.$key.'</td>';
            echo '<td class="field_value">'.$value.'</td>';
            echo '</tr>';
        }
        ?>
        
    </table>
    
</div>