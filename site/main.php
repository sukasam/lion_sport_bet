<?php
include_once("function/app_top.php");
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

		<?php 
		$RecDataBanner = $db->select("SELECT * FROM main_banner ORDER BY id ASC");
		?>

		<div class="main-content bg-white pb-30 overflow-hidden">
			<div class="container">
				<div class="row">
					<div class="col-12 col-lg-6 col-md-6 col-sm-6 pl-0 pr-0">
						<div class="topBannerL">
							<div class="brand_bg_pattern" style="background-color: <?php echo $RecDataBanner[0]['b_color'];?> !important;">
								<span class="pixel_placement" > <span class="shape shape_1"></span> <span class="shape shape_2"></span> <span class="shape shape_3"></span> <span class="shape shape_4"></span> </span>
							</div>
							<a href="" target="_blank">
								<div class="content bgBanerL" style="background-image: url(upload/banner/<?php echo $RecDataBanner[0]['b_img'];?>)"></div>
							</a>
						</div>
					</div>
					<div class="col-12 col-lg-6 col-md-6 col-sm-6 pl-0 pr-0">
						<div class="topBannerR">
							<div class="brand_bg_pattern" style="background-color: <?php echo $RecDataBanner[1]['b_color'];?> !important;">
								<span class="pixel_placement" style="background: <?php echo $RecDataBanner[1]['b_color']?> !important;"> <span class="shape shape_1"></span> <span class="shape shape_2"></span> <span class="shape shape_3"></span> <span class="shape shape_4"></span> </span>
							</div>
							<a href="" target="_blank">
								<div class="content bgBanerR" style="background-image: url(upload/banner/<?php echo $RecDataBanner[1]['b_img'];?>)"></div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="main-content bg-white moregame-content pb-60">
			<div class="container">
			
			<div class="top-content">
				<div class="container-fluid">
					<div id="carousel-one" class="carousel slide" data-ride="carousel" data-type="multi">

						<div class="controls-top">
							<?php 
								if(isMobile()){
									?>
									<p class="text-center"><a class="txmore-game">MORE GAMES 01</a></p>
									<div class="text-center">
										<a class="btn-floating" href="#carousel-one" data-slide="prev"><i class="fa fa-chevron-circle-left fa-3"></i></a>
										<a class="btn-floating pl-0" href="#carousel-one" data-slide="next"><i class="fa fa-chevron-circle-right fa-3"></i></a>
									</div>
									<?php
								}else{
									?>
									<a class="txmore-game">MORE GAMES 01</a>										
									<a class="btn-floating" href="#carousel-one" data-slide="prev"><i class="fa fa-chevron-circle-left fa-3"></i></a>
									<a class="btn-floating pl-0" href="#carousel-one" data-slide="next"><i class="fa fa-chevron-circle-right fa-3"></i></a>
									<?php
								}
							?>
						</div>

						<div class="carousel-inner carousel-inner-one row w-100 mx-auto" role="listbox">

							<?php
							 $RecDataGmaneOne = $db->select("SELECT * FROM game_row WHERE `g_row` = '1' ORDER BY id DESC");
							 foreach ($RecDataGmaneOne as $key => $value) {
    						?>
								<div class="carousel-item carousel-itemone col-12 col-sm-6 col-md-4 col-lg-3 <?php if ($key == 0) {echo "active";}
    							;?>">
									<a href="<?php echo $value['g_link']?>" target="_blank">
										<div class="bodyBox brand_bg_primary" style="background-image: url(upload/game/<?php echo $value['g_img']?>);">
											<!-- <div class="txBoxtitle">
												<p>
													<span class="" role="text">
														<span class="text_element">This Tuesday <?php echo sprintf("%02d", $i); ?></span>
														<span class="line_element"></span>
													</span>
												</p>
												
											</div>
											
											<div class="text-center">
												<button type="button" class="btn btn-primary cuk_btn_primary">PLAY GAME</button>
											</div> -->
										</div>
									</a>
								</div>
								<?php
								}
								?>
						</div>
					</div>


					<div id="carousel-two" class="carousel slide mt-50" data-ride="carousel" data-type="multi">

						<div class="controls-top">
						<?php 
								if(isMobile()){
									?>
									<p class="text-center"><a class="txmore-game">MORE GAMES 02</a></p>
									<div class="text-center">
									<a class="btn-floating" href="#carousel-two" data-slide="prev"><i class="fa fa-chevron-circle-left fa-3"></i></a>
							<a class="btn-floating pl-0" href="#carousel-two" data-slide="next"><i class="fa fa-chevron-circle-right fa-3"></i></a>
									</div>
									<?php
								}else{
									?>
									<a class="txmore-game">MORE GAMES 02</a>
									<a class="btn-floating" href="#carousel-two" data-slide="prev"><i class="fa fa-chevron-circle-left fa-3"></i></a>
									<a class="btn-floating pl-0" href="#carousel-two" data-slide="next"><i class="fa fa-chevron-circle-right fa-3"></i></a>
									<?php
								}
							?>
							
						</div>

						<div class="carousel-inner carousel-inner-two row w-100 mx-auto" role="listbox">

							<?php
							 $RecDataGmaneTwo = $db->select("SELECT * FROM game_row WHERE `g_row` = '2' ORDER BY id DESC");
							 foreach ($RecDataGmaneTwo as $key => $value) {
    						?>
								<div class="carousel-item carousel-itemtwo col-12 col-sm-6 col-md-4 col-lg-3 <?php if ($key == 1) {echo "active";}
								;?>">
									<a href="<?php echo $value['g_link']?>" target="_blank">
										<div class="bodyBox brand_bg_primary" style="background-image: url(upload/game/<?php echo $value['g_img']?>);">
											<!-- <div class="txBoxtitle">
												<p>
													<span class="" role="text">
														<span class="text_element">This Tuesday <?php echo sprintf("%02d", $i); ?></span>
														<span class="line_element"></span>
													</span>
												</p>
												
											</div>
											
											<div class="text-center">
												<button type="button" class="btn btn-primary cuk_btn_primary">PLAY GAME</button>
											</div> -->
										</div>
									</a>
								</div>
								<?php
								}
								?>
						</div>
					</div>

				</div>
			</div>

			</div>
		</div>

		<?php $RecDataPoker = $db->select("SELECT `poker_register`,`poker_login` FROM setting WHERE sid ='1'");?>
		<div class="main-content bg-white pt-3 pb-5">
           <div class="container c-down text-center py-5">
				<h2 class="mt-3">آیا در سایت تخته نرد تاس بازی اکانت دارین ؟</h2>
				<div class="row mt-4">

				<div class="col-12 col-lg-6 mt-5">
					<?php 
						if($RecDataPoker[0]['poker_register']){
							?>
							<a href="<?php echo $RecDataPoker[0]['poker_register'];?>" target="_blank">
								<img src="img/register_poker.png" alt="">
							</a>
							<?php
						}else{
							?>
							<img src="img/register_poker.png" alt="">
							<?php
						}
					?>
					
				</div>
				<div class="col-12 col-lg-6 mt-5">
					<?php 
					if($RecDataPoker[0]['poker_login']){
						?>
						<a href="<?php echo $RecDataPoker[0]['poker_login'];?>" target="_blank">
							<img src="img/login_poker.png" alt="">
						</a>
						<?php
					}else{
						?>
						<img src="img/login_poker.png" alt="">
						<?php
					}
					?>
					
				</div>
				<!-- <div class="col-12 col-lg-12 mt-5">
							<img src="img/mob.jpg" alt="">
						</div> -->
				</div>
			</div>
        </div>

        <?php include_once "footer.php";?>

		<?php include_once "footer_script.php";?>
	</body>
</html>