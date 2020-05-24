<?php
// Страница авторизации
	include($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');

// Функция для генерации случайной строки
function generateCode($length=6) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
	$code = "";
	$clen = strlen($chars) - 1;
	while (strlen($code) < $length) {
			$code .= $chars[mt_rand(0,$clen)];
	}
	return $code;
}

$error_message = "";

if(isset($_POST['submit']))
{
	$user_login = htmlspecialchars($_POST['login']);
	$user_password = htmlspecialchars($_POST['password']);

	$query = "SELECT user_id, user_password FROM users WHERE user_login=? LIMIT 1";
	$my_data = $db->prepare($query);
	$my_data->execute([$user_login]);
	$data = $my_data->fetch(PDO::FETCH_ASSOC);// Получаем значение одного поля [название опроса]
	// Сравниваем пароли
	if($data['user_password'] === md5(md5($_POST['password'])))
	{
		// Генерируем случайное число и шифруем его
		$hash = md5(generateCode(10));
		// Записываем в БД новый хеш авторизации и IP
		$query = "UPDATE users SET user_hash=? WHERE user_id=?";
		$stmt = $db->prepare($query); // Готовим запрос
		$stmt->bindParam(1, $hash);
		$stmt->bindParam(2, $data['user_id']);
		$stmt->execute();

		# Ставим куки на трое суток
		setcookie("id", $data['user_id'], time()+60*60*24*3, "/");
		setcookie("hash", $hash, time()+60*60*24*3, "/");
		$error_message = "Есть такой пользователь";
		// Переадресовываем браузер на страницу проверки нашего скрипта
		 header("Location: /index.html"); exit();
	}
	else
	{
		$error_message = "<div class = 'form-signin-error'><p>Вы ввели неправильный логин/пароль</p></div>";

	}
}
?>
<div class="container">
		<div class="row">
			<form method="POST" class="form-signin" role="form">
					<h1 class="form-signin-heading">Вход на сайт</h1>
					<input name="login" type="text" class="form-control" placeholder="Логин" required autofocus>
					<input name="password" type="password" class="form-control" placeholder="Пароль" required>
					<button class="btn btn-md btn-primary btn-block" type="submit" name="submit" >Войти</button>
			</form>
		</div>

		<?=$error_message?>

<p><a href = "../mov.php">Рагистрация нового пользователя</a></p>

</div>
