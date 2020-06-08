<?php
/***********************************************************************
 * Класс голосования и выставления рейтингов за видеоролики
 * Автор: Станислав В. Третьяков svtrostov@yandex.ru
 * 
 * 
 * МЕТОДЫ КЛАССА:
 * $db - указатель на объект PDO
 * 
 * $vote = new Vote($db);
 * 
 * $vote->voteUser() - Добавляет голос пользователя user_id за видеоролик mov_id
 * $vote->voteReferee() - Добавляет голос члена жюри reff_id за видеоролик mov_id
 * 
 * 
 * 
 * 
 **********************************************************************/




class Vote{

	public $db;	//Указатель на объект работы с базой данных
	public $errmsg;	//Сообщение о последней ошибке

	public $factor_unique		= 1.0; //Множитель для критерия оценки: Уникальность
	public $factor_humor		= 1.0; //Множитель для критерия оценки: Юмор
	public $factor_competition	= 1.0; //Множитель для критерия оценки: Состязательность
	public $factor_hardness		= 1.0; //Множитель для критерия оценки: Сложность
	public $factor_usefulness	= 1.0; //Множитель для критерия оценки: Полезность



/*-----------------------------------------------------------
 * Общие функции
 *----------------------------------------------------------*/

	/*
	 * Конструктор класса
	 */
	public function __construct($db){
		$this->db = $db;
		$this->errmsg = '';
	}#end function


	/*
	 * Деструктор класса
	 */
	public function __destruct(){
		
	}#end function

	/*
	 * Вызов недоступных методов
	 */
	public function __call($name, $args){
		return false;
	}#end function



/*-----------------------------------------------------------
 * Функции класса - прикладные функции
 *----------------------------------------------------------*/

	/*
	 * Возвращает запись о пользователе в виде ассоциативного массива
	 */
	private function getUserRecord($user_id=0){
		$stmt = $this->db->query('SELECT * FROM `users` WHERE `user_id`='.$user_id.' LIMIT 1');
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/*
	 * Возвращает запись о члене жюри в виде ассоциативного массива
	 */
	private function getRefereeRecord($reff_id=0){
		$stmt = $this->db->query('SELECT * FROM `refferies` WHERE `reff_id`='.$reff_id.' LIMIT 1');
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}


	/*
	 * Возвращает запись о видеоролике в виде ассоциативного массива
	 */
	private function getMovieRecord($mov_id=0){
		$stmt = $this->db->query('SELECT * FROM `movie` WHERE `mov_id`='.$mov_id.' LIMIT 1');
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/*
	 * Возвращает запись о голосовании пользователя
	 */
	private function getUserVoteRecord($user_id=0, $mov_id=0){
		$stmt = $this->db->query('SELECT * FROM `rates_users` WHERE `user_id`='.$user_id.' AND `mov_id`='.$mov_id.' LIMIT 1');
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}


	/*
	 * Возвращает запись о голосовании члена жюри
	 */
	private function getRefereeVoteRecord($reff_id=0, $mov_id=0){
		$stmt = $this->db->query('SELECT * FROM `rates_jury` WHERE `reff_id`='.$reff_id.' AND `mov_id`='.$mov_id.' LIMIT 1');
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}



/*-----------------------------------------------------------
 * Функции класса - голосование пользователей
 *----------------------------------------------------------*/

	/*
	 * Добавляет голос пользователя user_id за видеоролик mov_id
	 * $user_id - ID пользователя (uint)
	 * $mov_id - ID видеоролика (uint)
	 * $points - Оценка видеоролика пользователем (uint)
	 * $replace - Признак, указывающий как поступать, если пользователь уже голосовал за данный видеоролик:
	 * 			true - предыдущая запись о голосовании будет удалена и заменена на новую
	 * 			false - прредыдущая запись останется без изменения, 
	 * Возвращает 1 в случае успеха, 0 - если запись уже существует и не была обновлена, FALSE в случае ошибки
	 */
	public function voteUser($user_id=0, $mov_id=0, $points=0, $replace=false){
		$user_id = intval($user_id);
		$mov_id = intval($mov_id);
		$points = max(0,intval($points));

		if(empty($user_id)){
			$this->errmsg = 'voteUser(): user ID is empty';
			return false;
		}

		if(empty($mov_id)){
			$this->errmsg = 'voteUser(): movie ID is empty';
			return false;
		}


		//Проверка существования пользователя + получение данных о пользователе
		$user = $this->getUserRecord($user_id);
		if(!$user){
			$this->errmsg = 'voteUser(): user ID '.$user_id.' not exists';
			return false;
		}

		//Проверка, активен ли юзер
		if($user['user_status']<1){
			$this->errmsg = 'voteUser(): user ID '.$user_id.' has status: '.$user['user_status'];
			return false;
		}

		//Проверка существования видеоролика + получение данных о ролике
		$movie = $this->getMovieRecord($mov_id);
		if(!$movie){
			$this->errmsg = 'voteUser(): movie ID '.$mov_id.' not exists';
			return false;
		}

		//Проверка, активен ли видеоролик
		if($movie['mov_status']<2){
			$this->errmsg = 'voteUser(): movie ID '.$mov_id.' has status: '.$movie['mov_status'];
			return false;
		}

		//Если запись существует и следует проигнорировать - игнорируем
		if(!$replace){
			$vote = $this->getUserVoteRecord($user_id, $mov_id);
			if($vote) return 0;
		}

		//Добавление записи
		$this->db->beginTransaction();

			$stmt = $this->db->prepare('REPLACE INTO `rates_users` (`user_id`,`mov_id`,`match_id`,`movie_user_id`,`points`,`rate_ip`,`rate_ts`) VALUES (?,?,?,?,?,?,?)');
			if($stmt->execute(array($user_id, $mov_id, $movie['match_id'], $movie['user_id'], $points, $_SERVER['REMOTE_ADDR'], date('Y-m-d H:i:s')))===false){
				$this->db->rollback();
				$this->errmsg = 'voteUser(): insert to table `rates_users` fail';
				return false;
			}

			if(($stmt = $this->db->query(
				'UPDATE `movie` as M, (SELECT `mov_id`, IFNULL(COUNT(*),0) as mcount, IFNULL(SUM(`points`),0) as mpoints, IFNULL(AVG(`points`),0) as mavg FROM `rates_users` WHERE `mov_id` = '.$mov_id.') as RU '.
				'SET M.`voteuser_count` = RU.mcount, M.`voteuser_points` = RU.mpoints, M.`voteuser_avg` = RU.mavg WHERE M.`mov_id` = '.$mov_id
			))===false){
				$this->db->rollback();
				$this->errmsg = 'voteUser(): update stats in `movie` fail';
				return false;
			}

		//success
		$this->db->commit();

		return 1;
	}#end function







/*-----------------------------------------------------------
 * Функции класса - голосование членов жюри
 *----------------------------------------------------------*/


	/*
	 * Добавляет голос члена жюри reff_id за видеоролик mov_id
	 * $reff_id - ID члена жюри (uint)
	 * $mov_id - ID видеоролика (uint)
	 * $points - Массив оценок по критериеям видеоролика:
	 * 			array(
	 * 				'unique'		=> 0,	//Уникальность
	 * 				'humor'			=> 0,	//Юмор
	 * 				'competition'	=> 0,	//Состязательность
	 * 				'hardness' 		=> 0,	//Сложность
	 * 				'usefulness' 	=> 0	//Полезность
	 * 			)
	 * $replace - Признак, указывающий как поступать, если член жюри уже голосовал за данный видеоролик:
	 * 			true - предыдущая запись о голосовании будет удалена и заменена на новую
	 * 			false - прредыдущая запись останется без изменения, 
	 * Возвращает 1 в случае успеха, 0 - если запись уже существует и не была обновлена, FALSE в случае ошибки
	 */
	public function voteReferee($reff_id=0, $mov_id=0, $points=[], $replace=false){
		$reff_id = intval($reff_id);
		$mov_id = intval($mov_id);

		if(empty($reff_id)){
			$this->errmsg = 'voteReferee(): referee ID is empty';
			return false;
		}

		if(empty($mov_id)){
			$this->errmsg = 'voteReferee(): movie ID is empty';
			return false;
		}


		//Проверка существования члена жюри + получение данных о пользователе
		$user = $this->getRefereeRecord($reff_id);
		if(!$user){
			$this->errmsg = 'voteReferee(): referee ID '.$user_id.' not exists';
			return false;
		}

		//Проверка существования видеоролика + получение данных о ролике
		$movie = $this->getMovieRecord($mov_id);
		if(!$movie){
			$this->errmsg = 'voteReferee(): movie ID '.$mov_id.' not exists';
			return false;
		}

		//Проверка, активен ли видеоролик
		if($movie['mov_status']<2){
			$this->errmsg = 'voteReferee(): movie ID '.$mov_id.' has status: '.$movie['mov_status'];
			return false;
		}

		//Если запись существует и следует проигнорировать - игнорируем
		if(!$replace){
			$vote = $this->getRefereeVoteRecord($reff_id, $mov_id);
			if($vote) return 0;
		}

		$rate_unique = (!empty($points['unique']) ? intval($points['unique']) : 0);
		$rate_humor = (!empty($points['humor']) ? intval($points['humor']) : 0);
		$rate_competition = (!empty($points['competition']) ? intval($points['competition']) : 0);
		$rate_hardness = (!empty($points['hardness']) ? intval($points['hardness']) : 0);
		$rate_usefulness = (!empty($points['usefulness']) ? intval($points['usefulness']) : 0);

		$points =	$rate_unique * $this->factor_unique + 
					$rate_humor * $this->factor_humor +
					$rate_competition * $this->factor_competition +
					$rate_hardness * $this->factor_hardness +
					$rate_usefulness * $this->factor_usefulness;


		//Добавление записи
		$this->db->beginTransaction();

			$stmt = $this->db->prepare('REPLACE INTO `rates_jury` (`reff_id`,`mov_id`,`match_id`,`movie_user_id`,`rate_unique`,`rate_humor`,`rate_competition`,`rate_hardness`,`rate_usefulness`,`points`,`rate_ip`,`rate_ts`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
			if($stmt->execute(array($reff_id, $mov_id, $movie['match_id'], $movie['user_id'], $rate_unique, $rate_humor, $rate_competition, $rate_hardness, $rate_usefulness, $points, $_SERVER['REMOTE_ADDR'], date('Y-m-d H:i:s')))===false){
				$this->db->rollback();
				$this->errmsg = 'voteReferee(): insert to table `rates_jury` fail';
				return false;
			}

			if(($stmt = $this->db->query(
				'UPDATE `movie` as M, (SELECT `mov_id`, IFNULL(AVG(`rate_unique`),0) as munique, IFNULL(AVG(`rate_humor`),0) as mhumor, IFNULL(AVG(`rate_competition`),0) as mcompetition, IFNULL(AVG(`rate_hardness`),0) as mhardness, IFNULL(AVG(`rate_usefulness`),0) as musefulness, IFNULL(SUM(`points`),0) as mpoints FROM `rates_jury` WHERE `mov_id` = '.$mov_id.') as RR '.
				'SET M.`reff_unique` = RR.munique, M.`reff_humor` = RR.mhumor, M.`reff_competition` = RR.mcompetition, M.`reff_hardness` = RR.mhardness, M.`reff_usefulness` = RR.musefulness, M.`reff_points` = RR.mpoints WHERE M.`mov_id` = '.$mov_id
			))===false){
				$this->db->rollback();
				$this->errmsg = 'voteReferee(): update stats in `movie` fail';
				return false;
			}

		//success
		$this->db->commit();

		return 1;
	}#end function


}#end class

?>
