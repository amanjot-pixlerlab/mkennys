<?php
session_start();
require_once('wp-load.php');
require_once(get_template_directory().'/twilio.php');
    
global $wpdb;

$timeChange = false;

$msg='';
if(empty($_SESSION['check'] ) || strcasecmp($_SESSION['check'], $_POST['check']) != 0){  
		  $formData['msg']="error";
		 $msg =json_encode($formData);
		 echo $msg;
		exit;
}else{	
	
//session_destroy();

unset($_SESSION['location']);		
unset($_SESSION['startTime']);	
unset($_SESSION['startTime_hour']);	
unset($_SESSION['startTime_min']);
unset($_SESSION['endTime']);
unset($_SESSION['endTime_hour']);
unset($_SESSION['endTime_min']);
unset($_SESSION['description']);
unset($_SESSION['title']);
unset($_SESSION['email']);
unset($_SESSION['timeFormat']);	
unset($_SESSION['first_name']);
unset($_SESSION['last_name']);	
unset($_SESSION['phone']);
unset($_SESSION['event_location']);
unset($_SESSION['phone_no']);
unset($_SESSION['alternative_phone_no']);
unset($_SESSION['contact_name']);
unset($_SESSION['g_timeFormat']);
//$_SESSION['post']=$_POST;


//print_r($_POST);exit("Here");


$formData=$_POST;


	
	$msg='';
	$table_name = $wpdb->prefix .'schedule_appointment';
	$first_name  = trim(esc_attr($_POST['safirst_name']));
	$last_name   = trim(esc_attr($_POST['salast_name']));
	$phone       = trim(esc_attr($_POST['saphone']));
	$phone = preg_replace('/\s+/', '', $phone);
	$email       = trim(esc_attr($_POST['saemail']));	
	$dates       = trim(esc_attr($_POST['datess']));
	$times       = trim(esc_attr($_POST['times']));
	$time_slot       = trim(esc_attr($_POST['time_slot']));
    
    $source = '';
    if( isset($_POST['source']) ){
        $source = $_POST['source'];
    }
	
	if(is_array($_POST['sinterested']))
	{
		$_POST['sinterested'] = implode(', ', $_POST['sinterested']);
	}
	$interested  = $_POST['sinterested'];	
	$message    =  preg_replace("/\r|\n/", "", $_POST['samessage']);

	
	$state_arr = array();
	foreach($_POST['sastate'] as $singleStateId){
		
		$state_arr[] = "'".$singleStateId."'";
	}
	
	$state  = implode(",",$state_arr);

$query = "select state_name from wp_state where id IN (".$state.") ";
$state_name = $wpdb->get_results($query);

$singleState='';
$eveId='';

if(count($state_name) == 1){
	$singleState .= $state_name[0]->state_name;
	
}else{
	
	foreach($state_name as $singleName){
		
		$singleState .= $singleName->state_name." ";
	}
	
}
$query = "select event_id from wp_schedule_event_state where state_id IN (".$state.") and is_delete=1 ";
$eventIds = $wpdb->get_results($query);

$zone_query = "select * from wp_statezone where id='".$_POST['state_zone']."' ";
$zones = $wpdb->get_results($zone_query);

$eventId_arr=array();

if(count($eventIds)== 1){
	
	$eventId_arr[] = "'".$eventIds['0']->event_id."'";
	$eveId  = implode(",",$eventId_arr);
}else{
	
	foreach($eventIds as $eventId){
		
		$eventId_arr[] = "'".$eventId->event_id."'";
	}
	$eveId  = implode(",",$eventId_arr);
}


$query = "select event_id from wp_appointment_date_time where event_id IN (".$eveId.") and start_date ='".$dates."' and is_delete=1";
$eventIds = $wpdb->get_results($query);

$city_query = "select contact_name, city_name, location, phone_no, alternative_phone_no  from wp_schedule_events where id = '".$eventIds['0']->event_id."' ";
$cities = $wpdb->get_results($city_query);


	if(!empty($_POST['app_id'])){
		
		$selectApppointment = "SELECT * FROM wp_schedule_appointment WHERE id ='".$_POST['app_id']."'";
		$appointmentData = $wpdb->get_results($selectApppointment);
	
		if(count($appointmentData)>0)
		{				
			if($times != $appointmentData[0]->appointment_time)
			{
				$timeChange = true;
			}
		}

		$sql = "DELETE FROM wp_schedule_appointment WHERE id ='".$_POST['app_id']."'";
		$wpdb->query($sql);
	}	


$location = $cities['0']->location;



$location = str_replace('<p>','',$location);
$location = str_replace('<P>','',$location);
$location = str_replace('<p></p>','',$location);
$location = str_replace('<P></P>','',$location);
$location = str_replace('&lt;p&gt;&lt;/p&gt;','',$location);
$location = str_replace('&lt;p&gt;','<br>',$location);
$location = str_replace('</p>','<br>',$location);  
$location = str_replace('</P>','<br>',$location);
$location = str_replace('&lt;/p&gt;','',$location); 
$location = str_replace('<br />','<br>',$location); 
$location = str_replace('<BR />','<br>',$location); 
$location = str_replace('<br/>','<br>',$location); 
$location = str_replace('<BR/>','<br>',$location);  
$location = str_replace('&lt;br/&gt;','<br>',$location);
$location = str_replace('&lt;br /&gt;','<br>',$location);
$location = str_replace('&lt;BR/&gt;','<br>',$location);
$location = str_replace('&lt;BR /&gt;','<br>',$location);


$location = preg_replace('/<br>/', '', $location, 1);
$location = preg_replace('/<BR>/', '', $location, 1);


$contact_name = $cities['0']->contact_name;
$phone_no = $cities['0']->phone_no;
$alternative_phone_no = $cities['0']->alternative_phone_no;

$contact_number = $phone_no;
if(empty($contact_number))
{
	$contact_number = $alternative_phone_no;
}
else
{
	$contact_number = $contact_number."<br>".$alternative_phone_no;
}

	$msg = $wpdb->insert( 
					$table_name, 
					array( 
						'first_name' => $first_name,
						'last_name' => $last_name,
						'phone' => $phone,
						'email' => $email,
						'state' => $eventIds['0']->event_id,
						'appointment_date' => $dates,
						'appointment_time' => $times,
						'time_slot' => $time_slot,
						'interested_in' => $interested,
						'message' => $message,	
						'created_at' => current_time('mysql')
					)
	);
if(!empty($msg)){		
	
	$to = $email;
	//$to = "$email,info@mkennys.com,kenny@mkennys.com";
	
	//$to = "$email,karanjeettr@gmail.com,singhkaranjeet92@gmail.com";
	//$to = "$email,tr.sanjeevtiwari@gmail.com,amanjot@trsoftwaregroup.com";
	
	$from = "info@mkennys.com";
	
	$full_name = ucfirst($first_name).' '.ucfirst($last_name);
		
	if(!empty($_POST['app_id'])){				

		if($timeChange==true)
		{
			$subject = "Custom Fitting Appointment Reschedule for ".$full_name;
		}
		else
		{
			$subject = "Custom Fitting Appointment Updated for ".$full_name;
		}

		
	}else{
		$subject = "Custom Fitting Appointment for ".$full_name;
	}
	$message = "<html><head></head><body>";
	$message .= "<a href='http://www.mkennys.com'><img src='".get_template_directory_uri()."/images/logo.png' alt='' /></a><br>";

	$message .=  "<table border='0' cellspacing='0' cellpadding='0' width='580' style='width:435.0pt'>
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
											<td colspan='2' style='padding:10px 20px'>
												<p style='line-height:12.0pt'><strong><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Hello ".$full_name.",</span></strong><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'></span></p>\r\n";
												
												if(!empty($_POST['app_id'])){

													if($timeChange==true)
													{
														$message .=  "<p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Your custom fitting appointment with <span style='font-weight:bold'>True Fitted by M. Kenny's</span> has been rescheduled.</span></p>\r\n";
													}
													else
													{
														$message .=  "<p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Your custom fitting appointment with <span style='font-weight:bold'>True Fitted by M. Kenny's</span> has been updated.</span></p>\r\n";
													}
														
												}else{
												$message .=  "<p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Thank you for your interest in <span style='font-weight:bold'>True Fitted by M. Kenny's</span>. Your appointment is confirmed with us. \r\n<br>Please keep us apprised of any cancellations so we may inform our staff.<br>Should there be any changes or scheduling conflicts on our end, we will do our absolute best to accommodate you or reschedule.</span></p>\r\n";	
												}
												
												

								$message .="</td>
										</tr>
										<tr>
											<td  colspan='2'></td>
										</tr>
										<tr>

	<td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Appointment Confirmation:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;border-top:solid #ddd6b5 1.0pt;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$first_name." ".$last_name."</span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Phone:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'><a href='tel:".$phone."' target='_blank'>".$phone."</a></span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Email:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'><a href='mailto:".$email."' target='_blank'>".$email."</a></span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Interested In:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$interested."</span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Date and time:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$dates.", ".$times." </span></b></p></td></tr><tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Location:</span></b></p><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$location."</span></b></td></tr>

		<tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Contact:</span></b></p><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'>

		<b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$contact_name."
		<br>
		".$contact_number."
		</span></b>

		</td></tr>

	<tr><td width='40%' style='width:40.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>Message:</span></b></p></td><td width='60%' style='width:60.0%;border:none;border-bottom:solid #ddd6b5 1px;background:#FFF;padding:10px 20px'><p class='MsoNormal'><b><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>".$_POST['samessage']."</span></b></p></td></tr><tr><td colspan='2' style='border:none;border-bottom:solid #d6d6d6 1px;background:#f0f0f0;padding:5px 20px'><p style='line-height:12.0pt'><span style='font-size:9.0pt;font-family:Verdana,sans-serif;'>\r\nIf this is your first time with us, it is helpful to wear your best fitting suit, shirt and dress shoes.\r\n Our representatives will provide their input and carry several thousand fabrics to help you individualize your own look. Please feel free to e-mail us at info@mkennys.com with any further inquiries.\r\n Thank you and we look forward to meeting with you.</span></p></td></tr><tr style='color:#000!important;'>
		<td colspan='2' style='padding:10px 20px'><p><span style='font-weight:bold;font-size: 12px; font-family:Verdana, sans-serif; color: #222;'>Thanks,</span><br><span style='font-weight:bold;font-size: 12px; font-family:Verdana, sans-serif; color: #222;'>True Fitted by M. Kenny's</span><br><span style='font-size: 12px;font-weight:bold; font-family:Verdana, sans-serif; color: #222;'>Irvine, CA.</span><br><a style='font-weight:bold;color:#15c' href='mailto:info@mkennys.com'>info@mkennys.com</a><br><a style='font-weight:bold;color:#15c' href='http://www.mkennys.com'>www.mkennys.com</a><br><a style='font-weight:bold;color:#15c' href='tel:(714)%20573-2199' value='+17145732199' target='_blank'>+1 714 573 2199</a>
    		</p></td>
    </tr></tbody></table></td></tr>

	</tbody>

	</table>	
	

	</td></tr>

	</tbody>

	</table></body></html>";
  $headers = "Mkenny: Sender Mkenny\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "Cc: Kenny@mkennys.com,info@mkennys.com" . "\r\n";  
 // $headers .= "Cc: karanjeettr@gmail.com,sanjeevtrgroup@outlook.com" . "\r\n";  
  $headers .= "From:  True Fitted by M Kennys <" .$from. "> \r\n";
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
  
  
$mailinglist=$message;
    
    if( $source == 'upcoming' && $phone ){
        @sendSMS($phone);
    }
	
	if($_POST['answer'] == '1'){
		
		if(wp_mail($to,$subject,$mailinglist,$headers)){
			
			//if(1){
				
				$formData['succMsg']= 'Schedule Appointment has been rescheduled';
				
				$message =json_encode($formData);
				promoMail($first_name,$email);
			}	
			
			echo $message;
		
		
		
	}else{
		
		if($_POST['answer'] == '0'){
			
			$formData['succMsg']= 'Schedule Appointment has been rescheduled';
			$message =json_encode($formData);
			echo $message;
		}else{
			
  
	if(wp_mail($to,$subject,$mailinglist,$headers)){
		//if(1){
			
		$datess = date('Y-m-d', strtotime($_POST['datess']));
		$str =  explode(' ', $_POST['times']);
		$str = explode('.', $str[0]);
		$hour = $str[0];
		$min = $str[1];
		
		$formData['title'] = $first_name.' '.$last_name;
		

		$g_timeFormat = explode(' ', $times);
		$formData['g_timeFormat'] = $g_timeFormat[1];
		


		$formData['datess'] = $datess;
		$formData['hour'] = $str[0];
		$formData['min'] = $str[1];
		
		$_SESSION['startTime']=$_POST['datess'];		
		$_SESSION['startTime_hour']=$str[0];
		$_SESSION['startTime_min']=$str[1];
		
		$timestamp = strtotime($str[0].':'.$str[1]) + 60*30;
		$time = date('H:i', $timestamp);
		$times = explode(':',$time);
		$formData['end_hour']=$times['0'];
		$formData['end_min']=$times['1'];
		if($zones['0']->state_zone){
		  $zoneState=','.$zones['0']->state_zone;	
		}		
		$formData['location']= $singleState.$zoneState.','.$cities['0']->city_name;			
		
		$formData['succMsg']= 'Schedule Appointment data has been saved';		
		
		$_SESSION['location']= $formData['location'];
		$_SESSION['endTime']=$_POST['datess'];
		$_SESSION['timeFormat']=$_POST['times'];
		$_SESSION['endTime_hour']=$times['0'];
		$_SESSION['endTime_min']=$times['1'];		
		$_SESSION['description']=$_POST['samessage'];
		$_SESSION['title']=$formData['title'];
		$_SESSION['email']=$email;	
		$_SESSION['first_name']=$first_name;
		$_SESSION['last_name']=$last_name;
		$_SESSION['phone']=$phone;
		$_SESSION['event_location']=$location;


		$_SESSION['g_timeFormat']=$formData['g_timeFormat'];

		$_SESSION['phone_no']=$phone_no;
		$_SESSION['alternative_phone_no']=$alternative_phone_no;
		$_SESSION['contact_name']=$contact_name;

		$message =json_encode($formData); 
    	  	/* Krish code */
    		global $wpdb;
    		$table_name = $wpdb->prefix.'refer';
    		$part_result = $wpdb->get_results("SELECT * FROM $table_name Where to_email='".$email."' ",ARRAY_A);
                if(count($part_result) > 0){
                	$table_promo = $wpdb->prefix.'promo';
					$result = $wpdb->get_results("SELECT * FROM $table_promo Where email='".$part_result[0]['from_email']."'",ARRAY_A);
					 if(count($result) > 0){
						if($result[0]['status'] == 'Deactive')
						{
							promoMail($first_name,$email);	
						}
					}
        		}
    		/* End of krish code */
		}
		else{
		$message = 'Email sending fail.';
		}
		  echo $message;
		  
		}  
		  
		  
		  
		}		
	}
	exit;
}


function promoMail($name,$email){
	
		global $wpdb;
		$table_name = $wpdb->prefix.'refer';
		
		$part_result = $wpdb->get_results("SELECT * FROM $table_name Where to_email='".$email."' ",ARRAY_A);
		if(count($part_result)!= 0){
			$table_promo = $wpdb->prefix.'promo';
			$result = $wpdb->get_results("SELECT * FROM $table_promo Where email='".$part_result[0]['from_email']."'",ARRAY_A);



				if(count($result) != 0 ){

					$data = array(
					'id' => $result[0]['id'],
					'code' => $result['code'],
					'email' => $result['email'],
					'start_date' => $result['start_date'],
					'end_date' => $result['end_date'],
					'active' => 1,
					);
					//$wpdb->update($table_name, $data, array('id'=>$result[0]['id']));
					
					$to= $part_result[0]['from_email'] ;
					$subject = "Promo Code (MKennys.com)";
					$url = home_url();
					$message = "<html><head></head><body style='font-family:Arial, Helvetica, sans-serif;margin:0; padding:0;' >";
					$message .="<div  style='background: #eaeced;'>
									<div  style='width:700px; margin:0px auto; background: #fff;'>
										
								    	<div style='text-align: center; padding: 20px; background: #fff;'>
								        	<a href='http://mkennys.com/' style='display:inline-block'><img src='".$url."/newsletter-images/logo.png' alt=''></a> 
								        </div>
								        <div><img src='".$url."/newsletter-images/image.jpg'></div>
								        <div style='padding:30px 40px; max-width:500px;margin:0 auto; font-size:17px;'>
								        	<p style='font-size: 17px; font-family:Arial, Helvetica, sans-serif; color: #555;'>Hey ".$part_result[0]['from_name'].",</p>
								            <p style='font-size: 17px; line-height:1.8; font-family:Arial, Helvetica, sans-serif; color: #555;'>Congratulations,Your personalized promo code is ".$result[0]['code'].", please forward this e-mail to <a href='mailto:info@mkennys.com' target='_blank'>info@mkennys.com</a>  to receive a discount on your next purchase..</p>
												
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
					//$from = "karanjeettr@gmail.com,sanjeevtrgroup@outlook.com";
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Bcc:info@mkennys.com' . "\r\n";
					 // $headers .= 'Bcc:singhkaranjeet92@gmail.com,karanjeettr@gmail.com' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= "From:  True Fitted by M Kennys <" .$from. "> \r\n" .
					"X-Mailer: PHP/" . phpversion();
					$mail=wp_mail($to,$subject,$message,$headers);
				}
		}
	}




?>
