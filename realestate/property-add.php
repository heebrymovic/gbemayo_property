<?php 
    include("includes/header.php");
    superadmin_route();    

    include("includes/property-reg.php");
?>


    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Add new</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Add new Property</h1>
                    </div>            
                    <div class="col-lg-6 col-md-12 text-md-right">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row clearfix">

                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Basic Information</h2>
                        </div>

                        
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="body">

                               <!--  <div class="alert alert-danger col-md-5">
                                    Fail to submit
                                </div> -->

                                <?php

                                    if (isset($_POST['submit'])) {

                                        echo $output;
                                    }

                                ?>


                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required  name="property_name" placeholder="Property Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required name="property_location" placeholder="Property Location">
                                        </div>
                                    </div>

                                     <div class="col-sm-12 ">
                                        <div class="form-group">
                                             <div class="form-line">
                                        <input type="file" multiple name="file[]" required  class="dropify">
                                    </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="6" class="form-control no-resize" required  name="property_description" placeholder="Property Description"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control" name="property_type" required id="type">
                                                    <option value="">Select Property Type</option>
                                                    <?php

                                                        $query_property_type = query_property_types();

                                                        while($fetch_property_type = mysqli_fetch_assoc($query_property_type)){

                                                            extract($fetch_property_type);
                                                    ?>
                                                        <option value="<?php echo $property_type_id?>"><?php echo ucwords($property_type_name) ?></option>

                                                    <?php
                                                        }

                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <h6 class="mt-4">Property Information</h6>
                                    
                                     <div class="row clearfix ">
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <input type="number" class="form-control" required name="property_price" placeholder="Price">
                                            </div>
                                        </div>                            
                                
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" required name="property_size"  placeholder="Square ft">
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <textarea rows="4" class="form-control no-resize" required name="property_address"  placeholder="Property Address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                               
                            

                                <div id="House" class="info">
                                     
                                    <div class="row clearfix">
                                

                                     <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="property_bedroom" placeholder="Bedrooms">
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="property_year" placeholder="Year Built">
                                        </div>
                                    </div>
                                </div>
                              
                                <h6 class="mt-4">Features</h6>
                                <div class="row">
                                    <div class="col-sm-12 d-flex flex-wrap">
                                        <label class="c_checkbox mb-2 mr-4">
                                            <input type="checkbox" value="Swimming pool" name="features[]">
                                            <span class="checkmark"></span>
                                            <span class="ml-2">Swimming pool</span>
                                        </label>
                                        <label class="c_checkbox mb-2 mr-4">
                                            <input type="checkbox" value="Terrace" name="features[]">
                                            <span class="checkmark"></span>
                                            <span class="ml-2">Terrace</span>
                                        </label>
                                        <label class="c_checkbox mb-2 mr-4">
                                            <input type="checkbox" value="Air conditioning" name="features[]">
                                            <span class="checkmark"></span>
                                            <span class="ml-2">Air conditioning</span>
                                        </label>
                                        <label class="c_checkbox mb-2 mr-4">
                                            <input type="checkbox" value="Internet" name="features[]">
                                            <span class="checkmark"></span>
                                            <span class="ml-2">Internet</span>
                                        </label>
                                        <label class="c_checkbox mb-2 mr-4">
                                            <input type="checkbox" value="Balcony" name="features[]">
                                            <span class="checkmark"></span>
                                            <span class="ml-2">Balcony</span>
                                        </label>
                                        <label class="c_checkbox mb-2 mr-4">
                                            <input type="checkbox" value="Cable TV" name="features[]">
                                            <span class="checkmark"></span>
                                            <span class="ml-2">Cable TV</span>
                                        </label>
                                        <label class="c_checkbox mb-2 mr-4">
                                            <input type="checkbox" value="Computer" name="features[]">
                                            <span class="checkmark"></span>
                                            <span class="ml-2">Computer</span>
                                        </label>
                                        <label class="c_checkbox mb-2 mr-4">
                                            <input type="checkbox" value="Dishwasher" name="features[]">
                                            <span class="checkmark"></span>
                                            <span class="ml-2">Dishwasher</span>
                                        </label>

                                        <label class="c_checkbox mb-2 mr-4">
                                            <input type="checkbox" value="Car Parking" name="features[]">
                                            <span class="checkmark"></span>
                                            <span class="ml-2">Car Parking</span>
                                        </label>
                                    </div>
                                   
                                </div>    
                                </div>
                                
                                <h6 class="mt-4">Commissions</h6>

                                 <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="number" class="form-control" required  name="business_commission" placeholder="Business Commission(%)">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="number" class="form-control" required name="realtor_commission" placeholder="Realtors Commission(%)">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="number" class="form-control" required name="marketer_commission" placeholder="Marketers Commission(%)">
                                        </div>
                                    </div>

                                </div>


                                
                                <h6 class="mt-4">Installmental Info</h6>
                                <div id="installmental">

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="duration[]" placeholder="Duration">
                                            </div>
                                        </div>                            
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input type="number" class="form-control"  name="price[]" placeholder="Price">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="d-flex justify-content-end">
                                        <a href="javascript:void(0)"  class="btn btn-secondary" id="addForm">Add</a>
                                        <a href="javascript:void(0)"  class="btn btn-danger ml-2" id="removeForm">Remove</a>
                                    </div>

                                 <div class="row">
                                     
                                    <div class="col-sm-12">
                                        <div class="mt-4">
                                            <button name="submit" class="btn btn-primary">Submit</button>
                                            <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                                        </div>
                                    </div> 
                                 </div>

                                    
                            </div>
                        </form>
                    </div>
                </div>

            </div>

<?php

    include("includes/footer.php")

?>

<script>
     $(".info").css("display", "none");


     addForm.addEventListener("click", function() {
            

        var totalForm = installmental.querySelectorAll(".row").length;
        
        if ( totalForm < 5) {

        var element = document.createElement("div");

        element.classList.add("row");

        element.innerHTML = ` <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="duration[]" placeholder="Duration">
                                            </div>
                                        </div>                            
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <input type="number" class="form-control"  name="price[]" placeholder="Price">
                                            </div>
                                        </div>`;

        installmental.append(element)
         /*installmental.innerHTML += ` <div class="row">
                                       
                                    </div>`;*/
        }else{
            alert("Maximum Form Limit Reached")
        }
     })



     removeForm.addEventListener("click", function() {
            

        var totalForm = installmental.querySelectorAll(".row").length;

        if( totalForm > 1 ){
            installmental.lastElementChild.remove()
        }
        
    
     })

     type.addEventListener("change", function() {

        var value = this.options[this.selectedIndex].innerHTML;

        $(".info").css("display", "none");

        $(`#${value}`).css("display", "block");
     })
     
</script>