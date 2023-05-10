<?php
        if ( query_admin_email_exists($company_email) > 0) {
            $email_error  =  "<div class='alert alert-danger'>
                <strong>The email has already been taken.</strong>
            </div>";
            $check_input_error = false;
        }


        if (query_admin_username_exists($company_username) > 0) {
            $username_error = "<div class='alert alert-danger'>
               <strong>The username has already been taken.</strong>
            </div>";
            $check_input_error = false;
        }

?>