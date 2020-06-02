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

						<form method="POST">
							<div class="dt-sc-three-sixth column first">
								<style>
									.one_move {
										position: relative;
										width: 100%;
										/* height: 310px; */
										border: 1px solid rgb(223, 223, 223);
										margin-bottom: 40px;
									}
								</style>
								<?php 
								// Получаем и готовим линк
								$vimeo_link = "https://vimeo.com/77270461";
								$vimeo_short_link = str_replace("https://vimeo.com/", "", $vimeo_link);
								?>
								<input placeholder="Название ролика" type="text" name="mov_name">
								<div class="one_move">
									<iframe src="https://player.vimeo.com/video/<?=$vimeo_short_link?>" width="640"
										height="360" frameborder="0" allow="autoplay; fullscreen"
										allowfullscreen></iframe>

									<!-- <blockquote class="instagram-media" data-instgrm-version="7">
										<a href="https://www.instagram.com/p/CAIm3SDn54v/"></a>
									</blockquote>
									<script async defer src="//platform.instagram.com/en_US/embeds.js"></script> -->

								</div>
								<textarea placeholder="Описание ролика" name="mov_description"></textarea>

								<!-- <input placeholder="Загрузка обложки" type="text" name="mov_cover"> -->

							</div>

							<div class="dt-sc-three-sixth column last">

								<input placeholder="Строка загрузки" type="text" name="mov_link">
								<select name="mov_contest">
									<option value="">Категория конкурса</option>
									<option value="Удивительный теннис">Удивительный теннис</option>
									<option value="Семейный теннис">Семейный теннис</option>
									<option value="Теннисная прокачка">Теннисная прокачка</option>
									<option value="Свой конкурс">Свой конкурс</option>
								</select>

								<select name="mov_age_cat">
									<option value="">Возрастная категория</option>
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
											echo "<span><nobr>";
											echo "<input type='checkbox' id='kap{$k}' name='kap{$k}' value='yes'>";
											echo "<label for='kap{$k}'>{$contest}</label>";
											echo "</nobr></span>";
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
											echo "<span><nobr>";
											echo "<input type='checkbox' id='equ{$k}' name='equ{$k}' value='yes'>";
											echo "<label for='equ{$k}'>{$equipment}</label>";
											echo "</nobr></span>";
										$k++;	
										}
										?>
									</div>
								</aside>


							</div>
							<div style="text-align: center;">

								<a href="private_add_video.php" class="dt-sc-button small"
									data-hover="Новый ролик">Отправить на конкурс</a>
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