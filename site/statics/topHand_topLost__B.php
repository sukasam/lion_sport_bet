
<?php


    include_once("../function/poker_api.php");
    include_once("../function/poker_config.php");


    $params = array("Command"  => "LogsHandHistory");
    $api = Poker_API($params);

    for($j=0;$j<$api->Files;$j++){

      $dateCerrent = date("Y-m-d");
      $dateBefore =  date("Y-m-d",strtotime($dateCerrent." -1 day"));

      if($api->Date[$j] === $dateCerrent || $api->Date[$j] === $dateBefore){
        
        $params2 = array(
          "Command"  => "LogsHandHistory",
          "Date" => $api->Date[$j],
          "Name" => $api->Name[$j],
        );
        $api2 = Poker_API($params2);

        // echo "<pre>";
        //   print_r($api2);
        // echo "</pre>";

        $topLost = [];
        $amountPlayer = 0;
        $turnWin = "";
        $topHand = [];
        $turn = 0;
        $gameTurn = "";
        
        for($i=0;$i<count($api2->Data);$i++){

            $haystack = $api2->Data[$i];
            
            if($haystack === ""){
              $amountPlayer = 0;
              $turn = 0;
              $gameTurn = "";
            }

            if($amountPlayer > 1 && $turn == 1){
              $userTopHand = explode(" ",$haystack);
              //array_push($topHand,$userTopHand[2].' - '.$gameTurn." - ".$api->Name[$j]);
              $gameHand = explode(" - ",$gameTurn);
              $dateTime = explode(" ",$gameHand[1]);

              echo "Top Hand =>".$userTopHand[2]." ".$api->Name[$j]." ".$gameHand[0]."\r\n";
              
              $postfields = array(
                  'player'=> $userTopHand[2],
                  'table_game'=> $api->Name[$j],
                  'handID'=> $gameHand[0],
                  'date'=> $dateTime[0],
                  'time'=> $dateTime[1],
                  'point'=> "1",
                  'logs'=>'tophand_log'
              );
              
              $response = curl_post(SCRIPT_AUTO_SITE,$postfields);
            }
            

            if($amountPlayer > 1 && $turnWin != ""){
                $userLost = explode(" ",$haystack);

                $moneyBit = explode("(",$userLost[3]);
                $moneyBit = explode(")",$moneyBit[1]);

                if(trim($turnWin) != trim($userLost[2])){
                // array_push($topLost,$userLost[2].' - '.$gameTurn." - ".$api->Name[$j]);
                $gameHand = explode(" - ",$gameTurn);
                $dateTime = explode(" ",$gameHand[1]);

                $bitPoint = floor($moneyBit[0]*0.01);
                $bitPoint = explode("-",$bitPoint);

                echo "Top Lost =>".$userLost[2]." ".$api->Name[$j]." ".$gameHand[0]."\r\n";

                $postfields = array(
                    'player'=> $userLost[2],
                    'table_game'=> $api->Name[$j],
                    'handID'=> $gameHand[0],
                    'date'=> $dateTime[0],
                    'time'=> $dateTime[1],
                    'point'=> $bitPoint[1],
                    'logs'=>'toplost_log'
                );

                $response = curl_post(SCRIPT_AUTO_SITE,$postfields);

                }// if != Win
            }

            $needle4 = 'wins';
            if (strpos($haystack,$needle4) !== false) {
              $listWins = explode("wins",$haystack);
              $turnWin = $listWins[0];
              //echo "Wins: ".$turnWin."<br>";
            }

            $needle3 = ' Players: ';
            if (strpos($haystack,$needle3) !== false) {
              $listPlayer = explode(", Players: ",$haystack);
              $numPlayer = explode(",",$listPlayer[1]);
              $amountPlayer = $numPlayer[0];
            // echo $amountPlayer."<br>";
            }

            $needle = '** Turn **';
            if (strpos($haystack,$needle) !== false) {
              $turn = 1;
            }

            $needle5 = 'Hand #';
            if (strpos($haystack,$needle5) !== false) {
              $gameTurn = $haystack;
            }

        } // for loop

          // echo "Top Hand";
          // echo "<pre>";
          //   print_r($topHand);
          // echo "</pre>";

          //  echo "Top Lost";
          // echo "<pre>";
          //   print_r($topLost);
          // echo "</pre>";

      }// end if (Record only date before and date current)

    }

    echo "Done";

    exit;
?>