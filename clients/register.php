<?php
    include("../includes/plugins.php");


     if (isset($_GET['refid']) && !empty($_GET['refid'])) {
                
        $check_referral = query_agent_referral($_GET['refid']);

        if ($check_referral > 0) {
            $query_referral = query_agent_referral($_GET['refid'], true);
            $fetch_referral = mysqli_fetch_assoc($query_referral);
        }
    }


    if (isset($_POST['register'])) {
        
        $output = "";
        $client_fullname = mysqli_real_escape_string($con, $_POST['client_fullname']);
        $client_email = mysqli_real_escape_string($con, $_POST['client_email']);
        $client_title = mysqli_real_escape_string($con, $_POST['client_title']);
        $client_number = mysqli_real_escape_string($con, $_POST['client_number']);
        $client_address = mysqli_real_escape_string($con, $_POST['client_address']);
        $client_password = mysqli_real_escape_string($con, $_POST['client_password']);
        $client_password = md5($client_password);
        $tmpname = $_FILES['client_photo']['tmp_name'];
        $filename = $_FILES['client_photo']['name'];
        $foldername = 'photos/' ;
        $uploadpath = $foldername .uniqid(). $filename;

         if ( query_clients_email_exist($client_email) > 0) {
            
            $output  =  "<div class='alert alert-danger'>
                <strong>The email has already been taken.</strong>
            </div>";

        } else if( move_uploaded_file($tmpname, $uploadpath) ){

            /*CHECKS IF THE REFERRAL IS MARKETER OR REALTOR*/
            if (@$fetch_referral && in_array( $fetch_referral['priv_id'], array(3, 4)) ) {
                $agent_id = $fetch_referral['agent_id'] ;
                $business_id = $fetch_referral['company_id'];

            }else if( @$fetch_referral && in_array( $fetch_referral['priv_id'], array(1, 2)) ) {
                $agent_id = NULL;
                $business_id = $fetch_referral['company_id'];
            }else{
                $agent_id = NULL;
                $business_id = 1;
            }



            $register_client = client_registration($client_title, $client_fullname, $client_email, $uploadpath, $client_number, $client_address, $agent_id, $business_id, $client_password );

            if ($register_client) {
                $output = "<div class='alert alert-success'>
                      Registration Successful. Login to your dashboard
                    </div>";

                    header("refresh:2; url=login");
            }else{
                 $output = "<div class='alert alert-danger'>
                  Registration Failed. Try again later
                </div>";

                 unlink($uploadpath);
            }

        }


    }


    
?>

<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/hopital/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:17 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Gbemayo :: Clients Sign Up</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">

<!-- Custom Css -->
<link rel="stylesheet" href="../assets/css/amaze.style.min.css">
</head>

<body class="font-ubuntu">

<div id="body" class="theme-purple">

    <div class="authentication" >
        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12">
                    <div class="company_detail">
                         <h4 class="logo"><img class="mr-2" src="../assets/images/logo.svg" alt="Logo"> Gbemayo</h4>
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
                <div class="col-lg-6 col-md-12 mb-5">
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
                       

                        <form class="form mt-3" action="" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-control" name="client_title">
                                        <option>Select Title</option>
                                        <option name="mr">Mr</option>
                                        <option name="mister">Mister</option>
                                        <option name="mrs">Mrs</option>
                                        <option name="miss">Miss</option>
                                        <option name="Dr">Dr</option>
                                        <option name="Chief">Chief</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="client_fullname" placeholder="Enter Full Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="email" class="form-control" name="client_email" placeholder="Enter Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="client_photo">
                                </div>
                                <span class="text-danger">Kindly select a valid photograph</span>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="client_number" placeholder="Enter Phone Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <textarea class="form-control no-resize" name="client_address" placeholder="Enter Address" rows="3"></textarea>
                                </div>
                            </div>
                          
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" placeholder="Password" name="client_password" class="form-control" />
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
                            <button class="btn btn-secondary btn-block" name="register">REGISTER</button>
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
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/hopital/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:17 GMT -->
</html>