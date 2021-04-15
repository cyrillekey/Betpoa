<?php
require ('../conn/conn.php');
$game=$_POST['name'];
// use your default timezone to work correctly with unix timestamps
// and in line with other parts of your application
//echo('<script src="js/addtobet.js"></script>');
$current_time = time();
$sql = "SELECT `markets_table`.`fixture_id` AS `fixture_id`, `markets_table`.`home_team` AS `home_team`, `markets_table`.`away_team` AS `away_team`, `markets_table`.`commence_time`
AS`commence_time`, `odds_table`.`home_win` AS `home_win`, `odds_table`.`draw` AS `draw`, `odds_table`.`away_win` AS `away_win`,`league_table`.`league_name`,`league_table`.`country`
FROM (`markets_table` join odds_table  on markets_table.fixture_id = odds_table.fixture_id join league_table on markets_table.league_id = league_table.league_id ) WHERE (`markets_table`.`home_team` like  ?  or markets_table.away_team like ? ) and commence_time > ? and gamestatus=?";

$stmt = $conn->prepare($sql);
$stmt->execute([$game.'%',$game.'%',time(),"NS"]);
while ($row = $stmt->fetch()) {
    $dateold=strtotime("+180 minutes",$row->commence_time);

$date = gmdate("d D, F,Y,g:i a", $dateold);
    echo '
    
    <div class="betmarket">
        <div class="teams-info-meta big-screen">
            <div class="teams-info-meta-left">Soccer, '.$row->league_name.', '.$row->country. ' </div>
            <div class="teams-info-meta-right">' . $date . '
            </div>
        </div>
        <div class="teams-info-vert big-screen">
            <div class="teams-info-vert-left">
                <a href="#">
                    <div class="teams-info-vert-top">' . $row->home_team . '
                    </div>
                    <div class="teams-info-vert-top">' . $row->away_team . '
                    </div>
                </a>
            </div>
            <div class="teams-info-vert-right">
            <div class="odds__container num3" number-of-odds="3">
                <a href="#" class="match-odd odd1 odd1of3" id="' . $row->fixture_id . '1">
                    <div class="odds__value bold">'
        . $row->home_win . '
                    </div>
                    </a>
                    <a href="#" class="match-odd odd2 odd2of3" id="' . $row->fixture_id . '2">
                        <div class="odds__value bold">
                    ' . $row->draw . '
                    </div>
                    </a>
                    <a href="#" class="match-odd odd3 odd3of3" id="' . $row->fixture_id . '3">
                        <div class="odds__value bold">
                    ' . $row->away_win . '
                    </div>
                    </a>
                    <a class="more-markets " href="html/markets.php?game='.$row->fixture_id.'">+30</a>
                </div>
            </div>
        </div>
    </div>
                    ';

}
echo('<script src="js/addtobet.js"></script>');
?>