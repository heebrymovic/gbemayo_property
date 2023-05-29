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
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Client Lists</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Client Lists</h1>
                    </div>            
                

                    <div class="col-lg-6 col-md-12 text-md-right mt-3">
                                <h6><b>Referral link</b></h6>
                                 <input  type="text" style="display: none;" id="copyInput" value='<?php echo get_url("/CD/gbemayo/clients/register"). "?refid=" . $fetch_agent_info["agent_referral_id"] ?>'>

                                <p><?php echo get_url("/CD/gbemayo/clients/register"). "?refid=" . $fetch_agent_info["agent_referral_id"] ?></p>
                                <button class="btn btn-default" id="copyData">Copy Link</button>
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
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query_all_clients = query_clients($session_logged_in_agent_id, $session_logged_in_business_id, NULL, true);
                                        $count = 1;
                                        while($fetch_all_clients = mysqli_fetch_assoc($query_all_clients)){

                                            extract($fetch_all_clients);
                                        ?>

                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td><?php echo ucwords($clients_title . " ". $clients_fullname) ;   ?></td>
                                                <td><?php echo $clients_phone_number;  ?></td>
                                                <td><?php echo $clients_email;  ?></td>
                                                <td>  
                                                    <a class="btn btn-success text-white btn-sm" href="client-details?client_id=<?php echo base64_encode($clients_id) ?>">View more</a>
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