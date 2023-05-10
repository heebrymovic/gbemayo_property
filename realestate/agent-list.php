<?php include("includes/header.php"); ?>
   
    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item">Agents</li>
                            <li class="breadcrumb-item active">List</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Agent List</h1>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Agent Type</th>
                                        <th>Total Agents</th>
                                        <th>Subscription Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query_all_agents = admin_query_business_agents($session_logged_admin_company_id , true);
                                        $count = 1;
                                        while($fetch_all_agent = mysqli_fetch_assoc($query_all_agents)){

                                            extract($fetch_all_agent);
                                        ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td>
                                                    <a href="">
                                                        <img src="../<?php echo $agent_profile_photo ?>" class="rounded-circle avatar" alt="">
                                                        <span><?php echo ucwords($agent_fullname); ?></span>
                                                    </a>
                                                </td>
                                                <td><?php echo $agent_email; ?></td>
                                                <td><p style="white-space:initial;"><?php echo $agent_address; ?></p></td>
                                                <td><?php echo ucwords($privileges_name); ?></td>
                                                <td><?php echo query_realtor_referral($agent_business_id, $agent_id); ?></td>
                                                <td><span class="badge <?php echo  $agent_payment_status == 'inactive' ? 'badge-danger' : 'badge-success'   ?> "><?php echo $agent_payment_status ?></span></td>
                                                <td>
                                                    <a href="agent-details?agent-id=<?php echo base64_encode($agent_id) ?>&business-id=<?php echo base64_encode($agent_business_id) ?>" class="btn btn-sm btn-primary">View More</a>
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