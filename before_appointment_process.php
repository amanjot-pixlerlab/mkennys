<?php
require_once('wp-load.php');
global $wpdb;
$scheduleDate = array();
$stsId = array();
$cityData = array();
$statezone = array();
$id = $_POST['event_id'];
$city = '';
$cmpId = '';
$zone = '';
$today = '';
$multiStateDropdown = '';
$selectedStateId = array();

if (!empty($id)) {


	$schedule_event_state_sql = "select wp_schedule_events.id as schdule_eventId,wp_schedule_events.city_name,wp_schedule_event_state.id as schedule_stateId,wp_schedule_event_state.event_id,wp_schedule_event_state.state_id,
	wp_schedule_event_state.statezone_id,adt.id as schedule_dateTimeId,adt.start_date,
	adt.start_time,adt.end_time
	from wp_schedule_events,wp_schedule_event_state,wp_appointment_date_time adt WHERE adt.start_date = (SELECT max(adt2.start_date) FROM wp_appointment_date_time adt2 WHERE adt2.event_id = adt.event_id)
	and wp_schedule_events.id='" . $id . "' and wp_schedule_events.id=wp_schedule_event_state.event_id and wp_schedule_events.id=adt.event_id and wp_schedule_events.status='1' and
	wp_schedule_events.is_delete='1' and wp_schedule_event_state.status='1' and wp_schedule_event_state.is_delete='1' and adt.status='1' and adt.is_delete='1'group by wp_schedule_events.id";
	$schedules = $wpdb->get_results($schedule_event_state_sql);

	$event_id = array();

	foreach ($schedules as $schedule) {


		$startdate_arr = explode("/", $schedule->start_date);
		$sdate = $startdate_arr[2] . "-" . $startdate_arr[0] . "-" . $startdate_arr[1];

		$today = date("Y-m-d");

		if ($today <= $sdate) {

			$event_id[] = $schedule->schdule_eventId;
			$stsId[] = $schedule->state_id;
			$statezone[] = $schedule->statezone_id;

			//city added
			$selected_city = $schedule->city_name;
		}






		if ($cmpId == $schedule->schdule_eventId) {
		} else {

			if ($schedule->statezone_id) {

				$query = "SELECT wp_schedule_events.id,adt.start_date, wp_schedule_events.city_name FROM wp_schedule_event_state, `wp_schedule_events`,wp_appointment_date_time adt WHERE adt.start_date = (SELECT max(adt2.start_date) FROM wp_appointment_date_time adt2 WHERE adt2.event_id = adt.event_id) and wp_schedule_events.id = wp_schedule_event_state.event_id and adt.event_id=wp_schedule_event_state.event_id AND wp_schedule_event_state.statezone_id = '" . $schedule->statezone_id . "' and wp_schedule_events.is_delete='1' and adt.is_delete='1' and wp_schedule_event_state.is_delete='1' ORDER BY adt.start_date DESC";

				$events = $wpdb->get_results($query);
				foreach ($events as $event) {


					$startdate_arr = explode("/", $event->start_date);
					$sdate = $startdate_arr[2] . "-" . $startdate_arr[0] . "-" . $startdate_arr[1];
					$today = date("Y-m-d");

					if ($today <= $sdate) {

						if ($schedule->schdule_eventId == $event->id) {
							$event_selected = "selected='selected'";
						} else {
							$event_selected = "";
						}
						$city .= '<option ' . $event_selected . '  value="' . $event->id . '">';
						$city .= $event->city_name;
						$city .= '</option>';
					}
				}
			} else {

				/*Here is perform query when record is multiple without zone*/

				$query = "select event_id from wp_schedule_event_state where state_id ='" . $schedule->state_id . "'and is_delete ='1'";
				$records = $wpdb->get_results($query);
				$eventIds = '';
				$single = array();
				$single_another = array();
				$multiple = array();


				foreach ($records as $record) {

					$query = "select event_id,count(event_id) as eventCount from wp_schedule_event_state where event_id ='" . $record->event_id . "' and is_delete ='1'";

					$recordSingleMultiple = $wpdb->get_results($query);


					foreach ($recordSingleMultiple as $rec_sig_mul) {

						if ($rec_sig_mul->eventCount == 1) {
							$single_another[] = $rec_sig_mul->event_id;
							$single[] = "'" . $rec_sig_mul->event_id . "'";
						} else {

							$multiple[] = "'" . $rec_sig_mul->event_id . "'";
						}
					}
				}

				if (in_array($id, $single_another)) {

					$eventIds = implode(",", $single);
				} else {

					$eventIds = implode(",", $multiple);
				}

				/*

				$query = "SELECT wp_schedule_events.id,adt.start_date, wp_schedule_events.city_name FROM wp_schedule_event_state, `wp_schedule_events`,wp_appointment_date_time adt WHERE adt.start_date = (SELECT max(adt2.start_date) FROM wp_appointment_date_time adt2 WHERE adt2.event_id = adt.event_id) and wp_schedule_events.id = wp_schedule_event_state.event_id and adt.event_id=wp_schedule_event_state.event_id AND wp_schedule_event_state.event_id IN(" . $eventIds . ") and wp_schedule_events.is_delete='1' and adt.is_delete='1' and wp_schedule_event_state.is_delete='1'
					group by wp_schedule_events.city_name ORDER BY adt.start_date DESC";				
				*/

				
				$query = "select se.id, se.city_name from wp_appointment_date_time adt inner join wp_schedule_events se on adt.event_id = se.id WHERE adt.event_id IN(".$eventIds.") AND CONCAT(SUBSTRING(adt.start_date, 7, 4),SUBSTRING(adt.start_date, 1, 2),SUBSTRING(adt.start_date, 4, 2)) >= DATE_FORMAT(CURRENT_DATE,'%Y%m%d') ORDER BY CONCAT(SUBSTRING(adt.start_date, 7, 4),SUBSTRING(adt.start_date, 1, 2),SUBSTRING(adt.start_date, 4, 2)) DESC";

				$events_withoutzone = $wpdb->get_results($query);

				foreach ($events_withoutzone as $event) {

					/*
					$startdate_arr = explode("/", $event->start_date);
					$sdate = $startdate_arr[2] . "-" . $startdate_arr[0] . "-" . $startdate_arr[1];
					$today = date("Y-m-d");
					if ($today <= $sdate) {
					*/

					if ($schedule->schdule_eventId == $event->id) {
						$event_selected = "selected='selected'";
					} else {
						$event_selected = "";
					}
					$city .= '<option ' . $event_selected . ' value="' . $event->id . '">';
					$city .= $event->city_name;
					$city .= '</option>';
				}
			}
		}
		$cmpId = $schedule->schdule_eventId;
	}

	$query = "SELECT start_date FROM  wp_appointment_date_time where event_id =" . $id;
	$schedulesDates = $wpdb->get_results($query);
	foreach ($schedulesDates as $schedDate) {

		$startdate_arr = explode("/", $schedDate->start_date);
		$sdate = $startdate_arr[2] . "-" . $startdate_arr[0] . "-" . $startdate_arr[1];

		$today = date("Y-m-d");
		if ($today <= $sdate) {

			$scheduleDate[] = $schedDate->start_date;
		}
	}






	$event_id = array_unique($event_id);
	$stsId = array_unique($stsId);
	$statezone = array_unique($statezone);
	$scheduleDate = array_unique($scheduleDate);

	$selectState = "SELECT state_id FROM `wp_schedule_event_state` WHERE event_id='" . $id . "'";
	$statesData = $wpdb->get_results($selectState);

	if (count($statesData) > 1) {

		foreach ($statesData as $stateId) {

			$selectedStateId[]	= $stateId->state_id;
		}

		$multiStateDropdown .= '<optgroup label="Please Select State Name">';
		$table_name = $wpdb->prefix . "state";
		$sql = "select * from $table_name where is_delete='1'and status='1' ORDER BY `ID` ASC";
		$retrievedata = $wpdb->get_results($sql);
		foreach ($retrievedata as $retrieved_data) {
			$selected = '';
			if (in_array($retrieved_data->id, $selectedStateId)) {
				$selected = "selected = 'selected'";
			}
			$multiStateDropdown .= '<option value="' . $retrieved_data->id . '" ' . $selected . ' >';
			$multiStateDropdown .= $retrieved_data->state_name . ', ' . $retrieved_data->state_short;
			$multiStateDropdown .= '</option>';
		}
		$multiStateDropdown .= '</optgroup>';
		$multi_state[] = $multiStateDropdown;
		$zone .= 'multiStateWithoutZone';
	} else {

		$multiStateDropdown .= '<optgroup label="Please Select State Name">';
		$table_name = $wpdb->prefix . "state";
		$sql = "select * from $table_name where is_delete='1' and status='1' ORDER BY `ID` ASC";
		$retrievedata = $wpdb->get_results($sql);
		foreach ($retrievedata as $retrieved_data) {
			$selected = '';
			if ($retrieved_data->id == $statesData['0']->state_id) {
				$selected = "selected = 'selected'";
			}
			$multiStateDropdown .= '<option value="' . $retrieved_data->id . '" ' . $selected . ' >';
			$multiStateDropdown .= $retrieved_data->state_name . ', ' . $retrieved_data->state_short;
			$multiStateDropdown .= '</option>';
		}
		$multiStateDropdown .= '</optgroup>';
		$multi_state[] = $multiStateDropdown;


		if (count($statezone['0']) == 1) {

			//$zone .= '<option value="">None</option>';
			$table_zone = $wpdb->prefix . "statezone";
			$sql = "select * from $table_zone where is_delete='1' and state_id='" . $stsId['0'] . "'  ORDER BY `ID` ASC";
			$retrievedata = $wpdb->get_results($sql);
			foreach ($retrievedata as $retrieved_data) {
				$selected = '';
				if (in_array($retrieved_data->id, $statezone)) {
					$selected = "selected = 'selected'";
				}
				$zone .= '<option value="' . $retrieved_data->id . '" ' . $selected . ' >';
				$zone .= $retrieved_data->state_zone;
				$zone .= '</option>';
			}
		} else {
			$zone .= '<option value="">Not Available</option>';
		}
	}

	$zones[] = $zone;
	$cityData[] = $city;

	if (isset($_POST['bookedDate']) && $_POST['bookedDate'] != '') {

		//$scheduleDate['0']= $_POST['bookedDate'];


		array_unshift($scheduleDate, $_POST['bookedDate']);
		$scheduleDate = array_unique($scheduleDate);
		$scheduleDate = array_values($scheduleDate);
	}


	echo json_encode(array('status' => true, 'dates' => $scheduleDate, 'stateID' => $stsId, 'event_id' => $event_id, 'city' => $cityData, 'multiStateDropDown' => $multi_state, 'stateZone' => $zones));
}
exit;
