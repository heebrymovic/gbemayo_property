<?php

    include("../includes/plugins.php");

    redirect_default_path();

    authenticate_login(); 

    $query_company_info = query_company_acc_info($session_logged_admin_company_id, $session_logged_in_admin_id, true);

    $fetch_company_info = mysqli_fetch_assoc($query_company_info);

    $admin_username = $fetch_company_info['admin_username'];

    $company_event_id = $fetch_company_info['company_event_id'];

    $the_hour = date("H");
    
    $currentTime = ($the_hour > 17) ? "Evening" : (($the_hour > 12) ? "Afternoon" : "Morning");



?>



<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:19:56 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
<title>Gbemayo :: Admin Dashboard</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/plugins/bootstrap-select/css/bootstrap-select.css"/>
<link rel="stylesheet" href="../assets/plugins/c3/plugin.css"/>
<link rel="stylesheet" href="../assets/plugins/YoutubePopUp/YouTubePopUp.css"/>

<!-- Custom Css -->
<link rel="stylesheet" href="../assets/css/amaze.style.min.css">
</head>

<body class="font-raleway h_menu">

<div id="body" class="theme-green">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="mt-3"><img class="zmdi-hc-spin w60" src="../assets/images/loader.svg" alt="Amaze"></div>
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
                            <a class="navbar-brand" href="dashboard"><img src="../assets/images/logo.svg" width="30" alt="Amaze"><span class="ml-2">Amaze</span></a>
                        </div>
                        <div class="d-flex justify-content-end justify-content-md-between align-items-center flex-grow-1">
                            <div class="d-flex align-items-center currently_maintain hidden-xs">
                                
                            </div>
                            <ul class="navbar">
                               <!--  <li class="search_bar hidden-sm">
                                    <div class="input-group">
                                        <i class="icon-magnifier"></i>
                                        <input type="text" class="form-control" placeholder="Find your stuff...">
                                    </div>
                                </li> -->
                                <li class="dropdown notifications">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="icon-bell"></i><span class="label-count">5</span></a>
                                    <ul class="dropdown-menu">
                                        <li class="header">New Message</li>
                                        <li class="body">
                                            <ul class="menu list-unstyled">
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <div class="media">
                                                            <img class="media-object" src="../assets/images/xs/avatar5.jpg" alt="">
                                                            <div class="media-body">
                                                                <span class="name">Alexander <span class="time">13min ago</span></span>
                                                                <span class="message">Meeting with Shawn at Stark Tower by 8 o'clock.</span>
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
                                        <img class="rounded-circle"  src="<?php echo $fetch_company_info['company_photo'] != "" ? $fetch_company_info['company_photo'] : '../assets/images/profile_av.png'  ?>" style="width:30px; height: 30px;object-fit: cover;" alt="User">
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="user-info">
                                                <h5 class="user-name mb-0"><?php echo  $fetch_company_info['company_name']  ?></h5>
                                                <p class="user-position font-13">Available</p>
                                                <a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a>
                                                <a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a>
                                                <a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a>
                                                <a title="linkedin" href="javascript:void(0);"><i class="zmdi zmdi-linkedin-box"></i></a>
                                                <a title="dribbble" href="javascript:void(0);"><i class="zmdi zmdi-dribbble"></i></a>
                                                <hr>
                                            </div>
                                        </li>                            
                                        <li><a href="profile"><i class="icon-user mr-2"></i> <span>My Profile</span> <span class="badge badge-success float-right">80%</span></a></li>
                                       <!--  <li><a href="taskboard.html"><i class="icon-notebook mr-2"></i><span>Taskboard</span> <span class="badge badge-info float-right">New</span></a></li>
                                        <li><a href="locked.html"><i class="icon-lock mr-2"></i><span>Locked</span></a></li> -->
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

    <aside id="leftsidebar" class="sidebar">
        <div class="container">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="menu">
                        <ul class="list">
                            <li class="header">MAIN</li>
                            <li class="active open">
                                <a href="dashboard" class="menu-toggle"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>    
                            </li>
                            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Users</span></a>
                                <ul class="ml-menu">
                                    <li><a href="admin-add">New Admin</a></li>
                                    <li><a href="admin-list">Admin List</a></li>
                                    <?php
                                        if ($session_logged_company_privilege_id == 1) {
                                        ?>

                                            <li><a href="business-list">Business List</a></li>
                                        <?php
                                            }

                                        ?>
                                    
                                    <li><a href="agent-list">Agents List</a></li>
                                </ul>
                            </li>
                           
                            <!--  <li>
                                <a href="agent-category" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>Agent Category</span></a>
                            </li>
                            -->

                            <?php

                              if ($session_logged_company_privilege_id == 1) {
                            ?>
                                <li>
                                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>Property</span></a>
                                    <ul class="ml-menu">
                                        <li><a href="property-add">Add Property</a></li>
                                        <li><a href="property-list">Property List</a></li>
                                    </ul>
                                </li>
                            <?php
                                }else{
                            ?>

                                <li>
                                    <a href="property-list" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>Property</span></a>
                                </li>
                            <?php
                                }
                            ?>

                             <li>
                                <a href="purchase-list" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>Purchases</span></a>
                            </li>

                             <li>
                                <a href="events" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>Investments</span></a>
                            </li>

                            <li>
                                <a href="events" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>Events</span></a>
                            </li>

                             <li>
                                <a href="media" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>Media</span></a>
                            </li>

                            <li>
                                <a href="media" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>Enquires</span></a>
                            </li>

                            <li>
                                <a href="noticeboard" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>NoticeBoard</span></a>
                            </li>
                        
                        
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </aside>
