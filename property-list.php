<?php 
 include("includes/header.php");
?>

   
    <!-- Main Content -->
    <div class="body_area after_bg sm">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Property</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Property List</h1>
                    </div>           
                </div>
                <?php
                     if ($session_logged_in_privilege_id == 3 && $fetch_agent_info["agent_payment_status"] == "inactive") {
                        include("realtor-subscribe-msg.php");
                    }else{
                        include("marketers-subscribe-msg.php");
                    }
                ?>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-5">
                        
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">ID</th>
                                        <th class="border-top-0">Property Name</th>
                                        <th class="border-top-0">Address</th>
                                        <th class="border-top-0">Property Type</th>
                                        <th class="border-top-0">Price</th>
                                        <th class="border-top-0">Status</th>
                                        <th class="border-top-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $query_all_property =  query_all_property(true);

                                        $count = 1;

                                        while($fetch_property = mysqli_fetch_assoc($query_all_property)){
                                            
                                            extract($fetch_property);

                                            $images = json_decode($property_file);

                                        ?>

                                             <tr>
                                                <td><?php echo $count++  ?></td>
                                        <td class="d-flex align-items-center">
                                            <a href="#"><img class="img-fluid rounded" style="max-width: 80px;" src="realestate/<?php echo $images[0] ?>" alt="property img"></a>
                                            <div class="ml-3">
                                                <strong><?php echo $property_name ?></strong>
                                            </div>
                                        </td>
                                        <td>
                                             <div class="font-13 text-muted hidden-md" style="white-space: initial;"> <?php echo $property_address  ?></div>
                                            </div>
                                        </td>
                                        <td><?php echo ucwords($property_type_name) ?></td>
                                           
                                        <td><strong class="text-info">N<?php echo number_format($property_price) ?></strong></td>
                                        <td><span class="badge <?php echo $property_status == 'active' ? 'badge-success' : 'badge-danger' ?> "><?php echo $property_status ?></span></td>
                                        <td>
                                            <a class="btn btn-secondary" href="property-detail?property_id=<?php echo base64_encode($property_id) ?>">View More</a>

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



<?php
    require("includes/footer.php");
?>