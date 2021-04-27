<?php
require('conn/conn.php');
$sql="DELETE from markets_table where commence_time < ?";
$stmt=$conn->prepare($sql);
$stmt->execute([
    time()-(96*60*60)
]);
$newdate=gmdate("Y-m-d",time());
$yest=gmdate('Y-m-d',strtotime('-1 day',time()));
$dates=[$newdate,$yest,gmdate('Y-m-d',strtotime('+1 day',time()))];
foreach ($dates as $key => $value) {
$curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/fixtures/date/".$value."?timezone=Africa%2FNairobi",
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
$resarr=json_decode($response);
curl_close($curl);

$x=0;
while($x<700){
if ($err) {
	echo "cURL Error #:" . $err;
} else {
    try{
    
        $fixture_id=($resarr->api->fixtures[$x]->fixture_id);
        $timestamp=($resarr->api->fixtures[$x]->event_timestamp);
        $status=($resarr->api->fixtures[$x]->statusShort);
        $hometeam=($resarr->api->fixtures[$x]->homeTeam->team_name);
        $awayteam=($resarr->api->fixtures[$x]->awayTeam->team_name);
        $results=($resarr->api->fixtures[$x]->score->fulltime);
        $id=($resarr->api->fixtures[$x]->league_id);
        $half=" ";
        $total=" ";
        $gg=" ";
       $sql="INSERT into markets_table VALUES(:fix,:home,:away,:comm,:satus,:res,:total,:halftime,:gg,:id)";
       $stmt=$conn->prepare($sql);
       $stmt->execute([
           "fix"=>$fixture_id,
           "home"=>$hometeam,
           "away"=>$awayteam,
           "comm"=>$timestamp,
           "satus"=>$status,
           "res"=>$results,
           "total"=>$total,
           "halftime"=>$half,
           "gg"=>$gg,
           "id"=>$id

       ]);
echo" one worked";
}
    catch(Exception $e){
        print_r($stmt->errorInfo());
        echo "one failed ";
    }
    $x++;
}}

}