<?php 
include('../conn/conn.php');
$password=$_POST['password'];
$usernumber=$_POST['usernumber'];
if(isset($password)){
$new_password=password_hash($password,PASSWORD_DEFAULT);
$sql="SELECT * FROM users_table where user__id=?";
$stmt=$conn->prepare($sql);
$stmt->execute([$usernumber]);
$number=$stmt->rowCount();
if($number>0)
{
    echo"regis";
}
else{
    $sql="INSERT INTO users_table(user__id,user_number,user_password,account_balance) VALUES(:user__id,:user_number,:user_password,:account_balance)";
    $stmt=$conn->prepare($sql);
    $stmt->execute([
        "user__id"=>$usernumber,
        "user_number"=>$usernumber,
        "user_password"=>$new_password,
        "account_balance"=>"50.00"
    ]);
    session_start();
    $_SESSION['usernumber']=$usernumber;
    
    $sql="UPDATE admintable set users_regis=users_regis+1 where admin_id=?";
    $stmt=$conn->prepare($sql);
    $stmt->execute(["0708073370"]);
    echo"success";
}}else{
    echo"work";
}