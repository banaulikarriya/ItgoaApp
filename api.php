<?php 

	require_once('lib/initialize.php');
	require_once("Rest.inc.php");	
	class API extends REST {

		private $responseArray = array();	 
		private $funcName ;
		private $extension ;
		private $database;
		public function __construct($database){
			parent::__construct();				// Init parent contructor
			$this->extension = ".php" ;
			$this->database = $database;
		}
		public function processApi(){
			// $func = strtolower(trim(str_replace("/","",$_REQUEST['request'])));	
				 
			$request =$_REQUEST['request'];

			$requestData = array();
			// seperate out all / seperated attributes 
			$requestData = explode('/', $request);
			$func = $requestData[0];
			unset($requestData[0])	;
			if($_REQUEST['request']!='images')
			{
				unset($_REQUEST['request']);	
			}			
			// form an get request from request uri
				for ($i=2; $i <= count($requestData) ; $i=$i+2) { 
					 $_REQUEST[$requestData[$i-1]]	=	$requestData[$i];
				} 
				if(isset($_POST['fbProfilePic']))
					$_REQUEST['profilePic'] = $_POST['fbProfilePic'];
				if(isset($_POST['fbCoverPic']))
					$_REQUEST['coverPic'] = $_POST['fbCoverPic'];
				if(isset($_POST['image']))
					$_REQUEST['image'] = $_POST['image'];
				
				
			$this->funcName = $func;
			if((int)method_exists($this,$func))
				$this->$func();
			else
				$this->response('',404);				// If the method not exist with in this class, response would be "Page not found".
		}

			/* Function for create the URL with the file name */ 
		    private function user_signup()
			{
				$this->callEverything();			
			}
			private function user_login()
			{
				$this->callEverything();			
			}
			private function ImageUpload()
			{
				$this->callEverything();			
			}
			private function add_business()
			{
				$this->callEverything();			
			}
			private function business_details()
			{
				$this->callEverything();			
			}
			private function businessUpload()
			{
				$this->callEverything();			
			}
			private function product_details()
			{
				$this->callEverything();			
			}
				
		/*
		* function forms the file name 
		* in order to  make easy file name and function anem are kept same 		 
		*/
		private function formFile()
		{
			return $this->funcName.$this->extension;
		}
		/*
		*  call everything includes the file if it exists this file contains code for that perticular functionality 
		*/
		private function callEverything(){
			$database =$this->database;
			include_once($this->formFile());
			$this->json($responseArray);
		}
		/*
		 *	Encode array into JSON
		*/
		private function json($data){
			if(is_array($data)){
				// return json_encode($data);
				 print_r(json_encode($data,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
				$this->response('',200);
				exit(1);
			}
		}
	}
	
	// Initiiate Library
	
	$api = new API($database);
	$api->processApi();

 

 ?>

