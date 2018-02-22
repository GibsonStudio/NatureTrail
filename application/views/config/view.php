<div class="center_me">
  <?php echo anchor('config/add', 'Add Config Var', 'class="button"'); ?>
</div>

<div class="data_table_container">

    <table class="data_table">

        <tr>
            <td class="data_table_title" colspan="8">Config Vars</td>
        </tr>

        <tr>
            <td class="data_table_heading">Var</td>
            <td class="data_table_heading">Value</td>
            <td class="data_table_heading"></td>
        </tr>

        <?php

            //1 row for each user
            foreach ($config as $var)
            {

            	echo '<tr>';
            	echo '<td>'.$var['var'].'</td>';
                echo '<td>'.$var['value'].'</td>';

                //buttons
                echo '<td>';
                echo anchor('config/delete/'.$var['id'], 'Delete', 'class="button_small"');
                echo anchor('config/edit/'.$var['id'], 'Edit', 'class="button_small"');
                echo '</td>';

                echo '</tr>';
            }

        ?>

    </table>

</div>
