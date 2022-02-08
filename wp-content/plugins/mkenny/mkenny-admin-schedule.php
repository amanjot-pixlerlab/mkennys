<?php
$msg='';
$msg_existing='';
$results='';

function addSchedule($data){	
	global $wpdb;
	
	//echo "<pre>";
	//print_r($data);
	
	$table_name = $wpdb->prefix .'schedule_events';	
	$table_schedule_state = $wpdb->prefix . 'schedule_event_state';		
	$table_appointment_date_time = $wpdb->prefix . 'appointment_date_time';	
	
	if(count($data['multi_state']) == '1'){
		
		$state_id = trim(esc_attr($data['multi_state']['0']));
	}
		
	$state_zone = trim(esc_attr($data['state_zone']));	
	$city_name = trim(esc_attr($data['city_name']));
	$suite = trim(esc_attr($data['suite']));	
	$location = trim(esc_attr($data['location']));
	
	/*
	$start_date = trim(esc_attr($data['start_date']));
	$end_date = trim(esc_attr($data['end_date']));	
	$start_time_forstart_date = trim(esc_attr($data['start_time_forstart_date']));	
	$end_time_forstart_date = trim(esc_attr($data['end_time_forstart_date']));
	$start_time_forend_date = trim(esc_attr($data['start_time_forend_date']));
	$end_time_forend_date = trim(esc_attr($data['end_time_forend_date']));	
	$end_time = trim(esc_attr($data['end_time']));
	*/
	
	$contact_name   = trim(esc_attr($data['contact_name']));
	$phone_number   = trim(esc_attr($data['phone_number']));	
	$alternative_phone_number = trim(esc_attr($data['alternative_phone_number']));
	
	
	
	$upcoming_visit = trim(esc_attr($data['upcoming_visit']));
	$status = trim(esc_attr($data['status']));
	
	
	
	//#wp_schedule_events insertion
		 $msg=$wpdb->insert(                
			$table_name, 
			array( 
				'city_name' => $city_name,	
				'location' => $location,				
				'contact_name' => $contact_name,
				'phone_no' => $phone_number,
				'alternative_phone_no' => $alternative_phone_number,
				'upcoming_event' => $upcoming_visit,
				'status' => $status,
				'created_at' => current_time( 'mysql' ),
				'suite' => $suite,
			) 
		);
	//#wp_schedule_events insertion
	
	//wp_schedule_event_state
	if(!empty($msg)){
		
		$event_id = $wpdb->insert_id;		
		
		if(isset($data['state_zone'])){
		
				$wpdb->insert( 
					$table_schedule_state, 
					array( 
						'event_id' => $event_id,	
						'state_id' => $state_id,				
						'statezone_id' => $data['state_zone'],				
						'status' => $status,
						'created_at' => current_time('mysql'),
					) 
				);
		
			
			
		}elseif(count($data['multi_state'])>1){
			
			foreach($data['multi_state'] as $key => $multistate){
		
				$wpdb->insert( 
					$table_schedule_state, 
					array( 
						'event_id' => $event_id,	
						'state_id' => $multistate,				
						'statezone_id' => $statzone,				
						'status' => $status,
						'created_at' => current_time('mysql'),
					) 
				);
		
			}
			
		}else{
			
			$wpdb->insert( 
					$table_schedule_state, 
					array( 
						'event_id' => $event_id,	
						'state_id' => $state_id,				
						'statezone_id' => $statzone,				
						'status' => $status,
						'created_at' => current_time('mysql'),
					) 
				);
			
		}
		
		
		
		if(is_array($data['start_date'])){			
		     $total = count($data['start_date'])-1;
			 for($i=0;$i<$total;$i++){
				 
				 $wpdb->insert( 
					$table_appointment_date_time, 
					array( 
						'event_id' => $event_id,	
						'start_date' => $data['start_date'][$i],				
						'start_time' => $data['start_time'][$i],				
						'end_time' => $data['end_time'][$i],
						'status' => $status
					) 
				);
			 }			 
		}
		
		$_SESSION['scheduleAdd']="Schedule saved successfully";
		
	}
	//#wp_schedule_event_state	
}

if(isset($_POST['submit'])){
addSchedule($_POST);
}

function getScheduleById($id){
	global $wpdb;
	$table_name = $wpdb->prefix .'schedule_events';	
	$table_schedule_state = $wpdb->prefix . 'schedule_event_state';	
	
	
	$sql="select * from $table_name,$table_schedule_state WHERE $table_name.id=$id and $table_name.id=$table_schedule_state.event_id";
	$results = $wpdb->get_results($sql);
	
	
	
    	
	return $results;
	
	
}

if(isset($_POST['update_schedule'])){
update($_POST,$_GET['eid']);
}

function update($data,$id){
	global $wpdb;
	
	$table_name = $wpdb->prefix .'schedule_events';	
	$table_schedule_state = $wpdb->prefix . 'schedule_event_state';	
	$table_appointment_date_time = $wpdb->prefix . 'appointment_date_time';
	
	if(count($data['multi_state']) == '1'){
		
		$state_id = trim(esc_attr($data['multi_state']['0']));
	}	
	$state_zone = trim(esc_attr($data['state_zone']));	
	$city_name = trim(esc_attr($data['city_name']));	
	$suite = trim(esc_attr($data['suite']));
	$location = trim(esc_attr($data['location']));	
	$contact_name = trim(esc_attr($data['contact_name']));
	$phone_number = trim(esc_attr($data['phone_number']));
	
	$alternative_phone_number = trim(esc_attr($data['alternative_phone_number']));
	
	
	
	
	$upcoming_visit = trim(esc_attr($data['upcoming_visit']));
	$status = trim(esc_attr($data['status']));
	
	
	
	 $sql="UPDATE $table_name SET 
			city_name = '".$city_name."',
			suite = '".$suite."',				
			location = '".$location."',
			contact_name = '".$contact_name."',
			phone_no = '".$phone_number."',			
			alternative_phone_no = '".$alternative_phone_number."',
			upcoming_event = '".$upcoming_visit."',
			status = '".$status."'				
			WHERE id=".$id;			
	
	if($wpdb->query($sql)){
			
		$_SESSION['scheduleAdd']="Schedule event updated successfully";	
		
	}	
	
	    $query = "select * from $table_schedule_state where event_id='".$id."'";
		$schedule_state_record = $wpdb->get_results($query);	
		
		
		if($data['state_zone']){
			
			$query="delete from $table_schedule_state WHERE event_id =".$id;	
			$wpdb->query($query);
				
				$wpdb->insert( 
					$table_schedule_state, 
					array( 
						'event_id' => $id,	
						'state_id' => $state_id,				
						'statezone_id' => $state_zone,				
						'status' => $status,
						'created_at' => current_time('mysql'),
					) 
				);
				
			$_SESSION['scheduleAdd']="Schedule event updated successfully";	
		}elseif(count($data['multi_state'])>1){
			
							
			$query="delete from $table_schedule_state WHERE event_id =".$id;	
			$wpdb->query($query);
			
			foreach($data['multi_state'] as $key => $multistate){
				
				 $wpdb->insert( 
					$table_schedule_state, 
					array( 
						'event_id' => $id,	
						'state_id' => $multistate,				
						'statezone_id' => $statzone,				
						'status' => $status,
						'created_at' => current_time('mysql'),
					) 
				);
			}
			$_SESSION['scheduleAdd']="Schedule event updated successfully";	
			
		}else{
			   $query="delete from $table_schedule_state WHERE event_id =".$id;	
			   $wpdb->query($query);		
			    $wpdb->insert( 
					$table_schedule_state, 
					array( 
						'event_id' => $id,	
						'state_id' => $state_id,				
						'statezone_id' => $state_zone,				
						'status' => $status,
						'created_at' => current_time('mysql'),
					) 
				);			
			  $_SESSION['scheduleAdd']="Schedule event updated successfully";
		}
		
		if(is_array($data['start_date'])){	

			 $query="delete from $table_appointment_date_time WHERE event_id =".$id;	
			 $wpdb->query($query);		
		
		     $total = count($data['start_date'])-1;
			 for($i=0;$i<$total;$i++){
				 
				 $wpdb->insert( 
					$table_appointment_date_time, 
					array( 
						'event_id' => $id,	
						'start_date' => $data['start_date'][$i],				
						'start_time' => $data['start_time'][$i],				
						'end_time' => $data['end_time'][$i],
						'status' => $status
					) 
				);
			 }			 
		}	
		
		
	
}

if(isset($_GET['did'])){
	
	global $wpdb;
	
	$table_name = $wpdb->prefix .'schedule_events';	
	$table_schedule_state = $wpdb->prefix . 'schedule_event_state';	
	$table_appointment_date_time = $wpdb->prefix . 'appointment_date_time';
	$id = $_GET['did'];
	
	
	$sql_events="UPDATE $table_name SET 
			is_delete='0' WHERE id=".$id;
	if($wpdb->query($sql_events)){		
			$sql_schedule_event_state="UPDATE $table_schedule_state SET 
			is_delete='0' WHERE event_id=".$id;	
			$wpdb->query($sql_schedule_event_state);			
			$sql_date_time="UPDATE $table_appointment_date_time SET 
			is_delete='0' WHERE event_id=".$id;
			$wpdb->query($sql_date_time);
			
			$_SESSION['scheduleAdd']="Schedule event deleted successfully";
	}

}

function get_times( $default,$interval = '+30 minutes' ) {

    $output = '';

    $current = strtotime( '00:00' );
    $end = strtotime( '23:59' );

    while( $current <= $end ) {
        //$time = date( 'H:i', $current );
		 $time = date( 'h.i A', $current );			
		
        $sel = ( $time == $default ) ? ' selected' : '';
		
		
        $output .= "<option value=\"{$time}\"{$sel}>" . date( 'h.i A', $current ) .'</option>';
        $current = strtotime( $interval, $current );
    }

    return $output;
}


?>
<div class="wrap">
<h1>Schedule</h1>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="<?php echo site_url() ?>/wp-content/plugins/mkenny/css/fSelect.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo site_url() ?>/wp-content/plugins/mkenny/css/jquery-ui.css"> 
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery-1.12.4.js"></script>  
<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery-ui.js"></script>
<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery.validate.min.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=4pp7ra3703laaarld82m839r88o5j1p6rvqot0c6ixoftwic"></script>

<script>tinymce.init({ selector:'textarea'});</script>
<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery.tablesorter.js"></script>
<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/query-latest.js"></script>



  
<script type="text/javascript">
var previous='';
    jQuery(document).ready(function() {
      jQuery(".add-more").click(function(){ 
          var html = jQuery(".copy").html();
		 
          jQuery(".after-add-more").before(html);
		 
		  jQuery('.datepicker').off('click');
		  jQuery('.datepicker').click(function(){


			setTimeout(function(){
				previous = jQuery(this).parent().prev().find('.datepicker').val();
			},500);
		   
		  //console.log(date);
		  
		  		  
	  });
	 
      });
      jQuery("body").on("click",".remove",function(){ 
          jQuery(this).parents(".control-group").remove();
      });
	  
	
	  
	  
    });
	
	//Datepicker code
	  
	  jQuery(document).on("focus",".datepicker", function(){
		 // console.log(previous);
		  previous = jQuery(this).parent().prev().find('.datepicker').val();
		//  alert(previous);
		  if(typeof(previous)  == "undefined"){
			  previous = 0;
		  }
		 
			jQuery(this).datepicker({minDate: previous});
		});	 
</script>

<?php
 if(isset($_SESSION['scheduleAdd'])){
?>
	<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
		<p><strong><?php echo $_SESSION['scheduleAdd'];  ?>.</strong></p>
		<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
	</div>

<?php 
unset($_SESSION['scheduleAdd']);
}

?>

<form method="post" action=" " novalidate="novalidate" id="schedule" class="date-time-control-group">
<?php
$getScheduleById = getScheduleById($_GET['eid']);
?>

	<table class="form-table">
		<tbody>
		
		
			<?php
			if(count($getScheduleById)==0){
			?>	
			<tr class="multistate">
				<th scope="row"><label for="multi_state">State Name</label></th>
				<td class="state_name">														
						<select class="demo" multiple="multiple" name="multi_state[]" id ="multi_state" style="width:25em;" class="regular-text">
							<optgroup label="Please Select State Name">														
								<?php 
									global $wpdb;
									$table_name = $wpdb->prefix . "state";				
									$sql="select * from $table_name where is_delete='1' and status='1' ORDER BY `ID` ASC";
									$retrievedata=$wpdb->get_results($sql);								
									
									foreach($retrievedata as $retrieved_data){
									?>		
									<option value="<?php echo $retrieved_data->id;?>" ><?php echo $retrieved_data->state_name;?>, <?php echo $retrieved_data->state_short;?></option>
									<?php	
									}
								?>
							   
							</optgroup>
							
						</select>																	
				</td>
			</tr>
			
				
				
			<?php	
				
			}else{
				
			?>	
				
			<tr class="multistate">
				<th scope="row"><label for="multi_state">State Name </label></th>
				<td class="state_name">
						<select class="demo" multiple="multiple" name="multi_state[]" id ="multi_state" style="width:25em;" class="required regular-text">
							<optgroup label="Please Select State Name">
							
							
								<?php 
									global $wpdb;
									$table_name = $wpdb->prefix . "state";				
									$sql="select * from $table_name where is_delete='1' and status='1' ORDER BY `ID` ASC";
									$retrievedata=$wpdb->get_results($sql);
									$i=0;
									foreach($retrievedata as $retrieved_data){										
										   $selected = '';
											if($getScheduleById[$i]->state_id == $retrieved_data->id){												
												$selected = "selected = 'selected'";													
												$i=$i+1;	
											}
											
									?>		
									<option value="<?php echo $retrieved_data->id;?>" <?php echo $selected; ?>  ><?php echo $retrieved_data->state_name;?>, <?php echo $retrieved_data->state_short;?></option>
									<?php	
									}
								?>
							   
							</optgroup>
							
						</select>
						<!--<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>-->
						
					
				</td>
			</tr>	
				
				
			<?php	
			}
			
			?>			
			
			<tr><td></td><td><span id="zones"></span></td></tr>
			
			<tr class="sz">
				
			</tr>
			<tr>
				<th scope="row"><label for="city_name">City Name</label></th>
				<td>
					<input type="text"  name="city_name" id="city_name" class="regular-text" value="<?php echo $getScheduleById[0]->city_name ?>">				
				</td>
			</tr>			
			<tr>
				<th scope="row"><label for="suite">Suite#:</label></th>
				<td>
				<?php
				if(count($getScheduleById)==0){
				?>
				<input type="text"  name="suite" id="suite" class="regular-text" value="<?php echo $getScheduleById[0]->suite ?>">				
				<?php	
				}else{
					if($getScheduleById[0]->suite == ''){
						$getScheduleById[0]->suite='';
					}
					
				?>	
				<input type="text"  name="suite" id="suite" class="regular-text" value="<?php echo $getScheduleById[0]->suite ?>">				
				<?php	
				}
				?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="location">Location</label></th>
				<td style="float:left;width:631px;">
					<?php //echo do_shortcode(tinymce) ?>
					<textarea rows="10" cols="5" name="location" id="location" class="regular-text">
					<?php echo $getScheduleById[0]->location ?></textarea>					
				</td>
				
			</tr>
			
			<?php
			if(count($getScheduleById)==0){
			?>			
			<tr>			
				<th scope="row"><label for="addmore">Date Time</label></th>			
				<td>
					<div class="input-group control-group date-time-control-group">
					
					  <span class="date">Date</span><input type="text" name="start_date[]" class="datepicker" value="">Start Time<select name="start_time[]" id="start_time" class="required"> <?php echo get_times('10.00 AM'); ?></select>End Time<select name="end_time[]" id="end_time"><?php echo get_times('08.00 PM'); ?></select>	
					  <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i></button>
					</div>
					<div class="after-add-more"></div>
					<div class="copy hide">
					  <div class="control-group input-group" style="margin-top:10px">
						Date<input type="text" name="start_date[]" class="datepicker">
						Start Time<select name="start_time[]" id="start_time"><?php echo get_times('10.00 AM'); ?></select>	
						End Time<select name="end_time[]" id="end_time"><?php echo get_times('08.00 PM'); ?></select>
						  <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
					  </div>
					</div>					
				</td>
				
			</tr>
			
			<?php
			}else{
			?>
			<tr>			
				<th scope="row"><label for="addmore">Date Time</label></th>			
				<td>				
					<?php
					  if(isset($_GET['eid'])){
						  global $wpdb;
						  $table_appointment_date_time = $wpdb->prefix . 'appointment_date_time';
						  $query="select * from $table_appointment_date_time where event_id=".$_GET['eid'];	
					      $appointment_date_time_rec = $wpdb->get_results($query);
						  $start_time=''; 
						  $end_time='';
						  $counter=0;
						  foreach( $appointment_date_time_rec as $rec){
						  ?>  
						  <div class="input-group control-group date-time-control-group">
												 
						Date<input type="text" name="start_date[]" class="datepicker" value="<?php echo $rec->start_date; ?>">Start Time<select name="start_time[]" id="start_time" class="required"> <?php echo get_times($rec->start_time); ?></select>End Time<select name="end_time[]" id="end_time"><?php echo get_times($rec->end_time); ?></select>
						
							<?php
							 if($counter==0){
							?>
							<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i></button>	
							<?php	
							 }else{
							?>	 
							<button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
							
							<?php	 
							 }	
								
							$counter=$counter+1;	
							?>
						
						 
					</div>
						  
					<?php							  
						}						  
					}
					?>
				
				
				
					
					
					
					
					
					<div class="after-add-more"></div>
					<div class="copy hide">
					  <div class="control-group input-group" style="margin-top:10px">
						Date<input type="text" name="start_date[]" class="datepicker">
						Start Time<select name="start_time[]" id="start_time"><?php echo get_times($rec->start_time); ?></select>	
						End Time<select name="end_time[]" id="end_time"><?php echo get_times($rec->end_time); ?></select>
						  <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
					  </div>
					</div>					
				</td>
				
			</tr>
			
				
			<?php	
			}
			?>
			
			
			
			<tr>			
				<th scope="row"><label for="contact_name">Contact Name</label></th>
				<td>
					<input type="text" name="contact_name" id="contact_name" class="regular-text" value="<?php echo $getScheduleById[0]->contact_name ?>">				
				</td>
			</tr>
			
			<tr>			
				<th scope="row"><label for="phone_number">Phone Number</label></th>
				<td>
					<input type="text" name="phone_number" id="phone_number" class="regular-text" value="<?php echo $getScheduleById[0]->phone_no ?>">				
				</td>
			</tr>
			
			
			<tr>			
				<th scope="row"><label for="phone_number">Alternative Phone Number</label></th>
				<td>
					<input type="text" name="alternative_phone_number" id="alternative_phone_number" class="regular-text" value="<?php echo $getScheduleById[0]->alternative_phone_no ?>">				
				</td>
			</tr>
			
			
			
			<tr style="display:none;">
				<th scope="row"><label for="phone_number">Upcoming Visit</label></th>
				<?php if(count($getScheduleById)==0){
				?>
				<td>
					<select name="upcoming_visit" id="upcoming_visit"  class="regular-text">								
						<option value="1">Active</option>
						<option value="0">Inactive</option>
					</select>
				</td>
				
				<?php
				}else{
				?>
				<td>
					<select name="upcoming_visit" id="upcoming_visit"  class="regular-text">
								
						<option value="1" <?php  if($getScheduleById[0]->upcoming_event == '1' ){ ?> selected="selected" <?php } ?>>Active</option>
						<option value="0" <?php  if($getScheduleById[0]->upcoming_event == '0' ){ ?> selected="selected" <?php } ?>>Inactive</option>
					</select>
				</td>
				
				<?php	
				}
				
				?>
				
			</tr>
			
			
			
			<tr>
				<th scope="row"><label for="shortname">Status</label></th>
				<?php if(count($getScheduleById)==0){
				?>
				
				<td>
					<select name="status" id="status"  class="regular-text">
						<option value="">Please Select Status</option>					
						<option value="1">Enable</option>
						<option value="0">disable</option>
					</select>
				</td>
					
				<?php
				}else{
				?>
				
				<td>
					<select name="status" id="status"  class="regular-text">
						<?php 
						$selected='';					 
						?>
						<option value="">Please Select Status</option>
						<option value="1" <?php  if($getScheduleById[0]->status == '1' ){ ?> selected="selected" <?php } ?>>Enable</option>
						<option value="0" <?php  if($getScheduleById[0]->status == '0' ){ ?> selected="selected" <?php } ?>>disable</option>
					</select>
				</td>
				<?php
				}
				?>
				
			</tr>	
			
		</tbody>
	</table>
	<?php
	
	if(count($getScheduleById)==0){
	 ?>
	 <p class="submit"><input name="submit" id="submit" class="button button-primary" value="Save Schedule" type="submit"></p>
	<?php	
	}else{
	?>
	<p class="submit"><input name="update_schedule" id="submit" class="button button-primary" value="Update Schedule" type="submit"></p>
	<?php	
	}	
	?>
	
	
	

	
	
</form>

</div>

<!--- Show State Name --->

<div class="wrap">

<script type="text/javascript">
  function newDoc()
  {
  var e = document.getElementById("sorting_state");
  var state = e.options[e.selectedIndex].value;
  // alert(e); return false;
  window.location.assign('?page=mkenny-admin-schedule.php&sorting='+state)
  }
</script>


<?php //echo count($getScheduleById['1']);exit; 


//echo "<pre>";
//echo $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//print_r($_SERVER);
?>
	<h1 style="float:left;width:300px;">Schedule Listing</h1>
	<div style="float:right;display:block;width:212px;margin-bottom: 10px;">
	<h4>Sorting</h4>
	<form name="frm_sorting_state"  id="frm_sorting_state" method="post" action="" >
	<select name="sorting_state" id="sorting_state" onchange="newDoc()">
	<option value="">state</option>	
		<?php
		global $wpdb;
		$sorting_query = "SELECT * from {$wpdb->prefix}state";
		$sorting_states = $wpdb->get_results($sorting_query);
		$sorting_selected="";
		foreach($sorting_states as $sortingState){
			$sorting_selected="";
			if($_REQUEST['sorting'] == $sortingState->id){
				$sorting_selected="selected='selected'";
				
			}
			
		?>	
			
			<option value="<?php echo $sortingState->id ?>" <?php echo $sorting_selected; ?> ><?php echo $sortingState->state_name; ?></option>	
		<?php	
		}
		?>
	</select>	
	<input type="submit" style="display:none;" />
	</form>
	</div>
	<table class="form-table tablesorter" id="myTable" border="1">
	   <thead>
		
			<tr>
			<?php
			$sorting_order = '';
			  if($_GET['order'] == ''){
				  $sorting_order = 'desc';
			  }
			  if($_GET['order'] =='asc'){
				  $sorting_order = 'desc';
			  }
			  if($_GET['order'] == 'desc'){
				  $sorting_order = 'asc';
			  }
			  
			?>
			
				<th class="header">State</th>
				<th>City</th>
				<th>Location</th>		
				<th>Start Date</th>
				<th>Start Time</th>
				<th>End Time</th>			
				<th>Contact</th>
				<th>Phone Number</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		 </thead>
		 <tbody>
	<?php
		
		global $wpdb;
		$schedule_event_state = $wpdb->prefix . 'schedule_event_state';
	    $schedule_events = $wpdb->prefix . 'schedule_events';
		
		$state = $wpdb->prefix . 'state';
		
		$statezone = $wpdb->prefix . 'statezone';
		
		
		
		
		
		$retrieve_data = $wpdb->get_results("SELECT * FROM $schedule_events where is_delete='1'");
		
		$k=1;
//pagination
$page_name=get_option('siteurl')."/wp-admin/admin.php?page=mkenny-admin-schedule.php";
		$start=$_GET['start'];
			if(strlen($start) > 0 && !is_numeric($start)){
			echo "Data Error";
			exit;
			}
			$eu = ($start - 0); 
			$limit = 5;                               
			$this1 = $eu + $limit;			
			$back = $eu - $limit; 
			$next = $eu + $limit; 

$nume=count($retrieve_data);

$sql="select wp_schedule_events.id,wp_schedule_event_state.event_id,
COUNT(wp_schedule_event_state.event_id) as mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_statezone.state_zone,wp_schedule_events.location, wp_schedule_events.contact_name,wp_schedule_events.phone_no,wp_schedule_events.upcoming_event, wp_schedule_events.status,wp_appointment_date_time.start_date,wp_appointment_date_time.start_time,
wp_appointment_date_time.end_time from wp_schedule_event_state
LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id
LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id
LEFT JOIN wp_state ON wp_state.id = wp_schedule_event_state.state_id
LEFT JOIN wp_appointment_date_time ON wp_appointment_date_time.event_id = wp_schedule_events.id
where wp_schedule_events.is_delete='1' and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1'
and wp_appointment_date_time.is_delete='1' 
GROUP BY wp_schedule_event_state.event_id having mult_id>0 order by CONCAT(SUBSTRING(wp_appointment_date_time.start_date, 7, 4),SUBSTRING(wp_appointment_date_time.start_date, 1, 2),SUBSTRING(wp_appointment_date_time.start_date, 4, 2)) desc limit $eu, $limit";

if($_REQUEST['sorting'] != '' && isset($_REQUEST['sorting'])){
	
$sql="select wp_schedule_events.id,wp_schedule_event_state.event_id,
COUNT(wp_schedule_event_state.event_id) as mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_statezone.state_zone,wp_schedule_events.location, wp_schedule_events.contact_name,wp_schedule_events.phone_no,wp_schedule_events.upcoming_event, wp_schedule_events.status,wp_appointment_date_time.start_date,wp_appointment_date_time.start_time,
wp_appointment_date_time.end_time from wp_schedule_event_state
LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id
LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id
LEFT JOIN wp_state ON ".$_REQUEST['sorting']." = wp_schedule_event_state.state_id
LEFT JOIN wp_appointment_date_time ON wp_appointment_date_time.event_id = wp_schedule_events.id
where wp_schedule_events.is_delete='1' and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1'
and wp_appointment_date_time.is_delete='1' 
GROUP BY wp_schedule_event_state.event_id having mult_id>0 order by CONCAT(SUBSTRING(wp_appointment_date_time.start_date, 7, 4),SUBSTRING(wp_appointment_date_time.start_date, 1, 2),SUBSTRING(wp_appointment_date_time.start_date, 4, 2)) desc limit $eu, $limit";	
	
}

if( $_GET['order'] != '' && isset($_GET['order']) ){
	
$sql="select wp_schedule_events.id,wp_schedule_event_state.event_id,
COUNT(wp_schedule_event_state.event_id) as mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_statezone.state_zone,wp_schedule_events.location, wp_schedule_events.contact_name,wp_schedule_events.phone_no,wp_schedule_events.upcoming_event, wp_schedule_events.status,wp_appointment_date_time.start_date,wp_appointment_date_time.start_time,
wp_appointment_date_time.end_time from wp_schedule_event_state
LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id
LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id
LEFT JOIN wp_state ON wp_state.id = wp_schedule_event_state.state_id
LEFT JOIN wp_appointment_date_time ON wp_appointment_date_time.event_id = wp_schedule_events.id
where wp_schedule_events.is_delete='1' and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1'
and wp_appointment_date_time.is_delete='1' 
GROUP BY wp_schedule_event_state.event_id having mult_id>0 order by wp_schedule_events.id,wp_state.state_name ".$_GET['order']." limit $eu, $limit";
}

/*
$sql="select wp_schedule_events.id,wp_schedule_event_state.event_id,
COUNT(wp_schedule_event_state.event_id) as mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_statezone.state_zone,wp_schedule_events.location, wp_schedule_events.contact_name,wp_schedule_events.phone_no,wp_schedule_events.upcoming_event, wp_schedule_events.status,wp_appointment_date_time.start_date,wp_appointment_date_time.start_time,
wp_appointment_date_time.end_time from wp_schedule_event_state
LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id
LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id
LEFT JOIN wp_state ON wp_state.id = wp_schedule_event_state.state_id
LEFT JOIN wp_appointment_date_time ON wp_appointment_date_time.event_id = wp_schedule_events.id
where wp_schedule_events.is_delete='1' and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1'
and wp_appointment_date_time.is_delete='1' 
GROUP BY wp_schedule_event_state.event_id having mult_id>0 order by wp_schedule_events.id asc limit $eu, $limit";

if($_REQUEST['sorting'] != '' && isset($_REQUEST['sorting'])){
	
$sql="select wp_schedule_events.id,wp_schedule_event_state.event_id,
COUNT(wp_schedule_event_state.event_id) as mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_statezone.state_zone,wp_schedule_events.location, wp_schedule_events.contact_name,wp_schedule_events.phone_no,wp_schedule_events.upcoming_event, wp_schedule_events.status,wp_appointment_date_time.start_date,wp_appointment_date_time.start_time,
wp_appointment_date_time.end_time from wp_schedule_event_state
LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id
LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id
LEFT JOIN wp_state ON ".$_REQUEST['sorting']." = wp_schedule_event_state.state_id
LEFT JOIN wp_appointment_date_time ON wp_appointment_date_time.event_id = wp_schedule_events.id
where wp_schedule_events.is_delete='1' and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1'
and wp_appointment_date_time.is_delete='1' 
GROUP BY wp_schedule_event_state.event_id having mult_id>0 order by wp_schedule_events.id asc limit $eu, $limit";	
	
}

if( $_GET['order'] != '' && isset($_GET['order']) ){
	
$sql="select wp_schedule_events.id,wp_schedule_event_state.event_id,
COUNT(wp_schedule_event_state.event_id) as mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_statezone.state_zone,wp_schedule_events.location, wp_schedule_events.contact_name,wp_schedule_events.phone_no,wp_schedule_events.upcoming_event, wp_schedule_events.status,wp_appointment_date_time.start_date,wp_appointment_date_time.start_time,
wp_appointment_date_time.end_time from wp_schedule_event_state
LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id
LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id
LEFT JOIN wp_state ON wp_state.id = wp_schedule_event_state.state_id
LEFT JOIN wp_appointment_date_time ON wp_appointment_date_time.event_id = wp_schedule_events.id
where wp_schedule_events.is_delete='1' and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1'
and wp_appointment_date_time.is_delete='1' 
GROUP BY wp_schedule_event_state.event_id having mult_id>0 order by wp_schedule_events.id,wp_state.state_name ".$_GET['order']." limit $eu, $limit";
}
*/
	$tour_schedulings = $wpdb->get_results($sql);

	if($_REQUEST['sorting'] != '' && isset($_REQUEST['sorting'])){
		
		$nume=count($tour_schedulings);
	}


	

	
				
	$touScheduling='';
	$endDate='';
	$startDate='';
	$ids=array();
	
	if(count($tour_schedulings)>0){
	
	
	foreach ($tour_schedulings as $retrieved_data){	

				if($retrieved_data->mult_id>1){
							
					$sql="select  wp_state.id,wp_state.state_name from wp_state,wp_schedule_event_state
					where wp_schedule_event_state.state_id = wp_state.id 
					and wp_schedule_event_state.event_id ='".$retrieved_data->event_id."'";
					$multistates=$wpdb->get_results($sql);	
					$state ='';
					$total = count($multistates)-1;
					foreach($multistates as $key=>$multistate){
						if($total == $key){
							$state .= $multistate->state_name;
						}else{
							 $state .= $multistate->state_name.'/';
						}
						 
						
					}
				
				
				}

	
	?>	
			<tr>
				<?php 
					if($retrieved_data->mult_id>1){
				?>		
					<td><?php echo $state?></td>	
				<?php		
				}else{
				?>	
					<td><?php echo $retrieved_data->state_name ?></td>
				<?php	
				}

				?>					
				<td><?php echo $retrieved_data->city_name;?></td>
				<td><?php echo htmlspecialchars_decode($retrieved_data->location);?></td>
				<td><?php echo $retrieved_data->start_date;?></td>
				<td><?php echo $retrieved_data->start_time;?></td>
				<td><?php echo $retrieved_data->end_time;?></td>				
				<td><?php echo $retrieved_data->contact_name;?></td>				
				<td><?php echo $retrieved_data->phone_no;?></td>				
				<td><?php if($retrieved_data->status == '1'){echo "Enable";}else{ echo "Disable";}?></td>
				<td><a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-schedule.php&eid=<?php echo $retrieved_data->event_id;?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Pencil.png" title="edit	 state"/></a>&nbsp;
				<a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-schedule.php&did=<?php echo $retrieved_data->event_id;?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Delete.png" title="delete state"/></a></td>
			</tr>
	    <?php 	
	     $k++;
	   }
	}else{
		
		echo "<tr><td colspan='10'><center><b>Schedule event not found</b></center></td></tr>";
		
	}
	
	?>	
			
			
		</tbody>
	</table>
	
<div style="clear:both;"></div>

<?php 
if($nume > $limit ){ 

echo "<table align = 'center' width='50%'><tr><td  align='left' width='30%'>";


if($back >=0) { 
print "<a href='$page_name&start=$back'><font face='Verdana' size='2'>PREV</font></a>"; 
} 


echo "</td><td align=center width='30%'>";
$i=0;
$l=1;
for($i=0;$i < $nume;$i=$i+$limit){
if($i <> $eu){
echo " <a href='$page_name&start=$i'><font face='Verdana' size='2'>$l</font></a> ";
}
else { echo "<font face='Verdana' size='4' color=red>$l</font>";}        /// Current page is not displayed as link and given font color red
$l=$l+1;
}


echo "</td><td  align='right' width='30%'>";
///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
if($this1 < $nume) { 
print "<a href='$page_name&start=$next'><font face='Verdana' size='2'>NEXT</font></a>";} 
echo "</td></tr></table>";

}// end of if checking sufficient records are there to display bottom navigational link. 

?>	
	

</div>
<!-- #Show State Name --->

<style>

table.tablesorter thead tr .headerSortUp {
	background-image: url(<?php echo site_url() ?>/wp-content/plugins/mkenny/images/asc.gif);
	background-repeat: no-repeat;
	 background-color: #3399FF; 
}
table.tablesorter thead tr .headerSortDown {
	background-image: url(<?php echo site_url() ?>/wp-content/plugins/mkenny/images/desc.gif);
	background-repeat: no-repeat;
	 background-color: #3399FF; 
}
th.header { 
   background-image: url(<?php echo site_url() ?>/wp-content/plugins/mkenny/images/bg.gif);
    cursor: pointer; 
    font-weight: bold; 
    background-repeat: no-repeat; 
    background-position: center left; 
    padding-left: 20px; 
    border-right: 1px solid #dad9c7; 
    margin-left: -1px; 
} 
</style>

<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/fSelect.js"></script>
<script type="text/javascript">
	jQuery(function(){
		jQuery('.demo').fSelect();
		
		if('<?php echo $getScheduleById[0]->statezone_id ?>'){
	
		//alert('<?php echo $getScheduleById[0]->statezone_id ?>');
		window.statezone = '<?php echo $getScheduleById[0]->statezone_id; ?>';
		//alert(window.statezone);
		
	}
	});
</script>

<script type="text/javascript">
jQuery(document).ready(function () {

	jQuery('.notice-dismiss').on('click',function(){
		window.location ="<?= home_url() ?>/wp-admin/admin.php?page=mkenny-admin-schedule.php";
	});

    jQuery('#schedule').validate({ // initialize the plugin
	ignore: [],
        rules: {
            "multi_state[]":{
			 required: true
            },
			
			status: {
                required: true,
            },
			
			"start_date[]":{
				required: true,
			},
			
			"start_time[]":{
				required: true,
			},
			"end_time[]":{
				required: true,
			},
			
			upcoming_visit: {
                required: true,
            },
			
			city_name: {
                required: true,
            }
			
        }
    });
	
	//send this value and get state zone.
	
	

jQuery("#myTable").tablesorter( {headers: { 1: { sorter: false}, 2: {sorter: false},3: {sorter: false},4: {sorter: false},
5: {sorter: false},6: {sorter: false},7: {sorter: false},8: {sorter: false},9: {sorter: false},} }); 
   
 	
	
	
});

</script>
