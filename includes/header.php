<?php

    include("includes/plugins.php");
    authenticate_agent_login();

    $query_agent_info = admin_query_agent($session_logged_in_business_id, $session_logged_in_agent_id, true);

    $fetch_agent_info = mysqli_fetch_assoc($query_agent_info);

    $the_hour = date("H");
    
    $currentTime = ($the_hour > 17) ? "Evening" : (($the_hour > 12) ? "Afternoon" : "Morning");

?>



<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/ec-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:21:36 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: Gbemayo Properties :: Agents Dashboard</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css"/>
<link rel="stylesheet" href="assets/plugins/morrisjs/morris.css" />
<link rel="stylesheet" href="assets/plugins/YoutubePopUp/YouTubePopUp.css"/>

<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/amaze.style.min.css">
<link rel="stylesheet" href="assets/css/ecommerce.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
</head>

<body class="font-ubuntu">

<div id="body" class="theme-cyan">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="mt-3"><img class="zmdi-hc-spin w60" src="assets/images/loader.svg" alt="Gbemayo"></div>
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
                            <a href="javascript:void(0);" class="bars"></a>
                            <a class="navbar-brand" href="dashboard"><img src="assets/images/logo.svg" width="30" alt="Gbemayo"><span class="ml-2">Gbemayo</span></a>
                        </div>
                        <div class="d-flex justify-content-end justify-content-md-between align-items-center flex-grow-1">
                            <div class="d-flex align-items-center currently_maintain hidden-xs">
            
                            </div>
                            <ul class="navbar">
            
                                <li class="dropdown notifications">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i><span class="label-count">0</span></a>
                                    <ul class="dropdown-menu">
                                        <li class="header">New Message</li>
                                        <li class="body">
                                            <ul class="menu list-unstyled">
                                                <!-- <li>
                                                    <a href="javascript:void(0);">
                                                        <div class="media">
                                                            <img class="media-object" src="<?php echo $fetch_agent_info['agent_profile_photo'] ?>" alt="">
                                                            <div class="media-body">
                                                                <span class="name">Alexander <span class="time">13min ago</span></span>
                                                                <span class="message">Meeting with Shawn at Stark Tower by 8 o'clock.</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li> -->

                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <span class="name">No new messages.</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                           
                                       
                                            </ul>
                                        </li>
                                        <li class="footer"> <a href="javascript:void(0);">View All</a> </li>
                                    </ul>
                                </li>                        
                                <li class="dropdown profile">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                        <img class="rounded-circle" style="width:30px; height: 30px;object-fit: cover;" src="<?php echo $fetch_agent_info['agent_profile_photo'] ?>" alt="User">
                                    </a>
                                    <ul class="dropdown-menu py-3">
                                                    
                                        <li><a href="profile"><i class="icon-user mr-2"></i> <span>My Profile</span> <span class="badge badge-success float-right">80%</span></a></li>
                                       
                                        <li><a href="logout"><i class="icon-power mr-2"></i><span>Sign Out</span></a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0);" class="js-right-sidebar"><i class="icon-equalizer"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </nav>

    <aside id="leftsidebar" class="sidebar h_menu">
        <div class="container">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="menu">
                        <ul class="list">
                            <li class="header">MAIN</li>
                            <li class="active">
                                <a href="dashboard" class="menu-toggle"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
                            </li>
                            
                                
                            <li><a href="property-list" class="menu-toggle"><i class="zmdi zmdi-home"></i><span>Property</span></a>

                            <li><a href="client-list" class="menu-toggle"><i class="zmdi zmdi-home"></i><span>Clients</span></a>

                            <li><a href="events" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Events</span></a>

                            <li><a href="sales-list" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Sales List</span></a>

                            <?php
                                if ($session_logged_in_privilege_id == 3) {
                            ?>

                                 <li><a href="agent-list" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>My Agents</span></a>
                                 </li>

                                <?php
                                    if ($fetch_agent_info['agent_subscription_status'] == "active") {
                            
                                ?>
                                 <li><a href="media" class="menu-toggle"><i class="zmdi zmdi-slideshow"></i><span>Media</span></a>

                            <?php
                                }
                                }
                            ?>

                            <!-- <li><a href="" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Investments</span></a> -->

                            <li>
                                <a href="transaction-list" class="menu-toggle"><i class="zmdi zmdi-shopping-basket"></i><span>Transactions</span></a>
                            </li>      
                               <?php
                                if ($session_logged_in_privilege_id == 3) {
                            ?>                 
                            <li><a href="subscription-list" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Subscriptions</span></a></li>
                             <?php
                                }
                            ?>
                        
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Right Sidebar -->