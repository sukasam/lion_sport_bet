<?php
include_once "../vendor/autoload.php";

use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Event;
use CoinbaseCommerce\Resources\Charge;

//Make sure you don't store your API Key in your source code!
ApiClient::init('7bdc2bba-b0d3-4472-8b89-80f5b6add509');

// $eventObj = Event::retrieve('839df2ff-7c3b-41de-bb4a-a6150050001c');

// echo "<pre>";
// print_r($eventObj);
// echo "</pre>";

$chargeObj = Charge::retrieve('288c395c-a59d-4582-9ce8-5f00283e0e42');

echo "<pre>";
print_r($chargeObj);
echo "</pre>";
?>