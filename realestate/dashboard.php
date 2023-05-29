    <?php
    
    require("includes/header.php");

?>


    <div class="body_area after_bg">

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
                                 <input  type="text" style="display: none;" id="copyInput" value='<?php echo get_url("/CD/gbemayo/register"). "?refid=" . $fetch_company_info["company_referral_id"] ?>'>

                                <p><?php echo get_url("/CD/gbemayo/register"). "?refid=" . $fetch_company_info["company_referral_id"] ?></p>
                                <button class="btn btn-default" id="copyData">Copy Link</button>
                            </div>

                        <?php
                            }
                        ?>


                  
                </div>
                <div class="bh_divider"></div>
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12">
                        <p>New User</p>
                        <ul class="list-unstyled team-info sm">
                            <li><img src="../assets/images/xs/avatar1.jpg" alt="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar"></li>
                            <li><img src="../assets/images/xs/avatar7.jpg" alt="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar"></li>
                            <li><img src="../assets/images/xs/avatar2.jpg" alt="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar"></li>
                            <li><img src="../assets/images/xs/avatar5.jpg" alt="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar"></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-12 text-md-right">
                        <div class="inlineblock hidden-sm">
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="40px" data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#ffffff">6,2,6,5,9,3,7,9,5,1,3,5,7,4,6</div>
                            <small>Page Views</small>
                        </div>
                        <div class="inlineblock ml-4 hidden-sm">
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="40px" data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#ffffff">8,3,5,7,4,6,3,2,6,5,9,8,7,9,5</div>
                            <small>Visitors</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">

            <div class="row clearfix row-deck">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">ALL PROPERTIES</span>
                            <h4 class="mb-0 mt-2">22,500 <i class="zmdi zmdi-trending-up font-12"></i></h4>
                            <small class="text-muted">Analytics for last week</small>
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#39afa6" data-fill-Color="#73cec7">4,1,5,2,7,3,4</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">PROPERTIES FOR SALE</span>
                            <h4 class="mb-0 mt-2">1,12,500</h4>
                            <small class="text-muted">Analytics for last week</small>
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#ffa901" data-fill-Color="#efc26b">1,4,2,3,6,2</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">PROPERTIES FOR RENT</span>
                            <h4 class="mb-0 mt-2">1,070</h4>
                            <small class="text-muted">Analytics for last week</small>
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#38c172" data-fill-Color="#84d4a6">1,4,2,3,1,5</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">TOTAL EARNINGS</span>
                            <h4 class="mb-0 mt-2">10K</h4>
                            <small class="text-muted">Analytics for last week</small>
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#226fd8" data-fill-Color="#7ea7de">1,3,5,1,4,2</div>
                    </div>
                </div>
            </div>

            <div class="row clearfix row-deck">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12">
                            <div class="card top_widget">
                                <div id="top_counter3" class="carousel slide" data-ride="carousel" data-interval="2300">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="body">
                                                <div class="icon"><i class="zmdi zmdi-eye"></i></div>
                                                <div class="content">
                                                    <div class="text mb-2 text-uppercase">Expense</div>
                                                    <h4 class="number mb-0">32k <span class="font-12 text-muted"><i class="zmdi zmdi-trending-up"></i> 13%</span></h4>
                                                    <small class="text-muted">Analytics for last week</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="body">
                                                <div class="icon"><i class="zmdi zmdi-eye"></i></div>
                                                <div class="content">
                                                    <div class="text mb-2 text-uppercase">Income</div>
                                                    <h4 class="number mb-0">351k <span class="font-12 text-muted"><i class="zmdi zmdi-trending-up"></i> 8.2%</span></h4>
                                                    <small class="text-muted">Analytics for last week</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card top_widget">
                                <div id="top_counter1" class="carousel slide" data-ride="carousel" data-interval="2500">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="body">
                                                <div class="icon"><i class="zmdi zmdi-account-box"></i></div>
                                                <div class="content">
                                                    <div class="text mb-2 text-uppercase">Total Agent</div>
                                                    <h4 class="number mb-0">3,251 <span class="font-12 text-muted"><i class="zmdi zmdi-trending-up"></i> 13%</span></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="body">
                                                <div class="icon"><i class="zmdi zmdi-account-circle"></i></div>
                                                <div class="content">
                                                    <div class="text mb-2 text-uppercase">CORPORATE AGENTS</div>
                                                    <h4 class="number mb-0">351 <span class="font-12 text-muted"><i class="zmdi zmdi-trending-up"></i> 8.2%</span></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card top_widget">
                                <div id="top_counter4" class="carousel slide" data-ride="carousel" data-interval="2300">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="body">
                                                <div class="icon"><i class="zmdi zmdi-thumb-up"></i></div>
                                                <div class="content">
                                                    <div class="text mb-2 text-uppercase">Our Center</div>
                                                    <h4 class="number mb-0">780</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="body">
                                                <div class="icon"><i class="zmdi zmdi-mood"></i></div>
                                                <div class="content">
                                                    <div class="text mb-2 text-uppercase">Smiley Faces</div>
                                                    <h4 class="number mb-0">2,351</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Properties Analytics</h2>
                        </div>
                        <div class="body">
                            <div id="Properties-Analytics"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Properties Stats</h2>
                        </div>
                        <div class="body">
                            <div id="chart-bar-rotated"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix row-deck">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Gender Ratio</h2>
                        </div>
                        <div class="body">
                            <div id="Gender-Ratio"></div>
                        </div>
                    </div>  
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Social Counter</h2>
                        </div>
                        <div class="body social_counter">                        
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    FaceBook
                                    <span class="badge badge-primary badge-pill">40k</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Twitter
                                    <span class="badge badge-primary badge-pill">23k</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Linkedin
                                    <span class="badge badge-primary badge-pill">71k</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Behance
                                    <span class="badge badge-primary badge-pill">42k</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Dribbble
                                    <span class="badge badge-primary badge-pill">15k</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Ongoing Project</h2>
                        </div>
                        <div class="body">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>Lead</th>
                                      <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Rivera Height's</h6>
                                            <span class="font-12 text-muted">Due Date: 25 Jan 2023</span>
                                        </td>
                                        <td>
                                            <a href="agent-profile">
                                                <img src="../assets/images/xs/avatar1.jpg" class="rounded-circle avatar" alt="">
                                                <span>Alexander</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" style="width:66%; " aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Happy Homes</h6>
                                            <span class="font-12 text-muted">Due Date: 18 June 2021</span>
                                        </td>
                                        <td>
                                            <a href="agent-profile.html">
                                                <img src="../assets/images/xs/avatar2.jpg" class="rounded-circle avatar" alt="">
                                                <span>Isabella</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:89%; " aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Sivalik Park 2</h6>
                                            <span class="font-12 text-muted">Due Date: 22 Nov 2024</span>
                                        </td>
                                        <td>
                                            <a href="agent-profile.html">
                                                <img src="../assets/images/xs/avatar3.jpg" class="rounded-circle avatar" alt="">
                                                <span>Chris</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" style="width:29%; " aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Rivera Height's</h6>
                                            <span class="font-12 text-muted">Due Date: 25 Jan 2023</span>
                                        </td>
                                        <td>
                                            <a href="agent-profile.html">
                                                <img src="../assets/images/xs/avatar1.jpg" class="rounded-circle avatar" alt="">
                                                <span>Alexander</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" style="width:66%; " aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

<?php
    require("includes/footer.php");
?>