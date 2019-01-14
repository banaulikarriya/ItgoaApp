<?php

$responseArray  =   array();
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {

 $ImageData = $_REQUEST['image'];
 $ImageName = $_REQUEST['image_name'];
 $business_id   = $_REQUEST['business_id'];

 $ImagePath = "business/$ImageName";
 $ServerURL = "http://bollywood-game.000webhostapp.com/ITGoaApp_api/$ImagePath";


 	if($user_id && $empcode){
 
	     $qry 	=	"UPDATE business SET business_img='$ServerURL' WHERE id='$business_id'";
		 $database->query($qry);
		 if($database->affected_rows() > 0)
		 { 

		 	//code to move in folder images
		     if(file_put_contents($ImagePath,base64_decode($ImageData))){

		        $responseArray['message']    = "Successfully uploaded";
		        $responseArray['response']   =   1; 

		     } 
		     else{ 

		        $responseArray['message']    = "There was an error uploading the file, please try again!";
		        $responseArray['response']   =   0;
		     } 
	     }
	 }
	 else{

	        $responseArray['message']    = "Parameter business_id is missing!";
	        $responseArray['response']   =   0;

	 }
 }
 
 

