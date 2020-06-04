<?php
session_start();
//************************************* Скрипт восстановления пароля **************************************/
include($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');
include('./PHPMailer/PHPMailerFunction.php'); // Подключаем функцию отправки почты
// Функция проверки существования адреса электронной почты (пропускаем если адрес существует)
function CheckMail ($db, $user_mail){
	$query = "SELECT COUNT(user_mail) FROM users WHERE user_mail = ?";
	$my_data = $db->prepare($query);
	$my_data->execute([$user_mail]);
	$userdata = $my_data->fetch();
	if ($userdata[0] > 0) {
		return true;
	}else{
		return false;
	}
}
$set = $_POST['my_whwre'];
$sender_mail = "no-reply@mytennis.online";
$sender_name = "Администратор";

if($set =="SUPER8"){	
	$user_mail = htmlspecialchars($_POST['user_mail'], ENT_QUOTES);
	$user_login = $user_mail;
	$user_password = md5(md5(trim($_POST['user_password']))); // Двойное кодирование на всякий случай
	$mail_confirm = md5(md5($user_login)); // Формируем хеш для подтверждения почтового адреса
	$user_status = 'false';

	// Проверяем, существует ли почта в базе, и если нет - начинаем подлив
	//! Здесь необходимо сделать еще одну проверку
	
	if(CheckMail($db, $user_mail)){		
		$sql = "UPDATE users SET user_password = ?, mail_confirm = ?, user_status = ? WHERE user_login=?";	
		$stmt = $db->prepare($sql); // Готовим запрос
		$stmt->bindParam(1, $user_password);
		$stmt->bindParam(2, $mail_confirm);
		$stmt->bindParam(3, $user_status);
		$stmt->bindParam(4, $user_login);
		// Исполняем запрос
		$stmt->execute();
		
		// Получаем user_id (необходимо для активации учетной записи)
		$id_sql = "SELECT user_id FROM users WHERE user_login = ?";
		$stmt = $db->prepare($id_sql); // Готовим запрос;
		$stmt->execute([$user_login]);
		$id = $stmt->fetch(PDO::FETCH_ASSOC);
		$user_id = $id['user_id'];

		// Отправляем сообщение о рагистрации на указанную почту
		$subject = "Восстановление пароля на сайте MyTennis.online";
		$message = "Добрый день!<br>";
		$message .= "Ваш пароль восстановлен<br>";
		$message = "Для активации вашей учетной записи вам необходимо пройти по ссылке:<br>";
		$message .= "<a href='http://{$_SERVER['HTTP_HOST']}/login/registration_confirmation.php?user_id={$user_id}&mail_confirm={$mail_confirm}'>";
		$message .= "http://{$_SERVER['HTTP_HOST']}/login/registration_confirmation.php?user_id={$user_id}&mail_confirm={$mail_confirm}";
		$message .= "</a><br>";

		$message .= "==============================================<br>";
		$message .= "С уважением. Администрация сайта mytennis.online";

		SendMailGRMP($user_mail, $subject, $message, $sender_mail, $sender_name); // Отправляем почту

		// Установливаем сессионную переменную
		$_SESSION['info'] = "Ваш пароль восстановлен!<br>На указанную Вами почту отправлена ссылка для активации учетной записи. Вы можете войти в систему после активации.";

		// Возвращаемся на страницу
		header("Location: ../entry.php"); exit();
	}
}

?>