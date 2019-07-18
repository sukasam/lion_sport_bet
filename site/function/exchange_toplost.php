<?php
//print_r($_POST);
//include_once("app_top.php");
session_start();
include_once("app_top1.php");
include_once('poker_api.php');
// Array
// (
//     [amount] => 4000
//     [point_type] => top_win
//     [player] => D_D
//     [dateC] => 2018-12-15
//     [timeC] => 10:05:28
// )

$csrf = new csrf();
 
// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
if($csrf->check_valid('post')) {
    if($_POST){
///////////////////////////
		$taste=$_SESSION['tStHtLtW'];
		$taste=base64_decode($taste);
		$taste=explode("-",$taste);
		if (count($taste)==4){
			$plyerO=$taste[0];
			$rth=$taste[1];
			$rth=str_replace("QkYXHax", "", $rth);
			$rth=base64_decode($rth);
			$rth=intval($rth)/9856;
			$rtl=$taste[2];
			$rtl=str_replace("Q8BW)tH", "", $rtl);
			$rtl=base64_decode($rtl);
			$rtl=$rtl/8569;
			$rdp=$taste[3];
			$rdp=str_replace("QEw71eup", "", $rdp);
			$rdp=base64_decode($rdp);
			$rdp=(floatval($rdp)/546);
			///////////////////////////
			$Player = $db->CleanDBData($_POST['player']);
			if(hash('sha256',$Player) == $plyerO){	
				$pointType = $db->CleanDBData($_POST['point_type']);
				$amount = $db->CleanDBData($_POST['amount']);
				$dateC = $db->CleanDBData($_POST['dateC']);
				$timeC = $db->CleanDBData($_POST['timeC']);
				$amount = preg_replace('/\//'(',', '', $amount);
				if (strval($amount) == strval($rtl)){
					unset($_SESSION['tStHtLtW']);
					$postfields1 = array(
						'player'=> $Player,
						'point' => $amount, 
						'point_type' => $pointType, 
						'date' => $dateC, 
						'time' => $timeC, 
						'logs'=>'checkPoint'
					);
				
					$responseP = curl_post(API_SITE,$postfields1);
				
					if($responseP == "0"){
				
						$postfields = array(
							'player'=> $Player,
							'point' => $amount, 
							'point_type' => $pointType, 
							'date' => $dateC, 
							'time' =>  $timeC, 
							'logs'=>'point_log'
						);
						
						$response = curl_post(API_SITE,$postfields);
				
						$params = array("Command"  => "AccountsIncBalance",
						"Player"   => $Player,
						"Amount"   => $amount);
						$api = Poker_API($params);
				
						if ($api -> Result == "Ok"){
				
							$array_where = array(    
							'player' => $Player,
							);
						
							$Qry = $db->Delete('top_lost',$array_where);
							
				
							$_SESSION['errors_code2'] = "alert-success";
							$_SESSION['errors_msg2'] = "Your point has been exchange to balance.";
					
							echo "1";
						   // header("Location:".SiteRootDir."account.php?action=success");
				
							
						}else{
							$_SESSION['errors_code2'] = "alert-danger";
							$_SESSION['errors_msg2'] = $api -> Error;
					
							echo "2";
							//header("Location:".SiteRootDir."account.php?action=failed");
						}
					}else{
						echo "2";
						$_SESSION['errors_code2'] = "alert-danger";
						$_SESSION['errors_msg2'] = "The same amount that has been exchanged with the last time. Please try again later.";
					}
				}else{
					echo "2";
					$_SESSION['errors_code2'] = "alert-danger";
					$_SESSION['errors_msg2'] = "Please Don't Chang Amount.";
				}
			}else{
				echo "2";
				$_SESSION['errors_code2'] = "alert-danger";
				$_SESSION['errors_msg2'] = "Player Not Accepted.";
			}
		}else{
			echo "2";
			$_SESSION['errors_code2'] = "alert-danger";
			$_SESSION['errors_msg2'] = "Problem With Request Data.";
		}		
    }else{
        echo "2";
    }
}

?>