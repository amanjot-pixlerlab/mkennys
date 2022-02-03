<?php 
/*echo $_GET['location']."<br>";
echo $_GET['city']."<br>";
echo $_GET['state']."<br>";*/
/*

$data = $wpdb->get_results("SELECT email FROM $table_name Where location = '".$_GET['movie']."' ",ARRAY_A);

$mension = array_map('current', $data);



$headers = array('Content-Type: text/html; charset=UTF-8','From: My Site Name <krish@trsaoftwaregroup.com');
$subj = 'The email subject';
$body = 'This is the body of the email';
wp_mail( $mension, $subj, $body );
*/
global $wpdb;
$table_name = $wpdb->prefix . 'notify';
if(isset($_POST['submit'])){
	
	$data = $wpdb->get_results("SELECT email FROM $table_name Where location = '".$_GET['location']."' ",ARRAY_A);
	$emial_list = array_map('current', $data);
	notify_mail($emial_list,$_POST['message']);
}


function notify_mail($list,$body){
	
	$url = home_url();
	$subject = "Mkennys Tour Schdule Update";
	$message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";
	$message .="<div  style='background: #eaeced;'>
						<div  style='width:700px; margin:0px auto; background: #fff;'>
							
					    	<div style='text-align: center; padding: 20px; background: #fff;'>
					        	<a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a> 
					        </div>
					        <div><img src='".$url."/newsletter-images/image.jpg'></div>
					        <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>
					        	<p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Dear Customer,</p>
					            <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>".$body."</p>
									
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


			
		$from = 'info@mkennys.com';
		//$from = 'karanjeettr@gmail.com';
		$headers = array('Content-Type: text/html; charset=UTF-8',"From: True Fitted by M Kennys <info@mkennys.com");
		

		wp_mail( $list, $subject, $message, $headers );
		my_update_notice();
	
}

function my_update_notice() {

	?>
	<?php
	$url = admin_url( 'admin.php?page=notify-admin-list-page.php', 'http' );    
	 wp_redirect( $url );
    ?>
    <div class="updated notice">
        <p><?php _e( 'Notification Sent', 'my_plugin_textdomain' ); ?></p>
    </div>
    <?php
   
}


?>

<div class="wrap">
	<h1>Notification Mail</h1>
	<form method="post" action=" " class="enityValidation" id="Addmail">
		<div id="poststuff">
			<div id="post-body" class="postbox metabox-holder columns-2">
				<div class="inside">
					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row"><label for="promocode">Location</label></th>
								<td>
									<span><?php echo $_GET['location']; ?></span>
									
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="email">City</label></th>
								<td>
									<span><?php echo $_GET['city']; ?></span>
									
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="state">State</label></th>
								<td>
									<span><?php echo $_GET['state']; ?></span>
									
								</td>
							</tr>
							<tr>
								<th scope="row"><label for="state">Message</label></th>
								<td>
									<textarea placeholder="Message" rows="8" cols="60" id="message" name="message"></textarea>
								</td>
							</tr>
							<tr>
								<th colspan="2" scope="row"><label for="state">Note: Please write e-mail body content only(without image) and rest of the part will include automatically</label></th>
								<td>
									
								</td>
							</tr>
							
							
						</tbody>
					</table>
					<p class="submit"><input name="submit" id="submit" class="button button-primary" value="Send Notification" type="submit"></p>
				</div>
			</div>
		</div>
	</form>
</div>