<?php

// Вход с социальных сетей
	require_once($_SERVER['DOCUMENT_ROOT'].'/auth/via.php');

session_start();
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
	$data = $my_data->fetch(PDO::FETCH_ASSOC);// Получаем значение поля
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
		 header("Location: ../private.php"); exit();
	}
	else
	{
		$error_message = "<div class = 'form-signin-error'><p>Вы ввели неправильный логин/пароль или не активировали свою учетную запись по ссылке из активационного письма</p></div>";
	}
}
?>
<?php include('./layout/site_head.php');?>
<!-- Loader starts here -->
<div id="loader-wrapper">
	<div class="loader">
		<span class="glyph-icon flaticon-man159"></span>
	</div>
</div>
<!-- Loader ends here -->
	<!-- **Wrapper** -->
	<div class="wrapper">
		<div class="inner-wrapper">
			<!-- header-wrapper starts here -->
			<?php include ('./layout/header.php');?>
			<!-- header-wrapper end here -->
			<!-- breadcrumb starts here -->
			<div class="breadcrumb-wrapper">
				<div class="container">
					<h1>Личный кабинет</h1>
					<div class="breadcrumb">
						<a href="/">Личный кабинет</a>
						<span class="default"> </span>
						<h4>Вход в личный кабинет</h4>
					</div>
				</div>
			</div>
			<!-- breadcrumb ends here -->
			<div id="main">
				<!-- main-content starts here -->
				<div id="main-content">
					<section id="primary" class="content-full-width">
						<div class="fullwidth-section dt-sc-paralax full-pattern6">
							<div class="container">
							<div style="text-align: center; color: red;">
							<?php
							echo $_SESSION['info'];
							$_SESSION['info'] = '';
							?>
							</div>
								<div class="form-wrapper register">
									<form method="POST" id="reg_form" name="frmEntry" role="form">
											<p>
												<input name="login" type="text" class="form-control" placeholder="Логин (e-mail, введенный вами при регистрации)" required autofocus>
											</p>
											<p>
												<input placeholder="Пароль" type="password" id="user_password" name="password">
											</p>
											<p id="pass_infotext"></p>
											<?=$error_message;?>
											<!-- <button class="dt-sc-button small" name="submit" type="submit">Отправить</button> -->
											<input class="dt-sc-button small" value="Войти" type="submit" name="submit">
											<div class="dt-sc-hr-invisible-small"></div>
											<p><a href = "register.php" title="Новая регистрация в системе">Зарегистрироваться в системе</a>
											&nbsp;/&nbsp;<a href = "password_recovery.php" title="Ссылка для восстановления пароля будет выслана на указанную при регистрации почту">Я забыл пароль</a>
											</p>
									</form>
								</div>
							</div>
						</div>
						<div class="dt-sc-hr-invisible-small"></div>
					</section>
				</div>
				<!-- main-content ends here -->
			</div>
			<!-- footer starts here -->
			<?php include ('./layout/footer.php');?>
			<!-- footer ends here -->
	</div><!-- **Inner Wrapper - End** -->
</div><!-- **Wrapper - End** -->
<?php include('./layout/site_foot.php');?>
