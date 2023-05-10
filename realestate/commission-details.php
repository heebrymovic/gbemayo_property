<?php
    
    require("includes/header.php");

    if (isset($_GET['property_id']) && !empty($_GET['property_id'])) {
       
       $property_id = base64_decode($_GET['property_id']);

    }else{
         header("location:../404");
    }


   

    if (isset($_POST['update'])) {

        $output = "";
        $commission_business = @$_POST['commission_business'] ? mysqli_real_escape_string($con, $_POST['commission_business']) : 0 ;
        $commission_realtors  = mysqli_real_escape_string($con, $_POST['commission_realtors']);
        $commission_marketers  = mysqli_real_escape_string($con, $_POST['commission_marketers']);
        $commission_id  = mysqli_real_escape_string($con, $_POST['commission_id']);


        $update_commmission = update_commission($commission_id, $commission_business, $commission_realtors, $commission_marketers);

            if ($update_commmission) {
                $output  =  "<div class='alert alert-success ml-3'>
                    <strong>Commission Successfully Updated.</strong>
                </div>";
            }else{
                $output  =  "<div class='alert alert-danger ml-3'>
                    <strong>Something went wrong. Try again later</strong>
                </div>";
            }

    }


    if (isset($_POST['set_commission'])) {

        $output = "";
        $commission_realtors  = mysqli_real_escape_string($con, $_POST['commission_realtors']);
        $commission_marketers  = mysqli_real_escape_string($con, $_POST['commission_marketers']);
    


        $add_commmission = add_commissions($property_id, $session_logged_admin_company_id, 0, $commission_realtors, $commission_marketers);

            if ($add_commmission) {
                $output  =  "<div class='alert alert-success ml-3'>
                    <strong>Commission Successfully Added.</strong>
                </div>";
            }else{
                $output  =  "<div class='alert alert-danger ml-3'>
                    <strong>Something went wrong. Try again later</strong>
                </div>";
            }

    }


    $commission_exist = query_single_commission($property_id, $session_logged_admin_company_id);

     if ($session_logged_company_privilege_id == 1 || $commission_exist > 0 ) {
        
        $query_commision = query_single_commission($property_id, $session_logged_admin_company_id, true);

    }  else if ( $commission_exist == 0 ) {
        
            $query_commision = query_single_commission($property_id, 1, true);
    }


    $fetch_commission = mysqli_fetch_assoc($query_commision);  


   
?>

    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="property-list">Property List</a></li>
                            <li class="breadcrumb-item active">Commision</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Set Commission</h1>
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
                            <h4>Set Property Commission</h4>
                        </div>


                        <?php

                           
                             if (isset($_POST['update']) || isset($_POST['set_commission']) ) {
                                echo $output;
                            }

                        ?>
                        <form action="" method="POST">                     
                            <div class="body pt-1">
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $fetch_commission['property_name'] ?>" readonly class="form-control" placeholder="Property Name">
                                        </div>
                                    </div>

                                    <?php

                                         if ($session_logged_company_privilege_id == 1) {

                                    ?>


                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="number" name="commission_business" value="<?php echo $fetch_commission['commission_business'] ?>" class="form-control" placeholder="Business Commission">
                                            </div>
                                        </div>

                                    <?php
                                        }
                                    ?>

                                    <input type="hidden" name="commission_id" value="<?php echo $fetch_commission['commission_id'] ?>" class="form-control">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="number" name="commission_realtors" value="<?php echo $fetch_commission['commission_realtors'] ?>" class="form-control" placeholder="Realtors Commission">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="number" name="commission_marketers" value="<?php echo $fetch_commission['commission_marketers'] ?>" class="form-control" placeholder="Marketers Commission">
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    if ( $commission_exist > 0 ){

                                ?>
                                <button name="update" class="btn btn-primary">Update Commision</button>

                                <?php
                                    }else if ($session_logged_company_privilege_id == 2 && $commission_exist == 0 ) {
                                ?>
                                    <button name="set_commission" class="btn btn-primary">Set Commission</button>
                                <?php
                                    }
                                ?>

                                
                            </div>
                        </form>

                    </div>
                </div>
            
            </div>


<?php
    
    include("includes/footer.php");

?>