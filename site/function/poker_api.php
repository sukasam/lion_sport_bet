<?php

include_once 'poker_config.php';

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }

    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

function curl_post_outsite($url, $postfields)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    // Edit: prior variable $postFields should be $postfields;
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
    $result = curl_exec($ch);

    return $result;
}

function curl_get_outsite($url)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_GET, 1);
    // Edit: prior variable $postFields should be $postfields;
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
    $result = curl_exec($ch);

    return $result;
}

function encode($string, $key)
{
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    $hash = "";
    $j = "";
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(@substr($string, $i, 1));
        if ($j == $keyLen) {$j = 0;}
        $ordKey = ord(@substr($key, $j, 1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
    }
    return $hash;
} /// encode("Please Encode Me!","A New Key");

function decode($string, $key)
{
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    $j = "";
    for ($i = 0; $i < $strLen; $i += 2) {
        $ordStr = hexdec(base_convert(strrev(@substr($string, $i, 2)), 36, 16));
        if ($j == $keyLen) {$j = 0;}
        $ordKey = ord(@substr($key, $j, 1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
} // decode("t3t5e434q494f2m4s5j5w544b4d2m3k5i2","A New Key");

function generateCode($characters)
{
    $possible = '1234567890'; // ตัวอักษรที่ต้องการจะเอาสุ่มเป็น Captcha
    $code = '';
    $i = 0;
    while ($i < $characters) {
        $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
        $i++;
    }
    return $code;
}

function cardFormat($cardNumber)
{

    $numMake = "";
    for ($i = 1; $i <= strlen($cardNumber); $i++) {

        if (($i - 1) % 4 == 0) {
            $numMake .= " " . substr($cardNumber, $i - 1, 1);
        } else {
            $numMake .= substr($cardNumber, $i - 1, 1);
        }

    }
    return $numMake;
}

function send_mail($to, $from, $subject, $msg)
{
    $headers = "MIME-Version: 1.0";
    $headers .= "from: $from  $subject  ";
    $headers .= "Content-type: text/html;charset=utf-8 ";
    $headers .= "X-Priority: 3";
    $headers .= "X-Mailer: smail-PHP " . phpversion() . "";
    $msg = '
   	<div style="text-align:left">
    <h2>' . $subject . '</h2>
    ' . $msg . '
    </div>
    ';

    if (mail($to, $subject, $msg, $headers)) {
        return true;
    } else {
        return false;
    }
}
