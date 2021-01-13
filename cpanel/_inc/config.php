<?php

//error_reporting(0);

include_once 'db_class.php';

// define('FromName','Code With Mark');
// define('FromEmail','info@codewithmark.com');

// define('DownloadPageURL','download.php');

$SiteURLLocal = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER['PHP_SELF']);
//Will replace any backward slashes with forward ones
$RootSiteURLPath = str_replace('\\', '/', $SiteURLLocal);
define('SiteRootDir', $RootSiteURLPath);

define('FRONTSITE', "http://lion_sport_bet.com/");
define('ROOTGAMEIMG', str_replace("cpanel", "site", $_SERVER["DOCUMENT_ROOT"] . "upload/"));

//Real Server
// $db_conn = array(
//     'host' => 'localhost',
//     'user' => 'root',
//     'pass' => ';(ejB_E39sd^q#x',
//     'database' => 'lion_royal',
//     );

//Server Test
// $db_conn = array(
//     'host' => 'localhost',
//     'user' => 'omegadi1_sport',
//     'pass' => '147852369',
//     'database' => 'omegadi1_sport',
//     );

//Local
$db_conn = array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'database' => 'lion_sport',
);

$db = new SimpleDBClass($db_conn);
