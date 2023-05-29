<?php
    
    include("../includes/plugins.php");

    if( isset($_POST['login'])){

        $output = "";
        $email = mysqli_real_escape_string($con, addslashes($_POST['email']));
        $password = mysqli_real_escape_string($con, addslashes($_POST['password']));
        $password = md5($password);


        if ( client_login($email, $password) > 0 ) {
            
            $output = "<div class='alert alert-success'>Login Successful</div>";

            $query_client_info = client_login($email, $password, true);

            $fetch_client_info = mysqli_fetch_assoc( $query_client_info );

            $_SESSION['client_id'] = $fetch_client_info['clients_id'];

            $_SESSION['client_business_id'] = $fetch_client_info['clients_business_id'];

            $_SESSION['client_agent_id'] = $fetch_client_info['clients_agent_id'];

            $_SESSION['client_privilege_id'] = get_privileges_id('client');

            header("refresh:3; url=dashboard");
            
        }else{
            $output = "<div class='alert alert-danger'>Invalid Username or Password</div>";
        }


    }



?>  

<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/hopital/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:05 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Gbemayo :: Clients Sign In</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">

<!-- Custom Css -->
<link rel="stylesheet" href="../assets/css/amaze.style.min.css">
</head>

<body class="font-ubuntu">

<div id="body" class="theme-purple">

    <div class="authentication">
        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12">
                    <div class="company_detail">
                        <h4 class="logo"><img class="mr-2" src="../assets/images/logo.svg" alt="Logo"> Gbemayo</h4>
                        <h3>The ultimate <strong>Gbemayo</strong> Properties and Investments</h3>
                        <p>Amaze is fully based on HTML5 + CSS3 Standards. Is fully responsive and clean on every device and every browser</p>
                        <div class="footer">
                            
                            <p class="copyright font-12">Copyright 2020 © All Rights Reserved. Amaze Dashboard Template</p>
                            
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

                        ?>



                        <form class="form mt-4" action="" method="POST">
                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control mt-3" placeholder="Password">
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
                                <button name="login" class="btn btn-secondary btn-block">LOG IN</button>
                            </div>
                        </form>

                        
                        <span>Don't have an account? <a href="register" class="link">Sign up</a></span>
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

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/hopital/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:05 GMT -->
</html>