<?php
/***********************************************************************
 * Класс обработки тегов
 * Автор: Станислав В. Третьяков svtrostov@yandex.ru
 * 
 * 
 * МЕТОДЫ КЛАССА:
 * $db - указатель на объект PDO
 * 
 * $tag = new Tags($db);
 * 
 * $tag->getTags() - Возвращает список тегов определенной группы или все теги, если $group_id = 0, теги отсортированы по полю tag в порядке А..Я
 * $tag->addTag() - Добавляет новый тег
 * $tag->deleteTag() - Удаляет тег с существующим ID
 * $tag->changeTag() - Изменяет тег с существующим ID
 * 
 * $tag->getMovieTags() - Возвращает список тегов для видеоролика
 * $tag->addTagToMovie() - Добавляет новый тег (один или несколько) в видеоролик
 * $tag->removeTagFromMovie() - Удаляет тег (один или несколько) из видеоролика
 * $tag->updateMovieTags() - Обновляет теги для видеоролика: удаляет старые теги и заменяет новыми тегами
 * 
 * $tag->searchMovies() - Ищет видеоролики, соответствующие заданым тегам
 * 
 * 
 * 
 * 
 **********************************************************************/




class Tags{

	public $db;	//Указатель на объект работы с базой данных



/*-----------------------------------------------------------
 * Общие функции
 *----------------------------------------------------------*/

	/*
	 * Конструктор класса
	 */
	public function __construct($db){
		$this->db = $db;
	}#end function


	/*
	 * Деструктор класса
	 */
	public function __destruct() {
		
	}#end function

	/*
	 * Вызов недоступных методов
	 */
	public function __call($name, $args){
		return false;
	}#end function



/*-----------------------------------------------------------
 * Функции класса - работа с тегами
 *----------------------------------------------------------*/

	/*
	 * Возвращает список тегов определенной группы или все теги, если $group_id = 0, теги отсортированы по полю tag в порядке А..Я
	 * $group_id - ID группы тегов
	 * $output - формат вывода результатов: 
	 * 			0 - массив вида array(array('tag_id'=>TAG_ID,'tag'=>"TAG",'group_id'=>GROUP_ID),...,array('tag_id'=>TAG_ID,'tag'=>"TAG",'group_id'=>GROUP_ID))
	 * 			1 - массив вида array(array(TAG_ID,"TAG",GROUP_ID),...,array(TAG_ID,"TAG",GROUP_ID))
	 * 			2 - массив вида ключ->значение array(TAG_ID=>TAG,...,TAG_ID=>TAG)
	 * 			3 - массив вида ключ->значение, сгруппированный по group_id array(GROUP_ID => array(TAG_ID=>TAG,...,TAG_ID=>TAG), ..., GROUP_ID => array(TAG_ID=>TAG,...,TAG_ID=>TAG))
	 */
	public function getTags($group_id=0,$output=0){
		$group_id = intval($group_id);
		$result = [];
		$stmt = $this->db->query('SELECT `tag_id`,`tag`,`group_id` FROM `tags`'.($group_id>0 ? ' WHERE `group_id`='.$group_id:'').' ORDER BY `tag` ASC');
		switch($output){
			//массив вида array(array(TAG_ID,"TAG",GROUP_ID),...,array(TAG_ID,"TAG",GROUP_ID))
			case 1:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					$result[] = array($row[0],$row[1],$row[2]);
				}
			break;

			//массив вида ключ->значение
			case 2:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					$result[$row[0]] = $row[1];
				}
			break;

			//массив вида ключ->значение, сгруппированный по group_id
			case 3:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					if(!isset($result[$row[2]])) $result[$row[2]] = array();
					$result[$row[2]][$row[0]] = $row[1];
				}
			break;

			//массив вида array(array(),...,array())
			default:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					$result[] = array('tag_id'=>$row[0],'tag'=>$row[1],'group_id'=>$row[2]);
				}
		}
		return $result;
	}#end function


	/*
	 * Добавляет новый тег
	 * $tag - собственно само текстовое представление тега
	 * $group_id - ID группы тегов
	 * Возвращает FALSE в случае ошибки или ID добавленного тега в случае успеха
	 */
	public function addTag($tag='', $group_id=0){
		if(empty($tag)) return false;
		if($this->db->prepare('INSERT INTO `tags` (`tag_id`, `tag`, `group_id`) VALUES (NULL,?,?)')->execute([$tag, $group_id]) === false) return false;
		return $this->db->lastInsertId();
	}


	/*
	 * Удаляет тег с заданным ID
	 * $tag_id - ID тега
	 * Возвращает FALSE в случае ошибки, TRUE если тег был удален
	 */
	public function deleteTag($tag_id=0){
		$this->db->beginTransaction();
		$stmt = $this->db->prepare('DELETE FROM `tags` WHERE `tag_id` = ? LIMIT 1');
		if($stmt->execute([$tag_id])===false){
			$this->db->rollback();
			return false;
		}
		$stmt = $this->db->prepare('DELETE FROM `movie_tags` WHERE `tag_id` = ?');
		if($stmt->execute([$tag_id])===false){
			$this->db->rollback();
			return false;
		}
		$this->db->commit();
		return true;
	}




	/*
	 * Изменяет тег с заданным ID
	 * $tag_id - ID тега
	 * если задан $tag не как false, то он будет изменен
	 * если задан $group_id не как false, то он будет изменен
	 * Возвращает FALSE в случае ошибки, 0 - если tag_id не найден и 1 если тег был удален
	 */
	public function changeTag($tag_id=0, $tag=false, $group_id=false){
		if(empty($tag_id)) return 0;
		$updk=[];
		$updv=[];
		if($tag!==false){$updk[]='`tag`=?';$updv[]=$tag;}
		if($group_id!==false){$updk[]='`group_id`=?';$updv[]=$group_id;}
		if(empty($updk)) return 0; //нечего менять
		$stmt = $this->db->prepare('UPDATE `tags` SET '.implode(',',$updk).' WHERE `tag_id`=? LIMIT 1');
		$updv[]=$tag_id;
		if($stmt->execute($updv)===false) return false;
		return $stmt->rowCount();
	}



/*-----------------------------------------------------------
 * Функции класса - работа с тегами видеороликов
 *----------------------------------------------------------*/

	/*
	 * Возвращает список тегов для видеоролика
	 * $mov_id - ID видеоролика
	 * $output - формат вывода результатов: 
	 * 			0 - массив вида array(array('tag_id'=>TAG_ID,'tag'=>"TAG",'group_id'=>GROUP_ID),...,array('tag_id'=>TAG_ID,'tag'=>"TAG",'group_id'=>GROUP_ID))
	 * 			1 - массив вида array(array(TAG_ID,"TAG",GROUP_ID),...,array(TAG_ID,"TAG",GROUP_ID))
	 * 			2 - массив вида ключ->значение array(TAG_ID=>TAG,...,TAG_ID=>TAG)
	 * 			3 - массив вида ключ->значение, сгруппированный по group_id array(GROUP_ID => array(TAG_ID=>TAG,...,TAG_ID=>TAG), ..., GROUP_ID => array(TAG_ID=>TAG,...,TAG_ID=>TAG))
	 */
	public function getMovieTags($mov_id=0,$output=0){
		$mov_id = intval($mov_id);
		$result = [];
		$stmt = $this->db->query('SELECT T.`tag_id`,T.`tag`,T.`group_id` FROM `tags` as T INNER JOIN `movie_tags` as MT ON MT.`tag_id`=T.`tag_id` WHERE MT.`mov_id`='.$mov_id.' ORDER BY T.`tag` ASC');
		switch($output){
			//массив вида array(array(TAG_ID,"TAG",GROUP_ID),...,array(TAG_ID,"TAG",GROUP_ID))
			case 1:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					$result[] = array($row[0],$row[1],$row[2]);
				}
			break;

			//массив вида ключ->значение
			case 2:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					$result[$row[0]] = $row[1];
				}
			break;

			//массив вида ключ->значение, сгруппированный по group_id
			case 3:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					if(!isset($result[$row[2]])) $result[$row[2]] = array();
					$result[$row[2]][$row[0]] = $row[1];
				}
			break;

			//массив вида array(array(),...,array())
			default:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					$result[] = array('tag_id'=>$row[0],'tag'=>$row[1],'group_id'=>$row[2]);
				}
		}
		return $result;
	}#end function


	/*
	 * Возвращает список всех тегов, дополнительно возвращая признак отмеченных тегов для видеоролика
	 * $mov_id - ID видеоролика
	 * $output - формат вывода результатов: 
	 * 			0 - массив вида array(array('tag_id'=>TAG_ID,'tag'=>"TAG",'group_id'=>GROUP_ID,'selected'=>SELECTED_TAG),...,array('tag_id'=>TAG_ID,'tag'=>"TAG",'group_id'=>GROUP_ID,'selected'=>SELECTED_TAG))
	 * 			1 - массив вида array(array(TAG_ID,"TAG",GROUP_ID,SELECTED_TAG),...,array(TAG_ID,"TAG",GROUP_ID,SELECTED_TAG))
	 * 			2 - массив, сгруппированный по group_id
	 * 				array(
	 * 					GROUP_ID => array(array('tag_id'=>TAG_ID,'tag'=>"TAG",'group_id'=>GROUP_ID,'selected'=>SELECTED_TAG),...,array('tag_id'=>TAG_ID,'tag'=>"TAG",'group_id'=>GROUP_ID,'selected'=>SELECTED_TAG)),
	 * 					GROUP_ID => array(array('tag_id'=>TAG_ID,'tag'=>"TAG",'group_id'=>GROUP_ID,'selected'=>SELECTED_TAG),...,array('tag_id'=>TAG_ID,'tag'=>"TAG",'group_id'=>GROUP_ID,'selected'=>SELECTED_TAG))
	 * 				)
	 */
	public function getMovieAllTags($mov_id=0,$output=0){
		$mov_id = intval($mov_id);
		$result = [];
		$stmt = $this->db->query('SELECT T.`tag_id`,T.`tag`,T.`group_id`, IF(EXISTS(SELECT * FROM `movie_tags` WHERE `tag_id`=T.`tag_id` AND `mov_id`='.$mov_id.' LIMIT 1), 1, 0) as `selected` FROM `tags` as T ORDER BY T.`tag` ASC');
		switch($output){
			//массив вида array(array(TAG_ID,"TAG",GROUP_ID,SELECTED_TAG),...,array(TAG_ID,"TAG",GROUP_ID,SELECTED_TAG))
			case 1:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					$result[] = array($row[0],$row[1],$row[2],$row[3]);
				}
			break;

			//массив, сгруппированный по group_id
			case 2:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)){
					if(!isset($result[$row[2]])) $result[$row[2]] = array();
					$result[$row[2]][] = array('tag_id'=>$row[0],'tag'=>$row[1],'group_id'=>$row[2],'selected'=>$row[3]);
				}
			break;

			//массив вида array(array(),...,array())
			default:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					$result[] = array('tag_id'=>$row[0],'tag'=>$row[1],'group_id'=>$row[2],'selected'=>$row[3]);
				}
		}
		return $result;
	}#end function




	/*
	 * Добавляет новый тег (один или несколько) в видеоролик
	 * $mov_id - ID видеоролика
	 * $tag_id - ID тега, tag_id может быть задан в виде одномерного массива ID тегов:  array(1,2,...,n)
	 * Возвращает FALSE в случае ошибки или TRUE в случае успеха
	 */
	public function addTagToMovie($mov_id=0, $tag_id=0){
		if(empty($mov_id)||empty($tag_id)) return false;
		if(!is_array($tag_id))$tag_id=array($tag_id);
		$tag_id = array_map('intval',$tag_id);
		$stmt = $this->db->prepare('REPLACE INTO `movie_tags` (`mov_id`,`tag_id`) VALUES (?,?)');
		$this->db->beginTransaction();
		foreach ($tag_id as $id){
			if($stmt->execute([$mov_id, $id])===false){
				$this->db->rollback();
				return false;
			}
		}
		$this->db->commit();
		return true;
	}

	/*
	 * Удаляет тег (один или несколько) из видеоролика
	 * $mov_id - ID видеоролика
	 * $tag_id - ID тега, tag_id может быть задан в виде одномерного массива ID тегов:  array(1,2,...,n)
	 * Возвращает FALSE в случае ошибки или TRUE в случае успеха
	 */
	public function removeTagFromMovie($mov_id=0, $tag_id=0){
		if(empty($mov_id)||empty($tag_id)) return false;
		if(!is_array($tag_id)) $tag_id=array($tag_id);
		$tag_id = array_map('intval',$tag_id);
		if($this->db->prepare('DELETE FROM `movie_tags` WHERE `mov_id`=? AND `tag_id` IN('.implode(',',$tag_id).')')->execute([$mov_id]) === false) return false;
		return true;
	}


	/*
	 * Обновляет теги для видеоролика: удаляет старые теги и заменяет новыми тегами
	 * $mov_id - ID видеоролика
	 * $tag_id - ID тега, tag_id может быть задан в виде одномерного массива ID тегов:  array(1,2,...,n)
	 * Возвращает FALSE в случае ошибки или TRUE в случае успеха
	 */
	public function updateMovieTags($mov_id=0, $tag_id=0){
		if(empty($mov_id)) return false;
		if(!is_array($tag_id)) $tag_id=array($tag_id);
		$tag_id = array_map('intval',$tag_id);
		$this->db->beginTransaction();
		if($this->db->prepare('DELETE FROM `movie_tags` WHERE `mov_id`=?')->execute([$mov_id]) === false){
			$this->db->rollback();
			return false;
		}
		$stmt = $this->db->prepare('REPLACE INTO `movie_tags` (`mov_id`,`tag_id`) VALUES (?,?)');
		foreach ($tag_id as $id){
			if($stmt->execute([$mov_id, $id])===false){
				$this->db->rollback();
				return false;
			}
		}
		$this->db->commit();
		return true;
	}




/*-----------------------------------------------------------
 * Функции класса - поиск
 *----------------------------------------------------------*/

	/*
	 * Поиск видеороликов, соответствующим заданым тегам
	 * 
	 * $tags - ID тега или одномерный массив ID тегов:  array(1,2,...,n), 
	 * если $tags не задан будут возвращены все видеоролики
	 * 
	 * $type - тип фильтрации тегов (т.е. каким образом будет выполнен поиск видеороликов), значения:
	 * 			OR - будут выбраны видеоролики, которые содержат хотя бы один из заданных тегов
	 * 			AND - будут выбраны видеоролики, которые содержат все заданные теги
	 * 		по-умолчанию: OR
	 * 
	 * $movies - одномерный массив ID видеороликов, среди которых ведется поиск (т.е. в поиске участвуют только ролики с указанными ID)
	 * 		по-умолчанию: не задано
	 * 
	 * $output - формат вывода результатов: 
	 * 		0 - одномерный массив ID видеороликов вида array(MOV_ID,MOV_ID,...,MOV_ID)		
	 * 		1 - массив вида array(array(MOVIE_ROW),array(MOVIE_ROW),...,array(MOVIE_ROW))
	 * 		по-умолчанию: 1
	 * 
	 * $fields - массив полей таблицы movies, которые требуется вернуть, пример: array('mov_id','user_id','mov_name','mov_link')
	 * 			если не задано, возвращает все поля
	 * 			не работает, если $output задан как 0
	 * 			по-умолчанию: * (возвращает все поля)
	 * 
	 * $match_id - ID конкурса, в котором участвуют видеоролики, среди которых ведется поиск
	 * 			если не задано, поиск ведется среди всех видеороликов
	 * 			по-умолчанию: не задано
	 * 
	 * $order - поля, по которым идет сортировка, задается в виде ассоциативного массива
	 * 				array( FIELD => ORDER_TYPE, FIELD => ORDER_TYPE, FIELD => ORDER_TYPE)
	 * 				FIELD - поле таблицы, по которому будет делаться сортировка
	 * 				ORDER_TYPE - Направление сортировки:
	 * 					ASC - А..Я
	 * 					DESC - Я..А
	 * 				по-умолчанию: нет сортировки
	 * 
	 * 
	 * $term - если задано, то будет осуществлен поиск по полю `mov_name`
	 * $term_type - Тип поиска, возможные значения:
	 * 			AND - в `mov_name` должны быть все слова из $term
	 * 			OR - в `mov_name` должно быть хотя бы одно из слов в $term
	 * 			по-умолчанию: AND
	 * 
	 * $date_begin - Если задано, выводит добавленные видеоролики начиная с указанной даты включительно. Дата в формате MySQL YYYY-MM-DD
	 * $date_end - Если задано, выводит добавленные видеоролики до указанной даты включительно. Дата в формате MySQL YYYY-MM-DD
	 * 
	 * 
	 * $status - видеоролиики начиная от какого статуса следует вернуть.
	 * 			Возможные значения:
	 * 			0 - Все видеоролики (заблокированные, ожидающие аппрува, активные)
	 * 			1 - Только ожидающие аппрува и/или активные
	 * 			2 - Только активные
	 * 			По умолчанию: 2
	 * 
	 * $limit	- Максимальное количество возвращаемых видеоролииков
	 * 			По умолчанию: 0 (не ограничено)
	 * 
	 * $offset	- Смещение в результатах поиска на указанное количество записей
	 * 			По умолчанию: 0 (нет смещения)
	 * 
	 * Возвращает FALSE в случае ошибки или результат в случае успеха
	 * 
	 * 	ФУНКЦИЯ searchMovies() С ПОЛНЫМ НАБОРОМ ПАРАМЕТРОВ:
	 * 
		searchMovies([
			'tags' 		=> [1,2,3],											//ID тегов
			'type' 		=> 'OR',											//тип фильтрации тегов AND OR
			'movies'	=> null,											//массив ID видеороликов, среди которых ведется поиск
			'output'	=> 1,												//формат вывода результатов
			'fields'	=> ['mov_id','user_id','mov_name','mov_link'],		//массив полей таблицы movies, которые требуется вернуть
			'match_id'	=> 0,												//ID конкурса, в котором участвуют видеоролики, среди которых ведется поиск
			'order'		=> ['mov_name'=> 'ASC','mov_added'=> 'DESC'],		//Поля и поряток сортировки результатов
			'term'		=> '',												//если задано, то будет осуществлен поиск по полю `mov_name`
			'term_type' => 'AND',											//AND - в `mov_name` должны быть все слова из $term, OR - в `mov_name` должно быть хотя бы одно из слов в $term
			'date_begin'=> '2020-01-01',									//Если задано, выводит добавленные видеоролики начиная с указанной даты включительно. Дата в формате MySQL YYYY-MM-DD
			'date_end'	=> '2059-12-31',									//Если задано, выводит добавленные видеоролики до указанной даты включительно. Дата в формате MySQL YYYY-MM-DD
			'status'	=> 2,												//видеоролиики начиная от какого статуса следует вернуть: 2 - активные, 1 - активные + аппрув, 0 - все
			'limit'		=> 0,												//Максимальное количество возвращаемых видеоролииков
			'offset'	=> 0												//мещение в результатах поиска на указанное количество записей
		]);
	 */
	public function searchMovies($data=array()){

		$status = !isset($data['status']) ? 2 : min(2,max(0,intval($data['status'])));

		$ainner = [];
		$awhere = ['M.`mov_status`>='.$status];

		if(!empty($data['movies']) && is_array($data['movies'])){
			 $awhere[]='M.`mov_id` IN('.implode(',',array_map('intval',$data['movies'])).')';
		 }

		if(!empty($data['match_id'])){
			$awhere[]='M.`match_id`='.intval($data['match_id']);
		}

		if(!empty($data['date_begin'])&&preg_match("/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $data['date_begin'])){
			$awhere[]='M.`mov_added`>="'.$data['date_begin'].'"';
		}

		if(!empty($data['date_end'])&&preg_match("/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $data['date_end'])){
			$awhere[]='M.`mov_added`<="'.$data['date_end'].'"';
		}


		if(!empty($data['term'])){
			$term_type = !empty($data['term_type']) && $data['term_type'] == 'OR' ? 'OR' : 'AND';
			$term = str_replace(array('\\','+','*','?','[',']','^','(',')','{','}','=','!','<','>','|',':','-','\'','"','union','select','insert','delete'), ' ',strtolower($data['term']));
			$term = trim(preg_replace('/\s\s+/', ' ', $term));
			$term = addslashes($term);
			$words = explode(' ', $term);
			$aname = [];
			foreach ($words as $w){
				$aname[]='M.`mov_name` REGEXP "'.$w.'"';
			}
			$awhere[]= '('.implode(' '.$term_type.' ', $aname).')';
			//$awhere[]= 'M.`mov_name` LIKE "%'.addslashes(str_replace(['"','%',"\""],'',$data['term'])).'%"';
		}

		$output = isset($data['output']) ? (!empty($data['output']) ? 1 : 0) : 1;
		if($output){
			if(!empty($data['fields'])){
				$fields = is_array($data['fields']) ? array_map('addslashes',$data['fields']) : array(addslashes($data['fields']));
				$sql = 'SELECT DISTINCT '.implode('`,M.`',$fields).' FROM `movie` as M';
			}else{
				$sql = 'SELECT DISTINCT M.* FROM `movie` as M';
			}
		}
		else{
			$sql = 'SELECT DISTINCT M.`mov_id` FROM `movie` as M';
		}

		$tags = false;
		if(!empty($data['tags'])){
			$tags = is_array($data['tags']) ? array_map('intval',$data['tags']) : array(intval($data['tags']));
			if(count($tags)==1&&$tags[0]==0) $tags = false;
		}

		if(is_array($tags)){
			$type = !empty($data['type']) && in_array($data['type'],['OR','AND']) ? $data['type'] : 'OR';
			switch($type){
				case 'AND':
				for($i=0;$i<count($tags);$i++){
					$mt = 'MT'.$i;
					$ainner[]='INNER JOIN `movie_tags` as '.$mt.' ON '.$mt.'.`mov_id`=M.`mov_id`';
					$awhere[]=$mt.'.`tag_id` ='.$tags[$i];
				}
				break;
				case 'OR':
				default:
					$ainner[]='INNER JOIN `movie_tags` as MT ON MT.`mov_id`=M.`mov_id`';
					$awhere[]='MT.`tag_id` IN('.implode(',',$tags).')';
				break;
			}
		}

		$order = '';
		if(!empty($data['order'])&&is_array($data['order'])){
			$flds = [];
			foreach($data['order'] as $field=>$type){
				$flds[] = 'M.`'.$field.'` '.($type == 'DESC' ? 'DESC' : 'ASC');
			}
			$order = ' ORDER BY '.implode(',', $flds);
		}

		$limit = !empty($data['limit'])? abs(intval($data['limit'])) : 0;
		$offset = !empty($limit)&&!empty($data['offset'])? abs(intval($data['offset'])) : 0;

		$result = [];

		$sql.=' '.implode(' ',$ainner) . (empty($awhere) ? '' : ' WHERE '.implode(' AND ',$awhere)).$order.($limit>0 ? ' LIMIT '.$limit : '').($offset>0 ? ' OFFSET '.$offset : '');

		echo "\n".$sql."\n";
		
		if(($stmt = $this->db->query($sql))===false){
			return false;
		}

		switch($output){
			//массив вида array(array(TAG_ID,"TAG",GROUP_ID),...,array(TAG_ID,"TAG",GROUP_ID))
			case 1:
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$result[] = $row;
				}
			break;

			//массив вида array(mov_id,...,mov_id)
			default:
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					$result[] = $row[0];
				}
		}

		return $result;

	}#end function



}#end class

?>
