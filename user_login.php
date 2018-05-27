<?php 
/* Declaration of array and default responses */
	$response = 0;
	$message = '';
	$tempArray = array();
	$finalArray = array();
   /* End of Declaration of array and default responses */
   
   /* Declaration of post parameters from application */	

	 $username 		=	isset($_REQUEST['username'])	?$_REQUEST['username'] : null ;
	 $password 		=	isset($_REQUEST['password'])?$_REQUEST['password'] : null;
	 
   /* End of Declaration of post parameters from application */	
	 
	 /* Decrypt the password */
	 $passwordHash=md5($password);
	 /* End of decryption */
 
 /*  validation for parameters present */	
	if($username&&$password)
 /*  validation for parameters present */			
	{
			
		/* Check this username is registered or not */
        $qry = "SELECT * FROM users WHERE (email_id='$username' OR phone='$username') AND password='$passwordHash'";
		$exe = $database->query($qry);		
	    if($database->num_rows($exe)>0){

	    	while($fetchInfo = $database->fetch($exe)){
	    		$tempArray['first_name'] = $fetchInfo['first_name'];
	    		$tempArray['middle_name'] = $fetchInfo['middle_name'];
	    		$tempArray['last_name'] = $fetchInfo['last_name'];
	    		$tempArray['dob'] = $fetchInfo['dob'];
	    		$tempArray['image_url'] = $fetchInfo['image_url'];
				$tempArray['email_id'] = $fetchInfo['email_id'];
				$tempArray['phone'] = $fetchInfo['phone'];
				$tempArray['id'] = $fetchInfo['id'];
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

	    	$responseArray['data'] = "Incorrect username and password";
            $responseArray['response'] = '0'	;
            $responseArray['message'] = 'Failure';
	    }		
		/* End of Condition for email id and password not match */
				
	}
	else
	{
		$responseArray['data'] = "Please specify the correct parameters";
        $responseArray['response'] = '0'	;
        $responseArray['message'] = 'Failure';
	}
/* End Condition and response for app is missed any parameters */
	


  ?>