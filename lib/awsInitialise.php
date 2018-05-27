<?php 
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJUESPQ6SPJ2EKYNA');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
 	$bucket = "profitkey";
	$s3 = new S3(awsAccessKey, awsSecretKey);
 ?>