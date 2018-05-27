<?php 
/* Declaration of array and default responses */
$responseArray 	=	array();
$response 		=	0;
$userfound		=	0;
$message		=	'';
$userId			=	0;
$flag = 0;
/* End of Declaration of array and default responses */	


/* Declaration of post parameters from application */	
$password 	     =	isset($_REQUEST['password']) ? $_REQUEST['password'] : null ;
$first_name  		     =	isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : null ;
$middle_name  		     =	isset($_REQUEST['name']) ? $_REQUEST['middle_name'] : null ;
$last_name  		     =	isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : null ;
$phone 	     =	isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;	
$email_id 	     =	isset($_REQUEST['email_id']) ? $_REQUEST['email_id'] : null;
$dob 	  		 =	isset($_REQUEST['dob']) ? $_REQUEST['dob'] : null;	
$image_url 	  	 =	isset($_REQUEST['image_url']) ? $_REQUEST['image_url'] : null;		
//$device_token 	 =	isset($_REQUEST['device_token']) ? $_REQUEST['device_token'] : null;	
//$fcm_id 	     =	isset($_REQUEST['fcm_id']) ? $_REQUEST['fcm_id'] : null;	
/* End of Declaration of post parameters from application */		


/*  validation for Null values */		
if(($first_name&&$last_name&&$password&&$phone&&$email_id) && ($first_name!= 'Null' &&$last_name != 'Null' && $password != 'Null' && $phone != 'Null' && $email_id != 'Null'))			 
{

	/* Check that user is already registered or not */

	if($email_id){
		$qryEmailId = "SELECT id FROM users WHERE email_id='$email_id'";
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
	if($phone){
		$qryEmailId = "SELECT id FROM users WHERE phone='$phone'";
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
		$qrySignUp ="INSERT INTO users (first_name,middle_name,last_name ,password,phone,email_id,dob,image_url) 
		VALUES('$first_name','middle_name','last_name','$password','$phone','$email_id','$dob','$image_url')";

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