<?php
/**
 * Template Name: fitting 
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
?>
<section class="fitting-wrapper">
    <div class="innerPage-container  clearfix">
        <div class="funerl-inner">            
            <div class="fitting-data">
                <h2 class="heading-title">Initial Fit Confirmation</h2>
                
              
                <p>Once you have received your initial article of clothing, we’d like to make sure the fit is perfect before moving on to the rest of your order.</p>
                <a class="order-hold" href="javascript:void()"> <img class="hand-icon" src="<?php echo get_template_directory_uri(); ?>/images/hand-image.png" alt="">Your remaining order is likely on hold until we nail down the fit.</a>
            </div>
        </div>
    </div>
</section>

<section class="fitting-shart-pants">
    
    <div class="innerPage-container  clearfix">
        <div class="shart-pants">            
            <div class="shart-wrapper shart-pants-box">
                <h2 class="heading-title">Shirts</h2>
                <p class="paragraph-title">If possible, please have this laundered once to account for residual shrinkage to occur then provide your feedback. </p>               
            </div>
            <div class="pants-wrapper shart-pants-box">
                <h2 class="heading-title">Suits/Pants/Jackets/<br>Everything else</h2>
                  <p class="paragraph-title"> Please have your clothing professionally pressed. Doing so will make a significant impact on the overall fit and look.</p>
            </div>
        </div>
    </div>
</section>
<section class="fitting-emailSend">
<div class="innerPage-container  clearfix">
        <div class="fitting-emailSend-inner">
            
            <div class="funerl-data">   
            <h2 class="heading-title">Send us an email with
                your comments and photos</h2>            
                <p class="paragraph-title">at minimum 3; of your front, back and side views</p>
                <p class="paragraph-title email-descriptionBox">Email info@mkennys.com with any changes or if we may proceed with your pending order. Your remaining order will be on hold till we receive your confirmation.  </p>
            </div>
            <div class="email-img">
            <img src="<?php echo get_template_directory_uri(); ?>/images/email-send-poto.jpg" alt="">
            </div>
        </div>
    </div>
</section>
<?php
	get_footer(); 
?>