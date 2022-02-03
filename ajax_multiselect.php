<?php
require_once('wp-load.php');
global $wpdb;
$scheduleDate = array();
$datess=array();
$stsId = array();
$city ='';
$cityData=array();
$timeData=array();
$statezone=array();
$stateid_new_arr=array();
$citydrp='';
//$eventId = $_POST['eventId'];


$state_id = $_POST['state_id'];
$stateid_arr = explode(",",$state_id);
 
 
for($i=0;$i<=count($stateid_arr)-1;$i++){
	
	$stateid_new_arr[]="'".$stateid_arr[$i]."'";
} 

$state_id = implode(",",$stateid_new_arr);

$query = "select event_id,count(event_id) as eventCount from wp_schedule_event_state where state_id in (".$state_id.") and is_delete ='1' GROUP by event_id";

$records =$wpdb->get_results($query);







//echo count($records['0']->eventCount);exit;

 //if(($records['0']->eventCount)>1){
	
foreach($records as $record){
	
	$query = "select event_id,count(event_id) as eventCount from wp_schedule_event_state
	where event_id ='".$record->event_id."' and is_delete ='1'";					
	$recordMultiple =$wpdb->get_results($query);
	
	  if( ($record->eventCount>1) && ($record->eventCount == $recordMultiple['0']->eventCount)){		
		$evntId[] = "'".$record->event_id."'";	
		$prevId['0'] = $record->event_id;	
	  }
}
	
 $inId = implode(",",$evntId);
 
if($inId){
	
$schedule_event_state_sql = "select wp_schedule_events.id as schdule_eventId,wp_schedule_events.city_name,wp_schedule_event_state.id as schedule_stateId,wp_schedule_event_state.event_id,wp_schedule_event_state.state_id,
wp_schedule_event_state.statezone_id,adt.id as schedule_dateTimeId,adt.start_date,
adt.start_time,adt.end_time 
from wp_schedule_events,wp_schedule_event_state,wp_statezone,wp_appointment_date_time adt WHERE adt.start_date = (SELECT max(adt2.start_date) FROM wp_appointment_date_time adt2 WHERE adt2.event_id = adt.event_id) 
and wp_schedule_events.id IN(".$inId.") and wp_schedule_events.id=wp_schedule_event_state.event_id and wp_schedule_events.id=adt.event_id and wp_schedule_events.status='1' and
wp_schedule_events.is_delete='1' and wp_schedule_event_state.status='1' and wp_schedule_event_state.is_delete='1' and adt.status='1' and adt.is_delete='1' group by wp_schedule_events.id";
$schedules = $wpdb->get_results($schedule_event_state_sql);	
$event_id=array();
$prevZone ="";
$zoneCounter = 0;
$selectedZoneId = 0;

	 foreach($schedules as $schedule){
		 
		$startdate_arr = explode("/",$schedule->start_date);
		$sdate = $startdate_arr[2]."-".$startdate_arr[0]."-".$startdate_arr[1];
		$today = date("Y-m-d");
					
		if($today<=$sdate){
			
			$event_id[] =$schedule->schdule_eventId;	
			$stsId[]= $schedule->state_id;
			$statezone[]= $schedule->statezone_id;
			$scheduleDate[]= $schedule->start_date;			
			 if($cmpId == $schedule->schdule_eventId){
			 
			 }else{
			
			 $selectedZoneId = $schedule->statezone_id;
			 $city .= '<option data-zone="'.$schedule->statezone_id.'" value="'.$schedule->schdule_eventId.'">';
			 $city .= $schedule->city_name;
			 $city .='</option>';
			
			}	
			$cmpId = $schedule->schdule_eventId;
			
		}
		 
		
		 
		 
		 
	 }

		 $query = "SELECT start_date FROM  wp_appointment_date_time where event_id =".$event_id['0'];	
			$schedulesDates = $wpdb->get_results($query);
			foreach($schedulesDates as $schedDate){
			$startdate_arr = explode("/",$schedDate->start_date);
			$sdate = $startdate_arr[2]."-".$startdate_arr[0]."-".$startdate_arr[1];
			$today = date("Y-m-d");					
			if($today<=$sdate){
				$datess[]= $schedDate->start_date;
			}
		}
	 
		$event_id=array_unique($event_id);	
		$stsId=array_unique($stsId);		
		$statezone=array_unique($statezone);		
	    $scheduleDate = array_unique($scheduleDate);
	
		
	
  $table_appointment_date_time = $wpdb->prefix . 'appointment_date_time';
  $query="select * from $table_appointment_date_time where event_id='".$event_id['0']."' and start_date='".$scheduleDate['0']."'";	
  $appointment_date_time_rec = $wpdb->get_results($query);
  $start_time=''; 
  $end_time='';
  $counter=0;
 // print_r($appointment_date_time_rec);
  
   $start = strtotime($appointment_date_time_rec[0]->start_time);
   $end   = strtotime($appointment_date_time_rec[0]->end_time);
   
   
   
   $query = "select appointment_time from wp_schedule_appointment where state ='".$state_id."' and appointment_date='".$scheduleDate['0']."' order by id asc"; 
	$appointment_times = $wpdb->get_results($query);	
	$appointTimes=array();
	foreach($appointment_times as $apptime){
		$appointTimes[] = $apptime->appointment_time;
		
	}   
  
  $appointment_timesData='';
  
   for($i=$start;$i<=$end;$i+=1800){ 
        
		
		if(in_array(date('h.i A', $i), $appointTimes)){
				$appointment_timesData .='<option value="'.date('h.i A', $i).'" style="text-decoration:line-through" disabled>'.date('h.i A', $i).'</option>';
			}else{
				$appointment_timesData .='<option value="'.date('h.i A', $i).'">'.date('h.i A', $i).'</option>';
			}		
    }

    $timeData[] = $appointment_timesData;
	$cityData[] = $city;
		
	echo json_encode(array('status'=>true, 'dates'=>$datess,'times'=>$timeData,'city'=>$cityData));
}
else{
	echo json_encode(array('status'=>true, 'dates'=>$datess,'times'=>$timeData,'city'=>$cityData));
}
exit;



/*

 if( strpos($state_id, ',') !== false )
 {
    // echo "MUltiple is here";
 }






$table_zone= $wpdb->prefix ."statezone";				
$sql="select * from $table_zone where is_delete='1' and state_id='".$state_id."'  ORDER BY `ID` ASC";
$retrievedata=$wpdb->get_results($sql);	
$zone='';
$ids='';
if( count($retrievedata[0]->id) == 1){

		$zone .='<option value="">None</option>';
													
				foreach($retrievedata as $retrieved_data){									
					   $selected = '';	

					   $query = "select * from wp_schedule_event_state where state_id='".$state_id."' and statezone_id ='".$retrieved_data->id."'";					   
					   $stateZoneId = $wpdb->get_results($query);
					   if ($retrieved_data->id == $stateZoneId['0']->statezone_id ) {
							$selected = "selected = 'selected'";
						}
						$zone .= '<option value="'.$retrieved_data->id.'" '.$selected.' >';
						$zone .= $retrieved_data->state_zone;
						$zone .='</option>';
				}
				
				
						 
				/* 
				 $query = "select * from wp_schedule_events where id ='".$eventId->id."'";
				 $citiesData = $wpdb->get_results($query);				 
				 foreach($citiesData as $cData){
					 
				 $citydrp .= '<option value="'.$cData->id.'">';
				 $citydrp .= $cData->city_name;
				 $citydrp .= '</option>';	
					 
				 }
				 
				 
			  $date_query = "select * from wp_appointment_date_time where event_id='".$eventId->id."' and is_delete='1'";
			 
			  $dates_data = $wpdb->get_results($date_query);
			  foreach($dates_data as $date_data){				  
				   $scheduleDate[]= $date_data->start_date;
			  }
			  */
				 
		/*	
				
			$cityArrayData[] = $citydrp; 	
			$zones[] = $zone;
			
			
			 $scheduleDate = array_unique($scheduleDate);
			
			
	echo  json_encode(array('status'=>true,'stateZone'=>$zones,'dates'=>$scheduleDate,'city'=>$cityArrayData));		
	exit;		
}

/*

else{
	
	
	
	$zone .='<option value="">Not Available</option>';
	
	$schedule_event_state_sql = "select wp_schedule_events.id as schdule_eventId,wp_schedule_events.city_name,wp_schedule_event_state.id as schedule_stateId,wp_schedule_event_state.event_id,wp_schedule_event_state.state_id,
	wp_schedule_event_state.statezone_id,wp_appointment_date_time.id as schedule_dateTimeId,wp_appointment_date_time.start_date,
	wp_appointment_date_time.start_time,end_time
	from wp_schedule_events,wp_schedule_event_state,wp_appointment_date_time
	WHERE wp_schedule_events.id='".$eventId."' and wp_schedule_events.id=wp_schedule_event_state.event_id and wp_schedule_events.id=wp_appointment_date_time.event_id and wp_schedule_events.status='1' and
	wp_schedule_events.is_delete='1' and wp_schedule_event_state.status='1' and wp_schedule_event_state.is_delete='1' and wp_appointment_date_time.status='1' and wp_appointment_date_time.is_delete='1'";
    $schedules = $wpdb->get_results($schedule_event_state_sql);	
	$event_id=array();
	$cmpId='';
	 foreach($schedules as $schedule){
		 
		 $event_id[] =$schedule->schdule_eventId;	
		 $stsId[]= $schedule->state_id;
		 $city[]= $schedule->city_name;		 
		 $scheduleDate[] = $schedule->start_date;
		 
		  if($cmpId == $schedule->schdule_eventId){
			 
		 }else{
			 $citydrp .= '<option value="'.$schedule->schdule_eventId.'">';
			 $citydrp .= $schedule->city_name;
			 $citydrp .='</option>';
		 }
		 $cmpId=$schedule->schdule_eventId;
		 
		 
	 }		
	 
		$event_id=array_unique($event_id);	
		$stsId=array_unique($stsId);
		$cityArrayData[]=$citydrp;		
		if(!empty($scheduleDate['0'])){
			$scheduleDate = array_unique($scheduleDate);			
		}
	    
		$zones[] = $zone;
		//print_r($scheduleDate);
		
	echo json_encode(array('status'=>true, 'dates' => $scheduleDate,'event_id' =>$event_id,'city' =>$cityArrayData,'stateZone'=>$zones));
	exit;
}
*/

?>