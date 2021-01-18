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

if ($csrf->check_valid('post')) {
    //var_dump($_POST[$token_id]);
    if ($_POST) {

        if ($_SESSION['security_code'] === $db->CleanDBData($_POST['login_captcha_code'])) { // Check

            $RecDataUserBanSQL = "SELECT * FROM user_ban WHERE player = ?";
            $values = array($_POST['username']);
            $RecDataUserBan = $model->doSelect($RecDataUserBanSQL, $values);

            if (!empty($RecDataUserBan)) {
                if($RecDataUserBan[0]['count'] <= 2 || $RecDataUserBan[0]['count'] == ""){
                    $checkbanPassed = "Yes";
                }else{
                    // echo strtotime($RecDataUserBan[0]['datetime'])." ".strtotime("-10 minutes");
                    // exit();
                    if (strtotime($RecDataUserBan[0]['datetime']) < strtotime("-10 minutes")) {

                        $loginSQL = "update user_ban set count=?, datetime=? where player=?";
                        $values = array(0, date("Y-m-d H:i:s"), $_POST['username']);
                        $model->doUpdate($loginSQL, $values);
    
                        $checkbanPassed = "Yes";
    
                        $RecDataUserBan[0]['count'] = 0;
    
                    } else {
                        $checkbanPassed = "No";
                    }
                }
            } else {
                $checkbanPassed = "Yes";
            }

            if ($checkbanPassed === "Yes") {

                $passUser = encode($_POST['password'], KEY_HASH);

                $RecDataLoginUserCheckSQL = "SELECT * FROM user_profile WHERE Player = ? AND `password`=?";
                $values = array($_POST['username'], $passUser);
                $RecDataLoginUserCheck = $model->doSelect($RecDataLoginUserCheckSQL, $values);
                //$RecDataLoginUserCheck = $db->select("SELECT * FROM `user_profile` WHERE `Player` = '" . $_POST['username'] . "' AND `password` = '" . $passUser . "'");

                if (!empty($RecDataLoginUserCheck[0]['Player'])) {

                    if ($RecDataLoginUserCheck[0]['eactive'] === '1' && $RecDataLoginUserCheck[0]['uactive'] == '1') {

                        $_SESSION['Player_ID'] = $RecDataLoginUserCheck[0]['id'];
                        $_SESSION['Player'] = $RecDataLoginUserCheck[0]['Player'];
                        $_SESSION['Player_PW'] = $RecDataLoginUserCheck[0]['password'];
                        $_SESSION['Player_Email'] = $RecDataLoginUserCheck[0]['Email'];
                        $_SESSION['Player_Phone'] = $RecDataLoginUserCheck[0]['Telephone'];
                        $_SESSION['Player_RealName'] = $RecDataLoginUserCheck[0]['RealName'];
                        $_SESSION['Player_DBalance'] = $RecDataLoginUserCheck[0]['DBalance'];
                        $_SESSION['Player_CBalance'] = $RecDataLoginUserCheck[0]['CBalance'];
                        $_SESSION['Player_Lang'] = "en";

                        //Delete Ban
                        $sqldฺBan = "DELETE FROM `user_ban` WHERE player=?";
                        $valuesBan = array($_POST['username']);
                        $model->doDelete($sqldฺBan, $valuesBan);

                        header("Location:" . SiteRootDir . "index.php");
                    } else {

                        if ($RecDataLoginUserCheck[0]['eactive'] === '0') {
                            $_SESSION['errors_code'] = "alert-danger";
                            $_SESSION['errors_msg'] = "نام کاربری از طریق ایمیل تأیید نشده است.";

                            header("Location:" . SiteRootDir . "login.php?action=failed");
                        } else {
                            $_SESSION['errors_code'] = "alert-danger";
                            $_SESSION['errors_msg'] = "نام کاربری شما مسدود شده است. لطفا با کارکنان تماس بگیرید";

                            header("Location:" . SiteRootDir . "login.php?action=failed");
                        }

                    }

                } else {

                    
                    //Updated Ban
                    if(!empty($RecDataUserBan[0]['player'])){
                        $loginBanSQL = "update user_ban set count=?, datetime=? where player=?";
                        $valuesloginBanSQL = array($RecDataUserBan[0]['count']+1, date("Y-m-d H:i:s"), $_POST['username']);
                        $model->doUpdate($loginBanSQL, $valuesloginBanSQL);
                    }else{
                        $loginBanSQL = "insert into user_ban (player,count,datetime) values (?,?,?)";
                        $valuesloginBanSQL = array($_POST['username'],'1', date("Y-m-d H:i:s"));
                        $model->doinsert($loginBanSQL, $valuesloginBanSQL);
                    }

                    $_SESSION['errors_code'] = "alert-danger";
                    $_SESSION['errors_msg'] = "Username or password is invalid.";

                    header("Location:" . SiteRootDir . "login.php?action=failed");
                }
            } else {
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "You have logged in incorrectly more than 3 times, please try again after 10 minutes.";

                header("Location:" . SiteRootDir . "login.php?action=failed");
            }

        } else {
            $_SESSION['errors_code'] = "alert-danger";
            $_SESSION['errors_msg'] = "Invalid security code.";

            header("Location:" . SiteRootDir . "login.php?action=failed");
        }
    }
} else {
    echo 'Not Valid';
}
