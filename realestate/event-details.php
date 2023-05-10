<?php 
include("includes/header.php");


    if (isset($_GET['event_id']) && !empty($_GET['event_id']) ) {
        
        $event_id = base64_decode($_GET['event_id']);

        $query_event_info = query_single_event($event_id, true);

        $fetch_event_info = mysqli_fetch_assoc($query_event_info);

    }else{
        header("location:../404");
    }
?>


    <!-- Right Sidebar -->
  <!--   <aside id="rightsidebar" class="right-sidebar">
        <div class="card">
            <div class="header">
                <h2>Layout Settings</h2>
            </div>
            <ul class="list-unstyled layout_setting">
                <li>
                    <label class="c_radio">
                        <input name="menu_settings" type="radio" value="menu-h" checked="">
                        <span class="checkmark"></span>
                        <span class="ml-2">Horizontal Menu</span>
                    </label>
                </li>
                <li>
                    <label class="c_radio">
                        <input name="menu_settings" type="radio" value="menu-l">
                        <span class="checkmark"></span>
                        <span class="ml-2">Vertical Leftbar</span>
                    </label>
                </li>
                <li>
                    <label class="c_radio">
                        <input name="menu_settings" type="radio" value="menu-f">
                        <span class="checkmark"></span>
                        <span class="ml-2">Full witdh Layout</span>
                    </label>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="header">
                <h2>Theme Settings</h2>
            </div>
            <ul class="list-unstyled choose-skin">
                <li data-theme="purple"><div class="purple"></div></li>
                <li data-theme="blue"><div class="blue"></div></li>
                <li data-theme="cyan"><div class="cyan"></div></li>
                <li data-theme="green" class="active"><div class="green"></div></li>
                <li data-theme="orange"><div class="orange"></div></li>
                <li data-theme="blush"><div class="blush"></div></li>
            </ul>
            <div class="bh_divider"></div>
            <ul class="list-unstyled font_setting">
                <li>
                    <label class="c_radio">
                        <input type="radio" name="font" value="font-quicksand">
                        <span class="checkmark"></span>
                        <span class="ml-2">Quicksand Google Font</span>
                    </label>
                </li>
                <li>
                    <label class="c_radio">
                        <input type="radio" name="font" value="font-nunito">
                        <span class="checkmark"></span>
                        <span class="ml-2">Nunito Google Font</span>
                    </label>
                </li>
                <li>
                    <label class="c_radio">
                        <input type="radio" name="font" value="font-ubuntu">
                        <span class="checkmark"></span>
                        <span class="ml-2">Ubuntu Google Font</span>
                    </label>
                </li>
                <li>
                    <label class="c_radio">
                        <input type="radio" name="font" value="font-raleway" checked="">
                        <span class="checkmark"></span>
                        <span class="ml-2">Raleway Google Font</span>
                    </label>
                </li>
            </ul>
            <div class="bh_divider"></div>
            <ul class="list-unstyled mb-0">
                <li class="d-flex align-items-center mb-2">
                    <label class="toggle-switch theme-switch">
                        <input type="checkbox">
                        <span class="toggle-switch-slider"></span>
                    </label>
                    <span class="ml-3">Enable Dark Mode!</span>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <label class="toggle-switch theme-high-contrast">
                        <input type="checkbox">
                        <span class="toggle-switch-slider"></span>
                    </label>
                    <span class="ml-3">Enable High Contrast</span>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <label class="toggle-switch theme-rtl">
                        <input type="checkbox">
                        <span class="toggle-switch-slider"></span>
                    </label>
                    <span class="ml-3">Enable RTL Mode!</span>
                </li>
            </ul>
        </div>
        <div class="card">
            <a href="javascript:void(0);" target="_blank" class="btn btn-block btn-primary">Buy this item</a>
            <a href="https://themeforest.net/user/thememakker/portfolio" target="_blank" class="btn btn-block btn-secondary">Themeforest Portfolio</a>
            <a href="https://thememakker.com/" target="_blank" class="btn btn-block btn-default">Visit ThemeMakker</a>
        </div>
    </aside> -->

    <!-- Main Content -->
    <div class="body_area profile-page">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="events">Events List</a></li>
                            <li class="breadcrumb-item active">Event Details</li>
                        </ul>
                         <h1 class="mb-1 mt-1">Event Details</h1>
                    </div>                      


                </div>
         
                <!-- <div class="row clearfix">
                    <div class="col-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#overview">Overview</a></li>
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#schedule">Schedule</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#usersettings">Settings</a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                  
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="overview">
                            <!-- <div class="row clearfix">
                                <div class="col-lg-3 col-md-6 col-6">
                                    <div class="card text-center">
                                        <div class="body">
                                            <i class="zmdi zmdi-thumb-up zmdi-hc-2x"></i>
                                            <h5 class="m-b-0 number count-to" data-from="0" data-to="1203" data-speed="1000" data-fresh-interval="700">1203</h5>
                                            <small>Total Agents</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <div class="card text-center">
                                        <div class="body">                            
                                            <i class="zmdi zmdi-comment-text zmdi-hc-2x"></i>
                                            <h5 class="m-b-0 number count-to" data-from="0" data-to="324" data-speed="1000" data-fresh-interval="700">324</h5>
                                            <small>Total Realtors</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <div class="card text-center">
                                        <div class="body">
                                            <i class="zmdi zmdi-eye zmdi-hc-2x"></i>
                                            <h5 class="m-b-0 number count-to" data-from="0" data-to="1980" data-speed="1000" data-fresh-interval="700">1980</h5>
                                            <small>Total Marketers</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <div class="card text-center">
                                        <div class="body">
                                            <i class="zmdi zmdi-attachment zmdi-hc-2x"></i>
                                            <h5 class="m-b-0 number count-to" data-from="0" data-to="52" data-speed="1000" data-fresh-interval="700">52</h5>
                                            <small>Total Transactions</small>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2><strong>Info</strong></h2>
                                            <!-- <ul class="header-dropdown">
                                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="javascript:void(0);">Action</a></li>
                                                        <li><a href="javascript:void(0);">Another action</a></li>
                                                        <li><a href="javascript:void(0);">Something else</a></li>
                                                        <li><a href="javascript:void(0);" class="boxs-close">Delete</a></li>
                                                    </ul>
                                                </li>
                                            </ul> -->
                                        </div>

                                        <div class="body">
                                             <div class="d-flex flex-column mb-4">
                                                <input  type="text" style="display: none;" id="copyInput" value='<?php echo get_url("/CD/gbemayo/event")."?refid=$company_event_id&event_id=". base64_encode($event_id) ?>'>
                                               <button id="copyData" class="btn btn-primary" >Copy Invite Link</button>
                                            </div>
                                            <small class="text-muted">Event Title: </small>
                                            <p><?php echo $fetch_event_info['events_title'] ?></p>
                                            <hr>
                                            <small class="text-muted">Event Desc: </small>
                                            <p><?php echo $fetch_event_info['events_desc'] ?></p>
            
                                            <hr>
                                            <small class="text-muted">Event Venue: </small>
                                            <p><?php echo $fetch_event_info['events_venue'] ?></p>
                                            <hr>

                                            <small class="text-muted">Event Date:</small>
                                            <p><?php echo date("D, d M Y", strtotime($fetch_event_info['events_date'])) ?></p>
                                            <hr>
                                            <small class="text-muted">Event Status: </small>
                                            <p><span class="badge  <?php echo $fetch_event_info['events_status'] == 'active' ? 'badge-success' : 'badge-danger' ?>"><?php echo $fetch_event_info['events_status'] ?></span></p>
                                            <hr>
                                            
                                        </div>
                                    </div>
                                  
                                </div>
                                <div class="col-lg-8 col-md-12">
                                    
                        <div class="card p-3" >
                            <h5>Lists Of invitee</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                <thead>
                                    <tr>
                                        <th># ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        
                                        <?php
                                            if ($session_logged_company_privilege_id == 1) {
                                        ?>
                                             <th>Agent Name</th>
                                             <th>Business </th>
                                        <?php
                                            }else{
                                        ?>
                                            <th>Reffered By</th>
                                        <?php
                                            }
                                        ?>
                                       
                                        <th>Registered Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query_all_event = $session_logged_company_privilege_id == 1 ? query_all_event_reg($event_id, true) : business_query_event_reg($session_logged_admin_company_id, $event_id, true);
                                        $count = 1;
                                        while($fetch_all_event = mysqli_fetch_assoc($query_all_event)){

                                            extract($fetch_all_event);
                                        ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td><?php echo $event_invite_fullname ?></td>
                                                <td><?php echo $event_invite_email ?></td>
                                                <td><?php echo $event_invite_phone_no ?></td>
                                                <td><?php echo $event_invite_gender ?></td>
                                                <td><p style="white-space:initial;"><?php echo $event_invite_address ?></p></td>

                                        <?php
                                            if ($session_logged_company_privilege_id == 1) {
                                        ?>
                                             <td><?php echo $agent_fullname?></td>
                                              <td><?php echo $company_name; ?></td>
                                        <?php
                                            }else{
                                        ?>
                                             <td><?php echo $agent_fullname ? $agent_fullname : $company_name; ?></td>
                                        <?php
                                            }
                                        ?>

                                               
                                                <td><?php echo date("D, d M Y", strtotime($event_invite_created_on)); ?></td>
                                            </tr>

                                        <?php

                                            }

                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                                  
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>

  

</div>

<script>
  

    copyData.addEventListener("click", copyToClipBoard);
    
    function copyToClipBoard(e) {

        var defaults = this.innerHTML;

        let copyInput = document.querySelector("#copyInput");

        console.log( copyInput)

        copyInput.style.display = 'block'
        
        copyInput.select();

         document.execCommand('copy');

         this.innerHTML = "Copied"

         copyInput.style.display = 'none'

         setTimeout(() => this.innerHTML = defaults, 1000)
    }
</script>
<?php include("includes/footer1.php") ?>

