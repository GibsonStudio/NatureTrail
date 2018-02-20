<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="center_me">

    <div class="form_container"> 
        
        <?php
            echo form_open_multipart('user/do_upload_profile_image');
            $id = isset($id) ? $id : set_value('id');
        ?>
        
        <div class="form_title"><?php echo lang('upload_user_profile_image'); ?></div> 
        
        <div class="profile_image_constraints"><?php echo lang('profile_image_constraints'); ?></div>
        
            <table class="form_table">

                <tr>
                    <td><input type="hidden" name="id" value="<?php echo $id; ?>" /></td>
                </tr>
                
                <tr>
                    <td class="form_field_required"><input type="file" name="userfile" /></td>
                </tr>
                
                <tr>
                    <td><input type="submit" value="<?php echo lang('upload'); ?>" class="button" /></td>
                </tr>

                <tr>
                    <td class="form_error"><?php echo $error; ?></td>
                </tr>
                
            </table>
            
        </form>
    
    </div>
    
</div>