<?php
    
    require("includes/header.php");

    if (isset($_POST['submit'])) {

        $output = "";
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password  = md5(mysqli_real_escape_string($con, $_POST['password']));


        if ( query_admin_username_exists($username) > 0) {
            $output  =  "<div class='alert alert-danger ml-3'>
                <strong>The username has already been taken.</strong>
            </div>";
        } else{

            $add_admin = admin_registration($username, $password, $session_logged_admin_company_id);

            if ($add_admin) {
                $output  =  "<div class='alert alert-success ml-3'>
                    <strong>Registration Successful.</strong>
                </div>";
            }else{
                $output  =  "<div class='alert alert-danger ml-3'>
                    <strong>Registration Failed.</strong>
                </div>";
            }

        }
    
    }
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
    </aside> -->

    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
    
                            <li class="breadcrumb-item active">Add new</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Add new Admin</h1>
                    </div>            
                    <div class="col-lg-6 col-md-12 text-md-right">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            
            <div class="row clearfix">
                <div class="col-lg-5 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4>New Admin Information </h4>
                        </div>

                        <?php

                             if (isset($_POST['submit'])) {
                                echo $output;
                            }

                        ?>
                        <form action="" method="POST">                     
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control" placeholder="Username">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                   
                                </div>
                                <button name="submit" class="btn btn-primary">Submit</button>
                                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                            </div>
                        </form>

                    </div>
                </div>
            
            </div>


<?php
    
    include("includes/footer.php");

?>