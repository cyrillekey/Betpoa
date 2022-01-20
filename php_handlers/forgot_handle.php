<?php
include('../conn/conn.php');
if(isset($_POST['user'])){
$num=($_POST['user']);
$token=(mt_rand(1000,9999));
$expire=strtotime(time())+3600;

$sql="INSERT into password_reset(reset_user__id,reset_token,expiry_date) values (:rese,:tok,:expi)";
$stmt=$conn->prepare($sql);
$stmt->execute([
    "rese"=>$num,
    "tok"=>$token,
    "expi"=>$expire
]);
if($stmt){
    $message="Betpoa Password reset token is ".$token.".";
    $url = 'https://mysms.celcomafrica.com/api/services/sendsms/';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header
  
  
    $curl_post_data = array(
            //Fill in the request parameters with valid values
           'partnerID' => '',
           'apikey' => '',
           'mobile' => $num,
           'message' => $message,
           'shortcode' => 'CELCOM_SMS',
           'pass_type' => 'plain', //bm5 {base64 encode} or plain
    );
  
    $data_string = json_encode($curl_post_data);
  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
    $curl_response = curl_exec($curl); 
    header("location:../html/newpass.php?user=".$num);
}
}else{
    header("location:../html/forgot.php");
    exit();
}