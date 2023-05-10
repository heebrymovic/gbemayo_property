<?php include("includes/header.php"); ?>


    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Admin List</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Admin List</h1>
                    </div>            
                    <div class="col-lg-6 col-md-12 text-md-right">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card p-3">
                        
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Username</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query_all_admin = query_all_admin($session_logged_admin_company_id, true);

                                        $count = 1;

                                        while($fetch_admin_details = mysqli_fetch_assoc($query_all_admin)){
                                                extract($fetch_admin_details);
                                        ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo ucwords($admin_username) ?></td>
                                               <td><?php echo date("D, d M Y h:i:sa" , strtotime($admin_created_at)); ?></td>
                                                <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this data?')" href="">Delete</a></td>
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