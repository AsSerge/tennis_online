<?php

$client_id = '250791699527138'; // Client ID
$client_secret = '2a08f9c9a63237b2caeeb7c78f1c9696'; // Client secret
$redirect_uri = 'https://mytennis.online/auth/via-facebook.php'; // Redirect URIs

$url = 'https://www.facebook.com/dialog/oauth';

$params = array(
    'client_id'     => $client_id,
    'redirect_uri'  => $redirect_uri,
    'response_type' => 'code',
    'scope'         => 'email'
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
        'redirect_uri'  => $redirect_uri,
        'client_secret' => $client_secret,
        'code'          => $_GET['code']
    );

    $url = 'https://graph.facebook.com/oauth/access_token';

    $tokenInfo = null;
    $content =file_get_contents($url . '?' . http_build_query($params));
    //echo $content."<br>\n\n";
    
    
    $tokenInfo = json_decode($content, true);

    if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
        $params = array(
			'access_token' => $tokenInfo['access_token'],
			'fields'       => 'id,email,first_name,last_name,picture'
		);

		$content = file_get_contents('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params)));
		//echo $content."<br>\n\n";
        $userInfo = json_decode($content, true);

        if (isset($userInfo['id'])) {
            $userInfo = $userInfo;
            $result = true;
        }
    }

    if ($result) {
		/*
        echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
        echo "E-Mail пользователя: " . $userInfo['email'] . '<br />';
        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
        echo "Фамилия пользователя: " . $userInfo['last_name'] . '<br />';
        */
        @require_once($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
        social_network_auth('facebook',array(
			'id'	=> $userInfo['id'],
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
