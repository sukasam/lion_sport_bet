<?php
	include_once("function/app_top.php");

	// $RecData = $db->select("SELECT * FROM tickets WHERE player = '".$_SESSION['Player']."' ORDER BY id DESC");
?>

<!DOCTYPE html>
	<html lang="en" class="no-js">
    <?php include_once("header.php");?>
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
    <script src="https://use.fontawesome.com/2734t3et304.js"></script>
		<body>
			<!-- Start banner Area -->
			<section class="generic-banner relative">
                <?php include_once("topmenu.php");?>
			</section>		
            <!-- End banner Area -->
            
            <!-- About Generic Start -->
		<div class="main-wrapper ">
            <!-- Start feature Area -->
			<section class="feature-area section-gap ">
				<div class="container card-content">	
                    <div class="text-center invite-desc">
                        <div class="mb-30"><?php echo TITLE_TICKETS_DESC;?></div>
                        <div class="text-center">
                            <a href="https://t.me/lionroyalsup" target="_blank" style="color: #FFFFFF;"><i class="fa fa-telegram fa-3x"></i></a>
                        </div>
                    </div>				
				</div>	
			</section>
			<!-- End feature Area -->
        </div>

        <?php include_once("footer.php");?>	
        
        <?php include_once("footer_script.php");?>	
        
	</body>
</html>