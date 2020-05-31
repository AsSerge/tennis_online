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


?>