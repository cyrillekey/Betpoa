<?php
$callbackResponse = file_get_contents('php://input');
$response=json_decode($callbackResponse,true);
$id=($response['Result']['ResultParameters']['ResultParameter'][0]['Value']);
$amount=($response['Result']['ResultParameters']['ResultParameter'][1]['Value']);
$time=strtotime($date);
$date=($response['Result']['ResultParameters']['ResultParameter'][4]['Value']);
$time=strtotime($date);
echo("id $id amount $amount and date $time" );
