<?php
	session_start();
	error_reporting(0);

	include_once("function/csrf.class.php");

	$csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

	if(isset($_GET['affiliate']) && $_GET['affiliate'] != ""){
		include_once("function/affiliate.php");	
		$_SESSION['affiliate'] = $_GET['affiliate'];
	}

	if($_GET['action'] === 'register'){
		include_once("function/register.php");	
    }
    
    if(!isset($_GET['action'])){
        $_SESSION['errors_code'] = "";
	}

	
	define('TITLE_REGISTER','ثبت نام');
	define('TITLE_REGISTER_USERNAME','نام کاربری دلخواه');
	define('TITLE_REGISTER_PASSWORD','رمز عبور فقط حروف و اعداد');
	define('TITLE_REGISTER_MOBILE','شماره تلفن همراه');
	define('TITLE_REGISTER_EMAIL','ایمیل');
	define('TITLE_REGISTER_LOCATION','شهر یا کشور');
	define('TITLE_REGISTER_SECURE_CODE','کد امن را وارد نمایید');
	define('TITLE_BACK','بازگشت');
	define('TITLE_FORGET_PASSWORD','بازیابی رمز ورود');
	
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Lion Royal Online Sports Betting - Register</title>
   <!--Made with love by Mutiullah Samim -->
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="css/bootstrap.css">
    <!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/login.css">

</head>
<body>
<div class="container">
	<div class="d-flex h-100">
		<div class="card">
			<div class="card-header">
				<h3 class="d-flex justify-content-center text-center"><?php echo TITLE_REGISTER;?> <br>(Lion Royal Online Sports Betting)</h3>
            </div>
			<div class="card-body">
                <?php if($_SESSION['errors_code'] != ""){?>
                <div class="alert <?php echo $_SESSION['errors_code'];?>">
                    <?php echo $_SESSION['errors_msg'];?>
                </div>
                <?php }?>

                <form id="frm_register" name="frm_register" action="register.php?action=register" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="<?php echo TITLE_REGISTER_USERNAME;?>" name="user_username" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="<?php echo TITLE_REGISTER_PASSWORD;?>" name="user_password" required>
                    </div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="<?php echo TITLE_REGISTER_MOBILE;?>" name="user_phone" required>
                    </div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="<?php echo TITLE_REGISTER_EMAIL;?>" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="user_email" required>
                    </div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="<?php echo TITLE_REGISTER_LOCATION;?>" name="user_location" required>
					</div>
					<div class="input-group form-group">
                        <img id="captcha" src="include/captcha.php" alt="CAPTCHA Image" class="img-thumbnail img-thumbnail-captcha">
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="<?php echo TITLE_REGISTER_SECURE_CODE;?>" name="register_captcha_code" autocomplete="off" required>
                    </div>
                    <div class="form-group">
						<input type="button" value="<?php echo TITLE_BACK;?>" class="btn float-left login_btn" onclick="javascript:location.href='login.php'">
					</div>
					<div class="form-group">
						<input type="submit" value="<?php echo TITLE_REGISTER;?>" class="btn float-right login_btn">
					</div>
					<input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
				</form>
			</div>
			<div class="card-footer">
				<!-- <div class="d-flex justify-content-center links">
					Don't have an account?<a href="register.php">Sign Up</a>
				</div> -->
				<div class="d-flex justify-content-center">
					<a href="forgot_password.php"><?php echo TITLE_FORGET_PASSWORD;?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once("footer_script.php");?>
</body>
</html>