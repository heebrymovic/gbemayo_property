<?php
    
    include("includes/plugins.php");

    if (isset($_SESSION['store']) && !empty($_SESSION['store']) && !isset($_SESSION['store']['status']) ) {

        echo "<script>
            alert('You still have a pending payment');
            window.location='confirm-pay'
        </script>";

    
    }else if(isset($_SESSION['store']['status']) && $_SESSION['store']['status'] == 'pending') {
        echo "<script>
            alert('You still have a pending transaction. Kindly wait while we verify.');
            window.location='verify'
        </script>";
    }


    if (isset($_GET['refid'])) {
                
        $check_referral = query_agent_referral($_GET['refid']);

        if ($check_referral > 0) {
            $query_referral = query_agent_referral($_GET['refid'], true);
            $fetch_referral = mysqli_fetch_assoc($query_referral);
        }
    }
    
    if (isset($_POST['register'])) {
        
        $output = "";
        $fullname = mysqli_real_escape_string($con, addslashes($_POST['fullname']));
        $email = mysqli_real_escape_string($con, addslashes($_POST['email']));
        $agent_privilege_id = mysqli_real_escape_string($con, addslashes($_POST['agent_type']));
        $phone_no = mysqli_real_escape_string($con, addslashes($_POST['phone_no']));
        $address = mysqli_real_escape_string($con, addslashes($_POST['address']));
        $password = mysqli_real_escape_string($con, addslashes($_POST['password']));
        $password = md5($password);

        $tmpname = $_FILES['file']['tmp_name'];
        $filename = $_FILES['file']['name'];
        $foldername = 'photos/' ;
        $uploadpath = $foldername .uniqid(). $filename;

        $referral_id = random_strings(11);
        
        $event_id = random_strings(7);

        if ( query_agent_email_exists($email) > 0) {
            
            $output  =  "<div class='alert alert-danger'>
                <strong>The email has already been taken.</strong>
            </div>";

        }else if (move_uploaded_file($tmpname, $uploadpath)) {
                
                /*CHECKS IF IT REALTOR REFERRAL*/
                if(@$fetch_referral  && $fetch_referral['priv_id'] == 3) {

                    $business_id = $fetch_referral['company_id'];

                    $agent_referred_by_id = $fetch_referral['agent_id'];

                    $referral_type = "realtor";

                    /*CHECKS IF IT BUSINESS REFERRAL*/
                }else if (@$fetch_referral  && $fetch_referral['priv_id'] == 2) {
                    
                     $business_id = $fetch_referral['company_id'];

                     $agent_referred_by_id = NULL;

                     $referral_type = "business";
                }else{
                        $business_id = 1;
                        $agent_referred_by_id = NULL;
                        $referral_type = "business";
                }


                if ( ($agent_privilege_id == 3 && !@$fetch_referral) ||  ($agent_privilege_id == 3 && @$fetch_referral && $fetch_referral['subcription'] == 'active') ) {
                    
                    $_SESSION['store']['agent_privilege_id'] = $agent_privilege_id;
                    $_SESSION['store']['fullname'] = $fullname;
                    $_SESSION['store']['email'] = $email;
                    $_SESSION['store']['password'] = $password;
                    $_SESSION['store']['phone_no'] = $phone_no;
                    $_SESSION['store']['address'] = $address;
                    $_SESSION['store']['uploadpath'] = $uploadpath;
                    $_SESSION['store']['business_id'] = $business_id;
                    $_SESSION['store']['referral_id'] = $referral_id;
                    $_SESSION['store']['agent_referred_by_id'] = $agent_referred_by_id;
                    $_SESSION['store']['referral_type'] = $referral_type;
                    $_SESSION['store']['event_id'] = $event_id;
                    $_SESSION['store']['payment_type'] = "register";

                    echo "<script>
                    alert('Proceed to payment page');
                    window.location.href='confirm-pay'
                    </script>";
                    exit();
                } else if (@$fetch_referral && $fetch_referral['subcription'] == 'inactive' ) {
                    
                    $output = "<div class='alert alert-danger'>
                                  This account can't recruit at the moment. Try again later
                            </div>";

                        unlink($uploadpath);

                }else{

                         $register_agent = agent_registration($agent_privilege_id, $fullname, $email, $password, $phone_no, $address,$uploadpath ,$business_id,  $referral_id, $agent_referred_by_id, $referral_type,$event_id);    
                        
                

                            if ($register_agent) {
                                $output = "<div class='alert alert-success'>
                                          Registration Successful. Login to your dashboard
                                        </div>";
                            }else{
                                 $output = "<div class='alert alert-danger'>
                                          Registration Failed. Try again later
                                        </div>";
                                         unlink($uploadpath);
                            }

                }
        }

    }


?>

<!--  -->


<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:23:13 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: Gbemayo :: Sign Up</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/sweetalert/sweetalert.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/amaze.style.min.css">

</head>

<body class="font-ubuntu">

<div id="body" class="theme-cyan">

    <div class="authentication">
        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12">
                    <div class="company_detail">
                        <h4 class="logo"><img class="mr-2" src="assets/images/logo.svg" alt="Logo">Gbemayo</h4>
                        <h3>The ultimate <strong>Gbemayo</strong> Properties and Investments</h3>
                        <p>Amaze is fully based on HTML5 + CSS3 Standards. Is fully responsive and clean on every device and every browser</p>
                        <div class="footer">
                            <ul  class="social_link list-unstyled">
                                <li><a href="https://thememakker.com/" title="ThemeMakker"><i class="zmdi zmdi-globe"></i></a></li>
                                <li><a href="https://themeforest.net/user/thememakker" title="Themeforest"><i class="zmdi zmdi-shield-check"></i></a></li>
                                <li><a href="https://www.linkedin.com/company/thememakker/" title="LinkedIn"><i class="zmdi zmdi-linkedin"></i></a></li>
                                <li><a href="https://www.facebook.com/thememakkerteam" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="http://twitter.com/thememakker" title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="https://www.behance.net/thememakker" title="Behance"><i class="zmdi zmdi-behance"></i></a></li>
                                <li><a href="https://dribbble.com/thememakker" title="dribbble"><i class="zmdi zmdi-dribbble"></i></a></li>
                            </ul>
                            <hr>
                            <p class="copyright font-12">Copyright <?php echo date("Y") ?> © All Rights Reserved. Gbemayo Dashboard Template</p>
                            <!-- <ul class="list-unstyled d-inline-flex mt-2">
                                <li class="mr-3"><a href="http://thememakker.com/contact/" target="_blank">Contact Us</a></li>
                                <li class="mr-3"><a href="http://thememakker.com/about/" target="_blank">About Us</a></li>
                                <li class="mr-3"><a href="http://thememakker.com/services/" target="_blank">Services</a></li>
                                <li class="mr-3"><a href="https://themeforest.net/licenses/standard">Licenses</a></li>
                            </ul> -->
                        </div>
                    </div>
                </div>                        
                <div class="col-lg-6 col-md-12">
                    <div class="card-plain ml-auto">
                        <div class="header">
                            <h5>Sign Up</h5>
                            <span>Register a new membership</span>
                        </div>
                        
                            <?php 
                                if (isset($_POST['register'])) {
                                        
                                  echo $output;
                                }       
                            ?>

                        <form class="form mt-4" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" required name="fullname" value="<?php echo @$fullname ?>" placeholder="Enter Full Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="email" class="form-control" required name="email" value="<?php echo @$email ?>" placeholder="Enter Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number" class="form-control" required name="phone_no" value="<?php echo @$phone_no ?>" placeholder="Enter Phone Number">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-control" name="agent_type" required>
                                        <option value="">Select Agent Type</option>
                                        <?php

                                             if(@$fetch_referral  && $fetch_referral['priv_id'] == 3 ){
                                        ?>
                                            <option value="4">Marketer</option>
                                        <?php
                                             }else{

                                        ?>
                                            <option value="4">Marketer</option>
                                            <option value="3">Realtor</option>
                                        <?php
                                             }

                                        ?>
                                        
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <textarea class="form-control no-resize" required name="address" placeholder="Enter Address"><?php echo @$address ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="file" class="form-control" required name="file">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" placeholder="Password" required name="password" class="form-control" />
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="c_checkbox">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                    <span class="ml-2 font-13">I read and Agree to the <a href="javascript:void(0);">Terms of Usage</a></span>
                                </label>
                            </div>
                            <div class="mt-4 mb-2">
                                <button name="register" class="btn btn-secondary btn-block">Register</button>
                            </div>
                        </form>

                        <!-- <div class="footer mt-3">
                            <a href="index-2.html" class="btn btn-secondary btn-block">SIGN UP</a>
                        </div> -->
                        <span>You already have a <a class="link" href="login">membership?</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<script src="assets/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:23:13 GMT -->
</html>