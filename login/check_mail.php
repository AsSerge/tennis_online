<?php
if(isset($_GET['mail'])){
	include($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');

	$user_mail = $_GET['mail'];
	
	$query = "SELECT COUNT(user_mail) FROM users WHERE user_mail = ?";
	$my_data = $db->prepare($query);
	$my_data->execute([$user_mail]);
	$userdata = $my_data->fetch();
	echo $userdata[0];

}
else{
 	echo "Хрень";
}
?>