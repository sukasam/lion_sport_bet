<?php
//  include_once("function/app_top.php");
session_start();

if (isset($_GET['lang'])) {
    if ($_GET['lang'] === "en") {
        $_SESSION['Player_Lang'] = "en";
        header("Location:main.php");
    } else if ($_GET['lang'] === "ir") {
        $_SESSION['Player_Lang'] = "ir";
        header("Location:main.php");
    } else {
        $_SESSION['Player_Lang'] = "en";
        header("Location:main.php");
    }
} else {
    if (isset($_SESSION['Player_Lang'])) {
        if ($_SESSION['Player_Lang'] === "ir") {
            include_once "function/lang_ir.php";
        } else {
            include_once "function/lang_en.php";
        }
    } else {
        $_SESSION['Player_Lang'] = "en";
        include_once "function/lang_en.php";
    }

}

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

            <!-- Banner Start -->
		<!-- <div class="main-wrapper">


			<div class="slideWeb d-none d-lg-block d-xl-block">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
						<img src="img/banner/banner1.jpg" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
						<img src="img/banner/banner2.jpg" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
						<img src="img/banner/banner3.jpg" class="d-block w-100" alt="...">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>

			<div class="slideMobile d-block d-lg-none .d-xl-none">
				<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
						<img src="img/banner/banner1.jpg" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
						<img src="img/banner/banner2.jpg" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
						<img src="img/banner/banner3.jpg" class="d-block w-100" alt="...">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>

		</div> -->
		<!-- End Banner -->

		<!-- <div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8">
				asad
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4">
				asdad
			</div>
		</div> -->
		<div class="main-content bg-white moregame-content pb-60 ">
			<div class="container">
				<!--Carousel Wrapper-->
				<div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">

					<!--Controls-->
					<div class="controls-top">
						<a class="txmore-game">MORE GAMES</a>
						<a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-circle-left fa-3"></i></a>
						<a class="btn-floating pl-0" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-circle-right fa-3"></i></a>
					</div>
					<!--/.Controls-->

					<!--Indicators-->
					<!-- <ol class="carousel-indicators">
						<li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
						<li data-target="#multi-item-example" data-slide-to="1"></li>
						
					</ol> -->
					<!--/.Indicators-->

					<!--Slides-->
					<div class="carousel-inner" role="listbox">

						<!--First slide-->
						<div class="carousel-item active">
							<div class="col-md-4" style="float:left">
								<div class="bodyBox brand_bg_primary">
									<div class="txBoxtitle">
										<p>
											<span class="" role="text">
												<span class="text_element">This Tuesday</span>
												<span class="line_element"></span>
											</span>
										</p>
										<p>
											<span class="text_element_title">EUROMILLIONS<sup>r</sup></span>
										</p>
									</div>
									<div class="txGameContent">
										<div class="lockup" role="text">
											<p class="line line_1">£79M<sup>*</sup></p>
											<p class="line line_2">JACKPOT</p>
											<p class="line line_3">DREAM COME TRUE MONEY</p>
										</div>
									</div>
									<div class="text-center">
										<button type="button" class="btn btn-primary cuk_btn_primary">PLAY FOR £2.50</button>
									</div>
								</div>
							</div>		
							
							<div class="col-md-4" style="float:left">
								<div class="bodyBox brand_bg_primary">
									<div class="txBoxtitle">
										<p>
											<span class="" role="text">
												<span class="text_element">This Tuesday</span>
												<span class="line_element"></span>
											</span>
										</p>
										<p>
											<span class="text_element_title">EUROMILLIONS<sup>r</sup></span>
										</p>
									</div>
									<div class="txGameContent">
										<div class="lockup" role="text">
											<p class="line line_1">£79M<sup>*</sup></p>
											<p class="line line_2">JACKPOT</p>
											<p class="line line_3">DREAM COME TRUE MONEY</p>
										</div>
									</div>
									<div class="text-center">
										<button type="button" class="btn btn-primary cuk_btn_primary">PLAY FOR £2.50</button>
									</div>
								</div>
							</div>		

							<div class="col-md-4" style="float:left">
								<div class="bodyBox brand_bg_primary">
									<div class="txBoxtitle">
										<p>
											<span class="" role="text">
												<span class="text_element">This Tuesday</span>
												<span class="line_element"></span>
											</span>
										</p>
										<p>
											<span class="text_element_title">EUROMILLIONS<sup>r</sup></span>
										</p>
									</div>
									<div class="txGameContent">
										<div class="lockup" role="text">
											<p class="line line_1">£79M<sup>*</sup></p>
											<p class="line line_2">JACKPOT</p>
											<p class="line line_3">DREAM COME TRUE MONEY</p>
										</div>
									</div>
									<div class="text-center">
										<button type="button" class="btn btn-primary cuk_btn_primary">PLAY FOR £2.50</button>
									</div>
								</div>
							</div>		
						</div>
						<!--/.First slide-->

						<!--First slide-->
						<div class="carousel-item">
							<div class="col-md-4" style="float:left">
								<div class="bodyBox brand_bg_primary">
									<div class="txBoxtitle">
										<p>
											<span class="" role="text">
												<span class="text_element">This Tuesday</span>
												<span class="line_element"></span>
											</span>
										</p>
										<p>
											<span class="text_element_title">EUROMILLIONS<sup>r</sup></span>
										</p>
									</div>
									<div class="txGameContent">
										<div class="lockup" role="text">
											<p class="line line_1">£79M<sup>*</sup></p>
											<p class="line line_2">JACKPOT</p>
											<p class="line line_3">DREAM COME TRUE MONEY</p>
										</div>
									</div>
									<div class="text-center">
										<button type="button" class="btn btn-primary cuk_btn_primary">PLAY FOR £2.50</button>
									</div>
								</div>
							</div>		
							
							<div class="col-md-4" style="float:left">
								<div class="bodyBox brand_bg_primary">
									<div class="txBoxtitle">
										<p>
											<span class="" role="text">
												<span class="text_element">This Tuesday</span>
												<span class="line_element"></span>
											</span>
										</p>
										<p>
											<span class="text_element_title">EUROMILLIONS<sup>r</sup></span>
										</p>
									</div>
									<div class="txGameContent">
										<div class="lockup" role="text">
											<p class="line line_1">£79M<sup>*</sup></p>
											<p class="line line_2">JACKPOT</p>
											<p class="line line_3">DREAM COME TRUE MONEY</p>
										</div>
									</div>
									<div class="text-center">
										<button type="button" class="btn btn-primary cuk_btn_primary">PLAY FOR £2.50</button>
									</div>
								</div>
							</div>		

							<div class="col-md-4" style="float:left">
								<div class="bodyBox brand_bg_primary">
									<div class="txBoxtitle">
										<p>
											<span class="" role="text">
												<span class="text_element">This Tuesday</span>
												<span class="line_element"></span>
											</span>
										</p>
										<p>
											<span class="text_element_title">EUROMILLIONS<sup>r</sup></span>
										</p>
									</div>
									<div class="txGameContent">
										<div class="lockup" role="text">
											<p class="line line_1">£79M<sup>*</sup></p>
											<p class="line line_2">JACKPOT</p>
											<p class="line line_3">DREAM COME TRUE MONEY</p>
										</div>
									</div>
									<div class="text-center">
										<button type="button" class="btn btn-primary cuk_btn_primary">PLAY FOR £2.50</button>
									</div>
								</div>
							</div>		
						</div>
						<!--/.First slide-->

					</div>
					<!--/.Slides-->
				</div>
				<!--/.Carousel Wrapper-->
			</div>
		</div>

		<div class="main-content bg-white pt-3 pb-5">
           <div class="container">
				<!-- <div class="cuk cuk_homepage_notification">
					<span class="tab_line" role="text">
						<span class="text_element cuk_d_b12">Sorry, Our Games Are Taking A Break And Will Be Back Online At 6AM</span>
						<span class="line_element"></span>
					</span>
				</div> -->

				<div class="counter_wrapper">

					<div class="row">
						<div class="col-md-6">
							<div class="counter_section counter_text">
								<h2 class="margin_bottom_medium">
									<span class="line line_1">Did You Know?</span>
									<span class="line line_2">Players Like</span>
									<span class="line line_3">You Have Raised...</span>
								</h2>
							</div>
							<div class="counter_button">
								<!-- <a href="#" class="cuk_btn cuk_btn_primary">DISCOVER WINNERS &amp; GOOD CAUSES</a> -->
								<button type="button" class="btn btn-primary cuk_btn_primary">DISCOVER WINNERS &amp; GOOD CAUSES</button>
							</div>
						</div>
						<div class="col-md-6">
							<div class="counter_section counter_total">
								<p class="counter_figure counter">
									<span id="counter" data-cashfinal="30000000" data-date="2020/10/26">£6,166,648</span>                                  
								</p>
								<span class="counter_line ">(and counting) this week</span>
							</div>
						</div>
					</div>

					

				</div>

			</div>
        </div>

        <?php include_once "footer.php";?>

		<?php include_once "footer_script.php";?>
	</body>
</html>