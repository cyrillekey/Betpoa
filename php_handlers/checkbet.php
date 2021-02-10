<?php
include('../conn/conn.php');
$sql = "SELECT bet_id FROM bets_table where bet_status= ?";
$stmt = $conn->prepare($sql);
$stmt->execute(["pending"]);
while ($row = $stmt->fetch()) {
    $status=0;
    $status2=0;
    $id = $row->bet_id;
    $sql2 = "SELECT * FROM betsplaced where bet_id= ?" ;
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([$id]);
   
    while ($row2 = $stmt2->fetch()) {
        if($row2->bet_value==1 & $row2->result=="home" || $row2->bet_value==2 & $row2->result=="draw" || $row2->bet_value==3 & $row2->result=="away"){
            echo("one correct</br>");
            $status=1;        }
         else if($row2->result==NULL){
           echo("this is null</br>");
           $status=0;
           break;
       }else{
           echo("this is lost</br>");
           $status2=2;
           break;
       }
    }
    echo(" one bet done</br>");
    if($status==1){
        echo("this bet has won".$id."</br>");
        $sql3 = "UPDATE bets_table set bet_status=? where bet_id=?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute(array("Won", $id));
    }elseif($status2==2){
        echo("this bet has lost".$id."</br>");
        $sql3 = "UPDATE bets_table set bet_status=? where bet_id=?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute(array("Lost", $id));
    }elseif($status==0){
        echo("this bet is still pending".$id."</br>");
    }

    
}
