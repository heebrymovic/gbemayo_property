<?php 
   include("includes/plugins.php");

   print_r($_SESSION);
?>

<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/pricing.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:23:36 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: Amaze ::</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/amaze.style.min.css">
</head>

<body class="font-ubuntu">

<div id="body" class="theme-cyan">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="mt-3"><img class="zmdi-hc-spin w60" src="assets/images/loader.svg" alt="Amaze"></div>
            <p>Payment Processing...</p>        
        </div>
    </div>

  <div class="overlay"></div>

<form id="paymentForm">
  <div class="form-group">
    <label for="email">Email Address</label>
    <input type="email" id="email-address" value="heebrymovic@gmail.com" required />
  </div>
  <div class="form-group">
    <label for="amount">Amount</label>
    <input type="tel" id="amount" value="1000" required />
  </div>
  <div class="form-group">
    <label for="first-name">First Name</label>
    <input type="text" id="first-name" />
  </div>
  <div class="form-group">
    <label for="last-name">Last Name</label>
    <input type="text" id="last-name" />
  </div>
  <div class="form-submit">
    <button type="submit" id="submit" onclick="payWithPaystack()"> Pay </button>
  </div>
</form>

<script src="https://js.paystack.co/v1/inline.js"></script> 
<script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
<script>
    
    const paymentForm = document.getElementById('paymentForm');

  paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_386db586a3ce091524a369fce2e84a5ea3e7c1f4', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      console.log(message);
    }
  });

  handler.openIframe();
}



/*
  694860181
  385692367
*/

</script>

<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/pricing.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:23:36 GMT -->
</html>