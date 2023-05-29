<?php include("includes/header.php"); ?>
   
    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item">Clients</li>
                            <li class="breadcrumb-item active">List</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Client List</h1>
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
                                        <th>Agent Name</th>
                                        <?php
                                           if ($session_logged_company_privilege_id == 1){
                                        ?>
                                        <th>Business Name</th>
                                         <?php
                                            }
                                        ?>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Total Purchase</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query_all_clients = admin_query_business_clients($session_logged_admin_company_id, true);
                                        $count = 1;
                                        while($fetch_all_clients = mysqli_fetch_assoc($query_all_clients)){

                                            extract($fetch_all_clients);
                                        ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo "{$clients_title} {$clients_fullname}"; ?></td>
                                                <td><?php  echo $session_logged_company_privilege_id == 1 ? $agent_fullname : ($agent_fullname ? $agent_fullname : $company_name ); ?></td>
                                                <?php
                                                    if ($session_logged_company_privilege_id == 1){
                                                ?>
                                                <td><?php echo $company_name;  ?></td>
                                                <?php
                                                    }
                                                ?>
                                                <td><?php echo $clients_email; ?></td>
                                                <td><?php echo $clients_address; ?></td>
                                                <td><?php echo $clients_phone_number; ?></td>
                                                <td></td>
                                                <td><a href="client-details?client_id=<?php echo base64_encode($clients_id) ?>&business_id=<?php echo base64_encode($clients_business_id) ?>&agent_id=<?php echo base64_encode($clients_agent_id) ?>" class="btn btn-success text-white btn-sm">View more</a></td>
                                               
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