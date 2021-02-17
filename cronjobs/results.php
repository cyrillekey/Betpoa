<?php
require 'conn/conn.php';

$newdate=gmdate("Y-m-d",time());
$yest=gmdate('Y-m-d',strtotime(+1));
$dates=[$newdate,$yest];
foreach ($dates as $key => $value) {
    # code...

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

if ($err) {
	echo "cURL Error #:" . $err;
} else {
    
    $x=0;
    while($x<300){
        try{
    $fixture_id=($resarr->api->fixtures[$x]->fixture_id);
    $timestamp=($resarr->api->fixtures[$x]->event_timestamp);
    $status=($resarr->api->fixtures[$x]->statusShort);
    $hometeam=($resarr->api->fixtures[$x]->goalsHomeTeam);
    $awayteam=($resarr->api->fixtures[$x]->goalsAwayTeam);
    $result;
    

    if($status=="FT"){
    if($hometeam>$awayteam){
        $result="home";
    }elseif($awayteam>$hometeam){
        $result="away";
    }elseif($hometeam==$awayteam){
        $result="draw";
    }
    $sql="UPDATE markets_table set result= ?,gamestatus=? where fixture_id=? ";
    $stmt=$conn->prepare($sql);
    $stmt->execute(array($result,$status,$fixture_id));
echo"Updated one";}}
catch(Exception $e){
    echo("one failed");
}
    
    //$stmt->debugDumpParams();
    $x++;
    
    }
}
}
