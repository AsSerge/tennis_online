<?php
// Скрипт проверки ПЕРВОНАЧАЛЬНО ВВЕДЕННЫХ ДАННЫХ
include($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
	$user_id = $_COOKIE['id']; // Получаем ID из cookey если он установлен
	$query = "SELECT * FROM users WHERE user_id=? LIMIT 1";
	$my_data = $db->prepare($query);
	$my_data->execute([$user_id]);
	$userdata = $my_data->fetch(PDO::FETCH_ASSOC);// Получаем значение одного поля

 if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']) or ($userdata['user_status'] !== "true"))
	{
		setcookie("id", "", time() - 60*60*24*3, "/");
		setcookie("hash", "", time() - 60*60*24*3, "/");
		//Куки установлены но не совпадают - УДАЛЕНЫ - возврат на страницу авторизации
		header("Location: /login/login.php"); exit();
	}
	else
	{
	//Все в порядке - возврат на страницу кабинета клиента !!!!!! Внимание - здесь необходимо предусмотреть возможность возврата на проверяемую страницу
	header("Location: /index.php"); exit();
	}
}
else
{	
	//Куки не установлены - возврат на страницу авторизации
	header("Location: /login/login.php"); exit();
}
?>