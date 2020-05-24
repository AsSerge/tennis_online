<?php
include ('./login/line_check.php');
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
					<h1>Личный кабинет <span>[<?=$userdata['user_login']?>]</span></h1>
					<div class="breadcrumb">
						<a href="/">Home</a>
						<span class="default"> </span>
						<h4>Личный кабинет</h4>
						<p><a href = "/login/exit.php">Выйти</a></p>
					</div>
				</div>
			</div>
			<!-- breadcrumb ends here -->
			<div id="main">
				<!-- main-content starts here -->
				<div id="main-content">
					<section id="primary" class="content-full-width">
						<!-- <div class="dt-sc-hr-invisible-normal"></div> -->
							<div class="container">
							<h3 class="border-title"> <span> Добавление ролика </span></h3>
							<form method = "POST">

							<div class="dt-sc-three-sixth column first">
								
								<input placeholder="Название ролика" type="text" name="">
								
								<select name="cmbsubject">
									<option value="contest0">Категория конкурса</option>
									<option value="contest1">Удивительный теннис</option>
									<option value="contest2">Семейный теннис</option>
									<option value="contest3">Теннисная прокачка</option>
								</select>
								<textarea placeholder="Описание ролика"></textarea>
							</div>

							<div class="dt-sc-three-sixth column last">
								<input placeholder="Теги" type="text" name="">
								<select name="cmbsubject">
									<option value="contest0">Возрастная категория</option>
									<option value="contest1">до 16 лет</option>
									<option value="contest2">от 16 до 35 лет</option>
									<option value="contest3">от 35 до 50 лет</option>
									<option value="contest3">от 50 лет</option>
								</select>

								<select name="cmbsubject">
									<option value="contest0">Тип загрузки</option>
									<option value="contest1">Ссылка в Yutube.com</option>
									<option value="contest2">Ссылка в Vimeo.com</option>
									<option value="contest3">Прямая загрузка</option>
								</select>
								<input placeholder="Строка загрузки" type="text" name="">
								<input placeholder="Загрузка обложки" type="text" name="">
							</div>


								<!-- <p class="dt-sc-three-sixth column first">
									<input placeholder="Категория конкурса" type="text" name="">
								</p>
								<p class="dt-sc-three-sixth column first">
									<input placeholder="Название ролика" type="text" name="">
								</p>
								<p class="dt-sc-three-sixth column first">
									<input placeholder="Теги" type="text" name="">
								</p>
								<p class="dt-sc-three-sixth column first">
									<input placeholder="Возрастная градация" type="text" name="">
								</p>
								<textarea placeholder="Описание ролика"></textarea>
								<p id="pass_infotext"></p>
								<input class="dt-sc-button small" value="Зарегистрироваться" type="submit" id="register_form_submit"> -->
							</form>
							</div>
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
