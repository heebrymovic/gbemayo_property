<?php
    
    include("includes/plugins.php");

    if( isset($_POST['login'])){

        $output = "";
        $email = mysqli_real_escape_string($con, addslashes($_POST['email']));
        $password = mysqli_real_escape_string($con, addslashes($_POST['password']));
        $password = md5($password);


        if ( agent_login($email, $password) > 0 ) {
            
            $output = "<div class='alert alert-success'>Login Successful</div>";

            $query_agent_info = agent_login($email, $password, true);

            $fetch_agent_info = mysqli_fetch_assoc( $query_agent_info );


            $_SESSION['business_id'] = $fetch_agent_info['agent_business_id'];

            $_SESSION['agent_id'] = $fetch_agent_info['agent_id'];

            $_SESSION['agent_privilege_id'] = $fetch_agent_info['agent_privilege_id'];

            $_SESSION['agent_referral_type'] = $fetch_agent_info['agent_referral_type'];

            header("refresh:3; url=dashboard");
            
        }else{
            $output = "<div class='alert alert-danger'>Invalid Username or Password</div>";
        }


    }



?>  

<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:17:11 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: Gbemayo Properties :: Sign In</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

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
                       <h4 class="logo"><img class="mr-2" src="assets/images/logo.svg" alt="Logo"> Gbemayo</h4>
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
                           <!--  <ul class="list-unstyled d-inline-flex mt-2">
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
                            <h5>Log in</h5>
                        </div>
                        <?php

                             if( isset($_POST['login'])){

                                echo $output;
                            }

                            /*print_r($_SESSION);*/
                        ?>
                        <form class="form mt-2" action="" method="POST">
                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <a href="forgot-password.html" class="link font-13 float-right">Forgot Password?</a>
                            </div>
                            <div class="mt-4">
                                <label class="c_checkbox">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                    <span class="ml-2">Keep me logged in</span>
                                </label>
                            </div>

                            <div class="my-3">
                                <button name="login" class="btn btn-secondary btn-block">Login</button>
                            </div>

                        </form>

                        <!-- <div class="footer mt-3">
                            <a href="index-2.html" class="btn btn-secondary btn-block">SIGN IN</a>
                        </div> -->
                        <span>Don't have an account? <a href="register" class="link">Sign up</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:17:11 GMT -->
</html>