<?php
include ('./login/line_check.php');
include ('./layout/site_function.php');
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
					<p><a href="/login/exit.php">Выйти</a></p>
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

						<form method="POST" action="./login/move_save_exe.php">
							<div class="dt-sc-three-sixth column first">
								<style>
									.one_move {
										position: relative;
										width: 100%;
										/* height: 235px;
										overflow: hidden; */
										border: 1px solid rgb(223, 223, 223);
										margin-bottom: 40px;
									}
									.instagram-media {
										border-color: white !important;
									}
								</style>
	
								<input placeholder="Вставьте в это поле ссылку или часть кода для прикрепления видеоролика" type="text" name="mov_link" id = "move_load" required>
								<div id = "move_alert_info"></div>
								<div class="one_move">
								</div>
								<textarea placeholder="Описание ролика (не более 200 знаков) - коротко опишите для кого Ваш ролик и какие задачи решает."
									name="mov_description"></textarea>
							</div>

							<div class="dt-sc-three-sixth column last">

								<input placeholder="Название ролика (не более 30 знаков)" type="text" name="mov_name" required>
								<select name="mov_contest" required>
									<?php
									// Определяем список конкурсов в зависимости от текущей даты
									if(GetContestPermission($date_now) == 1){
										echo "<option value=''>Выберите категорию конкурса</option>";
										echo "<option value='Удивительный теннис'>Удивительный теннис</option>";
										echo "<option value='Семейный теннис'>Семейный теннис</option>";
									}elseif(GetContestPermission($date_now) == 2){
										echo "<option value=''>Выберите категорию конкурса</option>";
										echo "<option value='Теннисная прокачка'>Теннисная прокачка</option>";
										echo "<option value='Свой конкурс'>Свой конкурс</option>";	
									}else{
										echo "<option value=''>Выберите категорию конкурса</option>";
										echo "<option value='Удивительный теннис'>Удивительный теннис</option>";
										echo "<option value='Семейный теннис'>Семейный теннис</option>";
										echo "<option value='Теннисная прокачка'>Теннисная прокачка</option>";
										echo "<option value='Свой конкурс'>Свой конкурс</option>";
									}
									?>
								</select>

								<select name="mov_age_cat" required>
									<option value="">Выберите возрастную категорию аудитории</option>
									<option value="Любой">Любой</option>
									<option value="до 8 лет">до 8 лет</option>
									<option value="9-10 лет">9-10 лет</option>
									<option value="до 13 лет">до 13 лет</option>
									<option value="до 15 лет">до 15 лет</option>
									<option value="до 17 лет">до 17 лет</option>
									<option value="взрослые">взрослые</option>
								</select>
								<style>
									.move_check input {
										position: absolute;
										/* z-index: -1; */
										opacity: 0;
									}

									.move_check span {
										margin-right: 5px;
										line-height: 2.5rem;
										display: inline-block;
									}

									.move_check label {
										padding: 8px;
										color: #FFF;
										background-color: #179ed6;
										cursor: pointer;
									}
								</style>

								<aside class="widget">
									<div class="widgettitle">
										<h3>Тэги</h3><span></span>
									</div>
									<div class="move_check">
										<?php
										$mov_contest_arr = array('Скорость', 'Сила', 'Выносливость', 'Координация', 'Концентрация', 'Точность', 'Гибкость', 'Кардио');
										$k=0;
										foreach($mov_contest_arr as $contest){
											echo "<span>";
											// echo "<input type='checkbox' id='kap{$k}' name='kap{$k}' value='yes'>";
											// echo "<label for='kap{$k}'>{$contest}</label>";
											echo "<input type='checkbox' id='tags{$k}' name='mov_tags[]' value='{$contest}'>";
											echo "<label for='tags'>{$contest}</label>";
											echo "</span>";
										$k++;	
										}
										?>

									</div>
								</aside>
								<aside class="widget">
									<div class="widgettitle">
										<h3>Принадлежности</h3><span></span>
									</div>
									<div class="move_check">
										<?php
										$mov_equipment_arr = array('Скакалка', 'Ракетка', 'Теннисный мяч', 'Весовой мяч', 'Фитбол', 'Подставка/степ-платформа', 'Гантели', 'Коврик', 'Обруч', 'Тросы и ленты', 'Утяжелитель', 'Балансировочный тренажер', 'Эспандер', 'Батут', 'Скамейка/стул', 'Другое');
										$k=0;
										foreach($mov_equipment_arr as $equipment){
											echo "<span>";
											echo "<input type='checkbox' id='equipment{$k}' name='mov_equipment[]' value='{$equipment}'>";
											echo "<label for='equipment{$k}'>{$equipment}</label>";
											echo "</span>";
										$k++;	
										}
										?>
									</div>
								</aside>
							</div>
							<div style="text-align: center;">
								<input type="submit" class="dt-sc-button small" data-hover="Новый ролик"
									value="Отправить на конкурс" id = "send_move_btn">
								<!-- <a href="private_add_video.php" class="dt-sc-button small" 
									data-hover="Новый ролик">Отправить на конкурс</a> -->
							</div>
							<div class="dt-sc-hr-invisible-small"></div>
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