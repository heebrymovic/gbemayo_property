<?php

include("../includes/plugins.php");

authenticate_login();

if (isset($_GET['property_id']) && $session_logged_company_privilege_id == 1) {
	$property_id = base64_decode($_GET['property_id']);

	$query_property_info = query_single_property($property_id, 'property_id', true);

	$fetch_property_info = mysqli_fetch_assoc($query_property_info);

	$property_uniq_id = $fetch_property_info['property_uniq_id'];
	///delete fromDB
	$delete_event = mysqli_query($con,"DELETE FROM property WHERE property_id = '$property_id'");
	if ($delete_event) {

		deleteFiles("properties/$property_uniq_id");

		$delete_installmental = mysqli_query($con,"DELETE FROM installmental_tb WHERE installmental_property_id = '$property_id'");

		$delete_commission = mysqli_query($con,"DELETE FROM commissions WHERE commission_property_id = '$property_id'");

		echo "<script>
		alert('Property Deleted Successfully');
		window.location='property-list';
		</script>";

		header("refresh:3");
		
	}
	else{
		echo "<script>alert('Oops!!, Error occur while trying to delete property, please try again later');
		window.location='property-list';
		</script>";
	}
	
}else{
	 header("location:../404");
}
?>
