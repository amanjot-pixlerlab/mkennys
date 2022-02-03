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
	
	$gift_date =  date("Y-m-d");

    $value = array(
      'to_name' => $_POST['to_name'],
      'to_email' => $_POST['to_email'],
      'to_phone' => $_POST['to_phone'],
      'from_name' => $_POST['from_name'],
      'from_email' => $_POST['from_email'],
      'amount' => $_POST['amount'],
      'message' => $_POST['message'],
      'status' => 'void', 
	  'gift_date'=>$gift_date,	
    );

   // echo "<pre>";print_r($value);die;

    $table_name = $wpdb->prefix .'giftcard';
	$wpdb->insert($table_name, $value, '%s');
 	faqMail($value);
 	?><script> 
 	/*alert('Gift Certificate Generated Successfully') */
	jQuery(document).ready(function(){

		jQuery("#gift_alert").css('display','inline-block');

		jQuery('.gift_alertClose').click(function(){
			jQuery('.GiftAvailability').hide();
		});

	 });
 	</script>  
	<?php 
}

function faqMail($value){
		

		$to = $value['from_email'];
		$subject = "Gift Certificate Request for ".$value['to_name'];
		
		$url = home_url();


		$gift_from_message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";
		$gift_from_message .="<div  style='background: #eaeced;'>
						<div  style='width:700px; margin:0px auto; background: #fff;'>
							
					    	<div style='text-align: center; padding: 20px; background: #fff;'>
					        	<a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a> 
					        </div>
					        <div><img src='".$url."/newsletter-images/gift-card-banner.jpg'></div>
					        <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>
					        	<p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Dear ".$value['from_name'].",</p>
					            <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>An associate will reach out to you to approve and issue your gift certificate. Meanwhile, please review the details below are accurate, if anything appears incorrect please e-mail us back or call us at <a href='tel:(714) 573-2199'>(714) 573-2199</a> during business hours.</p>
								<table>
								    <tbody>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>To</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['to_name']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Email</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['to_email']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Phone</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['to_phone']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>From</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['from_name']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>From Email</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['from_email']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Amount</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>$".$value['amount']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;vertical-align: top;'>Message</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['message']."</td>
								        </tr>
								    </tbody>
								</table>
								<hr>
								<p>
                                                Thanks,
                                            <br>
                                            
                                                <span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #222;'>True Fitted by M Kenny's </span>
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

		$gift_admin_message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";
		$gift_admin_message .="<div  style='background: #eaeced;'>
						<div  style='width:700px; margin:0px auto; background: #fff;'>
							
					    	<div style='text-align: center; padding: 20px; background: #fff;'>
					        	<a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a> 
					        </div>
					        <div><img src='".$url."/newsletter-images/gift-card-banner.jpg'></div>
					        <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>
					        	
								<table>
								    <tbody>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>To</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['to_name']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Email</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['to_email']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Phone</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['to_phone']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>From</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['from_name']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>From Email</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['from_email']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>Amount</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>$".$value['amount']."</td>
								        </tr>
								        <tr>
								            <td style='width: 120px;font-weight: 600;color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;vertical-align: top;'>Message</td>
								            <td style='color: #555;font-family: Arial,Helvetica,sans-serif;padding: 10px 0;'>".$value['message']."</td>
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
					        	<p style='font-size: 16px; text-align: center; font-family:Arial, Helvetica, sans-serif; color: #555;'><a href='http://www.mkennys.com'>www.mkennys.com</a></p>
					        </div>
					    </div>
					</div>";

		$admin_subject = "Gift Certificate Request"	;				
		$from = 'info@mkennys.com';
		 //$from = "karanjeettr@gmail.com";
			
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Bcc:info@mkennys.com' . "\r\n";
		//$headers .= 'Bcc:singhkaranjeet92@gmail.com,karanjeettr@gmail.com' . "\r\n";
		//$headers .= 'Bcc:krish@trsoftwaregroup.com' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= "From:  True Fitted by M Kennys <" .$from. "> \r\n" .
		"X-Mailer: PHP/" . phpversion();
		$mail=mail($to,$subject,$gift_from_message,$headers);
		
		$admin_headers = 'MIME-Version: 1.0' . "\r\n";
        $admin_headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		//$admin_headers .= 'Bcc:info@mkennys.com' . "\r\n";
        $admin_headers .= "From: True Fitted by M Kennys " .$from. "\r\n" .
        "X-Mailer: PHP/" . phpversion();


		$mail_admin=mail($from,$admin_subject,$gift_admin_message,$admin_headers);		


		return;
				
	}


?>

<div id="gift_alert" class="calenderOverlay GiftAvailability" style="display:none;">
	<div class="calenderInner">
		<p>Thanks for submitting your gift certificate request. Our team will validate your certificate and send you an e-mail confirmation.</p>
		<a href="javascript:;" class="gift_alertClose">Close</a>
	</div>
</div>



<div class="contentPage">
	<div class="container">
		<div style="" class="search-header clearfix">
			<h1><?php the_title(); ?></h1>
			<div class="header-search">
				<input id="edValue" type="text"  onKeyUp="edValueKeyPress()" placeholder="Search FAQ">
				<ul id="lblValue"></ul>
			</div>
		</div>

    	
        <div class="faq_sidebar">
			<ul>
				<?php 	
					$args = array( 'post_type' => 'faq','order' => 'ASC');
					$loop = new WP_Query( $args );
					$posts = $loop->posts;
					$first = 'class="active faq_112"';
					
					foreach($posts as $post) {   $categories = get_the_category(); ?>
					<li>                    	
						<a <?php echo $first; ?> class="faq_<?php echo the_Id(); ?>"  href="#faq_<?php echo the_Id(); ?>"><?php echo $categories[0]->name; ?></a>
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
				


				<div id="faq_<?php echo the_Id(); ?>" class="faq_content_main <?php echo $first ?>">

				<?php 
				$val = $post->ID;
				if( $val == 141){ ?>
					<div class="gift_container">
						<h2>Gift Certificate</h2>
						<span>This gift certificate is valid only at M. Kenny’s Fashions. It may be redeemed by phone or in person. It is NOT redeemable for cash. Any unused balance will be stored as credit for future purchases to the recipient’s account.</span>
						<form method="POST" id="faq_form" action="">
	                            
	                            <div class="input_content"> 
	                                <input type="text" class="validate[required]" placeholder="To" name="to_name">
	                            </div>
	                            <div class="input_content"> 
	                                <input type="text" class="validate[required,custom[email]]" placeholder="To Email" name="to_email">
	                            </div>
	                             <div class="input_content"> 
	                                <input type="text" placeholder="Phone" maxlength="10" class="validate[required,custom[number]]" name="to_phone">
	                            </div>
	                            <div class="input_content"> 
	                                <input type="text" class="validate[required]" placeholder="From" name="from_name">
	                            </div>
	                           
	                            <div class="input_content"> 
	                                <input type="text" class="validate[required,custom[email]]" placeholder="From Email" name="from_email">
	                            </div>

	                            <div class="input_content"> 

	                             <select class="validate[required]" name="amount" id="giftAmount">
	                             	<option value="" disabled selected>Amount</option>
	                             	<option value="25">$25</option>
	                             	<option value="50">$50</option>
	                             	<option value="75">$75</option>
	                             	<option value="100">$100</option>
	                             	<option value="125">$125</option>
	                             	<option value="150">$150</option>
	                             	<option value="175">$175</option>
	                             	<option value="200">$200</option>
	                             	<option value="225">$225</option>
	                             	<option value="250">$250</option>
	                             	<option value="275">$275</option>
	                             	<option value="300">$300</option>
	                             	<option value="325">$325</option>
	                             	<option value="350">$350</option>
	                             	<option value="375">$375</option>
	                             	<option value="400">$400</option>
	                             	<option value="425">$425</option>
	                             	<option value="450">$450</option>
	                             	<option value="475">$475</option>
	                             	<option value="500">$500</option>
	                             	<option value="1">Or Enter Amount</option>	                             	
	                             </select>
	                           
	                            </div>
	                             <div class="input_content" id="giftCustomAmount" style="display: none;"> 
	                                <input placeholder="Enter Amount" class="" name="amount">
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
<script type="text/javascript">

	jQuery('#giftAmount').change(function(){
 	
 	if(jQuery(this).val()==1)
 	{
 		jQuery('#giftCustomAmount').show();
 		jQuery('#giftCustomAmount input').show().removeProp('disabled').addClass('validate[number]');
 	}
 	else
 	{
 		jQuery('#giftCustomAmount').hide();
 		jQuery('#giftCustomAmount input').hide().prop('disabled',true).removeClass('validate[number]');
 	}
 });
/*	
	  function edValueKeyPress2()
	    {
	        var edValue = document.getElementById("edValue");
	        var s = (edValue.value+"").toLowerCase();

	        if( s.length < 3 ) return;
	        var n=[];


			var newHTML = [];						

			$(".faq_content_main h3:contains("+s+")").each(function(index){

				newHTML = 	$(this).parent('.faq_content_main').attr('id');
				n.push('<li class="search_id" data-content="'+newHTML+'" >' + $(this).html() + '</li>');

			});

			$("#lblValue").html(n.join(""));

	    }*/

	   	function edValueKeyPress()
	    {
	        var edValue = document.getElementById("edValue");
	        var s = (edValue.value+"").toLowerCase();

	        if( s.length < 2 ){
	        	$("#lblValue").empty();
	        	return;
	        }
	        var n=[];


			var newHTML = [];						

			$(".faq_content_main h3").each(function(index){
				if( $(this).text().toLowerCase().includes(s) ){
					newHTML = 	$(this).parent('.faq_content_main').attr('id');
					n.push('<li class="search_id" data-content="'+newHTML+'" >' + $(this).html() + '</li>');
				}
			});

			$("#lblValue").html(n.join(""));

	    }


		$(document).on('click', ".search_id", function() { 
			var myAttr = $(this).attr('data-content');

			var myVal = $(this).text();
		  
		  $('.faq_sidebar a').removeClass('active');
		  $('.faq_content .faq_content_main').removeClass('active')
		  $("#lblValue").html('');
		  $("#edValue").val('');
		  $('#'+myAttr).addClass('active');
		  $('.'+myAttr).addClass('active');
		  

		  $(window).scrollTop($("#"+myAttr+" h3:contains('"+myVal+"')").offset().top - 50);
		  
		})
		

	

</script>

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

			else if(value == '#faq_118'){
				jQuery('.faq_sidebar a').removeClass('active');
				jQuery('.faq_content .faq_content_main').removeClass('active')
				jQuery('.faq_sidebar a').each(function(){
					
					if( jQuery(this).html() == 'Shipping & Delivery')
					{
						jQuery('#faq_118').addClass('active');
						jQuery(this).addClass('active');
					}
					
				});

			}
			else if(value == '#faq_117'){
				jQuery('.faq_sidebar a').removeClass('active');
				jQuery('.faq_content .faq_content_main').removeClass('active')
				jQuery('.faq_sidebar a').each(function(){
					
					if( jQuery(this).html() == 'Alterations')
					{
						jQuery('#faq_117').addClass('active');
						jQuery(this).addClass('active');
					}
					
				});

			}
			else if(value == '#faq_120'){
				jQuery('.faq_sidebar a').removeClass('active');
				jQuery('.faq_content .faq_content_main').removeClass('active')
				jQuery('.faq_sidebar a').each(function(){
					
					if( jQuery(this).html() == 'Pricing')
					{
						jQuery('#faq_120').addClass('active');
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