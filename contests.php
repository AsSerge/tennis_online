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
					<h1>Конкурсы</h1>
					<div class="breadcrumb">
						<a href="index.html">Home</a>
						<span class="default">  </span>
						<h4>Конкурсы</h4>
					</div>
				</div>
			</div>
			<!-- breadcrumb ends here -->
			<div id="main">
				<!-- main-content starts here -->
				<!-- main-content starts here -->
				<div id="main-content">
					<section id="primary" class="content-full-width">
						<div class="dt-sc-hr-invisible medium"></div>
						<div class="container">
							<div class="welcome-txt">
								<h3>Федерация Тенниса России приглашает Вас поучаствовать в конкурсах, которые помогут Вам творчески относиться к тренировочному процессу!</h3>
								<h6>Участвовать в конкурсах очень просто - выберите интересную для Вас категорию, снимите ролик, разместите его в своей социальной сети.</h6>
								<h6>- Вы уже умеете это делать и у Вас есть такие ролики? Тогда Вам остается просто скопировать ссылку и вставить её в специальном поле формы добавления ролика<br> в Личном кабинете этого сайта, нажать на кнопку и Вы уже участник!</h6>
								<a class="dt-sc-button medium" href="rules.html" data-hover="конкурса">Правила</a>
								<a class="dt-sc-button medium" href="register.php" data-hover="для участия">Регистрация</a>
								<div class="dt-sc-hr-invisible-small"></div>
							</div>
							<div class="dt-sc-hr-border"></div>
								<div class="dt-sc-hr-invisible-small"></div>
									<section id="secondary-left" class="secondary-sidebar secondary-has-left-sidebar">
										<aside class="widget widget_categories">
												<div class="widgettitle">
													<h3>Механика Конкурсов</h3>
												</div>
												<ul>
													<li class="cat-item"><a title="Удиви всех уникальными способностями." href="#">Общее описание</a></li>
													<li class="cat-item"><a title="Удиви всех уникальными способностями." href="#">Как участвовать?</a></li>
													<li class="cat-item"><a title="Удиви всех уникальными способностями." href="#">Сроки проведения</a></li>
													<li class="cat-item"><a title="Удиви всех уникальными способностями." href="#">Критерии выбора Победителя</a></li>
													<li class="cat-item"><a title="Удиви всех уникальными способностями." href="#">Вручение Призов</a></li>
												</ul>
										</aside>

										<aside class="widget widget_categories">
											<div class="widgettitle">
												<h3>Категории Конкурсов</h3>
											</div>
											<ul>
												<li class="cat-item"><a title="Удиви всех уникальными способностями." href="contests.php?co=1#co_head">Удивительный теннис<span> 1</span></a></li>
												<li class="cat-item"><a title="Вовлекай своих родных в тренировки дома." href="contests.php?co=2#co_head">Семейный теннис<span> 1</span></a></li>
												<li class="cat-item"><a title="Максимальная эффективность за минимальное время." href="contests.php?co=3#co_head">Теннисная прокачка<span> 1</span></a></li>
												<li class="cat-item"><a title="Создай свой конкурс и запусти вместе с ФТР!" href="contests.php?co=4#co_head">Свой конкурс<span> 2</span></a></li>
											</ul>
										</aside>

										<aside class="widget widget_links">
											<div class="widgettitle">
												<h3>Партнеры Конкурсов</h3>
											</div>
											<div class="menu-item-widget-area-container">
												<div class="textwidget">
													<ul>
														<li> <a href="https://www.forward-sport.ru/" title="Интернет-магазин компании Форвард - российского производителя спортивной одежды">Компания Форвард </a> </li>
														<li> <a href="https://babolat-shop.ru/" title="Официальный bнтернет-магазин компании BABOLAT">Компания BABOLAT </a> </li>
													</ul>
												</div>
											</div>
										</aside>
									</section>
									<div id="co_head"></div>
									<section id="primary" class="page-with-sidebar page-with-left-sidebar">
									<div class="portfolio-single">
										<?php 
											$co = $_GET['co'];
											switch ($co) {
												case '':
													include('./layout/co/co_0.php');
													break;
												case '1':
													include('./layout/co/co_1.php');
													break;
												case '2':
													include('./layout/co/co_2.php');
													break;
												case '3':
													include('./layout/co/co_3.php');
													break;
												case '4':
													include('./layout/co/co_4.php');
													break;	
												default:
													include('./layout/co/co_0.php');
													break;
											}
										?>
									</div>
									</section>
						</div>
						<!-- support starts here -->
						<div class="dt-sc-hr-invisible-large"></div>
					</section>
				</div>
				<!-- main-content ends here -->

				<!-- main-content ends here -->
			</div>
			<!-- footer starts here -->
			<?php include ('./layout/footer.php');?>
			<!-- footer ends here -->
	</div><!-- **Inner Wrapper - End** -->
</div><!-- **Wrapper - End** -->
<?php include('./layout/site_foot.php');?>
