<?php
require_once('wp-load.php');
global $wpdb;
$appointment_timesData='';
//$eventId = array();
$eventId = $_POST['eventId'];
$appintment_date = $_POST['appointmentTime'];
$stateId = $_POST['stateId'];



if(!is_numeric($eventId))
{
	echo $appointment_timesData ='<option value="">N/A</option>';
	exit;
}

$query = "select * from wp_schedule_event_state where state_id='".$stateId."' and is_delete ='1'";
$recs =$wpdb->get_results($query);
$evntId=array();


foreach($recs as $rec){
///$eventId[]=	$rec->event_id;
$evntId[] = "'".$rec->event_id."'";	
}

$inId = implode(",",$evntId);

$table_appointment_date_time = $wpdb->prefix . 'appointment_date_time';
$query="select * from $table_appointment_date_time where event_id IN(".$eventId.") and start_date='".$appintment_date."'";	
$appointment_date_time_rec = $wpdb->get_results($query);
$start_time=''; 
$end_time='';
$counter=0;
 // print_r($appointment_date_time_rec);
  
   $start = strtotime($appointment_date_time_rec[0]->start_time);
   $end   = strtotime($appointment_date_time_rec[0]->end_time);
   
   
   
   $query = "select appointment_time from wp_schedule_appointment where state IN(".$eventId.") and appointment_date='".$appintment_date ."' order by id asc"; 
	$appointment_times = $wpdb->get_results($query);	
	$appointTimes=array();
	foreach($appointment_times as $apptime){
		$appointTimes[] = $apptime->appointment_time;
		
	}   
  
 
  $appointment_timesData='';
  
 // $startdate_arr = explode("/",$schedule->start_date);
		// $sdate = $startdate_arr[2]."-".$startdate_arr[0]."-".$startdate_arr[1];

   //$today = date("Y-m-d");
  //if(!empty($appointmentTime) && ($appointmentTime != 'undefined') ){
  
   for($i=$start;$i<=$end;$i+=1800){ 
        
		
		if(in_array(date('h.i A', $i), $appointTimes)){
				$appointment_timesData .='<option value="'.date('h.i A', $i).'" style="text-decoration:line-through" disabled>'.date('h.i A', $i).'</option>';
			}else{
				$appointment_timesData .='<option value="'.date('h.i A', $i).'">'.date('h.i A', $i).'</option>';
			}		
    }
	
	echo $appointment_timesData;
  //}else{
	//  echo $appointment_timesData;
  //}
	
exit;

?>