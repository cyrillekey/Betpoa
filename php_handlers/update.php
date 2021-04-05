<?php
require('../conn/conn.php');
if(isset($_POST['num']) && isset($_POST['pass']) && isset($_POST['pass2']) && isset($_POST['token'])){
    $num=($_POST['num']);
$pass2=($_POST['pass']);
$pass=($_POST['pass2']);
$token=$_POST['token'];
if($pass===$pass2){
    if(strlen($pass)>5){
$sql="SELECT * from password_reset where reset_token= ? and reset_user__id= ?";
echo"here";
$stmt=$conn->prepare($sql);
$stmt->execute([$token,$num]);
$row=$stmt->fetch();
if($row->expiry_date<time())
{
    $newpass=password_hash($pass,PASSWORD_DEFAULT);
    $sql="UPDATE users_table set user_password = ? where user__id = ?";
    $stmt=$conn->prepare($sql);
    $stmt->execute([$newpass,$num]);
    header("location:../html/newpass.php?err=pass");
    exit();
}else{
    header("location:../html/newpass.php?err=exp");
}
    }else{
        header("location:../html/newpass.php?err=len");
    }
}else{
    header("location:../html/newpass.php?err=pass");
}
}
else{
    header("location:../html/newpass.php?err=blank");
}
?>