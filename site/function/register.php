<?php
include_once "_inc/config.php";
include_once "_inc/model.php";
include_once "poker_api.php";
include_once "csrf.class.php";

$csrf = new csrf();
$model = new Model();

echo SiteRootDir;
exit();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

if ($csrf->check_valid('post')) {
    if ($_POST) {
        if ($_SESSION['security_code'] === $db->CleanDBData($_POST['register_captcha_code'])) { // Check <br>

            $Player = $db->CleanDBData($_POST["user_username"]);
            $Password = $db->CleanDBData($_POST["user_password"]);
            $Password_confirm = $db->CleanDBData($_POST["user_password_confirm"]);
            $Email = $db->CleanDBData($_POST["user_email"]);
            $affiliate = decode($_SESSION['affiliate'], KEY_HASH);
            $Phone = $db->CleanDBData($_POST['user_phone']);

            $enPass = encode($Password, KEY_HASH);

            if ($Password == $Password_confirm) {

                if ($affiliate != "") {
                    $noteAPI = "Affiliate by " . $affiliate;
                } else {
                    $noteAPI = "";
                }

                $RecData = $db->select("SELECT * FROM user_profile WHERE Player = '" . $Player . "'");

                if ($RecData[0]['id'] == "") {

                    // $insert_arrays = array(
                    //     'Player'=> $Player,
                    //     'Email'=> $Email,
                    //     'Telephone'=> $Phone,
                    //     'onlineCard'=> 0,
                    //     'inviteUser'=> 0,
                    //     'uactive'=> 0,
                    //     'password'=> $enPass,
                    // );

                    // $qUser  = $db->insert('user_profile',$insert_arrays);

                    $RegisterSQL = "insert into user_profile (Player,Email,Telephone,onlineCard,inviteUser,uactive,password) values (?,?,?,?,?,?,?)";
                    $values = array($Player, $Email, $Phone, 0, 0, 0, $enPass);
                    $model->doinsert($RegisterSQL, $values);

                    $_SESSION['errors_code'] = "alert-success";
                    //$_SESSION['errors_msg'] = 'حساب کاربری با موفقیت ایجاد شد '.$Player.' برای نام کاربری. <a href="login.php"> (برای ورود اینجا کلیک کنید) </a>';
                    $_SESSION['errors_msg'] = 'درخواست شما ثبت شد و ایمیل حاوی لینک فعال سازی کاربر جدید به آدرس <span>' . $Email . '</span> ارسال گردید.';

                    $strTo = $Email;
                    $strSubject = "=?UTF-8?B?" . base64_encode("Activation Link") . "?=";
                    $strHeader .= "MIME-Version: 1.0' . \r\n";
                    $strHeader .= "Content-type: text/html; charset=utf-8\r\n";
                    $strHeader .= "From: Lion Royal Online Sports <noreply@lionroyal.com>\r\nReply-To: noreply@lionroyal.com ";
                    $strMessage = '<div style="border: 1px solid rgba(53,53,53,0.31);width: 500px;margin: 0 auto;font-family: Tahoma;padding: 15px;border-radius: 4px;background-color: rgba(53,53,53,0.11);"><span style="color: #000000;letter-spacing: -2px;font-size: 32px;margin-right: 3px;">Lion Royal Online Sports Betting</span>
								<hr>
								<span>Hello Dear <b>' . $Player . '</b>,</span>
								<p>Please use the link below to active your account, <br><br>
								<center><a href="' . SiteRootDir . 'NewPlayerActivation.php?Token=' . base64_encode($Player . ' ' . $Email) . '" target="_blank">Activation</a></center>
								<br><br>
								<span>If the button dose not work, copy and past this link to your browser and replace the Lion Royal Online Sports website address with the new one.</span>
								<br>
								</p>
								<p style="font-size:13px"><a href="' . SiteRootDir . 'NewPlayerActivation.php?Token=' . base64_encode($Player . ' ' . $Email) . '" target="_blank"><span>' . SiteRootDir . 'NewPlayerActivation.php?Token=' . base64_encode($Player . ' ' . $Email) . '</span></a>
								</p>
								<br>
								<span>Before starting, please ensure you have read the guidelines completle.</span>
								<br>
								<br>
								<span>Regards,</span> <br>
								<span>Lion Royal Online Sports Betting</span> <br>
								</div>';

                    $flgSend = @mail($strTo, $strSubject, $strMessage, $strHeader); // @ = No Show Error //

                    if ($affiliate != "") {
                        $postfields = array(
                            'player' => $affiliate,
                            'affiliate' => $Player,
                            'date' => date("Y-m-d"),
                            'time' => date("H:i:s"),
                            'action' => 'Enable',
                            'commission' => '0',
                            'amount' => '0',
                            'logs' => 'affiliate_log',
                        );
                        $response = curl_post(API_SITE, $postfields);
                    }

                    $_SESSION['affiliate'] = "";
                    unset($_SESSION['affiliate']);
                    $affiliate = "";

                    unset($_SESSION['Player']);
                    unset($_SESSION['Player_PW']);

                    header("Location:" . SiteRootDir . "register.php?action=success");
                } else {

                    $_SESSION['errors_code'] = "alert-danger";

                    if ($RecData[0]['Player'] == $Player) {
                        $_SESSION['errors_msg'] = "نام کاربری استفاده شده است";
                    } else if ($RecData[0]['Email'] == $Email) {
                        $_SESSION['errors_msg'] = "آدرس ایمیل توسط کاربر دیگری ثبت شده است";
                    } else if (count($RecData[0]['Player']) <= 2) {
                        $_SESSION['errors_msg'] = "نام کاربری باید بین ۳ تا ۱۲ کاراکتر باشد";
                    }

                    header("Location:" . SiteRootDir . "register.php?action=failed");
                }
            } else {
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "رمزهای ورود مطابقت ندارند";
                header("Location:" . SiteRootDir . "register.php?action=failed");
            }
        } else {
            $_SESSION['errors_code'] = "alert-danger";
            $_SESSION['errors_msg'] = "کد امنیتی نامعتبر است";

            header("Location:" . SiteRootDir . "register.php?action=failed");
        }
    }
} else {
    //echo 'Not Valid';
}
