<?php include("includes/header.php"); ?>

    <!-- Main Content -->
    <div class="body_area after_bg sm">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                       
                        <h1 class="mt-1">
                            <strong class="text text-secondary">You are logged in as <?php echo ucwords(get_privileges_name($session_logged_in_privilege_id)) ?></strong>
                        </h1>
                        
                        <ul class="breadcrumb pl-0 pb-0 mt-4">
                            <li class="breadcrumb-item active"><a href="dashboard">Home</a></li>
                        </ul>
                        <h1 class="mb-1 mt-1">Good <?php echo $currentTime .", " . ucwords(explode(" ",$fetch_agent_info['agent_fullname'])[0]) ?></h1>
                        <span>Welcome back to your dashboard</span>
                    </div>            
                    
                        <?php

                                if ($session_logged_in_privilege_id == 3) {
                        ?>
                            <div class="col-lg-6 col-md-12 text-md-right mt-3">
                                <h6><b>Referral link</b></h6>
                                 <input  type="text" style="display: none;" id="copyInput" value='<?php echo get_url("/CD/gbemayo/register"). "?refid=" . $fetch_agent_info["agent_referral_id"] ?>'>

                                <p><?php echo get_url("/CD/gbemayo/register"). "?refid=" . $fetch_agent_info["agent_referral_id"] ?></p>
                                <button class="btn btn-default" id="copyData">Copy Link</button>
                            </div>

                        <?php
                            }
                        ?>
                </div>

                <?php
                     if ($session_logged_in_privilege_id == 3 && $fetch_agent_info["agent_payment_status"] == "inactive") {
                        include("realtor-subscribe-msg.php");
                    }else if ($session_logged_in_privilege_id == 4 && $fetch_agent_info["agent_payment_status"] == "inactive"){
                        include("marketers-subscribe-msg.php");
                    }
                ?>
            </div>
        </div>

        <div class="container">
            <div class="row clearfix row-deck">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Orders</strong> Received</h2>                        
                        </div>
                        <div class="body">
                            <h3 class="mb-0">47,012</h3>
                            <small class="displayblock">23% Average <i class="zmdi zmdi-trending-up"></i></small>                    
                        </div>
                        <!-- <div class="sparkline" data-type="line" data-spot-Radius="1" data-max-Spot-Color="#fff133" data-offset="90" data-width="100%" data-height="40px"
                        data-line-Width="1" data-line-Color="#fff133" data-fill-Color="#fff133">4,2,7,3,3,4,3,6,4,4,1,5,2,3,9,4,3</div> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Total</strong> Sales</h2>
                        </div>
                        <div class="body">
                            <h3 class="mb-0">512</h3>
                            <small class="displayblock">18% Average <i class="zmdi zmdi-trending-down"></i></small>
                        </div>
                       <!--  <div class="sparkline" data-type="line" data-spot-Radius="1" data-max-Spot-Color="#60bafd" data-offset="90" data-width="100%" data-height="40px"
                        data-line-Width="1" data-line-Color="#60bafd" data-fill-Color="#60bafd">4,2,7,3,3,1,5,2,3,9,4,3,6,4,4,4,3</div> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Total</strong> Sales</h2>
                        </div>
                        <div class="body">
                            <h3 class="mb-0">512</h3>
                            <small class="displayblock">18% Average <i class="zmdi zmdi-trending-down"></i></small>
                        </div>
                       <!--  <div class="sparkline" data-type="line" data-spot-Radius="1" data-max-Spot-Color="#bce63a" data-offset="90" data-width="100%" data-height="40px"
                        data-line-Width="1" data-line-Color="#bce63a" data-fill-Color="#bce63a">4,2,7,3,3,1,5,2,3,9,4,3,6,4,4,4,3</div> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Revenue</strong></h2>                        
                        </div>
                        <div class="body">
                            <h3 class="mb-0">1,612</h3>
                            <small class="displayblock">13% Average <i class="zmdi zmdi-trending-up"></i></small>                        
                        </div>
                        <!-- <div class="sparkline" data-type="line" data-spot-Radius="1" data-max-Spot-Color="#b875d6" data-offset="90" data-width="100%" data-height="40px"
                        data-line-Width="1" data-line-Color="#b875d6" data-fill-Color="#b875d6">4,2,9,4,3,6,4,4,7,3,3,1,5,2,3,4,3</div> -->
                    </div>
                </div>           
            </div>
            
           
            
<?php
    include("includes/footer.php");
?>