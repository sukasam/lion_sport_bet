<?php
include_once "../vendor/autoload.php";

use CoinbaseCommerce\Webhook;

/**
 * To run this example please read README.md file
 * Past your Webhook Secret Key from Settings/Webhook section
 * Make sure you don't store your Secret Key in your source code!
 */

$secret = '6a27b0c8-5820-4b2b-be64-8f4418357b65';
$headerName = 'X-Cc-Webhook-Signature';
$headers = getallheaders();
$signraturHeader = isset($headers[$headerName]) ? $headers[$headerName] : null;
$payload = trim(file_get_contents('php://input'));

try {
    $event = Webhook::buildEvent($payload, $signraturHeader, $secret);
    http_response_code(200);
    $msg = sprintf('Successully verified event with id %s and type %s.', $event->id, $event->type);
    $resultfile = fopen("webhook.txt", "a") or die("Unable to open file!");
    $txt = $msg . "\r\n========================\r\n";
    fwrite($resultfile, $txt);
    fclose($resultfile);
} catch (\Exception $exception) {
    http_response_code(400);
    $msg = 'Error occured. ' . $exception->getMessage();
    $resultfile = fopen("webhook.txt", "a") or die("Unable to open file!");
    $txt = $msg . "\r\n========================\r\n";
    fwrite($resultfile, $txt);
    fclose($resultfile);
}
?>