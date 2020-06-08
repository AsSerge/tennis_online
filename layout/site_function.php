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

//Функция установки атрибута "selected" в зависимости от полученной из базы информации
function set_selected($arr, $data_from_base){
	foreach($arr as $key => $value ){
		$select_key = ($value == $data_from_base) ? "selected" : ""; //Тринарный оператор "?"
		// Если нужно значение
		// echo "<option value='".$value."' ".$select_key.">".$value."</option>";
		// Если нужен ключ
		echo "<option value='".$value."' ".$select_key.">".$key."</option>";
	}
}


// Функция очистки сстроки
function ClearPostString($string_to_clean){

	$clear_string = trim($string_to_clean); // Пробелы
	$clear_string = stripslashes($clear_string); // Экранирование
	$clear_string = strip_tags($clear_string); // Теги
	$clear_string = htmlspecialchars($clear_string); // HTML
	$clear_string = trim(preg_replace('/\s\s+/', ' ',str_replace(array('\\','\'','"','union','select','insert','delete'), ' ',$clear_string)));

return $clear_string;	
}

// Функция получения типа ссылки
function GetVideoContentType ($mov_link){	
	if(preg_match('/^https:\/\/vimeo.com\//', $mov_link)){
		$mov['type'] = "vimeo";
		$mov['short_link'] = str_replace("https://vimeo.com/", "", $mov_link);
		$mov['page_place'] = "
		<iframe src='https://player.vimeo.com/video/{$mov['short_link']}' width='640'
			height='360' frameborder='0' allow='autoplay; fullscreen'
			allowfullscreen></iframe>
		";
		return $mov;
	}
	elseif(preg_match('/^https:\/\/www.instagram.com\/p\//' , $mov_link))
	{
		$mov['type'] = "instagram";
		preg_match('/^https:\/\/www.instagram.com\/p\/(\S+\b)(\/)/', $mov_link, $vlink_raw);
			if($vlink_raw[2] == '/'){
				$mov['short_link'] = $vlink_raw[1]; 
			}else{
				$mov['short_link'] = str_replace("https://www.instagram.com/p/", "", $mov_link);
			}
		$mov['page_place'] = "
		<blockquote class='instagram-media' data-instgrm-version='7'>
		<a href='https://www.instagram.com/p/{$mov['short_link']}/media/?size=s'></a>
		</blockquote>
		<script async defer src='//platform.instagram.com/en_US/embeds.js'></script
		";
		return $mov;
	}
	elseif(preg_match('/^https:\/\/youtu.be\//', $mov_link)){
		$mov['type'] = "youtube";
		$mov['short_link'] = str_replace("https://youtu.be/", "", $mov_link);
		$mov['page_place'] = "
		<iframe width='100%' height='350px'src='https://www.youtube.com/embed/{$mov['short_link']}' 
			frameborder='0' 
			allow='accelerometer; 
			autoplay; 
			encrypted-media; 
			gyroscope; 
			picture-in-picture' 
			allowfullscreen>
			</iframe>
		";
		return $mov;
	}
	elseif (preg_match('/^https:\/\/www.youtube.com\/watch\?v=/', $mov_link)){
		$mov['type'] = "youtube";
		$mov['short_link'] = str_replace("https://www.youtube.com/watch?v=", "", $mov_link);
		$mov['page_place'] = "
		<iframe width='100%' height='350px'src='https://www.youtube.com/embed/{$mov['short_link']}' 
			frameborder='0' 
			allow='accelerometer; 
			autoplay; 
			encrypted-media; 
			gyroscope; 
			picture-in-picture' 
			allowfullscreen>
			</iframe>
		";
		return $mov;
	}
	elseif(preg_match('/src="https:\/\/www.youtube.com\/embed\//', $mov_link)){
		$mov['type'] = "youtube";
		preg_match('/(\/embed\/)(\S+\b)/', $mov_link, $vlink_raw);
		$mov['short_link'] = $vlink_raw[2];
		$mov['page_place'] = "
		<iframe width='100%' height='350px'src='https://www.youtube.com/embed/{$mov['short_link']}' 
			frameborder='0' 
			allow='accelerometer; 
			autoplay; 
			encrypted-media; 
			gyroscope; 
			picture-in-picture' 
			allowfullscreen>
			</iframe>
		";
		return $mov;
	}
	elseif(preg_match('/^https:\/\/ok.ru\/video\//', $mov_link)){
		$mov['type'] = "ok";
		$mov['short_link'] = str_replace("https://ok.ru/video", "", $mov_link);
		$mov['page_place'] = "
		<iframe width='100%' height='350'
		src='//ok.ru/videoembed/{$mov['short_link']}'
		frameborder='0'
		allow='autoplay'
		allowfullscreen>
		</iframe>
		";
		return $mov;
	}
	elseif(preg_match('/^https:\/\/www.facebook.com\/\S+\b\/videos/', $mov_link)){
		$mov['type'] = "facebook";
		preg_match('/^https:\/\/www.facebook.com\/(\S+\b)\/videos\/(\S+\b)\//',$mov_link, $vlink_raw);
		$mov['short_link'] = $vlink_raw[1]."/".$vlink_raw[2];
		$mov['page_place'] = "
		<iframe src='https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F{$vlink_raw[1]}%2Fvideos%2F{$vlink_raw[2]}%2F&show_text=0&width=560' 
			width='100%'
			height='350'
			style='border:none;overflow:hidden'
			scrolling='no'
			frameborder='0'
			allowTransparency='true'
			allowFullScreen='true'>
			</iframe>
		";
		return $mov;
	}
	
	elseif(preg_match('/^<iframe src="https:\/\/www.facebook.com\/plugins\/video/', $mov_link)){
		$mov['type'] = "facebook";
		$mov['short_link'] = $mov_link;
		$mov['page_place'] = $mov['short_link'];
		return $mov;
	}
	
	elseif(preg_match('/^<blockquote class="tiktok-embed" cite="https:\/\/www.tiktok.com\//', $mov_link)){
		$mov['type'] = "tiktok";
		$mov['short_link'] = $mov_link;
		$mov['page_place'] = $mov['short_link'];
		return $mov;
	}

	elseif(preg_match('/^<iframe src="\/\/vk.com\/video_ext.php/', $mov_link)){
		$mov['type'] = "vk";
		$mov['short_link'] = $mov_link;
		$mov['page_place'] = $mov['short_link'];
		return $mov;
	}
	elseif(preg_match('/^<blockquote class="twitter-tweet">/', $mov_link)){
		$mov['type'] = "twitter";
		$mov['short_link'] = $mov_link;
		$mov['page_place'] = $mov['short_link'];
		return $mov;
	}
} 
//Работа с изображениями
// $source     = Исходный файл
// $new_file   = Новый файл
// $size       = Необходимый размер
// $img_change = Необходимость в изменениии размера
function quest_image($source, $new_file, $size, $img_change){
	//Получаем размеры исходной картинки
	$size_source_pic = getimagesize($source);
		$p_width = $size_source_pic[0];//Ширина
		$p_height = $size_source_pic[1];//Высота
	// новая ширина (получаем из параметров)
		$width = $size;
	//Определяем коэффициент уменьшения
		$kresize = $width / $p_width;
		$height = round($p_height * $kresize); // новая высота
		$imge_edit_resize = false;
//Если новая высота картинки больше, чем заданная ширина, то ширину картинки уменьшаем с коэффициентом уменьшения.
// Холст создаем квадратный заданный размер + 2px. Фон - белый.
		if($height > $size){
			$height = $size;
			$kresize = $height / $p_height;
			$width = round($p_width * $kresize);
			$imge_edit_resize = true;
		}

	// цвет заливки фона
		$rgb = 0xffffff;
	// создаем холст пропорциональное сжатой картинке + 2px
		if($imge_edit_resize == true OR $img_change == true){
				$img = imagecreatetruecolor($size, $size);
		}else{
				$img = imagecreatetruecolor($width, $height);
		}
	// заливаем холст цветом $rgb
		imagefill($img, 0, 0, $rgb);
	// загружаем исходную картинку
		$photo = imagecreatefromjpeg($source);
	// копируем на холст сжатую картинку с учетом расхождений
	// цель, иссходник, x-результат, y-результат, x-исходного, y-исходного, ширина-результат, высота-результат, ширина-исходного, высота-исходного
	//	imagecopyresampled($img, $photo, 0, 0, 0, 0, $width, $height, $p_width, $p_height);
		if($imge_edit_resize == true){
			imagecopyresampled($img, $photo, ($size - $width)/2, 0, 0, 0, $width, $height, $p_width, $p_height);
		}else if($img_change == true){
			imagecopyresampled($img, $photo, 0, ($size - $height)/2, 0, 0, $width, $height, $p_width, $p_height);
		}else{
			imagecopyresampled($img, $photo, 0, 0, 0, 0, $width, $height, $p_width, $p_height);
		}       
	// сохраняем результат
		imagejpeg($img, $new_file);
	// очищаем память после выполнения скрипта
		imagedestroy($img);
		imagedestroy($photo);
}


?>
