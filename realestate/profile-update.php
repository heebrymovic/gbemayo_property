<?php 
    $update_company_profile = update_company_info($company_name, $company_account_name, $company_account_number, $company_bank_name, $company_address, $company_phone_number, $uploadpath, $session_logged_admin_company_id);

            if ($update_company_profile) {
               $output = "<div class='alert alert-success'>Profile Successfully Updated</div>";
               header("refresh:2");
            }else{
                $output = "<div class='alert alert-danger'>Failed To Update Profile. Try again Later</div>";
            }

?>