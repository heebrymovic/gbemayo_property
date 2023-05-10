<?php
    
    include("../includes/plugins.php");

    redirect_default_path();

    if (isset($_POST['login'])) {
        
        $output = "";
        $company_username = mysqli_real_escape_string($con, addslashes($_POST['company_username']));
        $password = mysqli_real_escape_string($con, addslashes($_POST['company_password']));
        $company_password = md5($password);


        set_privilege_id();

        if ( query_admin_login($company_username, $company_password, $company_privilege_id) > 0 ) {
            
            $output = "<div class='alert alert-success'>Login Successful</div>";

            $query_login_info = query_admin_login($company_username, $company_password, $company_privilege_id, true);

            $fetch_login_info = mysqli_fetch_assoc($query_login_info);


            $_SESSION['admin_company_id'] = $fetch_login_info['admin_company_id'];

            $_SESSION['company_privilege_id'] = $fetch_login_info['company_privilege_id'];

            $_SESSION['admin_id'] = $fetch_login_info['admin_id'];

            header("refresh:3; url=dashboard");

        }else{
            $output = "<div class='alert alert-danger'>Invalid Username or Password</div>";
        }
    }


?>


<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:58 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Gbemayo Real Estate || Login</title>
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
                            <h5>Log in</h5>
                        </div>

                        <?php
                             if (isset($_POST['login'])) {

                                echo $output;
                            }

                        ?>
                        <form class="form mt-4" action="" method="POST">
                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="company_username" placeholder="User Name">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="company_password" placeholder="Password">
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

                             <div class="footer mt-3">
                                <button name="login" class="btn btn-secondary btn-block">Login</button>
                            </div>
                        </form>

                        <?php

                            if (str_includes($url, "business") !== false){

                        ?>
                                <span>Don't have an account? <a href="register" class="link">Sign up</a></span>

                        <?php

                            }

                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Jquery Core Js -->
<script src="../assets/bundles/libscripts.bundle.js"></script>
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:58 GMT -->
</html>