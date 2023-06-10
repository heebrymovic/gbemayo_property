<?php
 include("includes/plugins.php");


if ( isset($_GET['ref']) && !empty($_GET['ref']) && isset($_GET['status']) && ( ($_GET['status'] == "success") || ($_GET['status'] == "pending")  ) ) {
    
      $refid = $_GET['ref'];

      $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/transaction/verify/$refid",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer sk_test_89e3ef4db9482db9193d5469010a8f5071af232b",
        "Cache-Control: no-cache",
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {

      
      $res  =json_decode($response);
      $status = $res -> data -> status;

      /*print_r($res);*/

      if ($status == 'pending') {
        
        $_SESSION['store']['status'] == "pending";

        echo "<script>
                  alert('Transaction is Pending. Try again later');
                </script>";


      }else  if ($status == "success") {
            
              $txn_payment_id = $res -> data -> id;
              $txn_ref_id = $res -> data -> reference;
              $txn_amount = (int)($res -> data -> amount) / 100;

            if ( ($_SESSION['store']['payment_type'] == "register") ) {

             $agent_privilege_id =  $_SESSION['store']['agent_privilege_id'];
              $fullname = $_SESSION['store']['fullname'];
              $email = $_SESSION['store']['email'];
              $password = $_SESSION['store']['password'];
              $phone_no = $_SESSION['store']['phone_no'];
              $address = $_SESSION['store']['address'];
              $uploadpath = $_SESSION['store']['uploadpath'];
              $business_id = $_SESSION['store']['business_id'];
              $referral_id = $_SESSION['store']['referral_id'];
              $agent_referred_by_id = $_SESSION['store']['agent_referred_by_id'];
              $referral_type = $_SESSION['store']['referral_type'];
              $event_id = $_SESSION['store']['event_id'];
            

              $register_agent = agent_registration($agent_privilege_id, $fullname, $email, $password, $phone_no, $address,$uploadpath ,$business_id,  $referral_id, $agent_referred_by_id, $referral_type,$event_id, 'active');  

              }elseif ( ($_SESSION['store']['payment_type'] == "upgrade")) {
                  authenticate_agent_login();

                  echo $session_logged_in_agent_id;
               
                  $register_agent = update_agent_subscription($session_logged_in_agent_id, $_SESSION['store']['upgrade_type']);
                  $business_id = $session_logged_in_business_id;
              }


              if ($register_agent) {
                
                $txn_agent_id  =  $_SESSION['store']['payment_type'] == "upgrade" ? $session_logged_in_agent_id : mysqli_insert_id($con);

                $txn_reg = txn_reg($txn_agent_id, $business_id, $txn_ref_id, $txn_payment_id, $txn_amount, $status);

                 $query_fee = query_single_reg_fee(NULL, 3);
                  
                  $fetch_fee = mysqli_fetch_assoc($query_fee);

                  $fee_duration = $fetch_fee['reg_fee_duration'];

                $start = date("Y-m-d", strtotime("today"));
                
                $end = date("Y-m-d", strtotime("+$fee_duration months"));

                if ($txn_reg) {
                  subscriptions_reg($txn_agent_id, $business_id, $start, $end);
                }

                unset($_SESSION['store']);

                if ( (@$_SESSION['store']['payment_type'] == "register")) {
                    echo "<script>
                    alert('Verification Successful. You can proceed to login');
                    window.location.href='login'
                  </script>";  
                }else{
                    echo "<script>
                    alert('Verification Successful');
                    window.location.href='transaction-list'
                  </script>";
                }
                
                
              }else{

                echo "<script>
                  alert('Verification Failed.');
                </script>";

              }

      }
      
    }
}
  

?>



<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/form-advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:22:31 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no ,shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>::Gbemayo Properties</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link  rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Morris Chart Css-->
<link rel="stylesheet" href="assets/plugins/morrisjs/morris.css" />
<!-- Colorpicker Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
<!-- Multi Select Css -->
<link rel="stylesheet" href="assets/plugins/multi-select/css/multi-select.css">
<!-- Bootstrap Spinner Css -->
<link rel="stylesheet" href="assets/plugins/jquery-spinner/css/bootstrap-spinner.css">
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<!-- Bootstrap Select Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<!-- noUISlider Css -->
<link rel="stylesheet" href="assets/plugins/nouislider/nouislider.min.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/amaze.style.min.css">
<style>
    .body_area { margin-top:70px!important; }
    .block-header{ overflow:hidden; position: relative; z-index: 1;}
    .block-header::after{ content:""; position:absolute; left:0; top:0; width:100%; height:100%; background:rgba(0, 0, 0, 0.4); z-index: -1;}
    @media only screen and (max-width: 1280px){
        .body_area { margin-top:58px!important; }        
    }
</style>
</head>

<body class="font-ubuntu">

<div id="body" class="theme-cyan">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="mt-3"><img class="zmdi-hc-spin w60" src="assets/images/loader.svg" alt="Amaze"></div>
            <p>Verification in progress... </p>        
        </div>
    </div>