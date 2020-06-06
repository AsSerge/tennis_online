<?php
// Home server
$dbUsername='root';
$dbPassword='root';
$dbName='u1068761_default';
$dbHost='localhost';

// Work server
// $dbUsername='u1068761_default';
// $dbPassword='!bU09QKw';
// $dbName='u1068761_default';
// $dbHost='localhost';

$ConnectString="mysql:host={$dbHost};dbname={$dbName}";
$db = new PDO($ConnectString, $dbUsername, $dbPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
?>