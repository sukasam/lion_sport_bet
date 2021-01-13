<?php
 include_once("../../function/cpanel/app_top.php");
 include_once("../../_inc/config.php"); 
 include_once("../../_inc/model.php"); 
 include_once("../../function/poker_api.php");
 

 /* Database connection start */

$conn = mysqli_connect($db_conn['host'], $db_conn['user'], $db_conn['pass'], $db_conn['database']) or die("Connection failed: " . mysqli_connect_error());
 
 // storing  request (ie, get/post) global array to a variable  
 $requestData= $_REQUEST;
 
 
 $columns = array( 
 // datatable column index  => database column name
 0 => 'id',
   1 =>'Player', 
   2=> 'Email',
   3=> 'Telephone',
   4=> 'DBalance',
   5=> 'CBalance',
 );
 
 // getting total number records without any search
 $sql = "SELECT *";
 $sql.=" FROM user_profile";
 $query=mysqli_query($conn, $sql) or die("user_unaccount_ajax.php: get user_profile");
 $totalData = mysqli_num_rows($query);
 $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
 
 
 $sql = "SELECT *";
 $sql.=" FROM user_profile WHERE 1=1 AND uactive = '0'";
 if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
   $sql.=" AND ( Player LIKE '".$requestData['search']['value']."%' ";    
   $sql.=" OR Email LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR Telephone LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR DBalance LIKE '".$requestData['search']['value']."%' ";
   $sql.=" OR CBalance LIKE '".$requestData['search']['value']."%' )";

 }
 $query=mysqli_query($conn, $sql) or die("user_unaccount_ajax.php: get user_profile");
 $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
 $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
 /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
 $query=mysqli_query($conn, $sql) or die("user_unaccount_ajax.php: get user_profile");
 
 $data = array();
 while( $row=mysqli_fetch_array($query) ) {  // preparing an array

   $nestedData=array(); 
 
   $nestedData[] = $row["Player"];
   $nestedData[] = $row["Email"];
   $nestedData[] = $row["Telephone"];
   $nestedData[] = number_format($row["DBalance"]);
   $nestedData[] = number_format($row["CBalance"]);
   //$nestedData[] = "<center class=\"btAction\"><button class=\"btn btn-primary btn-xs\" title=\"Edit\" onClick=\"window.location='user_unaccount_edit.php?Player=".$row["Player"]."'\"><i class=\"fa fa-pencil\"></i></button><button class=\"btn btn-warning btn-xs\" title=\"Balance\" onClick=\"window.location='user_unaccount_balance.php?Player=".$row["Player"]."';\"><i class=\"fa fa-btc\"></i></button><button class=\"btn btn-success btn-xs\" title=\"Bank Info\" onClick=\"window.location='user_unaccount_bank.php?Player=".$row["Player"]."';\"><i class=\"fa fa-building-o\"></i></button><button class=\"btn btn-info btn-xs\" title=\"Invite\" onClick=\"window.location='user_unaccount_invite.php?Player=".$row["Player"]."';\"><i class=\"fa fa-users\"></i></button></center>";
   $nestedData[] = "<center class=\"btAction\"><button class=\"btn btn-primary btn-xs\" title=\"Edit\" onClick=\"window.location='user_unaccount_edit.php?Player=".$row["Player"]."'\"><i class=\"fa fa-pencil\"></i></button></center>";

   $data[] = $nestedData;
 }
 
 
 
 $json_data = array(
       "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
       "recordsTotal"    => intval( $totalData ),  // total number of records
       "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
       "data"            => $data   // total data array
       );
 
 echo json_encode($json_data);  // send data as json format
 
 ?>