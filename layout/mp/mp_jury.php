<?php
// База членов жюри конкурсов
$jurors[] = array(
	"image"=>"medvedev3.png",
	"name"=>"Даниил",
	"surname"=>"Медведев",
	"age"=>"24",
	"titles"=>"7",
	"cup_name"=>"Win/Loss",
	"cup_value"=>"139/80",
	"experience"=>"18+ лет",
	"facebook"=>"#",
	"google"=>"#",
	"instagram"=>"#",
	"twitter"=>"#"
);
$jurors[] = array(
	"image"=>"rublev3.png",
	"name"=>"Андрей",
	"surname"=>"Рублев",
	"age"=>"22",
	"titles"=>"4",
	"cup_name"=>"Win/Loss",
	"cup_value"=>"106/82",
	"experience"=>"19+ лет",
	"facebook"=>"#",
	"google"=>"#",
	"instagram"=>"#",
	"twitter"=>"#"
);
$jurors[] = array(
	"image"=>"khachanov2.png",
	"name"=>"Карен",
	"surname"=>"Хачанов",
	"age"=>"23",
	"titles"=>"4",
	"cup_name"=>"Win/Loss",
	"cup_value"=>"128/103",
	"experience"=>"20+ лет",
	"facebook"=>"#",
	"google"=>"#",
	"instagram"=>"#",
	"twitter"=>"#"
);
$jurors[] = array(
	"image"=>"donskoy.png",
	"name"=>"Евгений",
	"surname"=>"Донской",
	"age"=>"30",
	"titles"=>"-",
	"cup_name"=>"ATP Ranking",
	"cup_value"=>"115",
	"experience"=>"23+ лет",
	"facebook"=>"#",
	"google"=>"#",
	"instagram"=>"https://www.instagram.com/edonskoy/",
	"twitter"=>"#"
);
$jurors[] = array(
	"image"=>"kuznetsova.png",
	"name"=>"Светлана",
	"surname"=>"Кузнецова",
	"age"=>"34",
	"titles"=>"34",
	"cup_name"=>"Win/Loss",
	"cup_value"=>"922/471",
	"experience"=>"27+ лет",
	"facebook"=>"#",
	"google"=>"#",
	"instagram"=>"#",
	"twitter"=>"#"
);
$jurors[] = array(
	"image"=>"vesnina.png",
	"name"=>"Елена",
	"surname"=>"Веснина",
	"age"=>"33",
	"titles"=>"21",
	"cup_name"=>"Win/Loss",
	"cup_value"=>"836/555",
	"experience"=>"26+ лет",
	"facebook"=>"#",
	"google"=>"#",
	"instagram"=>"#",
	"twitter"=>"#"
);
$jurors[] = array(
	"image"=>"pavlyuchenkova.png",
	"name"=>"Анастасия",
	"surname"=>"Павлюченкова",
	"age"=>"28",
	"titles"=>"17",
	"cup_name"=>"Win/Loss",
	"cup_value"=>"635/441",
	"experience"=>"22+ лет",
	"facebook"=>"https://www.facebook.com/AnastasiaPavlyuchenkova/",
	"google"=>"#",
	"instagram"=>"https://www.instagram.com/nastia_pav/",
	"twitter"=>"https://twitter.com/NastiaPav"
);
$jurors[] = array(
	"image"=>"makarova.png",
	"name"=>"Екатерина",
	"surname"=>"Макарова",
	"age"=>"31",
	"titles"=>"17",
	"cup_name"=>"Win/Loss",
	"cup_value"=>"812/487",
	"experience"=>"25+ лет",
	"facebook"=>"#",
	"google"=>"#",
	"instagram"=>"#",
	"twitter"=>"#"
);

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
			echo "			<img src='images/players/{$j['image']}' alt='{$j['name']} {$j['surname']}' title='{$j['name']} {$j['surname']}'>";
			echo "			<h3><span>{$j['name']}</span> <br><span>{$j['surname']}</span></h3>";
			echo "			<div class='team-detail'>";
			echo "				<h4>Спортсмен</h4>";
			echo "				<ul>";
			echo "					<li><span class='fa fa-calendar'></span> <b>Возраст:</b> {$j['age']} </li>";
			echo "					<li><span class='fa fa-trophy'></span> <b>Титулов:</b> {$j['titles']} </li>";
			echo "					<li><span class='fa fa-trophy'></span> <b>{$j['cup_name']}:</b> {$j['cup_value']} </li>";
			echo "				  <li><span class='fa fa-certificate'></span> <b>Опыт:</b> {$j['experience']} </li>";
			echo "				</ul>";
			echo "			</div>";
			echo "		</div>";
			echo "		<ul class='dt-sc-social-icons'>";
					if ($j['facebook'] != '#') echo "<li class='facebook'><a class='fa fa-facebook' href='{$j['facebook']}'></a></li>";
					if ($j['google'] != '#')echo "<li class='google'><a class='fa fa-google-plus' href='{$j['google']}'></a></li>";
					if ($j['instagram'] != '#')echo "<li class='instagram'><a class='fa fa-instagram' href='{$j['instagram']}'></a></li>";
					if ($j['twitter'] != '#')echo "<li class='twitter'><a class='fa fa-twitter' href='{$j['twitter']}'></a></li>";
			echo "		</ul>";
			echo "	</div>";
			echo "</div>";
			$idelay = $idelay + 200; 
		}
		?>
		<a class="dt-sc-button small" href="#" data-hover="Весь список"> Просмотреть </a>
	</div>
</div>