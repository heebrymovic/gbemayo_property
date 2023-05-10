<?php  

include("includes/header.php"); 

if (isset($_POST['add'])) {

        $output = "";
        $media_title = mysqli_real_escape_string($con, $_POST['media_title']);
        $media_link  = mysqli_real_escape_string($con, $_POST['media_link']);
        $media_desc  = mysqli_real_escape_string($con, $_POST['media_desc']);


        if ( query_media_exists($media_link) > 0) {
            $output  =  "<div class='alert alert-danger ml-3'>
                <strong>Ooops!!, The media has already been added.</strong>
            </div>";
        } else{

            $add_media = add_media($media_title, $media_desc, $media_link);

            if ($add_media) {
                $output  =  "<div class='alert alert-success ml-3'>
                    <strong>Media Successfully Added.</strong>
                </div>";
            }else{
                $output  =  "<div class='alert alert-danger ml-3'>
                    <strong>Media Failed To Submit.</strong>
                </div>";
            }

        }
    
    }
?>


<?php
    if ($session_logged_company_privilege_id == 1) {
?>

     <!-- Default Size -->
    <div class="modal fade" id="Add_Agencies" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="title" id="defaultModalLabel">Add Media</h6>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                    
                        <div class="form-group">
                            <input type="text" name="media_title" required placeholder="Media Title" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="media_link" required placeholder="Media Link" class="form-control">
                        </div>
                       
                        <div class="form-group">
                            <textarea class="form-control" name="media_desc" placeholder="Media Description" rows="5" cols="30" required=""></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button name="add" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
    }
?>
    <!-- Right Sidebar -->
    <!-- <aside id="rightsidebar" class="right-sidebar">
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
    <div class="body_area after_bg sm">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Media</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Media List</h1>
                    </div>            
                    <?php
                        if ($session_logged_company_privilege_id == 1) {
                    ?>
                        <div class="col-lg-6 col-md-12 text-md-right">
                            <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Add_Agencies">Add Media</a>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php

                                        if (isset($_POST['add'])) {
                                            echo $output;
                                        }
                                    ?>
                                       
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover js-basic-example dataTable" id="datatables">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $query_media = query_all_media(true);
                                            $count = 1;
                                            while($fetch_media = mysqli_fetch_assoc($query_media)){
                                                extract($fetch_media);
                                        ?>

                                             <tr>
                                                <td><?= $count++  ?></td>
                                                <td><?= $media_title  ?></td>
                                                <td><p style="white-space: initial;"><?= $media_description  ?></p></td>
                                                <td>
                                                    <a class="btn btn-success text-white youtubePopup" href="<?= $media_link ?>">Watch</a>

                                                <?php
                                                    if ($session_logged_company_privilege_id == 1) {
                                                ?>
                                                    <a class="btn btn-danger text-white youtubePopup" href="delete-media?media_id=<?= base64_encode($media_id) ?>">Delete</a>
                                                <?php
                                                    }
                                                ?>

                                                </td>

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
    
<?php include("includes/footer.php") ?>
