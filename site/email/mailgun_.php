<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun;

$message  = $_POST['message'];
$subject  = $_POST['subject'];
$email  = $_POST["email"];
$cc  = $_POST["cc"];

$keyMail = "key-89dc4298f7cfa94bd8b80049937b12f7";
$domain = "unicity.com";
$sender = "no-reply@unicity.com";

# First, instantiate the SDK with your API credentials
$mg = Mailgun::create($keyMail);

# Now, compose and send your message.
# $mg->messages()->send($domain, $params);

if($cc != ""){
	$result = $mg->messages()->send($domain, [
	  'from'    => $sender,
	  'to'      => $email,
	  'cc'      => $cc,
	  'subject' => $subject,
	  'text'    => "Unicity",
	  'html'  => $message
	]);
}else{
	$result = $mg->messages()->send($domain, [
	  'from'    => $sender,
	  'to'      => $email,
	  'subject' => $subject,
	  'text'    => "Unicity",
	  'html'  => $message
	]);
}

echo json_encode($result);



 /* $chMail = curl_init();

  $strSubject = "test script mail gun";
  $strMessage = "Message mail gun";
  $strTo = "mme_dumrus@hotmail.com";

  //$dataFeedPM = "message=".$strMessage."&subject=".$strSubject."&email=".$strTo."&cc=dumrus.sukasam@unicity.com";
  $dataFeedPM = "message=".$strMessage."&subject=".$strSubject."&email=".$strTo;
              
  curl_setopt($chMail, CURLOPT_URL,"https://member-th.unicity.com/email/mailgun.php");
  curl_setopt($chMail, CURLOPT_POST, 1);
  curl_setopt($chMail, CURLOPT_POSTFIELDS,$dataFeedPM);
                  
  curl_setopt($chMail, CURLOPT_SSL_VERIFYPEER,false);
  curl_setopt($chMail, CURLOPT_SSL_VERIFYHOST,false);
  curl_setopt($chMail, CURLOPT_RETURNTRANSFER, true);
               
  $server_output = curl_exec ($chMail);

  echo $server_output;*/

?>