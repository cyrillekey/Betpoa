<?php
require('conn/conn.php');
$leagues=["2790","2794","2796","2803","2833","2857","2664","2755","2771","2777"];
$curl = curl_init();
foreach ($leagues as $key => $league) {
    $p=0;
while($p<6){
curl_setopt_array($curl, [
	CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/odds/league/".$league."?page=".$p."",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: api-football-v1.p.rapidapi.com",
		"x-rapidapi-key: e56261b2e2msha48fb697c1e185dp18d4ffjsn3656a9b1fd85"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$result=json_decode($response);
$x=0;
while($x<10){
if ($err) {
	echo "cURL Error #:" . $err;
} else {
    try{
    
    $league=($result->api->odds[$x]->fixture->fixture_id);
    $home=($result->api->odds[$x]->bookmakers[0]->bets[0]->values[0]->odd);
    $draw=($result->api->odds[$x]->bookmakers[0]->bets[0]->values[1]->odd);
    $away=($result->api->odds[$x]->bookmakers[0]->bets[0]->values[2]->odd);
    $sql="INSERT INTO odds_table(fixture_id,home_win,away_win,draw)VALUES(:fixture_id,:home_win,:away_win,:draw)";
    $stmt2=$conn->prepare($sql);
    $stmt2->execute([
        "fixture_id"=>$league,
        "home_win"=>$home,
        "away_win"=>$away,
        "draw"=>$draw
    ]);
echo" one worked";
}
    catch(Exception $e){
        echo "one failed ";
    }
    $x++;
}}
$p++;
}
}