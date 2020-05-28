<?php include('./layout/site_head.php');?>
<?php
include('login/log_to_base.php');
// Список членов жюри
$query = "SELECT reff_id, reff_name, reff_surname FROM refferies WHERE 1";
$my_data = $db->prepare($query);
$my_data->execute();
$jurors_list = $my_data->fetchAll(PDO::FETCH_ASSOC);

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
						<span class="default">  </span>
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
									<?php
									foreach ($jurors_list as $j) {
										echo "<li class='cat-item'><a title='{$j['reff_name']} {$j['reff_surname']}' href='/refferies.php?reff_id={$j['reff_id']}'>{$j['reff_name']} {$j['reff_surname']}<span> 2</span></a></li>";
									}
									?>
								</ul>
							</aside>
							<aside class="widget widget_tag_cloud">
								<div class="widgettitle">
									<h3>Tags</h3>
								</div>
								<div class="tagcloud">
									<a title="1 topic" href="#">Кубок Кремля</a>
									<a title="1 topic" href="#">Uimbldon</a>
									<a title="1 topic" href="#">Rolan Garros</a>
									<a title="1 topic" href="#">Australian Open</a>
									<a title="1 topic" href="#">USA Open</a>
									<a title="1 topic" href="#">Олимпийские игры</a>
								</div>
							</aside>

							<aside class="widget widget_recent_entries">
								<div class="widgettitle">
									<h3>Последние посты</h3>
								</div>
								<ul>
									<li>
										<a href="https://twitter.com/DaniilMedwed/status/1256568143436304384?s=20">Missing tennis like........</a>
										<span class="post-date">2 мая, 2020</span>
									</li>
									<li>
										<a href="https://twitter.com/atptour/status/1250701234824077313?s=20#">Remember this? At the @ROLEXMCMASTERS in 2019, @DaniilMedwed
 claimed a big win</a>
										<span class="post-date">16 апреля, 2020</span>
									</li>
									<li>
										<a href="https://twitter.com/atptour/status/1248959099343118336?s=20">This is bigger than tennis. Ready? P̶l̶a̶y̶.̶ Stay.</a>
										<span class="post-date">11 апреля, 2020</span>
									</li>
									<li>
										<a href="https://twitter.com/DaniilMedwed/status/1242877824110931968?s=20">Играем...</a>
										<span class="post-date">25 марта, 2020</span>
									</li>
								</ul>
							</aside>
						</section>
						<section id="primary" class="page-with-sidebar page-with-left-sidebar">
							<div class="portfolio-single">
								<div class="portfolio-single-slider-wrapper">
									<ul class="portfolio-single-slider">
										<li> <img src="images/players/photo/medvedev_bg.jpg" alt="" title=""> </li>
										<li> <img src="http://placehold.it/1170x800&text=Gallery" alt="" title=""> </li>
										<li> <img src="http://placehold.it/1170x800&text=Gallery" alt="" title=""> </li>
										<li> <img src="images//portfolio4.jpg" alt="" title=""> </li>
									</ul>
									<div id="bx-pager">
									  <a data-slide-index="0" href=""> <img src="images/players/photo/medvedev_bg.jpg" alt="" title=""> </a>
									  <a data-slide-index="1" href=""> <img src="http://placehold.it/1170x800&text=Gallery" alt="" title=""> </a>
									  <a data-slide-index="2" href=""> <img src="http://placehold.it/1170x800&text=Gallery" alt="" title=""> </a>
									  <a data-slide-index="3" href=""> <img src="http://placehold.it/1170x800&text=Gallery" alt="" title=""> </a>
									</div>
								</div>
								<div class="dt-sc-hr-invisible-medium"></div>
								<div class="column dt-sc-two-third first">
									<h4 class="border-title"> <span><?php echo "{$juror['reff_name']} {$juror['reff_surname']}";?></span></h4>
									<?php
									// Описание игрока
									echo $juror['reff_description'];
									?>
									<p class="tags"><span class="fa fa-tag"></span> Титулы:&nbsp;&nbsp;&nbsp;&nbsp;<a rel="tag" href="#">Uimbldon</a> </p>
								</div>
								<div class="column dt-sc-one-third">
									<div class="content-box">
										<h5 class="border-title"> <span> Детали </span> </h5>
										<ul class="project-details">
											<li><span class="fa fa-user"></span><strong>Статус: </strong><?=$juror['reff_status']?></li>
											<li><span class="fa fa-calendar"></span><strong>Возраст: </strong><?=$juror['reff_age']?></li>
											<li><span class="fa fa-rocket"></span><strong>Начало занятий: </strong>c 3 лет</li>
											<li><span class="fa fa-clock-o"></span><strong>Начало карьеры: </strong>2014</li>
											<li><span class="fa fa-trophy"></span><strong>Титулов: </strong>4</li>
											<li><span class="fa fa-trophy"></span><strong>Win/Lost: </strong>128/103</li>
											<li><span class="fa fa-line-chart"></span><strong>Рейтинг ATP: </strong>#5</li>
											<li><span class="fa fa-certificate"></span><strong>Наивысшая позиция: </strong>#4</li>
											<li><span class="fa fa-link"></span><strong>Website: </strong><a href="#">http://iamdesigning.com</a></li>
										</ul>
										<div class="gallery-share">
											<div class="aligncenter">
												<ul class="dt-sc-social-icons">
												<?php
													if ($juror['reff_facebook'] != '') echo "<li class='facebook'><a class='fa fa-facebook' href='{$juror['reff_facebook']}'></a></li>";
													if ($juror['reff_google'] != '')echo "<li class='google'><a class='fa fa-google-plus' href='{$juror['reff_google']}'></a></li>";
													if ($juror['reff_instagram'] != '')echo "<li class='instagram'><a class='fa fa-instagram' href='{$juror['reff_instagram']}'></a></li>";
													if ($juror['reff_twitter'] != '')echo "<li class='twitter'><a class='fa fa-twitter' href='{$juror['reff_twitter']}'></a></li>";
												?>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="dt-sc-hr-invisible-medium"></div>
								<div class="post-nav-container">
									<div class="prev-post">
										<a rel="prev" href="#"><span class="fa fa-angle-left"></span> Предыдущий</a>
									</div>
									<div class="next-post">
										<a rel="next" href="#">Следующий <span class="fa fa-angle-right"></span></a>
									</div>
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
													  <iframe width="560" height="315" src="https://www.youtube.com/embed/EUg8fcKFXuM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> class="zoom"><span class="fa fa-play"> </span></a>
													  <a href="gallery-detail.html" class="link"> <span class="fa fa-link"> </span> </a>
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
											<span><i class="fa fa-heart-o"></i><br><a href="#" class="likeThis">13 Likes</a></span>
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
													  <iframe width="560" height="315" src="https://www.youtube.com/embed/FkdrXR42e9E" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><span class="fa fa-plus"> </span></a>
													  <a href="gallery-detail-with-left-sidebar.html" class="link"> <span class="fa fa-link"> </span> </a>
												  </p>
												</div>
											</div>
										</div>
									</div>
									<div class="portfolio-detail">
										<div class="portfolio-title">
											<h4><a href="gallery-detail-with-left-sidebar.html">Победа в полуфинале Цинцинати.</a></h4>
											<p><a href="#">События</a></p>
										</div>
										<div class="views">
											<span><i class="fa fa-heart-o"></i><br><a href="#" class="likeThis">13 Likes</a></span>
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
