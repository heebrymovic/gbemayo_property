<?php 
include("includes/header.php");



    if (isset($_GET['client_id']) && !empty($_GET['client_id']) ) {
        
        $client_id = base64_decode($_GET['client_id']);

        $query_client_info = query_clients($session_logged_in_agent_id, $session_logged_in_business_id, $client_id, true);

        $fetch_client_info = mysqli_fetch_assoc($query_client_info);


    }else{
        header("location:404");
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
                
                            <li class="breadcrumb-item"><a href="client-list">Client List</a></li>
                            <li class="breadcrumb-item active">Client Details</li>
                        </ul>
                         <h1 class="mb-1 mt-1">Client Details</h1>
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
                                            <h2><strong>Clients Info</strong></h2>
                                        </div>
                                        <div class="body pt-1">
                                            <div class="mb-3">
                                               <img src="clients/<?php echo $fetch_client_info['clients_photo'] ?>" alt="Clients Image" style="border:0; width: 100%; max-height: 250px; object-fit: cover;">
                                            </div>
                                            <small class="text-muted ">FullName: </small>
                                            <p><?php echo ucwords($fetch_client_info['clients_title'] . " " .$fetch_client_info['clients_fullname']) ?></p>
                                            <hr>
                                            <small class="text-muted">Email address: </small>
                                            <p><?php echo $fetch_client_info['clients_email'] ?></p>
                                            <hr>
                                             <small class="text-muted">Phone Number: </small>
                                            <p><?php echo ucwords($fetch_client_info['clients_phone_number']) ?></p>
                                            <hr>
                                            <small class="text-muted">Address: </small>
                                            <p><?php echo $fetch_client_info['clients_address'] ?></p>  
                                            <hr>
                                                
                                        </div>
                                    </div>
                                  
                                </div>
                                <div class="col-lg-8 col-md-12">
                                    <div class="card p-3" >
                                            <h5>Lists Of Purchased Property</h5>
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                                   <thead>
                                                    <tr>
                                                        <th># ID</th>
                                                        <th>Property Name</th>
                                                        <th>Property Price</th>
                                                        <th>Payment Type</th>
                                                        <th>Purchase Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $query_all_purchase = query_all_clients_property_purchase($client_id, true);
                                                        $count = 1;
                                                        while($fetch_all_purchase = mysqli_fetch_assoc($query_all_purchase) ){
                                
                                                        extract($fetch_all_purchase);

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $count++; ?></td>
                                                            <td><?php echo $property_name;?></td>
                                                            <td>N<?php echo number_format($property_price);?></td>
                                                            <td><?php echo $installmental_property_duration ? $installmental_property_duration : "Full Payment" ?></td>
                                                            <td><?php echo date('D, d m Y ' , strtotime($property_buy_created_on)); ?></td>
                                                            <td><a class="btn btn-primary btn-sm" href="purchase-details?purchase-id=<?php echo base64_encode($property_buy_id) ?>">View More</a> </td>

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