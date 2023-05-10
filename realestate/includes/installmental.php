<?php
    
    if ($add_property) {
        
        $last_id = mysqli_insert_id($con);
            
        add_commissions($last_id, $session_logged_admin_company_id, $business_commission, $realtor_commission, $marketer_commission);

         foreach($duration as $index =>  $value){
            
            $installmental_property_duration = $duration[$index];
            
            $installmental_property_amount = $price[$index];

            add_installment($last_id, $installmental_property_duration,  $installmental_property_amount);   
         }

         $output = "<div class='alert alert-success col-md-5'>
            <strong>Product Successfully Added</strong>
         </div>";
    }else{
        $output = "<div class='alert alert-danger col-md-5'>
            <strong>Something went wrong failed to add product. Try Again</strong>
         </div>"; 
    }
    

?>