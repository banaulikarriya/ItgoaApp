<?php 
class MySQLDatabase{
	private $connection;
	public $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;
	
	function __construct()
	
	{	$this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists( "mysqli_real_escape_string" );
	}
	

	public function open_connection()
	{
		$this->connection=mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME) ;
		mysqli_set_charset($this->connection,"utf8");
		if(!$this->connection)
		 {
			 die("database connecetion failed".mysqli_error($this->connection));
			 exit();
		 }
		 
	}

	public function close_connection()
	{
		if(isset($this->connection))
		{
			mysqli_close($this->connection);
			unset($this->connection);
		}
	}

	public function fetch($result_set)
	{

		return mysqli_fetch_array($result_set);

	}

		// public function fetchall($result_set)
	// {

		// return mysqli_fetch_all($result_set);

	// }
			public function fetch_assoc($result_set)
	{

		return mysqli_fetch_assoc($result_set);

	}

	
	public function query($sql)
	{
			 
	  $this->last_query=$sql;
 		
 		// print_r($sql) ;
 		// print_r("</br>");
	  $result=$this->connection->query($sql);

	    if(!$result)
	    {
	    	die("database query failed ".mysqli_error($this->connection));
	    }
	    return $result;
	}

	public function num_rows($result)
	{
		return $result->num_rows;

	}

	public function insert_id()
	{
		return $this->connection->insert_id;
	}

	public function affected_rows()
	{
		return $this->connection->affected_rows;
	}

	public function prepare($query)
	{
		return $this->connection->prepare($query);
	}

	public function bind_param($key,$value)
	{
	  return $this->bind_param($key,$value);
	}

	public function execute($params= array(''))
	{
		return $this->execute($params);
	}

	public function use_result()
	{
		return mysqli_use_result($this->connection);	
	}

	public function next_result()
	{
		return mysqli_next_result();
	}

	public function free_result($result)
	{
		return mysqli_free_result($result);
		// return $this->free_result($result);
	}

	public function fetch_prepare()
	{
		return $this->fetch();
	}



	public function escape_value( $value ) {
		if( $this->real_escape_string_exists ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $this->magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysqli_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}
}
$database=new MySQLDatabase();
?>