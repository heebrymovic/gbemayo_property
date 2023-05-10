<?php

include("../includes/plugins.php");

authenticate_login();

if (isset($_GET['event_id']) && $session_logged_company_privilege_id == 1) {
	$event_id = base64_decode($_GET['event_id']);
	///delete fromDB
	$delete_event = mysqli_query($con,"DELETE FROM events WHERE events_id = '$event_id'");
	if ($delete_event) {
		echo "<script>
		alert('Event Deleted Successfully');
		window.location='events';
		</script>";
		
	}
	else{
		echo "<script>alert('Oops!!, Error occur while trying to delete event, please try again later');
		window.location='events';
		</script>";
	}
	
}else{
	 header("location:../404");
}
?>
