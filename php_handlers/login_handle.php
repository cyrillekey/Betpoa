<?php
include('../conn/conn.php');
if(isset($_POST['status']) && $_POST['status']==true){
$user=$_POST['usernumber'];
$password=$_POST['password'];
$rem=$_POST['remember'];
$sql="SELECT * FROM users_table where user__id=?";
$stmt=$conn->prepare($sql);
$stmt->execute([$user]);
$number=$stmt->rowCount();
if($number>0){
    if($row=$stmt->fetch()){
        $pwdcheck=password_verify($password,$row->user_password);
        if(!$pwdcheck){
            echo("pwd");
        }else{
            session_start();
            $_SESSION['usernumber']=$user;
            if($rem=='true'){
                $selector=base64_encode(random_bytes(9));
                $authenticator=random_bytes(3);
                setcookie('remember',$selector.':'.base64_encode($authenticator),time()+864000,'/','',true,true);
                $sql="INSERT INTO auth_tokes(selector,token,userid,expires) values(:selector,:token,:userid,:expires)";
                
                $stmt=$conn->prepare($sql);
                $stmt->execute([
                    "selector"=>$selector,
                    "token"=> hash('sha256',$authenticator),
                    "userid"=>$user,
                    "expires"=>date('Y-m-d\TH:i:s',time()+864000)
                ]);     
            }

           echo('login');
        }
    }
}else{
    echo"nouser";
}}else{
    echo("hello world");
}