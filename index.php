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

			<div id="main">
			   <!-- **Slider Section** -->
			   <?php include ('./layout/mp/mp_slider.php');?>
				<!-- **Slider Section - End** -->
				<!-- icon content starts here -->
				<?php include ('./layout/mp/mp_icon_content.php');?>
				<!-- icon content ends here -->

				<!-- main-content starts here -->
				<div id="main-content">
					<section id="primary" class="content-full-width">
					<!-- <div class="dt-sc-hr-invisible-small"></div> -->
						<!-- Testimonials starts here -->
						<?php include ('./layout/mp/mp_testimonials.php')?>
						<!-- Testimonials ends here -->
						<div class="dt-sc-hr-invisible-normal"></div>
						<div class="dt-sc-hr-invisible-small"></div>

						<!-- ico-content starts here -->
						<?php include ('./layout/mp/mp_ico_content.php');?>
						<!-- ico-content ends here -->
						<div class="dt-sc-hr-invisible-medium"></div>

						<!-- Jury starts here -->
						<?php include ('./layout/mp/mp_jury.php')?>
						<!-- Jury ends here -->
						<div class="dt-sc-hr-invisible-normal"></div>

						<!-- Members activity starts here -->
						<?php include ('./layout/mp/mp_members_activity.php');?>
						<!-- Members activity ends here -->
						<div class="dt-sc-hr-invisible"></div>

						<!-- Competition prizes starts here-->
						<?php include ('./layout/mp/mp_competition_prizes.php');?>
						<!-- Competition prizes ends here-->
						<div class="dt-sc-hr-invisible-medium"></div>
						
						<!-- Prize gallery starts here -->
						<?php include ('./layout/mp/mp_prize_gallery.php')?>
						<!-- Prize gallery ends here -->
						<div class="dt-sc-hr-invisible-large"></div>
						<div class="dt-sc-hr-invisible-normal"></div>

						<!-- Your questions starts here -->
						<?php include ('./layout/mp/mp_your_questions.php');?>
						<!-- Your questions ends here -->
						<div class="dt-sc-hr-invisible-large"></div>

						<!-- Support starts here -->
						<?php include('./layout/mp/mp_support.php');?>
						<!-- Support ends here -->
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
