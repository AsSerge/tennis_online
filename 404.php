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
			<div id="main">
			<div id="main-content">
					<section id="primary" class="content-full-width">
						<div class="dt-sc-hr-invisible"></div>
						<div class="dt-sc-hr-invisible"></div>
						<div class="container">
							<div class="error-404 aligncenter">
								<h2 class="flaticon-gymnast35"><span>404 <br><i class="fa fa-times-circle"></i></span></h2>
								<h3>Извините, страница отсуствует</h3>
								<form action="#" class="searchform" id="searchform" method="get" role="search">
									<div>
										<input type="text" id="s" name="s" value="">
										<input type="submit" value="Поиск" id="searchsubmit">
									</div>
								</form>
								<div class="dt-sc-hr-invisible-small"></div>
								<a href="/" class="dt-sc-button medium" data-hover="На главную">Вернуться</a>
							</div>
						</div>
						<div class="dt-sc-hr-invisible-large"></div>
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
