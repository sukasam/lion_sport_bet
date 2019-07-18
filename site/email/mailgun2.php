<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun;

$message  = $_POST['message'];
$subject  = $_POST['subject'];
$email  = $_POST["email"];
$cc  = $_POST["cc"];
$bcc  = $_POST["bcc"];

$keyMail = "key-89dc4298f7cfa94bd8b80049937b12f7";
$domain = "unicity.com";
$sender = "no-reply@unicity.com";

# First, instantiate the SDK with your API credentials
/*$mg = Mailgun::create($keyMail);

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
		  'text'    => "Unicity",
		  'html'  => $message
		]);
		//var_dump($result);
	}else{
		$result = $mg->messages()->send($domain, [
		  'from'    => $sender,
		  'to'      => $email,
		  'cc'      => $cc,
		  'subject' => $subject,
		  'text'    => "Unicity",
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
	  'text'    => "Unicity",
	  'html'  => $message
	]);
	//var_dump($result);
}else{
	$result = $mg->messages()->send($domain, [
	  'from'    => $sender,
	  'to'      => $email,
	  'subject' => $subject,
	  'text'    => "Unicity",
	  'html'  => $message
	]);

}*/


# Instantiate the client.
$mgClient = new Mailgun($keyMail);

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
              array(
								'from'    => $sender,
								'to'      => $email,
								'subject' => $subject,
								'text'    => "Unicity",
								'html'  => $message
							));
										
//var_dump($result); 

$darr = json_encode($result);

//echo $darr;

$data=  json_decode($darr,true);
# Prints out the individual elements of the array
//echo $data["http_response_body"]["message"]."<br>";
//echo $data["http_response_body"]["id"]."<br>";
//echo $data["http_response_code"];

$msgID = substr( $data["http_response_body"]["id"],0,-1);
$msgID = str_replace("<","",$msgID);
echo $msgID;



/*$queryString = array(
	'message-id' => $msgID,
);

$results = $mgClient->get("$domain/events", $queryString);

$darr2 = json_encode($results);

echo $darr2;*/

?>