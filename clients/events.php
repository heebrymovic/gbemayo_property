<?php 
 include("includes/header.php");

?>

    <!-- Main Content -->
    <div class="body_area after_bg sm">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Events</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Event List</h1>
                    </div>            
                    <div class="col-lg-6 col-md-12 text-md-right">
            
                    </div>
                </div>

               
     
            </div>
        </div>

        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="body">
                           <div class="row">
                              
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover js-basic-example dataTable" id="datatables">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $query_all_events = query_all_events(true);
                                            $count = 1;
                                            while($fetch_events = mysqli_fetch_assoc($query_all_events)){
                                                extract($fetch_events);
                                        ?>

                
                                             <tr>
                                                <td><?php echo $count++  ?></td>
                                                <td><?php echo $events_title ?></td>
                                                <td><p style="white-space:initial;"><?php echo $events_desc ?></p></td>
                                                <td><p style="white-space:initial;"><?php echo $events_venue?></p></td>
                                                <td><?php echo date("D, d M Y", strtotime($events_date)) ?></td>
                                                <td>

                                                     <a class="btn btn-primary" href="event-details?event_id=<?php echo base64_encode($events_id)  ?>">View more</a>

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
            

<?php
    require("includes/footer.php");
?>