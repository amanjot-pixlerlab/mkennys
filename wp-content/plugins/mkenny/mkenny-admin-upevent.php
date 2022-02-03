<?php
$msg='';
$msg_existing='';

function addUpcomingEvent($data){
	
	global $wpdb;
	$table_name = $wpdb->prefix . 'up_coming_event';
	
	$start_date = trim(esc_attr($data['start_date']));	
    $end_date = trim(esc_attr($data['end_date']));	
	$state_id = trim(esc_attr($data['state_name']));	
	$status = trim(esc_attr($data['status']));	
	
	
	
	//Checking to see if the state already exists
    $datum = $wpdb->get_results("SELECT * FROM $table_name WHERE state_name = '".$statename."' and end_date = '".$end_date."' and start_date = '".$start_date."'" );
	
	   if($wpdb->num_rows > 0) {       
		 $_SESSION['stateAdd']="Up coming event exists already";
       
    }else{
		
			$msg=$wpdb->insert( 
			$table_name, 
			array( 
				'start_date' => $start_date,	
				'end_date' => $end_date,				
				'state_id' => $state_id,
				'status' => $status,			 	 
				'created_at' => current_time( 'mysql' ), 
			) 
		);
		
		if(!empty($msg)){
		     $_SESSION['stateAdd']="Up coming event saved successfully";
		}
		
	}
	
}

if(isset($_POST['submit'])){
addUpcomingEvent($_POST);
}


function getId($id){

	global $wpdb;
	$table_name = $wpdb->prefix . 'up_coming_event';
	$sql="select * from $table_name WHERE id=".$id;
	$results=$wpdb->get_results($sql);
    return $results;
}

if(isset($_POST['updateupcevent'])){
update($_POST,$_GET['eid']);
}

function update($data,$id){
	global $wpdb;
	$table_name = $wpdb->prefix . 'up_coming_event';
	
	$sql="UPDATE $table_name SET 
	start_date='".addslashes($data['start_date'])."',
	end_date='".addslashes($data['end_date'])."',
	state_id='".addslashes($data['state_name'])."',	
	status='".addslashes($data['status'])."' WHERE id=".$id;
	
	if($wpdb->query($sql)){
		$_SESSION['stateAdd']="Up coming event updated successfully";
	}
}


if(isset($_GET['did'])){
	
	$id = $_GET['did'];
	global $wpdb;
	$table_name = $wpdb->prefix . 'up_coming_event';
	$sql="UPDATE $table_name SET 
			is_delete='0' WHERE id=".$id;
	if($wpdb->query($sql)){
			$_SESSION['stateAdd']="Up coming event deleted successfully";
	}

}
?>
<div class="wrap">
<h1>Up Coming Events</h1>

  <link rel="stylesheet" href="<?php echo site_url() ?>/wp-content/plugins/mkenny/css/jquery-ui.css">  
  <script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery-1.12.4.js"></script>  
  <script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery-ui.js"></script>
  <script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery.validate.min.js"></script>
  
<script type="text/javascript">
	jQuery(document).ready(function (){
		jQuery("#start_date").datepicker();
		jQuery("#end_date").datepicker();
	});
</script>

<?php if(isset($_SESSION['stateAdd'])){ ?>
	<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
		<p><strong><?php echo $_SESSION['stateAdd'];  ?>.</strong></p>
		<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
	</div>

<?php 

unset($_SESSION['stateAdd']);
}

?>

<form method="post" action=" " novalidate="novalidate" id="stateform">

<?php
$getStateById=getId($_GET['eid']);
?>


	<table class="form-table">
		<tbody>
			<tr>			
				<th scope="row"><label for="start_date">Start Date</label></th>
				<td>
					<input type="text"  name="start_date" id="start_date" class="regular-text" value="<?php echo $getStateById[0]->start_date ?>">				
				</td>
			</tr>
			
			<tr>			
				<th scope="row"><label for="end_date">End Date</label></th>
				<td>
					<input type="text" name="end_date" id="end_date" class="regular-text" value="<?php echo $getStateById[0]->end_date ?>">				
				</td>
			</tr>
			
			
			
			<tr>
				<th scope="row"><label for="shortname">State Name</label></th>
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
					if($getStateById[0]->state_id == $retrieved_data->id){
						
						$selected = "selected = 'selected'";
						
					}
				?>		
						<option value="<?php echo $retrieved_data->id;?>" <?php echo $selected; ?>  ><?php echo $retrieved_data->state_name;?></option>
				<?php	
				}
				?>
					</select>
				</td>
				
			</tr>
			
			<tr>
				<th scope="row"><label for="shortname">Status</label></th>
				<?php if(count($getStateById)==0){
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
						<option value="1" <?php  if($getStateById[0]->status == 1 ){ ?> selected="selected" <?php } ?>>Enable</option>
						<option value="0" <?php  if($getStateById[0]->status == 0 ){ ?> selected="selected" <?php } ?>>disable</option>
					</select>
				</td>
				<?php
				}
				?>
				
			</tr>	
			
		</tbody>
	</table>
	
	<?php if(count($getStateById)==0){
	?>
	<p class="submit"><input name="submit" id="submit" class="button button-primary" value="Save UpComing Event" type="submit"></p>
	<?php
	}else{
	?>

	<p class="submit"><input name="updateupcevent" id="updateupcevent" class="button button-primary" value="Update UpComing Event" type="submit"></p>
	<?php	
	}
	?>
	
</form>

</div>

<!--- Show State Name --->

<div class="wrap">
	<h1>State Listing</h1>
	<table class="form-table" border="1">
		<tbody>
			<tr>
				<th>Start Date</th>
				<th>End Date</th>
				<th>State</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
	<?php
		
		global $wpdb;
		$table_name = $wpdb->prefix . 'up_coming_event';
	    $state = $wpdb->prefix . 'state';
		$retrieve_data = $wpdb->get_results("SELECT * FROM $table_name where is_delete='1'" );
		
		$k=1;
//pagination
$page_name=get_option('siteurl')."/wp-admin/admin.php?page=mkenny-admin-upevent.php";
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
 
 
 $sql="select $table_name.id,$table_name.start_date,$table_name.end_date,$table_name.status,$table_name.state_id,$state.state_name from $table_name,$state where $table_name.is_delete='1' and $state.is_delete='1' and $state.id = $table_name.state_id ORDER BY $table_name.id ASC  limit $eu, $limit ";
$retrievedata=$wpdb->get_results($sql);		
		
		foreach ($retrievedata as $retrieved_data){ 
	
	?>	
			<tr>
				<td><?php echo $retrieved_data->start_date;?></td>
				<td><?php echo $retrieved_data->end_date;?></td>
				<td><?php echo $retrieved_data->state_name;?></td>
				<td><?php if($retrieved_data->status == 1){echo "Enable";}else{ echo "Disable";}?></td>
				<td><a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-upevent.php&eid=<?php echo $retrieved_data->id  ?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Pencil.png" title="edit	 state"/></a>&nbsp;
				<a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-upevent.php&did=<?php echo $retrieved_data->id  ?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Delete.png" title="delete state"/></a></td>
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
jQuery(document).ready(function () {

    jQuery('#stateform').validate({ // initialize the plugin
        rules: {
            state_name: {
                required: true,
            },
			start_date: {
                required: true,
            },
			end_date: {
                required: true,
            },
			
			status: {
                required: true,
            }
			
			
        }
    });

	
	  
    

	
});
</script>
	