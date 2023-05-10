<?php
	
	include("config.php");	


	function authenticate_login(){

		$GLOBALS['session_logged_admin_company_id']  = $admin_company_id = @$_SESSION['admin_company_id'];
		$GLOBALS['session_logged_company_privilege_id'] = $company_privilege_id = @$_SESSION['company_privilege_id'];
		$GLOBALS['session_logged_in_admin_id'] = $session_logged_in_admin_id = @$_SESSION['admin_id'];

		if ( !isset($admin_company_id) && !isset($company_privilege_id) && !isset($session_logged_in_admin_id) || (query_company_acc_info($admin_company_id, $session_logged_in_admin_id) == 0) ){

       			 header("location:login");
       			 exit();
    	}
	}

	function authenticate_agent_login(){

		$GLOBALS['session_logged_in_business_id']  = $business_id = @$_SESSION['business_id'];
		$GLOBALS['session_logged_in_agent_id'] = $agent_id = @$_SESSION['agent_id'];
		$GLOBALS['session_logged_in_privilege_id'] = $privilege_id = @$_SESSION['agent_privilege_id'];
		$GLOBALS['session_logged_in_referral_type'] = $referral_type = @$_SESSION['agent_referral_type'];
		
		if ( !isset($business_id) && !isset($agent_id) && !isset($privilege_id) || (admin_query_agent($business_id, $agent_id) == 0) ){

       			 header("location:login");
       			 exit();
    	}
	}


	function superadmin_route(){
		global $session_logged_company_privilege_id;

		if ($session_logged_company_privilege_id != 1) {
			header("location:../404");
		}
	}


	function realtors_route(){
		global $session_logged_in_privilege_id;

		if ($session_logged_in_privilege_id != 3) {
			header("location:404");
		}
	}

	
	function str_includes($string, $search){
		return strpos($string, $search);
	}


	function stop_superadmin_registration(){
		global $url;

		if (str_includes($url, "superadmin") !== false) {
			header("location:login");
		}
	}


	/*IF URL ACCESS WITH WITH THE MAIN FOLDER NAME IT SHOULD REDIRECT TO ERROR PAGE*/
	function redirect_default_path(){
		global $url;

		if (str_includes($url, "realestate") !== false) {
			header("location:../404");
		}
	}


	function set_privilege_id(){

		global $url;

		if ( str_includes($url, "superadmin") !== false ) {
                
                $GLOBALS['company_privilege_id'] = get_privileges_id("superadmin");

            }else if (str_includes($url, "business") !== false) {

                $GLOBALS['company_privilege_id'] = get_privileges_id("business");
            }
	}



	function company_registration($company_name, $company_email, $company_address, $company_privilege_id, $company_referral_id, $company_event_id ){
		global $con;
		
		$query = mysqli_query($con, "INSERT INTO company SET
			company_name = '$company_name',
			company_email = '$company_email',
			company_address = '$company_address',
			company_privilege_id = '$company_privilege_id',
			company_referral_id = '$company_referral_id',
			company_event_id = '$company_event_id',
			company_created_at = NOW()
		")or die(mysqli_error($con));	

		return $query;
	}


	function update_company_info($company_name, $company_account_name, $company_account_number, $company_bank_name, $company_address,$company_phone_number ,$photo, $company_id){
		global $con;
		
		$query = mysqli_query($con, "UPDATE company SET
			company_name = '$company_name',
			company_account_name = '$company_account_name',
			company_account_number = '$company_account_number',
			company_bank_name = '$company_bank_name',
			company_address = '$company_address',
			company_phone_number='$company_phone_number',
			company_photo = '$photo' WHERE company_id = '$company_id'
		")or die(mysqli_error($con));	

		return $query;
	}


	function update_company_admin_password($admin_id, $company_id, $password){
		global $con;

		$query = mysqli_query($con, "UPDATE admin SET
			admin_password = '$password' WHERE admin_id='$admin_id' AND admin_company_id='$company_id' ");

		return $query;
		
	}

	function admin_registration($admin_username, $admin_password, $admin_company_id){
		global $con;
		
		$query = mysqli_query($con, "INSERT INTO admin SET
			admin_username = '$admin_username',
			admin_password = '$admin_password',
			admin_company_id = '$admin_company_id',
			admin_created_at = NOW()
		") or die(mysqli_error($con));	

		return $query;
	}


	function admin_query_all_business(){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM company WHERE company_privilege_id != 1 ORDER BY company_id DESC");

		return $query;
	}


	function get_privileges_id($privileges_name){
		global $con;
		
		$query = mysqli_query($con, "SELECT privileges_id FROM privileges WHERE privileges_name='$privileges_name'") or die(mysqli_error($con));

		$fetch =  mysqli_fetch_array($query);
		
		return $fetch['privileges_id'];
	}

	


	function query_admin_email_exists($email){
		global $con;

		$query = mysqli_query($con, "SELECT *  FROM company WHERE company_email='$email'") or die(mysqli_error($con));

		return mysqli_num_rows($query);
	}


	function query_agent_email_exists($email){
		global $con;

		$query = mysqli_query($con, "SELECT *  FROM agents WHERE agent_email='$email'") or die(mysqli_error($con));

		return mysqli_num_rows($query);
	}




	function query_all_admin($company_id, $data=false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM admin WHERE admin_company_id='$company_id' ") or die(mysqli_error($con));

		return $data ?  $query : mysqli_num_rows($query);
	}


	function query_admin_username_exists($username, $data=false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM admin WHERE admin_username='$username'") or die(mysqli_error($con));

		return $data ?  $query : mysqli_num_rows($query);
	}


	function query_admin_login($email, $password, $privileges_id,$data=false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM admin JOIN company ON company.company_id = admin.admin_company_id WHERE admin_username='$email' AND admin_password='$password' AND company_privilege_id='$privileges_id'") or die(mysqli_error($con));

		$count = mysqli_num_rows($query);

		return $data ? $query : $count;
	}


	function query_company_acc_info($id, $admin_id, $data=false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM company JOIN admin ON company.company_id = admin.admin_company_id AND admin.admin_id = '$admin_id'  WHERE company_id='$id'");

		return $data ? $query : mysqli_num_rows($query);
	}



	function admin_query_company_acc_info($id){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM company WHERE company_id='$id'");

		return $query;
	}



	function random_strings($length_of_string){ 
	    $str_result = mt_rand(1111111, 9999999 ) . time() . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
	    return substr(str_shuffle($str_result), 0, $length_of_string); 
	}


	function get_url($path = ""){

	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	  $page_current_name = $protocol.basename($_SERVER['HTTP_HOST']);
	  if ($page_current_name=='http://localhost' || $page_current_name=='127.0.0.1') {
	    $get_page_link = $page_current_name.$path;
	  }
	  else{
	    $get_page_link = $page_current_name;
	  }

	  return $get_page_link;
	}


	function add_media($media_title, $media_description, $media_link){
		global $con;

		$query = mysqli_query($con, "INSERT INTO media SET
			media_title = '$media_title',
			media_description = '$media_description',
			media_link = '$media_link',
			media_created_on = NOW()
		") or die(mysqli_error($con));	

		return $query;
	}


	function query_media_exists($media_link){
		global $con;

		$query = mysqli_query($con, "SELECT *  FROM media WHERE media_link='$media_link'") or die(mysqli_error($con));

		return mysqli_num_rows($query);
	}

	function query_all_media($data = false){
		global $con;

		$query = mysqli_query($con, "SELECT *  FROM media ORDER BY media_id DESC") or die(mysqli_error($con));

		return $data ? $query : mysqli_num_rows($query);
	}



	function query_property_types(){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM property_type");

		return $query;
	}


	function add_property($property_uniq_id,$property_type, $property_name, $property_location, $property_address, $property_file, $property_desc, $property_price, $property_sq_fit, $property_features =NULL, $property_year = NULL,  $property_bedroom = NULL,){
		global $con;

	
		$query = mysqli_query($con, "INSERT INTO property SET
			property_uniq_id = '$property_uniq_id',
			property_type = '$property_type',
			property_name = '$property_name',
			property_location = '$property_location',
			property_address = '$property_address',
			property_file = '$property_file',
			property_desc = '$property_desc',
			property_price = '$property_price',
			property_sq_fit = '$property_sq_fit',
			property_year = '$property_year',
			property_features = '$property_features',
			property_bedroom = '$property_bedroom',
			property_created_on=NOW()
		") or die(mysqli_error($con));	

		return $query;
	}


	function add_installment($installmental_property_id, $installmental_property_duration,  $installmental_property_amount){
		global $con;

		$query = mysqli_query($con, "INSERT INTO installmental_tb SET
			installmental_property_id = '$installmental_property_id',
			installmental_property_duration = '$installmental_property_duration',
			installmental_property_amount = '$installmental_property_amount',
			installmental_created_on = NOW() 
		");

		return $query;
	}


	function query_installmental($installmental_property_id){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM installmental_tb WHERE installmental_property_id='$installmental_property_id'");

		return $query;
	}
	

	function deleteFiles($dir){
   
	    foreach(glob($dir . '/*') as $file){
	        
	        if(is_file($file)){
	            
	            unlink($file);
	        }
	    }

	   rmdir($dir);
	}


	function query_all_property($data=false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM property JOIN property_type on property.property_type=property_type.property_type_id");

		return $data ? $query : mysqli_num_rows($query);
	}



	function query_single_property($property_id, $type, $data = false){

		global $con;

		$query = mysqli_query($con, "SELECT * FROM property JOIN property_type on property.property_type=property_type.property_type_id WHERE $type='$property_id'");

		return $data ? $query : mysqli_num_rows($query);
	}


	/*property_id*/

	function add_events($events_title, $events_desc, $events_venue, $events_date){
		global $con;

		$query = mysqli_query($con, "INSERT INTO events SET
			events_title = '$events_title',
			events_desc = '$events_desc',
			events_venue = '$events_venue',
			events_date = '$events_date',
			events_created_on = NOW()
		") or die(mysqli_error($con));	

		return $query;
	}


	function update_events($events_title, $events_desc, $events_venue, $events_date){
		global $con;

		$query = mysqli_query($con, "UPDATE events SET
			events_title = '$events_title',
			events_desc = '$events_desc',
			events_venue = '$events_venue',
			events_date = '$events_date'
		") or die(mysqli_error($con));	

		return $query;
	}




	function query_all_events($data =false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM events ORDER BY events_id DESC") or die(mysqli_error($con));	
		
		return $data ? $query : mysqli_num_rows($query); 
	}



	function query_single_event($event_id, $data = false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM events WHERE events_id='$event_id'") or die(mysqli_error($con));

		return $data ? $query : mysqli_num_rows($query);
	}


	function add_commissions($commission_property_id, $commission_business_id, $commission_business, $commission_realtors, $commission_marketers){
		global $con;

		$query = mysqli_query($con, "INSERT INTO commissions SET
			commission_property_id = '$commission_property_id',
			commission_business_id = '$commission_business_id',
			commission_business = '$commission_business',
			commission_realtors = '$commission_realtors',
			commission_marketers = '$commission_marketers',
			commission_created_on = NOW()
		") or die(mysqli_error($con));	

		return $query;
	}


	function update_commission($commission_id, $commission_business, $commission_realtors, $commission_marketers){
		
		global $con;

		$query = mysqli_query($con, "UPDATE commissions SET
			commission_business = '$commission_business',
			commission_realtors = '$commission_realtors',
			commission_marketers = '$commission_marketers'
			WHERE commission_id = '$commission_id'
		") or die(mysqli_error($con));	

		return $query;
	}


	function query_single_commission($property_id, $business_id, $data = false){
		global $con;

		$query = mysqli_query($con, "SELECT commissions.*, property.property_name FROM commissions JOIN property ON property.property_id = commissions.commission_property_id WHERE commission_property_id='$property_id' AND commission_business_id='$business_id'");

		return $data ? $query : mysqli_num_rows($query);
	}


	function admin_query_commissions($property_id, $data = false){
		global $con;

		$query = mysqli_query($con, "SELECT commissions.*, company.company_name FROM commissions JOIN company ON company.company_id = commissions.commission_business_id WHERE commission_business_id != 1 AND commission_property_id ='$property_id' ORDER BY commission_id DESC") or die(mysqli_error($con));

		return $data ? $query : mysqli_num_rows($query);
	}


	function agent_registration($agent_privilege_id, $agent_fullname, $agent_email, $agent_password, $agent_phone_number, $agent_address,$agent_profile_photo ,$agent_business_id,  $agent_referral_id, $agent_referred_by_id, $agent_referral_type,$agent_event_id){
		global $con;
		
		$query = mysqli_query($con, "INSERT INTO agents SET
			agent_privilege_id = '$agent_privilege_id',
			agent_fullname = '$agent_fullname',
			agent_email = '$agent_email',
			agent_password = '$agent_password',
			agent_phone_number = '$agent_phone_number',
			agent_address = '$agent_address',
			agent_profile_photo = '$agent_profile_photo',
			agent_business_id = '$agent_business_id',
			agent_referral_id = '$agent_referral_id',
			agent_referral_type = '$agent_referral_type',
			agent_referred_by_id = '$agent_referred_by_id',
			agent_event_id = '$agent_event_id',
			agent_created_on = NOW()
		")or die(mysqli_error($con));	

		return $query;
	}

	function update_agent($agent_fullname, $agent_phone_number, $agent_address, $agent_profile_photo, $agent_bank_name, $agent_account_name, $agent_account_number, $agent_id){
		global $con;

		$query = mysqli_query($con, "UPDATE agents SET
			agent_fullname = '$agent_fullname',
			agent_phone_number = '$agent_phone_number',
			agent_address = '$agent_address',
			agent_profile_photo = '$agent_profile_photo',
			agent_bank_name = '$agent_bank_name',
			agent_account_name = '$agent_account_name',
			agent_account_number = '$agent_account_number'
			WHERE agent_id = '$agent_id'
		")or die(mysqli_error($con));	

		return $query;
	}





	function query_agent_referral($referral_id, $data = false){
		global $con;

		$query = mysqli_query($con, "SELECT company_id FROM company WHERE company_referral_id='$referral_id' ");

		if (mysqli_num_rows($query) == 0) {
			$query = mysqli_query($con, "SELECT agents.agent_id, company.company_id  FROM agents JOIN company ON agents.agent_business_id = company.company_id WHERE agent_privilege_id = 3 AND agent_referral_id='$referral_id' ") or die(mysqli_error($con));
		}

		return $data ? $query : mysqli_num_rows($query);
	}


	function query_event_referral($referral_id, $data = false){
		global $con;

		$query = mysqli_query($con, "SELECT company_id, company_name fullname FROM company WHERE company_event_id='$referral_id' ");

		if (mysqli_num_rows($query) == 0) {
			$query = mysqli_query($con, "SELECT agents.agent_id, agents.agent_fullname fullname, company.company_id  FROM agents JOIN company ON agents.agent_business_id = company.company_id WHERE agent_event_id='$referral_id' ") or die(mysqli_error($con));
		}

		return $data ? $query : mysqli_num_rows($query);
	}


	function query_property_referral($referral_id, $data = false){
		global $con;

		$query = mysqli_query($con, "SELECT company_id, company_name fullname FROM company WHERE company_referral_id='$referral_id' ");

		if (mysqli_num_rows($query) == 0) {
			$query = mysqli_query($con, "SELECT agents.agent_id, agents.agent_fullname fullname, company.company_id  FROM agents JOIN company ON agents.agent_business_id = company.company_id WHERE agent_referral_id='$referral_id' ") or die(mysqli_error($con));
		}

		return $data ? $query : mysqli_num_rows($query);
	}



	function admin_query_business_agents($business_id , $data = false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM agents JOIN privileges ON privileges.privileges_id = agents.agent_privilege_id WHERE agent_business_id ='$business_id' AND agent_referred_by_id ='' ORDER BY agent_id DESC");

		return $data ? $query : mysqli_num_rows($query);

	}	


	function query_total_business_agents($business_id){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM agents WHERE agent_business_id ='$business_id'");

		return mysqli_num_rows($query);
	}




	function admin_query_agent($business_id, $agent_id, $data = false){ 
		global $con;

		$query = mysqli_query($con, "SELECT * FROM agents JOIN privileges ON privileges.privileges_id = agents.agent_privilege_id WHERE agent_business_id ='$business_id' AND agent_id ='$agent_id' ORDER BY agent_id DESC");

		return $data ? $query : mysqli_num_rows($query);
	}	


	function query_realtor_referral($business_id, $realtor_id, $data = false){ 
		global $con;

		$query = mysqli_query($con, "SELECT * FROM agents JOIN privileges ON privileges.privileges_id = agents.agent_privilege_id WHERE agent_business_id ='$business_id' AND agent_referred_by_id ='$realtor_id' ORDER BY agent_id DESC");

		return $data ? $query : mysqli_num_rows($query);
	}	


	function agent_login($email, $password, $data = false){
		
		global $con;

		$query = mysqli_query($con, "SELECT * FROM agents WHERE agent_email='$email' AND agent_password='$password'");

		return $data ? $query : mysqli_num_rows($query);

	}


	function update_agent_password($agent_id,$business_id, $password){
		global $con;

		$query = mysqli_query($con, "UPDATE agents SET
			agent_password = '$password' WHERE agent_id='$agent_id' AND agent_business_id='$business_id' ");

		return $query;
		
	}
	

	function event_reg($event_id, $event_invite_agent_id, $event_invite_business_id, $event_invite_fullname, $event_invite_email, $event_invite_phone_no, $event_invite_gender, $event_invite_address ){
		global $con;

		$query = mysqli_query($con, "INSERT INTO event_invite SET
			event_id='$event_id',
			event_invite_agent_id = '$event_invite_agent_id',
			event_invite_business_id = '$event_invite_business_id',
			event_invite_fullname = '$event_invite_fullname',
			event_invite_email = '$event_invite_email',
			event_invite_phone_no = '$event_invite_phone_no',
			event_invite_gender = '$event_invite_gender',
			event_invite_address = '$event_invite_address',
			event_invite_created_on = NOW()
		") or die(mysqli_error($con));

		return $query;
	}


	function query_event_invitee_exists($email){
		global $con; 

		$query = mysqli_query($con, "SELECT event_invite_email FROM event_invite WHERE event_invite_email ='$email' ")  or die(mysqli_error($con));

		return mysqli_num_rows($query);
	}

	function agent_event_invitee($event_invite_agent_id, $event_invite_business_id, $event_id, $data = false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM event_invite WHERE event_invite_agent_id ='$event_invite_agent_id' AND event_invite_business_id='$event_invite_business_id' AND event_id = '$event_id' ORDER BY 	event_invite_id DESC ");

		return $data ? $query : mysqli_num_rows($query);
	}



	function business_query_event_reg($business_id, $event_id, $data = false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM event_invite LEFT JOIN agents ON agents.agent_id = event_invite.event_invite_agent_id JOIN company ON company.company_id = event_invite.event_invite_business_id WHERE event_invite_business_id='$business_id' AND event_id='$event_id' ");

		return $data ? $query : mysqli_num_rows($query);
	}


	function query_all_event_reg($event_id, $data = false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM event_invite LEFT JOIN agents ON agents.agent_id = event_invite.event_invite_agent_id JOIN company ON company.company_id = event_invite.event_invite_business_id WHERE event_id='$event_id' ");

		return $data ? $query : mysqli_num_rows($query);
	}

	function register_property_purchase($property_buy_agent_id, $property_buy_property_id, $property_buy_business_id,  $buyers_title, $buyers_fullname, $buyers_email,$buyers_phone_number, $buyers_occupation,  $buyers_address, $buyers_dob, $buyers_passport, $buyers_valid_id, $buyers_kin_fullname, $buyers_kin_address, $buyers_kin_relationship, $buyers_kin_phone_number, $property_buy_unit,  $property_buy_payment_structure, $property_buy_amount_paid,  $property_buy_payment_proof ){
		global $con;

		$query = mysqli_query($con, "INSERT INTO property_buy SET
			property_buy_agent_id = '$property_buy_agent_id',
			property_buy_property_id = '$property_buy_property_id',
			property_buy_business_id = '$property_buy_business_id',
			buyers_title = '$buyers_title',
			buyers_fullname = '$buyers_fullname',
			buyers_email = '$buyers_email',
			buyers_phone_number = '$buyers_phone_number',
			buyers_occupation = '$buyers_occupation',
			buyers_address = '$buyers_address',
			buyers_dob = '$buyers_dob',
			buyers_passport = '$buyers_passport',
			buyers_valid_id = '$buyers_valid_id',
			buyers_kin_fullname = '$buyers_kin_fullname',
			buyers_kin_address = '$buyers_kin_address',
			buyers_kin_relationship = '$buyers_kin_relationship',
			buyers_kin_phone_number = '$buyers_kin_phone_number',
			property_buy_unit = '$property_buy_unit',
			property_buy_payment_structure = '$property_buy_payment_structure',
			property_buy_amount_paid = '$property_buy_amount_paid',
			property_buy_payment_proof = '$property_buy_payment_proof',
			property_buy_created_on = NOW()
		") or die(mysqli_error($con));

		return $query;
	}



	function agent_buyers_property_purchase($agent_id, $business_id, $property_buy_id = NULL, $data=false){
		global $con;

		if ($property_buy_id) {
				
		$query = mysqli_query($con, "SELECT * FROM property_buy JOIN property ON property.property_id = property_buy.property_buy_property_id LEFT JOIN installmental_tb ON installmental_tb.installmental_id = property_buy.property_buy_payment_structure WHERE property_buy_agent_id='$agent_id' AND property_buy_business_id='$business_id' AND property_buy_id = '$property_buy_id'");

	}else{

		$query = mysqli_query($con, "SELECT * FROM property_buy JOIN property ON property.property_id = property_buy.property_buy_property_id LEFT JOIN installmental_tb ON installmental_tb.installmental_id = property_buy.property_buy_payment_structure  WHERE property_buy_agent_id='$agent_id' AND property_buy_business_id='$business_id' ORDER BY property_buy_id DESC");
	}

		return $data ? $query : mysqli_num_rows($query);
	}


	function agent_buyers_property_purchase_by_id($property_buy_id,  $data=false){
		global $con;

				
		$query = mysqli_query($con, "SELECT * FROM property_buy JOIN property ON property.property_id = property_buy.property_buy_property_id LEFT JOIN installmental_tb ON installmental_tb.installmental_id = property_buy.property_buy_payment_structure  LEFT JOIN agents ON agents.agent_id = property_buy.property_buy_agent_id LEFT JOIN company ON company.company_id = property_buy.property_buy_business_id  WHERE property_buy.property_buy_id='$property_buy_id'  ") or die(mysqli_error($con));

		return $data ? $query : mysqli_num_rows($query);

	}


	function superadmin_query_buyers_property_purchase($data=false){
		global $con;

				
		$query = mysqli_query($con, "SELECT * FROM property_buy JOIN property ON property.property_id = property_buy.property_buy_property_id LEFT JOIN installmental_tb ON installmental_tb.installmental_id = property_buy.property_buy_payment_structure  LEFT JOIN agents ON agents.agent_id = property_buy.property_buy_agent_id LEFT JOIN company ON company.company_id = property_buy.property_buy_business_id ") or die(mysqli_error($con));

		return $data ? $query : mysqli_num_rows($query);

	}




	function business_buyers_property_purchase($business_id, $data=false){
		global $con;

		$query = mysqli_query($con, "SELECT * FROM property_buy JOIN property ON property.property_id = property_buy.property_buy_property_id LEFT JOIN installmental_tb ON installmental_tb.installmental_id = property_buy.property_buy_payment_structure  LEFT JOIN agents ON agents.agent_id = property_buy.property_buy_agent_id LEFT JOIN company ON company.company_id = property_buy.property_buy_business_id  WHERE property_buy_business_id='$business_id' ORDER BY property_buy_id DESC");

		return $data ? $query : mysqli_num_rows($query);
	}
?>
