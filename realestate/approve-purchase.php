<?php

include("../includes/plugins.php");

authenticate_login();

if (isset($_GET['property_id']) && !empty($_GET['property_id']) && isset($_GET['property_payment_id']) && !empty($_GET['property_payment_id']) && isset($_GET['client_id']) && !empty($_GET['client_id']) && $session_logged_company_privilege_id == 1) {
	
	$property_id = base64_decode($_GET['property_id']);
	$property_payment_id = base64_decode($_GET['property_payment_id']);
	$client_id = base64_decode($_GET['client_id']);
	$update_property_buy = update_property($property_id, $property_payment_id, $client_id, 'approved');
	

	if ($update_property_buy) {
		
		echo "<script>
		alert('Property Purchase Approved Successfully');
		window.location=history.back();
		</script>";
		
	}
	else{
		echo "<script>alert('Oops!!, Error occur while trying to approve property purchase payment, please try again later');
		window.location=history.back();
		</script>";
	}
	
}else{
	 header("location:../404");
}
?>
