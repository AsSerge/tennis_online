<?php
include ('../layout/site_function.php');
// Получаем адрес ссылки на ролик, прошедший проверку
$mov_link = $_POST['move'];
// Узнаем тип ролика и короткую ссылку на него. $mov['type'] и $mov['short_link']
$mov = GetVideoContentType($mov_link);

// vimeo:	https://vimeo.com/77270461
// instagramm: https://www.instagram.com/p/CAIm3SDn54v
// youtube:	<iframe>...</iframe>
//			https://youtu.be/gPehzeW22fY
// 			https://www.youtube.com/watch?v=gPehzeW22fY

echo $mov['page_place'];
?>