<?php
require('conn/conn.php');
require('vendor/autoload.php');

use Twilio\Rest\Client;

$sql = "SELECT bet_id FROM bets_table where bet_status= ?";
$stmt = $conn->prepare($sql);
$stmt->execute(["pending"]);
while ($row = $stmt->fetch()) {
    $status = 0;
    $status2 = 0;
    $status3 = 0;
    $id = $row->bet_id;
    $sql2 = "SELECT * FROM betsplaced where bet_id= ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([$id]);

    while ($row2 = $stmt2->fetch()) {
        if ($row2->result == NULL) {
            echo ("this is null</br>");
            $status3 = 2;
            $status = 0;
        } else if ($row2->bet_value == 1 & $row2->result == "home" || $row2->bet_value == 2 & $row2->result == "draw" || $row2->bet_value == 3 & $row2->result == "away") {
            echo ("one correct</br>");
            $status = 1;
        } else {
            echo ("this is lost</br>");
            $status2 = 2;
            break;
        }
    }
    echo (" one bet done</br>");
    if ($status3 == 2 || $status == 0) {
        echo ("this bet is still pending" . $id . "</br>");
    } else if ($status == 1) {
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
        $stmt5->execute(array($row4->possiblewin,$row4->possiblewin, 1, "0708073370"));
        $sql1 = "UPDATE users_table set account_balance=account_balance+? where user__id=?";
        $stmt = $conn->prepare($sql1);
        $stmt->execute(array($row4->possiblewin, "0708073370"));
        $account_sid = 'ACf5c6efd53f4d56bf6e66f7c95d266332';
        $auth_token = '92534b0dee56ab055582a5c2cb87b569';
        try{
        $twilio_number = "+12092706361";
        $sendnumbet = '+254' . substr($row4->user__id, 1);
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $sendnumbet,
            array(
                'from' => $twilio_number,
                'body' => 'Congratulations! bet  ' . $id . ' has won KES  ' . $row4->possiblewin
            )
        );}
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
    if ($status2 == 2) {
        echo ("this bet has lost" . $id . "</br>");
        $sql3 = "UPDATE bets_table set bet_status=? where bet_id=?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute(array("Lost", $id));

        $sql3="UPDATE admintable set bets_lost=bets_lost+? where admin_id=?";
        $stmt3=$conn->prepare($sql3);
        $stmt3->execute(array(1,"0708073370"));
    }
}
