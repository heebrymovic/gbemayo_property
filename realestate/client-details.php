<?php 
include("includes/header.php");



    if (isset($_GET['business_id']) && !empty($_GET['business_id']) && isset($_GET['agent_id']) && isset($_GET['client_id']) && !empty($_GET['client_id']) ) {
        

        $business_id = base64_decode($_GET['business_id']);

        $agent_id = base64_decode($_GET['agent_id']);

        $client_id = base64_decode($_GET['client_id']);


        $query_client_info = query_clients($agent_id, $business_id, $client_id, true);

        $fetch_client_info = mysqli_fetch_assoc($query_client_info);

        $query_nok =   query_client_next_of_kin($client_id, true);

        $fetch_nok = mysqli_fetch_assoc($query_nok);


    }else{
        header("location:404");
        exit();
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
                           
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2><strong>Clients Info</strong></h2>
                                        </div>
                                        <div class="body pt-1 pb-2">
                                            <div class="mb-3">
                                                <small class="text-muted">Profile Picture</small>
                                               <img src="../clients/<?php echo $fetch_client_info['clients_photo'] ?>" alt="Clients Image" style="border:0; width: 100%; max-height: 250px; object-fit: cover;">
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
                                            
                                        </div>
                                         <div class="header pt-0 mt-0">
                                                <h2><strong>Next Of Kin Information</strong></h2>
                                         </div>


                                        <div class="body pt-1 pb-2">
                                            <small class="text-muted ">FullName: </small>
                                            <p><?php echo ucwords(@$fetch_nok['client_next_of_kin_fullname']) ?></p>
                                            <hr>
                                            <small class="text-muted">Email address: </small>
                                            <p><?php echo @$fetch_nok['client_next_of_kin_email'] ?></p>
                                            <small class="text-muted">Phone Number: </small>
                                            <p><?php echo @$fetch_nok['client_next_of_kin_number'] ?></p>
                                            <hr>
                                             <small class="text-muted">Occupation: </small>
                                            <p><?php echo @$fetch_nok['client_next_of_kin_occupation'] ?></p>
                                            <hr>
                                             <small class="text-muted">Address: </small>
                                            <p><?php echo @$fetch_nok['client_next_of_kin_address'] ?></p>
                                            <hr>
                                            <small class="text-muted">Relationship: </small>
                                            <p><?php echo @$fetch_nok['client_next_of_kin_relationship'] ?></p>
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


<?php include("includes/footer1.php") ?>