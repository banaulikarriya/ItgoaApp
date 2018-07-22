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
$user_id 	     =	isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null ;
$business_name   =	isset($_REQUEST['business_name']) ? $_REQUEST['business_name'] : null ;
$category  		 =	isset($_REQUEST['category']) ? $_REQUEST['category'] : null ;
$email  		 =	isset($_REQUEST['email']) ? $_REQUEST['email'] : null ;	
$contact  		 =	isset($_REQUEST['contact']) ? $_REQUEST['contact'] : null ;	
/* End of Declaration of post parameters from application */		


/*  validation for Null values */		
if(($user_id&&$business_name&&$category && $email && $contact) && ($user_id!= 'Null' &&$business_name != 'Null' && $category != 'Null' && $email != 'Null' && $contact != 'Null'))		
{

		$qry ="INSERT INTO business (user_id,business_name,category,email,contact) 
		VALUES('$user_id','$business_name','$category','$email',$contact)";

		$database->query($qry);
		
		if($database->affected_rows())
		{ 	 
			$id = $database->insert_id($qry);
			$responseArray['message']	= "business added successfully";
			$responseArray['response'] 	=	1;	
			$responseArray['business_id']	= $id;
		}
		else
		{

			$responseArray['message']	= "business added failed";
			$responseArray['response'] 	=	0;	
			$responseArray['userId']	= "";
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