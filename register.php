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
					<h1>РЕГИСТРАЦИЯ</h1>
					<div class="breadcrumb">
						<a href="/">Home</a>
						<span class="default"> </span>
						<h4>Регистрация</h4>
					</div>
				</div>
			</div>
			<!-- breadcrumb ends here -->
			<div id="main">
				<!-- main-content starts here -->
				<div id="main-content">
					<section id="primary" class="content-full-width">
						<div class="fullwidth-section">
								<div class="container">
									<h3 class="border-title aligncenter"> <span>
											<i class="fa fa-user"></i> Еще не зарегистрированы? - Давайте сделаем это
											сейчас! </span></h3>
								</div>
						</div>
						<div class="fullwidth-section dt-sc-paralax full-pattern6">
							<div class="container">
								<div class="form-wrapper register">
									<form method="POST" action="/login/new_registration.php" id="reg_form"
										name="frmRegister" role="form">
										<input type="hidden" name="my_whwre" value="SUPER8">
										
										<p class="first">
										Введите адрес электронной почты и пароль для регистрации в системе. Этот <strong>адрес будет использоваться в качестве логина</strong> при авторизации. После регистрации на указанный вами почтовый ящик будет отправлено письмо для активации вашей учетной записи. Для активации необходимо пройти по ссылке из письма. 
										</p>
										<div class="dt-sc-hr-invisible-small"></div>
										<p class="dt-sc-one-column column">
											<input placeholder="Электронная почта" id="user_mail" type="email"
												name="user_mail" required>
										</p>
										<p id="mail_infotext"></p>
										<p class="dt-sc-three-sixth column first">
											<input placeholder="Пароль" type="password" id="user_password"
												name="user_password">
										</p>

										<p class="dt-sc-three-sixth column">
											<input placeholder="Повторите пароль" name="c_pwd" type="password"
												id="user_confirm_password" required>
										</p>
										<p id="pass_infotext"></p>
										<input class="dt-sc-button small" value="Зарегистрироваться*" type="submit"
											id="register_form_submit">
											<div class="dt-sc-hr-invisible-small"></div>
											<p class="first">*Регистрируясь на сайте Вы принимаете <a href ="#" target="_blank">Правила участия</a> в конкурсах, проводимых Федерацией Тенниса России (ФТР) или уполномоченными организациями.</p>

											<style>
											.one_smm {
												margin: 4px;
											}

											.one_smm:HOVER {
												opacity: 0.7;
											}
										</style>
										<p>Вход через социальные сети:</p>
										<?php
										$smm_link['VKontakte'] = ['vk', 'vk_entry.svg'];
										$smm_link['Ok'] = ['ok', 'ok_entry.svg'];
										$smm_link['Facebook'] = ['facebook', 'fb_entry.svg'];
										$smm_link['Google'] = ['google', 'gl_entry.svg'];
										$smm_link['Yandex'] = ['ya', 'ya_entry.svg'];
										$smm_link['Mail.ru'] = ['mailru', 'ml_entry.svg'];
										// $smm_link['Instagramm'] = ['inst', 'is_entry.svg'];
										foreach($smm_link as $key => $adr){
											echo "<a href='https://mytennis.online/entry.php?via={$adr[0]}' class='one_smm'><img src='/images/logo/{$adr[1]}' alt='{$key}' title='{$key}' width='30px'></a>";
										}
										?>
									</form>
								
								</div>
							</div>
						</div>
						<div class="dt-sc-hr-invisible-small"></div>
						
						<?php //include ('./layout/sp/subscript.php');?>
						<!-- <div class="dt-sc-hr-invisible-large"></div> -->
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
