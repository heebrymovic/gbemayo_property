<?php 
include("includes/header.php");

    if ( isset($_GET['purchase-id']) && !empty($_GET['purchase-id']) ) {
        
        $purchase_id = base64_decode($_GET['purchase-id']);

        $query_all_clients = agent_buyers_property_purchase_by_id($purchase_id,  true);

        $fetch_all_clients = mysqli_fetch_assoc($query_all_clients);

        $total_approved_payment = get_client_total_months($fetch_all_clients['property_id'], $fetch_all_clients['property_buy_id'], $session_logged_in_client_id);

    }else{
        header("location:404");
    }

    if (isset($_POST['upload'])) {

        $payment_amount = mysqli_real_escape_string($con, $_POST['payment_amount']);
        $filename = $_FILES['payment_proof']['name'];
        $tmpname = $_FILES['payment_proof']['tmp_name'];
        $foldername = 'proof/';
        $uploadpath = $foldername .uniqid(). $filename;


        if( move_uploaded_file($tmpname, $uploadpath) ){  
            

             $register_property_purchase =  register_property_buy_payment($purchase_id, $fetch_all_clients['property_id'], $session_logged_in_client_id, $payment_amount, $uploadpath );

             if($register_property_purchase){
                $output = "<div class='alert alert-success my-2'>
                    Payment Proof Successfully Uploaded. Kindly wait while admin comfirm your transactions and get back to you    
                </div>";
                header("refresh:3");
             }else{
                 $output = "<div class='alert alert-danger my-2'>
                    Payment proof failed to upload. Try again later
                </div>";

             }

        }else{
            deleteFiles($path);

            $output = "<div class='alert alert-danger my-2'>
                Failed to upload documents. Kindly Try Again
            </div>";
        }

    }

?>




    <!-- Main Content -->
    <div class="body_area profile-page">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="purchase-list">Purchase List</a></li>
                            <li class="breadcrumb-item active">Purchase Details</li>
                        </ul>
                         <h1 class="mb-1 mt-1">Purchase Details</h1>
                    </div>                      


                </div>
         
            </div>
        </div>

        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                  
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="overview">
                           
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2><strong>Info</strong></h2>
                                        </div>
                                        <div class="body pt-1">
                                            <div>
                                               <img src="../clients/<?php echo $fetch_all_clients['clients_photo'] ?>" alt="Clients Image" style="border:0; width: 100%; max-height: 250px; object-fit: cover;">
                                            </div>
                                            <hr>
                                            <small class="text-muted">Property Name: </small>
                                            <p><?php echo $fetch_all_clients['property_name'] ?></p>
                                            <hr>
                                            <small class="text-muted">Asking Price: </small>
                                            <p>N<?php echo number_format($fetch_all_clients['property_price']); ?></p>
                                            <hr>
                                            <small class="text-muted">Agent Payment Structure:</small>
                                            <p><?php echo $fetch_all_clients['property_buy_payment_structure'] ? "N".number_format($fetch_all_clients['installmental_property_amount'])." For " . $fetch_all_clients['installmental_property_duration']: "Full Payment" ?></p>
                                            <hr>
                                            <small class="text-muted">Total Approved Payment: </small>
                                            <p>N<?php echo number_format($total_approved_payment); ?></p>
                                            <hr>

                                             <small class="text-muted">Total Pending Payment: </small>
                                            <p>N<?php echo number_format($total_approved_payment); ?></p>
                                            <hr>
                                           
                                                                               
                                             
                                        </div>
                                    </div>
                                </div>

                                
                             
                                <div class="col-lg-8 col-md-12">
                                   
                                   <?php
                                    if ( ($fetch_all_clients['property_buy_payment_structure'] &&  $total_approved_payment != $fetch_all_clients['installmental_property_amount'])  ) {
                                    
                                   ?>
                                     <div class="card p-3">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <h5>Upload Payment Proof</h5>
                                        </div>
                                        <?php
                                            if (isset($_POST['upload'])) {
                                                echo $output;
                                            }
                                        ?>
                                                                        
                                         <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="col-lg-8 col-md-12">
                                                    <b>Amount Paid</b>
                                                    <div class="mb-3">
                                                        <input type="number" class="form-control" required name="payment_amount">
                                                    </div>
                                            </div> 


                                             <div class="col-lg-8 col-md-12">
                                                    <b>Payment Proof</b>
                                                    <div class="mb-3">
                                                        <input type="file" class="form-control" required name="payment_proof">
                                                    </div>
                                            </div> 
                                            <div class="col-lg-12">
                                                <button name="upload" class="btn btn-info text-white">Upload</button>    
                                            </div>
                                            
                                        </form>

                                     </div>

                                    <?php
                                        }
                                    ?>



                                     <div class="card p-3" >
                                            <h5>Purchased Property Payment</h5>
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-hover mb-0 js-basic-example dataTable" id="datatables">
                                                    <thead>
                                                        <tr>
                                                            <th># ID</th>
                                                            <th>Paid Amount Price</th>
                                                            <th>Payment Proof</th>
                                                            <th>Payment Status</th>
                                                            <th>Payment Date</th>
                                                             

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                            $query_payments = query_property_payments($fetch_all_clients['clients_id'], $purchase_id, true);
                                                            $count =  1;
                                                            while($fetch_payments = mysqli_fetch_assoc($query_payments)){
                                                                extract($fetch_payments);
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $count++ ?></td>
                                                                    <td>N<?php echo number_format($property_buy_amount_paid) ?></td>
                                                                    <td><img onclick="openFullscreen(this)" style="width: 300px;" src="../clients/<?php echo $property_buy_payment_proof ?>"></td>
                                                                    <td>
                                                                        <span class="badge <?php echo $property_payment_status == 'pending' ? 'badge-warning text-white': ($property_payment_status == 'approved' ? 'badge-success' : 'badge-danger') ?>"><?php echo $property_payment_status ?></span>
                                                                    </td>
                                                                    <td><?php echo date( "D, d M Y" , strtotime($property_buy_payment_created_on)) ?></td>

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
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>

  

</div>

<!-- Jquery Core Js --> 
<script src="../assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="../assets/bundles/c3.bundle.js"></script>

<script src="../assets/bundles/mainscripts.bundle.js"></script>
<script src="../assets/bundles/index.js"></script>
<script src="../assets/bundles/datatablescripts.bundle.js"></script>

<script>
    
     if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }


    function openFullscreen(elem) {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
      }
    }

    $(document).ready(function() {
            $('#datatables').DataTable({});

    });
</script>

</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:58 GMT -->
</html>