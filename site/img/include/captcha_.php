<?php

		session_start();
		
		function generateCode($characters) {
		  $possible = '0123456789';  // ตัวอักษรที่ต้องการจะเอาสุ่มเป็น Captcha
		  $code = '';
		  $i = 0;
		  while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		  }
		  return $code;
		 }

		$font = '../fonts/robotobold.ttf';  // เปลี่ยน font ได้ตามต้องการ
		 
		$width = isset($_GET['width']) && $_GET['height'] < 600 ? $_GET['width'] : '350';
		$height = isset($_GET['height']) && $_GET['height'] < 200 ? $_GET['height'] : '30';
		$characters = isset($_GET['characters']) && $_GET['characters'] > 2 ? $_GET['characters'] : '4';

		$code = generateCode($characters);
		$font_size = $height * 0.5;  // font size ที่จะโชว์ใน Captcha
		$image = imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		$background_color = imagecolorallocate($image, 255, 195, 18);  // กำหนดสีในส่วนต่่างๆ
		$text_color = imagecolorallocate($image, 16, 13, 5);
		//$noise_color = imagecolorallocate($image, 172, 208, 95);
		for( $i=0; $i<($width*$height)/5; $i++ ) { // สุ่มจุดภาพพื้นหลัง
		imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* for( $i=0; $i<($width*$height)/200; $i++ ) { // สุ่มเ้ส้นภาพพื้นหลัง
		imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}*/
		/* สร้าง Text box และเพิ่ม Text */
		$textbox = imagettfbbox($font_size, 0, $font, $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code) or die('Error in imagettftext function');
		/* display captcha image ไปที่ browser */
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
		$_SESSION['security_code'] = $code;
  
		// $random_alpha = md5(rand());
		// $captcha_code = generateCode(4);
		// $_SESSION["security_code"] = $captcha_code;
		// $target_layer = imagecreatetruecolor($width,$height);
		// $captcha_background = imagecolorallocate($target_layer, 255, 195, 18);
		// imagefill($target_layer,0,0,$captcha_background);
		// $captcha_text_color = imagecolorallocate($target_layer, 16, 13, 5);
		// imagestring($target_layer, 5, 5, 5, $captcha_code, $captcha_text_color);
		// header("Content-type: image/jpeg");
		// imagejpeg($target_layer);

?>