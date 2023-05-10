<?php

	 if (isset($_POST['submit'])) {
        
        $output = "";

        $property_name = mysqli_real_escape_string($con, $_POST['property_name']);

        $property_location = mysqli_real_escape_string($con, $_POST['property_location']);

        $property_description = mysqli_real_escape_string($con, $_POST['property_description']);

        $property_type = mysqli_real_escape_string($con, $_POST['property_type']);

        $property_price = mysqli_real_escape_string($con, $_POST['property_price']);

        $property_size = mysqli_real_escape_string($con, $_POST['property_size']);

        $property_address = mysqli_real_escape_string($con, $_POST['property_address']);

        $property_year = @mysqli_real_escape_string($con, $_POST['property_year']);

        $property_bedroom = @mysqli_real_escape_string($con, $_POST['property_bedroom']);

        $business_commission = mysqli_real_escape_string($con, $_POST['business_commission']);

        $realtor_commission = mysqli_real_escape_string($con, $_POST['realtor_commission']);

        $marketer_commission = mysqli_real_escape_string($con, $_POST['marketer_commission']);

        $features =  @$_POST['features'];

        $features = json_encode($features);

        $duration = @$_POST['duration'];

        $price = @$_POST['price'];

        $image = array();

        $property_id = random_strings(15);

        $path = "properties/". $property_id;
    
        if (!file_exists($property_id)) {
            mkdir($path);
            chmod($path, 0777);
        }

        $upload_sucessful = false;

        foreach($_FILES['file']['name'] as $index => $data){

            $filename = $data;

            $tmpname = $_FILES['file']['tmp_name'][$index];

            $dest = $image[]= $path ."/" . uniqid(). $filename;

            $upload_sucessful = true;

            if (!move_uploaded_file($tmpname, $dest)) {
                $upload_sucessful = false;
                break 1;
            }
        }    


        if ($upload_sucessful) {

                $str_image = json_encode($image);

                if ($property_type == 1) {
                   $add_property =  add_property($property_id,$property_type, $property_name, $property_location, $property_address, $str_image, $property_description,$property_price, $property_size);
                   
          
                   include("includes/installmental.php");

                  
                }else if($property_type == 2) {
                    $add_property =  add_property($property_id,$property_type, $property_name, $property_location, $property_address, $str_image, $property_description ,$property_price, $property_size, $features, $property_year, $property_bedroom);
                    
                    include("includes/installmental.php");
                }
        }else{

             if (file_exists($path)) {
                deleteFiles($path);

                $output = "<div class='alert alert-danger col-md-5'>
                    <strong>Failed To Upload Products Image. Try again later</strong>
                 </div>"; 
            }
        }

        
    }

?>

