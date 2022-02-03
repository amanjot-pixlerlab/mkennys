<?php
require_once('wp-load.php');
global $wpdb;
$appointment_timesData='';
$appintment_date = $_POST['appointmentTime'];
$eventId = $_POST['eventId'];
$dataStartTime ='';

  //if(!empty($_POST['appId'])){
				
	$sqlTime="SELECT appointment_time, appointment_date FROM `wp_schedule_appointment` where id='".$_POST['appId']."'";
	$dataStartTime = $wpdb->get_results($sqlTime);
	//$appintment_date = $dataStartTime['0']->appointment_date;
	
 // }
  


  $table_appointment_date_time = $wpdb->prefix . 'appointment_date_time';
  $query="select * from $table_appointment_date_time where event_id='".$eventId."' and start_date='".$appintment_date."'";	
  $appointment_date_time_rec = $wpdb->get_results($query);
  $start_time=''; 
  $end_time='';
  $counter=0;
 // print_r($appointment_date_time_rec);
  
   $start = strtotime($appointment_date_time_rec[0]->start_time);
   $end   = strtotime($appointment_date_time_rec[0]->end_time);
   
   
   
    $query = "select appointment_time from wp_schedule_appointment where state ='".$eventId."' and appointment_date='".$appintment_date ."' order by id asc"; 
	$appointment_times = $wpdb->get_results($query);	
	$appointTimes=array();
	foreach($appointment_times as $apptime){
		$appointTimes[] = $apptime->appointment_time;
		
	}   
  
  $appointment_timesData='';
 


   for($i=$start;$i<=$end;$i+=1800){ 
        
		$selected='';
		if(in_array(date('h.i A', $i), $appointTimes)){
			
			$selected='';
			//echo $dataStartTime['0']->appointment_time;
			//echo $appointTimes[$i];
			//echo date('h.i A', $i);
				
				if($dataStartTime['0']->appointment_time == date('h.i A', $i)){
					//exit("Here");
					$selected="selected='selected'";
					$appointment_timesData .='<option value="'.date('h.i A', $i).'" '.$selected.' >'.date('h.i A', $i).'</option>';					
				}else{					
					//$appointment_timesData .='<option value="'.date('h.i A', $i).'" style="text-decoration:line-through" disabled>'.date('h.i A', $i).'</option>';
				}		
				
				
		
				
			
				
			}else{
				$appointment_timesData .='<option value="'.date('h.i A', $i).'">'.date('h.i A', $i).'</option>';
			}		
    }

echo $appointment_timesData;
	
	
exit;




?>