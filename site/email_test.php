<?php 
    error_reporting(0);
	$strTo = "mme.dumrus@gmail.com";
	$strSubject = "=?UTF-8?B?".base64_encode("Activation Link")."?=";
	$strHeader .= "MIME-Version: 1.0' . \r\n";
	$strHeader .= "Content-type: text/html; charset=utf-8\r\n"; 
	$strHeader .= "From: Mr.Dumrus Sukasam <admin@omegadishwasher-family.com >\r\nReply-To: admin@omegadishwasher-family.com ";
	$strMessage = '<div style="border: 1px solid rgba(53,53,53,0.31);width: 500px;margin: 0 auto;font-family: Tahoma;padding: 15px;border-radius: 4px;background-color: rgba(53,53,53,0.11);"><span style="color: #000000;letter-spacing: -2px;font-size: 32px;margin-right: 3px;">Lion Royal Online Sports Betting</span>
			<hr>
			<span>Hello Dear <b>MY_MY</b>,</span>
			<p>Please use the link below to active your account, <br>
			<a href="http://sport.omegadishwasher-family.com/NewPlayerActivation.php?Token=" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="    display: block;height: 30px;
    width: 220px;border-radius: 2px;background-color: #ffd50f;color: #000;border: 1px solid #000;text-decoration: none;line-height: 30px;margin: 20px auto;text-align: center;">Activation</a>
			<br>
			<span>If the button dose not work, copy and past this link to your browser and replace the Emperor website address with the new one.</span>
			<br>
			</p>
			<p style="font-size:13px"><span>http://sport.omegadishwasher-family.com/NewPlayerActivation.php?Token=</span>
			</p>
			<br>
			<span>Before starting, please ensure you have read the guidelines completle.</span>
			<br>
			<br>
			<span>Regards,</span> <br>
			<span>Lion Royal Online Sports Betting</span> <br>
			</div>';

	$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
	if($flgSend){
		echo "Email Sending.";
	}
	else{
		echo "Email Can Not Send.";
	}
?>