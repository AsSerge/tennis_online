<?php
define('N',"\n");
define('NN',"\n\n");
@require($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');
@require($_SERVER['DOCUMENT_ROOT'].'/classes/tags.class.php');

echo '<pre>';

//Создание экземпляра класса
$tag = new Tags($db);

echo '=================================================================='.N;
echo '$tag->getMovieTags(1,3);'.NN;
print_r($tag->getMovieTags(1,3));


echo NN.'=================================================================='.N;
echo '$tag->getMovieAllTags(1,2);'.NN;
print_r($tag->getMovieAllTags(1,2));


exit;


//Возвращает список тегов определенной группы или все теги, если $group_id = 0, теги отсортированы по полю tag в порядке А..Я
$tag->getTags();


//Добавляет новый тег
echo '=================================================================='.N;
echo 'tag->addTag(): '.NN;
$tag_id = $tag->addTag('test tag',666);
echo 'Added tag with ID = '.$tag_id.NN;


//Проверяем, что тег добавлен
echo 'Tag list: '.NN;
print_r($tag->getTags(666));
echo NN;

//Изменяет тег с существующим ID
echo '=================================================================='.N;
echo 'tag->changeTag(): '.NN;
$tag->changeTag($tag_id,'new tag name');

//Проверяем, что тег изменен
echo 'Tag list: '.NN;
print_r($tag->getTags(666));
echo NN;


//Удаляет тег с существующим ID
echo '=================================================================='.N;
echo 'tag->deleteTag(): '.NN;
$tag->deleteTag($tag_id);

//Проверяем, что тег удален
echo 'Tag list: '.NN;
print_r($tag->getTags(666));
echo NN;

echo N.'=================================================================='.N;
echo 'tag->getTags(output=0): '.NN;
print_r($tag->getTags(0,0));

echo N.'=================================================================='.N;
echo 'tag->getTags(output=1): '.NN;
print_r($tag->getTags(0,1));

echo N.'=================================================================='.N;
echo 'tag->getTags(output=2): '.NN;
print_r($tag->getTags(0,2));

echo N.'=================================================================='.N;
echo 'tag->getTags(output=3): '.NN;
print_r($tag->getTags(0,3));


echo N.'=================================================================='.N;
echo 'tag->addTagToMovie(): '.NN;
$tag->addTagToMovie(1, 4);
$tag->addTagToMovie(1, 5);
$tag->addTagToMovie(1, array(6,7,8,14,15,16));

echo 'tag->getMovieTags(): '.NN;
print_r($tag->getMovieTags(1, 0));

echo N.'=================================================================='.N;
echo 'tag->getTags(output=0): '.NN;
print_r($tag->getMovieTags(1,0));

echo N.'=================================================================='.N;
echo 'tag->getTags(output=1): '.NN;
print_r($tag->getMovieTags(1,1));

echo N.'=================================================================='.N;
echo 'tag->getTags(output=2): '.NN;
print_r($tag->getMovieTags(1,2));

echo N.'=================================================================='.N;
echo 'tag->getTags(output=3): '.NN;
print_r($tag->getMovieTags(1,3));


echo N.'=================================================================='.N;
echo 'tag->removeTagFromMovie(): '.NN;
$tag->removeTagFromMovie(1, 8);
$tag->removeTagFromMovie(1, array(6,7));

echo 'tag->getMovieTags(): '.NN;
print_r($tag->getMovieTags(1,1));


echo N.'=================================================================='.N;
echo 'tag->updateMovieTags(): '.NN;
$tag->updateMovieTags(1,array(1,2,3));

print_r($tag->getMovieTags(1,3));



//Тест для поиска
$tag->updateMovieTags(1,array(1,2,11));
$tag->updateMovieTags(2,array(2,3,9));
$tag->updateMovieTags(3,array(3,4,12));
$tag->updateMovieTags(4,array(1,3,5,15,16));


////////////////////////////////////////////////////////////////////////
//Поиск
////////////////////////////////////////////////////////////////////////

echo N.'=================================================================='.N;
echo 'Search: without any parameters '.NN;
print_r($tag->searchMovies());



echo N.'=================================================================='.N;
echo 'Search: match_id = 2 '.NN;
print_r($tag->searchMovies([
	'match_id'=>2
]));


echo N.'=================================================================='.N;
echo 'Search: tags(1,2) OR '.NN;
print_r($tag->searchMovies([
	'tags'=>array(1,2),
	'type'=>'OR'
]));

echo N.'=================================================================='.N;
echo 'Search: tags(1,2) AND '.NN;
print_r($tag->searchMovies([
	'tags'=>array(1,2),
	'type'=>'AND'
]));


echo N.'=================================================================='.N;
echo 'Search by term: Lorem ipsum & term type AND'.NN;
print_r($tag->searchMovies([
	'tags'=>array(1,2,3),
	'type'=>'OR',
	'term'=>'Lorem ipsum',
	'order' => ['mov_name'=>'ASC'],
	'output'=>1
]));


echo N.'=================================================================='.N;
echo 'Search by term: ipsum movie & term type OR'.NN;
print_r($tag->searchMovies([
	'tags'=>array(1,2,3),
	'type'=>'OR',
	'term'=>'ipsum movie',
	'order' => ['mov_name'=>'ASC'],
	'term_type' => 'OR',
	'output'=>1
]));

echo N.'=================================================================='.N;
echo 'Search by term: ipsum movie & term type AND'.NN;
print_r($tag->searchMovies([
	'tags'=>array(1,2,3),
	'type'=>'OR',
	'term'=>'ipsum movie',
	'order_by' => 'mov_name',
	'term_type' => 'AND',
	'output'=>1
]));

?>
