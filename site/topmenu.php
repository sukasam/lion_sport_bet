<?php

$RecDataNoti = $db->select("SELECT * FROM `notification` WHERE player = '" . $_SESSION['Player'] . "' AND status='0' ORDER BY id DESC");
$RecDataNotiTotal = $db->select("SELECT count(*) as countNoti FROM notification WHERE player = '" . $_SESSION['Player'] . "' AND status='0'");
?>
<!-- Start Header Area -->
<header class="default-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
                <a class="navbar-brand" href="index.php">
                <!--<img src="img/logo.png" alt="">-->
                <span class="spanE"><?php echo TOP_LOGO_LION; ?></span> <span class="spanO"><?php echo TOP_LOGO_ROYAL; ?></span> <span class="spanE"><?php echo TOP_LOGO_CASINO; ?></span>
                <!-- <img src="img/lion-online-bet.png" class="hLogo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="text-white lnr lnr-menu"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav tMenuL">
                    <li><a href="index.php"><?php echo TOP_MENU_HOME; ?></a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <?php echo TOP_MENU_PLAY_GAME; ?>
                        </a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><?php echo TOP_MENU_PLAY_GAME2; ?></a>
                        <a class="dropdown-item" href="#"><?php echo TOP_MENU_PLAY_GAME3; ?></a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <?php echo TOP_MENU_DEPOSITS; ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="deposit.php"><img style="height: 25px; width: 25px; margin-top: -2px;" src="img/emp-perfmoney.png"> <?php echo TOP_MENU_DEPOSITS_PM_VOUCHER; ?></a>
                            <a class="dropdown-item" href="deposit2.php"><img style="height: 25px; width: 25px; margin-top: -2px;" src="img/emp-crypto.png"> <?php echo TOP_MENU_DEPOSITS_CRYPTO; ?></a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <?php echo TOP_MENU_CASHOUTS; ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="withdraw.php"><img style="height: 25px; width: 25px; margin-top: -2px;" src="img/emp-perfmoney.png"> <?php echo TOP_MENU_CASHOUTS_PM_VOUCHER; ?></a>
                            <a class="dropdown-item" href="withdraw2.php"><img style="height: 25px; width: 25px; margin-top: -2px;" src="img/emp-perfmoney.png"> <?php echo TOP_MENU_CASHOUTS_PM_ACCOUNT; ?></a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav tMenuR">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        [<?php echo $RecDataUserProfile[0]['Player']; ?>]
                        </a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="account.php"><?php echo TOP_MENU_ACCOUNT_INFO; ?></a>
                        <a class="dropdown-item" href="change_password.php"><?php echo TOP_MENU_CHANGE_PASSWORD; ?></a>
                        <a class="dropdown-item" href="logout.php"><?php echo TOP_MENU_LOGOUT; ?></a>
                        </div>
                    </li>
                    <li><a href="javascript:void(0);">D:<span class="spanO"><?php echo number_format($RecDataUserProfile[0]['DBalance']) ?></span> | C:<span class="spanO"><?php echo number_format($RecDataUserProfile[0]['CBalance']) ?></span></a></li>
                    <!-- <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <?php if ($_SESSION['Player_Lang'] == "ir") {echo '<img src="img/ir-flag.png" width="20">';} else {echo '<img src="img/en-flag.png" width="20">';}?>
                        </a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?lang=en"><img src="img/en-flag.png" width="20"> <?php echo TOP_MENU_LANG_EN; ?></a>
                        <a class="dropdown-item" href="index.php?lang=ir"><img src="img/ir-flag.png" width="20"> <?php echo TOP_MENU_LANG_IR; ?></a>
                        </div>
                    </li> -->

                    <!-- <li><a href="logout.php">Logout</a></li> -->
                    <!-- Dropdown -->

                </ul>
                </div>
        </div>
    </nav>
</header>
<!-- End Header Area -->