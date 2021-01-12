<?php 
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
// function generateCode($characters) {
//     $possible = '1234567890';  // ตัวอักษรที่ต้องการจะเอาสุ่มเป็น Captcha
//     $code = '';
//     $i = 0;
//     while ($i < $characters) { 
//       $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
//       $i++;
//     }
//     return $code;
//  }
?>