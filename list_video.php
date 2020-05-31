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
					<h1>Конкурсные ролики</h1>
					<div class="breadcrumb">
						<a href="index.html">Home</a>
						<span class="default">  </span>
						<h4>Ролики</h4>
					</div>
				</div>
			</div>
			<!-- breadcrumb ends here -->
			<div id="main">
				<!-- main-content starts here -->
				<div id="main-content">
					<div class="container">
						<div class="dt-sc-hr-invisible"></div>
							<div class="dt-sc-sorting-container">
									<a class="first active-sort" data-filter="*" href="#">Все</a>
									<a data-filter=".agility" href="#">Скорость</a>
									<a data-filter=".coordination" href="#">Координация</a>
									<a data-filter=".concentration" href="#">Концентрация</a>
									<a data-filter=".flexibility" href="#">Гибкость</a>
									<a data-filter=".endurance" href="#">Выносливость</a>
									<a data-filter=".cardio" href="#">Кардио</a>
							</div>
						<div class="dt-sc-hr-invisible"></div>
						<section id="secondary-left" class="secondary-sidebar secondary-has-both-sidebar">
							<aside class="widget widget_archive">
									<div class="widgettitle">
										<h3>Быстрые переходы</h3>
											<span></span>
									</div>
									<ul>
										<li><a href="#">За сегодня<span> 5</span></a></li>
										<li><a href="#">За неделю<span> 15</span></a></li>
										<li><a href="#">ТОП-5 лучших</a></li>
										<li><a href="#">ТОП-20 лучших</a></li>
										<li><a href="#">ТОП-50 лучших</a></li>
									</ul>
							</aside>
							<aside class="widget widget_popular_entries">
								<div class="widgettitle">
									<h3>Последний ролик</h3>
										<span></span>
								</div>
								<div class="recent-gallery-widget">
										<ul>
												<li>
													<article class="blog-entry format-link">
															<div class="blog-entry-inner">
																	<div class="entry-title">
																		<h4><a href="#">Качка - прокачка</a></h4>
																		<div class="entry-metadata">
																				<p class="tags"> Автор: <a href="#"> М. Николай</a></p>
																		</div>
																	</div>
																	<div class="dt-excersise-thumb">
																			<iframe src="http://player.vimeo.com/video/106579765" height="120"></iframe>
																	</div>
															</div>
													</article>
												</li>
										</ul>
								</div>
							</aside>

							<aside class="widget widget_popular_entries">
										<div class="widgettitle">
											<h3>Самый популярный</h3>
												<span></span>
										</div>
										<div class="recent-gallery-widget">
												<ul>
														<li>
															<article class="blog-entry format-link">
																	<div class="blog-entry-inner">
																			<div class="entry-title">
																					<h4><a href="#">Качка - прокачка</a></h4>
																					<div class="entry-metadata">
																							<p class="tags"> Автор: <a href="#"> М. Николай</a></p>
																					</div>
																			</div>
																			<div class="dt-excersise-thumb">
																					<iframe src="http://player.vimeo.com/video/106579765" height="120"></iframe>
																			</div>
																	</div>
															</article>
														</li>
												</ul>
										</div>
							</aside>

						</section>

						<section id="primary" class="page-with-sidebar page-with-both-sidebar">
							<div class="tpl-blog-holder apply-isotope">
								<div class="dt-sc-one-column column">
									<article class="blog-entry format-gallery">
												<div class="dt-excersises type2">
														<div class="dt-excersise-thumb">
																<iframe src="https://player.vimeo.com/video/218734869" height="430"></iframe>
														</div>
														<div class="dt-excersise-detail">
																<div class="dt-excersise-title">
																	<h5><a href="#">Скалка - Скакалка</a></h5> <br>
																		<p class="count">
																				<a href="#">27 <br><span>об/сек</span></a>
																		</p>
																		<h6>Категория конкурса:</h6>
																		<p class="dt-excersise-meta"><a href="#">Теннисная прокачка</a></p>
																		<a class="dt-sc-button small" href="#" data-hover="За ролик">Проголосовать</a>
																		<a class="dt-sc-button small" href="#" data-hover="На нарушение">Пожаловаться</a>
																		<a class="dt-sc-button small" href="#" data-hover="Ссылку">Копировать</a>
																</div>
																<div class="dt-excersise-content">
																		<h6>Возрастная категория:</h6>
																		<p class="dt-excersise-meta"><a href="#">12 - 14 лет</a>
																		<h6>Тэги:</h6>
																		<p class="dt-excersise-meta"><a href="#">Скорость</a>, <a href="#">Выносливость</a>, <a href="#">Кардио</a></p>
																		<h6>Принадлежности:</h6>
																		<p class="dt-excersise-meta"><a href="#">Скакалка</a>, <a href="#">Стул</a></p>
																		<p class="dt-excersise-meta"> Здесь должно быть короткое описание ролика объемом не более 200 символов, в котором автор "продает" идею и полезность ролика.</p>
																</div>
														</div>
												</div>
									</article>
								</div>
							</div>
							<div class="pagination">
								<div class="prev-post">
									<a href="#"><span class="fa fa-angle-double-left"></span> Предыдущая</a>
								</div>
								<ul class="">
									<li class="active-page">1</li>
									<li><a class="inactive" href="#">2</a></li>
								</ul>
								<div class="next-post">
									<a href="#">Следующая <span class="fa fa-angle-double-right"></span></a>
								</div>
							</div>

						</section>

						<section id="secondary-right" class="secondary-sidebar secondary-has-both-sidebar">

							<aside class="widget widget_search">
								<div class="widgettitle">
									<h3>Поиск</h3>
										<span></span>
								</div>
								<form action="#" id="searchform" method="get">
										<input type="text" placeholder="Введите слово" class="text_input" value="" name="s" id="s">
										<input type="submit" value="submit" name="submit" class="dt-sc-button small">
								</form>
							</aside>
							<aside class="widget widget_categories">
								<div class="widgettitle">
									<h3>Категории конкурсов</h3>
										<span></span>
								</div>
								<ul>
									<li class="cat-item"><a title="#" href="#">Удивительный теннис<span> 2</span></a></li>
									<li class="cat-item"><a title="#" href="#">Семейный теннис<span> 3</span></a></li>
									<li class="cat-item"><a title="#" href="#">Теннисная прокачка<span> 2</span></a></li>
									<li class="cat-item"><a title="#" href="#">Свой конкурс<span> 3</span></a></li>
								</ul>
							</aside>
							<aside class="widget widget_tag_cloud">
								<div class="widgettitle">
									<h3>Принадлежности</h3>
										<span></span>
								</div>
								<div class="tagcloud">
										<a title="1 topic" href="#">Скакалка</a>
										<a title="1 topic" href="#">Гантели</a>
										<a title="1 topic" href="#">Коврик</a>
										<a title="1 topic" href="#">Скамейка</a>
										<a title="1 topic" href="#">Стул</a>
										<a title="1 topic" href="#">Ракетка</a>
										<a title="1 topic" href="#">Мяч</a>
								</div>
							</aside>
							<aside class="widget widget_social_profile">
								<div class="widgettitle">
									<h3>Социальные сети</h3>
										<span></span>
								</div>
								<ul class="dt-sc-social-icons">
										<li class="facebook"><a href="#" class="fa fa-facebook"></a></li>
										<li class="twitter"><a href="#" class="fa fa-twitter"></a></li>
										<li class="flickr"><a href="#" class="fa fa-flickr"></a></li>
										<li class="youtube"><a href="#" class="fa fa-youtube"></a></li>
								</ul>
							</aside>

							<aside class="widget widget_tag_cloud">
								<div class="widgettitle">
									<h3>Tags</h3>
									<span></span>
								</div>
								<div class="tagcloud">
									<a title="1 topic" href="#">Diet</a>
									<a title="1 topic" href="#">Workout</a>
									<a title="1 topic" href="#">Flexibility</a>
									<a title="1 topic" href="#">Games</a>
									<a title="1 topic" href="#">Quickness</a>
								</div>
							</aside>

						</section>
						<!-- welcome-txt ends here -->
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
