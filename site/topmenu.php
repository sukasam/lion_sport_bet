<?php
    
    // $params3 = array("Command"  => "AccountsGet",
    // "Player"   => $_SESSION['Player']);
    // $api3 = Poker_API($params3);

    $RecDataUserBalance= $db->select("SELECT `Balance`  FROM `user_profile` WHERE `Player` = '".$_SESSION['Player']."'");

    if ($RecDataUserBalance[0]['Balance']){
        $_SESSION['Player_Balance'] = $RecDataUserBalance[0]['Balance'];
    }else{
        $_SESSION['Player_Balance'] = 0;
    }

    $RecDataNoti = $db->select("SELECT * FROM notification WHERE player = '".$_SESSION['Player']."' AND status='0' ORDER BY id DESC");
    $RecDataNotiTotal = $db->select("SELECT count(*) as countNoti FROM notification WHERE player = '".$_SESSION['Player']."' AND status='0'");
?>
<!-- Start Header Area -->
<header class="default-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
                <a class="navbar-brand" href="index.php">
                <!--<img src="img/logo.png" alt="">-->
                <span class="spanE"><?php echo TOP_LOGO_LION;?></span> <span class="spanO"><?php echo TOP_LOGO_ROYAL;?></span> <span class="spanE"><?php echo TOP_LOGO_CASINO;?></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="text-white lnr lnr-menu"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li><a href="javascript:void(0);"><?php echo $_SESSION['Player'];?> : <span class="spanO"><?php echo number_format($_SESSION['Player_Balance'])?></span> Toman</a></li>
                    <li><a href="index.php"><?php echo TOP_MENU_HOME;?></a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <?php echo TOP_MENU_PLAY_GAME;?>
                        </a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><?php echo TOP_MENU_PLAY_GAME2;?></a>
                        <a class="dropdown-item" href="#"><?php echo TOP_MENU_PLAY_GAME3;?></a>
                        </div>
                    </li>
                    <li><a href="support.php"><?php echo TOP_MENU_TICKETS;?></a></li>
                    <li><a href="agent.php"><?php echo TOP_MENU_INVITE;?></a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <?php echo TOP_MENU_PAYMENT;?>
                        </a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="deposit.php"><?php echo TOP_MENU_DEPOSIT_EV;?></a>
                        <a class="dropdown-item" href="deposit2.php"><?php echo TOP_MENU_DEPOSIT_ONLINE;?></a>
                        <a class="dropdown-item" href="withdraw.php"><?php echo TOP_MENU_WITHDRAW_EV;?></a>
                        <a class="dropdown-item" href="withdraw2.php"><?php echo TOP_MENU_WITHDRAW_ONLINE;?></a>
                        <!-- <a class="dropdown-item" href="transaction.php"><?php echo TOP_MENU_TRANSACTION_HISTORY;?></a> -->
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <?php echo TOP_MENU_PROFILE;?>
                        </a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="account.php"><?php echo TOP_MENU_ACCOUNT_INFO;?></a>
                        <a class="dropdown-item" href="change_password.php"><?php echo TOP_MENU_CHANGE_PASSWORD;?></a>
                        <a class="dropdown-item" href="logout.php"><?php echo TOP_MENU_LOGOUT;?></a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <?php if($_SESSION['Player_Lang'] == "ir"){echo'<img src="img/ir-flag.png" width="20">';}else{echo '<img src="img/en-flag.png" width="20">';}?>
                        </a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?lang=en"><img src="img/en-flag.png" width="20"> <?php echo TOP_MENU_LANG_EN;?></a>
                        <a class="dropdown-item" href="index.php?lang=ir"><img src="img/ir-flag.png" width="20"> <?php echo TOP_MENU_LANG_IR;?></a>
                        </div>
                    </li>
                    
                    <!-- <li><a href="logout.php">Logout</a></li> -->
                    <!-- Dropdown -->
                    
                </ul>
                </div>						
        </div>
    </nav>
</header>
<!-- End Header Area -->				