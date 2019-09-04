<?php
	session_start();

	include_once("function/csrf.class.php");
	include_once("function/poker_api.php");

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
	define('TITLE_FORGET_PASSWORD','کلمه عبور');
    define('TITLE_FORGET_PASSWORD_CONFIRM','تایید رمز عبور');
	$v = date("YmdHis");

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Lion Royal Casino - Register</title>
   <!--Made with love by Mutiullah Samim -->
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="css/bootstrap.css">
    <!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/login.css?v=<?php echo $v;?>">

</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3 class="d-flex justify-content-center text-center"><?php echo TITLE_REGISTER;?> <br>(Lion Royal Online Sports Betting)</h3>
            </div>
			<div class="card-body">
                <?php if($_SESSION['errors_code'] != ""){?>
                <div class="alert <?php echo $_SESSION['errors_code'];?>" style="direction: rtl;">
                    <?php echo $_SESSION['errors_msg'];?>
                </div>
                <?php }?>

                <form id="frm_register" name="frm_register" action="register.php?action=register" method="post">
                  <fieldset>
                     <legend>Email</legend>
                	<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="<?php echo TITLE_REGISTER_EMAIL;?>" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="user_email" required>
                    </div>
                    <span class="textbox-comment-farsi">لطفا آدرس ایمیل خود را وارد کنید</span>
                    </fieldset>
                    <fieldset>
                      <legend>Username</legend>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="<?php echo TITLE_REGISTER_USERNAME;?>" name="user_username" required>
						
					</div>
					<span class="textbox-comment-farsi">حداقل 3 و حداکثر 12 کارکتر، فقط حروف و اعداد</span>
                    </fieldset><br>
                    
                    <fieldset>
                      <legend>Passwword and Confirm</legend>
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
						<input type="password" class="form-control" placeholder="<?php echo TITLE_FORGET_PASSWORD_CONFIRM;?>" name="user_password_confirm" required>
                    </div>
                    <span class="textbox-comment-farsi">حداقل 6 و حداکثر 20 کارکتر</span>
                     </fieldset><br>
<!--
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="<?php echo TITLE_REGISTER_MOBILE;?>" name="user_phone" required>
                    </div>
-->
                    
                    <!-- <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="<?php echo TITLE_REGISTER_LOCATION;?>" name="user_location" required>
					</div> -->
					<fieldset>
                      <legend>CAPTCHA</legend>
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
						<input type="password" class="form-control" placeholder="<?php echo TITLE_REGISTER_SECURE_CODE;?>" name="register_captcha_code" autocomplete="off" required>
                    </div>
                    
                    </fieldset><br>
                    
                   <div class="row">
                   	<div class="col-6">
                   		 <div class="form-group">
							<input type="button" value="<?php echo TITLE_BACK;?>" class="btn float-left login_btn" onclick="javascript:location.href='login.php'">
						</div>
                   	</div>
                   	<div class="col-6">
                   		<div class="form-group">
							<input type="submit" value="<?php echo TITLE_REGISTER;?>" class="btn float-right login_btn">
						</div>
						<input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                   	</div>
                   </div>
				</form>
			</div>
			<div class="card-footer">
				<!-- <div class="d-flex justify-content-center links">
					Don't have an account?<a href="register.php">Sign Up</a>
				</div> -->
				<!-- <div class="d-flex justify-content-center">
					<a href="forgot_password.php"><?php echo TITLE_FORGET_PASSWORD;?></a>
				</div> -->
			</div>
		</div>
	</div>
</div>
<?php include_once("footer_script.php");?>
</body>
</html>