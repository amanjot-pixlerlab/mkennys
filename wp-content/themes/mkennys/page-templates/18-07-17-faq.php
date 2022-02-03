<?php
/**
 * Template Name: Faqs 
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/validationEngine.jquery.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validationEngine-en.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validationEngine.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
            jQuery("#faq_form").validationEngine();
        });
</script>

<?php 
global $wpdb;
if(isset($_POST['faq_submit'])){

    $value = array(
      'to_email' => $_POST['to_email'],
      'to_phone' => $_POST['to_phone'],
      'from_email' => $_POST['from_email'],
      'amount' => $_POST['amount'],
      'message' => $_POST['message'],
      'status' => 'void',
    );

    //echo "<pre>";print_r($value);die;

    $table_name = $wpdb->prefix . 'giftcard';
	$wpdb->insert($table_name, $value, '%s');
 	faqMail($value['from_email'],$value['to_email'],$value['amount']);
 	?><script> alert('Gift Certificate Generated Successfully') </script>  
	<?php 
}

function faqMail($from_email,$to_email,$amount){
		

		$to = $from_email;
		$subject = "Gift Certificate Request (MKennys.com)";
		
		$url = home_url();
		$message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";
		$message .="<div  style='background: #eaeced;'>
						<div  style='width:700px; margin:0px auto; background: #fff;'>
							
					    	<div style='text-align: center; padding: 20px; background: #fff;'>
					        	<a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a> 
					        </div>
					        <div><img src='".$url."/newsletter-images/gift-card-banner.jpg'></div>
					        <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>
					        	<p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Hey,</p>
					            <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>We received the certificate request and to check all the info in the summary below.Your gift certificate will be mailed to the recipient shortly </p>
									
								<p>
								<b style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Amount</b>
								<br>
								<span style='font-size: 30px; font-family:Arial, Helvetica, sans-serif; color: #555;'>$ ".$amount." </span>
								</p>

								<p>
								<b style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Sender</b>
								<br>
								<span style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'><a style='color:#2979ff;' href='mailto:".$to_email."'>".$to_email."</span>
								</p>

								<hr>
								<p>
									<b style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Thanks</b>
								<br>
									<span style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Mkenny's</span>

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

		$from = 'info@mkennys.com';
		$headers = 'MIME-Version: 1.0' . "\r\n";
		//$headers .= 'Bcc:info@mkennys.com,Kenny@mkennys.com' . "\r\n";
		 $headers .= 'Bcc:singhkaranjeet92@gmail.com,karanjeettr@gmail.com' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: " .$from. "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		$mail=mail($to,$subject,$message,$headers);
		return;
				
	}


?>


<div class="contentPage">
    <div class="container">
    	<h1><?php the_title(); ?></h1>
        <div class="faq_sidebar">
			<ul>
				<?php 	
					$args = array( 'post_type' => 'faq','order' => 'ASC');
					$loop = new WP_Query( $args );
					$posts = $loop->posts;
					$first = 'class="active"';
					
					foreach($posts as $post) {   $categories = get_the_category(); ?>
					<li>                    	
						<a <?php echo $first; ?> href="#faq_<?php echo the_Id(); ?>"><?php echo $categories[0]->name; ?></a>
                        <?php if($first){ $first =  ''; } ?>
					</li>
				<?php  } ?>
			</ul>
		</div>
		<div class="faq_content">
			<?php 	
			$args = array( 'post_type' => 'faq','order' => 'ASC');
			$loop = new WP_Query( $args );
			$posts = $loop->posts;
			$first = 'active';
			
			foreach($posts as $post) { ?>
				<?php //$categories = get_the_category(); ?>
				<?php //echo "<pre>";print_r( $post->ID); ?>


				<div id="faq_<?php echo the_Id(); ?>" class="faq_content_main <?php echo $first ?>">

				<?php 
				$val = $post->ID;
				if( $val == 141){ ?>
					<div class="gift_container">
						<h3>Gift Certificate</h3>
						<span>This gift certificate is valid only at M. Kenny’s Fashions. It may be redeemed by phone or in person. It is NOT redeemable for cash. Any unused balance will be stored as credit for future purchases to the recipient’s account.</span>
						<form method="POST" id="faq_form" action="">
	                            
	                            <div class="input_content"> 
	                                <input type="text" class="validate[required,custom[email]]" placeholder="To Email" name="to_email">
	                            </div>
	                            <div class="input_content"> 
	                                <input type="text" placeholder="Phone" maxlength="10" class="validate[required,custom[number]]" name="to_phone">
	                            </div>
	                            <div class="input_content"> 
	                                <input type="text" class="validate[required,custom[email]]" placeholder="From Email" name="from_email">
	                            </div>
	                            <div class="input_content"> 
	                                <input type="text" placeholder="Amount" class="validate[required,custom[number]]" name="amount">
	                            </div>
	                            <div class="input_content"> 
	                                <textarea placeholder="Message" class="" name="message"></textarea> 
	                            </div>
							<div class="input_content submit">
	                        	<input type="submit" value="Submit" name="faq_submit">
	                        </div>
	                    </form>
					</div>
				<?php }else { ?>
	                <?php if($first){ $first =  ''; } ?>
					<h2><?php echo $post->post_title; ?></h2>
					<?php echo $post->post_content; ?>
				<?php } ?>
				</div>
			<?php } ?>
		</div>
    </div>
</div>


<script>

	jQuery(document).ready(function(){ 
			var value = window.location.hash;
			if(value == '#faq_118'){
				jQuery('.faq_sidebar a').removeClass('active');
				jQuery('.faq_content .faq_content_main').removeClass('active')
				jQuery('.faq_sidebar a').each(function(){
					
					if( jQuery(this).html() == 'Shipping &amp; Delivery')
					{
						jQuery('#faq_118').addClass('active');
						jQuery(this).addClass('active');
					}
					
				});
			}
			else if(value == '#faq_141'){
				jQuery('.faq_sidebar a').removeClass('active');
				jQuery('.faq_content .faq_content_main').removeClass('active')
				jQuery('.faq_sidebar a').each(function(){
					
					if( jQuery(this).html() == 'Gift Certificates')
					{
						jQuery('#faq_141').addClass('active');
						jQuery(this).addClass('active');
					}
					
				});

			}
			
	});

	jQuery('.faq_sidebar a').click(function(e){ 
		e.preventDefault();
		jQuery('.faq_sidebar a').removeClass('active');
		jQuery(this).addClass('active');
		
		var myAttr = jQuery(this).attr('href');
		console.log(myAttr);
		jQuery('.faq_content .faq_content_main').removeClass('active')
	jQuery(myAttr).addClass('active');	
	})
		
	
</script>
<?php
	get_footer(); 
?>