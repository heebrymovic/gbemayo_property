<?php 
include("includes/header.php");


    if (isset($_GET['event_id']) && !empty($_GET['event_id']) ) {
        
        $event_id = base64_decode($_GET['event_id']);

        $query_event_info = query_single_event($event_id, true);

        $fetch_event_info = mysqli_fetch_assoc($query_event_info);

        $agent_event_id = $fetch_agent_info['agent_event_id'];

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
                            
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2><strong>Info</strong></h2>
                                            
                                        </div>

                                        <div class="body">
                                             <div class="d-flex flex-column mb-4">
                                               <input  type="text" style="display: none;" id="copyInput" value='<?php echo get_url("/CD/gbemayo/event")."?refid=$agent_event_id&event_id=". base64_encode($event_id) ?>'>
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
                                        <th>FullName</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Registration Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query_all__invitee = agent_event_invitee($session_logged_in_agent_id, $session_logged_in_business_id, $event_id,true);
                                        $count = 1;
                                        while($fetch_all_invitee = mysqli_fetch_assoc($query_all__invitee)){

                                            extract($fetch_all_invitee);
                                        ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td><?php echo ucwords($event_invite_fullname) ?></td>
                                                <td><?php echo $event_invite_email ?></td>
                                                <td><span style="white-space:initial;"><?php echo $event_invite_address ?></span></td>
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
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="assets/bundles/c3.bundle.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/bundles/index.js"></script>
<script src="assets/bundles/datatablescripts.bundle.js"></script>

<script>
        
    $(document).ready(function() {
            $('#datatables').DataTable({});

    });
</script>

</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:58 GMT -->
</html>