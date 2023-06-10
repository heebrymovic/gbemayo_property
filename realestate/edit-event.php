<?php
    
    require("includes/header.php");

     if (isset($_GET['event_id']) && !empty($_GET['event_id']) ) {
        
        $event_id = base64_decode($_GET['event_id']);

    }else{
        header("location:../404");
    }


     if (isset($_POST['add_event'])) {

        $output = "";
        $event_title = mysqli_real_escape_string($con, $_POST['event_title']);
        $event_desc  = mysqli_real_escape_string($con, $_POST['event_desc']);
        $event_date  = mysqli_real_escape_string($con, $_POST['event_date']);
        $event_venue  = mysqli_real_escape_string($con, $_POST['event_venue']);
        $event_status  = mysqli_real_escape_string($con, $_POST['event_status']);


        $add_event = update_events($event_title, $event_desc, $event_venue, $event_date, $event_status);

        if ($add_event) {
            $output  =  "<div class='alert alert-success ml-3'>
                <strong>Event Successfully Updated.</strong>
            </div>";
        }else{
            $output  =  "<div class='alert alert-danger ml-3'>
                <strong>Something went wrong. Try again later.</strong>
            </div>";
        }
    
    }

    $query_event_info = query_single_event($event_id, true);

    $fetch_event_info = mysqli_fetch_assoc($query_event_info);

   
?>

 

    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="events">Events</a></li>
                            <li class="breadcrumb-item active">Edit Event</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Update Event</h1>
                    </div>            
                    <div class="col-lg-6 col-md-12 text-md-right">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4>Update Event Information </h4>
                        </div>

                        <?php

                             if (isset($_POST['add_event'])) {
                                echo $output;
                            }

                        ?>
                        <form action="" method="POST">                     
                            <div class="body">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" value="<?php echo $fetch_event_info['events_title'] ?>" name="event_title" placeholder="Event Title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize" rows="7" name="event_desc" placeholder="Event Description..."><?php echo $fetch_event_info['events_desc'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" class="form-control" value="<?php echo $fetch_event_info['events_date'] ?>" name="event_date" placeholder="Event Date">
                                    </div>
                                </div>    

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" value="<?php echo $fetch_event_info['events_venue'] ?>" name="event_venue" placeholder="Event Venue">
                                    </div>
                                </div>   


                                 <div class="form-group">
                                    <div class="form-line">
                                      <select name="event_status" class="form-control">
                                          <option value="">Select Event Status</option>
                                          <option <?php echo $fetch_event_info['events_status'] == 'active' ? "selected": ""   ?> value="active">Activate</option>
                                          <option <?php echo $fetch_event_info['events_status'] == 'inactive' ? "selected": ""?> value="inactive">Deactivate</option>
                                      </select>
                                    </div>
                                </div>   
                        
                                <button name="add_event" class="btn btn-primary">Update</button>
                                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                            </div>
                        </form>

                    </div>
                </div>
            
            </div>


<?php
    
    include("includes/footer.php");

?>