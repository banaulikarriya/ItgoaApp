<?php 

/* Declaration of array and default responses */
	$response = 0;
	$message = '';
	$tempArray = array();
	$finalArray = array();
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
	 $username 		=	isset($_DATA->username)	? $_DATA->username : null ;
	 $password 		=	isset($_DATA->password) ? $_DATA->password : null;
	 
   /* End of Declaration of post parameters from application */	
	 
	 /* Decrypt the password */
	 $passwordHash=md5($password);
	 /* End of decryption */
 
 /*  validation for parameters present */	
	if($username&&$password)
 /*  validation for parameters present */			
	{
			
		/* Check this username is registered or not */
        $qry = "SELECT * FROM users WHERE email='$username' AND password='$passwordHash'";
		$exe = $database->query($qry);		
	    if($database->num_rows($exe)>0){

			//generate the token
			$token = generateRandomString();
			$qryUpdateDeviceToken 	=	"update users set token= '$token' where email= '$username'";
			$database->query($qryUpdateDeviceToken);	

	    	while($fetchInfo = $database->fetch($exe)){
	    		$tempArray['first_name'] = $fetchInfo['first_name'];
	    		$tempArray['last_name'] = $fetchInfo['last_name'];
	    		$tempArray['image_url'] = $fetchInfo['image_url'];
				$tempArray['email'] = $fetchInfo['email'];
				$tempArray['contact'] = $fetchInfo['contact'];
				$tempArray['id'] = $fetchInfo['id'];
				$tempArray['token'] = $fetchInfo['token'];
				array_push($finalArray,$tempArray);
	    	}

				/* Return the successfull response */
                $responseArray['message'] = "Logged in successfully";
                $responseArray['response'] = '1'	;
                $responseArray['data'] = $finalArray;
				/* End of Return the successfull response */
	      }
		/* Condition for email id and password not match */
	    else{

	    	$responseArray['data'] = [];
            $responseArray['response'] = '0'	;
            $responseArray['message'] = "Incorrect username and password";
	    }		
		/* End of Condition for email id and password not match */
				
	}
	else
	{
		$responseArray['data'] = [];
        $responseArray['response'] = '0'	;
        $responseArray['message'] = "Please specify the correct parameters";
	}
/* End Condition and response for app is missed any parameters */
	
	function generateRandomString($length = 32) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

  ?>