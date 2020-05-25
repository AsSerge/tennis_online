<?php
// Work server
// $dbUsername='ten_admin';
// $dbPassword='Qwerty#2020';
// $dbName='ten_base';
// $dbHost='localhost';

// Home server
// $dbUsername='root';
// $dbPassword='root';
// $dbName='ten_base';
// $dbHost='localhost';

// Work server 2
$dbUsername='root';
$dbPassword='';
$dbName='ten_base';
$dbHost='localhost';


$ConnectString="mysql:host={$dbHost};dbname={$dbName}";
$db = new PDO($ConnectString, $dbUsername, $dbPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
?>