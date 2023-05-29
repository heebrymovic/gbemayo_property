<?php

     include("includes/header.php");

     if(isset($_POST['update_profile'])){

        $output = "";

        $old_path = $fetch_agent_info['agent_profile_photo'];
        $agent_fullname = mysqli_real_escape_string($con, $_POST['agent_fullname']);
        $agent_account_name  = mysqli_real_escape_string($con, $_POST['agent_account_name']);
        $agent_account_number  =  mysqli_real_escape_string($con, $_POST['agent_account_number']);
        $agent_bank_name  = mysqli_real_escape_string($con, $_POST['agent_bank_name']);
        $agent_address  =     mysqli_real_escape_string($con, $_POST['agent_address']);
        $agent_phone_number  =     mysqli_real_escape_string($con, $_POST['agent_phone_number']);

        $filename = $_FILES['agent_profile']['name'];
        $tmpname = $_FILES['agent_profile']['tmp_name'];
        $foldername = 'photos/' ;
        $uploadpath = $foldername .uniqid(). $filename;

         if (!$tmpname & !$filename) {

            $uploadpath = $old_path;

            include("update-profile.php");

        }else if ( move_uploaded_file($tmpname, $uploadpath) ) {
            unlink($old_path);

          include("update-profile.php");

        }

     }



     if (isset($_POST['update_password'])) {

        $oldpass = $fetch_agent_info['agent_password'];
        
        $password = md5(mysqli_real_escape_string($con, $_POST['oldpass']));

        $newpass = md5(mysqli_real_escape_string($con, $_POST['newpass']));

        
        if ($oldpass == $password) {

             $update_pass = update_agent_password($session_logged_in_agent_id,$session_logged_in_business_id, $newpass);

             if ($update_pass) {
            
                $output = "<div class='alert alert-success'>Password Successfully Updated</div>";
            
             }else{
                    $output = "<div class='alert alert-success'>Failed to update password.</div>";
             }

           
        }else{
            $output = "<div class='alert alert-danger'>Invalid password.</div>";
        }
    }
    
     $query_agent_info = admin_query_agent($session_logged_in_business_id, $session_logged_in_agent_id, true);

     $fetch_agent_info = mysqli_fetch_assoc($query_agent_info);
 ?>


   
    <!-- Main Content -->
    <div class="body_area profile-page">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                         <h1 class="mb-1 mt-1">Good <?php echo $currentTime .", " . ucwords(explode(" ",$fetch_agent_info['agent_fullname'])[0]) ?></h1>
                        <span>Welcome back to your dashboard</span>
                    </div>            
                    <div class="col-lg-6 col-md-12 text-md-right">
                      
                    </div>
                </div>
                <div class="bh_divider"></div>
                <div class="row clearfix">
                    <div class="col-12">
                        <ul class="nav nav-tabs">
                            <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#overview">Overview</a></li>
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#schedule">Schedule</a></li> -->
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#usersettings">Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                <?php

                         if (isset($_POST['update_profile']) || isset($_POST['update_password'])) {
                            echo $output;
                        }

                    ?>
                    <div class="tab-content">
                       


                        <div role="tabpanel" class="tab-pane active" id="usersettings">
                            <div class="card col-lg-8">
                                <div class="header">
                                    <h2><strong>Security</strong> Settings</h2>
                                </div>
                                <form action="" method="POST">
                                <div class="body">
    
                                    <div class="form-group">
                                        <input type="password" name="oldpass" class="form-control" placeholder="Current Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="newpass" class="form-control" placeholder="New Password">
                                    </div>
                                    <button name="update_password" class="btn btn-info">Save Changes</button>                               
                                </div>
                            </form>
                            </div>
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Account</strong> Settings</h2>
                                </div>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="body">
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="agent_fullname" value="<?php echo $fetch_agent_info['agent_fullname'] ?>" placeholder="Enter FullName">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" readonly value="<?php echo $fetch_agent_info['agent_email'] ?>" placeholder="Enter Email">
                                                </div>
                                            </div>                                    
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="<?php echo $fetch_agent_info['agent_phone_number']   ?>" name="agent_phone_number" placeholder="Enter Phone Number">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?php echo $fetch_agent_info['agent_bank_name']   ?>" name="agent_bank_name" placeholder="Enter Bank Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?php echo $fetch_agent_info['agent_account_number']   ?>" name="agent_account_number" placeholder="Enter Account Number">
                                                </div>
                                            </div>

                                             <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?php echo $fetch_agent_info['agent_account_name']   ?>" name="agent_account_name" placeholder="Enter Account Name">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="file" class="form-control" name="agent_profile" >
                                                </div>
                                            </div>


                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <textarea rows="4" class="form-control no-resize" name="agent_address" placeholder="Address"><?php  echo $fetch_agent_info['agent_address'] ?></textarea>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-12">
                                                <button class="btn btn-primary" name="update_profile">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Default Size -->
    <div class="modal fade" id="addevent" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Add Event</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" class="form-control" placeholder="Event Date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="Event Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea class="form-control no-resize" placeholder="Event Description..."></textarea>
                        </div>
                    </div>       
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect">Add</button>
                    <button type="button" class="btn btn-simple waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob Plugin Js -->
<script src="assets/bundles/morrisscripts.bundle.js"></script> <!-- Morris Plugin Js --> 
<script src="assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts -->

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/charts/jquery-knob.js"></script>
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/calendar/calendar.js"></script>
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/profile.js"></script>
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:17:06 GMT -->
</html>