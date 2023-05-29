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
                                        <th>Clients Name</th>
                                        <th>Agent Name</th>
                                        <?php
                                           if ($session_logged_company_privilege_id == 1){
                                        ?>
                                        <th>Business Name</th>
                                         <?php
                                            }
                                        ?>
                                        <th>Property Name</th>
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
                                                        <img src="../clients/<?php echo $clients_photo; ?>" style="object-fit: cover;" class="rounded-circle avatar" alt="">
                                                        <span><?php echo $clients_title . " " . $clients_fullname ?></span>
                                                    </a>
                                                </td>

                                                <td><?php 
                                                echo $session_logged_company_privilege_id == 1 ? $agent_fullname : ($agent_fullname ? $agent_fullname : $company_name );

                                                ?></td>
                                                <?php
                                                    if ($session_logged_company_privilege_id == 1){
                                                ?>
                                                <td><?php echo $company_name;  ?></td>
                                                <?php
                                                    }
                                                ?>
                                                <td><?php echo $property_name;?></td>
                                                <!-- <td><span class="badge echo $property_buy_status =='pending' ?  'badge-warning' : 'badge-success';">echo $property_buy_status;  </span></td> -->
                                                <td>  
                                                    <a class="btn btn-success text-white btn-sm" href="purchase-details?purchase-id=<?php echo base64_encode($property_buy_id) ?>">View more</a>
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

