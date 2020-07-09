<?php
$v = date("YmdHis");
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Lion Royal Online Sports Betting - Login</title>
   <!--Made with love by Mutiullah Samim -->
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="css/bootstrap.css">
    <!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/main_home.css?v=<?php echo $v; ?>">
	<meta name="google-site-verification" content="q0CqLkSJnBCJyABXMpI_xraMMv6X-MLZUOzFhNZm7qE" />
	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130683010-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-130683010-1');
    </script>

</head>
<body>
<div class="container">
	<div class="d-flex h-100">
		<div class="card" style="width: 100%;">
			<div class="card-header headerMain">
				<?php include_once "top_main.php";?>
			</div>
			<div class="card-body">
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
			<?php include_once "footer_main.php";?>
		</div>
	</div>
</div>
<?php include_once "footer_script.php";?>
</body>
</html>