<?php

include("../includes/plugins.php");

authenticate_login();

if (isset($_GET['property_buy_id']) && !empty($_GET['property_buy_id']) && $session_logged_company_privilege_id == 1) {
	$property_buy_id = base64_decode($_GET['property_buy_id']);
	///delete fromDB
	$update_property_buy = mysqli_query($con,"UPDATE property_buy SET property_buy_status='approved' WHERE property_buy_id = '$property_buy_id'");

	if ($update_property_buy) {
		echo "<script>
		alert('Property Purchase Updated Successfully');
		window.location='purchase-list';
		</script>";
		
	}
	else{
		echo "<script>alert('Oops!!, Error occur while trying to update event, please try again later');
		window.location='purchase-list';
		</script>";
	}
	
}else{
	 header("location:../404");
}
?>
