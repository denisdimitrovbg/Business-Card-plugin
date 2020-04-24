<?php
if (!defined('ABSPATH')) exit;

?>
   
<form method="post" action="">
    <input type="hidden" name="business-cards-admin-form" value="1">
            
    <div class="information">
        <p>
            <label for="bc-name">Name</label><br/>
            <input type="text" name="bc-name" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'bc-name', true)) ;?>"/>
        </p>

        <p>
            <label for="bc-role">Role</label><br/>
            <input type="text" name="bc-role" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'bc-role', true)) ;?>"/>
        </p>

        <p>
            <label for="bc-phone">Phone</label><br/>
            <input type="tel" name="bc-phone" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'bc-phone', true)) ;?>"/>
        </p>

         <?php wp_nonce_field('business-cards-save', 'business-cards-admin-form');
            submit_button();?>
    </div><!-- .information -->


             
</form>

