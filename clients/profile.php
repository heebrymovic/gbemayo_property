<?php
    include("includes/header.php");

    $query_client_nok = query_client_next_of_kin($session_logged_in_client_id, true);
    $fetch_client_nok = mysqli_fetch_assoc($query_client_nok);



    if (isset($_POST['update_password'])) {

        $oldpass = $fetch_client_info['clients_password'];
        
        $password = md5(mysqli_real_escape_string($con, $_POST['oldpass']));

        $newpass = md5(mysqli_real_escape_string($con, $_POST['newpass']));

        
        if ($oldpass == $password) {

             $update_pass = update_client_password($session_logged_in_agent_id, $session_logged_in_business_id, $session_logged_in_client_id,  $newpass);

             if ($update_pass) {
            
                $output = "<div class='alert alert-success'>Password Successfully Updated</div>";
                 header("refresh:2");
            
             }else{
                    $output = "<div class='alert alert-success'>Failed to update password.</div>";
             }

           
        }else{
            $output = "<div class='alert alert-danger'>Invalid password.</div>";
        }
    }
    

    if (isset($_POST['update_profile'])) {
        
    
       $old_profile_path = $fetch_client_info['clients_photo'];
       $old_valid_id_path = $fetch_client_info['clients_valid_id'];
       $client_title = mysqli_real_escape_string($con, $_POST['client_title']);
       $client_fullname = mysqli_real_escape_string($con, $_POST['client_fullname']);
       $client_phone_number = mysqli_real_escape_string($con, $_POST['client_phone_number']);
       $client_occupation = mysqli_real_escape_string($con, $_POST['client_occupation']);
       $client_dob = mysqli_real_escape_string($con, $_POST['client_dob']);
       $client_address = mysqli_real_escape_string($con, $_POST['client_address']);
    
            /*PROFILE UPLOAD STARTS*/

        $profile_filename = $_FILES['client_passport']['name'];
        $profile_tmpname = $_FILES['client_passport']['tmp_name'];
        $profile_foldername = 'photos/';
        $profile_uploadpath = $profile_foldername .uniqid(). $profile_filename;

        /*PROFILE UPLOAD ENDS*/


        $valid_id_filename = $_FILES['client_valid_id']['name'];
        $valid_id_tmpname = $_FILES['client_valid_id']['tmp_name'];
        $valid_id_foldername = 'valid_id/';
        $valid_id_uploadpath = $valid_id_foldername .uniqid(). $valid_id_filename;


        $not_upload_profile = false; 

        $not_upload_valid_id = false; 


         if (!$profile_tmpname && !$profile_filename) {
           
            $profile_uploadpath = $old_profile_path;
            $not_upload_profile  = true;

        }

        if (!$valid_id_filename && !$valid_id_tmpname ) {
            
            $valid_id_uploadpath =  $old_valid_id_path;   

            $not_upload_valid_id = true;
        }


        if ($not_upload_valid_id && $not_upload_valid_id) {
            include("includes/update-profile.php");
        }



        if ( (!$valid_id_filename && !$valid_id_tmpname)  && ($profile_tmpname && $profile_filename)   ) {

            if (move_uploaded_file($profile_tmpname, $profile_uploadpath)) {
                include("includes/update-profile.php");
                unlink($old_profile_path);
            }
            

        }else if ( ($valid_id_filename && $valid_id_tmpname)  && (!$profile_tmpname && !$profile_filename)  ) {
            
            if (move_uploaded_file($valid_id_tmpname, $valid_id_uploadpath)) {
                include("includes/update-profile.php");
                 @unlink($old_valid_id_path);
            } 
            

        } else if (  ($valid_id_filename && $valid_id_tmpname)  && ($profile_tmpname && $profile_filename) ) {
            
            if (move_uploaded_file($profile_tmpname, $profile_uploadpath) && move_uploaded_file($valid_id_tmpname, $valid_id_uploadpath)) {
                include("includes/update-profile.php");
                @unlink($old_profile_path);
                @unlink($old_valid_id_path);
            }

        }

    }

    if (isset($_POST['register_nok'])) {
        
        $nok_fullname =  mysqli_real_escape_string($con, $_POST['nok_fullname']);
        $nok_email =  mysqli_real_escape_string($con, $_POST['nok_email']);
        $nok_relationship =  mysqli_real_escape_string($con, $_POST['nok_relationship']);
        $nok_address =  mysqli_real_escape_string($con, $_POST['nok_address']);
        $nok_phone_no =  mysqli_real_escape_string($con, $_POST['nok_phone_no']);
        $nok_occupation =  mysqli_real_escape_string($con, $_POST['nok_occupation']);

        $register_nok = register_client_nok($session_logged_in_client_id, $nok_fullname, $nok_email, $nok_occupation, $nok_address, $nok_relationship, $nok_phone_no);

        if ($register_nok) {
            $output = "<div class='alert alert-success'>Next Of Kin Information Added Successfully</div>";
               header("refresh:2");
        }else{
             $output = "<div class='alert alert-danger'>Failed To Add Next Of Kin Information. Try again Later</div>";
        }

    }

    if (isset($_POST['update_nok'])) {
        
        $nok_fullname =  mysqli_real_escape_string($con, $_POST['nok_fullname']);
        $nok_email =  mysqli_real_escape_string($con, $_POST['nok_email']);
        $nok_relationship =  mysqli_real_escape_string($con, $_POST['nok_relationship']);
        $nok_address =  mysqli_real_escape_string($con, $_POST['nok_address']);
        $nok_phone_no =  mysqli_real_escape_string($con, $_POST['nok_phone_no']);
        $nok_occupation =  mysqli_real_escape_string($con, $_POST['nok_occupation']);

        $update_nok = update_client_nok($fetch_client_nok['client_next_of_kin_id'], $nok_fullname, $nok_email, $nok_occupation, $nok_address, $nok_relationship, $nok_phone_no);

        if ($update_nok) {
            $output = "<div class='alert alert-success'>Next Of Kin Information Successfully Updated</div>";
               header("refresh:2");
        }else{
             $output = "<div class='alert alert-danger'>Failed To Update Next Of Kin Information. Try again Later</div>";
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
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Good <?php echo $currentTime .", " . ucwords("{$fetch_client_info['clients_title']} {$fetch_client_info['clients_fullname']}") ?></h1>
                        <span>Welcome back to your dashboard</span>
                    </div>            
                  
                </div>
               <!--  <div class="bh_divider"></div>
                <div class="row clearfix">
                    <div class="col-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#overview">Overview</a></li>
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#schedule">Schedule</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#usersettings">Settings</a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="container">
            <div class="row clearfix">

                 
                
                <div class="col-lg-12 col-md-12">
                    <?php

                        if (isset($_POST['update_profile'])  || isset($_POST['update_password']) || isset($_POST['register_nok']) || isset($_POST['update_nok'])){

                                echo $output;
                        }

                    ?>
                       
                    <div class="card text-white">
                        <div class="body profile-header d-flex align-items-center" style="gap:30px;">
                            <img src="<?php echo $fetch_client_info['clients_photo'] ?>" style="width: 150px; object-fit:cover; height: 150px;" class=" rounded" alt="User">
                            <div >
                                <div >
                                    <h4><strong><?php echo $fetch_client_info['clients_title'] ?></strong> <?php echo $fetch_client_info['clients_fullname'] ?></h4>
                                    <span><?php echo $fetch_client_info['clients_occupation'] ?></span>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="usersettings">
                            <div class="card col-lg-6">
                                <div class="header pb-1">
                                    <h2><strong>Security</strong> Settings</h2>
                                </div>
                                <form action="" method="POST">
                                    <div class="body">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="oldpass" placeholder="Current Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="newpass" placeholder="New Password">
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
                                            <div class="col-lg-4 col-md-12">
                                                <small>Title</small>
                                                <div class="form-group">
                                                    <input type="text" name="client_title" value="<?php echo $fetch_client_info['clients_title'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <small>Fullname</small>
                                                <div class="form-group">
                                                    <input type="text" name="client_fullname" value="<?php echo $fetch_client_info['clients_fullname'] ?>" class="form-control">
                                                </div>
                                            </div>                                    
                                            <div class="col-lg-4 col-md-12">
                                                <small>Email</small>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" readonly value="<?php echo $fetch_client_info['clients_email'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <small>Phone Number</small>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="client_phone_number" value="<?php echo $fetch_client_info['clients_phone_number'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <small>Occupation</small>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="client_occupation" value="<?php echo $fetch_client_info['clients_occupation'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <small>Date of birth</small>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="client_dob" value="<?php echo $fetch_client_info['clients_dob'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <small>Address</small>
                                                <div class="form-group">
                                                    <textarea rows="4" class="form-control no-resize" name="client_address" ><?php echo $fetch_client_info['clients_address']    ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-12">
                                                <small>Passport Photo</small>
                                                <div class="form-group">
                                                    <input type="file" class="form-control" name="client_passport">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-12">
                                                <small>Valid ID </small>
                                                <div class="form-group">
                                                    <input type="file" class="form-control" name="client_valid_id" <?php  echo $fetch_client_info['clients_valid_id'] ? '' : 'required'  ?> >
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-12">
                                                <button name="update_profile" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card">
                                <div class="header">
                                    <h2><strong>Next Of Kin</strong> Settings</h2>
                                </div>
                              
                                <form action="" method="POST">
                                    <div class="body">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?php echo @$fetch_client_nok['client_next_of_kin_fullname'] ?>" name="nok_fullname" placeholder="Full Name">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" value="<?php echo @$fetch_client_nok['client_next_of_kin_email'] ?>" name="nok_email" placeholder="E-mail">
                                                </div>
                                            </div>
                                                                             
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?php echo @$fetch_client_nok['client_next_of_kin_relationship'] ?>" name="nok_relationship" placeholder="Relationship">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <textarea rows="4" class="form-control no-resize" name="nok_address" placeholder="Address"><?php echo @$fetch_client_nok['client_next_of_kin_address'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="<?php echo @$fetch_client_nok['client_next_of_kin_number'] ?>" name="nok_phone_no" placeholder="Phone Number">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?php echo @$fetch_client_nok['client_next_of_kin_occupation'] ?>" name="nok_occupation" placeholder="Occupation">
                                                </div>
                                            </div>
                                            
                                           <?php
                                          
                                            if( query_client_next_of_kin($session_logged_in_client_id) > 0){

                                            ?>
                                                 <div class="col-md-12">
                                                    <button name="update_nok" class="btn btn-primary">Save Changes</button>
                                                </div>

                                            <?php
                                            }else{
                                            ?>
                                                 <div class="col-md-12">
                                                    <button name="register_nok" class="btn btn-primary">Register</button>
                                                </div>

                                            <?php
                                            }
                                           ?>
                                           
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

    

</div>

<script>
     if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<!-- Jquery Core Js --> 
<script src="../assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="../assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob Plugin Js -->
<script src="../assets/bundles/morrisscripts.bundle.js"></script> <!-- Morris Plugin Js --> 
<script src="../assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts -->

<script src="../assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/charts/jquery-knob.js"></script>
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/calendar/calendar.js"></script>
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/profile.js"></script>
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/hopital/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:05 GMT -->
</html>