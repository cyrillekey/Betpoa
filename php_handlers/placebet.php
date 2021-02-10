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

require('../conn/conn.php');
session_start();
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
            $sql="INSERT INTO bets_table(bet_id,user__id,bet_status,time_placed,bet_amount,possiblewin,total_odds) VALUES (:bet_id,:user__id,:bet_status,:time_placed,:bet_amount,:possiblewin,:total_odds)";
            $stmt=$conn->prepare($sql);
            $stmt->execute([
                'bet_id'=>$bet_id,
                'user__id'=>$username,
                'bet_status'=>"not placed",
                'time_placed'=>time(),
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
                    
                    $sql="SELECT account_balance FROM users_table where user__id=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute(["admin12345"]);
                    $row=$stmt->fetch();
                    $accountb=$row->account_balance;

                    
                    $conn->commit();    
                }
                
                
                catch(Exception $e){
                    $conn->rollBack();
                    echo($stmt->debugDumpParams());
                    exit();                }

            }}
            $sql="UPDATE users_table set account_balance=? where user__id=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute(array(($accountb+$word),"admin12345"));
                    unset($_SESSION['betslip']);
            header('location:../html/success.php?message=success');
        }
    }
}else{
    echo"not log in";
}