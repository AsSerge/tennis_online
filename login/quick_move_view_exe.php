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



switch ($mov['type']){
	case "vimeo":
		$video_link = str_replace("https://vimeo.com/", "", $mov_link);
		$video_frame_content = "
		<iframe src='https://player.vimeo.com/video/{$video_link}' width='640'
			height='360' frameborder='0' allow='autoplay; fullscreen'
			allowfullscreen></iframe>";
		break;
	case "instagram":
		preg_match('/^https:\/\/www.instagram.com\/p\/(\S+\b)(\/)/', $mov_link, $vlink_raw);
		if($vlink_raw[2] == '/'){
			$video_link = $vlink_raw[1]; 
		}else{
			$video_link = str_replace("https://www.instagram.com/p/", "", $mov_link);
		}
		$video_frame_content = "
		<blockquote class='instagram-media' data-instgrm-version='7'>
		<a href='https://www.instagram.com/p/{$video_link}/media/?size=s'></a>
		</blockquote>
		<script async defer src='//platform.instagram.com/en_US/embeds.js'></script>";
		break;
	case "youtube":
		// Определение типа YouTube ссылки
		if(preg_match('/^https:\/\/youtu.be\//', $mov_link)){
			$video_link = str_replace("https://youtu.be/", "", $mov_link);
		}elseif (preg_match('/^https:\/\/www.youtube.com\/watch\?v=/', $mov_link)) {
			$video_link = str_replace("https://www.youtube.com/watch?v=", "", $mov_link);
		}elseif(preg_match('/src="https:\/\/www.youtube.com\/embed\//', $mov_link)){
			preg_match('/(\/embed\/)(\S+\b)/', $mov_link, $vlink_raw);
			$video_link = $vlink_raw[2];}
		$video_frame_content = "
		<iframe width='100%' height='350px'src='https://www.youtube.com/embed/{$video_link}' 
			frameborder='0' 
			allow='accelerometer; 
			autoplay; 
			encrypted-media; 
			gyroscope; 
			picture-in-picture' 
			allowfullscreen>
			</iframe>";
		break;
	case "facebook":
		preg_match('/^https:\/\/www.facebook.com\/(\S+\b)\/videos\/(\S+\b)\//',$mov_link, $vlink_raw);
		$video_frame_content = "
		<iframe src='https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F{$vlink_raw[1]}%2Fvideos%2F{$vlink_raw[2]}%2F&show_text=0&width=560' 
			width='560'
			height='315'
			style='border:none;overflow:hidden'
			scrolling='no'
			frameborder='0'
			allowTransparency='true'
			allowFullScreen='true'>
			</iframe>";
		break;
	case "ok":
		$video_link = str_replace("https://ok.ru/video/", "", $mov_link);
		$video_frame_content = "
		<iframe width='560' height='315'
		src='//ok.ru/videoembed/{$video_link}'
		frameborder='0'
		allow='autoplay'
		allowfullscreen>
		</iframe>
		";
		break;
	case "vk":
		$video_link = $mov_link;
		$video_frame_content = $video_link;
		break;
	case "twitter":
			$video_link = $mov_link;
			$video_frame_content = $video_link;
		break;	
	default:
		echo "Видео не загружено".$mov['type'];
}
// Выводим плэйен в окно
echo $video_frame_content;

?>