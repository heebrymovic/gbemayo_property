    <?php
    
    require("includes/header.php");

?>


    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <h1 class="mt-1">
                            <strong class="text text-secondary">You are logged in as <?php echo ucwords(get_privileges_name($session_logged_company_privilege_id)) ?></strong>
                        </h1>
                        <ul class="breadcrumb pl-0 pb-0 ">
                          <!--   <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                            <li class="breadcrumb-item active"> Dashboard</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Good <?php echo $currentTime .", " . ucwords($admin_username) ?></h1>
                        <span>Welcome back to your dashboard.</span>
                    </div>            

                    <?php

                        if ($session_logged_company_privilege_id != 1 ) {
                    ?>
                              <div class="col-lg-6 col-md-12 text-md-right mt-3">
                                <h6><b>Referral link</b></h6>
                                 <input  type="text" style="display: none;" id="copyInput" value='<?php echo get_url("register"). "?refid=" . $fetch_company_info["company_referral_id"] ?>'>

                                <p><?php echo get_url("register"). "?refid=" . $fetch_company_info["company_referral_id"] ?></p>
                                <button class="btn btn-default" id="copyData">Copy Link</button>
                            </div>

                        <?php
                            }
                        ?>


                  
                </div>
                <div class="bh_divider"></div>
                
            </div>
        </div>


        <div class="container">

            <div class="row clearfix row-deck">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body py-4">
                            <span class="text-uppercase">ALL PROPERTIES</span>
                            <h4 class="mb-0 mt-2"><?php echo query_all_property() ?> <i class="zmdi zmdi-trending-up font-12"></i></h4>
                        </div>
                    </div>
                </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body py-4">
                            <span class="text-uppercase">AVAILABLE PROPERTIES</span>
                            <h4 class="mb-0 mt-2"><?php echo query_available_property() ?></h4>
                        </div>
                       
                    </div>
                </div>

                <?php

                    if ($session_logged_company_privilege_id == 1 ) {
                ?>
                 <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body py-4">
                            <span class="text-uppercase">TOTAL SOLD PROPERTIES</span>
                            <h4 class="mb-0 mt-2"><?php echo query_all_property() - query_available_property() ?></h4>
                        </div>
                       
                    </div>
                </div>

                <?php
                  }
                ?>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body py-4">
                            <span class="text-uppercase">MY SOLD PROPERTIES</span>
                            <h4 class="mb-0 mt-2"><?php echo business_sold_property($session_logged_admin_company_id) ?></h4>
                        </div>
                       
                    </div>
                </div>

                 <?php

                    if ($session_logged_company_privilege_id == 1 ) {
                ?>
                 <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body py-4">
                            <span class="text-uppercase">TOTAL AGENTS</span>
                            <h4 class="mb-0 mt-2"><?php echo query_all_agents() ?></h4>
                        </div>
        
                    </div>
                </div>
                <?php
                  }
                ?>
                 <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body py-4">
                            <span class="text-uppercase">MY AGENTS</span>
                            <h4 class="mb-0 mt-2"><?php echo query_total_business_agents($session_logged_admin_company_id) ?></h4>
                        </div>
        
                    </div>
                </div>
               
                <?php

                    if ($session_logged_company_privilege_id == 1 ) {
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body py-4">
                            <span class="text-uppercase">TOTAL CLIENTS</span>
                            <h4 class="mb-0 mt-2"><?php echo query_total_clients() ?></h4>
                        </div>
        
                    </div>
                </div>
                <?php
                  }
                ?>


                 <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body py-4">
                            <span class="text-uppercase">MY CLIENTS</span>
                            <h4 class="mb-0 mt-2"><?php echo admin_query_business_clients($session_logged_admin_company_id) ?></h4>
                        </div>
        
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body py-4">
                            <span class="text-uppercase">TOTAL MEDIA</span>
                            <h4 class="mb-0 mt-2"><?php echo query_all_media() ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body py-4">
                            <span class="text-uppercase">TOTAL EVENTS</span>
                            <h4 class="mb-0 mt-2"><?php echo query_all_events() ?></h4>
                        </div>
        
                    </div>
                </div>
               
            </div>

        
<?php
    require("includes/footer.php");
?>