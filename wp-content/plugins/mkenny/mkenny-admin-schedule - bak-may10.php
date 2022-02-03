<?php
$msg='';
$msg_existing='';
$results='';

function addSchedule($data){
	
	global $wpdb;
	$table_name = $wpdb->prefix .'schedule_events';	
	$table_schedule_state = $wpdb->prefix . 'schedule_event_state';	
	$state_id = trim(esc_attr($data['state_name']));	
	$state_zone = trim(esc_attr($data['state_zone']));	
	$city_name = trim(esc_attr($data['city_name']));	
	$location = trim(esc_attr($data['location']));
	$start_date = trim(esc_attr($data['start_date']));
	$end_date = trim(esc_attr($data['end_date']));	
	$start_time_forstart_date = trim(esc_attr($data['start_time_forstart_date']));	
	$end_time_forstart_date = trim(esc_attr($data['end_time_forstart_date']));
	$start_time_forend_date = trim(esc_attr($data['start_time_forend_date']));
	$end_time_forend_date = trim(esc_attr($data['end_time_forend_date']));
	
	$end_time = trim(esc_attr($data['end_time']));
	
	$contact_name = trim(esc_attr($data['contact_name']));
	$phone_number = trim(esc_attr($data['phone_number']));
	$upcoming_visit = trim(esc_attr($data['upcoming_visit']));
	$status = trim(esc_attr($data['status']));
	
     if(isset($data['multi_state_checkbox']) && ($data['multi_state_checkbox'] == '1')){
		 
			$multi_state_checkbox = trim(esc_attr($data['multi_state_checkbox']));	
	 }else{
		 $multi_state_checkbox = '0';	
	 }	
	
	
	//#wp_schedule_events insertion
		 $msg=$wpdb->insert(                
			$table_name, 
			array( 
				'city_name' => $city_name,	
				'start_date' => $start_date,				
				'end_date' => $end_date,				
				'start_time_forstart_date' => $start_time_forstart_date,
				'end_time_forstart_date' => $end_time_forstart_date,				
				'start_time_forend_date'=> $start_time_forend_date,				
				'end_time_forend_date'=> $end_time_forend_date,				
				'location' => $location,				
				'contact_name' => $contact_name,
				'phone_no' => $phone_number,
				'upcoming_event' => $upcoming_visit,
				'status' => $status,				
				'multi_select' => $multi_state_checkbox,				
				'created_at' => current_time( 'mysql' ),
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
		
			
			
		}elseif(is_array($data['multi_state'])){
			
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
	
	$sql="select * from $table_name,$table_schedule_state  WHERE $table_name.id=$id and $table_schedule_state.event_id=$table_name.id";
	$results = $wpdb->get_results($sql);
	//echo "<pre>";
	//print_r($results);
    return $results;
}

if(isset($_POST['update_schedule'])){
update($_POST,$_GET['eid']);
}

function update($data,$id){
	global $wpdb;
	
	//echo "<pre>";
	//print_r($data);
	
	
	$table_name = $wpdb->prefix .'schedule_events';	
	$table_schedule_state = $wpdb->prefix . 'schedule_event_state';	
	
	
	$state_id = trim(esc_attr($data['state_name']));	
	$state_zone = trim(esc_attr($data['state_zone']));	
	$city_name = trim(esc_attr($data['city_name']));	
	$location = trim(esc_attr($data['location']));
	$start_date = trim(esc_attr($data['start_date']));
	$end_date = trim(esc_attr($data['end_date']));	
	$start_time_forstart_date = trim(esc_attr($data['start_time_forstart_date']));	
	$end_time_forstart_date = trim(esc_attr($data['end_time_forstart_date']));
	$start_time_forend_date = trim(esc_attr($data['start_time_forend_date']));
	$end_time_forend_date = trim(esc_attr($data['end_time_forend_date']));
	$contact_name = trim(esc_attr($data['contact_name']));
	$phone_number = trim(esc_attr($data['phone_number']));
	$upcoming_visit = trim(esc_attr($data['upcoming_visit']));
	$status = trim(esc_attr($data['status']));
	
	if(isset($data['multi_value']) && ($data['multi_value'] == '1')){		 
			$multi_state_checkbox = trim(esc_attr($data['multi_value']));	
	}else{
		 $multi_state_checkbox = '0';	
	}
	
	 $sql="UPDATE $table_name SET 
			city_name = '".$city_name."',
			start_date = '".$start_date."',
			end_date = '".$end_date."',
			start_time_forstart_date = '".$start_time_forstart_date."',		
	        end_time_forstart_date = '".$end_time_forstart_date."', 
	        start_time_forend_date = '".$start_time_forend_date."',
	        end_time_forend_date =  '".$end_time_forend_date."',			
			location = '".$location."',
			contact_name = '".$contact_name."',
			phone_no = '".$phone_number."',
			upcoming_event = '".$upcoming_visit."',
			status = '".$status."',
			multi_select = '".$multi_state_checkbox."'	
			WHERE id=".$id;			
	
	if($wpdb->query($sql)){
			
		$_SESSION['scheduleAdd']="Schedule event updated successfully";	
		
	}	
	
	    $query = "select * from $table_schedule_state where event_id='".$id."'";
		$schedule_state_record = $wpdb->get_results($query);
		//print_r($schedule_state_record);exit;
		
		
		if($data['state_zone']){		
				$query="UPDATE $table_schedule_state SET 
						event_id  = '".$id."',
						state_id = '".$state_id."',
						statezone_id =  '".$data['state_zone']."',
						status = '".$status."'
						WHERE id=".$schedule_state_record['0']->id;	
						
				$wpdb->query($query);
				
			$_SESSION['scheduleAdd']="Schedule event updated successfully";	
		}elseif(is_array($data['multi_state'])){
			
			if(count($data['multi_state']) == '1'){	
				$sql="UPDATE $table_name SET multi_select = '0'	WHERE id=".$id;
				$wpdb->query($sql);
			}
								
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
								
			    $query="UPDATE $table_schedule_state SET 
						event_id  = '".$id."',
						state_id = '".$state_id."',
						statezone_id =  '".$statzone."',
						status = '".$status."'
						WHERE id=".$schedule_state_record['0']->id;	
			$wpdb->query($query);
			
			$_SESSION['scheduleAdd']="Schedule event updated successfully";
		}
	
}

if(isset($_GET['did'])){
	
	
	global $wpdb;
	$table_name = $wpdb->prefix .'schedule_events';	
	$table_schedule_state = $wpdb->prefix . 'schedule_event_state';
	
	$id = $_GET['did'];
	global $wpdb;
	
	$sql="UPDATE $table_name SET 
			is_delete='0' WHERE id=".$id;
	if($wpdb->query($sql)){
		
			$sql="UPDATE $table_schedule_state SET 
			is_delete='0' WHERE id=".$_GET['sid'];			
			
			$_SESSION['scheduleAdd']="Schedule event deleted successfully";
	}

}

function get_times( $default,$interval = '+30 minutes' ) {
//die("Here");
    $output = '';

    $current = strtotime( '00:00' );
    $end = strtotime( '23:59' );

    while( $current <= $end ) {
        $time = date( 'H:i', $current );
        $sel = ( $time == $default ) ? ' selected' : '';
		$time = date( 'h.i A', $current );
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
<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery-1.12.4.js"></script>  
<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery-ui.js"></script>
<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery.validate.min.js"></script>
  
<script type="text/javascript">
	$(document).ready(function (){
	$("#start_date").datepicker();
	$("#end_date").datepicker();
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

<form method="post" action=" " novalidate="novalidate" id="schedule">
<?php
$getScheduleById = getScheduleById($_GET['eid']);
if($getScheduleById[0]->multi_select == '1'){
?>
<input type="hidden" name="multi_value" id="multi_value" value="<?php echo $getScheduleById[0]->multi_select ?>" />

<?php
}
 

//echo "<pre>";
//print_r($getScheduleById);
//exit;


?>

<?php
/*
 if(count($getScheduleById)==0){
?>

    <div style="width:208px;float:left; display:block;margin-left:100px;">
		<h3><input type="checkbox" name="multi_state_checkbox" id="multi_state_checkbox" value="1">Multi Select State</h3>
	</div>
<?php
}

if($getScheduleById[0]->multi_select == '1'){
?>	
<div style="width:208px;float:left; display:block;margin-left:100px;">
		<h3><input type="checkbox" name="multi_state_checkbox" id="multi_state_checkbox" value="1" checked disabled="disabled">Multi Select State</h3>
	</div>
<?php	
}
*/
?>	

	

	<table class="form-table">
		<tbody>
		
			<tr class="multistate">
				<th scope="row"><label for="multi_state">State Name</label></th>
				<td>
					
					
					<div class="container">

						<select class="demo" multiple="multiple" name="multi_state[]" id ="multi_state" style="width:25em;">
							<optgroup label="Please Select State Name">
							
							
								<?php 
									global $wpdb;
									$table_name = $wpdb->prefix . "state";				
									$sql="select * from $table_name where is_delete='1' ORDER BY `ID` ASC";
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
						<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/fSelect.js"></script>
						<script type="text/javascript">
						$(function(){						
							
								$('.demo').fSelect();
								
								
								/*
								
								$(".multistate").hide();
								
								        $('input[type="checkbox"]').click(function(){

											if($(this).prop("checked") == true){
												$("#multi_state").removeAttr('disabled');
												$(".multistate").show();
												$(".singlestate").hide();												
												$(".sz").hide();
												$("#state_name").attr('disabled',true);
												$("#state_zone").attr('disabled',true);
												

											}else{												
												$(".multistate").hide();
												$("#multi_state").attr('disabled',true);
												$(".singlestate").show();
												$(".sz").show();
												$("#state_zone").removeAttr('disabled');
												$("#state_name").removeAttr('disabled');
											}

           
										});
								if($('#multi_state_checkbox').attr('checked')) {
																		
									if($('input[type="checkbox"]').prop("checked") == true){
										
												$("#state_name").attr('disabled',true);
												 $("#state_zone").prop('disabled', true);
												//$("#state_zone").attr('disabled',true);
												$("#multi_state").removeAttr('disabled');
												$(".multistate").show();
												$(".singlestate").hide();												
												$(".sz").hide();
											}else{												
												$(".multistate").hide();
												$("#multi_state").attr('disabled',true);
												$(".singlestate").show();
												$(".sz").show();
												$("#state_zone").removeAttr('disabled');
												$("#state_name").removeAttr('disabled');
											}
								} 
								
								if(window.multi_select=='0'){
									
									$(".multistate").hide();
									$("#multi_state").attr('disabled',true);
								}
								*/
								
							});
						</script>
					</div>
				</td>
			</tr>
			<?php
			/*
			?>
			<tr class="singlestate">
				<th scope="row"><label for="state_name">State Name</label></th>
				
				<?php if(count($getScheduleById)==0){
				?>
					<td>
					<select name="state_name" id="state_name"  class="regular-text">
						<option value="">Please Select State Name</option>		
						<?php 
						global $wpdb;
						$table_name = $wpdb->prefix . "state";				
						$sql="select * from $table_name where is_delete='1' ORDER BY `ID` ASC";
						$retrievedata=$wpdb->get_results($sql);
						
						foreach ($retrievedata as $retrieved_data){
						?>		
						<option value="<?php echo $retrieved_data->id;?>" <?php echo $selected; ?>  ><?php echo $retrieved_data->state_name;?>, <?php echo $retrieved_data->state_short;?></option>
						<?php	
						}
						?>
					</select>
				</td>
				
				<?php
				}else{
				?>	
				
				<td>
					<select name="state_name" id="state_name"  class="regular-text">
						<option value="">Please Select State Name</option>		
						<?php 
						global $wpdb;
						$table_name = $wpdb->prefix . "state";				
						$sql="select * from $table_name where is_delete='1' ORDER BY `ID` ASC";
						$retrievedata=$wpdb->get_results($sql);
						
						foreach ($retrievedata as $retrieved_data){
							$selected = '';
							if($getScheduleById[0]->state_id == $retrieved_data->id){
								
								$selected = "selected = 'selected'";
								
							}
							
							
						?>		
						<option value="<?php echo $retrieved_data->id;?>" <?php echo $selected; ?>  ><?php echo $retrieved_data->state_name;?>, <?php echo $retrieved_data->state_short;?></option>
						<?php	
						}
						?>
					</select>
				</td>
					
				<?php	
				}
				
				?>
				
				
				
			</tr>
			<?php */ ?>
			<tr><td></td><td><span id="zones" style=" background-image: url('<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/loading.gif');height: 85px; width: 103px;display:block;"></span></td></tr>
			
			<tr class="sz">
				
			</tr>
			<tr>
				<th scope="row"><label for="city_name">City Name</label></th>
				<td>
					<input type="text"  name="city_name" id="city_name" class="regular-text" value="<?php echo $getScheduleById[0]->city_name ?>">				
				</td>
			</tr>
			
			
			<tr>
				<th scope="row"><label for="location">Location</label></th>
				<td>					
					<textarea rows="4" cols="50" name="location" id="location" class="regular-text"><?php echo $getScheduleById[0]->location ?></textarea>					
				</td>
				
			</tr>
		
		  
			<tr style="float:left;width:0;">			
				<th scope="row"><label for="start_date">Start Date</label></th>
				<td>
					<input type="text"  name="start_date" id="start_date" value="<?php echo $getScheduleById[0]->start_date ?>">
				</td>
			
			
			
					
				<th scope="row"><label for="start_time_forstart_date">Start Time(For Start date)</label></th>
				
				<?php			   			
			    if(count($getScheduleById)==0){
			   ?>
			 
				<td width="30">
					<!--<input type="text"  name="start_time" id="end_time" class="regular-text" value="<?php //echo $getScheduleById[0]->start_time ?>">-->				
					<select name="start_time_forstart_date">
						<?php echo get_times('10:00'); ?>
					</select>	
				</td>
			 
			 
			  <?php	
			    }else{
					$start_time_forstart_date_arr = explode('.',$getScheduleById[0]->start_time_forstart_date);
					$start_time_forstart_date =$start_time_forstart_date_arr['0'].':'.substr($start_time_forstart_date_arr['1'],0,-3);
			  ?>
				<td width="30">		
				
					<!--<input type="text"  name="start_time" id="end_time" class="regular-text" value="<?php //echo $getScheduleById[0]->start_time ?>">-->				
					<select name="start_time_forstart_date">
						<?php echo get_times($start_time_forstart_date); ?>
					</select>	
				</td>
			  
			 <?php		
			  }	
			  ?>
						
				<th scope="row"><label for="end_time_forstart_date">End Time(For Start date)<?php echo $getScheduleById[0]->end_time; ?></label></th>
				<?php			   			
			    if(count($getScheduleById)==0){
				?>
				<td>
					<!--<input type="text"  name="end_time" id="end_time" class="regular-text" value="<?php //echo $getScheduleById[0]->end_time?>">-->				
					<select name="end_time_forstart_date">
						<?php echo get_times($default = '20:00'); ?>
					</select>
				</td>
				<?php
				}else{	
					
					$end_time_forstart_date_arr = explode('.',$getScheduleById[0]->end_time_forstart_date);
					$end_time_forstart_date =$end_time_forstart_date_arr['0'].':'.substr($end_time_forstart_date_arr['1'],0,-3);
					
				?>
				
				<td>
					
					<!--<input type="text"  name="end_time" id="end_time" class="regular-text" value="<?php //echo $getScheduleById[0]->end_time?>">-->				
					<select name="end_time_forstart_date">
						<?php echo get_times($end_time_forstart_date); ?>
					</select>
				</td>
				
				<?php			
					
				}
			   ?>
			</tr>
			
			
			
			<tr style="float:left;width:0;margin-top: 105px;">			
				<th scope="row"><label for="end_date">End Date</label></th>
				<td>
					<input type="text" name="end_date" id="end_date" value="<?php echo $getScheduleById[0]->end_date ?>">				
				</td>
			
			
			
			
					
				<th scope="row"><label for="start_time_forend_date">Start Time(For End date)</label></th>
				
				<?php			   			
			    if(count($getScheduleById)==0){
			   ?>
			 
				<td>
					<!--<input type="text"  name="start_time" id="end_time" class="regular-text" value="<?php //echo $getScheduleById[0]->start_time ?>">-->				
					<select name="start_time_forend_date">
						<?php echo get_times($default = '10:00'); ?>
					</select>	
				</td>
			 
			 
			  <?php	
			    }else{
					
					$start_time_forend_date_arr = explode('.',$getScheduleById[0]->start_time_forend_date);
					$start_time_forend_date =$start_time_forend_date_arr['0'].':'.substr($start_time_forend_date_arr['1'],0,-3);
					
			  ?>
				<td>
					<!--<input type="text"  name="start_time" id="end_time" class="regular-text" value="<?php //echo $getScheduleById[0]->start_time ?>">-->				
					<select name="start_time_forend_date">
						<?php echo get_times($start_time_forend_date); ?>
					</select>	
				</td>
			  
			 <?php		
			  }	
			  ?>
				
				
				
				
				
			
			
						
				<th scope="row"><label for="end_time_forend_date">End Time(For End date)</label></th>
				<?php			   			
			    if(count($getScheduleById)==0){
				?>
				<td>
					<!--<input type="text"  name="end_time" id="end_time" class="regular-text" value="<?php //echo $getScheduleById[0]->end_time?>">-->				
					<select name="end_time_forend_date">
						<?php echo get_times($default = '20:00'); ?>
					</select>
				</td>
				<?php
				}else{
					$end_time_forend_date_arr = explode('.',$getScheduleById[0]->end_time_forend_date);
					$end_time_forend_date =$end_time_forend_date_arr['0'].':'.substr($end_time_forend_date_arr['1'],0,-3);
					
				?>
				
				<td>
					<!--<input type="text"  name="end_time" id="end_time" class="regular-text" value="<?php //echo $getScheduleById[0]->end_time?>">-->				
					<select name="end_time_forend_date">
						<?php echo get_times($end_time_forend_date); ?>
					</select>
				</td>
				
				<?php			
					
				}
			   ?>
			</tr>
			
			
			
			
			
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
				<th scope="row"><label for="phone_number">Upcoming Visit</label></th>
				<?php if(count($getScheduleById)==0){
				?>
				<td>
					<select name="upcoming_visit" id="upcoming_visit"  class="regular-text">
						<option value="">Please Select Status</option>					
						<option value="1">Active</option>
						<option value="0">Inactive</option>
					</select>
				</td>
				
				<?php
				}else{
				?>
				<td>
					<select name="upcoming_visit" id="upcoming_visit"  class="regular-text">
						<option value="">Please Select Status</option>					
						<option value="1" <?php  if($getScheduleById[0]->status == 1 ){ ?> selected="selected" <?php } ?>>Active</option>
						<option value="0" <?php  if($getScheduleById[0]->status == 0 ){ ?> selected="selected" <?php } ?>>Inactive</option>
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
						<option value="1" <?php  if($getScheduleById[0]->status == 1 ){ ?> selected="selected" <?php } ?>>Enable</option>
						<option value="0" <?php  if($getScheduleById[0]->status == 0 ){ ?> selected="selected" <?php } ?>>disable</option>
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
	<h1>Schedule Listing</h1>
	<table class="form-table" border="1">
		<tbody>
			<tr>
				<th>State</th>
				<th>City</th>
				<th>Location</th>				
				<th>Start Date</th>
				<th>Start Time(For Start Date)</th>
				<th>End Time(For Start Date)</th>
				<th>End Date</th>
				<th>Start Time(For End Date)</th>
				<th>End Time(For End Date)</th>
				<th>Contact</th>
				<th>Number</th>
				<th>Upcoming Visit</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
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

$sql="select wp_schedule_events.id, wp_schedule_event_state.event_id,
COUNT(wp_schedule_event_state.event_id) as mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_statezone.state_zone,
wp_schedule_events.start_time_forstart_date,wp_schedule_events.end_time_forstart_date,
wp_schedule_events.start_time_forend_date,wp_schedule_events.end_time_forend_date,
wp_schedule_events.location, wp_schedule_events.start_date, wp_schedule_events.end_date,
wp_schedule_events.contact_name, wp_schedule_events.phone_no, wp_schedule_events.upcoming_event,
wp_schedule_events.status from wp_schedule_event_state 
LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id
LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id
LEFT JOIN wp_state ON wp_state.id = wp_schedule_event_state.state_id
and wp_schedule_events.is_delete='1' and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1' GROUP BY wp_schedule_event_state.event_id having mult_id>0 order by wp_schedule_events.id asc limit $eu, $limit";
	$tour_schedulings = $wpdb->get_results($sql);					
				
	$touScheduling='';
	$endDate='';
	$startDate='';
				
				
	$ids=array();
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
				<td><?php echo $retrieved_data->location;?></td>
				<td><?php echo $retrieved_data->start_date;?></td>
				<td><?php echo $retrieved_data->start_time_forstart_date;?></td>
				<td><?php echo $retrieved_data->end_time_forstart_date;?></td>
				<td><?php echo $retrieved_data->end_date;?></td>
				<td><?php echo $retrieved_data->start_time_forend_date;?></td>
				<td><?php echo $retrieved_data->end_time_forend_date;?></td>				
				<td><?php echo $retrieved_data->contact_name;?></td>				
				<td><?php echo $retrieved_data->phone_no;?></td>
				<td><?php if($retrieved_data->upcoming_event == 1){echo "Active";}else{ echo "Inactive";}?></td>				
				<td><?php if($retrieved_data->status == 1){echo "Enable";}else{ echo "Disable";}?></td>
				<td><a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-schedule.php&eid=<?php echo $retrieved_data->id;?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Pencil.png" title="edit	 state"/></a>&nbsp;
				<a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-schedule.php&did=<?php echo $retrieved_data->id;?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Delete.png" title="delete state"/></a></td>
			</tr>
	<?php 
	
	 $k++;
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



<script type="text/javascript">
$(document).ready(function () {

    $('#schedule').validate({ // initialize the plugin
        rules: {
            state_name: {
                required: true,
            },
			
			status: {
                required: true,
            },
			location: {
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

	if('<?php echo $getScheduleById[0]->statezone_id ?>'){
		
		window.statezone = '<?php echo $getScheduleById[0]->statezone_id; ?>';
		
	}
	
	
});
var multi_select='';

if('<?php echo $getScheduleById[0]->multi_select ?>'){
	 multi_select = '<?php echo $getScheduleById[0]->multi_select; ?>';
	 window.multi_select=multi_select;
}
</script>