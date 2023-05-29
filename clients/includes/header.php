    <?php

    include("../includes/plugins.php");
    authenticate_client_login();

    $query_client_info = admin_query_client($session_logged_in_client_id, $session_logged_in_business_id, $session_logged_in_agent_id,true);

    $fetch_client_info = mysqli_fetch_assoc($query_client_info);

    $the_hour = date("H");
    
    $currentTime = ($the_hour > 17) ? "Evening" : (($the_hour > 12) ? "Afternoon" : "Morning");

?>

<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
<title>Gbemayo :: Clients Dashboard</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
<link rel="stylesheet" href="../assets/plugins/c3/plugin.css"/>
<!-- Custom Css -->
<link rel="stylesheet" href="../assets/css/amaze.style.min.css">
</head>

<body class="font-ubuntu h_menu">

<div id="body" class="theme-purple">

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
                            <a class="navbar-brand" href="index.html"><img src="../assets/images/logo.svg" width="30" alt="Amaze"><span class="ml-2">Amaze</span></a>
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
                                                                <span class="name">Dr. Alexander <span class="time">13min ago</span></span>
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
                                        <img class="rounded-circle"  src="<?php echo $fetch_client_info['clients_photo']; ?>" style="width:30px; height: 30px;object-fit: cover;">
                                    </a>
                                    <ul class="dropdown-menu py-3">
                                                                   
                                        <li><a href="profile"><i class="icon-user mr-2"></i> <span>My Profile</span> </a></li>
                                        <li><a href="logout"><i class="icon-power mr-2"></i><span>Sign Out</span></a></li>
                                    </ul>
                                </li>
                                <!-- <li><a href="javascript:void(0);" class="js-right-sidebar"><i class="icon-equalizer"></i></a></li> -->
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
                            <li>
                                <a href="dashboard" class="menu-toggle"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
                            </li>
                            <li><a href="property-list"><i class="zmdi zmdi-hospital-alt"></i><span>Property</span></a></li>
                            <li><a href="events" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Events</span></a></li>
                            <li><a href="purchase-list" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Purchase List</span></a></li>
                            <!-- <li><a href="" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Events</span></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </aside>

   