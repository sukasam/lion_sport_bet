<?php

error_reporting(0); 
include_once('db_class.php'); 

// define('FromName','Code With Mark');
// define('FromEmail','info@codewithmark.com');

// define('DownloadPageURL','download.php');

$SiteURLLocal =  "http://" .$_SERVER["HTTP_HOST"]. dirname($_SERVER['PHP_SELF']); 
//Will replace any backward slashes with forward ones
$RootSiteURLPath = str_replace('\\', '/', $SiteURLLocal); 
define('SiteRootDir', $RootSiteURLPath); 

// $db_conn = array(
// 	'host' => 'localhost', 
// 	'user' => 'id9537812_lion',
// 	'pass' => 'HMu6tjvyhBVx',
// 	'database' => 'id9537812_lion', 
// ); 

$db_conn = array(
	'host' => 'localhost', 
	'user' => 'root',
	'pass' => '',
	'database' => 'id9537812_lion', 
); 

	
$db = new SimpleDBClass($db_conn);

?>