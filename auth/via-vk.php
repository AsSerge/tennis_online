<?php

$client_id = '7498342'; // ID приложения
$client_secret = 'Z7vEPWqZTxE1vQ6KHjHY'; // Защищённый ключ
$redirect_uri = 'https://mytennis.online/auth/via-vk.php'; // Адрес сайта

$url = 'http://oauth.vk.com/authorize';

$params = array(
	'client_id'     => $client_id,
	'redirect_uri'  => $redirect_uri,
	'response_type' => 'code',
	'scope'=>'email',
	'display'=>'page'
);

$link = $url . '?' . urldecode(http_build_query($params));

//Обращение к файлу через require в файле /login/login.php
if(defined('VIA_REDIRECT')){
	header('Location: '.$link);
	exit;
}

if (isset($_GET['code'])) {
    $result = false;
    $params = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri
    );

	$content = @file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params)));
	//echo $content;
    $token = @json_decode($content, true);

    if (isset($token['access_token'])) {
		
		$email = isset($token['email']) ? $token['email'] : '-[Не задан]-';
		
        $params = array(
            'uids'         => $token['user_id'],
            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token'],
            'v'=>'5.107'
        );

		$content = file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params)));
		//echo $content."<br><br>\n\n";

        $userInfo = json_decode($content, true);


        if (isset($userInfo['response'][0]['id'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }

    if ($result) {
		/*
        echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
        echo "E-Mail пользователя: " . $email . '<br />';
        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
        echo "Фамилия пользователя: " . $userInfo['last_name'] . '<br />';
        */
        @require_once($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
        social_network_auth('vk',array(
			'id'	=> $userInfo['id'],
			'email'	=> $email,
			'fname'	=> $userInfo['first_name'],
			'lname'	=> $userInfo['last_name']
        ));
        exit;
    }
}

header('Location: /entry.php');
exit;
?>
