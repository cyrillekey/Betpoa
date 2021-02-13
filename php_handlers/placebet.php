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
/*require('../vendor/autoload.php');
use Twilio\Rest\Client;*/
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
    $word=$_POST['placebet'];
    if(!empty($word)){
        $username=$_SESSION['usernumber'];
        $sql="SELECT account_balance FROM users_table where user__id=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$username]);
        $row=$stmt->fetch();
        $account=$row->account_balance;
        
        
        

        if($account<$word){
            $sql="DELETE from bets_table where bet_id=?";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$bet_id]);
            header('location:../html/success.php?message=balance');

        }else{
            $bet_id=generateRandomString(8);
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
            $sql="SELECT account_balance,betsplaces,amount_paid_in FROM admintable where admin_id=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute(["0708073370"]);
                    $row=$stmt->fetch();
                    $accountb=$row->account_balance;
            $sql="UPDATE admintable set account_balance=? ,betsplaces=?,amount_paid_in=? where admin_id=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute(array(($accountb+$word),($row->betsplaces)+1,($row->amount_paid_in)+$word,"0708073370"));
                    $stmt->debugDumpParams();
                    unset($_SESSION['betslip']);
                    /*

                    
                    $account_sid = 'ACf5c6efd53f4d56bf6e66f7c95d266332';
                    $auth_token = '92534b0dee56ab055582a5c2cb87b569';
                   
                    $twilio_number = "+12092706361";
                    $sendnumbet='+254'.substr($_SESSION['usernumber'],1);

                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create(
                        $sendnumbet,
                        array(
                            'from' => $twilio_number,
                            'body' => 'Bet '.$bet_id.' placed successfully. Possible win '.$_SESSION['total']*$word.' Best of luck.'
                        )
                    );  */ 
            header('location:../html/success.php?message=success');
        }
    }
}else{
    header("location:../html/login.php");
}