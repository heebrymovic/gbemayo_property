<?php
    include("includes/plugins.php");

    if (isset($_GET['refid']) && !empty($_GET['refid']) && isset($_GET['property-id']) && !empty($_GET['property-id'])  ) {
        
        $property_id = $_GET['property-id'];

        $refid = $_GET['refid'];

        if (query_single_property($property_id, 'property_uniq_id') > 0 && query_property_referral($refid) > 0)  {
           
           $query_property = query_single_property($property_id, 'property_uniq_id', true);

           $fetch_property_info = mysqli_fetch_assoc($query_property);

           $query_referral_info = query_property_referral($refid, true);

           $fetch_referral_info = mysqli_fetch_assoc($query_referral_info);

            /*IF TOTAL DATA IS TWO THAT IS AN ADMIN*/
        
            $event_invite_agent_id = count($fetch_referral_info)  == 2 ? NULL: $fetch_referral_info['agent_id'] ;

            $event_invite_business_id = $fetch_referral_info['company_id'];

        }else{
            header("location:404");
        }
    }else{
         header("location:404");
    }


    if (isset($_POST['subscribe'])) {

            
        $uniq_folder = random_strings(8);
        $path = "purchase/$uniq_folder/";

        if( !file_exists($path)){
            mkdir($path);
            chmod($path, 0777);
        }

        $upload_sucessful = true;
        foreach ($_FILES as $key => $value) {
                                            
            $tmpname = $_FILES[$key]['tmp_name'];
            $filename = $_FILES[$key]['name'];
            $$key = $filename ? $path .uniqid(). $filename : "";

            if (!move_uploaded_file($tmpname, $$key)) {
                $upload_sucessful = false;
                break;
            }
            
        }

        if($upload_sucessful){  

             $title = mysqli_real_escape_string($con, $_POST['title']);
             $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
             $email = mysqli_real_escape_string($con, $_POST['email']);
             $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
             $occupation = mysqli_real_escape_string($con, $_POST['occupation']);
             $address = mysqli_real_escape_string($con, $_POST['address']);
             $dob = mysqli_real_escape_string($con, $_POST['dob']);
             $nok_fullname = mysqli_real_escape_string($con, $_POST['nok_fullname']);
             $nok_address = mysqli_real_escape_string($con, $_POST['nok_address']);
             $nok_relationship = mysqli_real_escape_string($con, $_POST['nok_relationship']);
             $nok_phone_number = mysqli_real_escape_string($con, $_POST['nok_phone_number']);
             $property_unit = mysqli_real_escape_string($con, $_POST['property_unit']);
             $payment_structure = mysqli_real_escape_string($con, $_POST['payment_structure']);
             $payment_amount = mysqli_real_escape_string($con, $_POST['payment_amount']);


             $register_property_purchase = register_property_purchase($event_invite_agent_id, $fetch_property_info['property_id'], $event_invite_business_id,  $title, $fullname, $email, $phone_number, $occupation,  $address, $dob, $passport_photo, $valid_id, $nok_fullname, $nok_address, $nok_relationship, $nok_phone_number, $property_unit,  $payment_structure, $payment_amount,  $payment_proof );

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


<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/form-advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:22:31 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no ,shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>::Gbemayo Properties</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link  rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Morris Chart Css-->
<link rel="stylesheet" href="assets/plugins/morrisjs/morris.css" />
<!-- Colorpicker Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
<!-- Multi Select Css -->
<link rel="stylesheet" href="assets/plugins/multi-select/css/multi-select.css">
<!-- Bootstrap Spinner Css -->
<link rel="stylesheet" href="assets/plugins/jquery-spinner/css/bootstrap-spinner.css">
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<!-- Bootstrap Select Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<!-- noUISlider Css -->
<link rel="stylesheet" href="assets/plugins/nouislider/nouislider.min.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/amaze.style.min.css">
<style>
    .body_area { margin-top:70px!important; }
    .block-header{ overflow:hidden; position: relative; z-index: 1;}
    .block-header::after{ content:""; position:absolute; left:0; top:0; width:100%; height:100%; background:rgba(0, 0, 0, 0.4); z-index: -1;}
    @media only screen and (max-width: 1280px){
        .body_area { margin-top:58px!important; }        
    }
</style>
</head>

<body class="font-ubuntu">

<div id="body" class="theme-cyan">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="mt-3"><img class="zmdi-hc-spin w60" src="assets/images/loader.svg" alt="Amaze"></div>
            <p>Please wait...</p>        
        </div>
    </div>

    <div class="overlay"></div>

    <!-- Top Bar -->
    <nav class="top_navbar">
        <div class="container">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="navbar-logo">
                            <!-- <a href="javascript:void(0);" class="bars"></a> -->
                            <a class="navbar-brand" href="index-2.html"><img src="assets/images/logo.svg" width="30" alt="Amaze"><span class="ml-2">Gbemayo Properties</span></a>
                        </div>
                        <div class="d-flex justify-content-end justify-content-md-between align-items-center flex-grow-1"></div>
                    </div>
                </div>
            </div>        
        </div>
    </nav>

   <!--  <aside id="leftsidebar" class="sidebar h_menu"></aside> -->

    <!-- Right Sidebar -->


    <!-- Main Content -->
    <div class="body_area" >

        <div class="block-header" style="postion:relative; background: url(assets/images/realestate/co1.jpg) no-repeat fixed center/ cover; min-height:250px!important; display: grid; place-items: center;">
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
                                <h2><strong>Please Enter Your Personal</strong> Details</h2>

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
                                            <div class="col-lg-12 col-md-12 mb-3">
                                                <p> <b>Title</b> </p>
                                                <select class="form-control show-tick" name="title">
                                                    <option>Choose Title</option>
                                                    <option>Mr</option>
                                                    <option>Mister</option>
                                                    <option>Miss</option>
                                                    <option>Mrs</option>
                                                    <option>Dr</option>
                                                    <option>Chief</option>
                                                </select>
                                            </div>


                                            <div class="col-lg-12 col-md-12">
                                                <b>FullName</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="fullname" placeholder="Enter your fullname">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <b>Email Address</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                                    </div>
                                                    <input type="email" class="form-control email" name="email" placeholder="Enter your valid email">
                                                </div>
                                            </div>

                                             <div class="col-lg-12 col-md-12">
                                                <b>Phone Number</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="phone_number" placeholder="Enter your Phone Number">
                                                </div>
                                            </div>

                                             <div class="col-lg-12 col-md-12">
                                                <b>Occupation</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="occupation" placeholder="Enter Occupation">
                                                </div>
                                            </div> 

                                            <div class="col-lg-12 col-md-12">
                                                <b>Address</b>
                                                <div class="input-group mb-3">

                                                   <textarea class="form-control no-resize" name="address" rows="6"></textarea>
                                                </div>
                                            </div>
                                           

                                             <div class="col-lg-12 col-md-12">
                                                <b>Date of Birth</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" name="dob">
                                                </div>
                                            </div> 

                                            <div class="col-lg-12 col-md-12">
                                                <b>Passport Photo</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                                    </div>
                                                    <input type="file" class="form-control" name="passport_photo">
                                                </div>
                                            </div> 

                                            <div class="col-lg-12 col-md-12">
                                                <b>Valid ID</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                                    </div>
                                                    <input type="file" class="form-control" name="valid_id">
                                                </div>
                                            </div> 
                                            

                                            <div class="col-lg-12 col-md-12">
                                                <h6 class="mt-5">NEXT OF KIN INFORMATION</h6>                                            
                                            </div>

                                                <div class="col-lg-12 col-md-12">
                                                    <b>Fullname</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="nok_fullname">
                                                    </div>
                                              </div> 

                                               <div class="col-lg-12 col-md-12">
                                                <b>Address</b>
                                                <div class="input-group mb-3">

                                                   <textarea class="form-control no-resize"  name="nok_address" rows="6"></textarea>
                                                </div>
                                            </div>

                                               <div class="col-lg-12 col-md-12">
                                                    <b>Relationship</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="nok_relationship">
                                                    </div>
                                              </div> 

                                               <div class="col-lg-12 col-md-12">
                                                    <b>Phone number</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="nok_phone_number">
                                                    </div>
                                              </div> 


                                              <div class="col-lg-12 col-md-12">
                                                <h6 class="mt-5">
                                                    SUBSCRIPTION DETAILS
                                                </h6>                                            
                                            </div>

                                             <div class="col-lg-12 col-md-12">
                                                    <b>Number of unit</b>
                                                    <div class="mb-3">
                                                        <input type="number" class="form-control" value="1" name="property_unit">
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
                                                        <input type="number" class="form-control" name="payment_amount">
                                                    </div>
                                            </div> 


                                             <div class="col-lg-12 col-md-12">
                                                    <b>Payment Proof</b>
                                                    <div class="mb-3">
                                                        <input type="file" class="form-control" name="payment_proof">
                                                    </div>
                                            </div> 

                                            <div class="col-lg-12">
                                                <button class="btn btn-success text-white btn-block" name="subscribe">Subscribe</button>
                                            </div>


            
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
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
<script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
<script src="assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js --> 
<script src="assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js --> 
<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js --> 
<script src="assets/plugins/nouislider/nouislider.js"></script> <!-- noUISlider Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/forms/advanced-form-elements.js"></script> 

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/form-advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:22:43 GMT -->
</html>