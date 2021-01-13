<?php
class Model
{
    public static $conn = '';
    function __construct(){
	try{
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'lion_sport';
        $attr = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        self::$conn = new PDO('mysql:host=' . $servername . ';dbname=' . $dbname, $username, $password, $attr);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return self::$conn;
		}
		catch(PDOException $e)
		{
		echo "Connection failed: " . $e->getMessage();
		}
    }
    public static function doSelect($sql, $values = array(), $fetch = '', $fetchStyle = PDO::FETCH_ASSOC){
		$stmt = self::$conn->prepare($sql);
		foreach ($values as $key => $value) {
			$stmt->bindValue($key + 1, $value);
		}
		$stmt->execute();
		if ($fetch == '') {
			$result = $stmt->fetchAll($fetchStyle);
		} else {
			$result = $stmt->fetch($fetchStyle);
		}
		return $result;
		$stmt=null;
		self::$conn=null;
	} 
	public static function doUpdate($sqlu, $values = array()){
		$stmt = self::$conn->prepare($sqlu);
		foreach ($values as $key => $value) {
			$stmt->bindValue($key + 1, $value);
		}
		$stmt->execute();
		$stmt=null;
		// self::$conn=null;
	} 
	public static function doDelete($sqld, $values = array()){
		$stmt = self::$conn->prepare($sqld);
		foreach ($values as $key => $value) {
			$stmt->bindValue($key + 1, $value);
		}
		$stmt->execute();
		$stmt=null;
		// self::$conn=null;
	} 
	public static function doinsert($sql, $values = array()){
        $stmt = self::$conn->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        $stmt->execute();
		$stmt=null;
		// self::$conn=null;
    }
	public static function objectToArray($d) {
		if (is_object($d)) {
			$d = get_object_vars($d);
		}
		if (is_array($d)) {
			return array_map(__FUNCTION__, $d);
		}
		else {
			return $d;
		}
	}
	public static function sessionInit(){
       session_start();
   }
	public static function sessionSet($name, $value){
       $_SESSION[$name] = $value;
   }
	public static function sessionUnSet($name){
       unset($_SESSION[$name]);
   }
	public static function sessiondestroy(){
       session_destroy();
   }
	public static function sessionGet($name){
       if (isset($_SESSION[$name])) {
           return $_SESSION[$name];
       } else {
           return false;
       }
   }
	function Poker_API($params){
		$url = "https://hvdf99.xyz:8443/lionroyalapi";  // put your API path here
		$pw = "M4dhi1IKfW^7)XCgm8FLnruli#TQD6J2p*Ef*tf";                  // put your API password here
		$passwordCallback = "M4dhi1IKfW^7)XCgm8FLnruli#TQD6J2p*Ef*tf";
		$params['Password'] = $pw;
		$params['JSON'] = 'Yes';
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($curl, CURLOPT_VERBOSE, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($curl);
		if (curl_errno($curl)){ 
		$obj = (object) array('Result' => 'Error', 'Error' => curl_error($curl)); 
		}else if (empty($response)){ 
			$obj = (object) array('Result' => 'Error', 'Error' => 'Connection failed'); 
	}else{ $obj = json_decode($response);}
		curl_close($curl);
		return $obj;
	}
	function encode($string, $key){
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
	$hash ="";
	$j=0;
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
    return $hash;
}
	function decode($string, $key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
	$j=0;
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
	} 

}
?>