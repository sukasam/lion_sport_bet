<?php
	session_start();
	error_reporting(0); 
	include_once("function/csrf.class.php");

	$csrf = new csrf();
 
    // Generate Token Id and Valid
    $token_id = $csrf->get_token_id();
    $token_value = $csrf->get_token($token_id);

	if($_GET['action'] === 'forgot'){
		include_once("function/forgot.php");	
    }
    
    if(!isset($_GET['action'])){
        $_SESSION['errors_code'] = "";
	}
	
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Lion Royal Online Sports Betting - Reset Password</title>
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
				<h3 class="d-flex justify-content-center text-center">Reset Password <br>(Lion Royal Online Sports Betting)</h3>
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
                <form id="frm_login" name="frm_login" action="forgot_password.php?action=forgot" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Username" name="user_username" required>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="user_email" required>
					</div>
					<div class="input-group form-group">
                        <img id="captcha" src="include/captcha.php" alt="CAPTCHA Image" class="img-thumbnail img-thumbnail-captcha">
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Secured Code" name="forgot_captcha_code" autocomplete="off" required>
                    </div>
                    <div class="form-group">
						<input type="button" value="Back" class="btn float-left login_btn" onclick="javascript:location.href='login.php'">
					</div>
					<div class="form-group">
						<input type="submit" value="Reset" class="btn float-right login_btn">
					</div>
					<input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
				</form>
			</div>
		</div>
	</div>
</div>
<?php include_once("footer_script.php");?>
</body>
</html>