<?php
include_once "app_top.php";
include_once "poker_api.php";

$csrf = new csrf();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
if ($csrf->check_valid('post')) {
    if ($_POST) {

        $PasswordOld = encode($db->CleanDBData($_POST["old_password"]), KEY_HASH);
        $Password1 = encode($db->CleanDBData($_POST["new_password"]), KEY_HASH);
        $Password2 = encode($db->CleanDBData($_POST["retype_new_password"]), KEY_HASH);

        // echo $PasswordOld;
        // echo "<br>";
        // echo $_SESSION['Player_PW'];
        // exit();

        if ($PasswordOld === $_SESSION['Player_PW']) {
            if ($Password1 === $Password2) {

                $sqlu = "update user_profile set password=? where Player=?";
                $values = array($Password1, $_SESSION['Player']);
                $model->doUpdate($sqlu, $values);
                
                $_SESSION['Player_PW'] = $Password1;
                $_SESSION['errors_code'] = "alert-success";
                $_SESSION['errors_msg'] = 'Your password changed successfully.';


                header("Location:" . SiteRootDir . "change_password.php?action=success");

            } else {
                $_SESSION['errors_code'] = "alert-danger";
                $_SESSION['errors_msg'] = "Your passwords do not match";

                header("Location:" . SiteRootDir . "change_password.php?action=failed");
            }
        } else {

            $_SESSION['errors_code'] = "alert-danger";
            $_SESSION['errors_msg'] = "Current password is incorrect.";

            header("Location:" . SiteRootDir . "change_password.php?action=failed");
        }

    }

}
