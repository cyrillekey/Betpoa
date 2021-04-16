<?php
include('conn/conn.php');/*
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/leagues/season/2021",
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

if ($err) {
	echo "cURL Error #:" . $err;
} else {
    $x=0;
    while ($x <= 1000) {
        # code...
    try{
	$result=json_decode($response);
    $id=$result->api->leagues[$x]->league_id;
    $name=$result->api->leagues[$x]->country;
    $sql="UPDATE league_table SET country=? where league_id=?;";
    $stmt=$conn->prepare($sql);
    $stmt->execute([
        $name,$id
    ]);
echo("one worked");
}
    
    catch(Exception $e){
        echo("one failed");
    }
    $x++;
}
}
*/

$newdate=gmdate("Y-m-d",time());
$yest=gmdate('Y-m-d',strtotime('+1 day',time()));
$dates=[$newdate,$yest,gmdate('Y-m-d',strtotime('-1 day',time()))];
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
    while($x<700){
        try{
    $fixture_id=($resarr->api->fixtures[$x]->fixture_id);
   
    $id=($resarr->api->fixtures[$x]->league_id);



    $sql="UPDATE markets_table set league_id= ? where fixture_id=? ";
    
    $stmt=$conn->prepare($sql);
   $stmt->execute(array($id,$fixture_id));
echo"Updated one";}
catch(Exception $e){
    print_r($stmt->errorInfo());
    echo("one failed");
}
    
    //$stmt->debugDumpParams();
    $x++;
    
    }
}
}
