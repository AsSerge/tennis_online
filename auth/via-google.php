<?php

$client_id = '576538062035-rfjqmtn1u95u597sp05pak6alhgv786a.apps.googleusercontent.com'; // Client ID
$client_secret = 'TOcIYFyhM5F0hoPUdC-uvXh6'; // Client secret
$redirect_uri = 'https://mytennis.online/auth/via-google.php'; // Redirect URIs

$url = 'https://accounts.google.com/o/oauth2/auth';

$params = array(
    'redirect_uri'  => $redirect_uri,
    'response_type' => 'code',
    'client_id'     => $client_id,
    'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
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
        'redirect_uri'  => $redirect_uri,
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code']
    );

    $url = 'https://accounts.google.com/o/oauth2/token';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $tokenInfo = @json_decode($result, true);

    if (isset($tokenInfo['access_token'])) {
        $params['access_token'] = $tokenInfo['access_token'];

		$content = @file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params)));
		//echo $content."<br><br>\n\n";

        $userInfo = @json_decode($content, true);
        if (isset($userInfo['id'])) {
            $userInfo = $userInfo;
            $result = true;
        }
    }

    if ($result) {
		/*
        echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
        echo "Имя пользователя: " . $userInfo['given_name'] . '<br />';
        echo "Фамилия пользователя: " . $userInfo['family_name'] . '<br />';
        echo "Email: " . $userInfo['email'] . '<br />';
        */
        @require_once($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
        social_network_auth('google',array(
			'id'	=> $userInfo['id'],
			'email'	=> $userInfo['email'],
			'fname'	=> $userInfo['given_name'],
			'lname'	=> $userInfo['family_name']
        ));
        exit;
    }

}

header('Location: /entry.php');
exit;
?>
