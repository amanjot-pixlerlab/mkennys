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
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<script type="text/javascript">

	jQuery(document).ready(function(){

			jQuery("#refer_form").validationEngine();

	});

</script>

<?php if(!is_page('323') && !is_page('325')){ ?>
<div class="footerPrefix">
	<div class="container">
    	<div class="FP_left">
        	<p><b>READY TO START?</b></p>
            <p>Get Fitted in your city</p>
            <p><a href="<?php echo home_url(); ?>/tour-schedule/" class="fitted_btn">Get Fitted <i class="fa fa-chevron-right"></i></a></p>
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

<?php }?>


<?php if(!is_page('323') && !is_page('325')){ ?>

<footer id="colophon" class="site-footer" role="contentinfo">

    <div class="container">

        <div class="footerBox">

            <p><b>Style</b></p>

            <ul class="list-unstyled">

                <li><a href="<?php echo esc_url(home_url());?>/suits/">Suits</a></li>

                <li><a href="<?php echo esc_url(home_url());?>/shirts/">Shirts</a></li>

				<li><a href="<?php echo esc_url(home_url());?>/Jackets/">Jackets</a></li>
                <!--<li><a href="<?php //echo esc_url(home_url());?>/shirts/">Formal Wear</a></li>-->

                <li><a href="<?php echo esc_url(home_url());?>/outerwear/">Outerwear</a></li>

                <li class="women"><a href="<?php echo esc_url(home_url());?>/women/">Women's Wear</a></li>

				
				



            </ul>

        </div>

        <div class="footerBox">

            <p><b>SUPPORT</b></p>

            <ul class="list-unstyled">

				<li><a href="<?php echo esc_url(home_url()); ?>/clientreviews">Reviews</a></li>

                <li><a href="<?php echo esc_url(home_url());?>/faqs/#faq_118" class="">Shipping & Delivery</a></li>

                <li><a href="<?php echo esc_url(home_url());?>/faqs/#faq_121" class="">Fit Assurance</a></li>
                
                <li><a href="<?php echo esc_url(home_url());?>/faqs/#faq_117" class="">Alterations</a></li>

                <li><a href="<?php echo esc_url(home_url()); ?>/faqs">FAQ’s</a></li>
				
				

			 </ul>

		</div>

        <div class="footerBox">

            <p><b>MORE</b></p>

            <ul class="list-unstyled">

                <!-- <li><a href="<?php //echo esc_url(home_url());?>/tour-schedule/">Tour Schedule</a></li> -->

                <li><a href="javascript:;" class="viewDetail">Refer A Friend</a></li>

                <li><a href="<?php echo esc_url(home_url());?>/faqs/#faq_141" class="">Gift Certificates</a></li>

                <li><a href="<?php echo esc_url(home_url());?>/corporate-service" class="">Corporate Service</a></li>

            </ul>

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

                    <p>True Fitted by M. Kenny's<br>17601 17th Street, Suite 115<br>Tustin, CA. 92780</p>

                </div>

                <div class="address">

                    <p><b>Asia: Hong Kong</b></p>

                    <p>1203 Oriental Center<br>

                        67-70 Chatham Road<br>

                        Kowloon TST, Hong Kong</p>

                </div>

            </div>

        </div>

    </div>

    <div class="footer_bottom">

    	<div class="container">

            <ul class="copy_right unstyled-list">

                <!-- <li>&copy; <?php //echo date('Y');?> M. Kenny’s Fashions. All rights reserved</li> -->
                <li>&copy; <?php echo date('Y');?> True Fitted by M. Kenny's. All rights reserved</li>

                <li><a href="<?php echo esc_url(home_url('/')); ?>/privacy">Privacy Policy</a></li>

            </ul>

            <div class="social_footer">

                <p>FOLLOW US</p>

                <ul class="social unstyled-list">

                    <li class="fb"> <a target="_blank" href="https://www.facebook.com/pages/M-Kennys-Fashions-Inc/154636154604317"></a></li>

                    <li class="ln"><a target="_blank" href="http://www.linkedin.com/in/mkenny"></a></li>
                    
                    <li class="ig"><a target="_blank" href="https://www.instagram.com/p/B3xrOZ1lyZW/TrueFittedMK"></a></li>

                </ul>

            </div>

        </div>

    </div>

</footer>
<?php }?>

</div>

</div>



<div id="referFriend" style="display:none;" class="ReferFriend">

    <div class="FCpopup_inner">

    <div class="FCpopup_element">

            <div class="FCpopup_content FPR_box2">

                <button class="FCclosePopup">+</button>





                <div class="FCpopup_description">

                    Love Your Suit/Shirt? Refer-A-Friend and receive a complimentary custom shirt on us.

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

                                <input type="text" class="validate[required]" placeholder="Friend's Name" name="to_name">

                            </div>

                            <div class="input_content">

                                <input type="text" placeholder="Friend's Email" class="validate[required,custom[email]]" name="to_email">

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

														<div class="input_content">
															<?php echo apply_filters( 'gglcptch_display_recaptcha', '' ); ?>
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



<div id="foo" class="calenderOverlay foo" style="display:none;">

    <div class="calenderInner">

        <p>Thanks for your continued support, you’re on your way towards receiving a complimentary custom shirt on us.</p>

        <a href="javascript:;" class="fooClose">Close</a>

    </div>

</div>



<div id="foo_error" class="calenderOverlay foo_error" style="display:none;">

    <div class="calenderInner">

        <p id='foo_error_text'></p>

        <a href="javascript:;" class="foo_ErrorClose">Close</a>

    </div>

</div>



<?php

if(isset($_POST['footersubmit'])){
	$check_result = apply_filters( 'gglcptch_verify_recaptcha', true, 'string' );
	if ( true === $check_result ) { /* the reCAPTCHA answer is right */
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

				?><script>





				jQuery(document).ready(function(){
						jQuery("#foo_error").css('display','inline-block');
						jQuery("#foo_error_text").text("Requested Friend Already Referred Please Try New One.");
						jQuery('.foo_ErrorClose').click(function(){
								jQuery('.foo_error').hide();
						});
				});





				 </script> <?php

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

				footerMail($data['to_email'],$data['from_email'],$data['from_name'],$data['to_name'], $data['from_state'], $data['to_state']);

		?><script>





				jQuery(document).ready(function(){



						jQuery("#foo").css('display','inline-block');



						jQuery('.fooClose').click(function(){

								jQuery('.foo').hide();

						});



				});



		</script>

		<?php

		}
	} else { /* the reCAPTCHA answer is wrong or there are some other errors */
		?><script>





		jQuery(document).ready(function(){

				jQuery("#foo_error").css('display','inline-block');
				jQuery("#foo_error_text").text("<?php echo $check_result; ?>");
				jQuery('.foo_ErrorClose').click(function(){
						jQuery('.foo_error').hide();
				});
		});
		 </script> <?php
	}


}



    function footerMail($to_email,$from_email,$from_name,$to_name, $from_state, $to_state){



        $url = home_url();

        $to_message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";

        $to_message .="<div  style='background: #eaeced;'>

                        <div  style='width:700px; margin:0px auto; background: #fff;'>



                            <div style='text-align: center; padding: 20px; background: #fff;'>

                                <a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a>

                            </div>

                            <div><img src='".$url."/newsletter-images/about-01.jpg'></div>

                            <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>

                                <p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Dear ".$to_name.",</p>

                                <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>Your friend ".$from_name." (".$from_email.") thought you’d be interested in building a custom wardrobe with <span style='font-weight:bold'>True Fitted by M. Kenny's</span>. True Fitted provides handcrafted bespoke custom suits, jackets and shirts that are sure to help you leave a lasting impression. Book your custom fitting appointment with a master tailor in your city. Please visit: <a href='http://www.mkennys.com/'>www.mkennys.com</a></p>



                                <hr>

                               <p>

                                              <span style='font-weight:bold;font-size: 12px; font-family:Verdana, sans-serif; color: #222;'>Thanks,</span>

                                            <br>



                                                <span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #222;'>True Fitted by M. Kenny's </span>

                                            <br>

                                                <span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #222;'>Irvine, CA.</span>

                                            <br>

                                                <a style='font-weight:bold;color:#15c;font-size: 13px;' href='mailto:info@mkennys.com'>info@mkennys.com</a>

                                            <br>

                                                <a style='font-weight:bold;color:#15c;font-size: 13px;' href='http://www.mkennys.com'>www.mkennys.com</a>

                                            <br>

                                               <a style='font-weight:bold;color:#15c;font-size: 13px;' href='tel:(714)%20573-2199' value='+17145732199' target='_blank'>+1 714 573 2199</a>

                                            </p>

                            </div>

                            <div style='padding: 30px; background: #f7f7f7; text-align:center'>



                                <p style='font-size: 16px; text-align: center; font-family:Arial, Helvetica, sans-serif; color: #555;'><a href='http://www.mkennys.com'>www.mkennys.com</a></p>

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

                                <p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Dear ".$from_name.",</p>

                                <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>

                                Thank you for your referral. You're one step closer to receiving a complimentary custom shirt on us! Once your referral places an order with us you'll be awarded a fully handmade custom shirt (color/style options at your discretion).

                                </p>



                                <hr>

                                <p>

                                              <span style='font-weight:bold;font-size: 12px; font-family:Verdana, sans-serif; color: #222;'>Thanks,</span>

                                            <br>



                                                <span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #222;'>True Fitted by M. Kenny's </span>

                                            <br>

                                                <span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #222;'>Irvine, CA.</span>

                                            <br>

                                                <a style='font-weight:bold;color:#15c;font-size: 13px;' href='mailto:info@mkennys.com'>info@mkennys.com</a>

                                            <br>

                                                <a style='font-weight:bold;color:#15c;font-size: 13px;' href='http://www.mkennys.com'>www.mkennys.com</a>

                                            <br>

                                               <a style='font-weight:bold;color:#15c;font-size: 13px;' href='tel:(714)%20573-2199' value='+17145732199' target='_blank'>+1 714 573 2199</a>

                                            </p>

                            </div>

                            <div style='padding: 30px; background: #f7f7f7; text-align:center'>



                                <p style='font-size: 16px; text-align: center; font-family:Arial, Helvetica, sans-serif; color: #555;'> <a href='http://www.mkennys.com'>www.mkennys.com</a></p>

                            </div>

                        </div>

                    </div>";



        $admin_message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";

        $admin_message .="<div  style='background: #eaeced;'>

                        <div  style='width:700px; margin:0px auto; background: #fff;'>



                            <div style='text-align: center; padding: 20px; background: #fff;'>

                                <a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a>

                            </div>

                            <div><img src='".$url."/newsletter-images/image.jpg'></div>

                            <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>

                                <p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Dear Admin </p>

                                <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>

                                Referral information Request.

                                </p>



                                <table>

                                    <tbody>

                                        <tr>

                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>To</td>

                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$to_name."</td>

                                        </tr>

                                        <tr>

                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Email</td>

                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$to_email."</td>

                                        </tr>

                                        <tr>

                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>State</td>

                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$to_state."</td>

                                        </tr>

                                        <tr>

                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>From</td>

                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$from_name."</td>

                                        </tr>

                                        <tr>

                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Email</td>

                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$from_email."</td>

                                        </tr>

                                        <tr>

                                            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>State</td>

                                            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$from_state."</td>

                                        </tr>

                                    </tbody>

                                </table>







                                <hr>

                                 <p>

                                              <span style='font-weight:bold;font-size: 12px; font-family:Verdana, sans-serif; color: #222;'>Thanks,</span>

                                            <br>



                                                <span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #222;'>True Fitted by M. Kenny's </span>

                                            <br>

                                                <span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #222;'>Irvine, CA.</span>

                                            <br>

                                                <a style='font-weight:bold;color:#15c;font-size: 13px;' href='mailto:info@mkennys.com'>info@mkennys.com</a>

                                            <br>

                                                <a style='font-weight:bold;color:#15c;font-size: 13px;' href='http://www.mkennys.com'>www.mkennys.com</a>

                                            <br>

                                               <a style='font-weight:bold;color:#15c;font-size: 13px;' href='tel:(714)%20573-2199' value='+17145732199' target='_blank'>+1 714 573 2199</a>

                                            </p>

                            </div>

                            <div style='padding: 30px; background: #f7f7f7; text-align:center'>



                                <p style='font-size: 16px; text-align: center; font-family:Arial, Helvetica, sans-serif; color: #555;'> <a href='http://www.mkennys.com'>www.mkennys.com</a></p>

                            </div>

                        </div>

                    </div>";









        $admin_subject = 'Client Referral';

        $to_subject = $from_name." Referred You To us (www.mkennys.com/)";

        $from_subject = "Thanks for your referral";





       $from = 'info@mkennys.com';

       //$from = 'amanjot@trsoftwaregroup.com';



	    //$from = "karanjeettr@gmail.com";



		$headers = 'MIME-Version: 1.0' . "\r\n";

        $headers .= 'Bcc:info@mkennys.com' . "\r\n";

       // $headers .= 'Bcc:krish@trsoftwaregroup.com' . "\r\n";



        // $headers .= 'Bcc:singhkaranjeet92@gmail.com,karanjeettr@gmail.com' . "\r\n";

        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        $headers .= "From: True Fitted by M Kennys " .$from. "\r\n" .

        "X-Mailer: PHP/" . phpversion();

        $mail=mail($to_email,$to_subject,$to_message,$headers);

        $mail=mail($from_email,$from_subject,$from_message,$headers);





        $admin_headers = 'MIME-Version: 1.0' . "\r\n";

        $admin_headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

		//$admin_headers .= 'Bcc:sanjeevtrgroup@outlook.com' . "\r\n";

        $admin_headers .= "From: True Fitted by M Kennys " .$from. "\r\n" .

        "X-Mailer: PHP/" . phpversion();

        $mail=mail($from,$admin_subject,$admin_message,$admin_headers);

        return;

    }





?>



<script>



 jQuery(document).ready(function() {

        jQuery(".viewDetail").click(function () {

             jQuery('#referFriend').css('display','block');

             jQuery('body').addClass('bodyFixed');

        });

        jQuery(".FCclosePopup").click(function () {

            jQuery('#referFriend').css('display','none');

            jQuery('body').removeClass('bodyFixed');

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
		var ajaxCallData = settings.data;
        if(ajaxCallData.indexOf){
            if(ajaxCallData.indexOf('wysija_ajax') != -1){
    
                function URLToArray(url) {
                    var request = {};
                    var pairs = url.substring(url.indexOf('?') + 1).split('&');
                    for (var i = 0; i < pairs.length; i++) {
                        if(!pairs[i]){
                            continue;
                        }
                        var pair = pairs[i].split('=');
                        request[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
                    }
                    return request;
                }
    
                ajaxCallData = URLToArray( ajaxCallData );
                var stay_form_name = ajaxCallData['data[0][value]'];
                var stay_form_email = ajaxCallData['data[2][value]'];
                var stay_form_state = ajaxCallData['data[4][value]'];
                stayAdminEmail(stay_form_name,stay_form_email,stay_form_state);
                jQuery('.firstComePopup').hide();
                jQuery('.customPopOverlay').show();
    
                jQuery('.wysija-msg .allmsgs .updated').append('<div class="stay_informed_close_btn" style="font-size:15px;position:absolute;top:5px;right:12px;cursor:pointer;">X</div>');
            }else if(ajaxCallData.indexOf('_wpcf7') != -1){
                var message = JSON.parse(xhr.responseText);
                message = message.message;
                jQuery('.contactCustomPopOverlay').show();
                jQuery('.contactCustomPopOverlay').find('p').html(message);
            }
        }
	});

    jQuery(document).on('click','.wysija-submit',function(){
        jQuery(".wysija-msg").show();
    });

    jQuery(document).on('click','.stay_informed_close_btn',function(){
        jQuery(".wysija-msg").fadeOut();
    });

    jQuery(document).on('click','.close_wysija',function(){

        jQuery('.wysija-input,.wysija-select').val('');

    });



	jQuery(".home_begning").click(function(e){

		 jQuery('.commonSection').removeClass('selected');

		 jQuery(nextSection).addClass('selected');

		 var nextSection = $(this).parents('.commonSection:first').next('.commonSection');

		 var top  = jQuery(nextSection).offset().top



		jQuery('body,html').animate({ scrollTop:  top});



	});



	function stayAdminEmail(stay_form_name,stay_form_email,stay_form_state){

		var getUrl = window.location;

		var path = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/mkennys/";

		jQuery.ajax({

				type:'POST',

				url:path+'stayform_admin.php',

				data:'name='+stay_form_name+'&email='+stay_form_email+'&state='+stay_form_state,

			    success:function(html){

				}

		});



		return;

	}







})

</script>





<div class="contactCustomPopOverlay">

    <div class="CPO_inner">

        <p></p>

        <button class="CPO_close">Close</button>

    </div>

</div>



<?php wp_footer(); ?>
