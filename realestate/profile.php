<?php  
    require 'includes/header.php';

    


    if (isset($_POST['update_profile'])) {

        $output = "";
        $old_path = $fetch_company_info['company_photo'];
        $company_name = mysqli_real_escape_string($con, $_POST['company_name']);
        $company_account_name  = mysqli_real_escape_string($con, $_POST['company_account_name']);
        $company_account_number  =  mysqli_real_escape_string($con, $_POST['company_account_number']);
        $company_bank_name  = mysqli_real_escape_string($con, $_POST['company_bank_name']);
        $company_address  =     mysqli_real_escape_string($con, $_POST['company_address']);
        $company_phone_number  =     mysqli_real_escape_string($con, $_POST['company_phone_number']);


        $tmpname = $_FILES['company_photo']['tmp_name'];
        $filename = $_FILES['company_photo']['name'];
        $foldername = 'photos/' ;
        $uploadpath = $foldername .uniqid(). $filename;
        $movefile = move_uploaded_file($tmpname, $uploadpath);

        if (!$tmpname & !$filename) {

            $uploadpath = $old_path;

            require("profile-update.php");
           
        }else if($movefile) {

            $old_path ? unlink($old_path) : "";

            require("profile-update.php");

        }else{
            $output = "<div class='alert alert-danger'>Something went wrong. Try again Later</div>";
        }
    
    }



    if (isset($_POST['update_password'])) {

        $oldpass = $fetch_company_info['admin_password'];
        
        $password = md5(mysqli_real_escape_string($con, $_POST['password']));

        $newpass = md5(mysqli_real_escape_string($con, $_POST['newpass']));

        
        if ($oldpass == $password) {

             $update_pass = update_company_admin_password($session_logged_in_admin_id, $session_logged_admin_company_id, $newpass);

             if ($update_pass) {
            
                $output = "<div class='alert alert-success'>Password Successfully Updated</div>";
            
             }else{
                    $output = "<div class='alert alert-success'>Failed to update password.</div>";
             }

           
        }else{
            $output = "<div class='alert alert-danger'>Invalid password.</div>";
        }
    }
   


    $query_company_info = query_company_acc_info($session_logged_admin_company_id, $session_logged_in_admin_id,true);

    $fetch_company_info = mysqli_fetch_assoc($query_company_info);

?>
    <!-- Right Sidebar -->
   <!--  <aside id="rightsidebar" class="right-sidebar">
        <div class="card">
            <div class="header">
                <h2>Layout Settings</h2>
            </div>
            <ul class="list-unstyled layout_setting">
                <li>
                    <label class="c_radio">
                        <input name="menu_settings" type="radio" value="menu-h" checked="">
                        <span class="checkmark"></span>
                        <span class="ml-2">Horizontal Menu</span>
                    </label>
                </li>
                <li>
                    <label class="c_radio">
                        <input name="menu_settings" type="radio" value="menu-l">
                        <span class="checkmark"></span>
                        <span class="ml-2">Vertical Leftbar</span>
                    </label>
                </li>
                <li>
                    <label class="c_radio">
                        <input name="menu_settings" type="radio" value="menu-f">
                        <span class="checkmark"></span>
                        <span class="ml-2">Full witdh Layout</span>
                    </label>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="header">
                <h2>Theme Settings</h2>
            </div>
            <ul class="list-unstyled choose-skin">
                <li data-theme="purple"><div class="purple"></div></li>
                <li data-theme="blue"><div class="blue"></div></li>
                <li data-theme="cyan"><div class="cyan"></div></li>
                <li data-theme="green" class="active"><div class="green"></div></li>
                <li data-theme="orange"><div class="orange"></div></li>
                <li data-theme="blush"><div class="blush"></div></li>
            </ul>
            <div class="bh_divider"></div>
            <ul class="list-unstyled font_setting">
                <li>
                    <label class="c_radio">
                        <input type="radio" name="font" value="font-quicksand">
                        <span class="checkmark"></span>
                        <span class="ml-2">Quicksand Google Font</span>
                    </label>
                </li>
                <li>
                    <label class="c_radio">
                        <input type="radio" name="font" value="font-nunito">
                        <span class="checkmark"></span>
                        <span class="ml-2">Nunito Google Font</span>
                    </label>
                </li>
                <li>
                    <label class="c_radio">
                        <input type="radio" name="font" value="font-ubuntu">
                        <span class="checkmark"></span>
                        <span class="ml-2">Ubuntu Google Font</span>
                    </label>
                </li>
                <li>
                    <label class="c_radio">
                        <input type="radio" name="font" value="font-raleway" checked="">
                        <span class="checkmark"></span>
                        <span class="ml-2">Raleway Google Font</span>
                    </label>
                </li>
            </ul>
            <div class="bh_divider"></div>
            <ul class="list-unstyled mb-0">
                <li class="d-flex align-items-center mb-2">
                    <label class="toggle-switch theme-switch">
                        <input type="checkbox">
                        <span class="toggle-switch-slider"></span>
                    </label>
                    <span class="ml-3">Enable Dark Mode!</span>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <label class="toggle-switch theme-high-contrast">
                        <input type="checkbox">
                        <span class="toggle-switch-slider"></span>
                    </label>
                    <span class="ml-3">Enable High Contrast</span>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <label class="toggle-switch theme-rtl">
                        <input type="checkbox">
                        <span class="toggle-switch-slider"></span>
                    </label>
                    <span class="ml-3">Enable RTL Mode!</span>
                </li>
            </ul>
        </div>
        <div class="card">
            <a href="javascript:void(0);" target="_blank" class="btn btn-block btn-primary">Buy this item</a>
            <a href="https://themeforest.net/user/thememakker/portfolio" target="_blank" class="btn btn-block btn-secondary">Themeforest Portfolio</a>
            <a href="https://thememakker.com/" target="_blank" class="btn btn-block btn-default">Visit ThemeMakker</a>
        </div>
    </aside>
 -->
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
                        <h1 class="mb-1 mt-1">Good <?php echo $currentTime .", " . ucwords($admin_username) ?></h1>
                        <span>Welcome back to your dashboard, if need a help <a href="javascript:void(0);" class="text-secondary">Contact</a> us.</span>
                    </div>            
                   <!--  <div class="col-lg-6 col-md-12 text-md-right">
                        <button class="btn btn-default hidden-xs ml-2">Download Report</button>
                        <button class="btn btn-secondary hidden-xs ml-2">New Report</button>
                    </div> -->
                </div>
                <div class="bh_divider"></div>
                <div class="row clearfix">
                    <div class="col-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#usersettings">Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card bg-grey2  text-white">
                        <div class="body profile-header">
                            <img width="20%" style="max-height: 200px;object-fit: cover;" src="<?php echo $fetch_company_info['company_photo'] != "" ? $fetch_company_info['company_photo'] : '../assets/images/profile_av.png'  ?>" class="user_pic rounded" alt="User">
                            <div class="detail">
                                <div class="u_name">
                                    <h3><?php echo ucwords($fetch_company_info['company_name']); ?></h3>
                                    <span>Real Estate Company</span>
                                </div>
                                <div id="m_area_chart"></div>
                            </div>
                        </div>
                    </div>

                    <?php

                         if (isset($_POST['update_profile']) || isset($_POST['update_password'])) {
                            echo $output;
                        }

                    ?>
        
                    <div class="tab-content">
                      

                    
                        <div role="tabpanel" class="tab-pane active" id="usersettings">
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Security</strong> Settings</h2>
                                </div>
                                <form action="" method="POST">
                                    <div class="body">
                                        
                                        <div class="form-group">
                                            <input type="text" class="form-control" readonly value="<?php echo $fetch_company_info['admin_username'] ?>" placeholder="Username">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" required class="form-control" placeholder="Current Password">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="newpass" required class="form-control" placeholder="New Password">
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
                                                    <input type="text" class="form-control" required name="company_name" value="<?php echo $fetch_company_info['company_name'] ?>" placeholder="Company Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" readonly value="<?php echo $fetch_company_info['company_email'] ?>"  placeholder="Company Email">
                                                </div>
                                            </div>                                    
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" required name="company_account_name" value="<?php echo $fetch_company_info['company_account_name'] ?>" placeholder="Company Account Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" required name="company_account_number" value="<?php echo $fetch_company_info['company_account_number'] ?>" placeholder="Company Account Number">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" required name="company_bank_name"  value="<?php echo $fetch_company_info['company_bank_name'] ?>" placeholder="Company Bank Name">
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea rows="4" class="form-control no-resize" required name="company_address" placeholder="Company Address"><?php echo $fetch_company_info['company_address'] ?></textarea>
                                                </div>
                                            </div>

                                             <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" required name="company_phone_number"  value="<?php echo $fetch_company_info['company_phone_number'] ?>" placeholder="Company Phone Number">
                                                </div>
                                            </div>
                                           
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="file" class="form-control" name="company_photo"  placeholder="Company Bank Name">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <button name="update_profile" class="btn btn-primary">Save Changes</button>
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
<script src="../assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="../assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob Plugin Js -->
<script src="../assets/bundles/morrisscripts.bundle.js"></script> <!-- Morris Plugin Js --> 
<script src="../assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts -->

<script src="../assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/charts/jquery-knob.js"></script>
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/calendar/calendar.js"></script>
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/profile.js"></script>
<script>
    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:58 GMT -->
</html>