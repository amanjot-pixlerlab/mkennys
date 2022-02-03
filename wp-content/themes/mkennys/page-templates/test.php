<?php
/*
 * Template Name:testing-google-calendar
 */
 


$rootPath = get_home_path();
require_once($rootPath.'mkennys-googleCalender/settings.php');
require_once($rootPath.'mkennys-googleCalender/google-calendar-api.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$capi = new GoogleCalendarApi();
		
		// Get the access token 
		$data = $capi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		 $access_token = $data['access_token'];
		
		// We passed a state parameter in the OAuth login url. So Google will pass this parameter in the Redirect Url
		// In frontend parameters were encoded to JSON and then base64 encoded
		// In backend we base64 decode and then json decode it
		$event = json_decode(base64_decode($_GET['state']), true);

		// Get user calendar timezone
		$user_timezone = $capi->GetUserCalendarTimezone($access_token);
	
		// Create event on primary calendar
		$event_id = $capi->CreateCalendarEvent('primary', $event['title'], $event['all_day'], $event['event_time'], $user_timezone, $access_token);
		echo 'Event has been created with ID ' . $event_id;
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}



$login_url = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/calendar') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js"></script>
<style type="text/css">

#form-container {
	width: 400px;
	margin: 50px auto;
}

input[type="text"] {
	border: 1px solid rgba(0, 0, 0, 0.15);
	font-family: inherit;
	font-size: inherit;
	padding: 5px;
	border-radius: 0px;
	outline: none;
	display: block;
	margin: 0 0 20px 0;
	width: 100%;
	box-sizing: border-box;
}

select {
	border: 1px solid rgba(0, 0, 0, 0.15);
	font-family: inherit;
	font-size: inherit;
	padding: 8px;
	border-radius: 2px;
	display: block;
	width: 100%;
	box-sizing: border-box;
	outline: none;
	background: none;
	margin: 0 0 20px 0;
}

.input-error {
	border: 1px solid red !important;
}

#event-date {
	display: none;
}

#create-event {
	display: block;
	text-align: center;
	width: 100%;
}

</style>
</head>

<body>

<div id="form-container">
	<input type="text" id="event-title" placeholder="Event Title" autocomplete="off" />
	<select id="event-type"  autocomplete="off">
		<option value="FIXED-TIME">Fixed Time Event</option>
		<option value="ALL-DAY">All Day Event</option>
	</select>
	<input type="text" id="event-start-time" placeholder="Event Start Time" autocomplete="off" />
	<input type="text" id="event-end-time" placeholder="Event End Time" autocomplete="off" />
	<input type="text" id="event-date" placeholder="Event Date" autocomplete="off" />
	<a id="create-event" href="<?= $login_url ?>">Login & Create Event</a>
</div>

<script>

// Selected time should not be less than current time
function AdjustMinTime(ct) {
	var dtob = new Date(),
  		current_date = dtob.getDate(),
  		current_month = dtob.getMonth() + 1,
  		current_year = dtob.getFullYear();
  			
	var full_date = current_year + '-' +
					( current_month < 10 ? '0' + current_month : current_month ) + '-' + 
		  			( current_date < 10 ? '0' + current_date : current_date );

	if(ct.dateFormat('Y-m-d') == full_date)
		this.setOptions({ minTime: 0 });
	else 
		this.setOptions({ minTime: false });
}

// DateTimePicker plugin : http://xdsoft.net/jqplugins/datetimepicker/
$("#event-start-time, #event-end-time").datetimepicker({ format: 'Y-m-d H:i', minDate: 0, minTime: 0, step: 5, onShow: AdjustMinTime, onSelectDate: AdjustMinTime });
$("#event-date").datetimepicker({ format: 'Y-m-d', timepicker: false, minDate: 0 });

$("#event-type").on('change', function(e) {
	if($(this).val() == 'ALL-DAY') {
		$("#event-date").show();
		$("#event-start-time, #event-end-time").hide();
	}
	else {
		$("#event-date").hide(); 
		$("#event-start-time, #event-end-time").show();
	}
});

// Since we are settings event details before user authorization, we need to pass event details to the login url with the "state" parameter
// Google will pass this "state" parameter in the redirect url script
$("#create-event").on('click', function(e) {
	var blank_reg_exp = /^([\s]{0,}[^\s]{1,}[\s]{0,}){1,}$/,
		error = 0,
		parameters,
		state_parameter;

	$(".input-error").removeClass('input-error');

	if(!blank_reg_exp.test($("#event-title").val())) {
		$("#event-title").addClass('input-error');
		error = 1;
	}

	if($("#event-type").val() == 'FIXED-TIME') {
		if(!blank_reg_exp.test($("#event-start-time").val())) {
			$("#event-start-time").addClass('input-error');
			error = 1;
		}		

		if(!blank_reg_exp.test($("#event-end-time").val())) {
			$("#event-end-time").addClass('input-error');
			error = 1;
		}
	}
	else if($("#event-type").val() == 'ALL-DAY') {
		if(!blank_reg_exp.test($("#event-date").val())) {
			$("#event-date").addClass('input-error');
			error = 1;
		}	
	}

	if(error == 1)
		return false;

	if($("#event-type").val() == 'FIXED-TIME') {
		// If end time is earlier than start time, then interchange them
		if($("#event-end-time").datetimepicker('getValue') < $("#event-start-time").datetimepicker('getValue')) {
			var temp = $("#event-end-time").val();
			$("#event-end-time").val($("#event-start-time").val());
			$("#event-start-time").val(temp);
		}
	}

	// Event details
	parameters = { 	title: $("#event-title").val(), 
					event_time: {
						start_time: $("#event-type").val() == 'FIXED-TIME' ? $("#event-start-time").val().replace(' ', 'T') + ':00' : null,
						end_time: $("#event-type").val() == 'FIXED-TIME' ? $("#event-end-time").val().replace(' ', 'T') + ':00' : null,
						event_date: $("#event-type").val() == 'ALL-DAY' ? $("#event-date").val() : null
					},
					all_day: $("#event-type").val() == 'ALL-DAY' ? 1 : 0,
				};
	
	// To pass the "state" parameter, JSON encode and base64 encode the event details
	state_parameter = btoa(JSON.stringify(parameters));

	// Append the "state" parameter to the login url
	$("#create-event").attr('href', $("#create-event").attr('href') + '&state=' + state_parameter);
});

</script>

</body>

</html>
 