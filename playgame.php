<?php
	include_once("function/app_top.php");

	$params = array("Command" => "AccountsSessionKey", "Player" => $_SESSION['Player']);
    $api = Poker_API($params);
    if ($api -> Result != "Ok"){
		die($api -> Error . "<br/>" . "Click Back Button to retry.");
	}else{
		$key = $api -> SessionKey;
	}
	
	
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Poker - Poker</title>
		<link href="css/cstyles.min.css" rel="stylesheet">
		<style>[data-columns]::before{display:block;visibility:hidden;position:absolute;font-size:1px;}</style>
	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130683010-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-130683010-1');
    </script>
	
	</head>
	<style>html, body, iframe { height: 100%; }</style>
	<body style="margin:0px;padding:0px;overflow:hidden">
    <iframe src="http://<?php echo $_SERVER['SERVER_NAME']?>:2082/?LoginName=<?php echo $_SESSION['Player'];?>&SessionKey=<?php echo $key;?>" frameborder="0" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%"></iframe>
</body> 
</html>
