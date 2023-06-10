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
                            <li class="breadcrumb-item active">Transactions</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Transaction List</h1>
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
                                        <th class="border-top-0">Ref ID</th>
                                        <th class="border-top-0">Amount</th>
                                        <th class="border-top-0">Status</th>
                                        <th class="border-top-0">Transaction Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $query_all_txn =  query_agent_txn($session_logged_in_business_id, $session_logged_in_agent_id, true);

                                        $count = 1;

                                        while($fetch_all_txn = mysqli_fetch_assoc($query_all_txn)){
                                            
                                            extract($fetch_all_txn);

                                        ?>

                                            <tr>
                                                <td><?php echo $count++  ?></td>
                                                <td><?php echo $txn_ref  ?></td>
                                                <td>N<?php echo number_format($txn_amount)  ?></td>
                                                <td><span class="badge badge-success"><?php echo $txn_status  ?></span></td>
                                                <td><span><?php echo date("D, d M Y h:i:sa" ,strtotime($txn_created_on) )  ?></span></td>                                           
                                        
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