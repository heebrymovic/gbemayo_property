<?php
    include("../includes/plugins.php");

    redirect_default_path();
    
    stop_superadmin_registration();
    
    if (isset($_POST['register'])) {
        
        $output = "";
        $company_name = mysqli_real_escape_string($con, addslashes($_POST['company_name']));
        $company_address = mysqli_real_escape_string($con, addslashes($_POST['company_address']));
        $company_email = mysqli_real_escape_string($con, addslashes($_POST['company_email']));
        $company_username = mysqli_real_escape_string($con, addslashes($_POST['company_username']));
        $password = mysqli_real_escape_string($con, addslashes($_POST['company_password']));
        $password = md5($password);
        
        $email_error = "";
        
        $username_error = "";
    
        $check_input_error = true;

        require("register-error.php");

        if ($check_input_error) {

             set_privilege_id();

             $referral_id = random_strings(11);
             $event_id = random_strings(7);


             /*if ($company_privilege_id == 1) {
                    $referral_id = NULL;
             }*/

            $registration = company_registration($company_name, $company_email, $company_address, $company_privilege_id, $referral_id, $event_id );

        
            if ( $registration ) {

                $last_insert_id = mysqli_insert_id($con);

                admin_registration($company_username, $password, $last_insert_id);
                
                $password = "";

                 $output = "<div class='alert alert-success'>
                  Registration Successful. Login to your dashboard
                </div>";

            }else{
                $output = "<div class='alert alert-danger'>
                  An Error Occurred During Registration. Try again later
                </div>";
            }


        }



    }

?>

<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:26:19 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Gbemayo Real Estate || Register</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">

<!-- Custom Css -->
<link rel="stylesheet" href="../assets/css/amaze.style.min.css">
</head>

<body class="font-raleway">

<div id="body" class="theme-green">

    <div class="authentication">
        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12">
                    <div class="company_detail">
                        <h4 class="logo"><img class="mr-2" src="../assets/images/logo.svg" alt="Logo"> Amaze</h4>
                        <h3>Gbemayo Admin Dashboard</h3>
                        <p>Amaze is fully based on HTML5 + CSS3 Standards. Is fully responsive and clean on every device and every browser</p>
                        <div class="footer">
                            <hr>
                            <p class="copyright font-12">Copyright 2020 © All Rights Reserved. Amaze Dashboard Template</p>
                            <ul class="list-unstyled d-inline-flex mt-2">
                                <li class="mr-3"><a href="http://thememakker.com/contact/" target="_blank">Contact Us</a></li>
                                <li class="mr-3"><a href="http://thememakker.com/about/" target="_blank">About Us</a></li>
                                <li class="mr-3"><a href="http://thememakker.com/services/" target="_blank">Services</a></li>
                                <li class="mr-3"><a href="https://themeforest.net/licenses/standard">Licenses</a></li>
                            </ul>
                        </div>
                    </div>
                </div>                        
                <div class="col-lg-6 col-md-12">
                    <div class="card-plain ml-auto">
                        <div class="header">
                            <h5>Sign Up</h5>
                            <span>Register as a new membership</span>
                        </div>
                        <?php

                             if (isset($_POST['register'])) {

                                echo  $email_error;
                                
                                echo $username_error;

                                echo $output;
                            }

                        ?>
                        <form class="form mt-4" action="" method="POST">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="company_name" value="<?php echo @$company_name ?>" required placeholder="Enter Company name">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="company_address" required value="<?php echo @$company_address ?>" placeholder="Enter Company Address">
                                </div>
                            </div>

                             <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="company_email" required value="<?php echo @$company_email ?>" placeholder="Enter Company Email">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="company_username" required value="<?php echo @$company_username ?>" placeholder="Enter Company Admin Username">
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" placeholder="Enter Company Admin Password" required value="<?php echo @$company_password ?>" name="company_password" class="form-control" />
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="c_checkbox">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                    <span class="ml-2 font-13">I read and Agree to the <a href="javascript:void(0);">Terms of Usage</a></span>
                                </label>
                            </div>

                              <div class="footer mt-3">
                                <button name="register" class="btn btn-secondary btn-block">Register</button>
                            </div>
                        </form>

                      
                        <span>You already have a <a class="link" href="login">membership?</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="../assets/bundles/libscripts.bundle.js"></script>
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script>
    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:26:19 GMT -->
</html>