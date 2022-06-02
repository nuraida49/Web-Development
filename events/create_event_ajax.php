<?php

	//For Database
	include("classes/Database.class.php");
	include("classes/DB.class.php");
	
	$DB = new DB();
	
	if(isset($_GET['calculate_offset']) && $_GET['calculate_offset'] == "yes"){
		$entered_event_datetime_start	= $_GET['e_eventDate'] . ' ' . $_GET['e_startTime'];
		$entered_event_datetime_end		= $_GET['e_eventDate'] . ' ' . $_GET['e_endTime'];
		
		$datetime_start = new DateTime($entered_event_datetime_start);
		$datetime_end	= new DateTime($entered_event_datetime_end);
		$interval = $datetime_start->diff($datetime_end);
		
		if($interval){
			echo $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";exit;
		}else{
			echo '0';exit;	
		}
	}
	
	$eventsExplode = explode("_", $_GET['e_eventName']);
	$startTime = $_GET['e_startTime'] . ":00";
	$endTime = $_GET['e_endTime'] . ":00";
		
	$query = "INSERT INTO front_events (event_name, cluster_name, date, start_time, end_time, class_name, time_offset, event_id) VALUES ('".$eventsExplode[1]."', '".$_GET['e_clusterName']."', '".$_GET['e_eventDate']."', '".$startTime."', '".$endTime."', '".$_GET['e_room']."', '".$_GET['e_offset']."', '".$eventsExplode[0]."')";
	
	$result = $DB->Insert($query);
	if($result){
		echo "SUCCESS";exit;
	}else{
		echo "FAILURE";exit;
	}
?>