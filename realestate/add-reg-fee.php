<?php

    require("includes/header.php");
    superadmin_route();


    if (isset($_GET['reg_id'])  && !empty($_GET['reg_id']) ) {
            
        $reg_fee_id = base64_decode($_GET['reg_id']);

        $query_single_reg_fee = query_single_reg_fee($reg_fee_id);

        $fetch_single_reg_fee = mysqli_fetch_assoc($query_single_reg_fee);
    }


    if (isset($_POST['register'])) {
        
        $output = "";

        $agent_type = mysqli_real_escape_string($con, addslashes($_POST['agent_type']));
        $reg_price = mysqli_real_escape_string($con, addslashes($_POST['reg_price']));
        $reg_duration = mysqli_real_escape_string($con, addslashes($_POST['reg_duration']));

        $add_reg_fee = add_reg_fee($agent_type, $reg_price, $reg_duration);

        if ($add_reg_fee) {
            $output  =  "<div class='alert alert-success ml-3'>
                    <strong>Registration Fee Successfully Added.</strong>
                </div>";            
        }else{
            $output  =  "<div class='alert alert-danger ml-3'>
                    <strong>Something went wrong. Try again later</strong>
                </div>"; 
        }


    }



     if (isset($_POST['update'])) {
        
        $output = "";

        $agent_type = mysqli_real_escape_string($con, addslashes($_POST['agent_type']));
        $reg_price = mysqli_real_escape_string($con, addslashes($_POST['reg_price']));
        $reg_duration = mysqli_real_escape_string($con, addslashes($_POST['reg_duration']));

        $update_reg_fee = update_reg_fee($agent_type, $reg_price, $reg_duration, $reg_fee_id);

        if ($update_reg_fee) {
            $output  =  "<div class='alert alert-success ml-3'>
                    <strong>Registration Fee Updated Successfully.</strong>
                </div>";            

            header("refresh:2; url=add-reg-fee");
        }else{
            $output  =  "<div class='alert alert-danger ml-3'>
                    <strong>Something went wrong. Try again later</strong>
                </div>"; 
        }


    }
   
?>

    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Registration Fee</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Add Registration Fee</h1>
                    </div>            
                    <div class="col-lg-6 col-md-12 text-md-right">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            
            <div class="row clearfix">
                <div class="col-lg-5 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4>Set Registration Fee</h4>
                        </div>


                        <?php

                           
                             if ( isset($_POST['register']) || isset($_POST['update']) ) {
                                echo $output;
                            }

                        ?>
                        <form action="" method="POST">                     
                            <div class="body pt-1">
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <select class="form-control" name="agent_type">
                                                <option value="">Choose agent type</option>
                                                <option <?php echo @$fetch_single_reg_fee['reg_fee_privilege_id'] == 2 ? "selected": "" ?> value="2">Business</option>
                                                <option <?php echo @$fetch_single_reg_fee['reg_fee_privilege_id'] == 3 ? "selected": "" ?> value="3">Realtor</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="number" name="reg_price" value="<?php echo @$fetch_single_reg_fee['reg_fee_price'] ?>" class="form-control" placeholder="Price">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="number" name="reg_duration" value="<?php echo @$fetch_single_reg_fee['reg_fee_duration'] ?>" class="form-control" placeholder="Duration (In months)">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                     if (isset($_GET['reg_id'])  && !empty($_GET['reg_id']) ) {
                                ?>
                                    <button name="update" class="btn btn-primary">Update</button>

                                <?php
                                    }else{
                                ?>

                                <button name="register" class="btn btn-primary">Set Registration Fee</button>
                                <?php
                                    }
                                ?>
                                
                                
                            </div>
                        </form>

                    </div>
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="card p-3">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                <thead>
                                    <tr>
                                        <th># ID</th>
                                        <th>Agent Type</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                        $query_reg_fee = query_all_reg_fee(true);
                                        $count = 1;
                                        while($fetch_reg_fee = mysqli_fetch_assoc($query_reg_fee)){
                                        
                                        extract($fetch_reg_fee);
                                    ?>
                                         <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo ucwords($privileges_name) ?></td>
                                            <td>N<?php echo number_format($reg_fee_price) ?></td>
                                            <td><?php echo $reg_fee_duration." Months" ?></td>
                                            <td><?php echo date("D, d M Y", strtotime($reg_fee_created_at)) ?></td>
                                            <td>
                                                <a class="btn btn-danger" href="">Delete</a>
                                                <a class="btn btn-success text-white" href="add-reg-fee?reg_id=<?php echo base64_encode($reg_fee_id) ?>">Edit</a>
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


<?php
    
    include("includes/footer.php");

?>