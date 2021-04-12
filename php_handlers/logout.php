<?php
session_start();
unset($_SESSION['usernumber']);
if(isset($_COOKIE['remember'])){
    
    setcookie('remember',"", 1,'/','betpoa.xyz');
    unset($_COOKIE['remember']);
}
header('location:../html/login.php');
exit();
