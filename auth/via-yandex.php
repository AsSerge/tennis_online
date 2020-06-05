<?php

$client_id = '84a52d26bf564f3fb64310c99c8869a5'; // Id приложения
$client_secret = '9f69bb580e48490da7617c930a8ee75f'; // Пароль приложения
$redirect_uri = 'https://mytennis.online/auth/via-yandex.php'; // Callback URI

$url = 'https://oauth.yandex.ru/authorize';

$params = array(
    'response_type' => 'code',
    'client_id'     => $client_id,
    'display'       => 'popup'
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
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code'],
        'client_id'     => $client_id,
        'client_secret' => $client_secret
    );

    $url = 'https://oauth.yandex.ru/token';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);

    $tokenInfo = json_decode($result, true);

    if (isset($tokenInfo['access_token'])) {
        $params = array(
            'format'       => 'json',
            'oauth_token'  => $tokenInfo['access_token']
        );

        $content = file_get_contents('https://login.yandex.ru/info' . '?' . urldecode(http_build_query($params)));
        //echo $content."<br><br>\n\n";
        $userInfo = json_decode($content, true);
        if (isset($userInfo['id'])) {
            $userInfo = $userInfo;
            $result = true;
        }
    }

    if ($result) {
		/*
        echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
        echo "Email: " . $userInfo['default_email'] . '<br />';
        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
        echo "Фамилия пользователя: " . $userInfo['last_name'] . '<br />';
        */
        @require_once($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
        social_network_auth('yandex',array(
			'id'	=> $userInfo['id'],
			'email'	=> $userInfo['default_email'],
			'fname'	=> $userInfo['first_name'],
			'lname'	=> $userInfo['last_name']
        ));
        exit;
    }
}

header('Location: /entry.php');
exit;
?>
