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
			$Password = $db->CleanDBData($_POST["user_password"]);
			$Password_confirm = $db->CleanDBData($_POST["user_password_confirm"]);
			$Token = $_SESSION['Token_PW'];
			
			
			$userWemail = explode(' ',base64_decode($Token));

			$RecDataUser = $db->select("SELECT * FROM `user_profile` WHERE `Player` = '".$userWemail[0]."' AND Email = '".$userWemail[1]."'");
			
//			echo "SELECT * FROM `user_profile` WHERE `Player` = '".$userWemail[0]."' AND Email = '".$userWemail[1]."'";
//			exit();
			
			if($RecDataUser[0]['id'] != ''){
				
				if($Password == $Password_confirm){
					
					$enPass = encode($Password,KEY_HASH);
					
					$array_fields = array(
						'password' => $enPass,
					);

					$array_where = array(    
						'id' => $RecDataUser[0]['id'],
					);

					$q = $db->Update('user_profile', $array_fields, $array_where);
										
					$_SESSION['errors_code'] = "alert-success";
                 	$_SESSION['errors_msg'] = 'کلمه رمز جدید با موفقیت ثبت شد.<br><a href="login.php">برای ورود به سایت به صفحه لاگین مراجعه کنید.</a>';
					
					$_SESSION['Token_PW'] = '';
					
					header("Location:".SiteRootDir."NewPassword.php?action=success");
					
				}else{
					$_SESSION['errors_code'] = "alert-danger";
                 	$_SESSION['errors_msg'] = "رمزهای ورود مطابقت ندارند";
					header("Location:".SiteRootDir."NewPassword.php?action=failed");
				}
			}else{
				$_SESSION['errors_code'] = "alert-danger";
				$_SESSION['errors_msg'] = '<span id="lblMessage">از این لینک قبلا برای ساخت کاربر استفاده شده است.<br><a href="login.php"> لطفا برای ورود به سایت اینجا کلیک کنید</a></span>';
				header("Location:".SiteRootDir."NewPassword.php?action=failed");
			}
		}
	}
?>