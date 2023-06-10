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
                                               <input  type="text" style="display: none;" id="copyInput" value='<?php echo get_url("event")."?refid=$agent_event_id&event_id=". base64_encode($event_id) ?>'>
                                               <button id="copyData" class="btn btn-primary" >Copy Invite Link</button>
                                            </div>
                                            <div>
                                               <img onclick="openFullscreen(this)" src="realestate/<?php echo $fetch_event_info['events_banner'] ?>" alt="Events Banner Image" style="border:0; width: 100%; max-height: 350px; cursor: pointer;">
                                            </div>
                                            <hr>
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
                            <h5>Lists Of clients invitee</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                <thead>
                                    <tr>
                                        <th># ID</th>
                                        <th>FullName</th>
                                        <th>Event Status</th>
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
                                                <td><?php echo ucwords($clients_title . " " . $clients_fullname) ?></td>
                                                <td><span class="badge badge-info"><?php echo $event_invite_status ?></span></td>
                                                <td><?php echo date("D, d M Y", strtotime($event_invite_created_on)); ?></td>
                                            </tr>

                                        <?php

                                            }

                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                             <div class="card p-3" >
                            <h5>Lists Of normal users invitee</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables1">
                                <thead>
                                    <tr>
                                        <th># ID</th>
                                        <th>FullName</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Registration Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query_all__invitee = agent_normal_event_invitee($session_logged_in_agent_id, $session_logged_in_business_id, $event_id,true);
                                        $count = 1;
                                        while($fetch_all_invitee = mysqli_fetch_assoc($query_all__invitee)){

                                            extract($fetch_all_invitee);
                                        ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td><?php echo ucwords($normal_event_reg_fullname) ?></td>
                                                <td><?php echo $normal_event_reg_email ?></td>
                                                <td><?php echo $normal_event_reg_phone_no ?></td>
                                                <td><?php echo date("D, d M Y", strtotime($normal_event_created_on)); ?></td>
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

<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="assets/bundles/c3.bundle.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/bundles/index.js"></script>
<script src="assets/bundles/datatablescripts.bundle.js"></script>

<script>
        
     var click = 0;

    copyData?.addEventListener("click", copyToClipBoard);
    
    function copyToClipBoard(e) {

        var defaults = this.innerHTML;

        if (click == 1 ) return

        click++;

        let copyInput = document.querySelector("#copyInput");

        copyInput.style.display = 'block'
        
        copyInput.select();

         document.execCommand('copy');

         this.innerHTML = "Copied"

         copyInput.style.display = 'none'

         setTimeout(() => {
            this.innerHTML = defaults;
            click = 0;
         }, 1000)
    }

    function openFullscreen(elem) {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
      }
    }

    $(document).ready(function() {
            $('#datatables').DataTable({});
            $('#datatables1').DataTable({});

    });
</script>

</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:58 GMT -->
</html>