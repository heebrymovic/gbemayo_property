<?php include("includes/header.php"); ?>
   
    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Sales List</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Sales List</h1>
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
                                        <th>Property Name</th>
                                        <th>Property Price</th>
                                        <th>Payment Type</th>
                                        <th>Purchase Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query_all_purchase = agent_sold_property($session_logged_in_agent_id, $session_logged_in_business_id, true);
                                        $count = 1;
                                        while($fetch_all_purchase = mysqli_fetch_assoc($query_all_purchase)){

                                            extract($fetch_all_purchase);
                                            $images = json_decode($property_file);
                                        ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                
                                                <td><img class="img-fluid rounded" style="max-width: 80px;" src="realestate/<?php echo $images[0] ?>" alt="property img"> <span class="ml-3"><?php echo $property_name;?></span></td>

                                                <td>N<?php echo number_format($property_price);  ?></td>
                                                <td><?php echo $installmental_property_duration ? "N". number_format($installmental_property_amount) . " For ".$installmental_property_duration : "Full Payment" ?></td>
                                                <td><?php echo date('D, d M Y ' , strtotime($property_buy_created_on)); ?></td>
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

