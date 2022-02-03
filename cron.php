<?php 
require_once("./wp-load.php");

// $conn = mysqli_connect("127.0.0.1","mkennys_mkennyt","T_?9*Dc*37n&");
$conn = mysqli_connect("127.0.0.1","mkennys5_wp370","lRy1zO!I#%61");
mysqli_select_db($conn, "mkennys5_wp370");
// $select="SELECT * FROM  `appointment_list` WHERE id=14";
/*$select="SELECT sa.id, sa.first_name, sa.last_name, sa.phone, sa.email, sa.appointment_date, sa.appointment_time, se.city_name, se.location, se.contact_name, se.phone_no, se.alternative_phone_no  FROM  `wp_schedule_appointment` as sa, `wp_schedule_events` as se WHERE  `appointment_date` = DATE_FORMAT(CURRENT_DATE + 1,'%m/%d/%Y') AND sa.state = se.id AND sa.is_delete = 1 AND se.is_delete = 1 AND se.status = 1";*/
$select="SELECT sa.id, sa.first_name, sa.last_name, sa.phone, sa.email, sa.appointment_date, sa.appointment_time, se.city_name, se.location, se.contact_name, se.phone_no, se.alternative_phone_no  FROM  `wp_schedule_appointment` as sa, `wp_schedule_events` as se WHERE  STR_TO_DATE(appointment_date,'%m/%d/%Y') = CURDATE() AND sa.state = se.id AND sa.is_delete = 1 AND se.is_delete = 1 AND se.status = 1";

$query=mysqli_query($conn, $select);

while($fetch=mysqli_fetch_assoc($query))
{	
	extract($fetch);

	$location = html_entity_decode($location);

	$time = str_replace('.',"",strtoupper($time));
	$contact=str_replace('%20','',$contact);
	$contact_number=str_replace('%20','',$contact_number);
	$result = strip_tags($contact_number);
	$result = str_replace(array("\r\n", "\r"), "\n", $result);
	$lines = explode("\n", $result);

    $contact_number = $phone_no;
    if(!empty($alternative_phone_no))
    {
    	if(!empty($contact_number))
    	{
    		$contact_number .= ', ';
    	}
    	$contact_number .= $alternative_phone_no;
    }
	$to=$email;
	//$to='amanjot@trsoftwaregroup.com';
	//$to='nsehmi@gmail.com'
	$subject = "M. Kenny's Appointment Reminder";
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: mkennys5@us225.siteground.us (True Fitted by M Kennys) \r\n";
	"X-Mailer: PHP/" . phpversion();
	$message2 = "<html><head></head><body>";
	$message2 .= "<a href='http://www.mkennys.com'><img src='http://www.mkennys.com/newsletter-images/logo.png' alt='' /></a><br>";
   $message2 .=  "<table border='0' cellspacing='0' cellpadding='0' width='580' style='width:435.0pt'>
<tbody>
<tr>
<td valign='top' style='padding:0 0 0 0;'></td>
<td valign='top' style='padding:0 0 0 0;'></td>
</tr>
<tr>
<td colspan='2' style='border:solid #16395d 1.5pt;padding:0 0 0 0'>
<table border='0' cellspacing=0' cellpadding='0' width='100%' style='width:100.0%'>
<tbody>
<tr><td style='padding:0 0 0 0'></td></tr>
<tr>
<td style='padding:0 0 0 0'>
<table border='0' cellspacing='0' cellpadding='0' width='100%' style='width:100.0%'>
<tbody>
<tr>
<td colspan='2' style='padding:10px 20px'>
<p style='line-height:12.0pt'><strong><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Hello ".$first_name.",</span></strong><span style='font-size:9.0pt;font-family:Verdana,sans-serif'></span></p>
<p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>You have an appointment with us tomorrow. Below are the details of your appointment.</span></p>
</td></tr>	
	<tr>
	<td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Contact Person :</span></b></p></td><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$contact_name."</span></b></p></td></tr><tr><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Contact Person Phone: </span></b></p></td><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$contact_number."</span></b></p></td></tr><tr><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Date and time :</span></b></p></td><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$appointment_date.", ".$appointment_time."   </span></b></p></td></tr><tr><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Location :</span></b></p></td><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$location."</span></b></p></td></tr><tr><td colspan='2' style='border:none;border-bottom:solid #d6d6d6 1.0pt;background:#f0f0f0;padding:10px 20px'><p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>If this is your first time with us, it is helpful to wear your best fitting suit, shirt and dress shoes. Our representatives will provide their input and carry several thousand fabrics to help you individualize your own look. Please feel free to e-mail us at info@mkennys.com with any further inquiries. Thank you and we look forward to meeting with you.</span></p></td></tr><tr><td colspan='2' style='padding:10px 20px'><p><span style='font-weight:bold;font-size: 12px; font-family:Verdana, sans-serif; color: #222;'>Thanks,</span><br><span style='font-weight:bold;font-size: 12px; font-family:Verdana, sans-serif; color: #222;'>True Fitted by M. Kenny's</span><br><span style='font-size: 12px;font-weight:bold; font-family:Verdana, sans-serif; color: #222;'>Irvine, CA.</span><br><a style='font-weight:bold;color:#15c' href='mailto:info@mkennys.com'>info@mkennys.com</a><br><a style='font-weight:bold;color:#15c' href='http://www.mkennys.com'>www.mkennys.com</a><br><a style='font-weight:bold;color:#15c' href='tel:(714)%20573-2199' value='+17145732199' target='_blank'>+1 714 573 2199</a>
    		</p></td></tr></tbody></table></td></tr>
	</tbody>
	</table>
	</td></tr>
	</tbody>
	</table></body></html>";
	
	$mail=wp_mail($to,$subject,$message2,$headers);
	
	$to = "info@mkennys.com";

	//$to="amanjot@trsoftwaregroup.com";
	//$headers .= 'Bcc:info@mkennys.com,mkennysweb@gmail.com,info@KMKhemani.hostpilot.com' . "\r\n";	
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: ".$email. " \r\n";
	"X-Mailer: PHP/" . phpversion();
	
	
	
	$message3 = "<html><head></head><body>";
	$message3 .= "<a href='http://www.mkennys.com'><img src='http://www.mkennys.com/newsletter-images/logo.png' alt='' /></a><br>";
   $message3 .=  "<table border='0' cellspacing='0' cellpadding='0' width='580' style='width:435.0pt'>
<tbody>
<tr>
<td valign='top' style='padding:0 0 0 0;'></td>
<td valign='top' style='padding:0 0 0 0;'></td>
</tr>
<tr>
<td colspan='2' style='border:solid #16395d 1.5pt;padding:0 0 0 0'>
<table border='0' cellspacing=0' cellpadding='0' width='100%' style='width:100.0%'>
<tbody>
<tr><td style='padding:0 0 0 0'></td></tr>
<tr>
<td style='padding:0 0 0 0'>
<table border='0' cellspacing='0' cellpadding='0' width='100%' style='width:100.0%'>
<tbody>
<tr>
<td colspan='2' style='padding:10px 20px'>
<p style='line-height:12.0pt'><strong><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Hello Mkenny's,</span></strong><span style='font-size:9.0pt;font-family:Verdana,sans-serif'></span></p>
<p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$first_name." has an appointment with us tomorrow. Below are his details.</span></p>
</td></tr>	
	<tr><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Customer's Full Name :</span></b></p></td><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$first_name."  ".$last_name."   </span></b></p></td></tr><tr><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Customer's E-mail Address :</span></b></p></td><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$email."   </span></b></p></td></tr><tr><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Customer's Telephone Number :</span></b></p></td><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$phone."   </span></b></p></td></tr>
	<tr>
<td colspan='2' style='padding:10px 20px'>
<<p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Below are the appointment details:-</span></p>
</td></tr>
	<tr>
	<td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Contact Person :</span></b></p></td><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$contact_name."</span></b></p></td></tr><tr><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Contact Person Phone: </span></b></p></td><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$contact_number."</span></b></p></td></tr><tr><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Date and Time :</span></b></p></td><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$appointment_date.", ".$appointment_time."   </span></b></p></td></tr><tr><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>Location :</span></b></p></td><td width='50%' style='width:50.0%;border:none;border-bottom:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>".$location."</span></b></p></td></tr><tr><td colspan='2' style='border:none;border-bottom:solid #d6d6d6 1.0pt;background:#f0f0f0;padding:10px 20px'><p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif'>If this is your first time with us, it is helpful to wear your best fitting suit, shirt and dress shoes. Our representatives will provide their input and carry several thousand fabrics to help you individualize your own look. Please feel free to e-mail us at info@mkennys.com with any further inquiries. Thank you and we look forward to meeting with you.</span></p></td></tr><tr><td colspan='2' style='padding:10px 20px'><p><span style='font-weight:bold;font-size: 12px; font-family:Verdana, sans-serif; color: #222;'>Thanks,</span><br><span style='font-weight:bold;font-size: 12px; font-family:Verdana, sans-serif; color: #222;'>True Fitted by M. Kenny's</span><br><span style='font-size: 12px;font-weight:bold; font-family:Verdana, sans-serif; color: #222;'>Irvine, CA.</span><br><a style='font-weight:bold;color:#15c' href='mailto:info@mkennys.com'>info@mkennys.com</a><br><a style='font-weight:bold;color:#15c' href='http://www.mkennys.com'>www.mkennys.com</a><br><a style='font-weight:bold;color:#15c' href='tel:(714)%20573-2199' value='+17145732199' target='_blank'>+1 714 573 2199</a>
    		</p></td></tr></tbody></table></td></tr>
	</tbody>
	</table>
	</td></tr>
	</tbody>
	</table></body></html>";

	$mail2=wp_mail($to,$subject,$message3,$headers) or die(""); 
}
?>