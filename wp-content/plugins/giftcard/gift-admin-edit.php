<link rel="stylesheet" href="<?php echo site_url() ?>/wp-content/plugins/promocode/css/validationEngine.jquery.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo site_url() ?>/wp-content/plugins/promocode/js/jquery-1.11.0.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validationEngine-en.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validationEngine.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function(){
			jQuery("#Addpromo").validationEngine();
		});
</script>
<?php 


global $wpdb;
$table_name = $wpdb->prefix . 'giftcard';
$id = $_REQUEST['movie'];

if(isset($_POST['submit'])){
	
	$raw_data = $wpdb->get_results("SELECT * FROM $table_name WHERE id = $id",ARRAY_A);

	if($_POST['status']!='approve')
	{
		$_POST['manual_approval_code'] = "";
	}

	$data = array(
	  'id' => $raw_data[0]['id'],
	  'to_name' => $_POST['to_name'],
	  'to_email' => $_POST['to_email'],
	  'to_phone' => $_POST['to_phone'],
	  'from_email' => $_POST['from_email'],
	  'from_name' => $_POST['from_name'],
	  'amount' => $_POST['amount'],
	  'manual_approval_code' => $_POST['manual_approval_code'],
	  'message' => $_POST['message'],
	  'status' => $_POST['status'],
	  'gift_date' => $_POST['gift_date'],
	  
	);
	
	$wpdb->update($table_name, $data, array('id'=>$raw_data[0]['id']));

	if( $data['status'] == 'approve' ){
		promoMail($data);
	}
	my_update_notice();
}

function promoMail($data){
		

		$to = $data['to_email'];
		$subject = "Gift Certificate From ".$data['from_name'];
		
		$url = home_url();
		$message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";

		$manual_approval_text = "";
		if($data['status']=='approve')
		{
			$manual_approval_text = "<p  style='margin-top:6px; margin-bottom:6px; margin-left:0px; margin-right:0px; font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'><strong>Approval Code: </strong>".$data['manual_approval_code']."</p>";
		}

		$message .="<div  style='background: #eaeced;'>
						<div  style='width:700px; margin:0px auto; background: #fff;'>
							
					    	<div style='text-align: center; padding: 20px; background: #fff;'>
					        	<a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a> 
					        </div>
					        <div><img src='".$url."/newsletter-images/gift-card-banner.jpg'></div>
					        <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>
					        	<p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Dear ".$data['to_name'].",</p>
					            <p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Your friend ".$data['from_name']." wanted you to have a gift certificate worth of  $" .$data['amount']. " applicable towards a purchase of personalized custom clothing. Please print this form and bring it with you to your next custom fitting appointment.</p>
					            <p  style=' margin-top:10px; margin-bottom:6px; margin-left:0px; margin-right:0px; font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'><strong>To: </strong>".$data['to_name']."</p>
					            <p  style='margin-top:6px; margin-bottom:6px; margin-left:0px; margin-right:0px; font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'><strong>From: </strong>".$data['from_name']."</p>
					            <p  style='margin-top:6px; margin-bottom:6px; margin-left:0px; margin-right:0px; font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'><strong>Amount: </strong> $".$data['amount']."</p>
					            ".$manual_approval_text."


					            <p  style='margin-top:6px; margin-bottom:10px; margin-left:0px; margin-right:0px; font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'><strong>Message: </strong>".$data['message']."</p>
								

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
											
											<p  style='margin-top:15px; margin-bottom:15px; margin-left:0px; margin-right:0px; font-size: 13px; line-height:1; font-family:Arial, Helvetica, sans-serif; color: #555;'><strong>Disclaimer:</strong> This gift certificate is only valid at <span style='font-weight:bold'>True Fitted by M. Kenny's</span>. It may be redeemed by phone or in-person during a custom fitting. It is NOT redeemable for cash. Any unused balance will be kept on file towards a future purchase with us. </p>
											
					        </div>
					        <div style='padding: 30px; background: #f7f7f7; text-align:center'>
					        	<p style='font-size: 16px; text-align: center; font-family:Arial, Helvetica, sans-serif; color: #555;'><a href='http://www.mkennys.com'>www.mkennys.com</a></p>
					        </div>
					    </div>
					</div>";

		




		 $from = 'info@mkennys.com';
		 //$from = 'karanjeettr@gmail.com';
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'cc: '.$data['from_email'].' ' . "\r\n";
		//$headers .= 'Bcc:info@mkennys.com' . "\r\n";
		 //$headers .= 'Bcc:singhkaranjeet92@gmail.com,karanjeettr@gmail.com' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= "From: True Fitted by M. Kenny's " .$from. "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		$mail=mail($to,$subject,$message,$headers);
		return;
				
	}


function my_update_notice() {
	 wp_redirect( $_SERVER['HTTP_REFERER'] );
    ?>
    <div class="updated notice">
        <p><?php _e( 'Gift Card Update', 'my_plugin_textdomain' ); ?></p>
    </div>
    <?php
   
}
$result = $wpdb->get_results("SELECT * FROM $table_name WHERE id = $id",ARRAY_A);



?>

<div class="wrap">
	<h1>Edit Gift Card</h1>
	<form method="post" action=" " class="enityValidation" id="Addpromo">
		<div id="poststuff">
			<div id="post-body" class="postbox metabox-holder columns-2">
				<div class="inside">
					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row"><label for="to_name">To</label></th>
								<td>
									<input name="to_name" value= "<?php echo $result[0]['to_name']; ?>" placeholder="Enter Name"  class="mb-text-input mb-field validate[required]" type="text">
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="to_email">Email</label></th>
								<td>
									<input name="to_email" value="<?php echo $result[0]['to_email']; ?>" placeholder="Enter Email" id="" class="mb-text-input mb-field validate[required,custom[email]]" type="text">
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="to_phone">Phone</label></th>
								<td>
									<input name="to_phone" id="to_phone" value="<?php echo $result[0]['to_phone']; ?>" placeholder="Enter Phone" class="mb-text-input mb-field  validate[required,custom[number]]" type="text">
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="from_name">From</label></th>
								<td>
									<input name="from_name" id="from_name" value="<?php echo $result[0]['from_name']; ?>" placeholder="Enter From Name" class="mb-text-input mb-field validate[required]" type="text">
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="from_email">Email</label></th>
								<td>
									<input name="from_email" id="from_email" value="<?php echo $result[0]['from_email']; ?>" placeholder="Enter From Email" class="mb-text-input mb-field validate[required,custom[email]]" type="text">
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="amount">Amount in $</label></th>
								<td>
									<input name="amount" id="amount" value="<?php echo $result[0]['amount']; ?>" class="mb-text-input mb-field datepicker validate[required,custom[number]]" type="text">
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="message">Message</label></th>
								<td>
									<textarea placeholder="Message" id="message"  name="message"><?php echo $result[0]['message']; ?></textarea> 
									
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="status">Status</label></th>
								<td>
									<select name="status" id="gift_status">
										<option  value="approve" <?php if($result[0]['status'] == 'approve' ){ echo "selected='selected'"; } ?> >Approve</option>
										<option value="void" <?php if($result[0]['status'] == 'void' ){ echo "selected='selected'"; } ?>  >Void</option>
										<option value="cancel" <?php if($result[0]['status'] == 'cancel' ){ echo "selected='selected'"; } ?>  >Cancel</option>
									</select>

									<input <?php if($result[0]['status'] != 'approve') { echo "style=display:none;"; } else { echo "class='validate[required]';"; } ?> type="text" value="<?php echo $result[0]['manual_approval_code']; ?>" name="manual_approval_code" id="manual_approval_code" placeholder="Approval Code">
								
								</td>
							</tr>

							<tr>
								<th scope="row"><label for="amount">Gift Date</label></th>
								<td>
									<input name="gift_date" id="gift_date" value="<?php echo $result[0]['gift_date']; ?>" class="mb-text-input mb-field datepicker validate[required]" type="text">
								</td>
							</tr>
							
						</tbody>
					</table>
					<p class="submit"><input name="submit" id="submit" class="button button-primary" value="Update Status" type="submit"></p>
				</div>
			</div>
		</div>
	</form>
</div>
<style type="text/css">
	#manual_approval_code {
	    padding: 3px 5px;
	    position: relative;
	    top: 3px;
	}
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#gift_status').change(function(){
			if(jQuery(this).val() == 'approve')
			{
				jQuery('#manual_approval_code').show().addClass('validate[required]');

			}
			else
			{
				jQuery('#manual_approval_code').hide().removeClass('validate[required]').prev('.formError').remove();

			}
		});
	});
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
