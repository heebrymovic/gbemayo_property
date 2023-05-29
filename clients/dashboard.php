<?php
     include("includes/header.php");
?>

    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Good <?php echo $currentTime .", " . ucwords($fetch_client_info['clients_title'] ." " . $fetch_client_info['clients_fullname']) ?></h1>
                        <span>Welcome back to your dashboard.</span>
                    </div>            
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row clearfix row-deck">
                
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card top_widget">
                        <div class="body">
                            
                            <div class="content">
                                <div class="text mb-3 text-uppercase">Total Property</div>
                                <h4 class="number mb-0"><?php echo query_all_property(); ?></h4>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card top_widget">
                        <div class="body">
                            
                            <div class="content">
                                <div class="text mb-3 text-uppercase">Total Purchased Property</div>
                                <h4 class="number mb-0"><?php echo clients_property_purchase($session_logged_in_client_id) ?></h4>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card top_widget">
                        <div class="body">
                            
                            <div class="content">
                                <div class="text mb-3 text-uppercase">Total Events</div>
                                <h4 class="number mb-0"><?php echo query_all_events() ?></h4>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card top_widget">
                        <div class="body">
                            
                            <div class="content">
                                <div class="text mb-3 text-uppercase">Total Attended Events</div>
                                <h4 class="number mb-0"><?php echo query_clients_attend_event($session_logged_in_client_id) ?></h4>
                            </div>
                           
                        </div>
                    </div>
                </div>

                 <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card top_widget">
                        <div class="body">
                            
                            <div class="content">
                                <div class="text mb-3 text-uppercase">Total Payment Transactions</div>
                                <h4 class="number mb-0"><?php echo query_client_total_payments($session_logged_in_client_id) ?></h4>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
           
            

<?php

    include("includes/footer.php");
?>