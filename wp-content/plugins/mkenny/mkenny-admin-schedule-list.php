<?php
?>
<!--- Show State Name --->

<div class="wrap">
	<h1>Appointment Listing</h1>
    <div class="tableContainer">
		<table class="form-table" border="1">
		<tbody>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Phone</th>				
				<th>Email</th>
				<th>State</th>
				<th>Zone</th>
				<th>City</th>		
				<th>Appointment Date</th>
				<th>Appointment Time</th>
				<th>Interested In</th>
				<th>Message</th>				
			</tr>
	<?php
		
		global $wpdb;
		$schedule_appointment = $wpdb->prefix . 'schedule_appointment';		
		$state = $wpdb->prefix . 'state';
		
		
		$retrieve_data = $wpdb->get_results("SELECT * FROM $schedule_appointment");
		
		$k=1;
//pagination
$page_name=get_option('siteurl')."/wp-admin/admin.php?page=mkenny-admin-schedule-list.php";
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
 
$sql="SELECT wp_schedule_appointment.id,wp_schedule_appointment.first_name,wp_schedule_appointment.last_name, wp_schedule_appointment.phone,wp_schedule_appointment.email,wp_schedule_appointment.appointment_date,wp_schedule_appointment.appointment_time,wp_schedule_appointment.interested_in ,wp_schedule_appointment.message,wp_schedule_events.city_name,wp_state.state_name,wp_state.state_short,
wp_statezone.state_zone FROM wp_schedule_appointment,wp_state,wp_schedule_events,wp_schedule_event_state
left join  wp_statezone on wp_schedule_event_state.statezone_id = wp_statezone.id
where wp_schedule_appointment.state=wp_schedule_events.id and wp_state.status='1' and wp_schedule_appointment.state=wp_schedule_event_state.event_id and wp_schedule_event_state.state_id=wp_state.id and wp_state.is_delete='1'and wp_schedule_appointment.is_delete='1'
group by wp_schedule_appointment.id ORDER BY wp_schedule_appointment.id ASC limit $eu, $limit";
$retrievedata=$wpdb->get_results($sql);	
	foreach ($retrievedata as $retrieved_data){ 
	
	?>	
			<tr>
				<td><?php echo $retrieved_data->first_name;?></td>
				<td><?php echo $retrieved_data->last_name;?></td>
				<td><?php echo $retrieved_data->phone;?></td>
				<td><?php echo $retrieved_data->email;?></td>
				<td><?php echo $retrieved_data->state_name;?></td>
				
				<td><?php
				if(!empty($retrieved_data->state_zone)){
						echo $retrieved_data->state_zone;
				}else{
					echo 'none';
				}
				?></td>
				<td><?php echo $retrieved_data->city_name;?></td>
				
				
				<td><?php echo $retrieved_data->appointment_date;?></td>
				<td><?php echo $retrieved_data->appointment_time;?></td>
				<td><?php echo $retrieved_data->interested_in;?></td>
				<td><?php echo $retrieved_data->message;?></td>
			</tr>
	<?php 
	
	 $k++;
	}
	?>	
			
			
		</tbody>
	</table>
    </div>
	
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
.tableContainer { 
	overflow-x: auto;
}
</style>