<?php
$msg='';
$msg_existing='';

function addstate($data){	
	global $wpdb;	
	
	$statename = trim(esc_attr($data['statename']));	
    $state_short = trim(esc_attr($data['shortname']));	
	$status = trim(esc_attr($data['status']));	
	
	$table_name = $wpdb->prefix . 'state';
	
	//Checking to see if the state already exists
    $datum = $wpdb->get_results("SELECT * FROM $table_name WHERE state_name = '".$statename."' and is_delete='1'");
	
	   if($wpdb->num_rows > 0) {       
		 $_SESSION['stateAdd']="State name exists already";
        ?>
        
        <?php
        //return or exit
    }else{
		
			$msg=$wpdb->insert( 
			$table_name, 
			array( 
				'state_name' => $statename,	
				'state_short' => $state_short,
				'status' => $status,			 	 
				'created_at' => current_time( 'mysql' ), 
			) 
		);
		if(!empty($msg)){
		     $_SESSION['stateAdd']="State saved Successfully";
		}
		
	}
	
}

if(isset($_POST['submit'])){
addstate($_POST);
}


function getStateById($id){

	global $wpdb;
	$table_name = $wpdb->prefix . 'state';
	$sql="select * from $table_name WHERE id=".$id;
	$results=$wpdb->get_results($sql);
    return $results;
}

if(isset($_POST['updatestate'])){
updatestate($_POST,$_GET['eid']);
}

function updatestate($data,$id){
	global $wpdb;
	$table_name = $wpdb->prefix . 'state';
	$sql="UPDATE $table_name SET 
	state_name='".addslashes($data['statename'])."',
	state_short='".addslashes($data['shortname'])."',	
	status='".addslashes($data['status'])."' WHERE id=".$id;
	
	if($wpdb->query($sql)){
		$_SESSION['stateAdd']="State Updated Successfully";
	}
}


if(isset($_GET['did'])){
	
	$id = $_GET['did'];
	global $wpdb;
	$table_name = $wpdb->prefix . 'state';
	$sql="UPDATE $table_name SET 
			is_delete='0' WHERE id=".$id;
	if($wpdb->query($sql)){
			$_SESSION['stateAdd']="State deleted Successfully";
	}

}




?>
<div class="wrap">
<h1>Add State</h1>

<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery.min.js"></script>
<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery.validate.min.js"></script>

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
$getStateById=getStateById($_GET['eid']);
?>


	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="statename">State Name</label></th>
				<td><input name="statename" id="statename" value="<?php echo $getStateById[0]->state_name ?>" class="regular-text" type="text">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="shortname">State Short Name</label></th>
				<td><input name="shortname" id="shortname" value="<?php echo $getStateById[0]->state_short ?>" class="regular-text" type="text">
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
	<p class="submit"><input name="submit" id="submit" class="button button-primary" value="Save State" type="submit"></p>
	<?php
	}else{
	?>

	<p class="submit"><input name="updatestate" id="updatestate" class="button button-primary" value="Update State" type="submit"></p>
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
				<th>State Name</th>
				<th>State Short Name</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
	<?php
		
		global $wpdb;
		$table_name = $wpdb->prefix . "state";
		$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name where is_delete='1'" );
		
		$k=1;
//pagination
$page_name=get_option('siteurl')."/wp-admin/admin.php?page=mkenny-admin-state-page.php";
		$start=$_GET['start'];
			if(strlen($start) > 0 && !is_numeric($start)){
			echo "Data Error";
			exit;
			}
			$eu = ($start - 0); 
			$limit = 10;                               
			$this1 = $eu + $limit; 
			$back = $eu - $limit; 
			$next = $eu + $limit; 

 $nume=count($retrieve_data);
 $sql="select * from $table_name where is_delete='1' ORDER BY `ID` ASC  limit $eu, $limit ";
$retrievedata=$wpdb->get_results($sql);
		
		
		foreach ($retrievedata as $retrieved_data){ 
	
	?>	
			<tr>
				<td><?php echo $retrieved_data->state_name;?></td>
				<td><?php echo $retrieved_data->state_short;?></td>
				<td><?php if($retrieved_data->status == 1){echo "Enable";}else{ echo "Disable";}?></td>
				<td><a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-state-page.php&eid=<?php echo $retrieved_data->id  ?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Pencil.png" title="edit	 state"/></a>&nbsp;
				<a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-state-page.php&did=<?php echo $retrieved_data->id  ?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Delete.png" title="delete state"/></a></td>
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
            statename: {
                required: true,
            },
			shortname: {
                required: true,
            },
			
			status: {
                required: true,
            }
			
			
        }
    });

});
</script>
	