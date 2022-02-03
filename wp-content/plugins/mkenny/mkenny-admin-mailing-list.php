<?php
global $wpdb;
 $mailinglist = $wpdb->prefix . 'mailing_list';	

if(isset($_GET['did'])){
   global $wpdb;	
	$id = $_GET['did'];
	$sql="delete from $mailinglist WHERE id=".$id;
	if($wpdb->query($sql)){
			$_SESSION['mailinglist_delete']="Mailing list data deleted successfully";
	}
}

function getMailingId($id){	
  global $wpdb;
  $mailinglist = $wpdb->prefix . 'mailing_list';	
  $sql="select * from $mailinglist WHERE id=".$id;
  $results=$wpdb->get_results($sql);	
  return $results;
}

if(isset($_POST['updatemailinglist'])){
update($_POST,$_GET['eid']);
}

function update($data,$id){
	global $wpdb;
	 $mailinglist = $wpdb->prefix . 'mailing_list';	
	 
	 $query  = "select * from wp_state where state_name = '".$data['mailing_state']."' and is_delete='1'";	
	 $resultData = $wpdb->get_results($query);	
	
	$sql="UPDATE $mailinglist SET 
	mailing_name='".addslashes($data['mailing_name'])."',
	mailing_email='".addslashes($data['mailing_email'])."',
	mailing_state='".$resultData['0']->state_name."'	
	WHERE id=".$id;
	
	if($wpdb->query($sql)){
		$_SESSION['mailingUpdate']="Mailing list data updated successfully";
	}
}





?>
<!--- Show State Name --->

<div class="wrap">

<?php
if(isset($_GET['eid'])){
$getMailingById=getMailingId($_GET['eid']);	
?>



<h1>Mailing Listing</h1>
    <div class="tableContainer">
	
	
	<?php if(isset($_SESSION['mailingUpdate'])){ ?>
	<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
		<p><strong><?php echo $_SESSION['mailingUpdate'];  ?>.</strong></p>
		<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
	</div>

<?php 

unset($_SESSION['mailingUpdate']);




}

?>
	
	
	
	
	<?php if(isset($_SESSION['mailinglist_delete'])){ ?>
	<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
		<p><strong><?php echo $_SESSION['mailinglist_delete'];  ?>.</strong></p>
		<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
	</div>

<?php 

unset($_SESSION['mailinglist_delete']);
}

?>


<form method="post" action=" " novalidate="novalidate" id="stateform">




	<table class="form-table">
		<tbody>
			<tr>			
				<th scope="row"><label for="mailing_name">Mailing Name</label></th>
				<td>
					<input type="text"  name="mailing_name" id="mailing_name" class="regular-text" value="<?php echo $getMailingById[0]->mailing_name ?>">				
				</td>
			</tr>
			
			<tr>			
				<th scope="row"><label for="mailing_email">Mailing Email</label></th>
				<td>
					<input type="text" name="mailing_email" id="mailing_email" class="regular-text" value="<?php echo $getMailingById[0]->mailing_email ?>">				
				</td>
			</tr>
			
			<tr>			
				<th scope="row"><label for="mailing_state">Mailing State</label></th>
				<td>
					<select name="mailing_state" id="mailing_state"  class="regular-text">
				<?php
				    $sql = "select * from wp_state where is_delete='1' and status='1'";
					$results=$wpdb->get_results($sql);	
					
					
					foreach($results as $result){
						$selected='';
						if($result->state_name == $getMailingById[0]->mailing_state){							
							$selected="selected='selected'";
						}
					?>
					<option value="<?php echo $result->state_name;?>" <?php echo $selected; ?>><?php echo $result->state_name;?></option>
					<?php		
					}
				?>				
				</select>						
				</td>
			</tr>
			
			<?php
			/*
			?>
			
			
			
			<tr>
				<th scope="row"><label for="shortname">Status</label></th>
				<?php if(count($getMailingById)>0){
				?>
				<td>
					<select name="status" id="status"  class="regular-text">
						<?php 
						$selected='';					 
						?>
						<option value="">Please Select Status</option>
						<option value="1" <?php  if($getMailingById[0]->status == 1 ){ ?> selected="selected" <?php } ?>>Enable</option>
						<option value="0" <?php  if($getMailingById[0]->status == 0 ){ ?> selected="selected" <?php } ?>>disable</option>
					</select>
				</td>
					
				<?php
				}
				?>
				
			
				
				
			</tr>	
			<?php
			*/
			
			?>
			
		</tbody>
	</table>
	
	<?php
	if(count($getMailingById)>=0){
	?>
	
	
	<p class="submit"><input name="updatemailinglist" id="updatemailinglist" class="button button-primary" value="Update Maling List" type="submit"></p>
	<?php	
	}
	?>
	
</form>


</div>
<?php
}
?>


<div class="wrap">
	
		<table class="form-table" border="1">
		<tbody>
			<tr>
				<th>Mailing Name</th>						
				<th>Mailing Email</th>
				<th>Mailing State</th>
				<th>Status</th>
				
				
					
			</tr>
	<?php
		
		global $wpdb;
        $mailinglist = $wpdb->prefix . 'mailing_list';		
		$retrieve_data = $wpdb->get_results("SELECT * FROM $mailinglist");
		
		$k=1;
//pagination
$page_name=get_option('siteurl')."/wp-admin/admin.php?page=mkenny-admin-mailing-list.php";
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
 
$sql="SELECT * FROM $mailinglist  limit $eu, $limit";
$retrievedata=$wpdb->get_results($sql);	
	foreach ($retrievedata as $retrieved_data){ 
	
	?>	
			<tr>
				<td><?php echo $retrieved_data->mailing_name;?></td>
				<td><?php echo $retrieved_data->mailing_email;?></td>
				<td><?php echo $retrieved_data->mailing_state;?></td>				
				<td>
				<a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-mailing-list.php&eid=<?php echo $retrieved_data->id  ?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Pencil.png" title="delete state"/></a>&nbsp;&nbsp;
				<a href="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-mailing-list.php&did=<?php echo $retrieved_data->id  ?>"><img src="<?php echo get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Delete.png" title="delete state"/></a></td>
			</tr>
	<?php 
	
	 $k++;
	}
	
	if(count($retrieve_data) == 0){
	?>


	<tr>
		<td colspan="5"><?php echo "There is no record available;"?></td>
				
	</tr>

	
	<?php	
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