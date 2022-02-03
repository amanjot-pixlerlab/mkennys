<div class="wrap">
	<span id="ucities"> </span>
		<table class="form-table" border="1">
		<tbody>
			<tr>
				<th>State</th>						
				<th>City</th>
				<th>Location</th>
				<th>Suite</th>
				<th>Dates</th>
				<th>Contact</th>
				<th>Phone Number</th>
				<th>Action</th>
				
				
				
					
			</tr>
<?php		
global $wpdb;
$hidden_state='';
$sql="select  wp_appointment_date_time.start_date, wp_schedule_events.id, wp_schedule_event_state.event_id, 
(select count(*) from wp_schedule_event_state s where s.event_id=wp_schedule_event_state.event_id) mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_schedule_events.suite,wp_statezone.state_zone, wp_schedule_events.location,wp_schedule_events.contact_name, wp_schedule_events.phone_no,wp_schedule_events.alternative_phone_no, wp_schedule_events.upcoming_event,wp_schedule_events.status
from wp_schedule_event_state LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id LEFT JOIN wp_state ON wp_state.id = wp_schedule_event_state.state_id
LEFT JOIN wp_appointment_date_time ON wp_schedule_event_state.event_id = wp_appointment_date_time.event_id
where wp_schedule_events.status='1'
and wp_schedule_events.is_delete='1' and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1'and wp_schedule_event_state.status='1' and wp_state.status='1'
GROUP BY wp_schedule_event_state.event_id having mult_id>0 order by state_zone,state_name,start_date";

$tour_schedulings = $wpdb->get_results($sql);					
				
	$touScheduling='';
	$endDate='';
	$startDate='';
				
				
	$ids=array();
	$multi_state=array();
	$previous_event_id = '';
	$i=0;
	foreach ($tour_schedulings as $tour_scheduling){
		$hidden_state='';
		$hidden_zone='';
		$today = date("Y-m-d");
		$lastsql="select adt.start_date as lastDate from wp_appointment_date_time adt WHERE adt.start_date = (SELECT max(adt2.start_date) FROM wp_appointment_date_time adt2 WHERE adt2.event_id='".$tour_scheduling->event_id."')";
		$lastDate = $wpdb->get_results($lastsql);
		$lastdate = date("Y-m-d", strtotime($lastDate['0']->lastDate));	
		
		if($today<$lastdate){

		
		echo '<tr>';
				
				if($tour_scheduling->mult_id>1){
							
					 $sql="select wp_state.id,wp_state.state_name,state_short from wp_state,wp_schedule_event_state
					where wp_schedule_event_state.state_id = wp_state.id 
					and wp_schedule_event_state.event_id ='".$tour_scheduling->event_id."' and wp_schedule_event_state.state_id !='".$stsid."'";
					$multistates=$wpdb->get_results($sql);	
					$state ='';
					$state_mult='';
					$mult_state='';
					$total = count($multistates)-1;
					foreach($multistates as $key=>$multistate){
					$mult_state .= ucfirst($multistate->state_name).','. ucfirst($multistate->state_short).' ';				
						if($total == $key){
							$state .= $multistate->state_name;
							$state_mult .= $tour_scheduling->stateId;
						}else{
							 $state .= $multistate->state_name.'<span>/</span>';
							 $state_mult .= $tour_scheduling->stateId;
						}
						 
						
					}
				
				  $tour_scheduling->stateId='';
				}
				$multi_state[]= $state;
				$multi_state = array_unique($multi_state);
				 				 
				if($tour_scheduling->mult_id>1){

				$hidden_state .= '<span class="hidden_state" style="display:none;">'.$mult_state.'</span>';						
					//$touScheduling .='<div class="tourList clearfix" id="state_mult_'.$tour_scheduling->stateId.'">';
				}
				else{
					//$touScheduling .='<div class="tourList clearfix" id="state_'.$tour_scheduling->stateId.'">';
				}
				 
				 if($tour_scheduling->mult_id>1){
					 if($same_multi[0]==$state){
						echo '<td data-id="'.$state_mult.'">'. strtoupper($state).'</td>';
						
						   
					 }else{
						 	
						  echo '<td data-id="'.$state_mult.'">'. strtoupper($state).'</td>';
						
					 }
					 $same_multi[0]=$state; 
				 }
				 elseif($tour_scheduling->state_zone == ''){
					
					 
					 
					 if($tour_scheduling->state_name == $previous_state){
						// $stateincremented = $stateincremented +1; 
						 echo '<td data-id="'.$tour_scheduling->stateId.'">'. strtoupper($tour_scheduling->state_name).'</td>';
						 $hidden_state = '<span class="hidden_state" style="display:none;">'.ucfirst($tour_scheduling->state_name).','. ucfirst($tour_scheduling->state_short).'</span>';						 
						 
					 }else{
						 //$stateincremented = 1;
						 
						echo '<td data-id="'.$tour_scheduling->stateId.'">'. strtoupper($tour_scheduling->state_name).'</td>';
						$hidden_state = '<span class="hidden_state" style="display:none;">'.ucfirst($tour_scheduling->state_name).','. ucfirst($tour_scheduling->state_short).'</span>';						 
					 }
					 
					
					 
					 
				 }else{
					 if($zone == $tour_scheduling->state_zone){
						echo '<td data-id="'.$tour_scheduling->stateId.'">'.strtoupper($tour_scheduling->state_zone) .'</td>';
						$hidden_state = '<span class="hidden_state" style="display:none;">'.ucfirst($tour_scheduling->state_name).','. ucfirst($tour_scheduling->state_short).'</span>';
						$hidden_zone = '<span class="hidden_zone" style="display:none;">'.ucfirst($tour_scheduling->state_zone) .'</span>';

						
					 }else{
							echo '<td data-id="'.$tour_scheduling->stateId.'">'.strtoupper($tour_scheduling->state_zone) .'</td>';
							$hidden_state = '<span class="hidden_state" style="display:none;">'.ucfirst($tour_scheduling->state_name).','. ucfirst($tour_scheduling->state_short).'</span>';	
						$hidden_zone = '<span class="hidden_zone" style="display:none;">'.ucfirst($tour_scheduling->state_zone) .'</span>';							
					 }
					 
					 
				 }	
							
							echo '<td>'.$tour_scheduling->city_name.'</td>';	
							echo '<td>'.htmlspecialchars_decode($tour_scheduling->location).'</td>';
							echo '<td>'.htmlspecialchars_decode($tour_scheduling->suite).'</td>';
							
						
						$query="select * from wp_appointment_date_time where event_id = '".$tour_scheduling->event_id."'   order by `start_date` asc ";		
						
						
						
					      $dateTime_rec = $wpdb->get_results($query);
						  $eventDate = "";
						  $dayName = "";
						  $eventMonth = "";
						  $futureData = false;
						  $prevMonth = "";
						  $dateCounter = 0;
						  $last_key = end(array_keys($dateTime_rec));
						  foreach($dateTime_rec as $key=>$dateTime){
							  
							  
							    $get_fited='';							  
							    $startdate_arr = explode("/",$dateTime->start_date);
								$sdate = $startdate_arr[2]."-".$startdate_arr[0]."-".$startdate_arr[1];
								$app_schedule_date = $sdate;
								$sdate = date("F j l", strtotime($sdate));							
							    $today = date("Y-m-d");
								$startDate=explode(" ",$sdate);																$lastsql="select adt.start_date as lastDate from wp_appointment_date_time adt WHERE adt.start_date = (SELECT max(adt2.start_date) FROM wp_appointment_date_time adt2 WHERE adt2.event_id='".$tour_scheduling->event_id."')";
								$lastDate = $wpdb->get_results($lastsql);
								$lastdate = date("Y-m-d", strtotime($lastDate['0']->lastDate));	
								
								if($today<=$lastdate){
								
								
								$futureData = true;			
								
								if($prevMonth!=$startDate['0'])
								{
									if($dateCounter>0)
									{
										$eventMonth .= " & ";
										
										if($dateTime->end_time != '08.00 PM'){									
											$specialDate .= 'On'.' '.$startDate['1'].' '.'till'.' '.$dateTime->end_time;
										}
										
									}
									$eventMonth .= $startDate['0'].'  '.$startDate['1'];
								}
								else
								{
									if($dateCounter>0)
									{
										$eventMonth .= " & ".$startDate['1'];
										
										if($dateTime->end_time != '08.00 PM'){									
											$specialDate .= 'On'.' '.$startDate['2'].' '.'till'.' '.$dateTime->end_time;
										}
									}
									else {
										$eventMonth .= $startDate['0'].'  '.$startDate['1'];
									}
								}
								
								if($dateCounter>0)
								{
									$eventDate .= " & ";
									$dayName .= " & ";
								}
								$eventDate .= $startDate['1'];
								
								$dayName .= $startDate['2'];
								
								$prevMonth = $startDate['0'];
								//$touScheduling = $startDate['0'].' '.$startDate['1'].'<br/>'.$startDate['2'];
								
							
							}
							
							$dateCounter++;
							  
						  }
						  
						 
						  if( $futureData )
							{
								echo  "<td>".$eventMonth."<br>".$dayName."<br>".$specialDate."</td>";
							}
							
							
							
							
							
							
							echo '<td>'.$tour_scheduling->contact_name.'</td>';
							
							if($tour_scheduling->alternative_phone_no != ''){
								$alternative_phone_no = ", ".$tour_scheduling->alternative_phone_no;
							}
							if($tour_scheduling->alternative_phone_no == '0'){
								$alternative_phone_no = '';
							}
							
							echo '<td>'.$tour_scheduling->phone_no.$alternative_phone_no.'</td>';
								echo '<td>';
								echo '<a href="javascript:void(0)" id="'.$tour_scheduling->event_id.'" class="notify_people">Notify People';
									echo '<span class="hidden_suite" style="display:none;">'.$tour_scheduling->suite.'</span>';
									echo '<span class="hidden_city" style="display:none;">'.$tour_scheduling->city_name.'</span>';	
									echo '<span class="hidden_phone_no" style="display:none;">'.$tour_scheduling->phone_no.'</span>';
									echo '<span class="hidden_alternate_no" style="display:none;">'.$tour_scheduling->alternative_phone_no.'</span>';
									//echo $tour_scheduling->location;
									//$tour_scheduling->location = preg_replace('/\r|\n/', '', $tour_scheduling->location);
					          $sloc = str_replace('&lt;p', '&lt;p style="margin-top:0px;margin-bottom:0px;"', $tour_scheduling->location);
					         $sloc = preg_replace('/\r|\n/', '', $sloc);
									echo '<span class="hidden_location" style="display:none;">'.$sloc.'</span>';
									echo $hidden_state;
									echo $hidden_zone;
									echo '</a>';
								
								echo '</td>';
								
							$alternative_phone_no ='';								
							
							
							
							
							
					
					
				$zone = $tour_scheduling->state_zone;
				$previous_state=$tour_scheduling->state_name;
				$previous_event_id = $tour_scheduling->event_id;
			$specialDate='';
	$i++;			
	

	
	echo '</tr>';
	
	}		
	
	
	}
	
		
	
?>	
		
			
			
		</tbody>
	</table>
	
	<div class="calenderOverlay CityAvailability" style="display:none;">
	<div class="calenderInner">
		<p></p>
		<a href="javascript:;" class="CityAvailabilityClose">Close</a>
	</div>
  </div>
	
	
	
    </div>
	



<!-- #Show State Name --->

<style>
.tableContainer { 
	overflow-x: auto;
}
.calenderOverlay{
    background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
    height: 100%;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1;
}
.calenderInner{
    background: #ffffff none repeat scroll 0 0;
    border-radius: 3px;
    font-size: 20px;
    font-weight: 300;
    left: 50%;
    max-width: 100%;
    padding: 40px;
    position: absolute;
    text-align: center;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
}
.calenderInner a {
    background: #cccccc none repeat scroll 0 0;
    border-radius: 3px;
    display: inline-block;
    font-size: 17px;
    font-weight: 400;
    margin-top: 20px;
    padding: 7px 30px;
	text-decoration:none;
	color:#000;
	font-weight: 600;
}

p{
	border: 0 none;
	font-family: inherit;
	font-size: 100%;
	font-style: inherit;
	font-weight: inherit;
	margin: 0;
	outline: 0 none;
	padding: 0;
	vertical-align: baseline;	
}
#ucities{
	background: #2c3e50 url("<?php echo site_url() ?>/wp-content/plugins/mkenny/images/loading.gif") no-repeat scroll center center;
	border-radius: 50%;
	display: inline-block;
	height: 130px;
	left: 50%;
	padding: 0;
	position: fixed;
	top: 50%;
	transform: translate(-50%, -50%);
	width: 130px;
	z-index: 100000088;
}
</style>
<script>
(function($){
  jQuery("#ucities").hide();  
  var $table = $(".form-table");
  
  $table.find("tr").each(function(){
    
    var $td = $(this).find("td:first-child");
   if($td.length <= 0 ){ return; }
    
    var $tds = $table.find("td[data-id='"+ $td.attr("data-id") +"']");
    if($tds.length <= 1){
      return;
    }
    
    var first = true;
    $tds.each(function(){
      if(first){
        $(this).attr("rowspan",$tds.length);
        first = false;
        return;
      }
      $(this).remove();
    });
    
  });
  
  /*sent email to notify people on the base of event id*/
  jQuery(".notify_people").click(function(){
	  
	  console.log(jQuery(this).find(".hidden_suite").eq(0).text());
	  var eventId = jQuery(this).attr("id");
	  
	  var suite = jQuery(this).find(".hidden_suite").eq(0).text();
	  if(suite.length == 0){
		  suite = "TBD (Please contact us for further information)";
	  }
	  
	  var city = jQuery(this).find(".hidden_city").eq(0).text();
	  var phone_no = jQuery(this).find(".hidden_phone_no").eq(0).text();
	  var alternate_no = jQuery(this).find(".hidden_alternate_no").eq(0).text();
	  var state = jQuery(this).find(".hidden_state").eq(0).text();
	  var zone = jQuery(this).find(".hidden_zone").eq(0).text();
	  if(zone.length>0){
		  
		  state = state+' '+','+' '+zone;
	  }
	  var sloc = jQuery(this).find(".hidden_location").eq(0).text();
	 // var strloc = jQuery(sloc).text();
			
		

	  
	  
	  
	  jQuery.ajax({
			 url: '<?php echo site_url() ?>/wp-content/plugins/mkenny/ajax_notify_people.php',
			 type: 'POST',
			 data:'eventid='+eventId+'&suite='+suite+'&city='+city+'&phone_no='+phone_no+'&alternate_no='+alternate_no+'&state='+state+'&location='+sloc,			 		 
			 async: false,
			 beforeSend: function() {
				jQuery("#ucities").show();					
			 },
		     success: function(data){
				 
				 //alert(data);
				 if(data == 0){
					 jQuery(".calenderOverlay p").html("No Email Records Found For This Event.");
					 jQuery(".calenderOverlay").css("display","block");
					 
				 }
				 
				 if(data == 1){
					 jQuery(".calenderOverlay p").html("Email Sent Successfuly.");
					 jQuery(".calenderOverlay").css("display","block");
					 
				 }
				 
				/*
				jQuery("#rcData").html(data.msg);
				jQuery(".popup_overlay").fadeOut();	
				jQuery(".popup_overlay3").fadeIn();			
				*/				 
			 },
			 complete: function(){
				jQuery("#ucities").hide();	
			}
	});
	  
	  
  });
  
  /*Close Button code*/
  
  jQuery(".CityAvailabilityClose").click(function(){	  
	   jQuery(".calenderOverlay").hide(); 
  });
  
    
  

})(jQuery);


</script>