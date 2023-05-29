<?php
	include("../includes/plugins.php");
    authenticate_client_login();


    if (isset($_GET['event_id'])  && isset($_GET['status'])) {
    	
    	$event_id = base64_decode($_GET['event_id']);

    	$status = base64_decode($_GET['status']);

            $event_reg =  event_reg($event_id, $session_logged_in_client_id, $session_logged_in_agent_id, $session_logged_in_business_id, $status);

            if ($event_reg) {
                echo "<script>
                    alert('Event Successfully Set');
                    window.loction = history.back()
                </script>";
            }
    }

?>