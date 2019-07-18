<?php
/*
define('Host', 	'localhost');
define('DBName','loginsystem');
define('DBUserID','mark2');
define('DBUserPassword','admin123');
*/
define('Host',  'localhost');
define('DBName','nodejs');
define('DBUserID','root');
define('DBUserPassword','');
function DBConnect()
{ 
  /*
  * This will allow you to connect to the database
  */
  $host     = Host;
  $database = DBName;
  $user     = DBUserID;
  $pass     = DBUserPassword;
  // Create connection
  $connection = mysqli_connect($host, $user, $pass,$database);
  // Check connection
  if (!$connection) 
  {
  	//echo ("conasfasdfas");
  	die("Connection failed: " . mysqli_connect_error());
    return false;
  }
  if($connection)
  {
   	//echo ("connedted");
    return $connection;
  }
}
function DBConClose($con)
{
	/* 
	* This will close the database connection
	*/
	// Get thread id
	$t_id=mysqli_thread_id($con);
	//close current connection
	mysqli_close($con);
	// Kill connection
	mysqli_kill($con,$t_id);    
}
function CleanDBData($Data)
{
	/*
	* This will help in preventing sql injections
	*/
	// Create connection
	$con =  DBConnect();  
	$str = mysqli_real_escape_string($con,$Data); 
	return $str;
	//Close the current connection to the database
	DBConClose($con);     
} 
function CleanHTMLData($Data)
{
  /*
  * This will remove all HTML tags
  */
  // Create connection
  $con =  DBConnect();  
  $str = mysqli_real_escape_string($con,$Data);
	$result = preg_replace('/(?:<|&lt;)\/?([a-zA-Z]+) *[^<\/]*?(?:>|&gt;)/', '', $str) ;
  return $result;
  //Close the current connection to the database
  DBConClose($con);     
}  
/*
	Different 4 types of queries
	- Select (QGetRows) - all rows
	- Insert - add row(s)
	- Update - will update a field
	- Delete - will delete row(s)
*/
function QGetRows($SQLStatement)
{
	/*
	* This will get all of the rows from the table.  
	* Call it like - $Qry = QGetRows( "SELECT * FROM Users WHERE site='codewithmark'")  
	*/
	// Create connection
	$con =  DBConnect();
	// Check connection
	if (!$con) 
	{
		die("Connection failed in QGetRows function - " . mysqli_connect_error());
	}
	// Connection is made
	if ($con) 
	{
		//$SQLStatement = "SELECT * FROM UserProfile WHERE user_id='markkumar'"; 
		$q = $con->query($SQLStatement);
	    $row = $q->num_rows;
	    //now rows found
	    if($row <1)
	    {
	      $result = $row;  
	    }
		//only one row of data
		else if($row == 1)
		{
			$result = array($q->fetch_assoc());
		}
		//multiple rows
		else if( $row >1)
		{
			$d1 = array( $q->fetch_assoc());
			$d2= array();
			while ($row = $q->fetch_assoc()) 
			{
				$d2[] = $row;
			}
			//merger array to get all rows
			$result = array_merge($d1 , $d2);	
		}
		//Will return a row data
		return $result;
		//This will clear query cache
		mysqli_free_result($result);
		//Close the current connection to the database
		DBConClose($con);
  	}
}
function QInsert($TableName,$row_arrays = array() ) 
{ 
	/*
		$insert_arrays[] = array
		(
				'user_acc_id' => "multiple_updated value now",
				'pod_id' => $GetUniqueFileName,
			'pod_title'=>'pod_title'
		);
		Call it like this:
		QInsert('table',$insert_arrays);
		If ran successfully, it will return the insert id else 0
	*/
	// Setup arrays for Actual Values, and Placeholders
	$values = array();
	$place_holders = array();
	$query = "";
	$query_columns = "";
	$query .= "INSERT INTO {$TableName} (";
    foreach($row_arrays as $count => $row_array)
    {
        foreach($row_array as $key => $value) 
        {
            if($count == 0) 
            {
                if($query_columns) 
                {
                	$query_columns .= ",".$key."";		                    	
                } 
                else 
                {
                	$query_columns .= "".$key."";
                }
            }
            $values[] =  $value;
            if(is_numeric($value)) 
            {
                if(isset($place_holders[$count])) 
                {
                	$place_holders[$count] .= ", '$value'";
                } 
                else 
                {
                	$place_holders[$count] = "( '$value'";
                }
            } 
            else 
            {
                if(isset($place_holders[$count])) 
                {
                	$place_holders[$count] .= ", '$value'";
                } 
                else 
                {
                	$place_holders[$count] = "( '$value'";
                }
            }
        }
            // mind closing the GAP
            $place_holders[$count] .= ")";
    }
	$query .= " $query_columns ) VALUES ";
	$query .= implode(', ', $place_holders);
	$sql = $query; 
	$con =  DBConnect();
	// Check connection
	if (!$con) 
	{
		die("Connection failed in query function - " . mysqli_connect_error());
	}
	if($con)
	{
		$q = $con->query($sql);
		if(!$q)
		{
		  //$result = false;
		  //$result = "Error: "  . mysqli_error($con);
		  $result =  0;
		}
		if($q)
		{
		  //Will give the last inserted id
		  $result =  $con->insert_id;
		}
		return $result;
		//Close the current connection to the database
		DBConClose($con); 
	}
}
function Qry($SQLStatement)
{
  /*
  * This is for genearl purpose query. 
  * If it ran successfully, it will return 1 else 0.
  */
  // Create connection
  $con =  DBConnect();
  // Check connection
  if (!$con) 
  {
    die("Connection failed in query function - " . mysqli_connect_error());
  }
  if($con)
  {
    $q = $con->query($SQLStatement);
    if(!$q)
    {
      //$result = false;
      $result = 0;
    }
    if($q)
    {       
      //$result = true;
      $result = 1;
    }
    return $result;
    //Close the current connection to the database
    DBConClose($con);
  }
}
function QDelete($strTableName,$strFieldName,$strFieldDeleteValueEqualTo)
{
  /*
  * This will delete all rows where field name equals delete value. 
  * If it ran successfully, it will return 1 else 0
  */
  // Create connection
  $con =  DBConnect();
  // Check connection
  if (!$con) 
  {
    die("Connection failed in query function - " . mysqli_connect_error());
  }
  //check to see if the record exist
  $QFindRec = "SELECT * FROM $strTableName WHERE $strFieldName='$strFieldDeleteValueEqualTo'";
  if($con)
  {
    $q = $con->query($QFindRec);
    if($q->num_rows > 0 )
    {
      //found the record and now delete it
      $QDeleteRec = "DELETE FROM $strTableName WHERE $strFieldName='$strFieldDeleteValueEqualTo'";
      $con->query($QDeleteRec);
      $result = 1;
    }
    if($q->num_rows < 1)
    {   
      $result = 0;
    }
    return $result; 
    //Close the current connection to the database
    DBConClose($con); 
  }
}
function QTotalRows($SQLStatement)
{
  /*
  * This will get/return total rows based on the sql statement  
  */
  // Create connection
  $con =  DBConnect();
  // Check connection
  if (!$con) 
  {
    die("Connection failed in query function - " . mysqli_connect_error());
  }
  //$SQLStatement = "SELECT * FROM $strTableName WHERE $strFieldName='$strFieldCheckName'";
  if($con)
  {
    $q = $con->query($SQLStatement);
    return $q->num_rows ;
    //This will clear query cache
    mysqli_free_result($result);
    //Close the current connection to the database
    DBConClose($con); 
  }
}
function QRecValue($strTableName,$strFieldName,$strFieldCheckName,$strGetFieldValue)
{
  /*
  * This will look up and return the field value of a record
  * If it ran successfully, it will reture the field value
  */
  // Create connection
  $con =  DBConnect();
  // Check connection
  if (!$con) 
  {
    die("Connection failed in query function - " . mysqli_connect_error());
  }
  $SQLStatement = "SELECT * FROM $strTableName WHERE $strFieldName='$strFieldCheckName'";
  if($con)
  {
    $q = $con->query($SQLStatement);
    if($q->num_rows < 1)
    {
      $result = 0;
    }
    if($q->num_rows >0 )
    {       
      //$row = mysqli_num_rows($q);
			while($row = $q->fetch_assoc()) 
			{
				$data =  $row[$strGetFieldValue];
			}
      $result = $data;
    }
    return $result;
    //This will clear query cache
    mysqli_free_result($result);
    //Close the current connection to the database
    DBConClose($con); 
  }
} 
function QUpdate($strTableName, $array_fields, $array_where)
{ 
  /*
  * This will update the row values
  * If it ran successfully, it will return 1 else 0
  * 
    $strTableName = "TableName"
    $array_fields = array(
      'FieldName1' => FieldValue1,
      'FieldName2' => FieldValue2,
      'FieldName3' => FieldValue3,
    );
    $array_where = array(    
      'rec_id' => 2,
      'rec_dt' => date("Y-m-d"),    
    );
    Call it like this:  QUpdate($strTableName, $array_fields, $array_where)
  * 
  */
  //Get the update fields and value
  foreach($array_fields as $key=>$value) 
  {
    if($key) 
    {
      $field_update[] = " $key='$value'";
    }
  }
  $fields_update = implode( ',', $field_update );
  //Get where fields and value
  foreach($array_where as $key=>$value) 
  {
    if($key) 
    {
      $field_where[] = " $key='$value'";
    }
  }
  $fields_where = implode( ' and ', $field_where );
  $SQLStatement = "UPDATE $strTableName  SET $fields_update WHERE $fields_where ";
	$con =  DBConnect();
	// Check connection
	if (!$con) 
	{
		die("Connection failed in query function - " . mysqli_connect_error());
	}
	if($con)
	{
		$q = $con->query($SQLStatement);
		if(!$q)
	    {
	      $result =  0;
	    }
	    if($q)
	    {  
	      $result = 1;
	    }
	    return $result;
	    //Close the current connection to the database
	    DBConClose($con); 
	}
}
?>