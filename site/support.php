<?php

include_once "function/app_top.php";

if (isset($_GET['action']) && $_GET['action'] === 'chatbot') {
    $_SESSION['errors_code'] = "";
    include_once "function/support.php";
}

if (!isset($_GET['action'])) {
    $_SESSION['errors_code'] = "";
}

$RecDataSQL = "SELECT * FROM support WHERE player = ? ORDER BY id DESC";
$values = array($_SESSION['Player']);
$RecData = $model->doSelect($RecDataSQL, $values);

?>

<!DOCTYPE html>
	<html lang="en" class="no-js">
    <?php include_once "header.php";?>
    <style>
    html {
    background: url(img/bg/bg_lionroyalcasino.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;

    }
    body{
        background-color: transparent;
    }

    </style>
		<body>
			<!-- Start banner Area -->
			<section class="generic-banner relative">
                <?php include_once "topmenu.php";?>
			</section>
            <!-- End banner Area -->

            <!-- About Generic Start -->
		<div class="main-wrapper ">
            <!-- Start feature Area -->
			<section class="feature-area section-gap ">
				<div class="container card-content">
					<div class="row">
                        <div class="col-12">
                            <h3 class="text-heading"><?php echo TOP_MENU_TICKETS; ?></h3>
                        </div>
                        <div class="col-12 pl-0 pr-0 mb-60">
                            <form id="frm_support" name="frm_support" action="support.php?action=chatbot" method="post">
                                <div class="col-12">
                                <?php if ($_SESSION['errors_code'] != "") {?>
                                <div class="alert <?php echo $_SESSION['errors_code']; ?>">
                                    <?php echo $_SESSION['errors_msg']; ?>
                                </div>
                                <?php }?>
                                    <div class="row mb-20">
                                        <div class="col-md-5 mb-30">
                                            <div class="form-group">
                                                <label><?php echo TITLE_TYPE_HERE;?>:</label>
                                                <textarea name="s_message" rows="2" cols="20" maxlength="750" id="s_message" class="form-control" placeholder="<?php echo TITLE_TYPE_MESSAGE;?>" style="height:200px;" spellcheck="false" required></textarea>
                                                <label class="pt-10"><?php echo TITLE_SUPPORT_DETAIL;?></label>
                                            </div>
                                            <div class="text-center">
                                             <button class="genric-btn primary circle arrow" type="submit" style="font-size: 18px;width: 100%;justify-content: center;"><?php echo TITLE_SEND; ?></button>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <span id="ContentPlaceHolder1_lblChat" class="lblChat">
                                                <?php
                                                foreach ($RecData as $key => $value) {
                                                    $description = str_replace("\\r\\n",' ', $value['s_message']);
                                                    $description = str_replace("\\",'', $description);
                                                ?>
                                                <span class="<?php if($value['s_action'] === "user"){echo "chat-you";}else{echo "chat-support";}?>" title="<?php echo $value['date']." ".$value['time'];?>"><b><?php if($value['s_action'] === "user") {echo "You";}else{echo "Support";}?>:</b><?php echo $description;?></span>
                                                <?php }?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                            </form>
                        </div>
					</div>
				</div>
			</section>
			<!-- End feature Area -->
        </div>

        <?php include_once "footer.php";?>

		<?php include_once "footer_script.php";?>

	</body>
</html>