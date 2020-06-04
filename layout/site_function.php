<?php
//Считаем количество Файлов в каталоге новости и возвращаем массив имен файлов
function get_files_count($dir){
	$dir = opendir($dir);
	$dir_list = array();
	$count = 0;
	while($file = readdir($dir)){
		if($file == '.' || $file == '..' || is_dir($dir . $file)){
			continue;
		}
		$dir_list[] = $file;
		$count++;
		}
	return $dir_list;//Воозвращаем массив с файлами
}
//Преобразуем дату в правильный MySql формат
function date_to_mysql($date){
    $date_tmp = explode(".",$date);
    $dete_new = $date_tmp[2]."-".$date_tmp[1]."-".$date_tmp[0];                
    return $dete_new;
}
function mysql_to_date($date){
    $date_tmp = explode("-",$date);
    $dete_new = $date_tmp[2].".".$date_tmp[1].".".$date_tmp[0];                
    return $dete_new;
}
//Преобразуем MySQL дату в текстовый формат
function mysql_to_date_text($date){
    $date_tmp = explode("-", $date);
    $text_month = array("", "января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря");
    $date_new = (int)$date_tmp[2]." ".$text_month[(int)$date_tmp[1]]." ".$date_tmp[0];//Не забываем переводить строку в число - убираеи ведущий 0                
    return $date_new;
}

// Функция проверки нахождения даты в указанном диапазоне
function GetContestPermission ($date_now){
	// Настраиваем даты активности страницы загрузки роликов
	// 1 и 2 категория конкурса: доступны с 12 по 26 июня;
	// 3 и 4 категория конкурса: доступны с 26 июня по 10 июля.
	$date_1_start = mktime(0, 0 , 0, 6, 12, 2020);
	$date_1_end = mktime(23, 59 ,0 , 6, 26, 2020);
	$date_2_start = mktime(0, 0 ,0 , 6, 26, 2020);
	$date_2_end = mktime(23, 59 ,0 , 7, 10, 2020);
	if($date_now >= $date_1_start && $date_now < $date_1_end){
		// return "1 ".date("d.m.Y G:i");
		return 1;
	}elseif($date_now >= $date_2_start && $date_now < $date_2_end){
		// return "2 ".date("d.m.Y G:i");
		return 2;
	}else{
		// return "0 ".date("d.m.Y G:i");
		return 0;
	}
}


?>