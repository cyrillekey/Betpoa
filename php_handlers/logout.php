<?php
session_start();
unset($_SESSION['usernumber']);
header('location:../html/login.php');
exit();
