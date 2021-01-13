<?php
include_once "_inc/config.php";
include_once "_inc/model.php";
include_once "poker_api.php";
include_once "csrf.class.php";

$csrf = new csrf();
$model = new Model();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

$Token = $_GET['Token'];

$userWemail = explode(' ', base64_decode($Token));

$RecDataUserSQL = "SELECT * FROM user_profile WHERE Player = ? AND Email = ?";
$values = array($userWemail[0], $userWemail[1]);
$RecDataUser = $model->doSelect($RecDataUserSQL, $values);

if ($RecDataUser[0]['id'] != '') {

    $ActiveUserSQL = "update user_profile set uactive=?, eactive=? where id=?";
    $values = array('1','1', $RecDataUser[0]['id']);
    $model->doUpdate($ActiveUserSQL, $values);

    $_SESSION['errors_code'] = "alert-success";
    $_SESSION['errors_msg'] = '<span id="lblMessage">کاربر شما تایید شد.<a href="login.php"> لطفا برای ورود به سایت اینجا کلیک کنید</a>.<br></span>';
    header("Location:" . SiteRootDir . "NewPlayerActivation.php?action=success");
} else {
    $_SESSION['errors_code'] = "alert-danger";
    $_SESSION['errors_msg'] = '<span id="lblMessage">از این لینک قبلا برای ساخت کاربر استفاده شده است.<br><a href="login.php"> لطفا برای ورود به سایت اینجا کلیک کنید</a></span>';
    header("Location:" . SiteRootDir . "NewPlayerActivation.php?action=failed");
}
