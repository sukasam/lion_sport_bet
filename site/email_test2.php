<?php
include_once('function/poker_api.php');
$to = 'mme_dumrus@hotmail.com';
$from = 'omegadi1@omegadishwasher-family.com';
$subject = 'TEST Email Spam';
$msg = '<div>Test MSG Spam</div>';
echo send_mail($to,$from,$subject,$msg);
?>