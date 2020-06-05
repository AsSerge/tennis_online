<?php
$via_network = '';
if(isset($_GET['via'])){
	if(in_array(trim($_GET['via']), array('vk','ok','google','facebook','instagram','mailru','yandex'))){
		$via_network = trim($_GET['via']);
	}
	//Соц.сеть найдена
	if(!empty($via_network)){
		define('VIA_REDIRECT', $via_network);
		@require($_SERVER['DOCUMENT_ROOT'].'/auth/via-'.$via_network.'.php');
		exit;
	}
	
}


?>
