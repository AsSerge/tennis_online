<?php 
// Скрипт линейной проверки 
include($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');

//При установленной куке ID делаем запрос к базе
if (isset($_COOKIE['id'])){
	$user_id = $_COOKIE['id']; // Получаем ID из cookey если он установлен
	$query = "SELECT * FROM users WHERE user_id=? LIMIT 1";
	$my_data = $db->prepare($query);
	$my_data->execute([$user_id]);
	$userdata = $my_data->fetch(PDO::FETCH_ASSOC);// Получаем значение одного поля

	// $query = mysqli_query($link, "SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."'");
	// $userdata = mysqli_fetch_assoc($query);
}
//Проверяем, все ли куки установлены и равны тем, что в базе
if (
	!isset($_COOKIE['id']) 
	or !isset($_COOKIE['hash'])
	or ($userdata['user_hash'] !== $_COOKIE['hash'])
	or ($userdata['user_id'] !== $_COOKIE['id'])
	or ($userdata['user_status'] !== "true")	
   ){
	header("Location: /entry.php"); exit();
}
?>