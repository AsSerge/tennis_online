<?php
include ($_SERVER['DOCUMENT_ROOT'].'/login/log_to_base.php');
include ('../layout/site_function.php');
include ('../classes/tags.class.php');
include ('./PHPMailer/PHPMailerFunction.php'); // Подключаем функцию отправки почты
//************************************* Обработчик загрузки ролика **************************************/

if(isset($_POST['mov_id'])){
	$db->beginTransaction(); // Старт транзакции
	$mov_id = $_POST['mov_id'];
	$mov_description = ClearPostString($_POST['mov_description']); // Описание
	$mov_age_cat = $_POST['mov_age_cat']; // Возрастная категория

	$sql = "UPDATE movie SET mov_description = ?, mov_age_cat = ? WHERE mov_id = ?";
	$stmt = $db->prepare($sql); // Готовим запрос

		$stmt->bindParam(1, $mov_description);
		$stmt->bindParam(2, $mov_age_cat);
		$stmt->bindParam(3, $mov_id);
	$stmt->execute();
	
	$db->commit(); // Фиксация сохранение изменений
	// $tag = new Tags($db);
	// $equipment = new Tags($db);

	$mov_tags = $_POST['mov_tags']; // Строка тегов
	$mov_equipment = $_POST['mov_equipment']; // Строка оборудования
	// $tag->updateMovieTags($mov_id, $mov_tags); // Обновляем теги
	// $equipment->updateMovieTags($mov_id, $mov_equipment); // Обновляем оборудование

	header("Location: /private.php?mov_id={$mov_id}"); exit();
	

}else{

	$user_id=$_POST['user_id'];
	$match_id = $_POST['match_id']; // ID Конкурса
	$mov_added=date("Y-m-d");

	$mov_link = $_POST['mov_link'];
	$mov_link_type = GetVideoContentType($mov_link)['type']; // Тип


	$mov_name = ClearPostString($_POST['mov_name']); // Название
	$mov_description = ClearPostString($_POST['mov_description']); // Описание

	$mov_age_cat = $_POST['mov_age_cat']; // Возрастная категория

	$mov_status = 1;	

	$mov_tags = $_POST['mov_tags']; // Строка тегов
	$mov_equipment = $_POST['mov_equipment']; // Строка оборудования

	if(isset($user_id)){
		$db->beginTransaction(); // Старт транзакции

		$sql = "INSERT INTO movie (`user_id`, `match_id`, `mov_added`, `mov_link_type`, `mov_link`, `mov_name`, `mov_description`, `mov_age_cat`, `mov_status`)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $db->prepare($sql); // Готовим запрос

		$stmt->bindParam(1, $user_id);
		$stmt->bindParam(2, $match_id);
		$stmt->bindParam(3, $mov_added);
		$stmt->bindParam(4, $mov_link_type);
		$stmt->bindParam(5, $mov_link);
		$stmt->bindParam(6, $mov_name);
		$stmt->bindParam(7, $mov_description);
		$stmt->bindParam(8, $mov_age_cat);
		$stmt->bindParam(9, $mov_status);		
		// Исполняем запрос - Заполняем таблицу ролика
		$stmt->execute();
		// Получаем ID последней записи
		$move_id = $db->lastInsertId();
		
		// Заполняем таблицу тегов
		$tags_sql = "INSERT INTO movie_tags (`mov_id`, `tag_id`) VALUES (?, ?)";	
		$stmt = $db->prepare($tags_sql); 
		if(count($mov_tags) > 0 ){
			foreach($mov_tags as $tag_id){
				$stmt->execute([$move_id, $tag_id]);
			}
		}
		if(count($mov_equipment) > 0 ){
			foreach($mov_equipment as $tag_id){
				$stmt->execute([$move_id, $tag_id]);
			}
		}
		$db->commit(); // Фиксация добавления
		// Возвращаемся на страницу
		header("Location: /private.php"); exit();
	}
}

?>