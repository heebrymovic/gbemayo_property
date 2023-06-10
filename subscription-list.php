<?php 
 include("includes/header.php");
 realtors_route();

?>

    <!-- Main Content -->
    <div class="body_area after_bg sm">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Subscriptions</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Subscription List</h1>
                    </div>           
                </div>
                <?php
                    if ($session_logged_in_privilege_id == 3 && $fetch_agent_info["agent_subscription_status"] == "inactive") {
                        include("realtor-subscribe-msg.php");
                    }else if ($session_logged_in_privilege_id == 4 && $fetch_agent_info["agent_subscription_status"] == "inactive"){
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
                                        <th class="border-top-0">Subscription Start</th>
                                        <th class="border-top-0">Subscription Ends</th>
                                        <th class="border-top-0">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $query_all_txn =  query_agent_subscription($session_logged_in_business_id, $session_logged_in_agent_id, true);

                                        $count = 1;

                                        while($fetch_all_txn = mysqli_fetch_assoc($query_all_txn)){
                                            
                                            extract($fetch_all_txn);

                                        ?>

                                            <tr>
                                                <td><?php echo $count++  ?></td>
                                                <td><span><?php echo date("D, d M Y" ,strtotime($subscription_start) )  ?></span></td>
                                                <td><span><?php echo date("D, d M Y" ,strtotime($subscription_ends) )  ?></span></td>
                                                <td><span class="badge <?php echo $subscription_status == 'active' ? 'badge-success' : 'badge-danger'  ?>"><?php echo $subscription_status  ?></span></td>                                           
                                        
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