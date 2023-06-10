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
                                 <input  type="text" style="display: none;" id="copyInput" value='<?php echo get_url("register"). "?refid=" . $fetch_agent_info["agent_referral_id"] ?>'>

                                <p><?php echo get_url("register"). "?refid=" . $fetch_agent_info["agent_referral_id"] ?></p>
                                <button class="btn btn-default" id="copyData">Copy Link</button>
                            </div>

                        <?php
                            }
                        ?>
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
            <div class="row clearfix row-deck">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="header pb-1">
                            <h2><strong>Total</strong> Property</h2>                        
                        </div>
                        <div class="body py-2">
                            <h3 class="mb-0"><?php echo query_all_property()  ?></h3>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="header pb-1">
                            <h2><strong>Total</strong> Events</h2>
                        </div>
                        <div class="body py-3">
                            <h3 class="mb-0"><?php echo query_all_events(); ?></h3>
                        </div>
                      
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="header pb-1">
                            <h2><strong>Total</strong> Clients</h2>
                        </div>
                        <div class="body py-3">
                            <h3 class="mb-0"><?php echo query_clients($session_logged_in_agent_id, $session_logged_in_business_id) ?></h3>
                        </div>
                     
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="header pb-1">
                            <h2><strong>Total</strong> Sales</h2>                        
                        </div>
                        <div class="body py-3">
                            <h3 class="mb-0"><?php echo agent_sold_property($session_logged_in_agent_id, $session_logged_in_business_id) ?></h3>
                        </div>
                        
                    </div>
                </div>   

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="header pb-1">
                            <h2><strong>Total</strong> Events Invitee</h2>                        
                        </div>
                        <div class="body py-3">
                            <h3 class="mb-0">1,612</h3>
                        </div>
                        
                    </div>
                </div>   
                
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="header pb-1">
                            <h2><strong>Total</strong> Media</h2>                        
                        </div>
                        <div class="body py-3">
                            <h3 class="mb-0">1,612</h3>
                        </div>
                        
                    </div>
                </div>  

                 <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="header pb-1">
                            <h2><strong>Total</strong> Transactions</h2>                        
                        </div>
                        <div class="body py-3">
                            <h3 class="mb-0">1,612</h3>
                        </div>
                        
                    </div>
                </div>   

            </div>


            
           
            
<?php
    include("includes/footer.php");
?>