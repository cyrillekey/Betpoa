<?php
session_start();
unset($_SESSION['usernumber']);
if(isset($_COOKIE['remember'])){
    unset($_COOKIE['remember']);
    setcookie('remember', null, -1, '/');
}
header('location:../html/login.php');
exit();
