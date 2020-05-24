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
					<div class="container">
						<div class="dt-sc-hr-invisible"></div>
						<section id="primary" class="page-with-sidebar page-with-right-sidebar">
							<h3 class="border-title"> <span> Мои ролики </span></h3>
								<div class="dt-excersise-title title">
									<p class="count"> <a href="#">4 <br>
									<span>мяч</span></a> </p>
									<h5><a href="#">Название ролика не более 30 зн</a></h5>
								</div>
							<div class="dt-sc-workout-detail">
								<div class="dt-sc-hr-invisible-small"></div>
								<div class="dt-sc-one-half column first">
									<div class="dt-excersise-thumb">
										<iframe src="http://player.vimeo.com/video/106579765" height="250"></iframe>
									</div>
								</div>
								<div class="dt-sc-one-half column">
									<div class="dt-excersise-detail">
										<h4><a href="#">Категория: Удивительный теннис</a></h4>
										<h6>Возрастная категория:</h6>
										<p class="dt-excersise-meta"><a href="#"> 12 - 14 лет</a></p>
																				<h6>Тэги:</h6>
										<p class="dt-excersise-meta"><a href="#"> Скорость</a>, <a href="#">Выносливость</a>, <a href="#">Кардио</a></p>
										<h6>Принадлежностиs:</h6>
										<p class="dt-excersise-meta"><a href="#">Скакалка</a>, <a href="#">Стул</a></p>
									</div>
								</div>

								<div class="dt-sc-clear"></div>
								<p>Здесь размещается текст с описанием ролика с объемом не более 200-х знаков... </p>
								<a href="#" class="dt-sc-button small" data-hover="Описание">Редактировать</a>
							</div>

							<div class="dt-sc-hr-invisible"></div>
							<div class="dt-sc-clear"></div>
							<h3 class="border-title"> <span> Просмотренные ролики </span></h3>
							<div class="portfolio-single-slider-wrapper">
								<ul class="portfolio-single-slider">
									<li> <iframe src="http://player.vimeo.com/video/106579765" height="150"></iframe> </li>
									<li> <iframe src="https://player.vimeo.com/video/218734869" height="150"></iframe> </li>
									<li> <iframe src="http://player.vimeo.com/video/106579765" height="150"></iframe> </li>
									<li> <iframe src="https://player.vimeo.com/video/218734869" height="150"></iframe> </li>
								</ul>
								<div id="bx-pager">
								  <a data-slide-index="0" href=""> <img src="http://placehold.it/1170x800&text=Gallery" alt="" title=""> </a>
								  <a data-slide-index="1" href=""> <img src="http://placehold.it/1170x800&text=Gallery" alt="" title=""> </a>
								  <a data-slide-index="2" href=""> <img src="http://placehold.it/1170x800&text=Gallery" alt="" title=""> </a>
								  <a data-slide-index="3" href=""> <img src="http://placehold.it/1170x800&text=Gallery" alt="" title=""> </a>
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
							</div>
						</section>

						<section id="secondary-right" class="secondary-sidebar secondary-has-right-sidebar">
							<aside class="widget">
								<div class="widgettitle">
									<h3>Опубликованные ролики</h3>
									<span></span>
								</div>
								<div class="dt-excersise-title title">
									<p class="count">
										<a href="#">4 <br><span>мяч</span></a>
									</p>
									<h5><a href="#">Название ролика не более 30 зн</a></h5>
								</div>
								<div class="dt-excersise-title title">
									<p class="count">
										<a href="#">10 <br><span>мяч</span></a>
									</p>
									<h5><a href="#">Ролик 2 </a></h5>
								</div>
								<div class="dt-excersise-title title">
									<p class="count">
										<a href="#">12 <br><span>Мяч</span></a>
									</p>
									<h5><a href="#">Ролик 3 </a></h5>
								</div>
								<div class="dt-excersise-title title">
									<p class="count">
										<a href="#">32 <br><span>Мяч</span></a>
									</p>
									<h5><a href="#">Ролик 4</a></h5>
								</div>
								<div class="dt-excersise-title title">
									<p class="count">
										<a href="#">12 <br><span>Мяч</span></a>
									</p>
									<h5><a href="#">Ролик 5 </a></h5>
								</div>
								<a href="private_add_video.php" class="dt-sc-button small" data-hover="Новый ролик">Добавить</a>
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
									<h3 class="section-title3">КНИГА  <br><span>ОРУЖИЕ ЧЕМПИОНА</span></h3>
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
