<?php
require_once('settings.php');
require_once('google-calendar-api.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$capi = new GoogleCalendarApi();
		
		// Get the access token 
		$data = $capi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		echo $access_token = $data['access_token'];
		exit;
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

?>