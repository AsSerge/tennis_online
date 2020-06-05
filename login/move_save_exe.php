<?php

include ('../layout/site_function.php');
//=================== Обработчик загрузки ролика ===================
$mov_link = $_POST['mov_link'];
// Получаем тип ссылки
$mov_link_type = GetVideoContentType($mov_link); // Тип
$mov_name = ClearPostString($_POST['mov_name']); // Название
$mov_description = ClearPostString($_POST['mov_description']); // Описание
$mov_contest = $_POST['mov_contest']; // Конкурс
$mov_age_cat = $_POST['mov_age_cat']; // Возрастная категория
$mov_tags = $_POST['mov_tags']; // Строка тегов
$mov_equipment = $_POST['mov_equipment']; // Строка оборудования

echo $mov_link."<br>";
echo GetVideoContentType ($mov_link)['type']."<br>";
echo GetVideoContentType ($mov_link)['short_link']."<br>";
echo $mov_name."<br>";
echo $mov_description."<br>";
echo $mov_contest."<br>";
echo $mov_age_cat."<br>";
echo GetCheckBoxString($mov_tags, ";")."<br>";
echo GetCheckBoxString($mov_equipment, ";")."<br>";

?>