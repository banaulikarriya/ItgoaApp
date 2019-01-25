<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
/* Declaration of array and default responses */
	$response = 0;
	$message = '';
	$tempArray = array();
	$finalArray = array();
/* End of Declaration of array and default responses */


/* Fetch details from DB */
$qryGetLikers = "SELECT * FROM place";
$exeGetLikers=$database->query($qryGetLikers);

while($fetchInfo = $database->fetch($exeGetLikers)){

                $tempArray['id'] = (int)$fetchInfo['id'];
                $tempArray['user_id'] = $fetchInfo['user_id'];
                $tempArray['name'] = $fetchInfo['name'];
                $tempArray['location'] = $fetchInfo['location'];
                $tempArray['category'] = $fetchInfo['category'];
                $tempArray['text_details'] = $fetchInfo['text_details'];
                $tempArray['created'] = $fetchInfo['created'];
                array_push($finalArray,$tempArray);
        }

/* End of Fetch details from DB */

/* Check DB details is returning some values */
  if($finalArray != Null)
 {

    $responseArray['message'] = "Success";
	$responseArray['response'] = 1;
	$responseArray['data'] = $finalArray;
 }
 /* End of Check DB details is returning some values */

 /* Check DB details is not returning any values */
 else if($finalArray == Null)
 {

				$responseArray['message'] = 'Failure';
				$responseArray['response'] = 0;
				$responseArray['data'] = "No records found";
 }
/* End of Check DB details is not returning any values */
 ?>