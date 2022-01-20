<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$accountb=0;
require('../conn/conn.php');
session_start();
if(empty($_SESSION['usernumber']) && !empty($_COOKIE['remember'])){
    list($selector,$authenticator)=explode(":",$_COOKIE['remember']);
    $sql="SELECT * from auth_tokes where selector= ?";
    $stmt=$conn->prepare($sql);
    $stmt->execute([$selector]);
    $row=$stmt->fetch();
    if(hash_equals($row->token,hash('sha256',base64_decode($authenticator)))){
        $_SESSION['usernumber']=$row->userid;
    }

}
if(isset($_SESSION['usernumber'])){
    $games_list=explode(',',$_SESSION['betslip']);
    if(isset($_POST['placebet'])){
    $word=$_POST['placebet'];
}
    else{
       
        $word=NULL;
    }
    $bet_id=generateRandomString(8);
    if(!empty($word) && $word!=0 && is_int((int)$word)){
        $username=$_SESSION['usernumber'];
        $sql="SELECT account_balance FROM users_table where user__id=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$username]);
        $row=$stmt->fetch();
        $account=$row->account_balance;
        
            if( $account<$word){
                $sql="DELETE from bets_table where bet_id=?";
                $stmt=$conn->prepare($sql);
                $stmt->execute([$bet_id]);
                header('location:../html/success.php?message=balance');
            }else{
            
            $sql="INSERT INTO bets_table(bet_id,user__id,bet_status,bet_amount,possiblewin,total_odds) VALUES (:bet_id,:user__id,:bet_status,:bet_amount,:possiblewin,:total_odds)";
            $stmt=$conn->prepare($sql);
            $stmt->execute([
                'bet_id'=>$bet_id,
                'user__id'=>$username,
                'bet_status'=>"not placed",
                'bet_amount'=>$word,
                'possiblewin'=>$_SESSION['total']*$word,
                'total_odds'=>$_SESSION['total']

            ]);
            foreach($games_list as $key=>$market_id){
                $sql="SELECT commence_time from markets_table where fixture_id=? ";
                $stmt=$conn->prepare($sql);
                $stmt->execute([
                    substr($market_id,0,-1)
                ]);
                $row=$stmt->fetch();
                if($row->commence_time>time()){
                    echo"got here";
                try{
                    
                    $conn->beginTransaction();
                    
                    $betslip=generateRandomString(8);
                    $sql="INSERT INTO betslip_table (betslip_id,bet_id,fixture_id,bet_value) values(:betslip_id,:bet_id,:fixture_id,:bet_value)";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute([
                        "betslip_id"=>$betslip,
                        "bet_id"=>$bet_id,
                        "fixture_id"=>substr($market_id,0,-1),
                        "bet_value"=>substr($market_id,-1)
                    ]);

                    $sql="UPDATE users_table set account_balance = ? where user__id=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute(array(($account-$word),$username));

                    $sql="UPDATE bets_table set bet_status=? where bet_id=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute(array("pending",$bet_id));
                    
                    

                    
                    $conn->commit();    
                }
                
                
                catch(Exception $e){
                    $conn->rollBack();
                    $sql="DELETE from bets_table where bet_id=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute([$bet_id]);
                    header('location:../html/success.php?message=err');
                    exit();
                }

            }}
                    
            $sql="UPDATE admintable set account_balance=account_balance+?,betsplaces=betsplaces+?,amount_paid_in=amount_paid_in+? where admin_id=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute(array($word,1,$word,"0708073370"));
                    $stmt->debugDumpParams();
                    
                    $message='Betpoa Bet '.$bet_id.' placed successfully. Possible win '.$_SESSION['total']*$word.' Best of luck.';
                    $url = 'https://mysms.celcomafrica.com/api/services/sendsms/';
              $curl = curl_init();
              curl_setopt($curl, CURLOPT_URL, $url);
              curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header
            
            
              $curl_post_data = array(
                      //Fill in the request parameters with valid values
                     'partnerID' => '',
                     'apikey' => '',
                     'mobile' => $username,
                     'message' => $message,
                     'shortcode' => 'CELCOM_SMS',
                     'pass_type' => 'plain', //bm5 {base64 encode} or plain
              );
            
              $data_string = json_encode($curl_post_data);
            
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($curl, CURLOPT_POST, true);
              curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            
              $curl_response = curl_exec($curl);                   
                
            header('location:../html/success.php?message=success');
        }
    }else{
        echo"the problem lies here";
            $sql="DELETE from bets_table where bet_id=?";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$bet_id]);
            header('location:../html/success.php?message=zero');
    }
}else{
    header("location:../html/login.php");
}