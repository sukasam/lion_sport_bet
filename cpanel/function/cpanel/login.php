<?php

include_once "../../function/poker_api.php";
include_once "../../function/csrf.class.php";
include_once "../../_inc/config.php";
include_once "../../_inc/model.php";

$csrf = new csrf();
$model = new Model();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

if ($csrf->check_valid('post')) {

    if ($_POST) {

        $passUser = encode($_POST['password'], KEY_HASH);

        $sqlSQL = "SELECT * FROM user_profile WHERE Player = ? AND `password` = ? AND permission=? LIMIT 1";
        $values = array($_POST['username'], $passUser, "admin");
        $RecDataLoginUserCheck = $model->doSelect($sqlSQL, $values);

        if (!empty($RecDataLoginUserCheck[0]['Player'])) {

            $_SESSION['PlayerAdmin'] = $_POST['username'];
            $_SESSION['PlayerAdmin_PW'] = $_POST['password'];
            header("Location:index.php");

        }
    }
}
