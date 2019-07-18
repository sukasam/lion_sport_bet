<?php
$uri=$_SERVER['REQUEST_URI'];

	$uri=explode("&",$uri);
	$muser=explode("=",$uri[0]);
if (!empty ($muser)){	
	$user=$muser[1];
	$p01=$muser[0];
	$p01=$p01[2].$p01[3];
	$msid=explode("=",$uri[1]);
	$sid=$msid[1];
	$p02=$msid[0];

	if ($user != "" && $sid != ""){
		if($p01 === "LN" && $p02 === "SK"){
			$add= "http://185.169.253.150:8087/?LoginName=".$user."&SessionKey=".$sid;
		}else{
			$add= "http://localhost";
		}
	}else{
		$add= "http://localhost";
	}
}else{
	$add= "http://localhost";
	}
?>
<html>
	<body style="margin:0px;padding:0px;overflow:hidden">
		<iframe src="<?php echo $add?>" frameborder="0" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%"></iframe>
	</body> 
</html>