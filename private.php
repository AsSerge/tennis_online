<?php
include ('./login/line_check.php');
include ('./layout/site_function.php');
include ('./classes/tags.class.php');

// Получаем список всех роликов пользователя
$sql1 = "SELECT mov_name, mov_id, voteuser_avg  FROM movie WHERE user_id = ?";
$mov_data = $db->prepare($sql1);
$mov_data->execute([$user_id]);
$mov_data_names = $mov_data->fetchAll(PDO::FETCH_ASSOC);

// Получаем максимальное или минимальное значение ID ролика для пользователя
foreach($mov_data_names as $on_id){$k_stat[] = $on_id['mov_id'];}
$start_move = min($k_stat); // Первым выводится первый загруженный ролик
$mov_id = (isset($_GET['mov_id'])) ? $_GET['mov_id'] : $start_move;


$sql = "SELECT * FROM movie 
LEFT JOIN matches ON movie.match_id = matches.match_id
WHERE user_id = {$user_id} AND mov_id = ?";
$all_data = $db->prepare($sql);
$all_data->execute([$mov_id]);
$move = $all_data->fetch(PDO::FETCH_ASSOC);

// Получаем все теги ролика (Теги и оборудование)
$tag = new Tags($db);
$all_tags = $tag->getMovieTags($mov_id, 3);

?>
<?php include('./layout/site_head.php');?>
<!-- Loader starts here -->
<div id="loader-wrapper">
	<div class="loader">
		<!-- <span class="glyph-icon flaticon-man159"></span> -->
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
				<div class="container">
					<div class="dt-sc-hr-invisible"></div>
					<section id="primary" class="page-with-sidebar page-with-right-sidebar">

						<h3 class="border-title"> <span> Мои ролики </span></h3>

						<div class="dt-excersise-title title">
							<p class="count"> <a href="#"><?=$move['voteuser_avg']?><br>
									<span>мяч</span></a> </p>
							<h5><a href="#"><?=$move['mov_name']?></a></h5>
						</div>
						<div class='dt-sc-workout-detail'>
							<style>
								.mov_legend span {
									color: #179ed6;
									text-transform: uppercase;
									font-weight: 400;
								}
							</style>
							<?php
									echo "<div class='first mov_legend'>";
										echo "<center>";
										echo GetVideoContentType($move['mov_link'])['page_place'];
										echo "</center>";
									echo "</div>";
									echo "<div class='dt-sc-hr-invisible-small'></div>";
									echo "<div class='dt-excersise-detail mov_legend'>";
										echo "<p><span>Категория: </span>{$move['name']}</p>";
										echo "<p><span>Возрастная категория: </span>{$move['mov_age_cat']}</p>";
										if(isset($all_tags[1])){
											echo "<p><span>Теги: </span>";
												$one_tag = "";
												foreach($all_tags[1] as $tag){
													$one_tag .= $tag.", ";
												}
												echo rtrim($one_tag, ", "); 
											echo "</p>";
										}if(isset($all_tags[2])){
											echo "<p><span>Принадлежности: </span>";
												$one_tag = "";
											foreach($all_tags[2] as $tag){
												$one_tag .= $tag.", ";
											}
											echo rtrim($one_tag, ", ");
											echo "</p>";
										}
									echo "</div>";
								?>
							<div class='dt-sc-clear'></div>
							<div class="mov_legend">
								<p><span>Описание: </span><?=$move['mov_description']?></p>
								<?php
								if($move['mov_status'] == 1 || $move['mov_status'] == 2){
									echo "<a href='./login/set_status_video_exe.php?mov_id={$mov_id}&act=block' class='dt-sc-button small' data-hover='Ролик'>Заблокировать</a>";
								}elseif($move['mov_status'] == 0){
									echo "<a href='./login/set_status_video_exe.php?mov_id={$mov_id}&act=unblock' class='dt-sc-button small' data-hover='Ролик'>Разблокировать</a>";
								}
								?>
								<a href='/private_edit_video.php?mov_id=<?=$mov_id?>' class='dt-sc-button small' data-hover='Описание'>Редактировать</a>
							</div>
						</div>


						<!-- <div class="dt-sc-hr-invisible"></div>
						<div class="dt-sc-clear"></div>
						<h3 class="border-title"> <span> Просмотренные ролики </span></h3>
						<div class="portfolio-single-slider-wrapper">
							<ul class="portfolio-single-slider">
								<li> <iframe src="https://player.vimeo.com/video/106579765" height="150"></iframe> </li>
								<li> <iframe src="https://player.vimeo.com/video/218734869" height="150"></iframe> </li>
								<li> <iframe src="https://player.vimeo.com/video/106579765" height="150"></iframe> </li>
								<li> <iframe src="https://player.vimeo.com/video/218734869" height="150"></iframe> </li>
							</ul>
							<div id="bx-pager">
								<a data-slide-index="0" href=""> <img src="https://placehold.it/1170x800&text=Gallery"
										alt="" title=""> </a>
								<a data-slide-index="1" href=""> <img src="https://placehold.it/1170x800&text=Gallery"
										alt="" title=""> </a>
								<a data-slide-index="2" href=""> <img src="https://placehold.it/1170x800&text=Gallery"
										alt="" title=""> </a>
								<a data-slide-index="3" href=""> <img src="https://placehold.it/1170x800&text=Gallery"
										alt="" title=""> </a>
							</div>
							<div class="dt-sc-hr-invisible"></div>
							<div class="pagination">
								<div class="prev-post">
									<a href="#"><span class="fa fa-angle-double-left"></span> Назад</a>
								</div>
								<ul class="">
									<li class="active-page">1</li>
									<li><a class="inactive" href="#">2</a></li>
									<li><a class="inactive" href="#">3</a></li>
								</ul>
								<div class="next-post">
									<a href="#">Вперед <span class="fa fa-angle-double-right"></span></a>
								</div>
							</div>
						</div> -->
					</section>







					<section id="secondary-right" class="secondary-sidebar secondary-has-right-sidebar">
						<aside class="widget">
							<div class="widgettitle">
								<h3>Опубликованные ролики</h3>
								<span></span>
							</div>
							<?php
							// echo "<pre>";
							// echo $start_move;
							// print_r($mov_data_names);
							// echo "</pre>";
							
							foreach($mov_data_names as $one_mov){
								echo "<div class='dt-excersise-title title'>";
								echo "<p class='count'>";
								echo "<a href='#'>{$one_mov['voteuser_avg']}<br><span>мяч</span></a>";
								echo "</p>";
								echo "<h5><a href='/private.php?mov_id={$one_mov['mov_id']}'>{$one_mov['mov_name']}</a></h5>";
								echo "</div>";
							}
							?>

							<a href="private_add_video.php" class="dt-sc-button small"
								data-hover="Новый ролик">Добавить</a>
						</aside>
						<aside class="widget quick_links">
							<div class="widgettitle">
								<h3>Быстрые переходы</h3>
								<span></span>
							</div>
							<ul>
								<li><a href="#">Последние ролики</a></li>
								<li><a href="#">Популярные ролики</a></li>
								<li><a href="#">Ролики за сегодня</a></li>
								<li><a href="#">Ролики за неделю</a></li>
							</ul>
						</aside>
						<aside class="widget widget_text">
							<div class="widget-intro-text">
								<h3 class="section-title3">КНИГА <br><span>ОРУЖИЕ ЧЕМПИОНА</span></h3>
								<p><b>Методическое пособие</b> ....здесь короткий текст про гнигу... </p>
								<a href="book.html" class="dt-sc-button medium" data-hover="На сайте">Читать</a>
							</div>
						</aside>
						<aside class="widget widget_text">
							<div class="widgettitle">
								<h3>Категории конкурсов</h3>
								<span></span>
							</div>
							<div class="dt-sc-toggle-frame-set">
								<div class="dt-sc-toggle-frame">
									<h5 class="dt-sc-toggle-accordion active"><a href="#">Удивительный теннис</a></h5>
									<div class="dt-sc-toggle-content">
										<div class="block">
											Здесь размещается короткий текст, напоминающий смсл конкретного конткурса
										</div>
									</div>
								</div>
								<div class="dt-sc-toggle-frame">
									<h5 class="dt-sc-toggle-accordion "><a href="#">Семейный теннис</a></h5>
									<div class="dt-sc-toggle-content">
										<div class="block">
											Здесь размещается короткий текст, напоминающий смсл конкретного конткурса
										</div>
									</div>
								</div>
								<div class="dt-sc-toggle-frame">
									<h5 class="dt-sc-toggle-accordion "><a href="#">Теннисная прокачка</a></h5>
									<div class="dt-sc-toggle-content">
										<div class="block">
											Здесь размещается короткий текст, напоминающий смсл конкретного конткурса
										</div>
									</div>
								</div>
								<div class="dt-sc-toggle-frame">
									<h5 class="dt-sc-toggle-accordion "><a href="#">Свой конкурс</a></h5>
									<div class="dt-sc-toggle-content">
										<div class="block">
											Здесь размещается короткий текст, напоминающий смсл конкретного конткурса
										</div>
									</div>
								</div>
							</div>
						</aside>
					</section>
				</div>
				<div class="dt-sc-hr-invisible-large"></div>
			</div>
			<!-- main-content ends here -->
		</div>
		<!-- footer starts here -->
		<?php include ('./layout/footer.php');?>
		<!-- footer ends here -->
	</div><!-- **Inner Wrapper - End** -->
</div><!-- **Wrapper - End** -->
<?php include('./layout/site_foot.php');?>