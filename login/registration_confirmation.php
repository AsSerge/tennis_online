<?php
if(isset($_GET['user_id']) and isset($_GET['mail_confirm'])){
	include($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');

	$user_id = $_GET['user_id'];
	$mail_confirm = $_GET['mail_confirm'];
	
	$query = "SELECT COUNT(user_login) FROM users WHERE user_id = ? AND mail_confirm = ?";
	$my_data = $db->prepare($query);
	$my_data->bindParam(1, $user_id);
	$my_data->bindParam(2, $mail_confirm);
	$my_data->execute();
	$userdata = $my_data->fetch(); // Получаем количество совпадений

	// Включаем пользователя
	if($userdata[0] === '1'){
		$query = "UPDATE users SET user_status = 'true' WHERE user_id = ?";
		$my_data = $db->prepare($query);
		$my_data->execute([$user_id]);
		header("Location: /private.php"); exit();
	}else{
		header("Location: /entry.php"); exit();
	}
}
else{
 	echo "Хрень";
}
?>