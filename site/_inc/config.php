<?php
include_once('db_class.php'); 
// define('SITE','http://'.$_SERVER['SERVER_NAME']);
$SiteURLLocal =  "http://" .$_SERVER["HTTP_HOST"]. dirname($_SERVER['PHP_SELF']); 
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