<?php 
include("includes/header.php");
    
    realtors_route();

    if (isset($_GET['business-id']) && !empty($_GET['business-id']) && isset($_GET['agent-id']) && !empty($_GET['agent-id'])  ) {
        
        $business_id = base64_decode($_GET['business-id']);

        $agent_id = base64_decode($_GET['agent-id']);

        $query_agent_info = admin_query_agent($business_id, $agent_id, true);

        $fetch_agent_info = mysqli_fetch_assoc($query_agent_info);


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
                            <li class="breadcrumb-item"><a href="agent-list">Agent List</a></li>
                            <li class="breadcrumb-item active">Agent Details</li>
                        </ul>
                         <h1 class="mb-1 mt-1">Agent Details</h1>
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
                    <div class="row clearfix">
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

                            </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="overview">
                            
                            <div class="row clearfix">
                                
                            <div class="col-lg-4 col-md-12">
                            
                              
                              <div class="card">
                                        <div class="header">
                                            <h2><strong>Info</strong></h2>
                                        </div>
                                        <div class="body pt-1">
                                            <small class="text-muted">FullName: </small>
                                            <p><?php echo ucwords($fetch_agent_info['agent_fullname']) ?></p>
                                            <hr>
                                            <small class="text-muted">Email address: </small>
                                            <p><?php echo $fetch_agent_info['agent_email'] ?></p>
                                            <hr>
                                             <small class="text-muted">Agent Type: </small>
                                            <p><?php echo ucwords($fetch_agent_info['privileges_name']) ?></p>
                                            <hr>
                                            <small class="text-muted">Address: </small>
                                            <p><?php echo $fetch_agent_info['agent_address'] ?></p>
                                            <div>
                                               <img src="<?php echo $fetch_agent_info['agent_profile_photo'] ?>" alt="Agent Image" style="border:0; width: 100%; max-height: 250px; object-fit: cover;">
                                            </div>
                                            <hr>
                                            <small class="text-muted">Referral id: </small>
                                            <p><?php echo $fetch_agent_info['agent_referral_id'] ?></p>
                                            <hr>
                                            <small class="text-muted">Mobile: </small>
                                            <p><?php echo $fetch_agent_info['agent_phone_number'] ?></p>
                                            <hr>
                                            <small class="text-muted">Account Name: </small>
                                            <p><?php echo $fetch_agent_info['agent_account_name'] ?></p>
                                            <hr>
                                            <small class="text-muted">Account Number:</small>
                                            <p><?php echo $fetch_agent_info['agent_account_number'] ?></p>
                                            <hr>
                                             <small class="text-muted">Bank Name:</small>
                                            <p><?php echo $fetch_agent_info['agent_bank_name'] ?></p>
                                        </div>
                                    </div>
                            </div>

                            <div class="col-lg-8 col-md-12">
                                  <div class="card p-3" >
                            <h5>Lists Of Property Sold</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                <thead>
                                    <tr>
                                        <th># ID</th>
                                        <th>Property Name</th>
                                        <th>Price</th>
                                        <th>Paid Amount Price</th>
                                        <th>Agent Payment Structure</th>
                                        <th>Payment Status</th>
                                        <th>Purchase Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                       /* $query_all_clients = agent_buyers_property_purchase($agent_id, $business_id, NULL, true);
                                        $count = 1;
                                        while($fetch_all_clients = mysqli_fetch_assoc($query_all_clients)){

                                            extract($fetch_all_clients);*/
                                        ?>
                                            <tr>
                                                <td><?php echo @$count++;  ?></td>
                                               
                                            </tr>

                                        <?php

                                           /* }*/

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
        
    $(document).ready(function() {
            $('#datatables').DataTable({});

    });
</script>

</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:58 GMT -->
</html>