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

?>