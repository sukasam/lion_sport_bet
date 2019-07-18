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
		$taste=$_SESSION['tcutknivt'];
		$taste=base64_decode($taste);
		$taste=explode("-",$taste);
		if (count($taste)==3){
			$plyerO=$taste[0];
			$rths=$taste[1];
			$rths=str_replace("QNTQ2QEw", "", $rths);
			$rths=base64_decode($rths);
			$rths=intval($rths)/615;
			$Player = $db->CleanDBData($_POST['player']);
			if(hash('sha256',$Player) == $plyerO){
				$totalC = preg_replace('/\//'(',', '', $db->CleanDBData($_POST["totalC"]));
				if (strval($totalC) == strval($rths)){
					unset($_SESSION['tcutknivt']);
					$postfields1 = array(
						'player'=> $_SESSION['Player'],
						'date' => $db->CleanDBData($_POST['dateC']), 
						'time' =>  $db->CleanDBData($_POST['timeC']), 
						'amount'=> $totalC,
						'logs'=>'checkCommistion'
					);
				
					$responseC = curl_post(API_SITE,$postfields1);

					if($responseC == "0"){
				
						$postfields = array(
							'player'=> $_SESSION['Player'],
							'date' => $db->CleanDBData($_POST['dateC']), 
							'time' =>  $db->CleanDBData($_POST['timeC']), 
							'amount'=> $totalC,
							'logs'=>'commission_history_log'
						);
						
						$response = curl_post(API_SITE,$postfields);

						$update_arraysP = array(
							'commistion' => 0,
						  );
						  $where_arraysP = array(
							'player' => $_SESSION['Player'],
						  );
						
						  //if ran successfully it will reture last insert id, else 0 for error
						  $q  = $db->Update('commission_invite',$update_arraysP,$where_arraysP);
				
						// Update to database
						foreach ($_POST['affiliate'] as $key => $value) {

							set_time_limit(0);
							$params2 = array("Command"  => "AccountsEdit",
							"Player"   => $value,
							"ERake"   => "0");
							$api2 = Poker_API($params2);
						}

						$params = array("Command"  => "AccountsIncBalance",
						"Player"   => $Player,
						"Amount"   => $totalC);
						$api = Poker_API($params);

						// print_r($api);
						// exit();
						
						if ($api -> Result == "Ok"){
				
							$_SESSION['errors_code'] = "alert-success";
							$_SESSION['errors_msg'] = "Your commission has been withdrawn.";
				
							echo "0";
							//header("Location:".SiteRootDir."invite.php?action=success"); 
				
						}else{
							$_SESSION['errors_code'] = "alert-danger";
							$_SESSION['errors_msg'] = $api -> Error;
				
							echo "1";
					
							// header("Location:".SiteRootDir."invite.php?action=failed");
						}
					}else{
						// $_SESSION['errors_code'] = "alert-danger";
						// $_SESSION['errors_msg'] = "Withdrawing your commissions has a problem. Please try again.";
						$_SESSION['errors_code'] = "alert-success";
						$_SESSION['errors_msg'] = "Your commission has been withdrawn.";
				
						echo "2";
				
						// header("Location:".SiteRootDir."invite.php?action=success"); 
					}
				}else{
					echo "2";
					$_SESSION['errors_code'] = "alert-danger";
					$_SESSION['errors_msg'] = "Please Don't Change Amount.";
				}
			}else{
				echo "2";
				$_SESSION['errors_code'] = "alert-danger";
				$_SESSION['errors_msg'] = "Player Not Accepted.";
			}
		}else{
			echo "2";
			$_SESSION['errors_code'] = "alert-danger";
			$_SESSION['errors_msg'] = "Problem With Request Data.";
		}
	}else{
        echo "2";
    }   
}
?>