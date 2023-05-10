<?php 
 include("includes/header.php");

 if (isset($_GET['property_id']) && !empty($_GET['property_id']) && $session_logged_company_privilege_id == 1) {
       
       $property_id = base64_decode($_GET['property_id']);

    }else{
         header("location:../404");
    }

?>
    

   
    <!-- Main Content -->
    <div class="body_area after_bg sm">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="property-list">Property List</a></li>
                            <li class="breadcrumb-item active">Business Commission</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Business Commission List</h1>
                    </div>            
                   
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-5">
                        
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">ID</th>
                                        <th class="border-top-0">Business Name</th>
                                        <th class="border-top-0">Realtors Commission</th>
                                        <th class="border-top-0">Marketers Commission</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $query_all_commission =  admin_query_commissions($property_id, true);

                                        $count = 1;

                                        while($fetch_commission = mysqli_fetch_assoc($query_all_commission)){
                                            
                                            extract($fetch_commission);

                                        ?>

                                             <tr>
                                                <td><?php echo $count++  ?></td>
                                                <td><?php echo $company_name  ?></td>
                                                <td><?php echo $commission_realtors  ?>%</td>
                                                <td><?php echo $commission_marketers  ?>%</td>                                 
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
    require("includes/footer.php");
?>