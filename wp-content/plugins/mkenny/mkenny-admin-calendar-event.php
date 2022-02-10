<?php
require_once('calendar/bdd.php');
$sql = "SELECT wp_schedule_appointment.id,wp_schedule_appointment.state,wp_schedule_appointment.first_name,wp_schedule_appointment.last_name, wp_schedule_appointment.phone,wp_schedule_appointment.email,wp_schedule_appointment.state,wp_schedule_appointment.appointment_date,wp_schedule_appointment.appointment_time,wp_schedule_appointment.interested_in ,wp_schedule_appointment.message,wp_schedule_events.city_name,wp_state.state_name,wp_state.state_short,wp_statezone.state_zone as stateZone FROM wp_schedule_appointment,wp_state,wp_schedule_events,wp_schedule_event_state
left join  wp_statezone on wp_schedule_event_state.statezone_id = wp_statezone.id
where wp_schedule_appointment.state=wp_schedule_events.id and wp_state.status='1' and wp_schedule_appointment.state=wp_schedule_event_state.event_id and wp_schedule_event_state.state_id=wp_state.id and wp_state.is_delete='1'and wp_schedule_appointment.is_delete='1'
group by wp_schedule_appointment.id";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();
//print_r($events);
?>
<!-- Bootstrap Core CSS -->	
<link href="<?php echo site_url() ?>/wp-content/plugins/mkenny/calendar/css/bootstrap.min.css" rel="stylesheet">	
<!-- FullCalendar -->
<link href="<?php echo site_url() ?>/wp-content/plugins/mkenny/calendar/css/fullcalendar.css" rel="stylesheet"/>

<style>
.add_event {
    background: #2d3e50;
    border-radius: 3px;
    color: #ffffff !important;
    display: inline-block;
    margin-bottom: 20px;
    margin-top: 20px;
    padding: 10px 20px;
    text-decoration: none !important;
}
.calenderContainer { 
	
}
</style>

<body>

    <div class="calenderContainer">
        <div class="">
		<h2>Mkenny Event Calendar</h2>
		<a href="javascript:;"  rel="" class="add_event">Schedule An Appointment<i class="fa fa-chevron-right"></i></a>
        <div class="col-lg-12 calender_tabel text-center" style="background: #fff;">
            <div id="calendar" class="col-centered">
			No Found Event Data
            </div>
        </div>
        </div>
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Event has been cancelled successfully</h4>
			   </div>
			</div>  
		  </div>	
		</div>  

		<!-- Modal -->
		<div class="modal fade" id="ModalEdi4545t" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">			
			
			</div>
		  </div>
		</div>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/jquery-1.12.4.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/calendar/js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='<?php echo site_url() ?>/wp-content/plugins/mkenny/calendar/js/moment.min.js'></script>
	
	<?php if(count($events)>0) { ?>
	<script src='<?php echo site_url() ?>/wp-content/plugins/mkenny/calendar/js/fullcalendar.min.js'></script>
	<?php } ?> 
	<script>
	
	function daysDifference( firstDate, secondDate ){
				
		var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds		
		var days = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));		
		
		if( secondDate < firstDate ){
			return -days;
		}
		
		return days;
		
	}

	
	jQuery(document).ready(function(){
		<?php if(count($events)>0) { ?>
		jQuery('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: $('#calendar').fullCalendar('today'),
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				//$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				//$('#ModalAdd #end').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				//$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				
				element.find('div.fc-content').attr('id',event.event_id);
				
				element.find('div.fc-content').attr('alt',event.id);
				element.find('div.fc-content').attr('rel',event.booked_date);
				
				//console.log(event.reminder);
				
				if ( event.reminder != '' ) {					
					//console.log(event.reminder);
					element.find('div.fc-content').addClass('highlites');					
					jQuery('#ModalEdit #reminder').html(event.reminder);
				}
				
				var diff = daysDifference( new Date(), event._start._d );
					
				if( diff < 0 ){
					element.addClass("fc-state-disabled");
				}
				
				element.bind('click', function() {
					
					ev = event._start._d;
					
					if( jQuery(this).hasClass("fc-state-disabled") ){
						return;
					}
					//var d = new Date(event._start._d);
					
					//alert(event.interested_in);
										
					
					
					if( (diff == 2 || diff == 14) ){
						
						var $message = jQuery("<div/>",{
							"text" : event.reminder, 
							class : "event-message"});
						jQuery("div.event-message").remove();		
						$message.insertBefore( jQuery(".popup_overlay").find(".app_form_validation") ); 
					} else {
						jQuery(".popup_overlay").find(".event-message").remove();
					}
					
					jQuery("#app_id").val(event.id);
					
					jQuery("#app_booked_date").val(event.appointment_date);
					
					
					
					
					//jQuery(".close_btn").hide();
					// jQuery(".rschbtnpop").show();
					
					
					jQuery("#sa_submit").click(function(){
						
						if(jQuery("#captcha_code").val() != ''){
							
							var answer_reschedule = confirm("Are you sure you want to send email to the customer?");
							//alert(answer_reschedule);
							var ans_reschedule = 0;
							if (answer_reschedule) {
								ans_reschedule=1;
							}
							jQuery("#answer").val(ans_reschedule);
						}
						
					});
					
					
					
					jQuery("#cancel-event").show();
					jQuery(".creset").hide();
					jQuery("#sa_submit").val('ReSchedule Appointment');
					
					
					jQuery(".popup_overlay").fadeIn(".event-message");							
					
					
					if (event.reminder == '') {	
					  jQuery('#ModalEdit #reminder').html('');
					}	
					
					//alert(event.reminder);
					jQuery('#ModalEdit #reminder').html(event.reminder);
					jQuery('#ModalEdit #appointment_id').val(event.id);
					jQuery('#safirst_name').val(event.first.trim());
					jQuery('#salast_name').val(event.last);
					
					jQuery('#saphone').val(event.phone);
					jQuery('#saemail').val(event.email);
					
						
					jQuery('.demo').fSelect('destroy');
					jQuery('.demo').fSelect('create');
					
					jQuery('#sastate').html(event.state);
					
					/*
					if(event.state_zone){
						jQuery('#state_zone').html('<option value="'+event.stateZone+'">'+event.stateZone+'</option>');
					}else{
						jQuery('#state_zon').html('<option value="'+event.stateZone+'">'+event.stateZone+'</option>');
					}
					*/
					jQuery('#city_name').html('<option value="'+event.cityName+'">'+event.cityName+'</option>');
					
					
					if( event.interested_in.length > 0 ){
						var interested = event.interested_in.split(", ");
						interested.map(function(value){							
							jQuery('.interested input[value="'+value+'"]').prop("checked",true);
						});
					}
					
					
					function updateInterests(){
						var e = "";
						e = jQuery(".interested  input:checkbox").map(function (e) {
							if (this.checked) {
								return this.value
							}
						}).get().join(", ");
						//console.log(e);
						jQuery("#sinterested").val(e)
					}
					
					updateInterests();
					jQuery(".interested  input:checkbox").change(updateInterests);
						
					jQuery('#samessage').val(event.message);
					//$('#ModalEdit #color').val(event.color);
					jQuery('#ModalEdit').modal('show');
				});
				
			},
			events: [
			<?php
				$appointment_reminder='';
				$combine_state='';
				$diff='';
				foreach($events as $event):
				
				$stateId_query="select state_id FROM wp_schedule_event_state WHERE event_id=".$event['state'];
				
				$req = $bdd->prepare($stateId_query);
				$req->execute();
				$stateid_event = $req->fetchAll();
				$ids = array();	
				foreach($stateid_event as $state_event ){
														
					$ids[] = "'".$state_event['state_id']."'";
				}
					$sid = implode(",",$ids);
					
					$statename_query = "select id FROM wp_state WHERE id IN($sid)";
					
					
					
				
				   $req = $bdd->prepare($statename_query);
				   $req->execute();
				   $stateDats = $req->fetchAll();
				   $len = count($stateDats);
				   $combine_state=array();
					foreach($stateDats as $key=>$stateD ){
						
						$combine_state[] = $stateD['id'];
						
					}
				//print_r($combine_state);
				$appointmentDate = explode("/",$event['appointment_date']);				
				$start = $appointmentDate['2'].'-'.$appointmentDate['0'].'-'.$appointmentDate['1'];
				$date1 = new DateTime(date('Y-m-d'));
				$date2 = new DateTime($start);
				$darray = $date2->diff($date1);
				//print_r($darray);
				if(($darray->invert)>0){
					
					$diff = $date2->diff($date1)->format("%a");
				}	
				
				$appointment_reminder='';
				//$appointment_reminder='send 2-week e-mail for '.$diff;
				if($diff == '14'){
					
					$appointment_reminder='send 2-week e-mail for '.$event['first_name'];
					
				}
				if($diff == '2'){											
					$appointment_reminder='2 Days left send reminder e-mail for '.$event['first_name'];						
				}
				
					
				$appoint_timeFormat = date("H:i", strtotime($event['appointment_time']));
				$start = $start.'T'.$appoint_timeFormat;
				$diff='';
			?>
			
				{
					id: '<?php echo $event['id']; ?>',
					event_id: '<?php echo $event['state']; ?>',
					booked_date:'<?php echo $event['appointment_date']; ?>',
					
					title:'<?php echo $event['first_name'].' '.$event['last_name'].' '.$remaining_date; ?>',
					start:'<?php echo $start; ?>',			
					first:'<?php echo $event['first_name']; ?>',		
					last:'<?php echo $event['last_name']; ?>',					
					phone:'<?php echo $event['phone']; ?>',
					email:'<?php echo $event['email']; ?>',
					state:'<?php echo $combine_state; ?>',
					<?php
					if($event['stateZone'] == ''){
					?>	
						stateZone:'<?php echo 'none' ?>',
					<?php	
					}else{
					?>	
						stateZone:'<?php echo $event['stateZone']; ?>',
					<?php	
					}
					?>
					cityName:'<?php echo $event['city_name']; ?>',
					appointment_date:'<?php echo $event['appointment_date']; ?>',
					appointment_time:'<?php echo $event['appointment_time']; ?>',
					interested_in:'<?php echo $event['interested_in']; ?>',
					message:'<?php echo strip_tags($event['message']); ?>',
				    reminder:'<?php echo $appointment_reminder; ?>',
					
				},
			<?php
			endforeach;
			$combine_state='';
			$ids[]='';
			?>			
			]
		});
		
		<?php } ?>
		
		jQuery("#cancel-event").click(function(){
			
		var answer = confirm("Are you sure you want to send email to the customer?");
		var ans = 0;
		
		if (answer) {
			ans=1;
		}
			
		var form = jQuery("#app_form_validation")[0];		
		
		
		var formData = new FormData(form);
		
		formData.append( 'cData', "delete" );
		formData.append( 'ans', ans);		
		
			
				
			jQuery.ajax({
			 url: '<?php echo site_url() ?>/wp-content/plugins/mkenny/calendar/editEventTitle.php',
			 type: 'POST',
			 data: formData,
			 processData: false,
			 contentType: false,
			 dataType: 'json',
			 async: false,
		     success: function(data){
				 
				 //alert(data.msg);
				 
				jQuery('#ModalEdit').modal('hide');			
				
				jQuery("#rcData").html(data.msg);
				jQuery(".popup_overlay").fadeOut();	
				jQuery(".popup_overlay3").fadeIn();			
				
				//jQuery('#ModalAdd').modal('show');					
				//setTimeout(function(){location.reload();},500000);
				 
				 
			 }
			});
				
				
			
			
			
			
			
			
			return false;

			//return formData;
			//return;
		});
		
		
	});
	
	

</script>
<link href="<?php echo get_template_directory_uri(); ?>/css/stylepop.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/css/crousal-popup.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--<script src="<?php //echo get_template_directory_uri(); ?>/js/jquery.validationEngine-en.js" type="text/javascript"></script>-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validationEngine.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function(){
    
    jQuery('.add_event').click(function(){
        //jQuery(".rschbtnpop").hide();	
		jQuery('.demo').fSelect(function(){							   
			 uncheckAll: true							   
		});
		jQuery(".creset").show();
		
		if(jQuery("#datess").val().length == 0){
			
			jQuery("#datess").val('Not Available');
			
		}
		
		if(jQuery("#city_name").html().length == 0){
			
			jQuery("#city_name").html('<option value="">Not Available</option>');
			
		}
		
		if(jQuery("#time").html().length == 0){
			
			jQuery("#time").html('<option value="">Not Available</option>');
			
		}
		
		
		if(jQuery("#state_zone").html().length == 0){
			
			jQuery("#state_zone").html('<option value="">Not Available</option>');
			
		}
		
		
		
		
        jQuery("#show_date").hide();		
	    jQuery("#cancel-event").hide();
		jQuery(".popup_overlay").fadeIn();		
	});	

	jQuery(".close_btn a").click(function () {
		pageLoadCounter = 0;
		
		
		// clear list and re-init the states dropdown
		jQuery(".demo").fSelect('destroy');	
		var elements = document.getElementById("sastate").options;
		for(var i = 0; i < elements.length; i++){
		  elements[i].selected = false;
		}		
		jQuery(".demo").fSelect('create');
				
		
		jQuery(".app_form_validation").each(function () {
			
			//jQuery('.demo').fSelect('destroy');
			//jQuery('.demo').fSelect('create');
			jQuery('.demo').fSelect(function(){							   
			 uncheckAll: true							   
			});
			jQuery(".event-message").html('');
			jQuery("#state_zone").html("");
			jQuery("#city_name").html("");
			jQuery("#datess").val("");			
			jQuery("#time").html("");
			jQuery("#samessage").val('');
			jQuery("#captcha_code").val('');
			jQuery("#app_id").val('');
			jQuery("#app_booked_date").val('');
			jQuery("#answer").val('');
			jQuery(".check").removeAttr('checked');
			
			
                //this.reset();
                jQuery(".rresult").hide();
          });
        jQuery(".close_btnpop a").parents(".popup_overlay").fadeOut();
		jQuery(".close_btnpop a").parents(".popup_overlay3").fadeOut();
		
		

		
        //return false
    });
	
	jQuery(".close_btnpop a").click(function(){
		
			jQuery(".close_btnpop a").parents(".popup_overlay").fadeOut();
			jQuery(".close_btnpop a").parents(".popup_overlay3").fadeOut();
		    setTimeout(function(){window.location.reload(true);}, 100);
	});
	
	
	
});
</script>


<!--appointment_popup end here -->

<div class="popup_overlay schedule-appointment" style="display: none;">
    <div class="appointment_popup">
        <div class="container-12">
            <div class="grid-12">
                <h2 class="heading">Schedule An Appointment</h2>                
                <p class="close_btn"> <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/close.png"></a></p>
				<!--<p class="rschbtnpop"> <a href="#"><img src="<?php //echo get_template_directory_uri(); ?>/images/close.png"></a></p>-->
				
                <form class="app_form_validation" id="app_form_validation">
                
                	
                    <div class="input-group clearfix">
                    	<div class="form-control">
                        	<input name="safirst_name" id="safirst_name" placeholder="First Name" class="" type="text">	
                        </div>
                        <div class="form-control">
                        	<input name="salast_name" id="salast_name" placeholder="Last Name" class="" type="text">	
                        </div>
                        <div class="form-control">
                        	<input maxlength="10" name="saphone" id="saphone" placeholder="Phone"  type="text">	
                        </div>
                    	<div class="form-control">
                        	<input name="saemail" id="saemail" placeholder="Email"  type="text">	
                        </div>
                        <div class="form-control">
                        	<div class="multiOptions">
	                        	<select class="demo" multiple="multiple" name="sastate[]" id ="sastate" style="width:25em;"  class="validate[required]">
								
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
                            </div>
                        </div>
                        <div class="form-control">
                        	<select id="state_zone" name="state_zone">
							<option value="">Not Available</option>
							</select>
                        </div>
                        <div class="form-control">
                        	<select id="city_name" name="city_name" class="cv_required">
							<option value="">Not Available</option>
							</select>
                        </div>
                        <div class="form-control">
                        	<input type="text" name="datess" id="datess" value="Not Available">
                        </div>
                        <div class="form-control">
                        	<select id="time" name="times" class="cv_required">
							<option value="">Not Available</option>
							</select>
                        </div>
						<div class="form-control">
                        	<select id="time_slot" name="time_slot">
							<option id="apt_1h" value="1 hour">1 Hour Appointment </option>
							<option id="apt_30m" value="30 minute">30 Minutes Appointment </option>
							</select>
                        </div>
                        
                    </div>    
                  
                    <span id="show_date"> </span>                  
                    <link href="<?php echo site_url() ?>/wp-content/plugins/mkenny/css/fSelect.css" rel="stylesheet" type="text/css">                   
                    <script src="<?php echo site_url() ?>/wp-content/plugins/mkenny/js/fSelect.js"></script> 
                    <script type="text/javascript">	
						//$.noConflict();
						jQuery(function(){							
							
					       jQuery('.demo').fSelect(function(){							   
							  uncheckAll: true							   
						   });
						});					
					</script>
                    <div style="float:left;width:100%;color: #8C8C8C; padding:20px 0;">
                        <label style="float:left;">Interested In:&nbsp;&nbsp;&nbsp;</label>
                        <div class="interested">
                            <input class="check" name="interested_in[]" value="Suits" type="checkbox">
                            &nbsp;&nbsp;Suits&nbsp;
                            <input class="check" name="interested_in[]" value="Shirts" type="checkbox">
                            &nbsp;&nbsp;Shirts&nbsp;
                            <input class="check" name="interested_in[]" value="Pants" type="checkbox">
                            &nbsp;&nbsp;Pants&nbsp;
                            <input class="check" name="interested_in[]" value="Coats" type="checkbox">
                            &nbsp;&nbsp;Coats&nbsp;
                            <input class="check" name="interested_in[]" value="Formal Wear" type="checkbox">
                            &nbsp;&nbsp;
                            Formal Wear&nbsp;
                            <input class="check" name="interested_in[]" value="Wardrobe Upgrade" type="checkbox">
                            &nbsp;&nbsp;Wardrobe Upgrade&nbsp; </div>
                        <input name="sinterested" id="sinterested" value="" type="hidden">
                    </div>
                    <p class="user_comments">
                        <textarea placeholder="Message" name="samessage" id="samessage" style="width: 98%;"></textarea>
                    <div id="captcha"> captcha code:<?php echo $_SESSION['msg']; ?></div>
                    <div>
					<img src="<?php echo get_template_directory_uri(); ?>/mathcaptcha/captcha.php" id="captcha_image"> <br>
                        <label for='message'>Enter the code above here :</label>
                        <br>
                        <input id="captcha_code" name="check" type="text">
                        <br>
                        Robots don’t look good in suits! <span style="text-transform: uppercase;">click</span> <a href='javascript: refreshCaptcha();' style="text-decoration: underline;">here</a> to refresh.<br/>
                    </div>
                    <script type='text/javascript'>
						function refreshCaptcha(){
							//var img = document.images['captchaimg'];
							//img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
							jQuery('#captcha_image').attr('src', jQuery('#captcha_image').attr('src')+'#');
						}
					</script>
                    <?php //echo unset($_SESSION['msg']); ?>
                    </p>
                    <p class="actions">
                        <input class="creset" value="RESET" type="button">
                        <input id="sa_submit" value="Schedule Appointment" type="submit">
						<input id="cancel-event" type="button" value="Cancel Event" />
                    </p>
					
					<input type="hidden" name="app_id" id="app_id" value="" />
					
					<input type="hidden" name="app_booked_date" id="app_booked_date" value="" />
					
					
					
					<input type="hidden" name="answer" id="answer" value=""/ >
					
                </form>
            </div>
        </div>
    </div>
</div>
<!--appointment_popup end here --> 


<!--- popup Add Google calendar and outlook ---->
<div class="popup_overlay3" style="display: none;">
    <div class="appointment_popup">
        <div class="container-12">
		
		
            <div class="grid-12">
			
			<p id="rcData">Schedule Appointment data has been saved</p> 
                <p class="close_btnpop"> <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/close.png"></a></p>
                
            </div>
        </div>
    </div>
</div>
<!--- #popup Add Google calendar and outlook ---->

</body>