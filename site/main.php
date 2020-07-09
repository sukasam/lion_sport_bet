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

            <!-- About Generic Start -->
		<div class="main-wrapper ">


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
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
						<img src="img/banner/bannerM1.jpg" class="d-block w-100" alt="...">
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

			<!-- <div class="row">
				<div class="col-12">
					<div class="slide d-none d-lg-block d-xl-none">
						<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img class="d-block w-100" src="img/banner/banner1.jpg" alt="First slide">
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="img/banner/banner2.jpg" alt="Second slide">
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="img/banner/banner3.jpg" alt="Third slide">
								</div>
							</div>
							<ol class="carousel-indicators">
								<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
							</ol>
							<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>

					<div class="slide d-xl-none">
						<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img class="d-block w-100" src="img/banner/banner1.jpg" alt="First slide">
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="img/banner/banner2.jpg" alt="Second slide">
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="img/banner/banner3.jpg" alt="Third slide">
								</div>
							</div>
							<ol class="carousel-indicators">
								<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
							</ol>
							<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div> -->


        </div>

        <?php include_once "footer.php";?>

		<?php include_once "footer_script.php";?>
	</body>
</html>