<?php 
   include("includes/plugins.php");

   if (isset($_SESSION['store']['payment_type']) && ($_SESSION['store']['payment_type'] == "register") ) {
     
     $fullname = $_SESSION['store']['fullname'];
        $email = $_SESSION['store']['email'];
        $address = $_SESSION['store']['address'];
        $phone_no = $_SESSION['store']['phone_no'];

   }elseif (isset($_SESSION['store']['payment_type']) && ($_SESSION['store']['payment_type'] == "upgrade") ) {
       
       
   }else{
        header("location:register");
   }

   if (isset($_POST['cancel'])) {
       
       unlink($_SESSION['store']['uploadpath']);

       unset($_SESSION['store']);

       echo "<script>
        alert('You have successfully cancelled payment');
        window.location.href = 'register'
       </script>";
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

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 text-center">
                        
                        <h1 class="mb-3 mt-1">Payment Checkout Form</h1>
                        
                    </div>          
                    
                </div>
            </div>
        </div>

        <div class="container">

              

                <!-- Masked Input -->
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header pb-2">
                                <div class="alert alert-primary">Kindly click the confirm button to continue  payment</div>
                                <!-- <h2><strong>Kindly click the confirm button to continue  payment</h2> -->
                               
                            </div>
                            <form  id="paymentForm" >
                                <div class="body pt-1">
                                    <div class="demo-masked-input">
                                        <div class="row clearfix">
                    

                                            <div class="col-lg-12 col-md-12">
                                                <b>FullName</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                                    </div>
                                                    <input type="text"  readonly class="form-control" value="<?php echo $fullname ?>" name="fullname">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <b>Email Address</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                                    </div>
                                                    <input type="email" id="email-address"  readonly value="<?php echo $email ?>" class="form-control email" name="email" >
                                                </div>
                                            </div>

                                             <div class="col-lg-12 col-md-12">
                                                <b>Phone Number</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-phone"></i></span>
                                                    </div>
                                                    <input type="text" readonly class="form-control" value="<?php echo $phone_no ?>" name="phone_number">
                                                </div>
                                            </div>

                                             <div class="col-lg-12 col-md-12">
                                                <b>Address</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" readonly value="<?php echo $address ?>" name="occupation">
                                                </div>
                                            </div> 

                                             <div class="col-lg-12 col-md-12">
                                                <b>Amount</b>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="zmdi zmdi-time"></i></span>
                                                    </div>
                                                    <input type="number" id="amount" class="form-control" readonly value="<?php 
                                                        $query_fee = query_single_reg_fee(NULL, 3);
                                                        $fetch_fee = mysqli_fetch_assoc($query_fee);
                                                        echo $fetch_fee['reg_fee_price']
                                                     ?>" name="occupation">
                                                </div>
                                            </div>                                             

            
                                            <div class="col-lg-12">
                                                <button class="btn btn-success text-white btn-block" id="submit" onclick="payWithPaystack()" name="subscribe">Confirm payment</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="" method="POST">
                                <div class="body" style="padding-top:0px!important; padding-bottom: 0px!important;">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button class="btn btn-danger text-white btn-block" name="cancel">Cancel payment</button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">

            
                    </div>
                </div>
                <!-- #END# Masked Input -->        
                
          
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

<script src="https://js.paystack.co/v1/inline.js"></script> 
<script>


    
    const paymentForm = document.getElementById('paymentForm');

  paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_386db586a3ce091524a369fce2e84a5ea3e7c1f4', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: 'gb_'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      window.location.href = `verify?ref=${response.reference}&status=${response.status}`
      /*console.log(message);*/
    }
  });

  handler.openIframe();
}


    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/form-advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:22:43 GMT -->
</html>