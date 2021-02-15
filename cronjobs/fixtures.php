<?php
require('conn/conn.php');
$date=time();
$newdate=gmdate("Y-m-d");
$curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/fixtures/date/".$newdate."?timezone=Africa%2FNairobi",
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
    
        $fixture_id=($resarr->api->fixtures[$x]->fixture_id);
        $timestamp=($resarr->api->fixtures[$x]->event_timestamp);
        $status=($resarr->api->fixtures[$x]->statusShort);
        $hometeam=($resarr->api->fixtures[$x]->homeTeam->team_name);
        $awayteam=($resarr->api->fixtures[$x]->awayTeam->team_name);
        $result=($resarr->api->fixtures[$x]->score->fulltime);
       $sql="INSERT into markets_table VALUES(:fix,:home,:away,:comm,:satus,:res)";
       $stmt=$conn->prepare($sql);
       $stmt->execute([
           "fix"=>$fixture_id,
           "home"=>$hometeam,
           "away"=>$awayteam,
           "comm"=>$timestamp,
           "satus"=>$status,
           "res"=>$results
       ]);
echo" one worked";
}
    catch(Exception $e){
        echo "one failed ";
    }
    $x++;
}}

