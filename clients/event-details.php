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
                                <div class="col-lg-5 col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2><strong>Info</strong></h2>
                                            
                                        </div>

                                        <div class="body">
                                             
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
                                            <?php
                                                if ( $fetch_event_info['events_status'] == 'active' && query_client_event($event_id, $session_logged_in_client_id) == 0 ) {

                                            ?>
                                                 <p>Click on a particular button to attend the event or not.</p>
                                                <div class="d-flex">
                                                <a class="btn btn-success text-white" href="set-event?event_id=<?php echo base64_encode($event_id) ?>&status=<?php echo base64_encode('will attend') ?>">Will Attend</a>
                                                <a class="btn btn-warning ml-2" href="set-event?event_id=<?php echo base64_encode($event_id) ?>&status=<?php echo base64_encode('not sure') ?>">Not Sure</a>
                                                <a class="btn btn-danger ml-2" href="set-event?event_id=<?php echo base64_encode($event_id) ?>&status=<?php echo base64_encode('not attending') ?>">Not Attending</a>
                                            </div>

                                            <?php
                                                }else if (query_client_event($event_id, $session_logged_in_client_id) > 0){

                                                    $query_client_event =  query_client_event($event_id, $session_logged_in_client_id, true);

                                                    $fetch_client_event = mysqli_fetch_assoc($query_client_event);
                                                ?>
                                                        <h5>Attendance Status</h5>
                                                        <span class="badge badge-info"><?php echo $fetch_client_event['event_invite_status']; ?></span>

                                                <?php
                                                }
                                            ?>
                                           
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
<script src="../assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="../assets/bundles/c3.bundle.js"></script>

<script src="../assets/bundles/mainscripts.bundle.js"></script>
<script src="../assets/bundles/index.js"></script>
<script src="../assets/bundles/datatablescripts.bundle.js"></script>

<script>
        
    $(document).ready(function() {
            $('#datatables').DataTable({});

    });
</script>

</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:58 GMT -->
</html>