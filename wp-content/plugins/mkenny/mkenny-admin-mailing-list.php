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

//send mail
if(isset($_POST['send_mail'])){
	if(isset($_POST['email_to']) && isset($_POST['email_to']) !== "" && isset($_POST['message']) && isset($_POST['message']) !== ""){
		$to = $_POST['email_to'];
		$subject = "Mail from mKennys";				
		$message = $_POST['message'];
		$from = 'info@mkennys.com';
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Bcc:info@mkennys.com' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= "From:  True Fitted by M Kennys <" .$from. "> \r\n" . "X-Mailer: PHP/" . phpversion();
		if(mail($to,$subject,$message,$headers)){
			echo '<script>
				alert("Mail sent successfully!!");
				window.location ="'.home_url().'/wp-admin/admin.php?page=mkenny-admin-mailing-list.php";
				</script>';
			}else{
				echo '<script>
					alert("Mail was not sent");
					window.location ="'.home_url().'/wp-admin/admin.php?page=mkenny-admin-mailing-list.php";
				</script>';
		}
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
		<p><strong><?= $_SESSION['mailingUpdate'] ?>.</strong></p>
		<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
	</div>

<?php 

unset($_SESSION['mailingUpdate']);




}

?>
	
	
	
	
	<?php if(isset($_SESSION['mailinglist_delete'])){ ?>
	<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
		<p><strong><?= $_SESSION['mailinglist_delete'] ?>.</strong></p>
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
				<th scope="row"><label for="mailing_name">Name</label></th>
				<td>
					<input type="text"  name="mailing_name" id="mailing_name" class="regular-text" value="<?= $getMailingById[0]->mailing_name ?>">				
				</td>
			</tr>
			
			<tr>			
				<th scope="row"><label for="mailing_email">Email Address</label></th>
				<td>
					<input type="text" name="mailing_email" id="mailing_email" class="regular-text" value="<?= $getMailingById[0]->mailing_email ?>">				
				</td>
			</tr>
			
			<tr>			
				<th scope="row"><label for="mailing_state">State</label></th>
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
					<option value="<?= $result->state_name ?>" <?= $selected ?>><?= $result->state_name ?></option>
					<?php		
					}
				?>				
				</select>						
				</td>
			</tr>
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
				<th>Name</th>						
				<th>Email Address</th>
				<th>State</th>
				<th>Date Added</th>
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
 
$sql="SELECT * FROM $mailinglist ORDER BY created_at DESC LIMIT $eu, $limit";
$retrievedata=$wpdb->get_results($sql);	
	foreach ($retrievedata as $retrieved_data){ 
	
	?>	
			<tr>
				<td><?= $retrieved_data->mailing_name ?></td>
				<td><?= $retrieved_data->mailing_email ?></td>
				<td><?= $retrieved_data->mailing_state ?></td>				
				<td><?= $retrieved_data->created_at ?></td>				
				<td>
					<a href="<?= get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-mailing-list.php&eid=<?= $retrieved_data->id ?>"><img src="<?= get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Pencil.png" title="Edit"/></a>
					&nbsp;&nbsp;
					<a href="<?= get_option('siteurl') ?>/wp-admin/admin.php?page=mkenny-admin-mailing-list.php&did=<?= $retrieved_data->id ?>"><img src="<?= get_option('siteurl') ?>/wp-content/plugins/mkenny/images/Delete.png" title="Delete"/></a>
					&nbsp;&nbsp;
					<a href="javascript:void(0);" data-email="<?= $retrieved_data->mailing_email ?>" class="send-mail"><img src="<?= get_option('siteurl') ?>/wp-content/plugins/mkenny/images/email.png" title="Email"/></a>
				</td>
			</tr>
	<?php 
	
	 $k++;
	}
	
	if(count($retrieve_data) == 0){
	?>


	<tr>
		<td colspan="5"><?= "There is no record available"?></td>
				
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

<!-- Popup modal -->
<div class="modal-wrapper send-email-modal">
	<div class="overlay"></div>
	<form method="POST">
		<div class="modal-dialog">
			<div class="modal-content">  
				<div class="modal-header">
					<h5 class="modal-title">Send Mail</h5>
					<button type="button" class="close hide-modal" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>    
				</div>  
				<div class="modal-body">     				
						<div class="form-type">
							<label for="email_to">To</label>
							<input type="text" name="email_to" readonly="readonly">
						</div>
						<div class="form-type">
							<label for="message">Message</label>
							<textarea class="modal-mail-message" name="message"></textarea>
						</div>					
					<div class="modal-action">
					</div>            
				</div>  
				<div class="modal-footer form-type">
					<button class="cancel-btn hide-modal " type="button">Cancel</button>
					<button class="primary-btn hide-modal " name="send_mail">Send Mail</button>
				</div>  	    
			</div>
		</div>
	</form>
</div>
<!-- #Show State Name --->


<script>
	jQuery(document).ready(function(){
		jQuery('.send-mail').on('click',function(){
			var email = jQuery(this).data('email');
			if(email){
				jQuery('input[name="email_to"]').val(email);
				jQuery('.modal-wrapper').fadeIn();
			}
		});
		jQuery('.hide-modal').on('click',function(){
			jQuery('.modal-wrapper').fadeOut();
		});
	});
</script>