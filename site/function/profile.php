<?php

include_once "app_top.php";

$csrf = new csrf();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
if ($csrf->check_valid('post')) {
    if ($_POST) {

        $account_fname = $db->CleanDBData($_POST['account_fname']);
        $account_lname = $db->CleanDBData($_POST['account_lname']);
        $account_email = $db->CleanDBData($_POST['account_emails']);
        $account_phone = $db->CleanDBData($_POST['account_phone']);

        if (!empty($_POST["old_password"])) {
            $PasswordOld = encode($db->CleanDBData($_POST["old_password"]), KEY_HASH);
            if ($PasswordOld === $_SESSION['Player_PW']) {
                $Password1 = encode($db->CleanDBData($_POST["new_password"]), KEY_HASH);
                $_SESSION['Player_PW'] = $Password1;
                $sqlu = "update user_profile set Fname=?,Lname=?,Email=?,Telephone=?,password=? where Player=?";
                $values = array($account_fname, $account_lname, $account_email, $account_phone, $Password1, $_SESSION['Player']);
            } else {
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "Current password is incorrect.";
                header("Location:" . SiteRootDir . "profile.php?action=failed");
            }
        } else {
            $sqlu = "update user_profile set Fname=?,Lname=?,Email=?,Telephone=? where Player=?";
            $values = array($account_fname, $account_lname, $account_email, $account_phone, $_SESSION['Player']);
        }

        $model->doUpdate($sqlu, $values);

        $_SESSION['Player_Email'] = $account_email;
        $_SESSION['Player_Phone'] = $account_phone;

        $_SESSION['errors_code'] = "alert-success";
        $_SESSION['errors_msg'] = "Updated account information.";

        header("Location:" . SiteRootDir . "profile.php?action=success");

    }
} else {
    echo 'Not Valid';
}
