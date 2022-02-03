<?php
require_once('bdd.php');

//print_r($_POST);

$zones='';
if(isset($_POST['state_zone'])){
	$zones = $_POST['state_zone'];
}else{
	
	$zones = '';
}
	

/*	

if($_POST['rData']=='editData'){
	
	
	$sql="UPDATE wp_schedule_appointment SET	
		first_name='".addslashes($_POST['fullname'])."',	
		last_name='".addslashes($_POST['lastname'])."',	
		phone='".addslashes($_POST['phone'])."',	
		email='".addslashes($_POST['email'])."',	
		appointment_date='".addslashes($_POST['appointment_date'])."',	
		appointment_time='".addslashes($_POST['appointment_time'])."',	
		interested_in='".addslashes($_POST['interested_in'])."',	
		message='".addslashes($_POST['message'])."'		
		WHERE id=".$_POST['appointment_id'];
		
		$query = $bdd->prepare( $sql );
		if ($query == false) {	
		 die ('Error in Sql Query');
		}
		if($query->execute()){
			
			
			$email=$_POST['email'];
			//$to = "$email,info@mkennys.com,Kenny@mkennys.com";
	$to = "$email,karanjeettr@gmail.com,singhkaranjeet92@gmail.com";
	$subject = "M. Kenny's Appointment Reschedule";

	$mailinglist = "<html><head></head><body>";
	$mailinglist .= "<a href='http://www.mkennys.com'><img src='http://www.mkennys.com/images/logo.png' alt='' /></a><br>";

	$mailinglist .=  "<table border='0' cellspacing='0' cellpadding='0' width='580' style='width:435.0pt'>
	<tbody>
		<tr>
			<td valign='top' style='padding:0 0 0 0;'></td>
			<td valign='top' style='padding:0 0 0 0;'></td>
		</tr>
		<tr>
			<td colspan='2' style='padding:0 0 0 0'>
				<table border='0' cellspacing=0' cellpadding='0' width='100%' style='width:100.0%'>
					<tbody>
						<tr>
							<td style='padding:0 0 0 0'></td>
						</tr>
						<tr>
							<td style='border:solid #16395d 1.5pt;padding:0 0 0 0'>
								<table border='0' cellspacing='0' cellpadding='0' width='100%' style='width:100.0%'>
									<tbody>
										<tr>
											<td colspan='2' style='padding:0 0 0 0'>
												<p class='MsoNormal'>&nbsp;</p>
											</td>
										</tr>
										<tr>
											<td colspan='2' style='padding:2.25pt 0in 2.25pt 7.5pt'>
												<p style='line-height:12.0pt'><strong><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Hello ".$_POST['fullname']." ,</span></strong><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'></span></p>
												
												<p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Thank you for your interest in <a href='http://mkennys.com' target='_blank'> mkennys.com</a>. Your appointment is confirmed with us. <br>Please keep us apprised of any cancellations so we may inform our staff.<br>Should there be any changes or scheduling conflicts on our end, we will do our absolute best to accommodate you or reschedule.</span></p>

											</td>
										</tr>
										<tr>
											<td  colspan='2'></td>
										</tr>
										<tr>
											<td colspan='2' style='padding:0 0 0 0'>
												<p class='MsoNormal'>&nbsp;</p>
											</td>
										</tr>
										<tr>

	<td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Appointment Confirmation:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$_POST['fullname']." ".$_POST['lastname']."</span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Phone :</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'><a href='tel:".$_POST['phone']."' target='_blank'>".$_POST['phone']."</a></span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Email :</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'><a href='mailto:".$_POST['email']."' target='_blank'>".$_POST['email']."</a></span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Interested In :</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$_POST['interested_in']."</span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Date and time :</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$_POST['appointment_date']."   ,   ".$_POST['appointment_time']." </span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Location :</span></b></p><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$_POST['cityName'].",".$_POST['state']."<br/>".$zones."</span></b></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Message:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$_POST['message']."</span></b></p></td></tr><tr><td colspan='2' style='border:none;border-bottom:solid #d6d6d6 1px;background:#f0f0f0;padding:2.25pt 0in 2.25pt 7.5pt'><p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>If this is your first time with us, it is helpful to wear your best fitting suit, shirt and dress shoes. Our representatives will provide their input and carry several thousand fabrics to help you individualize your own look. Please feel free to e-mail us at info@mkennys.com with any further inquiries. Thank you and we look forward to meeting with you.</span></p></td></tr><tr><td colspan='2' style='padding:0 0 0 0'><p class='MsoNormal'>&nbsp;</p></td></tr><tr style='color:#000!important;'><td colspan='2' style='font-weight:bold;padding:2.25pt 0in 2.25pt 7.5pt'><p class='MsoNormal' style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Thank you,<br><br><b>M. Kenny's</b><br>3 Corporate Park, Suite 235<br>Irvine, CA. 92606<br>Tel: (714) 573-2199<br>Cell: (949) 929-9511<br>Fax: (714) 573-9143 <br><a href='http://mkennys.com/' target='_blank'>www.mkennys.com</a><br></span></p></td></tr></tbody></table></td></tr>

	</tbody>

	</table>	

	

	</td></tr>

	</tbody>

	</table></body></html>";
  $headers = "Mkenny: Sender Mkenny\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
		
		if($_POST['ans'] == 1){
			
			//if(wp_mail($to,$subject,$mailinglist,$headers)){
		
			if(1){				
				
				$response['msg'] = "Appointment has been rescheduled";
				echo json_encode($response);
				
				
			}		
		}
		
			die;
		}
	
}

*/


if($_POST['cData']=='delete'){
	
	$sql = "DELETE FROM wp_schedule_appointment WHERE id ='".$_POST['app_id']."'";
	$query = $bdd->prepare( $sql );
	if ($query == false) {	
	 die ('Error in Sql Query');
	}
	if($query->execute()){
		
		
		/* Get City name */

		$eventCityId = $_POST['city_name'];
		$query = "select city_name from wp_schedule_events where id = ".$eventCityId;
		$req = $bdd->prepare($query);
		$req->execute();
		$cities = $req->fetchAll();
		$cityName = isset($cities[0]['city_name'])? $cities[0]['city_name'].", " : "";
		
		
			$state_arr = array();
				foreach($_POST['sastate'] as $singleStateId){
					
					$state_arr[] = "'".$singleStateId."'";
				}
				
				$state  = implode(",",$state_arr);

			$query = "select state_name from wp_state where id IN (".$state.") ";
			
			
			$req = $bdd->prepare($query);
			$req->execute();
			$state_name = $req->fetchAll();
			
			
			
			
			//$state_name = $wpdb->get_results($query);

			$singleState='';
			$eveId='';

			if(count($state_name) == 1){
				$singleState .= $state_name[0]['state_name'];
				
			}else{
				
				foreach($state_name as $singleName){
					
					$singleState .= $singleName['state_name']." ";
				}
				
			}
			
		$fname = trim($_POST['safirst_name']);
		$lname = $_POST['salast_name'];			
		$fullname = ucfirst($fname).' '.ucfirst($lname);
		
		$email=$_POST['saemail'];
	    $to = $email;
		$from = "info@mkennys.com";
	
	$subject = "Custom Fitting Appointment Cancelled for ".$fullname;

	$mailinglist = "<html><head></head><body>";
	$mailinglist .= "<a href='http://www.mkennys.com'><img src='".get_template_directory_uri()."/images/logo.png' alt='' /></a><br>";

	$mailinglist .=  "<table border='0' cellspacing='0' cellpadding='0' width='580' style='width:435.0pt'>
	<tbody>
		<tr>
			<td valign='top' style='padding:0 0 0 0;'></td>
			<td valign='top' style='padding:0 0 0 0;'></td>
		</tr>
		<tr>
			<td colspan='2' style='padding:0 0 0 0'>
				<table border='0' cellspacing=0' cellpadding='0' width='100%' style='width:100.0%'>
					<tbody>
						<tr>
							<td style='padding:0 0 0 0'></td>
						</tr>
						<tr>
							<td style='border:solid #16395d 1.5pt;padding:0 0 0 0'>
								<table border='0' cellspacing='0' cellpadding='0' width='100%' style='width:100.0%'>
									<tbody>
										<tr>
											<td colspan='2' style='padding:0 0 0 0'>
												<p class='MsoNormal'>&nbsp;</p>
											</td>
										</tr>
										<tr>
											<td colspan='2' style='padding:2.25pt 0in 2.25pt 7.5pt'>
			<p style='line-height:12.0pt'><strong><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Hello ".$_POST['safirst_name'].",</span></strong><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'></span></p>
												
												<p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Your custom fitting appointment with <span style='font-weight:bold'>True Fitted by M. Kenny's</span> has been cancelled.</span></p>

											</td>
										</tr>
										<tr>
											<td  colspan='2'></td>
										</tr>
										<tr>
											<td colspan='2' style='padding:0 0 0 0'>
												<p class='MsoNormal'>&nbsp;</p>
											</td>
										</tr>
										<tr>

	<td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Appointment Cancellation:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$_POST['safirst_name']." ".$_POST['salast_name']."</span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Phone:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'><a href='tel:".$_POST['saphone']."' target='_blank'>".$_POST['saphone']."</a></span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Email:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'><a href='mailto:".$_POST['saemail']."' target='_blank'>".$_POST['saemail']."</a></span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Interested In:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$_POST['sinterested']."</span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Date and time:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$_POST['datess'].", ".$_POST['times']." </span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Location:</span></b></p><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$cityName.$singleState."<br/>".$zones."</span></b></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Message:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$_POST['samessage']."</span></b></p></td></tr><tr><td colspan='2' style='border:none;border-bottom:solid #d6d6d6 1px;background:#f0f0f0;padding:2.25pt 0in 2.25pt 7.5pt'><p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Please feel free to e-mail us at <a href='mailto:info@mkennys.com'>info@mkennys.com</a> with any further inquiries. Thank you.</span></p></td></tr><tr><td colspan='2' style='padding:0 0 0 0'><p class='MsoNormal'>&nbsp;</p></td></tr><tr style='color:#000!important;'><td colspan='2' style='font-weight:bold;padding:2.25pt 0in 2.25pt 7.5pt'><p><b style='font-weight:bold;font-size: 13px; font-family:Arial, Helvetica, sans-serif; color: #000;'>Thanks,</b><br><span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #000;'>True Fitted by M. Kenny's</span><br><span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #000;'>Irvine, CA.</span><br><a href='mailto:info@mkennys.com'>info@mkennys.com</a>
    <br><a href='http://www.mkennys.com'>www.mkennys.com</a><br><span style='font-weight:bold;font-size: 12px; font-family:Arial, Helvetica, sans-serif; color: #000;'>Phone: +1 714 573 2199</span></p></td></tr></tbody></table></td></tr>

	</tbody>

	</table>	

	

	</td></tr>

	</tbody>

	</table></body></html>";
  
/*  $headers  = "Mkenny: Sender Mkenny\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "Cc: info@mkennys.com,Kenny@mkennys.com" . "\r\n";  
  //$headers .= "Cc: karanjeettr@gmail.com,sanjeevtrgroup@outlook.com" . "\r\n";  
  $headers .= "From:  True Fitted by M Kennys <" .$from. "> \r\n" .
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;*/

  $headers = "Mkenny: Sender Mkenny\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "Cc: Kenny@mkennys.com,info@mkennys.com" . "\r\n";  
 // $headers .= "Cc: karanjeettr@gmail.com,sanjeevtrgroup@outlook.com" . "\r\n";  
  $headers .= "From:  True Fitted by M Kennys <" .$from. "> \r\n";
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

       if($_POST['ans'] == 1){
		   if(wp_mail($to,$subject,$mailinglist,$headers)){
		
			//if(1){				
				$response['msg'] = "Appointment has been cancelled";
				echo json_encode($response);
				exit;
			}			
		
		   
	   }else{
		   
		    $response['msg'] = "Appointment has been cancelled";
			echo json_encode($response);
			exit;
	   }
  
			
		
	}
}

/*
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$sql = "DELETE FROM events WHERE id = $id";
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
	
}elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	
	$sql = "UPDATE events SET  title = '$title', color = '$color' WHERE id = $id ";

	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
header('Location: index.php');
*/

	
?>
