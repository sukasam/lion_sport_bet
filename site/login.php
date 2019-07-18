<?php
	session_start();

	include_once("function/csrf.class.php");
	include_once("function/poker_api.php");

	$csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);
	
	//echo $_SESSION['count_login'];

	if($_GET['login'] == 'no'){
		session_destroy();
		header("Location:login.php");
	}

    if($_GET['action'] === 'login'){
		include_once("function/login.php");	
	}

	// if(isset($_SESSION['Player']) && isset($_SESSION['Player_PW'])){
	// 	header("Location:set_pin.php");
	// }

	if(!isset($_GET['action'])){
        $_SESSION['errors_code'] = "";
	}
	
	//define('TITLE_FORGET_PASSWORD','Forgot your password?');
	define('TITLE_FORGET_PASSWORD','بازیابی رمز ورود');
	define('TITLE_REGISTER_USERNAME','نام كاربرى');
	define('TITLE_REGISTER_PASSWORD','رمز عبور');
	define('TITLE_REGISTER_SECURE_CODE','کد امن را وارد نمایید');
	define('TITLE_LOGIN','ورود به سیستم');
	$v = date("YmdHis");
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Lion Royal Online Sports Betting - Login</title>
   <!--Made with love by Mutiullah Samim -->
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="css/bootstrap.css">
    <!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/login.css?v=<?php echo $v;?>">
	<meta name="google-site-verification" content="q0CqLkSJnBCJyABXMpI_xraMMv6X-MLZUOzFhNZm7qE" />
	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130683010-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-130683010-1');
    </script>

</head>
<body>
<div class="container">
	<div class="d-flex h-100">
		<div class="card">
			<div class="card-header">
				<h3 class="d-flex justify-content-center text-center">Sign In <br>(Lion Royal Online Sports Betting)</h3>
				<!-- <div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div> -->
			</div>
			<div class="card-body">
				<?php if($_SESSION['errors_code'] != ""){?>
                <div class="alert <?php echo $_SESSION['errors_code'];?>">
                    <?php echo $_SESSION['errors_msg'];?>
                </div>
                <?php }?>
                <form id="frm_login" name="frm_login" action="login.php?action=login" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="<?php echo TITLE_REGISTER_USERNAME;?>" name="username" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="<?php echo TITLE_REGISTER_PASSWORD;?>" name="password" required>
					</div>
					<div class="input-group form-group justify-content-center">
						<!-- <img id="captcha" src="include/captcha.php?v=<?php echo date("YmdHis");?>" alt="CAPTCHA Image" class="img-thumbnail img-thumbnail-captcha"> -->
						<?php 
						$_SESSION['security_code'] = generateCode(4);
						?>
						<div class="captcha">
							<?php echo $_SESSION['security_code'];?>
						</div>
					
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="<?php echo TITLE_REGISTER_SECURE_CODE;?>" name="login_captcha_code" autocomplete="off" required >
					</div>
					<div class="form-group">
						<input type="submit" value="<?php echo TITLE_LOGIN;?>" class="btn float-right login_btn" style="width: 120px;">
					</div>
					<input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
				</form>
			</div>
			<div class="card-footer">
				<!-- <div class="d-flex justify-content-center links">
					Don't have an account?<a href="contact">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="forgot_password.php"><?php echo TITLE_FORGET_PASSWORD;?></a>
				</div> -->
			</div>
		</div>
	</div>
</div>
<?php include_once("footer_script.php");?>
</body>
</html>