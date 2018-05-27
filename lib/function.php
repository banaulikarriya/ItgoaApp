<?php 

	function validateEmail($email)
	{
		return filter_var($email,FILTER_VALIDATE_EMAIL);
	}
	function encrypt($password)
	{
		return(md5($password));
	}

	function  set_date()
	{
		$timeZone = date_default_timezone_get();
		date_default_timezone_set($timeZone);
	}
	function get_date()
	{
		set_date();
		$date = date('Y-m-d h:i:s');
		return $date ;
	}
 ?>