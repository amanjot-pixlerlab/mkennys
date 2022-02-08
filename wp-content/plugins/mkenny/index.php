<?php
/*
Plugin Name: mkenny
Plugin URI: ''
Description: This is plugin 
Version:     20160911
Author:      tr group
Author URI:  ''
License:     GPL2
*/

add_action('admin_menu', 'my_plugin_menu');

function my_plugin_menu()
{

	add_menu_page('Mkennys Dashboard', 'Mkennys Dashboard', 'manage_options', 'mkenny-admin-page.php', 'mkenny_admin_page', 'dashicons-tickets', 6);
	// add_submenu_page( 'mkenny-admin-page.php', 'Mkenny State', 'Add State', 'manage_options', 'mkenny-admin-state-page.php', 'mkenny_admin_sub_page'); 
	// add_submenu_page( 'mkenny-admin-page.php', 'Upcoming Events', 'Upcoming Events', 'manage_options', 'mkenny-admin-upevent.php', 'mkenny_admin_upcevent_page');
	// add_submenu_page( 'mkenny-admin-page.php', 'Add Statezone', 'Add Statezone', 'manage_options', 'mkenny-admin-statezone.php', 'mkenny_admin_statezone_page'); 
	add_submenu_page('mkenny-admin-page.php', 'Upcoming Schedules', 'Upcoming Schedules', 'manage_options', 'mkenny-admin-schedule.php', 'mkenny_admin_schedule_page');
	add_submenu_page('mkenny-admin-page.php', 'Calendar Appointments', 'Calendar Appointments', 'manage_options', 'mkenny-admin-calendar-event.php', 'mkenny_admin_calendar_event_page');
	add_submenu_page('mkenny-admin-page.php', 'Email List', 'Email List', 'manage_options', 'mkenny-admin-mailing-list.php', 'mkenny_admin_mailing_list_page');
	add_submenu_page('mkenny-admin-page.php', 'Referral List', 'Referral List', 'manage_options', 'mkenny-admin-refer-list.php', 'mkenny_admin_refer_list_page');
	// add_submenu_page('mkenny-admin-page.php', 'Email List', 'Email List', 'manage_options', 'mkenny-admin-mailing-list.php', 'mkenny_admin_mailing_list_page');
	// add_submenu_page('mkenny-admin-page.php', 'Upcoming Cities', 'Upcoming Cities', 'manage_options', 'mkenny-admin-upcoming-cities.php', 'mkenny_admin_upcoming_cities_page');

	remove_submenu_page('mkenny-admin-page.php', 'mkenny-admin-page.php');
}


function mkenny_admin_page()
{
	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}
	include('mkenny-admin-page.php');
}

function mkenny_admin_sub_page()
{
	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}
	include('mkenny-admin-state-page.php');
}

function mkenny_admin_upcevent_page()
{

	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}
	include('mkenny-admin-upevent.php');
}

function mkenny_admin_statezone_page()
{

	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}
	include('mkenny-admin-statezone.php');
}

function mkenny_admin_schedule_page()
{
	global $getScheduleById;
	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}

	include('mkenny-admin-schedule.php');
}


function mkenny_admin_upcoming_cities_page()
{

	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}
	include('mkenny-admin-upcoming-cities.php');
}


function mkenny_admin_calendar_event_page()
{

	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}

	include('mkenny-admin-calendar-event.php');
}

function mkenny_admin_mailing_list_page()
{

	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}

	include('mkenny-admin-mailing-list.php');
}

function mkenny_admin_refer_list_page()
{

	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}

	include('mkenny-admin-refer-list.php');
}

/*Upcoming cities*/

add_shortcode('upcomingCity', 'upcoming_city');

function upcoming_city($atts)
{
	global $wpdb;

	$sql = "select se.city_name,adt.event_id,min(adt.start_date) as start_date  from wp_schedule_events se,wp_appointment_date_time adt where adt.event_id=se.id and se.status='1' and se.is_delete='1' and adt.start_date >= DATE_FORMAT(CURRENT_DATE,'%m/%d/%Y') group by adt.event_id order by adt.start_date limit 0,6";

	$retrievedatas = $wpdb->get_results($sql);

	$upcoming = '';
	$upcoming .= '<ul class="clearfix unstyled-list">';

	$eventDate_upcoming = "";
	$dayName_upcoming = "";
	$eventMonth_upcoming = "";
	$prevMonth_upcoming = "";
	$dateCounter_upcoming = 0;


	foreach ($retrievedatas as $retrievedata) {



		$upcoming .= '<li>';




		$startdate_arr = explode("/", $retrievedata->start_date);
		$sdate = $startdate_arr[2] . "-" . $startdate_arr[0] . "-" . $startdate_arr[1];
		$sdate = date("F j l", strtotime($sdate));
		$today = date("Y-m-d");
		$startDate = explode(" ", $sdate);



		$eventDate_upcoming = $startDate['1'];
		//$dayName_upcoming = $startDate['2'];
		$eventMonth_upcoming = $startDate['0'];

		//for local	
		$upcoming .= '<a href="/mkennys/tour-schedule/?action=' . $retrievedata->event_id . '">';

		//for live
		//$upcoming .= '<a href="/tour-schedule/?action='.$retrievedata->event_id.'">';

		$upcoming .= "<p><b>" . $eventMonth_upcoming . ' ' . $eventDate_upcoming . "</b></p>";
		$upcoming .= '<p>' . $retrievedata->city_name;
		$upcoming .= '</p>';
		$upcoming .= '</a>';
		$upcoming .= '</li>';
		$eventDate_upcoming = '';
		$eventMonth_upcoming = '';
	}

	$upcoming .= '</ul>';
	return $upcoming;
}

/*#Upcoming cities*/




//Short code for Upcoming Evenets
add_shortcode('foobar', 'foobar_func');
function foobar_func($atts)
{
	global $wpdb;

	$limit = 6;
	if (isset($atts['limit'])) {
		$limit = $atts['limit'];
	}

	$sql = "select se.city_name,adt.event_id,min(adt.start_date) as start_date from wp_schedule_events se,wp_appointment_date_time adt where adt.event_id=se.id and se.status='1' and se.is_delete='1' and CONCAT(SUBSTRING(adt.start_date, 7, 4),SUBSTRING(adt.start_date, 1, 2),SUBSTRING(adt.start_date, 4, 2)) >= DATE_FORMAT(CURRENT_DATE,'%Y%m%d') group by adt.event_id order by adt.start_date limit 0,${limit}";

	// $sql = "select se.city_name,adt.event_id,min(adt.start_date) as start_date from wp_schedule_events se,wp_appointment_date_time adt where adt.event_id=se.id and se.status='1' and se.is_delete='1' and CONCAT(SUBSTRING(adt.start_date, 7, 4),SUBSTRING(adt.start_date, 1, 2),SUBSTRING(adt.start_date, 4, 2)) >= DATE_FORMAT('2023-04-07','%Y%m%d') group by adt.event_id order by adt.start_date limit 0,7";

	/*
if(!empty($atts['limit'])){
	$sql="select se.city_name,adt.event_id,min(adt.start_date) as start_date  from wp_schedule_events se,wp_appointment_date_time adt where adt.event_id=se.id and se.status='1' and se.is_delete='1' and adt.start_date >= DATE_FORMAT(CURRENT_DATE,'%m/%d/%Y') group by adt.event_id order by adt.start_date limit 0,7";	//added city_name
}else{
	$sql="select se.city_name,adt.event_id,min(adt.start_date) as start_date  from wp_schedule_events se,wp_appointment_date_time adt where adt.event_id=se.id and se.status='1' and se.is_delete='1' and adt.start_date >= DATE_FORMAT(CURRENT_DATE,'%m/%d/%Y') group by adt.event_id order by adt.start_date limit 0,6";	//added city_name
}
*/

	$retrievedatas = $wpdb->get_results($sql);

	$count = count($retrievedatas);
	if($limit > $count ){
		$limit_rest = $limit - $count;
		$cities_sql = "select id as event_id, city_name from wp_schedule_events GROUP BY city_name ORDER BY city_name limit 0,${limit_rest}";
		$cities=$wpdb->get_results($cities_sql);
		$retrievedatas =array_merge($retrievedatas,$cities);

	}

	$upevent = '';
	$upevent .= '<ul class="clearfix unstyled-list">';
	$eventDate_upcoming = "";
	$dayName_upcoming = "";
	$eventMonth_upcoming = "";
	$prevMonth_upcoming = "";
	$dateCounter_upcoming = 0;


	foreach ($retrievedatas as $retrievedata) {

		//get states
		$stateQuery = "select st.state_name,st.state_short,ses.statezone_id from wp_schedule_event_state ses ,wp_state st where ses.event_id='" . $retrievedata->event_id . "' and ses.state_id=st.id";
		$states = $wpdb->get_results($stateQuery);
		$total = count($states) - 1;
		$statesCombine = '';
		$short_name = '';
		foreach ($states as $key => $state) {
			if (count($states) > 1) {
				if ($total == $key) {
					$statesCombine .= $state->state_short;
				} else {
					$statesCombine .= $state->state_short . '<span>/<span>';
				}
			} else {
				if (!empty($state->statezone_id)) {
					$zoneQuery = "select state_zone from wp_statezone where id='" . $state->statezone_id . "'";
					$zones = $wpdb->get_results($zoneQuery);
					$statesCombine .= $zones['0']->state_zone;
				} else {
					$statesCombine .= $state->state_name;
					$short_name .= $state->state_short;
				}
			}
		}

		//set dates
		if(isset($retrievedata->start_date)){
			$startdate_arr = explode("/", $retrievedata->start_date);
			$sdate = $startdate_arr[2] . "-" . $startdate_arr[0] . "-" . $startdate_arr[1];
			$sdate = date("F j l", strtotime($sdate));
			$startDate = explode(" ", $sdate);
			$eventDate_upcoming = $startDate['1'];
			//$dayName_upcoming = $startDate['2'];
			$eventMonth_upcoming = $startDate['0'];
			$startDate = $eventMonth_upcoming . ' ' . $eventDate_upcoming;
		}else{
			$startDate = 'TBD';
		}

		$upevent .= '<li>';						
		$upevent .= '<a href="' . home_url() . '/new-tour-schedule/#' . $statesCombine . '">';

		if (!empty($atts['limit'])) {
			$upevent .= "<b>" . $startDate . "</b>";
			//show city and state
			if (isset($retrievedata->city_name)) {
				$upevent .= '<span>' . $retrievedata->city_name;
			} else {
				$upevent .= '<span>' . $statesCombine;
			}
			if ($short_name) {
				$upevent .= ', ' . $short_name;
			}
			$upevent .= '</span>';
		} else {
			$upevent .= "<p><b>" . $startDate . "</b></p>";
			//show city and state
			if (isset($retrievedata->city_name)) {
				$upevent .= '<p>' . $retrievedata->city_name;
			} else {
				$upevent .= '<p>' . $statesCombine;
			}
			if ($short_name) {
				$upevent .= ', ' . $short_name;
			}
			$upevent .= '</p>';
		}

		$upevent .= '</a>';
		$upevent .= '</li>';
		$eventDate_upcoming = '';
		$eventMonth_upcoming = '';

		//}

	}

	$upevent .= '</ul>';
	return $upevent;
}

// #Short code for Upcoming Evenets

//Short code for Tour Scheduling
add_shortcode('tourSchedule', 'tour_scheduling');
function tour_scheduling($atts)
{

	global $wpdb;
	$sql = '';
	$stsid = '';
	$stsid = $atts['stateid'];


	if ($atts['stateid'] != 0 && $atts['allstate'] == 0) {

		$sql = "select wp_appointment_date_time.start_date, wp_schedule_events.id, wp_schedule_event_state.event_id,
	(select count(*) from wp_schedule_event_state s where s.event_id=wp_schedule_event_state.event_id) mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_schedule_events.suite,wp_statezone.state_zone, wp_schedule_events.location,wp_schedule_events.contact_name, wp_schedule_events.phone_no,wp_schedule_events.alternative_phone_no, wp_schedule_events.upcoming_event,wp_schedule_events.status 
    from wp_schedule_event_state 
    LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id AND wp_schedule_event_state.state_id ='" . $stsid . "' 
	LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id 
	LEFT JOIN wp_state ON wp_state.id = '" . $stsid . "' 
	LEFT JOIN wp_appointment_date_time ON wp_schedule_event_state.event_id = wp_appointment_date_time.event_id
	where wp_schedule_events.status='1' AND wp_schedule_event_state.state_id = '" . $stsid . "' and wp_schedule_events.is_delete='1' and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1'and wp_schedule_event_state.status='1' and wp_state.status='1' GROUP BY wp_schedule_event_state.event_id having mult_id>0 order by state_zone,mult_id,state_name";
	}

	if ($atts['stateid'] != 0 && $atts['allstate'] == 1) {


		$sql = " select wp_appointment_date_time.start_date, wp_schedule_events.id, wp_schedule_event_state.event_id,
 (select count(*) from wp_schedule_event_state s where s.event_id=wp_schedule_event_state.event_id) mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_schedule_events.suite,wp_statezone.state_zone, wp_schedule_events.location,wp_schedule_events.contact_name, wp_schedule_events.phone_no,wp_schedule_events.alternative_phone_no, wp_schedule_events.upcoming_event,wp_schedule_events.status from wp_schedule_event_state LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id LEFT JOIN wp_state ON wp_state.id = wp_schedule_event_state.state_id
 LEFT JOIN wp_appointment_date_time ON wp_schedule_event_state.event_id = wp_appointment_date_time.event_id
 where wp_schedule_events.status='1' and wp_schedule_events.is_delete='1'  and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1'and wp_schedule_event_state.status='1' and wp_schedule_event_state.state_id !='" . $stsid . "' and  wp_state.status='1' GROUP BY wp_schedule_event_state.event_id having mult_id>0 order by state_zone,mult_id,state_name";
	}
	if ($atts['stateid'] == 0 && $atts['allstate'] == 1) {
		$sql = "select  wp_appointment_date_time.start_date, wp_schedule_events.id, wp_schedule_event_state.event_id, 
(select count(*) from wp_schedule_event_state s where s.event_id=wp_schedule_event_state.event_id) mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_schedule_events.suite,wp_statezone.state_zone, wp_schedule_events.location,wp_schedule_events.contact_name, wp_schedule_events.phone_no,wp_schedule_events.alternative_phone_no, wp_schedule_events.upcoming_event,wp_schedule_events.status
from wp_schedule_event_state LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id LEFT JOIN wp_state ON wp_state.id = wp_schedule_event_state.state_id
LEFT JOIN wp_appointment_date_time ON wp_schedule_event_state.event_id = wp_appointment_date_time.event_id
where wp_schedule_events.status='1'
and wp_schedule_events.is_delete='1' and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1'and wp_schedule_event_state.status='1' and wp_state.status='1'
GROUP BY wp_schedule_event_state.event_id having mult_id>0 order by state_zone,state_name,start_date";
	}

	if (isset($atts['statelist']) && $atts['statelist']) {

		// ?? Array unique
		// 	$sql="select  wp_appointment_date_time.start_date, wp_schedule_events.id, wp_schedule_event_state.event_id, 
		// (select count(*) from wp_schedule_event_state s where s.event_id=wp_schedule_event_state.event_id) mult_id,wp_state.state_name,wp_state.id as stateId, wp_state.state_short,wp_schedule_events.city_name,wp_schedule_events.suite,wp_statezone.state_zone, wp_schedule_events.location,wp_schedule_events.contact_name, wp_schedule_events.phone_no,wp_schedule_events.alternative_phone_no, wp_schedule_events.upcoming_event,wp_schedule_events.status
		// from wp_schedule_event_state LEFT JOIN wp_statezone ON wp_statezone.id = wp_schedule_event_state.statezone_id LEFT JOIN wp_schedule_events ON wp_schedule_events.id = wp_schedule_event_state.event_id LEFT JOIN wp_state ON wp_state.id = wp_schedule_event_state.state_id
		// LEFT JOIN wp_appointment_date_time ON wp_schedule_event_state.event_id = wp_appointment_date_time.event_id
		// where wp_schedule_events.status='1'
		// and wp_schedule_events.is_delete='1' and wp_schedule_event_state.is_delete='1' and wp_state.is_delete='1'and wp_schedule_event_state.status='1' and wp_state.status='1'
		// GROUP BY wp_state.state_name having mult_id>0 order by state_zone,state_name,start_date";

		// New tour page
		$tour_schedulings = $wpdb->get_results($sql);
		// $unique = array_unique($tour_schedulings);

		$touSchedulingNew = '';




		// print_r($tour_schedulings);

		foreach ($tour_schedulings as $tour_scheduling) {
			$date = $tour_scheduling->start_date;
			$dateDiff = strtotime($date) > time();
			$dateDiffClass = '';

			if ($dateDiff > 0) {
				$dateDiffClass = 'gall-trigger';
			} else {
				$dateDiffClass = 'notifiedBtn';
			}


			$touSchedulingNew .= '<div id="ts_' . $tour_scheduling->event_id . '" class="ts_data_list_item ts_state' . $tour_scheduling->stateId . '">';
			$touSchedulingNew .= '<div class="ts_data_list_top"><div class="d-flex"><div class="date">' . date('d', strtotime($date)) . '</div><div>' . date('F', strtotime($date)) . ' <br />' . date('D', strtotime($date)) . '</div></div>
								<div class="d-flex date-duration">
									<div>From <br />10:00 am</div>
									<div>Till <br />6:00 pm</div>
								</div>
							</div>
							<div class="ts_data_list_bottom">
								<div class="title">
									<h3>' . $tour_scheduling->state_name . '</h3>
								</div>
								<div class="ts_location">
									<strong>' . $tour_scheduling->city_name . '</strong>
									' . htmlspecialchars_decode($tour_scheduling->location) . '
									<p style="margin-top: 12px; font-weight: 300;">Phone: ' . $tour_scheduling->phone_no . '</p>
								</div>
								<div>
									<b>' . $tour_scheduling->contact_name . '</b>
									' . $tour_scheduling->phone_no . ' <br>
									' . $tour_scheduling->alternative_phone_no . '
								</div>
								<div class="text-right">
									<a href="javascript:void(0)" id="' . $tour_scheduling->event_id . '" rel="' . $date . '" class="btn-appointment ' . $dateDiffClass . '">Book Appointment <i class="fa fa-chevron-right"></i></a>
								</div>
							</div>'; // Inner Data
			$touSchedulingNew .= '</div>'; // /.ts_data_list_item
		}

		return $touSchedulingNew;

		// ?? ts_stateList Data

		// $touScheduling .= '<ul class="ts_stateList">';
		// foreach ($tour_schedulings as $tour_scheduling){
		// 	$touScheduling .= '<li class="active"><a data-id="'.$tour_scheduling->stateId.'" data-name="'.$tour_scheduling->state_short.'" href="#'.$tour_scheduling->state_name.'">'.$tour_scheduling->state_name.'</a></li>';
		// }
		// $touScheduling .= '</ul>';

		// return $touScheduling;
	} // new tour page
	else {

		// other Your pages
		$tour_schedulings = $wpdb->get_results($sql);

		$touScheduling = '';
		$endDate = '';
		$startDate = '';


		$ids = array();
		$multi_state = array();
		$previous_event_id = '';
		$i = 0;

		$query = "select * from wp_appointment_date_time where event_id = '" . $tour_scheduling->event_id . "' order by `start_date` asc ";
		$dateTime_rec = $wpdb->get_results($query);
		foreach ($tour_schedulings as $tour_scheduling) {

			$from = date_create($tour_scheduling->start_date);
			$to = date_create(date('Y-m-d'));
			$diff = date_diff($to, $from);
			print_r($tour_scheduling->end_time);
			$daysDiff = $diff->format('%R%a');

			$listingClassName = '';


			$alternative_phone_no = "";
			$myval[] = $tour_scheduling;

			$draw_line = '';

			$today = date("Y-m-d");
			$lastsql = "select adt.start_date as lastDate from wp_appointment_date_time adt WHERE adt.start_date = (SELECT max(adt2.start_date) FROM wp_appointment_date_time adt2 WHERE adt2.event_id='" . $previous_event_id . "')";
			$lastDate = $wpdb->get_results($lastsql);
			$lastdate = date("Y-m-d", strtotime($lastDate['0']->lastDate));
			//echo $previous_event_id."<br/>";

			$nextMonth = date("Y-m-d", strtotime(" +2 months"));

			// print_r(date_diff(date_create(date('Y-m-d')),date_create($lastdate))->format('%R%a'));

			$diffDates = date_diff(date_create(date('Y-m-d')), date_create($lastdate))->format('%R%a');

			$last_key = end(array_keys($dateTime_rec));

			if (isset($atts['withinmonths']) && $atts['withinmonths']) {
				$totalDays = $atts['withinmonths'] * 30;
				if (strtotime($tour_scheduling->start_date) > time() && $daysDiff > 0 && $daysDiff < 60) {
					$listingClassName = 'active-shop';
				} else {
					$listingClassName = 'hide-shop';
				}
			}

			if ($today <= $lastdate) {

				if ($tour_scheduling->state_name != $previous_state && $i != 0 && $tour_scheduling->state_zone == '') {

					$touScheduling .= '<p class="offtime_message ' . $listingClassName . '">Schedule an appointment by clicking on the “Get Fitted” button above or call us at (800) 220-8469. If you are calling after office hours, please call the hotel directly and request the representative’s name, only on the dates listed above.</p>';
				}


				if ($tour_scheduling->state_zone != $zone && $i != 0) {

					$touScheduling .= '<p class="offtime_message ' . $listingClassName . '">Schedule an appointment by clicking on the icon or call us at toll free at (800) 220-8469. If you are calling after office hours, please call the hotel directly and request the representative\'s name, only on the dates listed above. </p>';
				}
			}



			if ($i != 0) {
				$touScheduling .= '</div>';
			}
			if ($tour_scheduling->mult_id > 1) {

				$sql = "select wp_state.id,wp_state.state_name from wp_state,wp_schedule_event_state
					where wp_schedule_event_state.state_id = wp_state.id 
					and wp_schedule_event_state.event_id ='" . $tour_scheduling->event_id . "' and wp_schedule_event_state.state_id !='" . $stsid . "' ";
				$multistates = $wpdb->get_results($sql);
				$state = '';
				$total = count($multistates) - 1;
				foreach ($multistates as $key => $multistate) {
					if ($total == $key) {
						$state .= $multistate->state_name;
						$my_state .= $multistate->state_name;
					} else {
						$state .= $multistate->state_name . '<span>/</span>';
						$my_state .= $multistate->state_name . ' / ';
					}
				}

				$tour_scheduling->stateId = '';
			}
			$multi_state[] = $state;
			$multi_state = array_unique($multi_state);

			//echo $state;
			// echo "<pre>";print_r($multi_state);



			if ($tour_scheduling->mult_id > 1) {
				$touScheduling .= '<div class="tourList tt clearfix" id="state_mult_' . $tour_scheduling->stateId . '">';
			} else {
				$touScheduling .= '<div class="tourList test clearfix ' . $daysDiff . ' ' . $listingClassName . ' state_' . $tour_scheduling->stateId . '" id="state_' . $tour_scheduling->stateId . '">';
			}

			if ($tour_scheduling->mult_id > 1) {
				if ($same_multi[0] == $state) {
					$draw_line = '<div class="draw_line  ' . $listingClassName . '"></div>';
				} else {

					$h2_state_name = str_replace(" ", "_", strtolower($state));
					$touScheduling .= '<h2 id=' . $h2_state_name . '>' . strtoupper($state) . '</h2>';
				}
				$same_multi[0] = $state;
			} elseif ($tour_scheduling->state_zone == '') {



				if ($tour_scheduling->state_name == $previous_state) {
					$draw_line = '
						 
						 <div class="draw_line ' . $listingClassName . '"></div>';
				} else {
					$changeState = true;
					$h2_state_name = str_replace(" ", "_", strtolower($tour_scheduling->state_name));
					$touScheduling .= '<h2 id=' . $h2_state_name . '>' . strtoupper($tour_scheduling->state_name) . '</h2>';
				}
			} else {
				if ($zone == $tour_scheduling->state_zone) {
					$draw_line = '<div class="draw_line ' . $listingClassName . '"></div>';
				} else {
					$h2_state_name = str_replace(" ", "_", strtolower($tour_scheduling->state_zone));
					$touScheduling .= '<h2 id=' . $h2_state_name . '>' . strtoupper($tour_scheduling->state_zone) . '</h2>';
				}
			}


			// $touScheduling .='<br/>';
			$touScheduling .= $draw_line;
			$touScheduling .= '<div id="' . $tour_scheduling->event_id . '"  class="box clearfix ' . $listingClassName . '">';
			$touScheduling .= '<div class="innerbox1">';
			if ($tour_scheduling->mult_id > 1) {
				$touScheduling .= '<span style="display:none">' . strtoupper($my_state) . '</span>';
			} else {
				if ($tour_scheduling->state_zone != '') {
					$touScheduling .= '<span style="display:none">' . strtoupper($tour_scheduling->state_zone) . '</span>';
				} else {
					$touScheduling .= '<span style="display:none">' . strtoupper($tour_scheduling->state_name) . '</span>';
				}
			}
			$touScheduling .= '<h6>' . $tour_scheduling->city_name . '</h6>';
			$touScheduling .= '<div class="location">' . htmlspecialchars_decode($tour_scheduling->location) . '</div>';
			$touScheduling .= '</div>';
			$touScheduling .= '<div class="innerbox2">';
			$touScheduling .= '<b>Dates</b>';

			//$query="select * from wp_appointment_date_time where event_id='".$tour_scheduling->event_id."' order by `start_date` asc ";

			//$query="select * from wp_appointment_date_time where event_id IN(select event_id from wp_schedule_event_state where  state_id='".$tour_scheduling->stateId."') order by `start_date` asc ";		



			//var_dump($query); exit;
			//$query = "select * from wp_appointment_date_time,wp_schedule_event_state where wp_appointment_date_time.event_id = '".$tour_scheduling->event_id."' and wp_schedule_event_state.event_id='".$tour_scheduling->event_id."' and wp_schedule_event_state.state_id='".$tour_scheduling->stateId."'  order by wp_appointment_date_time.start_date desc";

			$query = "select * from wp_appointment_date_time where event_id = '" . $tour_scheduling->event_id . "' order by `start_date` asc ";
			$dateTime_rec = $wpdb->get_results($query);
			$last_key = end(array_keys($dateTime_rec));


			$eventDate = "";
			$dayName = "";
			$eventMonth = "";
			$futureData = false;
			$prevMonth = "";
			$dateCounter = 0;
			foreach ($dateTime_rec as $key => $dateTime) {

				$get_fited = '';
				$startdate_arr = explode("/", $dateTime->start_date);
				$sdate = $startdate_arr[2] . "-" . $startdate_arr[0] . "-" . $startdate_arr[1];
				$app_schedule_date = $sdate;
				$sdate = date("F j l", strtotime($sdate));
				$today = date("Y-m-d");
				$startDate = explode(" ", $sdate);
				$lastsql = "select adt.start_date as lastDate from wp_appointment_date_time adt WHERE adt.start_date = (SELECT max(adt2.start_date) FROM wp_appointment_date_time adt2 WHERE adt2.event_id='" . $tour_scheduling->event_id . "')";
				$lastDate = $wpdb->get_results($lastsql);
				$lastdate = date("Y-m-d", strtotime($lastDate['0']->lastDate));

				if ($today > $lastdate) {

					if ($key == $last_key) {
						$touScheduling .= '<p class="ptbd">TBD</p>';
						$get_fited = '<p><a href="javascript:;" id="' . $tour_scheduling->event_id . '" rel="' . $tour_scheduling->start_date . '"
										class="getFitted notifiedBtn" style="background-color:#aeaeae">Get Notified <i class="fa fa-chevron-down"></i></a></p>';
					}
				} else {

					$futureData = true;

					$timebeforesixpm = date('H:i:s', strtotime("06.00 PM"));
					$time_running = date('H:i:s', strtotime($dateTime->end_time));


					//if($today<=$app_schedule_date){


					if ($prevMonth != $startDate['0']) {
						if ($dateCounter > 0) {
							$eventMonth .= " - ";

							if ($time_running < $timebeforesixpm) {
								//if($dateTime->end_time != '08.00 PM'){	
								//echo "Hello";		
								$specialDate .= 'On' . ' ' . $startDate['2'] . ' ' . 'till' . ' ' . $dateTime->end_time . '<br/>';
							}
						}
						$eventMonth .= $startDate['0'] . '  ' . $startDate['1'];
					} else {
						if ($dateCounter > 0) {
							if ($key == $last_key) {
								$eventMonth .= " - " . $startDate['1'];
							}

							if ($time_running < $timebeforesixpm) {

								//if($dateTime->end_time != '08.00 PM'){									
								$specialDate .= 'On' . ' ' . $startDate['2'] . ' ' . 'till' . ' ' . $dateTime->end_time . '<br/>';
							}
						} else {
							$eventMonth .= $startDate['0'] . '  ' . $startDate['1'];
						}
					}

					if ($dateCounter > 0) {
						if ($key == $last_key) {
							$eventDate .= " - ";
							$dayName .= " - " . $startDate['2'];
						}
					}

					if (($time_running < $timebeforesixpm) && ($dateCounter == '0')) {
						$specialDate .= 'On' . ' ' . $startDate['2'] . ' ' . 'till' . ' ' . $dateTime->end_time . '<br/>';
					}

					$eventDate .= $startDate['1'];
					if ($dateCounter == 0) {
						$dayName .= $startDate['2'];
					}

					$prevMonth = $startDate['0'];
					//$touScheduling = $startDate['0'].' '.$startDate['1'].'<br/>'.$startDate['2'];


				}

				$dateCounter++;
			}


			if ($futureData) {
				$touScheduling .= "<p>" . $eventMonth . "<br>" . $dayName . "<br>" . $specialDate . "</p>";
			}

			$touScheduling .= '</div>';
			$touScheduling .= '<div class="innerbox3">';
			$touScheduling .= '<b>Contact</b>';

			$touScheduling .= '<p>' . $tour_scheduling->contact_name . '</p>';

			if ($tour_scheduling->alternative_phone_no != '') {
				$alternative_phone_no = "<br>" . $tour_scheduling->alternative_phone_no;
			}


			$touScheduling .= '<p>' . $tour_scheduling->phone_no . $alternative_phone_no . '</p>';
			$touScheduling .= '</div>';
			$touScheduling .= '<div class="innerbox4">';
			if (empty($get_fited)) {
				$touScheduling .= '<p><a href="javascript:;" id="' . $tour_scheduling->event_id . '" rel="' . $tour_scheduling->start_date . '" class="getFitted gall-trigger">Get Fitted <i class="fa fa-chevron-right"></i></a></p>';
			} else {
				$touScheduling .= $get_fited;
			}



			$touScheduling .= '</div>';
			$touScheduling .= '</div>';

			$zone = $tour_scheduling->state_zone;
			$previous_state = $tour_scheduling->state_name;
			$previous_event_id = $tour_scheduling->event_id;
			$specialDate = '';
			$i++;
		}
	}



	$today = date("Y-m-d");
	$lastsql = "select adt.start_date as lastDate from wp_appointment_date_time adt WHERE adt.start_date = (SELECT max(adt2.start_date) FROM wp_appointment_date_time adt2 WHERE adt2.event_id='" . $tour_scheduling->event_id . "')";
	$lastDate = $wpdb->get_results($lastsql);
	$lastdate = date("Y-m-d", strtotime($lastDate['0']->lastDate));
	if ($today < $lastdate) {

		$touScheduling .= '<p class="offtime_message">Schedule an appointment by clicking on the “Get Fitted” button above or call us at (800) 220-8469. If you are calling after office hours, please call the hotel directly and request the representative’s name, only on the dates listed above.</p>';
	}
	$touScheduling .= '</div>';
	return $touScheduling;
}

//#Short code for Tour Scheduling


//State table creation
register_activation_hook(__FILE__, 'jal_install');
function jal_install()
{

	global $wpdb;
	global $jal_db_version;
	$jal_db_version = '1.0';

	$table_name = $wpdb->prefix . 'state';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name(
		id mediumint(9) NOT NULL AUTO_INCREMENT,		
		state_name varchar(55) NOT NULL,
		state_short varchar(55) NOT NULL,
		status ENUM('1', '0') NOT NULL default '1',
		is_delete ENUM('1', '0') NOT NULL default '1',
		created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,		
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option('jal_db_version', $jal_db_version);
}

// #State table creation

register_activation_hook(__FILE__, 'upce_install');


//Upcoming Evenets table creation
function upce_install()
{

	global $wpdb;
	global $jal_db_version;
	$jal_db_version = '1.0';

	$table_name = $wpdb->prefix . 'up_coming_event';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,		
		start_date varchar(55) NOT NULL,
		end_date varchar(55) NOT NULL,
		state_id int NOT NULL,
		status ENUM('1', '0') NOT NULL default '1',
		is_delete ENUM('1', '0') NOT NULL default '1',
		created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,		
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option('jal_db_version', $jal_db_version);
}

//#Upcoming Evenets table creation


//Statezone  table creation
register_activation_hook(__FILE__, 'statezone_install');

function statezone_install()
{

	global $wpdb;
	global $jal_db_version;
	$jal_db_version = '1.0';

	$table_name = $wpdb->prefix . 'statezone';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		state_id int NOT NULL,
		state_zone varchar(55) NOT NULL,
		status ENUM('1', '0') NOT NULL default '1',
		is_delete ENUM('1', '0') NOT NULL default '1',
		created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,		
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option('jal_db_version', $jal_db_version);
}

//#Statezone  table creation

//schedule event table creation
register_activation_hook(__FILE__, 'schedule_event_install');

function schedule_event_install()
{

	global $wpdb;
	global $jal_db_version;
	$jal_db_version = '1.0';

	$table_name = $wpdb->prefix . 'schedule_events';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id int(11) NOT NULL AUTO_INCREMENT,
		city_name varchar(55) NOT NULL,
		start_date VARCHAR(255) NOT NULL,
		end_date VARCHAR(255) NOT NULL,
		start_time VARCHAR(255) NOT NULL,
		end_time VARCHAR(255) NOT NULL,	
		location varchar(255) NOT NULL,
		contact_name (100) NOT NULL,
		phone_no varchar(55) NOT NULL,		
		upcoming_event ENUM('1','0') NOT NULL,
		status ENUM('1', '0') NOT NULL default '1',
		multi_select ENUM('1', '0') NOT NULL,
		created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		is_delete ENUM('1', '0') NOT NULL default '1',
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option('jal_db_version', $jal_db_version);
}

//#schedule event table creation


//schedule event state table creation

register_activation_hook(__FILE__, 'schedule_event__state_install');

function schedule_event__state_install()
{

	global $wpdb;
	global $jal_db_version;
	$jal_db_version = '1.0';

	$table_name = $wpdb->prefix . 'schedule_event_state';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id int(11) NOT NULL AUTO_INCREMENT,
		event_id int(11) NOT NULL,		
		state_id int(11) NOT NULL,		
		statezone_id int(11) NULL,
		status ENUM('1', '0') NOT NULL default '1',
		created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		is_delete ENUM('1', '0') NOT NULL default '1',
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option('jal_db_version', $jal_db_version);
}
//#schedule event table creation


add_action('admin_footer', 'my_action_javascript'); // Write our JS below here


function my_action_javascript()
{ ?>



	<script type="text/javascript">
		//$.noConflict();
		jQuery(document).ready(function() {

			jQuery('#zones').hide();
			var stateID = '';




			jQuery('#multi_state').on('change', function() {
				//alert('ppp');

				var count = jQuery('#multi_state :selected').length;

				if (count == '1') {
					jQuery('.sz').show();
					jQuery('#zones').show();

					// stateID = $(this).val();
					stateID = jQuery('select option:selected').val();


					var data = {
						'action': 'my_action',
						'state_id': stateID // We pass php values differently!
					};
					var ajaxurl = '<?php echo admin_url("admin-ajax.php", null); ?>';



					jQuery.post(ajaxurl, data, function(response) {
						if (response == 1) {
							jQuery('#zones').hide();
							jQuery(".sz").html('');
						} else {
							jQuery('#zones').hide();
							jQuery(".sz").html(response);
						}


					});



				} else {
					if (count > 1) {
						jQuery('.sz').hide();
					}
					jQuery('#state_zone').attr('disabled', true);

				}

				return false;
			});

			//This code for editing
			<?php if ($_GET['eid']) { ?>



				var stateID = '';

				var count = jQuery('#multi_state :selected').length;
				if (count == '1') {
					// alert('if');

					var szid = window.statezone;
					//alert(szid);				;
					//stateID = $('#multi_state :selected').val();				
					stateID = jQuery('select option:selected').val();


					var data = {
						'action': 'my_action',
						'state_id': stateID,
						'szid': szid,
						// We pass php values differently!
					};

					//alert(stateID);
					var ajaxurl = '<?php echo admin_url("admin-ajax.php", null); ?>';
					jQuery.post(ajaxurl, data, function(response) {

						if (response == 1) {
							jQuery(".sz").html('');
						} else {
							//alert(response);

							jQuery(".sz").html(response);
						}
					});
				}


			<?php } ?>


		}); //end doc ready
	</script>
<?php
}
add_action('wp_ajax_my_action', 'my_action');
add_action('wp_ajax_nopriv_my_action', 'my_action');
function my_action()
{

	global $wpdb;
	$table_name = $wpdb->prefix . 'statezone';
	$retrieve_data = $wpdb->get_results("SELECT * FROM $table_name where state_id='" . $_POST['state_id'] . "' and status='1' and is_delete='1'");
	$option = '';
	if (count($retrieve_data) == 0) {

		echo "1";
	} else {

		$option .= '<th scope="row"><label for="state_zone">State Zone</label></th>';
		$option .= '<td>';
		$option .= '<select name="state_zone" class="regular-text" id="state_zone" class="state_zone">';
		foreach ($retrieve_data as $tour_scheduling) {
			$selected = '';
			if ($tour_scheduling->id == $_POST['szid']) {

				$selected = "selected = 'selected'";
			}



			$option .= '<option value="' . $tour_scheduling->id . '" ' . $selected . '>' . $tour_scheduling->state_zone . '</option>';
		}
		$option .= '</select>';
		$option .= '</td>';

		echo $option;
	}

	die;
}
