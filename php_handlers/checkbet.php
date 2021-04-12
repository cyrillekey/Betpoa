<?php
require('conn/conn.php');



/**
 * TODO
 * halftime fulltime
 *  Draw no bet
 * 
 */
$sql = "SELECT bet_id FROM bets_table where bet_status= ?";
$stmt = $conn->prepare($sql);
$stmt->execute(["pending"]);
while ($row = $stmt->fetch()) {
    $status = 0;
    $status2 = 0;
    $status3 = 0;
    $id = $row->bet_id;
    //$sql2 = "SELECT * FROM betsplaced where bet_id= ?";
    $sql2 = "SELECT `bets_table`.`bet_id` AS `bet_id`, `bets_table`.`user__id` AS `user__id`, `bets_table`.`bet_status` AS `bet_status`, `bets_table`.`bet_amount` 
    AS `bet_amount`, `bets_table`.`possiblewin` AS `possiblewin`, `bets_table`.`total_odds` AS `total_odds`, `betslip_table`.`bet_value` 
    AS `bet_value`, `markets_table`.`home_team` AS `home_team`, `markets_table`.`away_team` AS `away_team`, `markets_table`.`gamestatus` 
    AS `gamestatus`, `markets_table`.`result` AS `result`,`markets_table`.`total_goals`,`markets_table`.`halftime`,`markets_table`.`gg`,`markets_table`.`fixture_id` FROM ((`bets_table` join `betslip_table` on(`bets_table`.`bet_id` = `betslip_table`.`bet_id`)) 
    join `markets_table` on(`markets_table`.`fixture_id` = `betslip_table`.`fixture_id`)) WHERE bets_table.bet_id= ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([$id]);

    while ($row2 = $stmt2->fetch()) {
        if ($row2->result == NULL) {
            echo ("this is null</br>");
            $status3 = 2;
            $status = 0;
        } else if (
            $row2->bet_value == 1 & $row2->result == "home" || $row2->bet_value == 2 & $row2->result == "draw" || $row2->bet_value == 3 & $row2->result == "away" || $row2->bet_value == "g" && $row2->halftime == "home" || $row2->bet_value == "h" && $row2->halftime == "draw" || $row2->bet_value == "i" && $row2->halftime == "away" || $row2->bet_value == "j" && $row2->gg == 1 ||
            $row2->bet_value == "k" && $row2->gg == 2 || ($row2->bet_value == "4" &&
                ($row2->result == "home" || $row2->result == "draw")) ||
            ($row2->bet_value == "5" && ($row2->result == "home" || $row2->result == "away"))
            || ($row2->bet_value == "6" && ($row2->result == "away" || $row2->result == "draw")) || ($row2->bet_value == "l" && ($row2->result == "home" && $row2->gg == 1)) || ($row2->bet_value == "m" && ($row2->result == "home" && $row2->gg == 2)) || ($row2->bet_value == "n" && ($row2->result == "away" && $row2->gg == 1)) || ($row2->bet_value == "o" && ($row2->result == "away" && $row2->gg == 2))
            || ($row2->bet_value == 7 && $row2->total_goals < 1) ||  ($row2->bet_value == 8 && $row2->total_goals > 1) || ($row2->bet_value == 9 && $row2->total_goals > 1) || ($row2->bet_value == 0 && $row2->total_goals < 2) || ($row2->bet_value == "a" && $row2->total_goals > 2) || ($row2->bet_value == "b" && $row2->total_goals < 3) || ($row2->bet_value == "c" && $row2->total_goals > 3) || ($row2->bet_value == "d" && $row2->total_goals < 4) || ($row2->bet_value == "e" && $row2->result == "home") || ($row2->bet_value == "f" && $row2->result == "away")
        ) {
            echo ("one correct</br>");
            $status = 1;
        } elseif (($row2->bet_value == "e" && $row2->result == "draw")) {
            $sql4="SELECT dnb1 FROM odds_table where fixture_id=?";
            $stmt4=$conn->prepare($sql4);
            $stmt4->execute([$row2->fixture_id]);
            $row3=$stmt4->fetch();

            $sql4="UPDATE bets_table set total_odds = total_odds / ? ,possible_win=possible_win / ? where fixture_id=?";
            $stmt6=$conn->prepare($sql4);
            $stmt6->execute([$row3->dnb1,$row3->dnb1,$row2->fixture_id]);
            $status=1;
            echo("Draw no bet passed</br>");
        } elseif ($row2->bet_value == "f" && $row2->result == "draw") {
            $sql4="SELECT dnb2 FROM odds_table where fixture_id=?";
            $stmt4=$conn->prepare($sql4);
            $stmt4->execute([$row2->fixture_id]);
            $row3=$stmt4->fetch();

            $sql4="UPDATE bets_table set total_odds = total_odds / ? ,possible_win=possible_win / ? where fixture_id=?";
            $stmt6=$conn->prepare($sql4);
            $stmt6->execute([$row3->dnb2,$row3->dnb2,$row2->fixture_id]);
            $status=1;
            echo("Draw no bet passed</br>");
        } else {
            echo ("this is lost</br>");
            $status2 = 2;
            break;
        }
    }
    echo (" one bet done</br>");
    if ($status3 == 2 || $status == 0) {
        echo ("this bet is still pending" . $id . "</br>");
    } else if ($status == 1 && $status2 != 2) {
        echo ("this bet has won" . $id . "</br>");
        $sql3 = "UPDATE bets_table set bet_status=? where bet_id=?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute(array("Won", $id));

        $sql7 = "SELECT * FROM bets_table where bet_id= ?";
        $stmt7 = $conn->prepare($sql7);
        $stmt7->execute([$id]);
        $row4 = $stmt7->fetch();

        $sql5 = "UPDATE admintable set account_balance=account_balance-?,ammount_paid_out=ammount_paid_out+?,bets_won=bets_won+? where admin_id= ?";
        $stmt5 = $conn->prepare($sql5);
        $stmt5->execute(array($row4->possiblewin, $row4->possiblewin, 1, "0708073370"));
        $sql1 = "UPDATE users_table set account_balance=account_balance+? where user__id=?";
        $stmt5 = $conn->prepare($sql1);
        $stmt5->execute(array($row4->possiblewin, $row4->user__id));
        /* send message on bet won */
        $message = "Betpoa bet id" . $id . " has won kes " . $row4->possiblewin;
        $url = 'https://mysms.celcomafrica.com/api/services/sendsms/';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'partnerID' => '2693',
            'apikey' => '73b76cf9f410d485c26db42f2d45400b',
            'mobile' => $row4->user__id,
            'message' => $message,
            'shortcode' => 'CELCOM_SMS',
            'pass_type' => 'plain', //bm5 {base64 encode} or plain
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
    }
    if ($status2 == 2) {
        echo ("this bet has lost" . $id . "</br>");
        $sql3 = "UPDATE bets_table set bet_status=? where bet_id=?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute(array("Lost", $id));

        $sql3 = "UPDATE admintable set bets_lost=bets_lost+? where admin_id=?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute(array(1, "0708073370"));
    }
}
