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
					<h1>Контакты</h1>
					<div class="breadcrumb">
						<a href="index.html">Home</a>
						<span class="default">  </span>
						<h4>Контакты</h4>
					</div>
				</div>
			</div>
			<!-- breadcrumb ends here -->
			<div id="main">
				<!-- main-content starts here -->
				<div id="main-content">
					<section id="primary" class="content-full-width">
						<div class="fullwidth-section full-contact dt-sc-paralax">
							<div class="container">
								<div class="dt-sc-three-sixth column first">
									<h3>Свяжитесь с нами</h3>
									<div id="ajax_contact_msg"></div>
									<form name="frmcontact" action="php/send.php" method="post" id="contact-form">
										<div class="dt-sc-one-half column first">
										<input type="text" name="txtname" placeholder="Введите имя..." required>
									</div>
									<div class="dt-sc-one-half column">
										<input type="email" name="txtemail" placeholder="Введите e-mail..." required>
									</div>
									<div class="clear"></div>
									  <div class="selection-box">
										<select name="cmbsubject">
											<option value="Ваш статус?">Ваш статус?</option>
											<option value="Спортсмен">Спортсмен</option>
											<option value="Тренер">Тренер</option>
											<option value="Родитель">Родитель</option>
											<option value="Судья">Судья</option>
											<option value="Организатор турниров">Организатор турниров</option>
											<option value="Рекламодатель">Рекламодатель</option>
											<option value="Поставщик">Поставщик</option>
											<option value="Спонсор">Спонсор</option>
										</select>
									</div>
										<div class="selection-box">
										<select name="cmbsubject">
										  <option value="Задайте вопрос?">Задайте вопрос?</option>
										  <option value="Сколько времени идет конкурс?">Сколько времени идет конкурс?</option>
										  <option value="Кто может участвовать в конкурсе?">Кто может участвовать в конкурсе?</option>
										</select>
									</div>
									<textarea name="txtmessage" placeholder="Напишите Ваш вопрос..." required></textarea>
									<input type="submit" name="submit" value="Отправить">
									</form>
								</div>
								<div class="dt-sc-three-sixth column">
									<h3>Мы находимся здесь</h3>
									<div id="contact_map"> </div>
									<div class="dt-sc-hr-invisible"></div>
									<div class="dt-sc-one-half column first">
										<div class="dt-sc-contact-info type1 address"><p><i class="fa fa-rocket"></i>Российская Федерация <br> Москва</p></div>
										<div class="dt-sc-contact-info type1 time"><p><i class="fa fa-clock-o"></i>Рабочее время <br>9:00 - 18:00<br> Понедельник - Пятница </p></div>
									</div>
									<div class="dt-sc-one-half column">
										<div class="dt-sc-contact-info type1"><p><i class="fa fa-phone"></i>+7 915 171 9291</p></div>
										<div class="dt-sc-hr-invisible-small"></div>
										<div class="dt-sc-contact-info type1"><p><i class="fa fa-globe"></i><a href="http://www.google.com" target="_blank">google.com</a></p></div>
										<div class="dt-sc-hr-invisible-small"></div>
										<div class="dt-sc-contact-info type1"><p><i class="fa fa-envelope"></i><a href="mailto:yourname@somemail.com">info@MyTennis.online</a></p></div>
									</div>
								</div>
							</div>
						</div>
						<div class="dt-sc-hr-invisible-medium"></div>
						<div class="fullwidth-section dt-sc-paralax">
							<div class="container">
								<div class="dt-sc-one-third column first">
									<div class="contact-pack">
										<h3 class="section-title3">БЛОК 1 <br><span>СПОНСОР 1</span></h3>
										<p><b>Компания 1</b> делает то-то и далее текст про неё. </p>
									</div>
								</div>
								<div class="dt-sc-one-third column">
									<div class="contact-pack">
										<h3 class="section-title3">БЛОК 2 <br><span>СПОНСОР 2</span></h3>
										<p><b>Компания 2</b> делает то-то и далее текст про неё. </p>
									</div>
								</div>
								<div class="dt-sc-one-third column">
									<div class="contact-pack">
										<h3 class="section-title3">БЛОК 3  <br><span>СПОНСОР 3</span></h3>
										<p><b>Компания 3</b> делает то-то и далее текст про неё. </p>
									</div>
								</div>
							</div>
						</div>
						<div class="dt-sc-hr-invisible-large"></div>
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
