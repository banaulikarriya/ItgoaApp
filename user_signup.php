<?php 
/* Declaration of array and default responses */
$responseArray 	=	array();
$response 		=	0;
$userfound		=	0;
$message		=	'';
$userId			=	0;
$flag = 0;
/* End of Declaration of array and default responses */	

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
	// Extract the data.
	$_DATA = json_decode($postdata);
}else{

	// Extract the data.
	$_DATA = [];
}

/* Declaration of post parameters from application */	
$password 	     =	isset($_DATA->password) ? $_DATA->password : null ;
$first_name  		     =	isset($_DATA->first_name) ? $_DATA->first_name : null ;
$last_name  		     =	isset($_DATA->last_name) ? $_DATA->last_name: null ;
$email 	     =	isset($_DATA->email) ? $_DATA->email : null;
$contact 	  		 =	isset($_DATA->contact) ? $_DATA->contact : null;		
//$device_token 	 =	isset($_REQUEST['device_token']) ? $_REQUEST['device_token'] : null;	
//$fcm_id 	     =	isset($_REQUEST['fcm_id']) ? $_REQUEST['fcm_id'] : null;	
/* End of Declaration of post parameters from application */		


/*  validation for Null values */		
if(($first_name&&$last_name&&$password&&$contact&&$email) && ($first_name!= 'Null' &&$last_name != 'Null' && $password != 'Null' && $contact != 'Null' && $email!= 'Null'))			 
{

	/* Check that user is already registered or not */

	if($email){
		$qryEmailId = "SELECT id FROM users WHERE email='$email'";
		$exeEmailId = $database->query($qryEmailId);
		$getEmailId = $database->fetch($exeEmailId);
		$gotUserId = $getEmailId['id'];
		if($database->num_rows($exeEmailId)>0){
			$responseArray['message']	= "This email is already registered";
			$responseArray['response'] 	=	0;	
			$responseArray['userId']	= $gotUserId;
			$flag = 1;
		}
	}
	if($contact){
		$qryEmailId = "SELECT id FROM users WHERE contact='$contact'";
		$exeEmailId = $database->query($qryEmailId);
		$getEmailId = $database->fetch($exeEmailId);
		$gotUserId = $getEmailId['id'];
		if($database->num_rows($exeEmailId)>0){
			$responseArray['message']	= "This contact number is already registered";
			$responseArray['response'] 	=	0;	
			$responseArray['userId']	= $gotUserId;
			$flag = 1;
		}
	}

	if($flag == 0){
		$password=md5($password);
		$qrySignUp ="INSERT INTO users (first_name,last_name ,password,contact,email) 
		VALUES('$first_name','$last_name','$password','$contact','$email')";

		$database->query($qrySignUp);
		
		if($database->affected_rows())
		{ 	 
			$uid = $database->insert_id($qrySignUp);
			$responseArray['message']	= "Signed up successfully";
			$responseArray['response'] 	=	1;	
			$responseArray['userId']	= $uid;
		}
		else
		{

			$responseArray['message']	= "Sign up failed";
			$responseArray['response'] 	=	0;	
			$responseArray['userId']	= "";
		}
	}
}
else
{

	$responseArray['message']	= "Please specify the correct parameters";
	$responseArray['response'] 	=	0;	
	$responseArray['userId']	= "";
}
/* End Condition and response for app is missed any parameters */

?>