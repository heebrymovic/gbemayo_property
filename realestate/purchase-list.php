<?php include("includes/header.php"); ?>
   
    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Purchase List</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Purchase List</h1>
                    </div>            
                    <div class="col-lg-6 col-md-12 text-md-right">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card p-4">
                       
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                <thead>
                                    <tr>
                                        <th># ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Agent Name</th>
                                        <th>Property Name</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query_all_purchase = $session_logged_company_privilege_id == 1 ? superadmin_query_buyers_property_purchase(true) : business_buyers_property_purchase($session_logged_admin_company_id , true);
                                        $count = 1;
                                        while($fetch_all_purchase = mysqli_fetch_assoc($query_all_purchase)){

                                            extract($fetch_all_purchase);
                                        ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td>
                                                    <a href="">
                                                        <img src="../<?php echo $buyers_passport; ?>" class="rounded-circle avatar" alt="">
                                                        <span><?php echo $buyers_title . " " . $buyers_fullname ?></span>
                                                    </a>
                                                </td>

                                                <td><?php echo $buyers_email ?></td>
                                                <td><?php echo $buyers_phone_number ?></td>
                                                <td><?php echo $property_buy_agent_id ? $agent_fullname : $company_name;  ?></td>
                                                <td><?php echo $property_name;?></td>
                                                <td><span class="badge <?php echo $property_buy_status =='pending' ?  'badge-warning' : 'badge-success';  ?>"><?php echo $property_buy_status;  ?></span></td>
                                                <td>  
                                                    <a class="btn btn-success text-white btn-sm" href="purchase-details?purchase-id=<?php echo base64_encode($property_buy_id) ?>">View more</a>

                                                    <?php
                                                        if ($session_logged_company_privilege_id == 1  && $property_buy_status != 'approved') {
                                    
                                                    ?>
                                                    <a class="btn btn-info text-white btn-sm" href="approve-purchase?property_buy_id=<?php echo base64_encode($property_buy_id) ?>">Approve</a>
                                                    <a class="btn btn-warning btn-sm" href="">Decline</a>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
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

<?php include("includes/footer.php") ?>

