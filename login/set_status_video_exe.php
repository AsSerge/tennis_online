<?php
include ($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');
include ('../layout/site_function.php');
include ('../classes/tags.class.php');
include ('./PHPMailer/PHPMailerFunction.php'); // Подключаем функцию отправки почты
//************************************* Временная блокировка ролика **************************************/
if(isset($_GET['mov_id']) && isset($_GET['act']) && $_GET['act'] == "block"){
	$mov_status = 0;
	$mov_id = $_GET['mov_id'];
	$sql = "UPDATE movie SET mov_status = ? WHERE mov_id = ?";
	$stmt = $db->prepare($sql); // Готовим запрос
	$stmt->execute([$mov_status, $mov_id]);
	header("Location: /private.php?mov_id={$mov_id}"); exit();
}elseif(isset($_GET['mov_id']) && isset($_GET['act']) && $_GET['act'] == "unblock"){
	$mov_status = 1;
	$mov_id = $_GET['mov_id'];
	$sql = "UPDATE movie SET mov_status = ? WHERE mov_id = ?";
	$stmt = $db->prepare($sql); // Готовим запрос
	$stmt->execute([$mov_status, $mov_id]);
	header("Location: /private.php?mov_id={$mov_id}"); exit();
}
?>
