<?php
    include_once("_inc/config.php");
    include_once("poker_api.php");

    include_once("csrf.class.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

    if($csrf->check_valid('post')) {
        if($_POST){
            if($_SESSION['security_code'] === $db->CleanDBData($_POST['forgot_captcha_code'])) { // Check <br>
				
				$Player = $db->CleanDBData($_POST["user_username"]);
				$Email = $db->CleanDBData($_POST["user_email"]);
				
				$RecData = $db->select("SELECT * FROM user_profile WHERE Player = '".$Player."' AND Email = '".$Email."'");
//				echo "SELECT * FROM user_profile WHERE Player = '".$Player."' AND Email = '".$Email."'";
//				echo $RecData[0]['id'];
//				exit();
				
				if($RecData[0]['id'] != ""){
					
					$pass = substr(str_shuffle(str_repeat('0123456789',5)),0,6);
					
					$enPass = encode($pass,KEY_HASH);
					
					$array_fields = array(
						'password' => $enPass,
					);

					$array_where = array(    
						'id' => $RecData[0]['id'],
					);

					$q = $db->Update('user_profile', $array_fields, $array_where);
					
					$strTo = $Email;
					$strSubject = "=?UTF-8?B?".base64_encode("Password Recovery")."?=";
					$strHeader .= "MIME-Version: 1.0' . \r\n";
					$strHeader .= "Content-type: text/html; charset=utf-8\r\n"; 
					$strHeader .= "From: Lion Royal Online Sports <admin@omegadishwasher-family.com >\r\nReply-To: admin@omegadishwasher-family.com ";
					$strMessage = '<div style="border: 1px solid rgba(53,53,53,0.31);width: 500px;margin: 0 auto;font-family: Tahoma;padding: 15px;border-radius: 4px;background-color: rgba(53,53,53,0.11);"><span style="color: #000000;letter-spacing: -2px;font-size: 32px;margin-right: 3px;">Lion Royal Online Sports Betting</span>
							<hr>
							<span>Hello Dear <b>'.$Player.'</b>,</span>
							<p>This email sent by Lion Royal Online Sports Website based on your request to restart password, if you did not request just ignore this email.<br><br>
							<center>Passwords is '.$pass.'</center>
							<br><br>
							<span>Regards,</span> <br>
							<span>Lion Royal Online Sports Betting</span> <br>
							</div>';

					$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
					
					$_SESSION['errors_code'] = "alert-success";
					$_SESSION['errors_msg'] = "ایمیل حاوی لینک تغییر کلمه رمز برای شما با موفقیت ارسال شد.";
					
					header("Location:".SiteRootDir."forgot_password.php?action=success");
					
				}else{
					
					$_SESSION['errors_code'] = "alert-danger";
					$_SESSION['errors_msg'] = "نام کاربری یا آدرس ایمیل نامعتبر است.";
					
					header("Location:".SiteRootDir."forgot_password.php?action=failed");
					
				}
				
			}else{
				
                 $_SESSION['errors_code'] = "alert-danger";
                 $_SESSION['errors_msg'] = "کد امنیتی نامعتبر است";
        
                 header("Location:".SiteRootDir."forgot_password.php?action=failed");
            }
		}
	}else {
        //echo 'Not Valid';
    }

?>