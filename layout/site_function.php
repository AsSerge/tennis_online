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

// Функция  формирования строки из чекбоксов
function GetCheckBoxString ($string_arr, $seperator){
	$str_out = "";
	if(count($string_arr)>0){
		foreach($string_arr as $str){
			$str_out .= $str.$seperator; 
		}
	}
	return rtrim($str_out, $seperator);
}

// Функция получения типа ссылки
function GetVideoContentType ($mov_link){	
	if(preg_match('/^https:\/\/vimeo.com\//', $mov_link)){
		$mov['type'] = "vimeo";
		$mov['short_link'] = str_replace("https://vimeo.com/", "", $mov_link);
		return $mov;
	}elseif(preg_match('/^https:\/\/www.instagram.com\/p\//' , $mov_link)){
		$mov['type'] = "instagram";
		preg_match('/^https:\/\/www.instagram.com\/p\/(\S+\b)(\/)/', $mov_link, $vlink_raw);
			if($vlink_raw[2] == '/'){
				$mov['short_link'] = $vlink_raw[1]; 
			}else{
				$mov['short_link'] = str_replace("https://www.instagram.com/p/", "", $mov_link);
			}
		return $mov;
	}elseif(preg_match('/^https:\/\/youtu.be\//', $mov_link)){
		$mov['type'] = "youtube";
		$mov['short_link'] = str_replace("https://youtu.be/", "", $mov_link);
		return $mov;
	}elseif(preg_match('/^https:\/\/www.youtube.com\/watch\?v=/', $mov_link)){
		$mov['type'] = "youtube";
		$mov['short_link'] = str_replace("https://www.youtube.com/watch?v=", "", $mov_link);
		return $mov;
	}elseif(preg_match('/src="https:\/\/www.youtube.com\/embed\//', $mov_link)){
		$mov['type'] = "youtube";
		preg_match('/(\/embed\/)(\S+\b)/', $mov_link, $vlink_raw);
		$mov['short_link'] = $vlink_raw[2];
		return $mov;
	}elseif(preg_match('/^https:\/\/ok.ru\/video\//', $mov_link)){
		$mov['type'] = "ok";
		$mov['short_link'] = str_replace("https://ok.ru/video", "", $mov_link);
		return $mov;
	}elseif(preg_match('/^https:\/\/www.facebook.com\/\S+\b\/videos/', $mov_link)){
		$mov['type'] = "facebook";
		preg_match('/^https:\/\/www.facebook.com\/(\S+\b)\/videos\/(\S+\b)\//',$mov_link, $vlink_raw);
		$mov['short_link'] = $vlink_raw[1]."/".$vlink_raw[2];
		return $mov;
	}elseif(preg_match('/^https:\/\/ok.ru\/video\//', $mov_link)){
		$mov['type'] = "ok";
		$mov['short_link'] = str_replace("https://ok.ru/video/", "", $mov_link);
		return $mov;
	}elseif(preg_match('/^<iframe src="\/\/vk.com\/video_ext.php/', $mov_link)){
		$mov['type'] = "vk";
		$mov['short_link'] = $mov_link;
		return $mov;
	}elseif(preg_match('/^<blockquote class="twitter-tweet">/', $mov_link)){
		$mov['type'] = "twitter";
		$mov['short_link'] = $mov_link;
		return $mov;
	}
} 
// Функция очистки сстроки
function ClearPostString($string_to_clean){

	$clear_string = trim($string_to_clean); // Пробелы
	$clear_string = stripslashes($clear_string); // Экранирование
	$clear_string = strip_tags($clear_string); // Теги
	$clear_string = htmlspecialchars($clear_string); // HTML

return $clear_string;	
}

?>