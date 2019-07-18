<?php

error_reporting(0);

include_once('db_class.php'); 

// define('FromName','Code With Mark');
// define('FromEmail','info@codewithmark.com');

// define('DownloadPageURL','download.php');

$SiteURLLocal =  "http://localhost" . dirname($_SERVER['PHP_SELF']); 
//Will replace any backward slashes with forward ones
$RootSiteURLPath = str_replace('\\', '/', $SiteURLLocal); 
define('SiteRootDir', $RootSiteURLPath); 


// $db_conn = array(
// 	'host' => 'localhost', 
// 	'user' => 'root',
// 	'pass' => ';(ejB_E39sd^q#x',
// 	'database' => 'lion_royal', 
// 	); 
$db_conn = array(
	'host' => 'localhost', 
	'user' => 'root',
	'pass' => '',
	'database' => 'lion_sport', 
); 

$db = new SimpleDBClass($db_conn);

?>