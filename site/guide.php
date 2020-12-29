<?php
include_once "function/app_top.php";
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
                <?php include_once "topmenu_main.php";?>
			</section>
            <!-- End banner Area -->

		<div class="main-content bg-white moregame-content pb-60">
			<div class="container">
                <div class="row">
                    <div class="col-12 d-block d-lg-none .d-xl-none">
                        <div class="form-group">
                            <select class="form-control" id="guideList" onchange="guideSelect()">
                            <?php
							 $RecDataGuideList = $db->select("SELECT * FROM guide WHERE `status` = '0' ORDER BY id ASC");
							 foreach ($RecDataGuideList as $key => $value) {
    						?>
                                <option value="<?php echo $value['id'];?>" <?php if($_GET['id'] === $value['id']){echo "selected";}?>><?php echo $value['g_name'];?></option>
                            <?php }?>
                            
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-none d-lg-block d-xl-block">
                        <div>
                            <ul>
                            <?php
							 $RecDataGuideMenu = $db->select("SELECT * FROM guide WHERE `status` = '0' ORDER BY id ASC");
							 foreach ($RecDataGuideMenu as $key => $value) {
    						?>
                                <li class="guide <?php if($_GET['id'] === $value['id']){echo "activeC";}?>" onclick="window.location.href='guide.php?id=<?php echo $value['id'];?>'"><a class="link"><?php echo $value['g_name'];?></a></li>
                            <?php }?>
                            </ul>
                        </div>
                    </div>
                    <div class="<?php if(isMobile()){echo "col-12";}else{echo "col-md-9";}?>">
                    <?php
                    $RecDataGuideCon = $db->select("SELECT * FROM guide WHERE `status` = '0' AND `id` = ".$_GET['id']);
                    ?>
                    <h3 class="mb-2"><?php echo $RecDataGuideCon[0]['g_name'];?></h3>
                    <div class="guideCon">
                        <?php 
                            $strCon = $RecDataGuideCon[0]['g_detail'];
                            $newCon = preg_replace("/\/userfiles/", SiteImgDir."/userfiles", $strCon);
                            echo stripslashes($newCon);?>
                        </div>
                    </div>
                </div>
			</div>
		</div>


        <?php include_once "footer.php";?>

		<?php include_once "footer_script.php";?>
	</body>
</html>