<?php
	session_start();

	include_once("function/csrf.class.php");
	include_once("function/poker_api.php");

	$csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);
	
	//echo $_SESSION['count_login'];


	// if(isset($_SESSION['Player']) && isset($_SESSION['Player_PW'])){
	// 	header("Location:set_pin.php");
	// }
	
	if($_GET['Token'] != "" && isset($_GET['Token'])){
		include_once("function/NewPlayerActivation.php");
		exit();
	}
	

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
				<h3 class="d-flex justify-content-center text-center">Active New Players <br>(Lion Royal Online Sports Betting)</h3>
			</div>
			<div class="card-body">
				<?php if($_SESSION['errors_code'] != ""){?>
                <div class="alert <?php echo $_SESSION['errors_code'];?>" style="direction: rtl;">
                    <?php echo $_SESSION['errors_msg'];?>
<!--Success		           <span id="lblMessage">کاربر شما تایید شد.<a href="login.php"> لطفا برای ورود به سایت اینجا کلیک کنید</a>.<br></span>-->
               
<!--Errors               <span id="lblMessage">از این لینک قبلا برای ساخت کاربر استفاده شده است.<br><a href="login.php"> لطفا برای ورود به سایت اینجا کلیک کنید</a></span>-->
                </div>
                <?php }?>
			</div>
		</div>
	</div>
</div>
<?php include_once("footer_script.php");?>
</body>
</html>