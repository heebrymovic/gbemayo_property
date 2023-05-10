<?php 
 include("includes/header.php");

    if (isset($_GET['property_id']) && !empty($_GET['property_id']) ) {

        $property_id = base64_decode( $_GET['property_id']);

        $query_property = query_single_property($property_id, "property_id",true);

        $fetch_property = mysqli_fetch_assoc($query_property);

        $images = $fetch_property['property_file'];

        $images = json_decode($images);

        $features = $fetch_property['property_features'];

        $features = json_decode($features);


    }else{
        header("location:../404");
    }
?>



    <!-- Main Content -->
    <div class="body_area">

        <div class="block-header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <ul class="breadcrumb pl-0 pb-0 ">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="property-list">Property</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ul>
                        <h1 class="mb-1 mt-1">Property Details</h1>
                    </div>            
                    <div class="col-lg-6 col-md-12 text-md-right">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="body">
                            <div id="propertyImgSlider" class="carousel slide" data-ride="carousel">
                                <ul class="carousel-indicators">
                                    <?php
                                       
                                        foreach( $images as $ind => $value){
                                    ?>
                                            <li data-target="#demo2" data-slide-to="<?php echo $ind ?>" class="<?php echo $ind == 0 ? 'active' : '' ?>"></li>
                                    <?php
                                        }

                                    ?>
                                    <!-- <li data-target="#demo2" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo2" data-slide-to="1" class=""></li>
                                    <li data-target="#demo2" data-slide-to="2" class=""></li> -->
                                </ul>
                                <div class="carousel-inner">

                                    <?php
                                    

                                        foreach( $images as $ind => $value){
                                    ?>
                                            
                                            <div class="carousel-item <?php echo $ind == 0 ? 'active' : '' ?>">
                                            <img src="realestate/<?php echo $value ?>"  style="max-height: 400px; width: 100%;object-fit: cover;" class="img-fluid" alt="">
                                           <!--  <div class="carousel-caption">
                                                <h3>Chicago</h3>
                                                <p>Thank you, Chicago!</p>
                                            </div> -->
                                        </div>

                                    <?php
                                        }

                                    ?>


                                </div>
                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#propertyImgSlider" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                                <a class="carousel-control-next" href="#propertyImgSlider" data-slide="next"><span class="carousel-control-next-icon"></span></a>
                            </div>
                            <div class="property grid mt-4">
								<div class="details flex-grow-1">
									<div class="tc_content">
										<div class="d-flex justify-content-between">
											<ul class="list-unstyled tag">
												<li class="list-inline-item"><a href="#" class="rent"><?php  echo ucwords($fetch_property['property_type_name']) ?></a></li>
												<!-- <li class="list-inline-item"><a href="#" class="sale">Featured</a></li> -->
											</ul>
											<span class="font-25">N<?php echo number_format($fetch_property['property_price']) ?></span>
										</div>
										<!-- <p class="text-danger">Apartment</p> -->
										<h5><?php echo $fetch_property['property_name'] ?></h5>
										<p><i class="zmdi zmdi-map-pin font-13"></i> <?php echo $fetch_property['property_address'] ?></p>
										<!-- <ul class="list-unstyled property-info">
											<li class="list-inline-item"><a href="#">Beds: <strong>4</strong></a></li>
											<li class="list-inline-item"><a href="#">Baths: <strong>2</strong></a></li>
											<li class="list-inline-item"><a href="#">Sq Ft: <strong>5280</strong></a></li>
										</ul> -->
									</div>
									<!-- <div class="d-flex justify-content-between align-items-center">
										<ul class="list-unstyled mb-0">
											<li class="list-inline-item"><a href="#"><img class="avatar rounded-circle" src="../assets/images/xs/avatar1.jpg" alt="avatar.png"></a></li>
											<li class="list-inline-item"><a href="#">Rose Rivera</a></li>
										</ul>
										<div>4 years ago</div>
									</div> -->
								</div>
							</div>
                        </div>
                    </div>


                   

                        <div class="card">

                        <div class="header">
                            <h2>Descriptions</h2>
                        </div>
                        <div class="body pt-0">
                            <?php echo $fetch_property['property_desc'] ?>
                        </div>

                         <?php

                            if($fetch_property['property_type_id'] == 2){
                        ?>
                        <div class="header">
                            <h2>General Amenities</h2>
                        </div>
                        <div class="body pt-1">
                            <ul class="row list-unstyled amenities-list mb-0">
                                <?php

                                    foreach($features as $feature){
                                ?>

                                    <li class="col-lg-4 col-md-5 col-sm-6"><i class="zmdi zmdi-check mr-1"></i><?php echo $feature ?></li>

                                <?php
                                    }

                                ?>
                                
                            </ul>
                        </div>

                         <?php
                        }

                    ?>

                         <div class="header">
                            <h2>Installmental Payment Structures  </h2>
                        </div>
                        <div class="body pt-0">
                            
                            <table class="table">
                                <thead>
                                     <tr>
                                        <th>Duration</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                        $query_installmental = query_installmental($property_id);


                                        while($fetch_installmental = mysqli_fetch_assoc($query_installmental)){
                                        
                                        extract($fetch_installmental);    
                                    ?>
                                        <tr>
                                            <td><?php echo $installmental_property_duration ?></td>
                                            <td>N<?php echo number_format($installmental_property_amount); ?></td>
                                        </tr>

                                    <?php
                                        }
                                    ?>

                                </tbody>
                               
                            </table>
                        </div>
                 
                    </div>

                   
                   
                </div>
                <div class="col-lg-4 col-md-12">
                    
                    <div class="card">
                        <div class="header">
                            <h2>More Details</h2>
                        </div>
                        <div class="body">
                            <?php
                                if ($fetch_property['property_status'] == 'active') {
                            ?>
                            <input  type="text" style="display: none;" id="copyInput" value='<?php echo get_url("/CD/gbemayo/property"). "?refid=" . $fetch_agent_info["agent_referral_id"] ?>&property-id=<?php echo $fetch_property['property_uniq_id'] ?>'>
                            <button class="btn btn-primary btn-block mb-3" id="copyData">Copy Subscription Link</button>
                            <?php
                                 }
                            ?>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered mb-0">
                                    <tbody>
                                

                                        <tr>
                                            <th scope="row">Reference ID:</th>
                                            <td><?php echo $fetch_property['property_uniq_id'] ?></td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Location:</th>
                                            <td><?php echo $fetch_property['property_location'] ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Square ft:</th>
                                            <td><?php echo $fetch_property['property_sq_fit'] ?></td>
                                        </tr>
                                        

                                       <!--  <tr>
                                            <th scope="row">Garage Spaces:</th>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Land Size:</th>
                                            <td>721 m²</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Floors:</th>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Listed for:</th>
                                            <td>15 days</td>
                                        </tr> -->

                                        <?php

                                            if($fetch_property['property_type_id'] == 2){

                                        ?>

                                            <tr>
                                                <th scope="row">Bedrooms:</th>
                                                <td><?php echo $fetch_property['property_bedroom']  ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Year Built:</th>
                                                <td><?php echo $fetch_property['property_year']  ?></td>
                                            </tr>

                                        <?php

                                        }
                                            if (query_single_commission($fetch_property['property_id'], $session_logged_in_business_id) > 0) {
                                                    
                                                    $query_commission = query_single_commission($fetch_property['property_id'], $session_logged_in_business_id, true);


                                                }else{
                                                    $query_commission = query_single_commission($fetch_property['property_id'], 1, true);
                                                }
                                                $fetch_commission = mysqli_fetch_assoc($query_commission);
                                        ?> 

                                        <tr>
                                            <th scope="row">Realtors Commission:</th>
                                            <td><?php echo $fetch_commission['commission_realtors'];?>%</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Marketers Commission:</th>
                                            <td><?php echo $fetch_commission['commission_marketers']; ?>%</td>
                                        </tr>


                                        <tr>
                                            <th scope="row">Availability:</th>
                                            <td><span class="badge <?php echo $fetch_property['property_status'] == 'active' ? 'badge-success' : 'badge-danger' ?> "><?php echo $fetch_property['property_status'] ?></span></td>
                                        </tr>
    
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>Request Inquiry</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Mobile No.">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="submit" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

<?php
    require("includes/footer.php");
?>