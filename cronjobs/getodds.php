<?php
require('conn/conn.php');
$newdate=gmdate("Y-m-d",time());
$yest=gmdate('Y-m-d',strtotime('+1 day',time()));
$dates=[$newdate,$yest];
foreach ($dates as $key => $value) {

$curl = curl_init();
    $p=1;
while($p<40){
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/odds/date/".$value."?timezone=Africa%2FNairobi&page=".$p,
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
    $result=json_decode($response);   
    curl_close($curl);

$x=0;
while($x<11){
if ($err) {
	echo "cURL Error #:" . $err;
} else {
    $stmt2;
    try{
    
    $league=(($result->api->odds[$x]->fixture->fixture_id));

    $home=(!isset($result->api->odds[$x]->bookmakers[0]->bets[0]->values[0]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[0]->values[0]->odd));
    $draw=(!isset($result->api->odds[$x]->bookmakers[0]->bets[0]->values[1]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[0]->values[1]->odd));
    $away=(!isset($result->api->odds[$x]->bookmakers[0]->bets[0]->values[2]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[0]->values[2]->odd));
    if(isset($result->api->odds[$x]->bookmakers[0]->bets[7]->label_id)==8){
    $gg=(!isset($result->api->odds[$x]->bookmakers[0]->bets[7]->values[0]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[7]->values[0]->odd));
    $ngg=(!isset($result->api->odds[$x]->bookmakers[0]->bets[7]->values[1]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[7]->values[1]->odd));}
    else{
        $gg=1.00;
        $ngg=1.00;

    }
    $onex=(!isset($result->api->odds[$x]->bookmakers[0]->bets[13]->values[0]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[13]->values[0]->odd));
    $twox=(!isset($result->api->odds[$x]->bookmakers[0]->bets[13]->values[1]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[13]->values[1]->odd));
    $X2=(!isset($result->api->odds[$x]->bookmakers[0]->bets[13]->values[2]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[13]->values[2]->odd));
    $dnb1=(!isset($result->api->odds[$x]->bookmakers[0]->bets[1]->values[0]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[1]->values[0]->odd));
    $dnb2=(!isset($result->api->odds[$x]->bookmakers[0]->bets[1]->values[1]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[1]->values[1]->odd));
    #all over sections
    $ov05=(!isset($result->api->odds[$x]->bookmakers[0]->bets[3]->values[8]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[3]->values[8]->odd));
    $ov15=(!isset($result->api->odds[$x]->bookmakers[0]->bets[3]->values[2]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[3]->values[2]->odd));
    $ov25=(!isset($result->api->odds[$x]->bookmakers[0]->bets[3]->values[6]->odd)? 1.00 :($result->api->odds[$x]->bookmakers[0]->bets[3]->values[6]->odd) );
    $ov35=(!isset($result->api->odds[$x]->bookmakers[0]->bets[3]->values[0]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[3]->values[0]->odd));
    $un05=(!isset($result->api->odds[$x]->bookmakers[0]->bets[3]->values[9]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[3]->values[9]->odd));
    $un15=(!isset($result->api->odds[$x]->bookmakers[0]->bets[3]->values[3]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[3]->values[3]->odd));
    $un25=(!isset($result->api->odds[$x]->bookmakers[0]->bets[3]->values[7]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[3]->values[7]->odd));
    $un35=(!isset($result->api->odds[$x]->bookmakers[0]->bets[3]->values[1]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[3]->values[1]->odd));
    $half1=(!isset($result->api->odds[$x]->bookmakers[0]->bets[14]->values[0]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[14]->values[0]->odd));
    $halfX=(!isset($result->api->odds[$x]->bookmakers[0]->bets[14]->values[1]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[14]->values[1]->odd));
    $half2=(!isset($result->api->odds[$x]->bookmakers[0]->bets[14]->values[2]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[14]->values[2]->odd));

    
    $half1n1=(!isset($result->api->odds[$x]->bookmakers[0]->bets[6]->values[4]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[6]->values[4]->odd));
    $half1nx=(!isset($result->api->odds[$x]->bookmakers[0]->bets[6]->values[0]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[6]->values[0]->odd));
    $half1n2=(!isset($result->api->odds[$x]->bookmakers[0]->bets[6]->values[1]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[6]->values[1]->odd));
    $half2n1=(!isset($result->api->odds[$x]->bookmakers[0]->bets[6]->values[6]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[6]->values[6]->odd));
    $half2nx=(!isset($result->api->odds[$x]->bookmakers[0]->bets[6]->values[7]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[6]->values[7]->odd));
    $half2n2=(!isset($result->api->odds[$x]->bookmakers[0]->bets[6]->values[8]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[6]->values[8]->odd));
    $halfxn1=(!isset($result->api->odds[$x]->bookmakers[0]->bets[6]->values[5]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[6]->values[5]->odd));
    $halfxnx=(!isset($result->api->odds[$x]->bookmakers[0]->bets[6]->values[3]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[6]->values[3]->odd));
    $halfxn2=(!isset($result->api->odds[$x]->bookmakers[0]->bets[6]->values[2]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[6]->values[2]->odd));
    $win2nillhome_yes=(!isset($result->api->odds[$x]->bookmakers[0]->bets[8]->values[0]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[8]->values[0]->odd));
    $win2nillhome_no=(!isset($result->api->odds[$x]->bookmakers[0]->bets[8]->values[1]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[8]->values[1]->odd));
    $win2nillaway_yes=(!isset($result->api->odds[$x]->bookmakers[0]->bets[9]->values[0]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[9]->values[0]->odd));
    $win2nillaway_no=(!isset($result->api->odds[$x]->bookmakers[0]->bets[9]->values[1]->odd)? 1.00 : ($result->api->odds[$x]->bookmakers[0]->bets[9]->values[1]->odd));
    //check if either is null
    $sql="INSERT INTO odds_table(fixture_id,home_win,away_win,draw,onex,one2,X2,gg,ngg,dnb1,dnb2,ov25,ov35,ov15,ov05,un05,un15,un25,un35,half1,halfX,half2,half1n1,half1n2,half1nx,half2n1,half2n2,half2nx,halfxn1,halfxn2,halfxnx,win2nillhome_yes,win2nillhome_no,win2nillaway_yes,win2nillaway_no)VALUES
    (:fixture_id,:home_win,:away_win,:draw,:onex,:one2,:X2,:gg,:ngg,:dnb1,:dnb2,:ov25,:ov35,:ov15,:ov05,:un05,:un15,:un25,:un35,:half1,:halfX,:half2,:half1n1,:half1n2,:half1nx,:half2n1,:half2n2,:half2nx,:halfxn1,:halfxn2,:halfxnx,:win2nillhome_yes,:win2nillhome_no,:win2nillaway_yes,:win2nillaway_no)";
    $stmt2=$conn->prepare($sql);
    $stmt2->execute([
        "fixture_id"=>$league,
        "home_win"=>$home,
        "away_win"=>$away,
        "draw"=>$draw,
        "onex"=>$onex,
        "one2"=>$twox,
        "X2"=>$X2,
        "gg"=>$gg,
        "ngg"=>$ngg,
        "dnb1"=>$dnb1,
        "dnb2"=>$dnb2,
        "ov25"=>$ov25,
        "ov35"=>$ov35,
        "ov15"=>$ov15,
        "ov05"=>$ov05,
        "un05"=>$un05,
        "un15"=>$un15,
        "un25"=>$un25,
        "un35"=>$un35,
        "half1"=>$half1,
        "halfX"=>$halfX,
        "half2"=>$half2,
        "half1n1"=>$half1n1,
        "half1n2"=>$half1n2,
        "half1nx"=>$half1nx,
        "half2n1"=>$half2n1,
        "half2n2"=>$half2n2,
        "half2nx"=>$half2nx,
        "halfxn1"=>$halfxn1,
        "halfxn2"=>$halfxn2,
        "halfxnx"=>$halfxnx,
        "win2nillhome_yes"=>$win2nillhome_yes,
        "win2nillhome_no"=>$win2nillhome_no,
        "win2nillaway_yes"=>$win2nillaway_yes,
        "win2nillaway_no"=>$win2nillhome_yes,

    ]);
echo" one worked";

}
    catch(Exception $e){
        print_r($stmt2->errorInfo());
        echo "one failed ";
    }
    $x++;
}}
$p++;
}
}