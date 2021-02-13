<?php
	session_start();

	include_once("function/csrf.class.php");
	include_once("function/poker_api.php");

	$csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);
	
	//echo $_SESSION['count_login'];

    if($_GET['action'] === 'newpassword'){
		include_once("function/newpassword.php");	
		exit();
	}else{
		if(!isset($_GET['action'])){
			if($_GET['Token'] == '' || !isset($_GET['Token'])){
				$_SESSION['Token_PW'] = '';
				session_destroy();
				header("Location:login.php");
			}else{
				$_SESSION['Token_PW'] = $_GET['Token'];
			}
		}
	}


	if(!isset($_GET['action'])){
        $_SESSION['errors_code'] = "";
	}

	define('TITLE_NEW_PASSWORD','کلمه عبور');
    define('TITLE_NEW_PASSWORD_CONFIRM','تایید رمز عبور');
	define('TITLE_SUBMIT','گردن نهادن');
	$v = date("YmdHis");
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Lion Royal Online Betting - Login</title>
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
				<h3 class="d-flex justify-content-center text-center">Password Recovery <br>(Lion Royal Online Betting)</h3>
				<!-- <div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div> -->
			</div>
			<div class="card-body">
				<?php if($_SESSION['errors_code'] != ""){?>
                <div class="alert <?php echo $_SESSION['errors_code'];?>" style="direction: rtl;">
                    <?php echo $_SESSION['errors_msg'];?>
                </div>
                <?php }?>
                <form id="frm_newpassword" name="frm_newpassword" action="NewPassword.php?action=newpassword" method="post">
					
					<fieldset>
                      <legend>New Password</legend>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="<?php echo TITLE_NEW_PASSWORD;?>" name="user_password" required>
                    </div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="<?php echo TITLE_NEW_PASSWORD_CONFIRM;?>" name="user_password_confirm" required>
                    </div>
                    <span class="textbox-comment-farsi">کلمه رمز جدید و تکرار رمز جدید</span>
                     </fieldset><br>

					<div class="form-group">
						<input type="submit" value="<?php echo TITLE_SUBMIT;?>" class="btn float-right login_btn" style="width: 120px;">
					</div>
					<input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
					<input type="hidden" name="Token" value="<?php echo base64_encode($token_value); ?>"/>
				</form>
			</div>
		</div>
	</div>
</div>
<?php include_once("footer_script.php");?>
</body>
</html>