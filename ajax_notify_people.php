<?php
print_r($_POST);
exit;

/*
require_once('wp-load.php');
$to = $_POST['email'];
$state=$_POST['map_state'];

$retrieve_data = $wpdb->get_results("SELECT * FROM wp_mailing_list where mailing_email='".$to."' and mailing_state='".$state."' and status='1'");

if(count($retrieve_data)>0){
$message='Already exist User';
echo $message;
exit;	
}else{
	
$message = '';
$subject = "Join our Mailing List";
$mailinglist = '<div  class="mailWrap">';
	
$mailinglist .= '<a href="http://www.mkennys.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.mkennys.com&amp;source=gmail&amp;ust=1497685628173000&amp;usg=AFQjCNFUISZVuQKyVwHvRinKdmiEN6EIgg"><img src="'.get_template_directory_uri().'/images/logo.png" alt="" class="CToWUd"></a>';
$mailinglist .= '<br>';
$mailinglist .= '<table border="0" cellspacing="0" cellpadding="0" width="580" style="width:435.0pt">';
$mailinglist .= '<tbody>';
$mailinglist .= '<tr>';
$mailinglist .= '<td valign="top" style="padding:0 0 0 0"></td>';
$mailinglist .= '<td valign="top" style="padding:0 0 0 0"></td>';
$mailinglist .= '</tr>';
$mailinglist .= '<tr>';
$mailinglist .= '<td colspan="2" style="border:solid #16395d 1.5pt;padding:0 0 0 0">';

$mailinglist .= '<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">';
$mailinglist .= '<tbody>';
$mailinglist .= '<tr><td style="padding:0 0 0 0"></td></tr>';
$mailinglist .= '<tr>';
$mailinglist .= '<td style="border:solid #16395d 1.5pt;padding:0 0 0 0">';

$mailinglist .= '<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">';
$mailinglist .= '<tbody>';
$mailinglist .= '<tr>';
$mailinglist .= '<td colspan="2" style="padding:0 0 0 0">';
$mailinglist .= '<p class="MsoNormal">&nbsp;</p>';
$mailinglist .= '</td>';
$mailinglist .= '</tr>';
$mailinglist .= '<tr>';
$mailinglist .= '<td colspan="2" style="padding:2.25pt 0in 2.25pt 7.5pt">';
$mailinglist .= '<p style="line-height:12.0pt"><strong><span style="font-size:9.0pt;font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;">Hello&nbsp;'. $_POST['name'].' ,</span></strong><span style="font-size:9.0pt;font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;"></span></p>';
$mailinglist .= '<p style="line-height:12.0pt">';
$mailinglist .= '<span style="font-size:9.0pt;font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;">Thank you for your interest in ';
$mailinglist .= '<a href="http://mkennys.com" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://mkennys.com&amp;source=gmail&amp;ust=1497685628173000&amp;usg=AFQjCNGDDB0GUljJ_TLziQq_Q1fG1CA-VA"> mkennys.com</a>.';
$mailinglist .= 'Thank you for joining our e-mail list. We\'ll keep you informed of our upcoming travel schedules in a city near you..</span>';
$mailinglist .= '</p>';
$mailinglist .= '</td>';
$mailinglist .= '</tr>';
$mailinglist .= '<tr>';
$mailinglist .= '<td colspan="2"></td>';
$mailinglist .= '</tr>';
$mailinglist .= '<tr>';
$mailinglist .= '<td colspan="2" style="padding:0 0 0 0">';
$mailinglist .= '<p class="MsoNormal">&nbsp;</p>';
$mailinglist .= '</td>';
$mailinglist .= '</tr>';
$mailinglist .= '<tr>';
$mailinglist .= '<td width="40%" style="width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;border-top:solid #ddd6b5 1.0pt;background:#fff;padding:3.75pt 0in 3.75pt 7.5pt">';
$mailinglist .= '<p class="MsoNormal">';
$mailinglist .= '<b>';
$mailinglist .= '<span style="font-size:9.0pt;font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;">Name:</span>';
$mailinglist .= '</b>';
$mailinglist .= '</p>';
$mailinglist .= '</td>';
												
$mailinglist .= '<td width="60%" style="width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;border-top:solid #ddd6b5 1.0pt;background:#fff;padding:3.75pt 0pt 3.75pt 7.5pt">';
												
$mailinglist .= '<p class="MsoNormal">';
$mailinglist .= '<b>';
$mailinglist .= '<span style="font-size:9.0pt;font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;">'.$_POST["name"].'</span>';
$mailinglist .= '</b>';
$mailinglist .= '</p>';
$mailinglist .= '</td>';
$mailinglist .= '</tr>';

$mailinglist .= '<tr>';
$mailinglist .= '<td width="40%" style="width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#fff;padding:3.75pt 0in 3.75pt 7.5pt">';
$mailinglist .= '<p class="MsoNormal">';
$mailinglist .= '<b><span style="font-size:9.0pt;font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;">Email:</span></b>';
$mailinglist .= '</p>';
$mailinglist .= '</td>';
$mailinglist .= '<td width="60%" style="width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#fff;padding:3.75pt 0in 3.75pt 7.5pt">';
$mailinglist .= '<p class="MsoNormal">';
$mailinglist .= '<b><span style="font-size:9.0pt;font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;">';
$mailinglist .= '<a href="mailto:'.$_POST['email'].'" target="_blank">'.$_POST['email'].'</a>';
$mailinglist .= '</span></b>';
$mailinglist .= '</p>';
$mailinglist .= '</td>';
$mailinglist .= '</tr>';											
$mailinglist .= '<tr>';
$mailinglist .= '<td width="40%" style="width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#fff;padding:3.75pt 0in 3.75pt 7.5pt">';
$mailinglist .= '<p class="MsoNormal">';
$mailinglist .= '<b>';
$mailinglist .= '<span style="font-size:9.0pt;font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;">State:</span>';
$mailinglist .= '</b>';
$mailinglist .= '</p>';
$mailinglist .= '</td>';
$mailinglist .= '<td width="60%" style="width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#fff;padding:3.75pt 0in 3.75pt 7.5pt">';
$mailinglist .= '<p class="MsoNormal">';
$mailinglist .= '<b>';
$mailinglist .= '<span style="font-size:9.0pt;font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;">'.$_POST['map_state'].'</span>';
$mailinglist .= '</b>';
$mailinglist .= '</p>';
$mailinglist .= '</td>';
$mailinglist .= '</tr>';
$mailinglist .= '<tr>';
$mailinglist .= '<td colspan="2" style="border:none;border-bottom:solid #d6d6d6 1px;background:#f0f0f0;padding:2.25pt 0in 2.25pt 7.5pt">';
$mailinglist .= '<p style="line-height:12.0pt">';
$mailinglist .= '<span style="font-size:9.0pt;font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;">If your information above appears incorrect let us know. Please feel free to e-mail us at <a href="mailto:info@mkennys.com" target="_blank">info@mkennys.com</a> with any further questions. We look forward to meeting with you and welcome the opportunity to be of service.</span>';
$mailinglist .= '</p>';
$mailinglist .= '</td>';
$mailinglist .= '</tr>';
$mailinglist .= '<tr>';											
$mailinglist .= '<td colspan="2" style="padding:0 0 0 0">';
$mailinglist .= '<p class="MsoNormal">&nbsp;</p>';
$mailinglist .= '</td>';
$mailinglist .= '</tr>';
$mailinglist .= '<tr style="color:#000 important">';
$mailinglist .= '<td colspan="2" style="font-weight:bold;padding:2.25pt 0in 2.25pt 7.5pt">';
$mailinglist .= '<p class="MsoNormal" style="line-height:12.0pt">';

$mailinglist .= '<p>
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
            </p>';


$mailinglist .= '</p>';
$mailinglist .= '</td>';
$mailinglist .= '</tr>';
$mailinglist .= '</tbody>';
$mailinglist .= '</table>';
$mailinglist .= '<span></span>';
$mailinglist .= '</td>';
$mailinglist .= '</tr>';
$mailinglist .= '</tbody>';
$mailinglist .= '</table>';
$mailinglist .= '<span></span>';
$mailinglist .= '</td>';
$mailinglist .= '</tr>';
$mailinglist .= '</tbody>';
$mailinglist .= '</table>';
$mailinglist .= '</div>';

$from = "info@mkennys.com";

  $headers .= "Mkenny: Sender Mkenny\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "From:  True Fitted by M.Kenny’s <" .$from. "> \r\n" .
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
//Send email

$email_to = "$to,info@mkennys.com,Kenny@mkennys.com";
//$email_to = "$to,karanjeettr@gmail.com,singhkaranjeet92@gmail.com";

if(mail($email_to,$subject,$mailinglist,$headers)){
	//if(1){
	
	global $wpdb;
	 $sql="INSERT INTO `wp_mailing_list` (`mailing_name`, `mailing_email`, `mailing_state`, `created_at`) VALUES( '".$_POST['name']."','".$_POST['email']."','".$_POST['map_state']."',now());";		
	if($wpdb->query($sql)){
		$message = 'Email has sent successfully.';	
	}
	
	
}
	else{
		$message = 'Email sending fail.';
	}
	echo $message;
	exit;
}
*/
?>