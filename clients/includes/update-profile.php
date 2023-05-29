<?php

          $update_client_profile  = update_client_profile($client_title, $client_fullname, $profile_uploadpath, $client_phone_number, $client_address, $client_occupation, $client_dob, $valid_id_uploadpath, $session_logged_in_client_id);

            if ($update_client_profile) {
                 $output = "<div class='alert alert-success'>Profile Successfully Updated</div>";
               header("refresh:2");
            }else{
              
                 $output = "<div class='alert alert-danger'>Failed To Update Profile. Try again Later</div>";
            }

?>