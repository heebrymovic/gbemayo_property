<?php
    include("includes/header.php");
   
    if ( isset($_GET['property_id']) && !empty($_GET['property_id'])  ) {
        
        $property_id = $_GET['property_id'];

    
        if (query_single_property($property_id, 'property_uniq_id') > 0 )  {
           
           $query_property = query_single_property($property_id, 'property_uniq_id', true);

           $fetch_property_info = mysqli_fetch_assoc($query_property);

           $query_referral_info = query_client_referral($session_logged_in_business_id, $session_logged_in_agent_id, true);

           $fetch_referral_info = mysqli_fetch_assoc($query_referral_info);

        }else{
            header("location:../404");
        }
    }else{
         header("location:../404");
    }


     if (isset($_POST['subscribe'])) {

    
         $property_unit = mysqli_real_escape_string($con, $_POST['property_unit']);
         $payment_structure = mysqli_real_escape_string($con, $_POST['payment_structure']);
         $payment_amount = mysqli_real_escape_string($con, $_POST['payment_amount']);

        $filename = $_FILES['payment_proof']['name'];
        $tmpname = $_FILES['payment_proof']['tmp_name'];
        $foldername = 'proof/';
        $uploadpath = $foldername .uniqid(). $filename;



        if( move_uploaded_file($tmpname, $uploadpath) ){  
            

             $register_property_purchase = register_property_purchase($session_logged_in_agent_id, $session_logged_in_client_id, $fetch_property_info['property_id'], $session_logged_in_business_id, $property_unit,  $payment_structure, $payment_amount,  $uploadpath );

             if($register_property_purchase){
                $output = "<div class='alert alert-success my-2'>
                    Subscription information successfully summitted. Kindly wait while admin comfirm your transactions and get back to you    
                </div>";
             }else{
                 $output = "<div class='alert alert-danger my-2'>
                    Subscription information failed to submit. Try again later
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


<!-- Bootstrap Select Css -->
<link rel="stylesheet" href="../assets/plugins/bootstrap-select/css/bootstrap-select.css" />

<style>

    .block-header{ overflow:hidden; position: relative; z-index: 1;}
    .block-header::after{ content:""; position:absolute; left:0; top:0; width:100%; height:100%; background:rgba(0, 0, 0, 0.4); z-index: -1;}
    
</style>
    <!-- Main Content -->
    <div class="body_area" >

        <div class="block-header" style="postion:relative; background: url(../assets/images/realestate/co1.jpg) no-repeat fixed center/ cover; min-height:250px!important; display: grid; place-items: center;">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 text-center">
                        
                        <h1 class="mb-3 mt-1"><?php echo $fetch_property_info['property_name'] ?>   (<?php echo $fetch_property_info['property_location'] ?>)</h1>
                        
                    </div>          
                    
                </div>
            </div>
        </div>

        <div class="container">

            <?php
                if ($fetch_property_info['property_status'] == 'sold' ) {
            ?>
                <div class="alert alert-danger">
                    <h3>This property has been sold out already</h3>    
                </div>
            <?php
                }else{
            ?>
            
                <!-- Masked Input -->
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header pb-2">
                                <div class="alert alert-secondary">You were invited by <?php echo $fetch_referral_info['fullname'] ?></div>
                                <h2><strong>Please Enter Your Subscription</strong> Details</h2>

                                <?php
                                if (isset($_POST['subscribe'])) {
                                    echo $output;
                                }
                            ?>
                               
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="body pt-1">
                                    <div class="demo-masked-input">
                                        <div class="row clearfix">
                                

                                              <div class="col-lg-12 col-md-12">
                                                <h6 class="mt-2">
                                                    SUBSCRIPTION DETAILS
                                                </h6>                                            
                                            </div>

                                             <div class="col-lg-12 col-md-12">
                                                    <b>Number of unit</b>
                                                    <div class="mb-3">
                                                        <input type="number" class="form-control" value="1" required name="property_unit">
                                                    </div>
                                            </div> 

                                             <div class="col-lg-12 col-md-12">
                                                    <b>Asking Price</b>
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" readonly value="N<?php echo number_format($fetch_property_info['property_price']) ?>">
                                                    </div>
                                            </div> 

                                             <div class="col-lg-12 col-md-12 mb-3">
                                                    <b>Payment Structure (Optional)</b>
                                                   <select class="form-control show-tick" name="payment_structure">
                                                        <option value="">Payment Structure</option>
                                                        <?php
                                                            $query_installmental = query_installmental($fetch_property_info['property_id']);
                                                            while($fetch_installmental = mysqli_fetch_assoc($query_installmental) ){

                                                                extract($fetch_installmental);
                                                            
                                                        ?>
                                                            <option value="<?php echo $installmental_id; ?>">N<?php echo number_format($installmental_property_amount)?> for <?php echo $installmental_property_duration ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                            </div> 

                                             <div class="col-lg-12 col-md-12">
                                                    <b>Amount Paid</b>
                                                    <div class="mb-3">
                                                        <input type="number" class="form-control" required name="payment_amount">
                                                    </div>
                                            </div> 


                                             <div class="col-lg-12 col-md-12">
                                                    <b>Payment Proof</b>
                                                    <div class="mb-3">
                                                        <input type="file" class="form-control" required name="payment_proof">
                                                    </div>
                                            </div> 
                                            <?php
                                                if ($fetch_client_info['client_profile_update_count'] > 0 && query_client_next_of_kin($session_logged_in_client_id) > 0 )  {
                                                ?>
                                                 <div class="col-lg-12">
                                                    <button class="btn btn-success text-white btn-block" name="subscribe">Subscribe Now</button>
                                                </div>

                                            <?php
                                                }else{

                                            ?>
                                            <div class="col-lg-12 mt-3">
                                                <h5 class="text text-danger">Kindly update your profile and next of kin information</h5>
                                            </div>
                                            <?php
                                                }
                                            ?>
                                           
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">

                        <div class="card">
                            <div class="body">
                                <div id="propertyImgSlider" class="carousel slide" data-ride="carousel">
                                    <ul class="carousel-indicators">
                                        <?php
                                           $images = json_decode($fetch_property_info['property_file']);

                                            foreach( $images as $ind => $value){
                                        ?>
                                                <li data-target="#demo2" data-slide-to="<?php echo $ind ?>" class="<?php echo $ind == 0 ? 'active' : '' ?>"></li>
                                        <?php
                                            }

                                        ?>
                                        <!-- <li data-target="#demo2" data-slide-to="0" class="active"></li>
                                        <li data-target="#demo2" data-slide-to="1" class=""></li>
                                        <li data-target="#demo2" data-slide-to="2" class=""></li> -->
                                    </ul>
                                    <div class="carousel-inner">

                                        <?php
                                        

                                            foreach( $images as $ind => $value){
                                        ?>
                                                
                                                <div class="carousel-item <?php echo $ind == 0 ? 'active' : '' ?>">
                                                <img src="realestate/<?php echo $value ?>"  style="max-height: 400px; width: 100%;object-fit: cover;" class="img-fluid" alt="">
                                               <!--  <div class="carousel-caption">
                                                    <h3>Chicago</h3>
                                                    <p>Thank you, Chicago!</p>
                                                </div> -->
                                            </div>

                                        <?php
                                            }

                                        ?>


                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev" href="#propertyImgSlider" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                                    <a class="carousel-control-next" href="#propertyImgSlider" data-slide="next"><span class="carousel-control-next-icon"></span></a>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="body">
                                <h6>Payment Instructions</h6>

                                <ol type="1" style="display: flex; flex-direction: column; gap:10px;"> 
                                    <li>Kindly  make deposits/transfers to bank details below with the name of the subscriber clearly spelt out.</li>

                                    <li>Attach the teller or transfer slip(proof of payment) as indicated in the subscription details section.</li>
                                </ol>
                            </div>
                        </div>


                        <div class="card">
                            <div class="body">
                                <h6>Bank Details</h6>

                                <p><b>Account Name:</b> Gbemayo Properties</p>
                                <p><b>First Bank:</b>1012345677</p>
                                <p><b>GT Bank:</b> 0123456789</p>
                                <p><b>Access Bank:</b> 123456789</p>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Masked Input -->        
                
            <?php
                }
            ?>
         
        </div>

    </div>

</div>

<!-- Jquery Core Js --> 
<script src="../assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
<script src="../assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
<script src="../assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js --> 
<script src="../assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js --> 
<script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js --> 
<script src="../assets/plugins/nouislider/nouislider.js"></script> <!-- noUISlider Plugin Js --> 

<script src="../assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/forms/advanced-form-elements.js"></script> 

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/form-advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:22:43 GMT -->
</html>