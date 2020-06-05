<?php
/***********************************************************************
 * Авторизация через социальную сеть
 **********************************************************************/
@include($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');

//Аутентификация через социальную сеть
function social_network_auth($network, $data){
	global $db;
	$id 	= (!empty($data['id']) ? $data['id'] : '');
	$email	= (!empty($data['email']) ? $data['email'] : '');
	$fname	= (!empty($data['fname']) ? $data['fname'] : '');
	$lname	= (!empty($data['lname']) ? $data['lname'] : '');

	if(empty($id)){
		header('Location: /entry.php');
		exit;
	}
	/*
	echo "Социальная сеть: " . $network . '<br />';
	echo "Социальный ID пользователя: " . $id . '<br />';
	echo "E-Mail пользователя: " . $email . '<br />';
	echo "Имя пользователя: " . $fname . '<br />';
	echo "Фамилия пользователя: " . $lname. '<br />';
	*/
	
	$vals = [];
	$sql = 'SELECT * FROM `users` WHERE ';
	if(!empty($email)){
		$sql = $sql.'`email` LIKE ? OR ';
		$vals[] = $email;
	}
	$sql = $sql.'`id_'.$network.'` LIKE ?';
	$vals[] = $id;

	$q = $db->prepare($sql);
	$q->execute($vals);
	$user = $q->fetch(PDO::FETCH_ASSOC);
		
	//Пользователь найден
	if(!empty($user)){
		social_network_success($user['user_id']);
		
	}
	//Пользователь не найден - создаем учетную запись
	else{
		$vals = [];
		$keys = [];
		if(!empty($email)){
			$keys[]='`user_login`';
			$vals[]=$email;
			$keys[]='`user_mail`';
			$vals[]=$email;
		}
		if(!empty($fname)){
			$keys[]='`user_name`';
			$vals[]=$fname;
		}
		if(!empty($lname)){
			$keys[]='`user_name`';
			$vals[]=$lname;
		}
	$sql = "UPDATE users SET name=?, surname=?, sex=? WHERE id=?";
	if($pdo->prepare($sql)->execute([$name, $surname, $sex, $id]) !== false){
		setcookie("id", $user_id, time()+60*60*24*3, "/");
		setcookie("hash", $hash, time()+60*60*24*3, "/");	
		header("Location: /private.php"); 
		exit();
	}

}



	
}


//Успешная аутентификация
function social_network_success($user_id){
	global $db;
	$hash = md5(rand(111111,999999).time());
	if($pdo->prepare('UPDATE `users` SET `user_hash`=? WHERE `user_id`=?')->execute([$hash, $user_id]) !== false){
		setcookie("id", $user_id, time()+60*60*24*3, "/");
		setcookie("hash", $hash, time()+60*60*24*3, "/");	
		header("Location: /private.php"); 
		exit();
	}
	header("Location: /entry.php?pdo_error=social_network_success"); 
	exit();
}

?>
