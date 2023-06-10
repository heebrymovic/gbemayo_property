<?php  

include("includes/header.php"); 
realtors_route();

if ( $fetch_agent_info['agent_subscription_status'] !== "active") {
    header("location:dashboard");
}

?>


  

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
                   
                </div>

                  <?php
                    if ($session_logged_in_privilege_id == 3 && $fetch_agent_info["agent_subscription_status"] == "inactive") {
                        include("realtor-subscribe-msg.php");
                    }
                ?>    
            </div>
        </div>

        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            
                            
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
