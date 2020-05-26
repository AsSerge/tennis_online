<?php

// Home server
$dbUsername='root';
$dbPassword='root';
$dbName='ten_base';
$dbHost='localhost';

// Work server
// $dbUsername='root';
// $dbPassword='';
// $dbName='ten_base';
// $dbHost='localhost';

$ConnectString="mysql:host={$dbHost};dbname={$dbName}";
$db = new PDO($ConnectString, $dbUsername, $dbPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
?>