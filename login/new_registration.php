<?php
session_start();
//************************************* Скрипт регистрации нового пользователя **************************************/
include($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');
include('./PHPMailer/PHPMailerFunction.php'); // Подключаем функцию отправки почты
// Функция проверки существования адреса электронной почты
function CheckMail ($db, $user_mail){

	$query = "SELECT COUNT(user_mail) FROM users WHERE user_mail = ?";
	$my_data = $db->prepare($query);
	$my_data->execute([$user_mail]);
	$userdata = $my_data->fetch();
	if ($userdata[0] > 0) {
		return false;
	}else{
		return true;
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
	$user_status = 0; // Отключаем учетную запись при первоначальной регистрации
	// Проверяем, существует ли почта в базе, и если нет - начинаем подлив
	
	//! Здесь необходимо сделать еще одну проверку

	if(CheckMail($db, $user_mail)){

		$sql = "INSERT INTO users (user_login, user_mail, user_password, mail_confirm, user_status) VALUES (?, ?, ?, ?, ?)"; // Плейсхолдер запроса
		$stmt = $db->prepare($sql); // Готовим запрос
		$stmt->bindParam(1, $user_login);
		$stmt->bindParam(2, $user_mail);
		$stmt->bindParam(3, $user_password);
		$stmt->bindParam(4, $mail_confirm);
		$stmt->bindParam(5, $user_status);
		// Исполняем запрос
		$stmt->execute();
		// Получаем ID последней записи
		$user_id = $db->lastInsertId();

		// Отправляем сообщение о рагистрации на указанную почту
		$subject = "Регистрация на сайте MyTennis.online";
		$message = "Добрый день! Вы оставили заявку на регистрацию на сайте MyTennis.online.<br>Для активации вашей учетной записи вам необходимо пройти по ссылке:<br>";
		$message .= "<a href='https://{$_SERVER['HTTP_HOST']}/login/registration_confirmation.php?user_id={$user_id}&mail_confirm={$mail_confirm}'>";
		$message .= "https://{$_SERVER['HTTP_HOST']}/login/registration_confirmation.php?user_id={$user_id}&mail_confirm={$mail_confirm}";
		$message .= "</a><br>";
		$message .= "==============================================<br>";
		$message .= "С уважением. Администрация сайта mytennis.online";

		SendMailGRMP($user_mail, $subject, $message, $sender_mail, $sender_name); // Отправляем почту

		// Установливаем сессионную переменную
		$_SESSION['info'] = "На указанную Вами почту отправлена ссылка для активации учетной записи. Вы можете войти в систему после активации.";
		// Возвращаемся на страницу
		header("Location: ../entry.php"); exit();
	}
}

?>