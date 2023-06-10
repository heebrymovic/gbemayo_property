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
                                <div class="col-lg-4 col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2><strong>Info</strong></h2>
                            
                                        </div>

                                        <div class="body">
                                             <div class="d-flex flex-column mb-4">
                                                <input  type="text" style="display: none;" id="copyInput" value='<?php echo get_url("event")."?refid=$company_event_id&event_id=". base64_encode($event_id) ?>'>
                                               <button id="copyData" class="btn btn-primary">Copy Invite Link</button>
                                            </div>
                                            <div>
                                               <img onclick="openFullscreen(this)" src="<?php echo $fetch_event_info['events_banner'] ?>" alt="Events Banner Image" style="border:0; width: 100%; max-height: 350px; cursor: pointer;">
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
                            <h5>Lists Of invitee</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                <thead>
                                    <tr>
                                        <th># ID</th>
                                        <th>Name</th>
                                        <th>Attendance Status</th>
                                        <th>Email</th>
                                        <th>Clients Photo</th>
                                        
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
                                                <td><?php echo $clients_fullname ?></td>
                                                <td><span class="badge <?php echo $event_invite_status == 'will attend' ? 'badge-success' : ($event_invite_status == 'not sure' ? 'badge-warning' : 'badge-info')  ?>"><?php echo $event_invite_status ?></span></td>
                                                <td><?php echo $clients_email ?></td>
                                                
                                                <td><img style="width: 200px;cursor: pointer;" onclick="openFullscreen(this)" src="../clients/<?php echo $clients_photo ?>"></td>

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



                              <div class="card p-3" >
                            <h5>Lists Of Non Clients invitee</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables1">
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

                                        $query_all_event = $session_logged_company_privilege_id == 1 ? query_all_normal_event_reg($event_id, true) : business_query_normal_event_reg($session_logged_admin_company_id, $event_id, true);
                                        $count = 1;
                                        while($fetch_all_event = mysqli_fetch_assoc($query_all_event)){

                                            extract($fetch_all_event);
                                        ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td><?php echo $normal_event_reg_fullname;  ?></td>
                                                <td><?php echo $normal_event_reg_email ?></td>
                                                <td><?php echo $normal_event_reg_phone_no ?></td>
                                                <td><?php echo $normal_event_reg_gender ?></td>
                                                <td>
                                                    <p style="white-space:initial;"><?php echo $normal_event_reg_address ?></p>
                                                </td>

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


<?php include("includes/footer1.php") ?>

