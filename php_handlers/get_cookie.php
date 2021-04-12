<?php

function mango(){
    require('../conn/conn.php');
session_start();
if (empty($_SESSION['usernumber']) && !empty($_COOKIE['remember'])) {
    list($selector, $authenticator) = explode(":", $_COOKIE['remember']);
    $sql = "SELECT * from auth_tokes where selector= ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$selector]);
    $row = $stmt->fetch();
    if (hash_equals($row->token, hash('sha256', base64_decode($authenticator)))) {
        $_SESSION['usernumber'] = $row->userid;
    }
}}