<?php
// @require($_SERVER['DOCUMENT_ROOT'].'/login/line_check.php');
// @require($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');
// @require($_SERVER['DOCUMENT_ROOT'].'/classes/tags.class.php');

include ('./login/line_check.php');
include ('./layout/site_function.php');
include ('./classes/tags.class.php');
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
							<input type="hidden" name="user_id" value="<?=$user_id?>">
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

								<input
									placeholder="Вставьте в это поле ссылку или часть кода для прикрепления видеоролика"
									type="text" name="mov_link" id="move_load" required>
								<div id="move_alert_info"></div>
								<div class="one_move">

								</div>
								<textarea
									placeholder="Описание ролика (не более 200 знаков) - коротко опишите для кого Ваш ролик и какие задачи решает."
									name="mov_description" id="mov_description"></textarea>
							</div>

							<div class="dt-sc-three-sixth column last">

								<input placeholder="Название ролика (не более 30 знаков)" type="text" name="mov_name"
									required>
								<select name="match_id" required>
									<?php
									// Определяем список конкурсов в зависимости от текущей даты
									if(GetContestPermission($date_now) == 1){
										echo "<option value=''>Выберите категорию конкурса</option>";
										echo "<option value='1>Удивительный теннис</option>";
										echo "<option value='2'>Семейный теннис</option>";
									}elseif(GetContestPermission($date_now) == 2){
										echo "<option value=''>Выберите категорию конкурса</option>";
										echo "<option value='3'>Теннисная прокачка</option>";
										echo "<option value='4'>Свой конкурс</option>";	
									}else{
										echo "<option value=''>Выберите категорию конкурса</option>";
										echo "<option value='1'>Удивительный теннис</option>";
										echo "<option value='2'>Семейный теннис</option>";
										echo "<option value='3'>Теннисная прокачка</option>";
										echo "<option value='4'>Свой конкурс</option>";
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
										background-color: #b4b4b4;
										cursor: pointer;
									}
								</style>

								<aside class="widget">
									<div class="widgettitle">
										<h3>Тэги</h3><span></span>
									</div>
									<div class="move_check">
										<?php
										$tags = new Tags($db);
										foreach (($tags->getTags(1,3))[1] as $key => $value){
											echo "<span>";
											echo "<input type='checkbox' id='tags{$key}' name='mov_tags[]' value='{$key}'>";
											echo "<label for='tags'>{$value}</label>";
											echo "</span>";
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
										$equipment = new Tags($db);
										foreach (($equipment->getTags(2,3))[2] as $key => $value){
											echo "<span>";
											echo "<input type='checkbox' id='tags{$key}' name='mov_equipment[]' value='{$key}'>";
											echo "<label for='tags'>{$value}</label>";
											echo "</span>";
										}
										?>
									</div>
								</aside>
							</div>
							<div style="text-align: center;">
								<input type="submit" class="dt-sc-button small" data-hover="Новый ролик"
									value="Отправить на конкурс" id="send_move_btn">
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