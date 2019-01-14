<?php 
/* Declaration of array and default responses */
$responseArray 	=	array();
$response 		=	0;
$userfound		=	0;
$message		=	'';
$userId			=	0;
$flag = 0;
/* End of Declaration of array and default responses */	

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
/* Declaration of post parameters from application */	
$business_id 	     =	isset($_REQUEST['business_id']) ? $_REQUEST['business_id'] : null ;
$product_name        =	isset($_REQUEST['product_name']) ? $_REQUEST['product_name'] : null ;
$description  		 =	isset($_REQUEST['description']) ? $_REQUEST['description'] : null ;
$ImageData  		 =	isset($_REQUEST['img_data']) ? $_REQUEST['img_data'] : null ;	
$ImageName  		 =	isset($_REQUEST['img_name']) ? $_REQUEST['img_name'] : null ;	

/* End of Declaration of post parameters from application */		
 $ImagePath = "products/$ImageName";
 $ServerURL = "http://bollywood-game.000webhostapp.com/ITGoaApp_api/$ImagePath";
/*  validation for Null values */		
	if(($business_id&&$product_name&&$description && $ImageData) && ($business_id!= 'Null' &&$product_name != 'Null' && $description != 'Null' && $ImageData != 'Null'))		
	{
			//code to move in folder images
		     if(file_put_contents($ImagePath,base64_decode($ImageData))){

				    $qry ="INSERT INTO  product_details (business_id,product_name,description,image) 
					VALUES('$business_id','$product_name','$description','$ServerURL')";

					$database->query($qry);
					
					if($database->affected_rows())
					{ 	 
						$id = $database->insert_id($qry);
						$responseArray['message']	= "product added successfully";
						$responseArray['response'] 	=	1;	
						$responseArray['business_id']	= $id;
					}
					else
					{

						$responseArray['message']	= "product added failed";
						$responseArray['response'] 	=	0;	
						$responseArray['userId']	= "";
					}

		     }
		     else{
		     	$responseArray['message']	= "Image upload failed";
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
}
/* End Condition and response for app is missed any parameters */

?>