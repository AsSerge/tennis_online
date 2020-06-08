<?php
define('N',"\n");
define('NN',"\n\n");
@require($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');
@require($_SERVER['DOCUMENT_ROOT'].'/classes/rates.class.php');

echo '<pre>';

//Создание экземпляра класса
$rate = new Rates($db);

//Голосование за видеоролик - пользователи
$rate->voteUser(61, 1, 2);
echo $rate->errmsg.NN;

$rate->voteUser(61, 1, 3, true);
echo $rate->errmsg.NN;


//Голосование за видеоролик - члены жюри
$rate->voteReferee(3, 1, [
	'unique'		=> 3,	//Уникальность
	'humor'			=> 7,	//Юмор
	'competition'	=> 5,	//Состязательность
	'hardness' 		=> 7,	//Сложность
	'usefulness' 	=> 5	//Полезность
],true);
echo $rate->errmsg.NN;


?>
