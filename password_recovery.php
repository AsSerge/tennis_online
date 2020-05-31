<?php
// Страница авторизации
include($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');
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
					<h1>Восстановление пароля</h1>
					<div class="breadcrumb">
						<a href="/">Home</a>
						<span class="default"> </span>
						<h4>Восстановление пароля</h4>
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
								<div class="form-wrapper register">
									<form method="POST" action="/login/password_recovery_exe.php" id="reg_form" name="frmEntry" role="form">
									<input type="hidden" name="my_whwre" value="SUPER8">
											<p>Для смены (восстановления) пароля введите логин (адрес электронной почты), введенный вами при регистрации в системе.</p>
											<p>
												<input name="user_mail" id="recover_password" type="text" class="form-control" placeholder="Логин (e-mail, введенный вами при регистрации)" required autofocus>
											</p>
											<!-- Поля ввода нового пароля -->
											<div id="newpass">
												<p class="dt-sc-three-sixth column first">
												<input placeholder="Новый пароль" type="password" id="user_password" name="user_password" required>
												</p>

												<p class="dt-sc-three-sixth column">
												<input placeholder="Повторите пароль" type="password" id="user_confirm_password" name="c_pwd" required>
												</p>
												
											</div>
											<p id="pass_infotext"></p>
											<input class="dt-sc-button small" value="Восстановить пароль" type="submit" name="submit" id="recover_password_btn">
											<div class="dt-sc-hr-invisible-small"></div>
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