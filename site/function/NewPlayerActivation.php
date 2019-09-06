<?php
    include_once("_inc/config.php");
    include_once("poker_api.php");

    include_once("csrf.class.php");

    $csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

	$Token = $_GET['Token'];
	
	$userWemail = explode(' ',base64_decode($Token));

	$RecDataUser = $db->select("SELECT * FROM `user_profile` WHERE `Player` = '".$userWemail[0]."' AND Email = '".$userWemail[1]."'");

	if($RecDataUser[0]['id'] != ''){
		
		$array_fields = array(
			'eactive' => '1',
		);
		
		$array_where = array(    
			'id' => $RecDataUser[0]['id'],
		);
	
		$q = $db->Update('user_profile', $array_fields, $array_where);
		
		$_SESSION['errors_code'] = "alert-success";
		$_SESSION['errors_msg'] = '<span id="lblMessage">کاربر شما تایید شد.<a href="login.php"> لطفا برای ورود به سایت اینجا کلیک کنید</a>.<br></span>';
		header("Location:".SiteRootDir."NewPlayerActivation.php?action=success");
	}else{
		$_SESSION['errors_code'] = "alert-danger";
		$_SESSION['errors_msg'] = '<span id="lblMessage">از این لینک قبلا برای ساخت کاربر استفاده شده است.<br><a href="login.php"> لطفا برای ورود به سایت اینجا کلیک کنید</a></span>';
		header("Location:".SiteRootDir."NewPlayerActivation.php?action=failed");
	}

?>