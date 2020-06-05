<?php

$client_id = '779284'; // ID
$client_secret = 'cd728ced4f9f5247a84d53f94fa396ad'; // Секретный ключ
$redirect_uri = 'https://mytennis.online/auth/via-mailru.php'; // Ссылка на приложение

$url = 'https://connect.mail.ru/oauth/authorize';

$params = array(
    'client_id'     => $client_id,
    'response_type' => 'code',
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
        'client_id'     => $client_id,
        'client_secret' => $client_secret,
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code'],
        'redirect_uri'  => $redirect_uri
    );

    $url = 'https://connect.mail.ru/oauth/token';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);

	//echo $result."<br><br>\n\n";

    $tokenInfo = json_decode($result, true);

    if (isset($tokenInfo['access_token'])) {
        $sign = md5("app_id={$client_id}method=users.getInfosecure=1session_key={$tokenInfo['access_token']}{$client_secret}");

        $params = array(
            'method'       => 'users.getInfo',
            'secure'       => '1',
            'app_id'       => $client_id,
            'session_key'  => $tokenInfo['access_token'],
            'sig'          => $sign
        );

		$content = file_get_contents('http://www.appsmail.ru/platform/api' . '?' . urldecode(http_build_query($params)));
		//echo $content."<br><br>\n\n";
        $userInfo = json_decode($content, true);
        if (isset($userInfo[0]['uid'])) {
            $userInfo = array_shift($userInfo);
            $result = true;
        }
    }

    if ($result) {
        /*
        echo "Социальный ID пользователя: " . $userInfo['uid'] . '<br />';
        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
        echo "Фамилия пользователя: " . $userInfo['last_name'] . '<br />';
        echo "Email: " . $userInfo['email'] . '<br />';
        */
        @require_once($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
        social_network_auth('mailru',array(
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
