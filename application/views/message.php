<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="message">
    <?php
    
    echo $message_text;
    
    if (isset($buttons))
    {
        
        echo '<hr />';
        
        foreach ($buttons as $button)
        {
            
            if (isset($button['type']))
            {
                
                //back button
                if ($button['type'] == 'back')
                {
                    
                    //is button_text set?
                    if (isset($button['button_text'])) {
                        $text = $button['button_text'];
                    } else {
                        $text = lang('back');
                    }
                    
                    $back_level = 1;
                    
                    if (isset($button['back_level']))
                    {
                        $back_level = $button['back_level'];
                    }
                    
                    echo '<a href="javascript:history.go(-'.$back_level.');" class="button">'.$text.'</a>';
                    
                }
                
                
            }
            else
            {
                //default button
                echo anchor($button['link'], $button['button_text'], 'class="button"');
            }
                        
        }
        
    }
    
    ?>    
</div>