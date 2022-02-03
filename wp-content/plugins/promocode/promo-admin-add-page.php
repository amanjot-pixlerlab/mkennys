<link rel="stylesheet" href="<?php echo site_url() ?>/wp-content/plugins/promocode/css/validationEngine.jquery.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo site_url() ?>/wp-content/plugins/promocode/js/jquery-1.11.0.js"></script>
<script src="<?php echo site_url() ?>/wp-content/plugins/promocode/js/jquery.validationEngine-en.js"></script>
<script src="<?php echo site_url() ?>/wp-content/plugins/promocode/js/jquery.validationEngine.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
			jQuery("#Addpromo").validationEngine();
		});
</script>
<?php
function changeDateFormat($date)
{
    if(!empty($date))
    {
       $date = date('d-m-Y',strtotime($date));
    }
   return $date;
}


function my_error_notice() {
	
	 wp_redirect( $_SERVER['HTTP_REFERER'] );

    ?>
    <div class="error notice">
        <p><?php _e( 'This user already referred. Please use different email'); ?></p>
    </div>
    <?php
}
function my_update_notice() {
	 wp_redirect( $_SERVER['HTTP_REFERER'] );
    ?>
    <div class="updated notice">
        <p><?php _e( 'Promo Code Created', 'my_plugin_textdomain' ); ?></p>
    </div>
    <?php
   
}
if(isset($_POST['submit'])){
	$data = array(
	  'code' => $_POST['code'],
	  'email' => $_POST['email'],
	  'start_date' => $_POST['start_date'],
	  'end_date' => $_POST['end_date'],
	  'status' => $_POST['status'],
	  'discount' => $_POST['discount'],
	);
	global $wpdb;
	$table_name = $wpdb->prefix . 'promo';
	$result = $wpdb->get_results("SELECT email FROM $table_name WHERE email = '".$data['email']."' ",ARRAY_A);
	if(count($result) == 0){
		$wpdb->insert($table_name, $data, '%s');
		if( $data['status'] == 'Active' ){
			promoMail($data['email'],$data['code']);
		}
		my_update_notice();
		
	}
	else{
		 
		my_error_notice();
	}
}


function promoMail($email,$code){
		
	


		$to = $email;
		$subject = "Promo Code Confirmation (MKennys.com)";
		
		$url = home_url();
		$message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";
		$message .="<div  style='background: #eaeced;'>
						<div  style='width:700px; margin:0px auto; background: #fff;'>
							
					    	<div style='text-align: center; padding: 20px; background: #fff;'>
					        	<a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a> 
					        </div>
					        <div><img src='".$url."/newsletter-images/image.jpg'></div>
					        <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>
					        	<p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Hey,</p>
					            <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>Congratulations, Your personalized promo code ".$code." is now activated. You will get free shirt on your next purchase..</p>
									
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
					        	
					            <p style='font-size: 13px; text-align: center; font-family:Arial, Helvetica, sans-serif; color: #555;'>&copy; Copyright 2017, Mkennys</p>
					        </div>
					    </div>
					</div>";


		

		$from = 'info@mkennys.com';
		//$from = 'karanjeettr@gmail.com';
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Bcc:info@mkennys.com' . "\r\n";
        //$headers .= 'Bcc:singhkaranjeet92@gmail.com,karanjeettr@gmail.com' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: True Fitted by M Kennys " .$from. "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		$mail=mail($to,$subject,$message,$headers);
		return;
				
	}



?>

<script type="text/javascript">
jQuery(document).ready(function() {

	var promo = 'Mk'+Math.random().toString(36).substring(7);
	  jQuery("#promocode").val(promo);

});
	
//alert('Mk'+Math.random().toString(36).substring(7));

</script>

<div class="wrap">
	<h1>Add New Promo Code</h1>
	<form method="post" action=" " class="enityValidation" id="Addpromo">
		<div id="poststuff">
			<div id="post-body" class="postbox metabox-holder columns-2">
				<div class="inside">
					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row"><label for="promocode">Promo Code</label></th>
								<td>
									<input name="code" placeholder="Enter Code" id="promocode" class="mb-text-input mb-field validate[required]" type="text">
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="email">Assign To</label></th>
								<td>
									<input name="email" id="email" placeholder="Enter Email" class="mb-text-input mb-field validate[required,custom[email]]" type="text">
								</td>
							</tr>
							<!-- <tr>
								<th scope="row"><label for="discount">Discount in %</label></th>
								<td> -->
									<input name="discount" value="100" id="discount" placeholder="Enter Percentage" class="mb-text-input mb-field" type="hidden">
							<!-- 	</td>
							</tr> -->
							<tr>
								<th scope="row"><label for="startdate">Start From</label></th>
								<td>
									<input name="start_date" id="startdate" class="mb-text-input mb-field datepicker validate[required]" type="text">
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="enddate">End To</label></th>
								<td>
									<input name="end_date" id="enddate" class="mb-text-input mb-field datepicker validate[required]" type="text">
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="status">Active</label></th>
								<td>
									<select name="status">
										<option value="" disabled selected>Status</option>
										<option  value="Deactive">Deactive</option>
										<option value="Active">Active</option>
									</select>
								
								</td>
							</tr>
							
						</tbody>
					</table>
					<p class="submit"><input name="submit" id="submit" class="button button-primary" value="Save Code" type="submit"></p>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script type="text/javascript">



jQuery(function() {

   
    var datepickersOpt = {
        dateFormat: 'dd-mm-yy',
        minDate   : 0
    }

    jQuery("#startdate").datepicker(jQuery.extend({
        onSelect: function() {
            var minDate = jQuery(this).datepicker('getDate');
            minDate.setDate(minDate.getDate()+1); //add two days
            jQuery("#enddate").datepicker( "option", "minDate", minDate);
        }
    },datepickersOpt));

    jQuery("#enddate").datepicker(jQuery.extend({
        onSelect: function() {
            var maxDate = jQuery(this).datepicker('getDate');
            maxDate.setDate(maxDate.getDate()-1);
           jQuery("#startdate").datepicker( "option", "maxDate", maxDate);
        }
    },datepickersOpt));
}); 





</script>