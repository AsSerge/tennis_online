<?php
define('ENTRY_REDIRECT_DISABLE',true);
require($_SERVER['DOCUMENT_ROOT'].'/login/line_check.php');
require($_SERVER['DOCUMENT_ROOT'].'/classes/tags.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/classes/vote.class.php');

$style_selected = 'style="background-color:#179ed6;color:#fff;"';

$HREFQUERY = '?';

$dtoday = date('Y-m-d');
$dweek = date('Y-m-d', (time()-86400*7));

//Доступные конкурсы
$MATCHLAYOUT = '';
$mselected=0;
$mcount = 0;
$match_id = !empty($_GET['match_id']) ? intval($_GET['match_id']) : 0;
$stmt = $db->query('SELECT M.`match_id`,M.`name`,(SELECT count(*) FROM `movie` WHERE `match_id`=M.`match_id` AND `begin_date`>="'.$dtoday.'") as `count` FROM `matches` as M WHERE `status`>0 ORDER BY `match_id` ASC');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	if($match_id==$row['match_id']) $mselected = $row['match_id'];
	$MATCHLAYOUT.='<li class="cat-item"><a title="#" '.($match_id==$row['match_id'] ? $style_selected : '').' href="?match_id='.$row['match_id'].'">'.$row['name'].'<span> '.$row['count'].'</span></a></li>';
	$mcount += $row['count'];
}
$MATCHLAYOUT = '<li class="cat-item"><a title="#" '.($mselected==0 ? $style_selected : '').' href="?match_id=0">Все конкурсы</a></li>'.$MATCHLAYOUT;
if($mselected>0) $HREFQUERY = '?match_id='.$mselected.'&';


//Статистика
$stmt = $db->query('SELECT (SELECT count(*) FROM `movie` WHERE `mov_added`="'.$dtoday.'" AND `mov_status`>1) as `today`, (SELECT count(*) FROM `movie` WHERE `mov_added` BETWEEN "'.$dweek.'" AND "'.$dtoday.'" AND `mov_status`>1) as `week`');
$STATS = $stmt->fetch(PDO::FETCH_ASSOC);
if(empty($STATS))$STATS=['today'=>0,'week'=>0];

//Фльтры
$filters=[
	'fields'=>['mov_id','mov_name','mov_added','voteuser_points', 'mov_description'],
	'order'=>[],
	'status'=>1
];

$tags = new Tags($db);
$vote = new Vote($db);

//Ролики за период
if(!empty($_GET['period'])){
	switch($_GET['period']){
		case 'today': 
			$filters['date_begin'] = $dtoday;
			$filters['date_end'] = $dtoday;
		break;
		case 'week': 
			$filters['date_end'] = $dtoday;
			$filters['date_begin'] = $dweek;
		break;
	}
}

//Топ роликов
if(!empty($_GET['order'])){
	switch($_GET['order']){
		case 'latest':
			$filters['order']['mov_id']='DESC';
			$filters['order']['mov_added']='DESC';
		break;
		case 'top':
			$filters['order']['voteuser_points']='DESC';
		break;
		case 'alphabet':
			$filters['order']['mov_name']='ASC';
		break;
	}

}

//Поиск по названию
if(!empty($_GET['term'])){
	$term = trim(preg_replace('/\s\s+/', ' ',str_replace(array('\\','+','*','?','[',']','^','(',')','{','}','=','!','<','>','|',':','-','\'','"','union','select','insert','delete'), ' ',strtolower($_GET['term']))));
	$filters['term'] = $term;
}

//Соревнование
if(!empty($_GET['match_id'])){
	$filters['match_id'] = intval($_GET['match_id']);
}


$tarr=[];
if(!empty($_GET['tag'])){
	$tarr = is_array($_GET['tag']) ? array_map('intval',$_GET['tag']) : [intval($_GET['tag'])];
	$filters['tags'] = $tarr;
	$filters['type'] = 'AND';
}

$t1selected=0;
$tdata = $tags->getTags(0,3);	//Все теги по группам
$TAGLAYOUT1='';
foreach($tdata[1] as $id=>$tag){
	$tina = in_array($id,$tarr);
	if($tina) $t1selected = $id;
	$TAGLAYOUT1.='<a '.($tina?'class="active-sort"':'').' '.($tina?$style_selected:'').' data-name="tag" data-value="'.$id.'" href="'.$HREFQUERY.'tag[]='.$id.'">'.$tag.'</a>';
}
$TAGLAYOUT1 = '<a class="first '.($t1selected==0?'active-sort':'').'" '.($t1selected==0?$style_selected:'').' data-name="tag" data-value="0" href="'.$HREFQUERY.'">Все</a>'.$TAGLAYOUT1;

$TAGLAYOUT2 = '';
foreach($tdata[2] as $id=>$tag){
	$tina = in_array($id,$tarr);
	$TAGLAYOUT2.='<a '.($tina?$style_selected:'').' data-name="tag" data-value="'.$id.'" href="'.$HREFQUERY.($t1selected>0?'tag[]='.$t1selected.'&':'').'tag[]='.$id.'">'.$tag.'</a>';
}

//Выборка роликов по заданным критериям поиска
$MOVIES = $tags->searchMovies($filters);

/*
//Последний ролик
$LAST_MOVIE = $tags->searchMovies([
	'limit'	=> 1,
	'order'	=> ['mov_id' => 'DESC']
]);

//Top ролик
$TOP_MOVIE = $tags->searchMovies([
	'limit'	=> 1,
	'order'	=> ['voteuser_points' => 'DESC']
]);
*/

include('./layout/site_head.php');

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
<div id="active_video"></div>
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
					<span class="default"> </span>
					<h4>Ролики</h4>
				</div>
			</div>
		</div>
		<!-- breadcrumb ends here -->
		<div id="main">		
			<!-- main-content starts here -->
			<div id="main-content">
				<div class="container">

					<!--div class="dt-sc-hr-invisible"></div>
							<div class="dt-sc-sorting-container">
									<?=$TAGLAYOUT1;?>
							</div>
						<div class="dt-sc-hr-invisible"></div-->

					<section id="secondary-left" class="secondary-sidebar secondary-has-both-sidebar">
						<aside class="widget widget_archive">
							<div class="widgettitle">
								<h3>Быстрые переходы</h3>
							</div>
							<ul>
								<li><a data-name="order" data-value="latest" href="?order=latest">Последние ролики</a>
								</li>
								<li><a data-name="order" data-value="latest" href="?order=top">Лучшие ролики</a></li>
								<li><a data-name="period" data-value="today" href="?period=today">За сегодня<span>
											<?=$STATS['today'];?></span></a></li>
								<li><a data-name="period" data-value="week" href="?period=week">За неделю<span>
											<?=$STATS['week'];?></span></a></li>
							</ul>
						</aside>

						<aside class="widget widget_search">
							<div class="widgettitle">
								<h3>Поиск</h3>
							</div>
							<form action="#" id="searchform" method="get">
								<input type="text" placeholder="Введите слово" class="text_input" value="<?=$term;?>"
									name="term" id="term">
								<input type="submit" class="dt-sc-button small">
							</form>
						</aside>

						<aside class="widget widget_categories">
							<div class="widgettitle">
								<h3>Конкурсы</h3>
							</div>
							<ul>
								<?=$MATCHLAYOUT;?>
							</ul>
						</aside>
						<aside class="widget widget_tag_cloud">
							<div class="widgettitle">
								<h3>Теги</h3>
								<span></span>
							</div>
							<div class="tagcloud">
								<?=$TAGLAYOUT1;?>
							</div>
						</aside>
						<aside class="widget widget_tag_cloud">
							<div class="widgettitle">
								<h3>Принадлежности</h3>
								<span></span>
							</div>
							<div class="tagcloud">
								<?=$TAGLAYOUT2;?>
							</div>
						</aside>
					</section>
					
					<style>
						.my_count {
							position: relative;
							top: 7px;
							left: 7px;
							width: 50px;
							height: 50px;
							border: 2px solid rgb(255, 255, 255);
							border-radius: 50px;
							background-color: #179dd6bb;
							font-size: 1rem;
							font-weight: bold;
							line-height: 3rem;
							color: white;
						}
						.st_height{
							/* height:500px; */
						}
					</style>

					
					<section id="primary" class="page-with-sidebar page-with-left-sidebar">
						
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
																		<p class="dt-excersise-meta">Возрастная категория: <a href="#">12 - 14 лет</a>
																		<p class="dt-excersise-meta">Тэги: <a href="#">Скорость</a>, <a href="#">Выносливость</a>, <a href="#">Кардио</a></p>
																		<p class="dt-excersise-meta">Принадлежности: <a href="#">Скакалка</a>, <a href="#">Стул</a></p>
																		<p class="dt-excersise-meta"> Здесь должно быть короткое описание ролика объемом не более 200 символов, в котором автор "продает" идею и полезность ролика.</p>
																</div>
														</div>
												</div>
									</article>
								</div>
							</div>
						
						
						<div class="dt-sc-hr-invisible-small"></div>
						<div class="portfolio-single">
							<!-- <pre style="display:block;width:100%;height:100%;overflow:both;">
							<?=print_r($MOVIES);?>
							</pre> -->
							<?php
							foreach($MOVIES as $move){
							echo "<div class='dt-sc-one-half column'>";
							echo "	<article class='blog-entry format-link st_height'>";
							echo "		<div class='blog-entry-inner'>";
							echo "			<div class='entry-title'>";
							echo "				<h4><a href='#active_video'>{$move['mov_name']}</a></h4>";
							echo "				<div class='entry-metadata'>";
							echo "					<p class='tags'>Удивительный теннис</p>";
							echo "				</div>";
							echo "			</div>";
							echo "			<div class='entry-thumb'>";
							echo "				<a href='#''>";
							echo "					<img title='' alt='' src='/images/move_cover/mov_{$move['mov_id']}.jpg'>";
							echo "					<div class='blog-overlay'></div>";
							echo "				</a>";
							echo "				<div class='entry-meta'><p class='my_count'>{$move['voteuser_points']}</p></div>";
							echo "			</div>";
							echo "			<div class='entry-body'>";
							echo "				<p>{$move['mov_description']}</p>";
							echo "			</div>";
							echo "			<div class='entry-body'>";
							echo "				<a href = '#active_video' class = 'sm'>Посмотреть</a>";
							echo "			</div>";
							echo "		</div>";
							echo "	</article>";
							echo "</div>";
							}
							?>


						</div>

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