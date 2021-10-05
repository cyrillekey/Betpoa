<?php
//generate Jackpot Games
require ('./conn/conn.php'); 

$sql="SELECT fixture_id,home_win,draw,away_win from odds_table";
$stmt=$conn->prepare($sql);
$stmt->execute();
$row=$stmt->fetch();
$count=$stmt->rowCount();
$x=0;
while($x<$count){
    echo($over=((1/$row->home_win)*100)+((1/$row->draw)*100)+((1/$row->away_win)*100));
    $over=bcdiv($over, 1, 2);
    $x++;
}


