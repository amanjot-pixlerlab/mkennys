<?php
$msgupdate='';
$msg='';
function addstatezone($data){
	
	global $wpdb;
	$table_name = $wpdb->prefix . 'statezone';	
	$state_id = trim(esc_attr($data['state_name']));	    	
	$status = trim(esc_attr($data['status']));	
	
	for($i=0; $i<(count($data['addmore'])-1); $i++){
		
		//Checking to see if the state already exists
		
		$existing_zone = $wpdb->get_results("SELECT * FROM $table_name WHERE state_id = '".$state_id."'
		and state_zone = '".$data['addmore'][$i]."' and is_delete='1'");
	
		if(count($existing_zone) > 0) {       
			$_SESSION['statezoneAdd']="State zone exists already";
        
		}else{			
			$msg=$wpdb->insert( 
				$table_name, 
				array( 
					'state_id' => $state_id,	
					'state_zone' => $data['addmore'][$i],
					'status' => $status,			 	 
					'created_at' => current_time( 'mysql' ), 
				) 
			);
		}		
	} 
	
	if(!empty($msg) && count($existing_zone)==0){
		     $_SESSION['statezoneAdd']="statezone saved successfully";
	}
	
	
	
	
	
}

if(isset($_POST['submit'])){
addstatezone($_POST);
}

function getStateZoneById($id){

	global $wpdb;
	$table_name = $wpdb->prefix . 'statezone';
	$sql="select * from $table_name WHERE id=".$id;
	$results=$wpdb->get_results($sql);
    return $results;

}

function updatestatezone($data,$id){
	
	global $wpdb;
	$table_name = $wpdb->prefix . 'statezone';	
		
		$sql="UPDATE $table_name SET 
		state_id ='".addslashes($data['state_name'])."',
		state_zone ='".addslashes($data['addmore'])."',	
		status='".addslashes($data['status'])."'		
		WHERE id = ".$id;
		$msgupdate=$wpdb->query($sql);
	
	
	if($msgupdate){
		$_SESSION['statezoneAdd']="Statezone Updated Successfully";
	}
}


if(isset($_POST['updatestatezone'])){	
updatestatezone($_POST,$_GET['eid']);
}

if(isset($_GET['did'])){
	
	global $wpdb;
	$table_name = $wpdb->prefix . 'statezone';	
		
		$sql="UPDATE $table_name SET 
		is_delete ='0' WHERE id = ".$_GET['did'];
		$msgupdate=$wpdb->query($sql);
		
		if($msgupdate){
		$_SESSION['statezoneAdd']="Statezone data deleted Successfully";
	}
}

?>
<div class="wrap">
<h1>Add State Zone</h1>

 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="<?php echo site_url() ?>/wp-content/plugins/mkenny/css/bootstrap.min.css">-->
    <script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery.js"></script>
	<script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery.validate.min.js"></script>
    
  
  <script type="text/javascript">


    jQuery(document).ready(function() {


      jQuery(".add-more").click(function(){ 

          var html = jQuery(".copy").html();

          jQuery(".after-add-more").after(html);

      });


      jQuery("body").on("click",".remove",function(){ 

          jQuery(this).parents(".control-group").remove();

      });


    });


</script>


<?php if(isset($_SESSION['statezoneAdd'])){ ?>
	<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
		<p><strong><?php echo $_SESSION['statezoneAdd'];  ?>.</strong></p>
		<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
	</div>

<?php 

unset($_SESSION['statezoneAdd']);
}

?>

<form method="post" action=" " novalidate="novalidate" id="statezone" name="statezone">

<?php
$getstatezone = getStateZoneById($_GET['eid']);
?>

	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="shortname">State Name</label></th>
				
				<?php if(count($getstatezone)==0){
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
						<option value="<?php echo $retrieved_data->id;?>"><?php echo $retrieved_data->state_name;?></option>
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
							if($getstatezone[0]->state_id == $retrieved_data->id){
								
								$selected = "selected = 'selected'";
								
							}
						?>		
						<option value="<?php echo $retrieved_data->id;?>" <?php echo $selected; ?>  ><?php echo $retrieved_data->state_name;?></option>
				<?php	
				}
				?>
					</select>
				</td>

				<?php
				}
				?>
				
				
			</tr>
			
			<tr>			
				<th scope="row"><label for="addmore">State Zone</label></th>
				
				<?php if(count($getstatezone)==0){
				?>
				<td>
					<div class="input-group control-group after-add-more">
					  <input type="text" name="addmore[]" class="regular-text" value="<?php echo $getstatezone[0]->state_zone ?>">         
						<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i></button>
					</div>
					<div class="copy hide">
					  <div class="control-group input-group" style="margin-top:10px">
						<input type="text" name="addmore[]" class="regular-text">
						  <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
					  </div>
					</div>					
				</td>
				
				
				<?php
				
				}else{
				?>
				<td>
					<div class="input-group control-group after-add-more">
					  <input type="text" name="addmore" class="regular-text" value="<?php echo $getstatezone[0]->state_zone ?>">         
						
					</div>
								
				</td>
				
				<?php	
				}
				?>
				
				
			</tr>			
			<tr>
				<th scope="row"><label for="shortname">Status</label></th>
				<?php if(count($getstatezone)==0){
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
						<option value="1" <?php  if($getstatezone[0]->status == 1 ){ ?> selected="selected" <?php } ?>>Enable</option>
						<option value="0" <?php  if($getstatezone[0]->status == 0 ){ ?> selected="selected" <?php } ?>>disable</option>
					</select>
				</td>
				<?php
				}
				?>
				
			</tr>
						
		</tbody>
	</table>
	

	
		<?php if(count($getstatezone)==0){
	?>
		<p class="submit"><input name="submit" id="submit" class="button button-primary" value="Save Statezone" type="submit"></p>
	<?php
	}else{
	?>

	<p class="submit"><input name="updatestatezone" id="updatestatezone" class="button button-primary" value="Update State Zone" type="submit"></p>
	<?php	
	}
	?>
	
</form>

</div>

<!-- Listing StateZone  -->

<div class="wrap">
	<h1>State Zone Listing</h1>
	<table class="form-table" border="1">
		<tbody>
			<tr>
				<th>State Name</th>
				<th>State Zone</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
	<?php
		
		global $wpdb;
		$table_name = $wpdb->prefix . "statezone";
		$state = $wpdb->prefix . "state";
		$retrieve_data = $wpdb->get_results("SELECT * FROM $table_name where is_delete='1'");		
		$k=1;
//pagination
$page_name=get_option('siteurl')."/wp-admin/admin.php?page=mkenny-admin-statezone.php";
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
 $sql="select $table_name.id,$state.state_name,$table_name.state_zone,$table_name.status from $table_name,$state where $table_name.state_id = $state.id and $table_name.is_delete ='1' ORDER BY $table_name.id ASC  limit $eu, $limit ";
$retrievedata=$wpdb->get_results($sql);

//echo "<pre>";
//print_r($retrievedata);
		
		
		foreach ($retrievedata as $retrieved_data){ 
	
	?>	
			<tr>
				<td><?php echo $retrieved_data->state_name;?></td>
				<td><?php echo $retrieved_data->state_zone;?></td>
				<td><?php if($retrieved_data->status == 1){echo "Enable";}else{ echo "Disable";}?></td>
				<td><a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-statezone.php&eid=<?php echo $retrieved_data->id  ?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Pencil.png" title="edit	 state"/></a>&nbsp;
				<a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-statezone.php&did=<?php echo $retrieved_data->id  ?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Delete.png" title="delete state"/></a></td>
			</tr>
	<?php 
	
	 $k++;
	}
	
	
	?>	
			
			
		</tbody>
	</table>
	
<div style="clear:both;"></div>

<?php 
if($nume > $limit){ 

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




<!---#Listing StateZone -->





<script type="text/javascript">
jQuery(document).ready(function () {

    jQuery('#statezone').validate({ // initialize the plugin
        rules: {
            state_name: {
                required: true,
            },
			'addmore[]': {
                required: true,
            },
			
			status: {
                required: true,
            }
			
			
        }
    });

	
	  
    

	
});
</script>



	