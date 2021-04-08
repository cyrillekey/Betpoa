<?php
require('../conn/conn.php');
$callbackResponse = file_get_contents('php://input');
$response=json_decode($callbackResponse,true);
$id=($response['Result']['ResultParameters']['ResultParameter'][0]['Value']);
$amount=($response['Result']['ResultParameters']['ResultParameter'][1]['Value']);
$date=($response['Result']['ResultParameters']['ResultParameter'][4]['Value']);
$number=($response['Result']['ResultParameters']['ResultParameter'][5]['Value']);
$result=($response['Result']['ResultCode']);
echo($result);
$time=strtotime($date);
$newnumber=("0".substr($number,3,9));
$sql="INSERT into transactions_table VALUES(:trans,:user,:typed,:trantime,:amo)";
$stmt=$conn->prepare($sql);
try{
$stmt->execute([
    "trans"=>$id,
    "user"=>$number,
    "typed"=>$result,
    "trantime"=>$time,
    "amo"=>$amount
]);
}
catch(Exception $e){
    print_r($stmt->errorInfo());
}if($result=="0")
{
    try{
        $conn->beginTransaction();
$sql="UPDATE users_table set account_balance = account_balance- ? where user__id=? ";
$stmt=$conn->prepare($sql);
$stmt->execute([
    $amount,$number
]);
$conn->commit();

}catch(Exception $e){
    $conn->rollBack();
    print_r($stmt->errorInfo());
}
}
//echo("id $id amount $amount and date $time" );
