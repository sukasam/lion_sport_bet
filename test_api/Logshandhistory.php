
<?php
    include_once("../function/poker_api.php");

    $params = array("Command"  => "LogsHandHistory",
                     "Date" => "2018-11-18",
                     "Name" => "Ring Game #01",
                  );
    $api = Poker_API($params);

    /*echo "<pre>";
      print_r($api->Data);
    echo "</pre>";*/


    $topLost = [];
    $amountPlayer = 0;
    $turnWin = "";
    $topHand = [];
    $turn = 0;
    
    for($i=0;$i<count($api->Data);$i++){

      $haystack = $api->Data[$i];

      // Top Lost Function
      if($haystack === ""){
        $amountPlayer = 0;
      }

      if($amountPlayer > 1 && $turnWin != ""){
        $userLost = explode(" ",$haystack);
        if(trim($turnWin) != trim($userLost[2])){
          array_push($topLost,$userLost[2]);
          //echo $userLost[2]."<br>";
        }
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


      // Top Hand Function
      $needle2 = '** River **';
      if (strpos($haystack,$needle2) !== false) {
        $turn = 0;
      }

      $checkFolds = explode(" ",$haystack);

      if($turn == 1){
        //Top Hand 
        array_push($topHand,$checkFolds[0]);
        if($checkFolds[1] === "folds"){
          $turn = 0;
        }
      }

      $needle = '** Turn **';
      if (strpos($haystack,$needle) !== false) {
        $turn = 1;
      }

    }

    

    echo "<pre>";
      print_r($topHand);
    echo "</pre>";

    echo "<pre>";
      print_r($topLost);
    echo "</pre>";



    exit;
?>