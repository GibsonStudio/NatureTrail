<div class="center_me">
<?php echo anchor('availability/add', lang('add').' Availability', 'class="button"'); ?>
</div>

<div class="data_table_container">

    <table class="data_table">

        <tr>
            <td class="data_table_title" colspan="8"><?php echo count($availabilities); ?> Availabilities</td>
        </tr>

        <tr>
            <td class="data_table_heading">Sort</td>
            <td class="data_table_heading">Name</td>
            <td class="data_table_heading"></td>
        </tr>

        <?php

        foreach ($availabilities as $availability)
        {

        	echo '<tr>';
        	echo '<td>'.$availability['sort'].'</td>';
        	echo '<td>'.$availability['name'].'</td>';

        	echo '<td>';
        	echo anchor('availability/edit/'.$availability['id'], lang('edit'), 'class="button_small"');
        	echo anchor('availability/delete/'.$availability['id'], lang('delete'), 'class="button_small"');
        	echo '</td>';

        	echo '</tr>';

        }


        ?>


	</table>

</div>
