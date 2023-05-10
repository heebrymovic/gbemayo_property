<?php 
include("includes/header.php");

    if ( isset($_GET['purchase-id']) && !empty($_GET['purchase-id']) ) {
        
        $purchase_id = base64_decode($_GET['purchase-id']);

        $query_all_clients = agent_buyers_property_purchase_by_id($purchase_id,  true);

        $fetch_all_clients = mysqli_fetch_assoc($query_all_clients);

    }else{
        header("location:404");
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
                                <div class="col-lg-5 col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2><strong>Info</strong></h2>
                                        </div>
                                        <div class="body pt-1">
                                            <small class="text-muted">FullName: </small>
                                            <p><?php echo ucwords($fetch_all_clients['buyers_title'] . ". " .$fetch_all_clients['buyers_fullname']) ?></p>
                                            <hr>
                                            <small class="text-muted">Email address: </small>
                                            <p><?php echo $fetch_all_clients['buyers_email'] ?></p>
                                            <hr>
                                             <small class="text-muted">Phone Number: </small>
                                            <p><?php echo ucwords($fetch_all_clients['buyers_phone_number']) ?></p>
                                            <hr>
                                            <small class="text-muted">Address: </small>
                                            <p><?php echo $fetch_all_clients['buyers_address'] ?></p>
                                            <div>
                                               <img src="../<?php echo $fetch_all_clients['buyers_passport'] ?>" alt="Agent Image" style="border:0; width: 100%; max-height: 250px; object-fit: cover;">
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
                                            <small class="text-muted">Client Payment Price:</small>
                                            <p>N<?php echo number_format($fetch_all_clients['property_buy_amount_paid']) ?></p>
                                            <hr>
                                             <small class="text-muted">Payment Status:</small>
                                             <p>
                                                <span class="badge <?php echo $fetch_all_clients['property_buy_status'] == 'pending' ? 'badge-warning text-white': ($fetch_all_clients['property_buy_status'] == 'approved' ? 'badge-success' : 'badge-danger') ?>"><?php echo $fetch_all_clients['property_buy_status'] ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    if ($session_logged_company_privilege_id == 1) {
                                ?>

                                    <div class="col-lg-7 col-md-12">
                                        <div class="card">
                                            <div class="body">
                                                <h5>Payment Proof</h5>
                                                <img src="../<?php echo $fetch_all_clients['property_buy_payment_proof']; ?>" onclick=" openFullscreen(this)" style="width: 100%;max-height: 400px; object-fit:cover; cursor: zoom-in;">
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="body">
                                                <h5>Valid ID</h5>
                                                <img src="../<?php echo $fetch_all_clients['buyers_valid_id']; ?>" onclick=" openFullscreen(this)" style="width: 100%;max-height: 400px; object-fit:cover; cursor: zoom-in;">
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }

                                ?>
                                
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