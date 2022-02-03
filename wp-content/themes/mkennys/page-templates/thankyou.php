<?php
/*
 * Template Name:Thank you
 */
get_header();
?>
<div class="thankyou">
    <div class="thankyou_inner">
        <div class="ty_logo">
            <img src="<?php echo get_template_directory_uri();?>/images/mkennys-logo.svg" alt="logo" />
        </div>
        <!-- /.ty_logo -->
        <div class="ty_image">
            <img src="<?php echo get_template_directory_uri();?>/images/thankyou.png" alt="thankyou" />        
        </div>
        <!-- /.ty_image -->
        <div class="ty_content">
            <!-- <h3>Your appointment has been confirmed, <br />you will receive an email shortly</h3> -->
            <h3>Your appointment has been confirmed. <small style="display: block;font-size: 75%;">An e-mail with your appointment details is on the way.</small></h3>
            
            <div class="copyright">© 2020 M. Kenny’s Fashions. All rights reserved</div>
        </div>
        <!-- /.ty_content -->
    </div>
    <!-- /.thankyou_content -->
</div>
<!-- /.thankyou -->
<?php
get_footer();
?>