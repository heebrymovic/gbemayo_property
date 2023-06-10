<?php
include("includes/plugins.php");
authenticate_agent_login();

	if ( isset($_GET['upgrade_type']) && !empty($_GET['upgrade_type'])  ) {

			$_SESSION['store']['payment_type'] = 'upgrade';
			$_SESSION['store']['upgrade_type'] = base64_decode($_GET['upgrade_type']);
			header("location:confirm-pay");
	}else{

			header("location:404");

	}

?>