<?php
/*
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);
$dns='mysql:host='.$server.';dbname='.$db;

$conn = new PDO($dns,$username,$password, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
));
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ); 
*/
$host='localhost';
$user='cyrille';
$password='123456';
$database='betpoa';
$dsn='mysql:host='.$host.';dbname='.$database;

$conn=new PDO($dsn,$user,$password); 
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
