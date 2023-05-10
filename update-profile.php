<?php

     $update_agent  = update_agent($agent_fullname, $agent_phone_number, $agent_address, $uploadpath, $agent_bank_name, $agent_account_name, $agent_account_number, $session_logged_in_agent_id);

            if ($update_agent) {
                 $output = "<div class='alert alert-success'>Profile Successfully Updated</div>";
               header("refresh:2");
            }else{
              
                 $output = "<div class='alert alert-danger'>Failed To Update Profile. Try again Later</div>";
            }

?>