<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/validationEngine.jquery.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validationEngine-en.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validationEngine.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
			jQuery("#refer_form").validationEngine();
	});
</script>
<div class="footerPrefix">
	<div class="container">
    	<div class="FP_left">
        	<p><b>READY TO START?</b></p>
            <p>Get Fitted in your city</p>
            <p><a href="http://trsoftwaregroup.com/dev/mkennys/tour-schedule/" class="fitted_btn">Get Fitted <i class="fa fa-chevron-right"></i></a></p>
        </div>
        <div class="FP_right">
        	<div class="FPR_box">
            	<p><b>Stay informed</b></p>
                <p>Sign up for our newsletter to find out when will be in your city next.</p>
                
                <?php echo do_shortcode('[wysija_form id="2"]')?>
                
            </div>
        </div>        
    </div>
</div>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footerBox">
            <p><b>Styles</b></p>
            <ul class="list-unstyled">
                <li><a href="<?php echo esc_url(home_url());?>/suits/">Suits</a></li>
                <li><a href="<?php echo esc_url(home_url());?>/shirts/">Shirts</a></li>
                <!--<li><a href="<?php echo esc_url(home_url());?>/shirts/">Formal Wear</a></li>-->
                <li><a href="<?php echo esc_url(home_url());?>/women/">Women's Wear</a></li>
                <li><a href="<?php echo esc_url(home_url());?>/outerwear/">Outerwear</a></li>
                <li><a href="<?php echo esc_url(home_url());?>/tour-schedule/">Tour Schedule</a></li>
            </ul>
        </div>
        <div class="footerBox">
            <p><b>Help</b></p>
            <ul class="list-unstyled">
                <li><a href="">Shipping & Delivery</a></li>
                <li><a href="">Alterations</a></li>
                <li><a href="">Payments and Inquiries</a></li>
                <li><a href="">Promo Code</a></li>
                <li><a href="<?php echo esc_url(home_url('/')); ?>/faqs">FAQ’s</a></li>
				<li>
					<p><b>Miscellaneous</b></p>
                    <ul class="list-unstyled">
                        <li><a href="javascript:;" class="viewDetail" >Refer A Friend</a></li>
                        <li><a href="<?php echo site_url();?>/faq/#faq_141" class="">Gift Certificates</a></li>               
                    </ul>
				
				</li>
				
				
            </ul>
			<!--
            <p><b>Referral</b></p>
            <ul class="list-unstyled">
                <li><a href="javascript:;" class="viewDetail" >Refer a friend</a></li>               
            </ul>-->
        </div>
        <div class="footerBox">
            <p><b>Contact Us</b></p>
            <div class="addressBlock">
                <div class="phone">
                    <p><b>Phone</b></p>
                    <p>+ 1 714 573 2199</p>
                </div>
                <div class="email">
                    <p><b>Email</b></p>
                    <p><a href="mailto:info@mkennys.com">info@mkennys.com</a></p>
                </div>
                <div class="address">
                    <p><b>US Office</b></p>
                    <p>Orange County, CA.<br>
                        3 Corporate Park, Suite 235,<br>
                        Irvine, CA. 92606</p>
                </div>
                <div class="address">
                    <p><b>Asia: Hong Kong</b></p>
                    <p>503 Supreme House,<br>
                        2A Hart Avenue,<br>
                        Kowloon, Hong Kong</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
    	<div class="container">
            <ul class="copy_right unstyled-list">
                <li>&copy; <?php echo date('Y');?> M. Kenny’s Fashions. All rights reserved</li>
                <li><a href="<?php echo esc_url(home_url('/')); ?>/privacy">Privacy Policy</a></li>
            </ul>
            <div class="social_footer">
                <p>FOLLOW US</p>
                <ul class="social unstyled-list">
                    <li class="fb"> <a target="_blank" href="https://www.facebook.com/pages/M-Kennys-Fashions-Inc/154636154604317"></a></li>
                    <li class="ln"><a target="_blank" href="http://www.linkedin.com/in/mkenny"></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<div id="referFriend" style="display:none;" class="ReferFriend">
    <div class="FCpopup_inner">
    <div class="FCpopup_element">
            <div class="FCpopup_content FPR_box2">
                <button class="FCclosePopup">+</button>
               

                <div class="FCpopup_description">
                    Love Your Suit/Shirt? Refer-A-Friend and received a complimentary custom shirt on us
                </div>
                
                <div class="FCpopup_message ">
                    <form method="POST" id="refer_form" action="">
                            
                            <div class="input_content"> 
                                <input type="text" class="validate[required]" placeholder="Your Name" name="from_name">
                            </div>
                            <div class="input_content"> 
                                <input type="text" placeholder="Your Email" class="validate[required,custom[email]]" name="from_email">
                            </div>
                            <div class="input_content select"> 
                                 <select class="validate[required]" name="from_state">
                                    <option value="" disabled selected>State</option>
                                    <?php
                                        global $wpdb;
                                        $table_name = $wpdb->prefix . 'state';
                                        $result = $wpdb->get_results("SELECT state_name FROM $table_name",ARRAY_A);
                                        
                                        foreach ($result as $value) {
                                            ?>
                                            <option value="<?php echo $value['state_name']; ?>"><?php echo $value['state_name']; ?></option>
                                        <?php }
                                     ?>
                                 
                                </select>
                            </div>
                            <div class="input_content"> 
                                <input type="text" class="validate[required]" placeholder="Friend Name" name="to_name">
                            </div>
                            <div class="input_content"> 
                                <input type="text" placeholder="Friend Email" class="validate[required,custom[email]]" name="to_email">
                            </div>
                            <div class="input_content select">
                                <select class="validate[required]" name="to_state">
                                    <option value="" disabled selected>State</option>
                                    <?php
                                        global $wpdb;
                                        $table_name = $wpdb->prefix . 'state';
                                        $result = $wpdb->get_results("SELECT state_name FROM $table_name",ARRAY_A);
                                        
                                        foreach ($result as $value) {
                                            ?>
                                            <option value="<?php echo $value['state_name']; ?>"><?php echo $value['state_name']; ?></option>
                                        <?php }
                                     ?>
                                 
                                </select>
                            </div>
                        <div class="input_content submit">
                        <input type="submit" value="Submit" name="footersubmit">
                        </div>
                    </form>
                </div>
                <div class="FCpopup_description_end">
                    *Once your referral has placed an order you will automatically receive credit for a complimentary custom shirt.
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
if(isset($_POST['footersubmit'])){
    $data = array(
      'from_name' => $_POST['from_name'],
      'from_email' => $_POST['from_email'],
      'from_state' => $_POST['from_state'],
      'to_name' => $_POST['to_name'],
      'to_email' => $_POST['to_email'],
      'to_state' => $_POST['to_state'],
    );
    $table_name = $wpdb->prefix . 'refer';
    
     $result = $wpdb->get_results("SELECT to_email FROM $table_name where to_email = '".$_POST['to_email']."' ",ARRAY_A);

     if(count($result) > 0){
        ?><script> alert('Requested Friend Already Referred Please Try New One') </script> <?php
     }
     else{

        $wpdb->insert($table_name, $data, '%s');

        /* Promo Table content */
        $date = date('d-m-y');
        $coupon = substr( md5(rand()), 0, 7);
        $date_frw = strtotime("+7 day");
        $end_date = date('d-m-y', $date_frw);
        $promo_data = array(
            'code' =>$coupon,
            'start_date' => $date,
            'end_date' => $end_date,
            'email' => $data['from_email'],
            'status' => 'Deactive',
            'discount' => '100',
            );
        $table_promo = $wpdb->prefix . 'promo';
        $wpdb->insert($table_promo, $promo_data, '%s');
        footerMail($data['to_email'],$data['from_email'],$data['from_name'],$data['to_name']);
    ?><script> alert('Friend Refer Successfully') </script>  
    <?php 
    }
}

    function footerMail($to_email,$from_email,$from_name,$to_name){
        
        $url = home_url();
        $to_message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";
        $to_message .="<div  style='background: #eaeced;'>
                        <div  style='width:700px; margin:0px auto; background: #fff;'>
                            
                            <div style='text-align: center; padding: 20px; background: #fff;'>
                                <a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a> 
                            </div>
                            <div><img src='".$url."/newsletter-images/about-01.jpg'></div>
                            <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>
                                <p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Dear ".$to_name." </p>
                                <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>Your friend ".$from_name." (".$from_email.") thought you’d be interested in building a custom wardrobe with True Fitted by M. Kenny’s. True Fitted provides handcrafted bespoke custom suits, jackets and shirts that are sure to help you leave a lasting impression. Book your custom fitting appointment with a master tailor in your city. Please visit: <a href='http://www.mkennys.com/'>Mekennys.com</a></p>
                                    
                                <hr>
                                <p>
                                    <b style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Thanks</b>
                                <br>
                                    <span style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>True Fitted by M. Kenny’s</span>
                                 <br><br>
                                    <span style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>3 Corporate Park, Suite 235</span>   
                                <br>
                                    <span style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Irvine, CA. 92606</span>
                                <br>
                                    <a href='mailto:info@mkennys.com'>info@mkennys.com</a>
                                <br>
                                    <a href='http://www.mkennys.com'>www.mkennys.com</a>
                                <br>
                                    <span style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Phone: +1 714 573 2199</span>   
                                
                                </p>
                            </div>
                            <div style='padding: 30px; background: #f7f7f7; text-align:center'>
                                <ul style='padding:0;'>
                                    <li style='display:inline-block;'><a href='mailto:info@mkennys.com' style='text-decoration: none; font-size: 13px; font-family:Arial, Helvetica, sans-serif; color: #555;'>info@mkennys.com</a></li>
                                    <li style='display:inline-block; padding:0 100px; font-size: 13px; font-family:Arial, Helvetica, sans-serif; color: #555;'>+1-1234-5678</li>
                                    <li style='display:inline-block;'><a href='".$url."/faqs' style='text-decoration: none; font-size: 13px; font-family:Arial, Helvetica, sans-serif; color: #555;'>FAQ</a></li>
                                </ul>
                                <p style='font-size: 13px; text-align: center; font-family:Arial, Helvetica, sans-serif; color: #555;'>&copy; Copyright 2017, Mkennys</p>
                            </div>
                        </div>
                    </div>";

        $from_message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";
        $from_message .="<div  style='background: #eaeced;'>
                        <div  style='width:700px; margin:0px auto; background: #fff;'>
                            
                            <div style='text-align: center; padding: 20px; background: #fff;'>
                                <a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a> 
                            </div>
                            <div><img src='".$url."/newsletter-images/image.jpg'></div>
                            <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>
                                <p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Dear ".$from_name." </p>
                                <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>
                                Thank you for your referral. You’re one step closer to receiving a complimentary custom shirt on us! Once your referral places an order with us you’ll be awarded a fully handmade custom shirt (color/style options at your discretion). 
                                </p>
                                    
                                <hr>
                                <p>
                                    <b style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Thanks</b>
                                <br>
                                    <span style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>True Fitted By M. Kenny’s </span>
                                 <br><br>
                                    <span style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>3 Corporate Park, Suite 235</span>   
                                <br>
                                    <span style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Irvine, CA. 92606</span>
                                <br>
                                    <a href='mailto:info@mkennys.com'>info@mkennys.com</a>
                                <br>
                                    <a href='http://www.mkennys.com'>www.mkennys.com</a>
                                <br>
                                    <span style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Phone: +1 714 573 2199</span>    
                                </p>
                            </div>
                            <div style='padding: 30px; background: #f7f7f7; text-align:center'>
                                <ul style='padding:0;'>
                                    <li style='display:inline-block;'><a href='mailto:info@mkennys.com' style='text-decoration: none; font-size: 13px; font-family:Arial, Helvetica, sans-serif; color: #555;'>info@mkennys.com</a></li>
                                    <li style='display:inline-block; padding:0 100px; font-size: 13px; font-family:Arial, Helvetica, sans-serif; color: #555;'>+1-1234-5678</li>
                                    <li style='display:inline-block;'><a href='".$url."/faqs' style='text-decoration: none; font-size: 13px; font-family:Arial, Helvetica, sans-serif; color: #555;'>FAQ</a></li>
                                </ul>
                                <p style='font-size: 13px; text-align: center; font-family:Arial, Helvetica, sans-serif; color: #555;'>&copy; Copyright 2017, Mkennys</p>
                            </div>
                        </div>
                    </div>";

        

        



        
        $to_subject = "Referral Invitation (MKennys.com)";

        $from_subject = "Referral Confirmation (MKennys.com)";


        $from = 'info@mkennys.com';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Bcc:info@mkennys.com,Kenny@mkennys.com' . "\r\n";
        
        // $headers .= 'Bcc:singhkaranjeet92@gmail.com,karanjeettr@gmail.com' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: " .$from. "\r\n" .
        "X-Mailer: PHP/" . phpversion();
        $mail=mail($to_email,$to_subject,$to_message,$headers);
        $mail=mail($from_email,$from_subject,$from_message,$headers);
        return;
    }


?>

<script>

 jQuery(document).ready(function() {
        jQuery(".viewDetail").click(function () {
             jQuery('#referFriend').css('display','block');
        });
        jQuery(".FCclosePopup").click(function () {
            jQuery('#referFriend').css('display','none');
        });
    });



jQuery(document).ready(function() { 
	jQuery( document ).on( "click",  ".close_wysija", function() {
		jQuery('.allmsgs').hide();
	});
	jQuery( document ).on( "click",  ".CPO_close", function() {
		jQuery('.customPopOverlay').hide();

        jQuery('.contactCustomPopOverlay').hide();
	});
	
	jQuery( document ).ajaxComplete(function( event, xhr, settings ) {	 		
		//alert(settings.data);
		var ajaxCallData = settings.data;
        
		if(ajaxCallData.indexOf('wysija_ajax') != -1){
			jQuery('.firstComePopup').hide();
			jQuery('.customPopOverlay').show();            
		}
        else if(ajaxCallData.indexOf('_wpcf7') != -1)
        {
            
            var message = JSON.parse(xhr.responseText);
                message = message.message;               
            jQuery('.contactCustomPopOverlay').show();
            jQuery('.contactCustomPopOverlay').find('p').html(message);
        }
		
		
	});
	
    jQuery(document).on('click','.close_wysija',function(){
        jQuery('.widget_wysija')[0].reset();
    });
	
	jQuery(".home_begning").click(function(e){
		 jQuery('.commonSection').removeClass('selected');		 
		 jQuery(nextSection).addClass('selected');
		 var nextSection = $(this).parents('.commonSection:first').next('.commonSection');
		 var top  = jQuery(nextSection).offset().top
		 
		jQuery('body,html').animate({ scrollTop:  top});
		
	});
	
	
})
</script>


<div class="contactCustomPopOverlay">
    <div class="CPO_inner">
        <p></p>
        <button class="CPO_close">Close</button>
    </div>
</div>

<?php wp_footer(); ?>
