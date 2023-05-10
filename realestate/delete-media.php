<?php

include("../includes/plugins.php");

authenticate_login();

if (isset($_GET['media_id']) && $session_logged_company_privilege_id == 1) {
	$media_id = base64_decode($_GET['media_id']);
	///delete fromDB
	$delete_media = mysqli_query($con,"DELETE FROM media WHERE media_id = '$media_id'");
	if ($delete_media) {
		echo "<script>
		alert('Media Deleted Successfully');
		window.location='media';
		</script>";
		
	}
	else{
		echo "<script>alert('Oops!!, Error occur while trying to delete media, please try again later');
		window.location='media';
		</script>";
	}
	
}else{
	 header("location:../404");
}
?>
