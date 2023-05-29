<?php 
include("includes/header.php");
superadmin_route();    

    if (isset($_GET['business-id']) && !empty($_GET['business-id']) ) {
        
        $business_id = base64_decode($_GET['business-id']);

        $query_business_info = admin_query_company_acc_info($business_id);

        $fetch_business_info = mysqli_fetch_assoc($query_business_info);

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
                            <li class="breadcrumb-item"><a href="business-list">Business List</a></li>
                            <li class="breadcrumb-item active">Business Details</li>
                        </ul>
                         <h1 class="mb-1 mt-1">Business Details</h1>
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
                                <div class="col-lg-3 col-md-6 col-6">
                                    <div class="card text-center">
                                        <div class="body">
                                            <i class="zmdi zmdi-thumb-up zmdi-hc-2x"></i>
                                            <h5 class="m-b-0 number count-to" data-from="0" data-to="<?php echo query_total_business_agents($business_id) ?>" data-speed="1000" data-fresh-interval="700"><?php echo query_total_business_agents($business_id) ?></h5>
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
                                            <small class="text-muted">Business name: </small>
                                            <p><?php echo $fetch_business_info['company_name'] ?></p>
                                            <hr>
                                            <small class="text-muted">Address: </small>
                                            <p><?php echo $fetch_business_info['company_address'] ?></p>
                                            <div>
                                               <img src="<?php echo $fetch_business_info['company_photo'] ?>" alt="Business Image" style="border:0; width: 100%; max-height: 250px; object-fit: cover;">
                                            </div>
                                            <hr>
                                            <small class="text-muted">Email address: </small>
                                            <p><?php echo $fetch_business_info['company_email'] ?></p>
                                            <hr>
                                            <small class="text-muted">Referral id: </small>
                                            <p><?php echo $fetch_business_info['company_referral_id'] ?></p>
                                            <hr>
                                            <small class="text-muted">Mobile: </small>
                                            <p><?php echo $fetch_business_info['company_phone_number'] ?></p>
                                            <hr>
                                            <small class="text-muted">Account Name: </small>
                                            <p><?php echo $fetch_business_info['company_account_name'] ?></p>
                                            <hr>
                                            <small class="text-muted">Account Number:</small>
                                            <p><?php echo $fetch_business_info['company_account_number'] ?></p>
                                            <hr>
                                             <small class="text-muted">Bank Name:</small>
                                            <p><?php echo $fetch_business_info['company_bank_name'] ?></p>
                                        </div>
                                    </div>
                                  
                                </div>
                                <div class="col-lg-8 col-md-12">
                                    
                            <div class="card p-3" >
                            <h4>List of Agents</h4>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                <thead>
                                    <tr>
                                        <th># ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Agent Type</th>
                                        <th>Subscription Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query_all_agents = admin_query_business_agents($business_id , true);
                                        $count = 1;
                                        while($fetch_all_agent = mysqli_fetch_assoc($query_all_agents)){

                                            extract($fetch_all_agent);
                                        ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td>
                                                    <a href="">
                                                        <img src="../<?php echo $agent_profile_photo ?>" class="rounded-circle avatar" alt="">
                                                        <span><?php echo ucwords($agent_fullname); ?></span>
                                                    </a>
                                                </td>
                                                <td><?php echo $agent_email; ?></td>
                                                <td><p style="white-space:initial;"><?php echo $agent_address; ?></p></td>
                                                <td><?php echo ucwords($privileges_name); ?></td>
                                                <td><span class="badge <?php echo  $agent_payment_status == 'inactive' ? 'badge-danger' : 'badge-success'   ?> "><?php echo $agent_payment_status ?></span></td>
                                                <td>
                                                   <a href="agent-details?agent-id=<?php echo base64_encode($agent_id) ?>&business-id=<?php echo base64_encode($agent_business_id) ?>" class="btn btn-sm btn-primary">View More</a>
                                                    <!-- <a href="" class="btn btn-sm btn-danger">View </a> -->
                                                </td>
                                            </tr>

                                        <?php

                                            }

                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="card p-4">
                       <h4>List Of Clients</h4>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                <thead>
                                    <tr>
                                        <th># ID</th>
                                        <th>Name</th>
                                        <th>Agent Name</th>
                                        <?php
                                           if ($session_logged_company_privilege_id == 1){
                                        ?>
                                        <th>Business Name</th>
                                         <?php
                                            }
                                        ?>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Total Purchase</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query_all_clients = admin_query_business_clients($fetch_business_info['company_id'], true);
                                        $count = 1;
                                        while($fetch_all_clients = mysqli_fetch_assoc($query_all_clients)){

                                            extract($fetch_all_clients);
                                        ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo "{$clients_title} {$clients_fullname}"; ?></td>
                                                <td><?php  echo $session_logged_company_privilege_id == 1 ? $agent_fullname : ($agent_fullname ? $agent_fullname : $company_name ); ?></td>
                                                <?php
                                                    if ($session_logged_company_privilege_id == 1){
                                                ?>
                                                <td><?php echo $company_name;  ?></td>
                                                <?php
                                                    }
                                                ?>
                                                <td><?php echo $clients_email; ?></td>
                                                <td><?php echo $clients_address; ?></td>
                                                <td><?php echo $clients_phone_number; ?></td>
                                                <td></td>
                                                <td><a href="client-details?client_id=<?php echo base64_encode($clients_id) ?>&business_id=<?php echo base64_encode($clients_business_id) ?>&agent_id=<?php echo base64_encode($clients_agent_id) ?>" class="btn btn-success text-white btn-sm">View more</a></td>
                                               
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