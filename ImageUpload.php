<?php

$responseArray  =   array();
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {

 $ImageData = $_POST['image'];
 $ImageName = $_POST['image_name'];
 $user_id   = $_POST['user_id'];

 $ImagePath = "images/$ImageName";
 $ServerURL = "http://bollywood-game.000webhostapp.com/ITGoaApp_api/$ImagePath";


 	if($user_id && $empcode){
 
	     $qry 	=	"UPDATE users SET image_url='$ServerURL' WHERE user_id='$user_id'";
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

	        $responseArray['message']    = "Parameter Userid is missing!";
	        $responseArray['response']   =   0;

	 }
 }
 
 

