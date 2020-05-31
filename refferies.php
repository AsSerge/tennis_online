<?php include('./layout/site_head.php');?>
<?php include('./layout/site_function.php');?>
<?php
include('login/log_to_base.php');
// Список членов жюри
$query = "SELECT reff_id, reff_name, reff_surname FROM refferies WHERE 1";
$my_data = $db->prepare($query);
$my_data->execute();
$jurors_list = $my_data->fetchAll(PDO::FETCH_ASSOC);
$jurors_count = count($jurors_list);

// Получаем информацию по отдельному члену жюри
if(isset($_GET['reff_id'])){
	$reff_id = $_GET['reff_id'];
}else{
	$reff_id = "1";
}
$sql = "SELECT * FROM refferies WHERE reff_id = ?";
$all_data = $db->prepare($sql);
$all_data->execute([$reff_id]);
$juror = $all_data->fetch(PDO::FETCH_ASSOC);
?>
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
				<h1>Члены жюри</h1>
				<div class="breadcrumb">
					<a href="/">Home</a>
					<span class="default"> </span>
					<h4>Члены жюри</h4>
				</div>
			</div>
		</div>
		<!-- breadcrumb ends here -->
		<div id="main">
			<!-- main-content starts here -->
			<div id="main-content">
				<div class="container">
					<div class="dt-sc-hr-invisible"></div>
					<section id="secondary-left" class="secondary-sidebar secondary-has-left-sidebar">

						<aside class="widget widget_categories">
							<div class="widgettitle">
								<h3>Команда Жюри</h3>
							</div>
							<ul>
								<style>
									.jactive {
										font-weight: bold;
									}
								</style>
								<?php
									foreach ($jurors_list as $j) {
										$jactive=($reff_id == $j['reff_id']) ? 'jactive' : ''; // Подстветили активного
										echo "<li class='cat-item {$jactive}'><a title='{$j['reff_name']} {$j['reff_surname']}' href='/refferies.php?reff_id={$j['reff_id']}'>{$j['reff_name']} {$j['reff_surname']}<span> 2</span></a></li>";
									}
									?>
							</ul>
						</aside>
						<?php
							$tags = explode(";", $juror['reff_tags']);
							if(count($tags)>1){
								echo "<aside class='widget widget_tag_cloud'>";
								echo "	<div class='widgettitle'>";
								echo "		<h3>Tags</h3>";
								echo "	</div>";
								echo "	<div class='tagcloud'>";
								foreach($tags as $tag){
									echo "<a title='{$tag}' href='#'>{$tag}</a>";
								}
								echo "	</div>";
								echo "</aside>";
							}
							?>

						<aside class="widget widget_recent_entries">
							<div class="widgettitle">
								<h3>Последние посты</h3>
							</div>
							<ul>
								<li>
									<a href="https://twitter.com/DaniilMedwed/status/1256568143436304384?s=20">Missing
										tennis like........</a>
									<span class="post-date">2 мая, 2020</span>
								</li>
								<li>
									<a href="https://twitter.com/atptour/status/1250701234824077313?s=20#">Remember
										this? At the @ROLEXMCMASTERS in 2019, @DaniilMedwed
										claimed a big win</a>
									<span class="post-date">16 апреля, 2020</span>
								</li>
								<li>
									<a href="https://twitter.com/atptour/status/1248959099343118336?s=20">This is bigger
										than tennis. Ready? P̶l̶a̶y̶.̶ Stay.</a>
									<span class="post-date">11 апреля, 2020</span>
								</li>
								<li>
									<a
										href="https://twitter.com/DaniilMedwed/status/1242877824110931968?s=20">Играем...</a>
									<span class="post-date">25 марта, 2020</span>
								</li>
							</ul>
						</aside>
					</section>
					<section id="primary" class="page-with-sidebar page-with-left-sidebar">
						<div class="portfolio-single">
							<?php
								// Выводим галлерею
								$gal_dir = "./images/players/slider/".$juror['reff_image_dir'];
								$juror_images = get_files_count($gal_dir);
								if(count($juror_images) > 0){
									echo "<div class='portfolio-single-slider-wrapper'>";
									echo "	<ul class='portfolio-single-slider'>";
									foreach($juror_images as $jimage){
										echo "<li> <img src='{$gal_dir}/{$jimage}' alt='' title=''> </li>";
									}
									echo "	</ul>";
									echo "	<div id='bx-pager'>";
									$i=0;
									foreach($juror_images as $jimage){
										echo "<a data-slide-index='{$i}' href='#'> <img src='{$gal_dir}/{$jimage}' alt='' title=''> </a>";
									$i++;
									}
									echo "	</div>";
									echo "</div>";
									echo "<div class='dt-sc-hr-invisible-medium'></div>";
								}
								?>
							<div class="column dt-sc-two-third first">
								<h4 class="border-title">
									<span><?php echo "{$juror['reff_name']} {$juror['reff_surname']}";?></span></h4>
								<?php
									// Описание игрока
									echo $juror['reff_description'];
									?>
								<p class="tags"><span class="fa fa-tag"></span> Титулы:&nbsp;&nbsp;&nbsp;&nbsp;<a
										rel="tag" href="#">Uimbldon</a> </p>
							</div>
							<div class="column dt-sc-one-third">



								<div class="content-box">
										<h5 class="border-title"> <span> Личные данные </span> </h5>
										<?php
										// Подготовка данных
										// Дата рождения
										$reff_birth = mysql_to_date($juror['reff_birth']);
										// Возраст
										$now = new DateTime();
										$date = DateTime::createFromFormat("Y-m-d", $juror['reff_birth']);
										$interval = $now->diff($date);
										$age = $interval->y; // Получаем возраст в годах
										?>
										<ul class="project-details">
											<li><span class="fa fa-user"></span><strong>Статус: </strong><?=$juror['reff_status']?></li>
											<li><span class="fa fa-calendar"></span><strong>Дата рождения: </strong><?php echo "{$reff_birth} ({$age})";?></li>
											<li><span class="fa fa-calendar"></span><strong>Возраст: </strong><?=$age?></li>
											<li><span class="fa fa-user"></span><strong>Рост/ Вес: </strong><?=$juror['reff_height']?> см / <?=$juror['reff_weight']?> кг</li>
											<li><span class="fa fa-rocket"></span><strong>Начало занятий: </strong>c <?=$juror['reff_class_start']?> лет</li>
											<li><span class="fa fa-clock-o"></span><strong>Начало карьеры: </strong><?=$juror['reff_carier_start']?> г.</li>
										</ul>
										<h5 class="border-title"> <span> Достижения </span> </h5>
										<?php
										// Подготовка данных
										// Форматируемяа сумма призовых
										$reff_prize = "$ ".number_format($juror['reff_prize'], 0);
										// Всего титулов в обоих разрядах
										$all_titles = $juror['reff_titles_single'] + $juror['reff_titles_double'];
										?>
										<ul class="project-details">
											<li><span class="fa fa-trophy"></span><strong>Титулов за карьеру: </strong><?=$all_titles?></li>
											<li><span class="fa fa-money"></span><strong>Призовые: </strong><?=$reff_prize?></li>
										</ul>
										<h5 class="border-title"> <span> Одиночный разряд </span> </h5>
										<?php
										// Подготовка данных
										// Определяем ATP или WTA (зависит от пола игрока)
										if($juror['reff_rating_atp_single'] != ''){
											$current_rating = "ATP # {$juror['reff_rating_atp_single']}" ;
										}else{
											$current_rating = "WTA # {$juror['reff_rating_wta_single']}" ;
										}
										// Определяем дату наивысшей позиции и формируем строку
										$reff_high_pos_single_date = mysql_to_date($juror['reff_high_pos_single_date']);
										$high_pos_single = "#&nbsp;".$juror['reff_high_pos_single']." ({$reff_high_pos_single_date})";
										?>
										<ul class="project-details">
											<li><span class="fa fa-line-chart"></span><strong>Текущий рейтинг: </strong><?=$current_rating?></li>
											<li><span class="fa fa-certificate"></span><strong>Наивысшая позиция: </strong><?=$high_pos_single?></li>
											<li><span class="fa fa-trophy"></span><strong>Титулов (single): </strong><?=$juror['reff_titles_single']?></li>
											<li><span class="fa fa-trophy"></span><strong>Win/Lost (single): </strong><?=$juror['reff_wl_single']?></li>
										</ul>
										<h5 class="border-title"> <span> Парный разряд </span> </h5>
										<?php
										// Подготовка данных
										// Определяем ATP или WTA (зависит от пола игрока)
										if($juror['reff_rating_atp_double'] != ''){
											$current_rating_2 = "ATP # {$juror['reff_rating_atp_double']}" ;
										}else{
											$current_rating_2 = "WTA # {$juror['reff_rating_wta_double']}" ;
										}
										// Определяем дату наивысшей позиции и формируем строку
										$reff_high_pos_double_date = mysql_to_date($juror['reff_high_pos_double_date']);
										$high_pos_double = "#&nbsp;".$juror['reff_high_pos_double']." ({$reff_high_pos_double_date})";
										?>
										<ul class="project-details">
											<li><span class="fa fa-line-chart"></span><strong>Текущий рейтинг: </strong><?=$current_rating_2?></li>
											<li><span class="fa fa-certificate"></span><strong>Наивысшая позиция: </strong><?=$high_pos_double?></li>
											<li><span class="fa fa-trophy"></span><strong>Титулов (double): </strong><?=$juror['reff_titles_double']?></li>
											<li><span class="fa fa-trophy"></span><strong>Win/Lost (double): </strong><?=$juror['reff_wl_double']?></li>
										</ul>

										<ul class="project-details">
										<?php
												if ($juror['reff_website'] != '') {echo "<li><span class='fa fa-link'></span><strong>Website: </strong><a href='{$juror['reff_website']}'>{$juror['reff_website']}</a></li>";}
												echo "<li><span class='fa fa-link'></span><strong>Wikipedia: </strong><a href='{$juror['reff_wiki']}' target='_blank'>{$juror['reff_name']} {$juror['reff_surname']}</a></li>";
										?>
										</ul>
										<div class="gallery-share">
										<div class="aligncenter">
											<ul class="dt-sc-social-icons">
												<?php
													if ($juror['reff_facebook'] != '') echo "<li class='facebook'><a class='fa fa-facebook' href='{$juror['reff_facebook']}'></a></li>";
													if ($juror['reff_google'] != '')echo "<li class='google'><a class='fa fa-google-plus' href='{$juror['reff_google']}'></a></li>";
													if ($juror['reff_instagram'] != '')echo "<li class='instagram'><a class='fa fa-instagram' href='{$juror['reff_instagram']}'></a></li>";
													if ($juror['reff_twitter'] != '')echo "<li class='twitter'><a class='fa fa-twitter' href='{$juror['reff_twitter']}'></a></li>";
													if ($juror['reff_vkontakte'] != '')echo "<li class='twitter'><a class='fa fa-vk' href='{$juror['reff_vkontakte']}'></a></li>";
												?>
											</ul>
										</div>
									</div>

									</div>
							</div>
							<!-- <div class="dt-sc-hr-invisible-medium"></div> -->
							<div class="post-nav-container">
								<?php
								// $jurors_list - база членов жюри
								// $jurors_count - всего членов жюри
								// $reff_id - активный член жюри

								// foreach ($jurors_list as $key=>$j) {
								// 	$jur_id[] = $j['reff_id'];
								// 	echo $key;
								// }
								
								// if($reff_id == count($jur_id)){
								// 	echo "<div class='prev-post'><a rel='prev' href='/refferies.php?reff_id=".$jur_id[0]."'><span class='fa fa-angle-left'></span> Предыдущий</a></div>";
								// 	echo "<div class='next-post'><a rel='next' href='/refferies.php?reff_id=".reset($jur_id)."'>Следующий <span class='fa fa-angle-right'></span></a></div>";
								// }
								
								// if($reff_id < $jurors_count and $reff_id != 1){
								// 	$next_link = "/refferies.php?reff_id=".$reff_id+1;
								// 	$prev_link = "/refferies.php?reff_id=".$reff_id-1; 
								// }elseif ($reff_id == $jurors_count) {
								// 	$next_link = "/refferies.php?reff_id=1";
								// 	$prev_link = "/refferies.php?reff_id=".$reff_id-1; # code...
								// }elseif ($reff_id == 1) {
								// 	$next_link = "/refferies.php?reff_id=".$reff_id+1;
								// 	$prev_link = "/refferies.php?reff_id=".$jurors_count; # code...
								// }
								// echo "<div class='prev-post'><a rel='prev' href='#'><span class='fa fa-angle-left'></span> Предыдущий</a></div>";
								// echo "<div class='next-post'><a rel='next' href='#'>Следующий <span class='fa fa-angle-right'></span></a></div>";
								?>
								

							</div>

							<div class="dt-sc-hr-invisible-medium"></div>
							<div class="dt-sc-clear"></div>
							<h2 class="border-title"> <span> Видеотека </span> </h2>
							<div class="portfolio dt-sc-one-half column first">
								<div class="portfolio-thumb">
									<img src="images/event_players/Medvedev_final_USO2019.png" alt="" title="">
									<div class="image-overlay">
										<div class="fig-content-wrapper">
											<div class="fig-overlay">
												<p>
													<iframe width="560" height="315"
														src="https://www.youtube.com/embed/EUg8fcKFXuM" frameborder="0"
														allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
														allowfullscreen></iframe> class="zoom"><span class="fa fa-play">
													</span></a>
													<a href="gallery-detail.html" class="link"> <span
															class="fa fa-link"> </span> </a>
												</p>
											</div>
										</div>
									</div>
								</div>
								<div class="portfolio-detail">
									<div class="portfolio-title">
										<h4><a href="gallery-detail.html">Финал US Open 2019</a></h4>
										<p><a href="#">События</a></p>
									</div>
									<div class="views">
										<span><i class="fa fa-heart-o"></i><br><a href="#" class="likeThis">13
												Likes</a></span>
									</div>
								</div>
							</div>
							<div class="portfolio dt-sc-one-half column">
								<div class="portfolio-thumb">
									<img src="images/event_players/Medvedev_Jokovich_2019.png" alt="" title="">
									<div class="image-overlay">
										<div class="fig-content-wrapper">
											<div class="fig-overlay">
												<p>
													<iframe width="560" height="315"
														src="https://www.youtube.com/embed/FkdrXR42e9E" frameborder="0"
														allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
														allowfullscreen></iframe><span class="fa fa-plus"> </span></a>
													<a href="gallery-detail-with-left-sidebar.html" class="link"> <span
															class="fa fa-link"> </span> </a>
												</p>
											</div>
										</div>
									</div>
								</div>
								<div class="portfolio-detail">
									<div class="portfolio-title">
										<h4><a href="gallery-detail-with-left-sidebar.html">Победа в полуфинале
												Цинцинати.</a></h4>
										<p><a href="#">События</a></p>
									</div>
									<div class="views">
										<span><i class="fa fa-heart-o"></i><br><a href="#" class="likeThis">13
												Likes</a></span>
									</div>
								</div>
							</div>
							<div class="dt-sc-hr-invisible-small"></div>
						</div>
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