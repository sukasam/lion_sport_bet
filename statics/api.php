<?php

include_once('../_inc/config.php');

if(isset($_REQUEST['logs']) && $_REQUEST['logs'] === "autoscript"){

	$dateP = $db->CleanDBData($_POST['date']);
	$table_game = $db->CleanDBData($_POST['table_game']);
	
	
	$RecData = $db->select("SELECT * FROM count_autoscript WHERE date='".$dateP."' AND table_game='".$table_game."'");

	if($RecData[0]['id'] == ""){
		$insert_arrays = array(
			'date'=> $db->CleanDBData($_POST['date']),
			'table_game'=> $db->CleanDBData($_POST['table_game']),
			'rec_count'=> $db->CleanDBData($_POST['rec_count']),
		);
	
		//if ran successfully it will reture last insert id, else 0 for error
		$q  = $db->insert('count_autoscript',$insert_arrays);
	}else{
		$array_fields = array(
			'rec_count'=> $db->CleanDBData($_POST['rec_count']),
		);
		
		$array_where = array(    
			'date'=> $db->CleanDBData($_POST['date']),
			'table_game'=> $db->CleanDBData($_POST['table_game']),
		);
	
		$q = $db->Update('count_autoscript', $array_fields, $array_where);
	}
    
}

if(isset($_POST['logs']) && $_POST['logs'] === "getcount_autoscript"){
	
	$RecData = $db->select("SELECT rec_count FROM count_autoscript WHERE date='".$db->CleanDBData($_POST['date'])."' AND table_game='".$db->CleanDBData($_POST['table_game'])."'");
	
	if($RecData[0]['rec_count'] != ""){
		echo $RecData[0]['rec_count'];
	}else{
		echo 0;
	}
	
	
}

if(isset($_POST['logs']) && $_POST['logs'] === "report_login"){

    $insert_arrays = array(
		'player' => $db->CleanDBData($_POST['player']),
		'domain' => $db->CleanDBData($_POST['domain']),
		'ip' => $db->CleanDBData($_POST['ip']),
		'date'=>$db->CleanDBData($_POST['date']),
		'time'=>$db->CleanDBData($_POST['time']),
		'action'=>$db->CleanDBData($_POST['action'])
	);

	//if ran successfully it will reture last insert id, else 0 for error
     $q  = $db->insert('reports_logins',$insert_arrays);
}

if(isset($_POST['logs']) && $_POST['logs'] === "affiliate_log"){

    $insert_arrays = array(
		'affiliate' => $db->CleanDBData($_POST['affiliate']),
		'player' => $db->CleanDBData($_POST['player']),
		'date' => $db->CleanDBData($_POST['date']),
		'time' => $db->CleanDBData($_POST['time']),
		'action' => $db->CleanDBData($_POST['action']),
		'commission' => $db->CleanDBData($_POST['commission']),
		'amount' => $db->CleanDBData($_POST['amount'])
	);

	//if ran successfully it will reture last insert id, else 0 for error
     $q  = $db->insert('affiliate',$insert_arrays);
}

if(isset($_POST['logs']) && $_POST['logs'] === "tickers_log"){

    $insert_arrays = array(
		'tkid' => $db->CleanDBData($_POST['tkid']),
		'player' => $db->CleanDBData($_POST['player']),
		'subject' => $db->CleanDBData($_POST['subject']),
		'detail' => $db->CleanDBData($_POST['detail']),
		'date' => $db->CleanDBData($_POST['date']),
		'time' => $db->CleanDBData($_POST['time']),
		'action' => $db->CleanDBData($_POST['action'])
	);

	//if ran successfully it will reture last insert id, else 0 for error
     $q  = $db->insert('tickets',$insert_arrays);
}

if(isset($_POST['logs']) && $_POST['logs'] === "tickets_detail"){

    $insert_arrays = array(
		'tid' => $db->CleanDBData($_POST['tid']),
		'player' => $db->CleanDBData($_POST['player']),
		'detail' => $db->CleanDBData($_POST['detail']),
		'date' => $db->CleanDBData($_POST['date']),
		'time' => $db->CleanDBData($_POST['time']),
		'action' => $db->CleanDBData($_POST['action']),
	);

	//if ran successfully it will reture last insert id, else 0 for error
     $q  = $db->insert('tickets_detail',$insert_arrays);
}

if(isset($_POST['logs']) && $_POST['logs'] === "deposit_ev"){

	$insert_arrays = array(
		'player'=> $db->CleanDBData($_POST['player']), 
		'VOUCHER_NUM' => $db->CleanDBData($_POST['VOUCHER_NUM']),
		'VOUCHER_ACTIVE' => $db->CleanDBData($_POST['VOUCHER_ACTIVE']),
    	'VOUCHER_AMOUNT' => $db->CleanDBData($_POST['VOUCHER_AMOUNT']),
        'VOUCHER_AMOUNT_CURRENCY' => $db->CleanDBData($_POST['VOUCHER_AMOUNT_CURRENCY']),
        'Payee_Account' => $db->CleanDBData($_POST['Payee_Account']),
        'PAYMENT_BATCH_NUM' => $db->CleanDBData($_POST['PAYMENT_BATCH_NUM']),
        'date' => $db->CleanDBData($_POST['date']),
		'time' => $db->CleanDBData($_POST['time']),
	);
	
	$q  = $db->insert('deposit_evoucher',$insert_arrays);

}

if(isset($_POST['logs']) && $_POST['logs'] === "withdraw_ev"){

	$insert_arrays = array(
		'player'=> $db->CleanDBData($_POST['player']), 
		'Payer_Account' => $db->CleanDBData($_POST['Payer_Account']),
		'PAYMENT_AMOUNT' => $db->CleanDBData($_POST['PAYMENT_AMOUNT']),
		'PAYMENT_BATCH_NUM' => $db->CleanDBData($_POST['PAYMENT_BATCH_NUM']),
		'VOUCHER_NUM' => $db->CleanDBData($_POST['VOUCHER_NUM']),
		'VOUCHER_CODE' => $db->CleanDBData($_POST['VOUCHER_CODE']),
    'VOUCHER_AMOUNT' => $db->CleanDBData($_POST['VOUCHER_AMOUNT']),    
    'date' => $db->CleanDBData($_POST['date']),
		'time' => $db->CleanDBData($_POST['time']),
	);
	
	$q  = $db->insert('withdraw_voucher',$insert_arrays);

}

if(isset($_POST['logs']) && $_POST['logs'] === "deposit_cardonline_log"){

	$insert_arrays = array(
		'player'=> $db->CleanDBData($_POST['player']), 
    'amount' => $db->CleanDBData($_POST['amount']),
    'cardnumber' => $db->CleanDBData($_POST['cardnumber']),
    'pin2' => $db->CleanDBData($_POST['pin2']),
    'm_exp' => $db->CleanDBData($_POST['m_exp']),
		'y_exp' => $db->CleanDBData($_POST['y_exp']),
		'ccv' => $db->CleanDBData($_POST['ccv']),
    'date' => $db->CleanDBData($_POST['date']),
		'time' => $db->CleanDBData($_POST['time']),
	);
	
	$q  = $db->insert('deposit_onlinecard',$insert_arrays);

}

if(isset($_POST['logs']) && $_POST['logs'] === "deposit_history_log"){

	$RecData = $db->select("SELECT * FROM deposit_history WHERE tran_id='".$db->CleanDBData($_POST['tran_id'])."' AND player ='".$db->CleanDBData($_POST['player'])."' AND amount = '".$db->CleanDBData($_POST['amount'])."'");

	if($RecData[0]['id'] != ""){
		
		$array_fields = array(
			'status' => $db->CleanDBData($_POST['status']),
		);
		
		$array_where = array(    
			'tran_id' => $db->CleanDBData($_POST['tran_id']),
		);
	
		$q = $db->Update('deposit_history', $array_fields, $array_where);

	}else{
		
		$insert_arrays = array(
			'player'=> $db->CleanDBData($_POST['player']), 
			'amount' => $db->CleanDBData($_POST['amount']),
			'deposit_type' => $db->CleanDBData($_POST['deposit_type']),
			'date' => $db->CleanDBData($_POST['date']),
			'time' => $db->CleanDBData($_POST['time']),
			'tran_id' => $db->CleanDBData($_POST['tran_id']),
			'currency' => $db->CleanDBData($_POST['currency']),
			'status' => $db->CleanDBData($_POST['status']),
		);
		
		$q  = $db->insert('deposit_history',$insert_arrays);
	}

}

if(isset($_POST['logs']) && $_POST['logs'] === "pins_log"){
	$array_fields = array(
		'pin' => $db->CleanDBData($_POST['pins']),
	);
	
	$array_where = array(    
		'Player' => $db->CleanDBData($_POST['player']),
	);

	$q = $db->Update('user_pin', $array_fields, $array_where);
}


if(isset($_POST['logs']) && $_POST['logs'] === "withdraw_log"){

	$insert_arrays = array(
		'player'=> $db->CleanDBData($_POST['player']), 
		'amount'=> $db->CleanDBData($_POST['amount']), 
		'evoucher'=> $db->CleanDBData($_POST['evoucher']), 
    'activation_code'=> $db->CleanDBData($_POST['activation_code']), 
    'date' => $db->CleanDBData($_POST['date']),
		'time' => $db->CleanDBData($_POST['time']),
		'withdraw_type' => $db->CleanDBData($_POST['withdraw_type']),
		'status' => $db->CleanDBData($_POST['status']),
		'auto_withdraw' => $db->CleanDBData('0'),
	);
	
	$q  = $db->insert('withdraw_history',$insert_arrays);

}

if(isset($_POST['logs']) && $_POST['logs'] === "resetpoint_login"){
	
	$RecData = $db->select("SELECT * FROM reset_point_history WHERE point_type='".$db->CleanDBData($_POST['point_type'])."'");
	
	if($RecData[0]['id'] == ""){
		$insert_arrays = array(
			'point_type'=> $db->CleanDBData($_POST['point_type']), 
			'date' => $db->CleanDBData($_POST['date']),
			'time' => $db->CleanDBData($_POST['time']),
			'action' => $db->CleanDBData($_POST['action']),
		);
		
		$q  = $db->insert('reset_point_history',$insert_arrays);
	}else{
		$array_fields = array(
			'date' => $db->CleanDBData($_POST['date']),
			'time' => $db->CleanDBData($_POST['time']),
			'action' => $db->CleanDBData($_POST['action']),
			);
		
			$array_where = array(    
			'point_type' => $db->CleanDBData($_POST['point_type']),
			);
		
			$q = $db->Update('reset_point_history', $array_fields, $array_where);
	}
	
}

if(isset($_POST['logs']) && $_POST['logs'] === "tophand_log"){

	$RecData = $db->select("SELECT id FROM top_hand WHERE player='".$db->CleanDBData($_POST['player'])."' AND table_game='".$db->CleanDBData($_POST['table_game'])."' AND handID='".$db->CleanDBData($_POST['handID'])."' AND date='".$db->CleanDBData($_POST['date'])."' AND time='".$db->CleanDBData($_POST['time'])."'");
	$RecPoint = $db->select("SELECT * FROM point_history WHERE player='".$db->CleanDBData($_POST['player'])."' AND point_type = 'top_hand' ORDER BY id DESC");
	$RecRestetHand = $db->select("SELECT * FROM reset_point_history WHERE point_type = 'top_hand'");


	if($RecData[0]['id'] == ""){

		if($RecRestetHand[0]['date'] != ""){

			if($RecPoint[0]['id'] != ""){

				$date_point = $RecPoint[0]['date']." ".$RecPoint[0]['time'];
				$date_reset = $RecRestetHand[0]['date']." ".$RecRestetHand[0]['time'];
				$date_game = $_POST['date']." ".$_POST['time'];
	
				if(strtotime($date_point) > strtotime($date_reset)){
					if(strtotime($date_game) > strtotime($date_point)){
						$insert_arrays = array(
							'player'=> $db->CleanDBData($_POST['player']),
							'table_game'=> $db->CleanDBData($_POST['table_game']),
							'handID'=> $db->CleanDBData($_POST['handID']),
							'date'=> $db->CleanDBData($_POST['date']),
							'time'=> $db->CleanDBData($_POST['time']),
							'point'=> $db->CleanDBData($_POST['point']),
						);
						
						$q  = $db->insert('top_hand',$insert_arrays);
					}
				}else{
					if(strtotime($date_game) > strtotime($date_reset)){
						$insert_arrays = array(
							'player'=> $db->CleanDBData($_POST['player']),
							'table_game'=> $db->CleanDBData($_POST['table_game']),
							'handID'=> $db->CleanDBData($_POST['handID']),
							'date'=> $db->CleanDBData($_POST['date']),
							'time'=> $db->CleanDBData($_POST['time']),
							'point'=> $db->CleanDBData($_POST['point']),
						);
						
						$q  = $db->insert('top_hand',$insert_arrays);
					}
				}

			}else{

				$date_reset = $RecRestetHand[0]['date']." ".$RecRestetHand[0]['time'];
				$date_game = $db->CleanDBData($_POST['date'])." ".$db->CleanDBData($_POST['time']);
				
				if(strtotime($date_game) > strtotime($date_reset)){
					$insert_arrays = array(
						'player'=> $db->CleanDBData($_POST['player']),
						'table_game'=> $db->CleanDBData($_POST['table_game']),
						'handID'=> $db->CleanDBData($_POST['handID']),
						'date'=> $db->CleanDBData($_POST['date']),
						'time'=> $db->CleanDBData($_POST['time']),
						'point'=> $db->CleanDBData($_POST['point']),
					);
					
					$q  = $db->insert('top_hand',$insert_arrays);
				}
			}

		}else{
			if($RecPoint[0]['id'] != ""){
				$date_point = $RecPoint[0]['date']." ".$RecPoint[0]['time'];
				$date_game = $db->CleanDBData($_POST['date'])." ".$db->CleanDBData($_POST['time']);
				
				if(strtotime($date_game) > strtotime($date_point)){
					$insert_arrays = array(
						'player'=> $db->CleanDBData($_POST['player']),
						'table_game'=> $db->CleanDBData($_POST['table_game']),
						'handID'=> $db->CleanDBData($_POST['handID']),
						'date'=> $db->CleanDBData($_POST['date']),
						'time'=> $db->CleanDBData($_POST['time']),
						'point'=> $db->CleanDBData($_POST['point']),
					);
					
					$q  = $db->insert('top_hand',$insert_arrays);
				}
			}else{
				$insert_arrays = array(
					'player'=> $db->CleanDBData($_POST['player']),
					'table_game'=> $db->CleanDBData($_POST['table_game']),
					'handID'=> $db->CleanDBData($_POST['handID']),
					'date'=> $db->CleanDBData($_POST['date']),
					'time'=> $db->CleanDBData($_POST['time']),
					'point'=> $db->CleanDBData($_POST['point']),
				);
				
				$q  = $db->insert('top_hand',$insert_arrays);
			}
		}
	}
	
}

if(isset($_POST['logs']) && $_POST['logs'] === "toplost_log"){
	
	$RecData = $db->select("SELECT id FROM top_lost WHERE player='".$db->CleanDBData($_POST['player'])."' AND table_game='".$db->CleanDBData($_POST['table_game'])."' AND handID='".$db->CleanDBData($_POST['handID'])."' AND date='".$db->CleanDBData($_POST['date'])."' AND time='".$db->CleanDBData($_POST['time'])."'");
	$RecPoint = $db->select("SELECT * FROM point_history WHERE player='".$db->CleanDBData($_POST['player'])."' AND point_type = 'top_lost' ORDER BY id DESC");
	$RecRestetLost = $db->select("SELECT * FROM reset_point_history WHERE point_type = 'bad_bit'");


	if($RecData[0]['id'] == ""){

		if($RecRestetLost[0]['date'] != ""){

			if($RecPoint[0]['id'] != ""){

				$date_point = $RecPoint[0]['date']." ".$RecPoint[0]['time'];
				$date_reset = $RecRestetLost[0]['date']." ".$RecRestetLost[0]['time'];
				$date_game = $db->CleanDBData($_POST['date'])." ".$db->CleanDBData($_POST['time']);
	
				if(strtotime($date_point) > strtotime($date_reset)){
					if(strtotime($date_game) > strtotime($date_point)){
						$insert_arrays = array(
							'player'=> $db->CleanDBData($_POST['player']),
							'table_game'=> $db->CleanDBData($_POST['table_game']),
							'handID'=> $db->CleanDBData($_POST['handID']),
							'date'=> $db->CleanDBData($_POST['date']),
							'time'=> $db->CleanDBData($_POST['time']),
							'point'=> $db->CleanDBData($_POST['point']),
						);
						
						$q  = $db->insert('top_lost',$insert_arrays);
					}
				}else{
					if(strtotime($date_game) > strtotime($date_reset)){
						$insert_arrays = array(
							'player'=> $db->CleanDBData($_POST['player']),
							'table_game'=> $db->CleanDBData($_POST['table_game']),
							'handID'=> $db->CleanDBData($_POST['handID']),
							'date'=> $db->CleanDBData($_POST['date']),
							'time'=> $db->CleanDBData($_POST['time']),
							'point'=> $db->CleanDBData($_POST['point']),
						);
						
						$q  = $db->insert('top_lost',$insert_arrays);
					}
				}

			}else{

				$date_reset = $RecRestetLost[0]['date']." ".$RecRestetLost[0]['time'];
				$date_game = $db->CleanDBData($_POST['date'])." ".$db->CleanDBData($_POST['time']);
				
				if(strtotime($date_game) > strtotime($date_reset)){
					$insert_arrays = array(
						'player'=> $db->CleanDBData($_POST['player']),
						'table_game'=> $db->CleanDBData($_POST['table_game']),
						'handID'=> $db->CleanDBData($_POST['handID']),
						'date'=> $db->CleanDBData($_POST['date']),
						'time'=> $db->CleanDBData($_POST['time']),
						'point'=> $db->CleanDBData($_POST['point']),
					);
					
					$q  = $db->insert('top_lost',$insert_arrays);
				}
			}

		}else{
			if($RecPoint[0]['id'] != ""){
				$date_point = $RecPoint[0]['date']." ".$RecPoint[0]['time'];
				$date_game = $db->CleanDBData($_POST['date'])." ".$db->CleanDBData($_POST['time']);
				
				if(strtotime($date_game) > strtotime($date_point)){
					$insert_arrays = array(
						'player'=> $db->CleanDBData($_POST['player']),
						'table_game'=> $db->CleanDBData($_POST['table_game']),
						'handID'=> $db->CleanDBData($_POST['handID']),
						'date'=> $db->CleanDBData($_POST['date']),
						'time'=> $db->CleanDBData($_POST['time']),
						'point'=> $db->CleanDBData($_POST['point']),
					);
					
					$q  = $db->insert('top_lost',$insert_arrays);
				}
			}else{
				$insert_arrays = array(
					'player'=> $db->CleanDBData($_POST['player']),
					'table_game'=> $db->CleanDBData($_POST['table_game']),
					'handID'=> $db->CleanDBData($_POST['handID']),
					'date'=> $db->CleanDBData($_POST['date']),
					'time'=> $db->CleanDBData($_POST['time']),
					'point'=> $db->CleanDBData($_POST['point']),
				);
				
				$q  = $db->insert('top_lost',$insert_arrays);
			}
		}
	}
}


if(isset($_POST['logs']) && $_POST['logs'] === "commission_history_log"){
	
	$insert_arrays = array(
		'player'=> $db->CleanDBData($_POST['player']), 
		'date'=> $db->CleanDBData($_POST['date']),
		'time'=> $db->CleanDBData($_POST['time']),
		'amount'=> $db->CleanDBData($_POST['amount']),
	);
	
	$q  = $db->insert('commission_history',$insert_arrays);
}


if(isset($_POST['logs']) && $_POST['logs'] === "checkWithdrawAuto"){

	// echo "SELECT * FROM withdraw_history WHERE amount = '".$_POST['amount']."' AND withdraw_type = '2' AND status = '0' AND auto_withdraw = 0";
	// exit();
	$RecData = $db->select("SELECT * FROM withdraw_history WHERE amount = '".$db->CleanDBData($_POST['amount'])."' AND withdraw_type = '2' AND status = '0' AND auto_withdraw = 0");
	if($RecData[0]['player'] != ""){
		$array_fields = array(
			'auto_withdraw'=> 1,
		);
	
		$array_where = array(    
		'id' => $RecData[0]['id'],  
		);
	
		$q = $db->Update('withdraw_history', $array_fields, $array_where);

		$RecDataBank = $db->select("SELECT * FROM bank_info WHERE player = '".$RecData[0]['player']."'");

		echo "9|".$RecDataBank[0]['bank_card']."|".$RecData[0]['id'];
	}else{
		echo "0|0|0";
	}
}


if(isset($_POST['logs']) && $_POST['logs'] === "cancelWithdrawAuto"){

		$array_fields = array(
			'auto_withdraw'=> 0,
		);
	
		$array_where = array(    
		'id' => $db->CleanDBData($_POST['idC']),  
		);
	
		echo $q = $db->Update('withdraw_history', $array_fields, $array_where);

}

if(isset($_POST['logs']) && $_POST['logs'] === "approveWithdrawAuto"){

	$array_fields = array(
		'status'=> "1",
		'comment'=>"Auto",
	);

	$array_where = array(    
	'id' => $db->CleanDBData($_POST['idC']),  
	);

	$q = $db->Update('withdraw_history', $array_fields, $array_where);

}


if(isset($_POST['logs']) && $_POST['logs'] === "commission_log"){
	$array_fields = array(
	'commission'=> $db->CleanDBData($_POST['commission']),
	'amount'=> $db->CleanDBData($_POST['amount']),
	);

	$array_where = array(    
	'player' => $db->CleanDBData($_POST['player']),  
	'affiliate' => $db->CleanDBData($_POST['affiliate']),
	);

	$q = $db->Update('affiliate', $array_fields, $array_where);
}

if(isset($_POST['logs']) && $_POST['logs'] === "point_log"){

	$insert_arrays = array(
		'player'=> $db->CleanDBData($_POST['player']), 
		'point'=> $db->CleanDBData($_POST['point']), 
		'point_type'=> $db->CleanDBData($_POST['point_type']), 
		'date'=> $db->CleanDBData($_POST['date']),
		'time'=> $db->CleanDBData($_POST['time']),
	);
	
	$q  = $db->insert('point_history',$insert_arrays);
	
	if($_POST['point_type'] == "top_hand"){
		$array_where = array(    
			'player' => $db->CleanDBData($_POST['player']),
			);
		$qH = $db->Delete('top_hand',$array_where);
	}

	if($_POST['point_type'] == "top_lost"){
		$array_where = array(    
			'player' => $db->CleanDBData($_POST['player']),
			);
		$ql = $db->Delete('top_lost',$array_where);
	}
}

if(isset($_POST['logs']) && $_POST['logs'] === "bank_log"){

	$RecData = $db->select("SELECT * FROM bank_info WHERE player = '".$db->CleanDBData($_POST['player'])."'");
	
	if($RecData[0]['player'] == ""){

		$insert_arrays = array(
			'player'=> $db->CleanDBData($_POST['player']), 
			'bank_name'=> $db->CleanDBData($_POST['bank_name']),
			'fullname'=> $db->CleanDBData($_POST['fullname']),
			'bank_card'=> $db->CleanDBData($_POST['bank_card']),
			'bank_sheba'=> $db->CleanDBData($_POST['bank_sheba']),
			'date'=> $db->CleanDBData($_POST['date']),
			'time'=> $db->CleanDBData($_POST['time']),
			'action'=> $db->CleanDBData($_POST['action']),
		);
		
		$q  = $db->insert('bank_info',$insert_arrays);

	}else{
		  $array_fields = array(
			'bank_name'=> $db->CleanDBData($_POST['bank_name']),
			'fullname'=>  $db->CleanDBData($_POST['fullname']),
			'bank_card'=>  $db->CleanDBData($_POST['bank_card']),
			'bank_sheba'=>  $db->CleanDBData($_POST['bank_sheba']),
		  );
	
		  $array_where = array(    
			'player' => $db->CleanDBData($_POST['player']),  
		  );
		
		  $q = $db->Update('bank_info', $array_fields, $array_where);
	}
}




if(isset($_POST['logs']) && $_POST['logs'] === "checkCommistion"){
	
	$RecDataCheck = $db->select("SELECT * FROM commission_history WHERE player='".$db->CleanDBData($_POST['player'])."' AND amount='".$db->CleanDBData($_POST['amount'])."' AND date='".$db->CleanDBData($_POST['date'])."'");
	if($RecDataCheck[0]['id'] == ""){
		$RecData = $db->select("SELECT count(*) as countW FROM commission_history WHERE player='".$db->CleanDBData($_POST['player'])."' AND amount='".$db->CleanDBData($_POST['amount'])."' AND date='".$db->CleanDBData($_POST['date'])."' AND time='".$db->CleanDBData($_POST['time'])."'");

		if($RecData[0]['countW'] != ""){
			echo $RecData[0]['countW'];
		}else{
			echo 1;
		}
	}else{
		echo 1;
	}
	
}

if(isset($_POST['logs']) && $_POST['logs'] === "checkPoint"){
	
	$RecDataCheck = $db->select("SELECT * FROM point_history WHERE player='".$db->CleanDBData($_POST['player'])."' AND point='".$db->CleanDBData($_POST['point'])."' AND point_type='".$db->CleanDBData($_POST['point_type'])."' AND date='".$db->CleanDBData($_POST['date'])."'");
	
	if($RecDataCheck[0]['id'] == ""){

		$RecData = $db->select("SELECT count(*) as countP FROM point_history WHERE player='".$db->CleanDBData($_POST['player'])."' AND point='".$db->CleanDBData($_POST['point'])."' AND point_type='".$db->CleanDBData($_POST['point_type'])."' AND date='".$db->CleanDBData($_POST['date'])."' AND time='".$db->CleanDBData($_POST['time'])."'");

		if($RecData[0]['countP'] != ""){
			echo $RecData[0]['countP'];
		}else{
			echo 1;
		}
	}else{
		echo 1;
	}
	
}



?>