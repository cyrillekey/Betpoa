<?php
session_start();
$games=explode(",",$_SESSION['betslip']);
session_destroy();
header('location:../index.php');
exit();