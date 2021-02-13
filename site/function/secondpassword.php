<?php

include_once "app_top.php";

$csrf = new csrf();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

if (isset($_SESSION['Player']) && $_SESSION['Player'] != "") {

    $sqlSCP = "SELECT * FROM secpw WHERE player = ? ORDER BY id DESC";
    $values = array($_SESSION['Player']);
    $RecDataSCP = $model->doSelect($sqlSCP, $values);

    $sql = "SELECT * FROM user_profile WHERE Player = ?";
    $values = array($_SESSION['Player']);
    $RecData = $model->doSelect($sql, $values);

    $checkSendMail = "no";

    if (empty($RecDataSCP)) {
        $scpw = generateCode(6);
        $scpwHash = encode($scpw, KEY_HASH);

        $sqliSCPSQL = "insert into secpw (player,swp,date,time,action) values (?,?,?,?,?)";
        $valuesSCPSQL = array($_SESSION['Player'], $scpwHash, date("Y-m-d"), date("H:i:s"),'0');
        $model->doinsert($sqliSCPSQL, $valuesSCPSQL);

        $checkSendMail = "yes";

    } else {

        $date = $RecDataSCP[0]['date'];
        $time = $RecDataSCP[0]['time'];

        $timestamp = strtotime($date . " " . $time); //1373673600
        
        // getting current date 
        $cDate = strtotime(date('Y-m-d H:i:s'));
        
        // Getting the value of old date + 24 hours
        $oldDate = $timestamp + 86400; // 86400 seconds in 24 hrs
        

        if ($oldDate < $cDate) {

            $scpw = generateCode(5);
            $scpwHash = encode($scpw, KEY_HASH);

            $sqliSCPSQL = "insert into secpw (player,swp,date,time,action) values (?,?,?,?,?)";
            $valuesSCPSQL = array($_SESSION['Player'], $scpwHash, date("Y-m-d"), date("H:i:s"),'0');
            $model->doinsert($sqliSCPSQL, $valuesSCPSQL);

            $checkSendMail = "yes";

        } else {
            $_SESSION['errors_code'] = "alert-danger";
            $_SESSION['errors_msg'] = "There should be a 24 hour interval between each request to change the new password.";

            header("Location:" . SiteRootDir . "withdraw_pm.php?tab=pm&action=failed");
        }
    }

    if ($checkSendMail === "yes") {
        $to = $RecData[0]['Email'];
        $from = EMAIL_NONEREPLY;
        $subject = "Cahsouts - Perfect Money Voucher(Second Password)";
        $msg = '<div style="border: 1px solid rgba(53,53,53,0.31);width: 500px;margin: 0 auto;font-family: Tahoma;padding: 15px;border-radius: 4px;background-color: rgba(53,53,53,0.11);"><span style="color: #000000;letter-spacing: -2px;font-size: 32px;margin-right: 3px;">Lion Royal Online Betting</span>
        <hr>
        <span>Hello Dear <b>' . $RecData[0]['Player'] . '</b>,</span>
        <p>Use the information below to cahsouts your money.</p>
        <br>
        <p>Second Password : ' . $scpw . '</p>
        <br>
        <span>Before starting, please ensure you have read the guidelines completle.</span>
        <br>
        <br>
        <span>Regards,</span> <br>
        <span>Lion Royal Online Betting</span> <br>
        </div>';
        send_mail($to, $from, $subject, $msg);

        $_SESSION['errors_code'] = "alert-success";
        $_SESSION['errors_msg'] = "The second password was sent to your e-mail successfully.";

        header("Location:" . SiteRootDir . "withdraw_pm.php?tab=pm&action=success");
    }

} else {

    $_SESSION['errors_code'] = "alert-danger";
    $_SESSION['errors_msg'] = "Unable to verify your identity";

    header("Location:" . SiteRootDir . "withdraw_pm.php?tab=pm&action=failed");
}
