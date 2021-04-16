<?php
include('conn/conn.php');
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/leagues",
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
    while ($x <= 3375) {
        # code...
    try{
	$result=json_decode($response);
    $id=$result->api->leagues[$x]->league_id;
    $name=$result->api->leagues[$x]->country;
    $leg=$result->api->leagues[$x]->name;
    $sql="INSERT INTO league_table VALUES(:id,:named,:country )";
    $stmt=$conn->prepare($sql);
    $stmt->execute([
        "id"=>$id,
        "named"=>$leg,
        "country"=>$name
    ]);
echo("one worked");
}
    
    catch(Exception $e){
        echo("one failed");
    }
    $x++;
}
}
