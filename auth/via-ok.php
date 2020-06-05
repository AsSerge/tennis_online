<?php

$client_id = '512000590447'; // Application ID
$public_key = 'CQGDAOJGDIHBABABA'; // Публичный ключ приложения
$client_secret = '8B8E47E0B5809A48D8DE0CD5'; // Секретный ключ приложения
$redirect_uri = 'https://mytennis.online/auth/via-ok.php'; // Ссылка на приложение

$url = 'http://www.odnoklassniki.ru/oauth/authorize';

$params = array(
    'client_id'     => $client_id,
    'response_type' => 'code',
    'scope'			=> 'GET_EMAIL',
    'redirect_uri'  => $redirect_uri
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
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code',
        'client_id' => $client_id,
        'scope'=>'GET_EMAIL',
        'client_secret' => $client_secret
    );

    $url = 'http://api.odnoklassniki.ru/oauth/token.do';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
	//echo $result."<br>\n\n";
    $tokenInfo = json_decode($result, true);

    if (isset($tokenInfo['access_token']) && isset($public_key)) {
        $sign = md5("application_key={$public_key}format=jsonmethod=users.getCurrentUser" . md5("{$tokenInfo['access_token']}{$client_secret}"));

        $params = array(
            'method'          => 'users.getCurrentUser',
            'access_token'    => $tokenInfo['access_token'],
            'application_key' => $public_key,
            'format'          => 'json',
            'sig'             => $sign
        );

		$content = file_get_contents('http://api.odnoklassniki.ru/fb.do' . '?' . urldecode(http_build_query($params)));
		//echo $content."<br>\n\n";
        $userInfo = json_decode($content, true);
        if (isset($userInfo['uid'])) {
            $result = true;
        }
    }

    if ($result) {
		/*
        echo "Социальный ID пользователя: " . $userInfo['uid'] . '<br />';
        echo "Email: " . $userInfo['email'] . '<br />';
        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
        echo "Фамилия пользователя: " . $userInfo['last_name'] . '<br />';
        */
        @require_once($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
        social_network_auth('ok',array(
			'id'	=> $userInfo['uid'],
			'email'	=> $userInfo['email'],
			'fname'	=> $userInfo['first_name'],
			'lname'	=> $userInfo['last_name']
        ));
        exit;
    }
}

header('Location: /entry.php');
exit;
?>
