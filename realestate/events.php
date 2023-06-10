<?php 
 include("includes/header.php");

 if (isset($_POST['add_event'])) {

        
        $event_title = mysqli_real_escape_string($con, $_POST['event_title']);
        $event_desc  = mysqli_real_escape_string($con, $_POST['event_desc']);
        $event_date  = mysqli_real_escape_string($con, $_POST['event_date']);
        $event_venue  = mysqli_real_escape_string($con, $_POST['event_venue']);

        $tmpname = $_FILES['event_banner']['tmp_name'];
        $filename = $_FILES['event_banner']['name'];
        $foldername = 'events_banner/' ;
        $uploadpath = $foldername .uniqid(). $filename;
    

        if (move_uploaded_file($tmpname, $uploadpath)) {
          
            add_events($event_title, $event_desc, $uploadpath, $event_venue, $event_date);

            $output  =  "<div class='alert alert-success ml-3'>
                <strong>Event Successfully Added.</strong>
            </div>";

        }else{
            $output  =  "<div class='alert alert-danger ml-3'>
                    <strong>Something went wrong. Try again later.</strong>
                </div>";
        }
    
    }
?>


<?php
    if ($session_logged_company_privilege_id == 1) {
?>


    
    <!-- Default Size -->
    <div class="modal fade" id="addevent" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Add Event</h4>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
        
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control" name="event_title" placeholder="Event Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea class="form-control no-resize" name="event_desc" placeholder="Event Description..."></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-line">
                            <input type="file" class="form-control" name="event_banner">
                        </div>
                    </div>  

                    <div class="form-group">
                        <div class="form-line">
                            <input type="date" class="form-control" name="event_date" placeholder="Event Date">
                        </div>
                    </div>    

                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control" name="event_venue" placeholder="Event Venue">
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button name="add_event" class="btn btn-primary waves-effect">Add</button>
                    <button type="button" class="btn btn-simple waves-effect" data-dismiss="modal">CLOSE</button>
                </div>

            </form>
            </div>
        </div>
    </div>
<?php
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
                            <li class="breadcrumb-item active">Events</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Event List</h1>
                    </div>            
                    <div class="col-lg-6 col-md-12 text-md-right">
                     
                         <?php
                            if ($session_logged_company_privilege_id == 1) {
                        ?>

                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addevent">Add Events</button>

                        <?php
                            }
                        ?>
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
                                <div class="col-lg-6">
                                    <?php

                                        if (isset($_POST['add_event'])) {
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

                                                     <?php

                                                         if ($session_logged_company_privilege_id == 1) {
                                                     ?>
                                                         <a class="btn btn-default" href="edit-event?event_id=<?php echo base64_encode($events_id)?>">Edit</a>
                                                            <a class="btn btn-danger" href="delete-event?event_id=<?php echo base64_encode($events_id)  ?>">Delete</a>

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
            

<?php
    require("includes/footer.php");
?>