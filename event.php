<?php
    include("includes/plugins.php");

    if (isset($_GET['refid']) && !empty($_GET['refid']) && isset($_GET['event_id']) && !empty($_GET['event_id'])  ) {
        
        $event_id = base64_decode($_GET['event_id']);

        $refid = $_GET['refid'];

        if (query_single_event($event_id) > 0 && query_event_referral($refid) > 0)  {
           
           $query_event = query_single_event($event_id, true);

           $fetch_event_info = mysqli_fetch_assoc($query_event);

           $query_referral_info = query_event_referral($refid, true);

           $fetch_referral_info = mysqli_fetch_assoc($query_referral_info);

            /*IF TOTAL DATA IS TWO THAT IS AN ADMIN*/
        
            $event_invite_agent_id = count($fetch_referral_info)  == 2 ? NULL: $fetch_referral_info['agent_id'] ;

            $event_invite_business_id = $fetch_referral_info['company_id'];

        }else{
            header("location:404");
        }
    }else{
         header("location:404");
    }


    if (isset($_POST['register'])) {
        
         $output = "";
        $fullname = mysqli_real_escape_string($con, addslashes($_POST['fullname']));
        $email = mysqli_real_escape_string($con, addslashes($_POST['email']));
        $phone_no = mysqli_real_escape_string($con, addslashes($_POST['phone_no']));
        $gender = mysqli_real_escape_string($con, addslashes($_POST['gender']));
        $address = mysqli_real_escape_string($con, addslashes($_POST['address']));   


        if( query_event_invitee_exists($email, $event_id) > 0 ){

            $output = '<div class="alert alert-danger mt-3">
                  Email has already been registered for this event.
                </div>';
        }else{
            $event_reg = normal_event_reg($event_id, $event_invite_agent_id, $event_invite_business_id, $fullname, $email, $phone_no, $gender, $address );

            if ($event_reg) {
                $output = '<div class="alert alert-success mt-3">
                    Registration Successful.
                </div>';
            }else{
                $output = '<div class="alert alert-danger mt-3">
                  Something went wrong. Registration Failed Try Again Later.
                </div>';
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
            <p>Please wait...</p>        
        </div>
    </div>

    <div class="overlay"></div>

    <!-- Top Bar -->
    <nav class="top_navbar">
        <div class="container">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="navbar-logo">
                            <!-- <a href="javascript:void(0);" class="bars"></a> -->
                            <a class="navbar-brand" href=""><img src="assets/images/logo.svg" width="30" alt="Amaze"><span class="ml-2">Gbemayo Properties</span></a>
                        </div>
                        <div class="d-flex justify-content-end justify-content-md-between align-items-center flex-grow-1"></div>
                    </div>
                </div>
            </div>        
        </div>
    </nav>

    <!-- Main Content -->
    <div class="body_area" >

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <h1 class="mb-3 mt-1"><?php echo ucwords($fetch_event_info['events_title']) ?> Event Registration</h1>
                    </div>
                    <div class="col-lg-6 col-md-12">
                    
                        <div>
                            <h5>Description:</h5>
                             <p><?php echo $fetch_event_info['events_desc'] ?></p>
                        </div>
                    </div>    

                    <div class="col-lg-6 col-md-12">
                             <h5>Venue:</h5>
                             <p><?php echo $fetch_event_info['events_venue'] ?></p>

                             <h5>Date:</h5>
                            <p><?php echo date("D, d M Y", strtotime($fetch_event_info['events_date'])) ?></p>
                    </div>  

                     <div class="col-lg-6 col-md-12">
                         <img style="max-height: 220px; max-width: 100%;" src="realestate/<?php echo $fetch_event_info['events_banner'] ?>">
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="container mb-5">

            <?php
                if ($fetch_event_info['events_status'] == "inactive") {
            ?>

                <h1 class="text text-danger">Event Not Active Anymore.</h1>

            <?php
                }else{

            ?>
                 <!-- Masked Input -->
            <div class="row clearfix">
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header pb-3">
                            <h2><strong>Registration</strong> Info</h2>

                            <?php
                                if (isset($_POST['register'])) {
                                    echo $output;
                                }
                            ?>
                        </div>
                        
                        <form action="" method="POST">
                            <div class="body">

                                <h5 class="text text-success">You Are Being Referred by <?php echo ucwords($fetch_referral_info['fullname']) ?></h5>
                                <div class="demo-masked-input">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12">
                                            <b>FullName</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                                </div>
                                                <input type="text" class="form-control date" name="fullname" required value="<?php echo @$fullname ?>" placeholder="Enter your fullname">
                                            </div>
                                        </div>


                                         <div class="col-lg-12 col-md-12 mb-3">
                                            <p> <b>Gender</b> </p>
                                            <select class="form-control show-tick" name="gender" required value="<?php echo @$gender ?>">
                                                <option>Choose gender</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <b>Email Address</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                                </div>
                                                <input type="email" class="form-control email" name="email" required value="<?php echo @$email ?>" placeholder="Enter your valid email">
                                            </div>
                                        </div>

                                         <div class="col-lg-12 col-md-12">
                                            <b>Phone Number</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="zmdi zmdi-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control phone-number" name="phone_no" required value="<?php echo @$phone_no ?>"  placeholder="Enter your Phone Number">
                                            </div>
                                        </div>

    
                                        
                                        <div class="col-lg-12 col-md-12">
                                            <b>Address</b>
                                            <div class="input-group mb-3">

                                               <textarea class="form-control no-resize" name="address" required rows="6"><?php echo @$address ?></textarea>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-12 col-md-12">
                                            <button name="register" class="btn btn-primary">Register</button>
                                        </div>                               
                                
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Masked Input -->     

            <?php
                }
            ?>
              
             
        </div>

    </div>

</div>

<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
<script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
<script src="assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js --> 
<script src="assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js --> 
<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js --> 
<script src="assets/plugins/nouislider/nouislider.js"></script> <!-- noUISlider Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/forms/advanced-form-elements.js"></script> 
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/form-advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:22:43 GMT -->
</html>