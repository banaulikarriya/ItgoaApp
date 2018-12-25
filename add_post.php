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
$name   =	isset($_REQUEST['name']) ? $_REQUEST['name'] : null ;
$category  		 =	isset($_REQUEST['category']) ? $_REQUEST['category'] : null ;
$text_details  		 =	isset($_REQUEST['text_details']) ? $_REQUEST['text_details'] : null ;	
$location  		 =	isset($_REQUEST['location']) ? $_REQUEST['location'] : null ;	
/* End of Declaration of post parameters from application */		


/*  validation for Null values */		
if(($user_id&&$name&&$category && $text_details && $location) && ($user_id!= 'Null' && $name != 'Null' && $category != 'Null' && $text_details != 'Null' && $location != 'Null'))		
{

		$qry ="INSERT INTO place (user_id,name,category,text_details,location) 
		VALUES('$user_id','$name','$category','$text_details','$location')";

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