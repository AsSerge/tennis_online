<?php
include('login/log_to_base.php');
// Получаем базу челнов жюри
$query = "SELECT * FROM refferies WHERE 1 LIMIT 8";
$my_data = $db->prepare($query);
$my_data->execute();
$jurors = $my_data->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="fullwidth-section">
	<div class="container">
		<h2 class="border-title aligncenter"> <span> Члены Жюри Конкурсов </span></h2>

		<?php
		$idelay = 100; // Настройка появления членов жюри

		foreach ($jurors as $j) {
			echo "<div class='dt-sc-one-fourth column first animate' data-animation='fadeInLeft' data-delay='{$idelay}'>";
			echo "	<div class='dt-sc-team type2'>";
			echo "		<div class='team-thumb'>";
			echo "			<img src='images/players/{$j['reff_main_image']}' alt='{$j['reff_name']} {$j['reff_surname']}' title='{$j['reff_name']} {$j['reff_surname']}'>";
			echo "			<h3><span>{$j['reff_name']}</span> <br><span>{$j['reff_surname']}</span></h3>";
			echo "			<div class='team-detail'>";
			echo "				<h4>Спортсмен</h4>";
			echo "				<ul>";
			echo "					<li><span class='fa fa-calendar'></span> <b>Возраст:</b> {$j['reff_age']} </li>";
			echo "					<li><span class='fa fa-trophy'></span> <b>Титулов:</b> {$j['reff_titles']} </li>";
			echo "					<li><span class='fa fa-trophy'></span> <b>{$j['reff_cup_name']}:</b> {$j['reff_cup_value']} </li>";
			echo "				  <li><span class='fa fa-certificate'></span> <b>Опыт:</b> {$j['reff_experience']} </li>";
			echo "				</ul>";
			echo "			</div>";
			echo "		</div>";
			echo "		<ul class='dt-sc-social-icons'>";
					if ($j['reff_facebook'] != '') echo "<li class='facebook'><a class='fa fa-facebook' href='{$j['reff_facebook']}'></a></li>";
					if ($j['reff_google'] != '')echo "<li class='google'><a class='fa fa-google-plus' href='{$j['reff_google']}'></a></li>";
					if ($j['reff_instagram'] != '')echo "<li class='instagram'><a class='fa fa-instagram' href='{$j['reff_instagram']}'></a></li>";
					if ($j['reff_twitter'] != '')echo "<li class='twitter'><a class='fa fa-twitter' href='{$j['reff_twitter']}'></a></li>";
			echo "		</ul>";
			echo "	</div>";
			echo "</div>";
			$idelay = $idelay + 200; 
		}
		?>
		<a class="dt-sc-button small" href="#" data-hover="Весь список"> Просмотреть </a>
	</div>
</div>