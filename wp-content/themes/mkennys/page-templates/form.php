<?php
/**
 * Template Name: form 
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fourteen 1.0
 */

include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
?>
<?php
 global $wpdb;

if(isset($_POST['submit'])){
    $data = array(
      'from_name' => $_POST['from_name'],
      'from_email' => $_POST['from_email'],
      'to_name' => $_POST['to_name'],
      'to_email' => $_POST['to_email'],
      'to_state' => $_POST['to_state'],
    );

    //
   
    $table_name = $wpdb->prefix . 'refer';
    echo "<pre>";print_r($table_name);die;
    
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
	    footerMail($data['to_email'],$data['from_email']);
	?><script> alert('Friend Refer Successfully') </script>  
	<?php 
		$location = get_site_url() . "/faqs";
		wp_redirect( $location, 301 );
	}
}

	function footerMail($to_email,$from_email){
		
		
		$to_message = "<html><head></head><body>";
		$to_message .= "<a href='http://www.mkennys.com/'><img src='http://www.mkennys.com/images/logo.png' alt='' /></a><br>";
		$to_message .=  "<table border='0' cellspacing='0' cellpadding='0' width='580' style='width:435pt'><tbody><tr><td valign='top' style='padding:0;background-image:url();background-repeat:repeat no-repeat'>
			</td><td valign='top' style='padding:0;background-image:url();background-repeat:repeat no-repeat'></td></tr><tr><td colspan='2' style='border:1.5pt solid rgb(22,57,93);padding:0'><span><font color='#888888'></font></span><span><font color='#888888'></font></span><span><font color='#888888'></font></span><table border='0' cellspacing='0' cellpadding='0' width='100%' style='width:100%'>
				<tbody><tr><td style='padding:0'></td></tr><tr><td style='border:1.5pt solid rgb(22,57,93);padding:0'><span><font color='#888888'></font></span><span><font color='#888888'></font></span><span><font color='#888888'></font></span><span><font color='#888888'>
				</font></span><table border='0' cellspacing='0' cellpadding='0' width='100%' style='width:100%'>
				<tbody><tr><td colspan='2' style='padding:0'><br></td></tr><tr><td colspan='2' style='padding:2.25pt 0 2.25pt 7.5pt'><p style='line-height:12pt'><strong><span style='font-size:9pt;font-family:Verdana,sans-serif'>Hey,</span></strong></p>
		<div>

		<p style='line-height:12pt'><span style='font-size:9pt;font-family:Verdana,sans-serif'>Your friend ".$from_email." thought you'd like to be a part of <strong>Mekennys.com</strong>. Mekenny's offers the best in class custom clothing and accessories.Please visit us on <a href='http://www.mkennys.com/'>Mekennys.com</a>;</span></p></div></td></tr><tr><td colspan='2' style='padding:0'><br></td></tr>

		<tr><td colspan='2' style='border-style:none none solid;border-bottom-color:rgb(214,214,214);border-bottom-width:1pt;background-color:rgb(240,240,240);padding:2.25pt 0 2.25pt 7.5pt'><p style='line-height:12pt'><span style='font-size:9pt;font-family:Verdana,sans-serif'>If your information above appears incorrect let us know.&nbsp;<u></u></span><span style='font-family:Verdana,sans-serif;font-size:12px;'>Please feel free to e-mail us at&nbsp;</span><a href='mailto:info@mkennys.com' style='font-family:Verdana,sans-serif;font-size:12px;' target='_blank'>info@mkennys.com</a><span style='font-family:Verdana,sans-serif;font-size:12px;'>&nbsp;with any further questions. We look forward to meeting with you and welcome the opportunity to be of service.</span></p>


		</td></tr>

		<tr><td colspan='2' style='padding:0'><br></td></tr><tr style='color:#000;font-family:Verdana,sans-serif;font-size:12px;'><td colspan='2' style='padding:2.25pt 0 2.25pt 7.5pt'><span style='font-size:9pt;font-family:Verdana,sans-serif'><b>Thank you,</b>
		<br><br>
		<b>M. Kenny's</b></span><div><b><a href='mailto:info@mkennys.com' target='_blank'>info@mkennys.com</a> <br><a href='http://mkennys.com/' target='_blank'>www.mkennys.com</a><br>Toll Free <a href='tel:(800) 220-8469' target='_blank'>(800) 220-8469</a><br>

		3 Corporate Park, Suite 235<br></b></div><b> Irvine, CA. 92606</b><span><font color='#888888'><br><span><font color='#888888'><span><font color='#888888'></font></span></font></span><p></p><span><font color='#888888'><span><font color='#888888'></font></span></font></span></font></span></td></tr></tbody></table><span><font color='#888888'><span><font color='#888888'><span><font color='#888888'></font></span></font></span></font></span></td></tr></tbody></table><span><font color='#888888'><span><font color='#888888'><span><font color='#888888'></font></span></font></span></font></span></td></tr></tbody></table></body></html>";


		$from_message = "<html><head></head><body>";
		$from_message .= "<a href='http://www.mkennys.com/'><img src='http://www.mkennys.com/images/logo.png' alt='' /></a><br>";
		$from_message .=  "<table border='0' cellspacing='0' cellpadding='0' width='580' style='width:435pt'><tbody><tr><td valign='top' style='padding:0;background-image:url();background-repeat:repeat no-repeat'>
			</td><td valign='top' style='padding:0;background-image:url();background-repeat:repeat no-repeat'></td></tr><tr><td colspan='2' style='border:1.5pt solid rgb(22,57,93);padding:0'><span><font color='#888888'></font></span><span><font color='#888888'></font></span><span><font color='#888888'></font></span><table border='0' cellspacing='0' cellpadding='0' width='100%' style='width:100%'>
				<tbody><tr><td style='padding:0'></td></tr><tr><td style='border:1.5pt solid rgb(22,57,93);padding:0'><span><font color='#888888'></font></span><span><font color='#888888'></font></span><span><font color='#888888'></font></span><span><font color='#888888'>
				</font></span><table border='0' cellspacing='0' cellpadding='0' width='100%' style='width:100%'>
				<tbody><tr><td colspan='2' style='padding:0'><br></td></tr><tr><td colspan='2' style='padding:2.25pt 0 2.25pt 7.5pt'><p style='line-height:12pt'><strong><span style='font-size:9pt;font-family:Verdana,sans-serif'>Hi ,</span></strong></p>
		<div>

		<p style='line-height:12pt'><span style='font-size:9pt;font-family:Verdana,sans-serif'>

		Congratulations, You just refer a friend and you'll get a customized shirt as a gift when your friend place his first order ..&nbsp;</span></p></div></td></tr><tr><td colspan='2' style='padding:0'><br></td></tr>

		<tr><td colspan='2' style='border-style:none none solid;border-bottom-color:rgb(214,214,214);border-bottom-width:1pt;background-color:rgb(240,240,240);padding:2.25pt 0 2.25pt 7.5pt'><p style='line-height:12pt'><span style='font-size:9pt;font-family:Verdana,sans-serif'>If your information above appears incorrect let us know.&nbsp;<u></u></span><span style='font-family:Verdana,sans-serif;font-size:12px;'>Please feel free to e-mail us at&nbsp;</span><a href='mailto:info@mkennys.com' style='font-family:Verdana,sans-serif;font-size:12px;' target='_blank'>info@mkennys.com</a><span style='font-family:Verdana,sans-serif;font-size:12px;'>&nbsp;with any further questions. We look forward to meeting with you and welcome the opportunity to be of service.</span></p>


		</td></tr>

		<tr><td colspan='2' style='padding:0'><br></td></tr><tr style='color:#000;font-family:Verdana,sans-serif;font-size:12px;'><td colspan='2' style='padding:2.25pt 0 2.25pt 7.5pt'><span style='font-size:9pt;font-family:Verdana,sans-serif'><b>Thank you,</b>
		<br><br>
		<b>M. Kenny's</b></span><div><b><a href='mailto:info@mkennys.com' target='_blank'>info@mkennys.com</a> <br><a href='http://mkennys.com/' target='_blank'>www.mkennys.com</a><br>Toll Free <a href='tel:(800) 220-8469' target='_blank'>(800) 220-8469</a><br>

		3 Corporate Park, Suite 235<br></b></div><b> Irvine, CA. 92606</b><span><font color='#888888'><br><span><font color='#888888'><span><font color='#888888'></font></span></font></span><p></p><span><font color='#888888'><span><font color='#888888'></font></span></font></span></font></span></td></tr></tbody></table><span><font color='#888888'><span><font color='#888888'><span><font color='#888888'></font></span></font></span></font></span></td></tr></tbody></table><span><font color='#888888'><span><font color='#888888'><span><font color='#888888'></font></span></font></span></font></span></td></tr></tbody></table></body></html>";



		
		$to_subject = "Referral Invitation (MKennys.com)";

		$from_subject = "Referral Confirmation (MKennys.com)";


		$from = 'krish@trsoftwaregroup.com';
		$headers = 'MIME-Version: 1.0' . "\r\n";
		//$headers .= 'Bcc:info@mkennys.com,Kenny@mkennys.com' . "\r\n";
        $headers .= 'Bcc:singhkaranjeet92@gmail.com,karanjeettr@gmail.com' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: " .$from. "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		$mail=mail($to_email,$to_subject,$to_message,$headers);
		$mail=mail($from_email,$from_subject,$from_message,$headers);
		return;
	}



 ?>