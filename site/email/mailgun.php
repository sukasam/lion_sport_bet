<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun;

$message  = $_POST['message'];
$subject  = $_POST['subject'];
$email  = $_POST["email"];
$cc  = $_POST["cc"];
$bcc  = $_POST["bcc"];

$keyMail = "a8ede253b99136f799e0703a8a12de54-c9270c97-859024bd";
$domain = "sandbox88cbefcf18e34cdba643ee1ee3590aa5.mailgun.org";
$sender = "no-reply@lionroyal.com";

# First, instantiate the SDK with your API credentials
$mg = Mailgun::create($keyMail);

# Now, compose and send your message.
# $mg->messages()->send($domain, $params);

if($cc !== ""){
	if($bcc !== ""){
		$result = $mg->messages()->send($domain, [
		  'from'    => $sender,
		  'to'      => $email,
		  'cc'      => $cc,
		  'bcc'      => $bcc,
		  'subject' => $subject,
		  'text'    => "Lionroyal",
		  'html'  => $message
		]);
		//var_dump($result);
	}else{
		$result = $mg->messages()->send($domain, [
		  'from'    => $sender,
		  'to'      => $email,
		  'cc'      => $cc,
		  'subject' => $subject,
		  'text'    => "Lionroyal",
		  'html'  => $message
		]);
		//var_dump($result);
	}
}else if($bcc !== ""){
	$result = $mg->messages()->send($domain, [
	  'from'    => $sender,
	  'to'      => $email,
	  'bcc'      => $bcc,
	  'subject' => $subject,
	  'text'    => "Lionroyal",
	  'html'  => $message
	]);
	//var_dump($result);
}else{
	$result = $mg->messages()->send($domain, [
	  'from'    => $sender,
	  'to'      => $email,
	  'subject' => $subject,
	  'text'    => "Lionroyal",
	  'html'  => $message
	]);
   //var_dump($result);
}




?>