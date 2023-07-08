<?php

class Model_Forum extends Model {

	/**
	 * Предоставление списка тегов
	 * @param null $message
	 * @return array
	 */
	public function get_tag_list($message = null) {
		$data = array(
			'code' => 200,
			'message' => $message
		);
		$pdo = Session::get_sql_connection();
		$stmt = $pdo->query("SELECT tag, description FROM tag");
		while ($row = $stmt->fetch()) {
			$data['tag'][] = $row;
		}
		return $data;
	}

	/**
	 * Создание темы на форуме
	 * @throws Exception
	 */
	public function add_theme($user_uuid, $header, $content, $tag) {
		$data = array(
			'code' => 200,
			'message' => 'OK'
		);
		$pdo = Session::get_sql_connection();
		$stmt = $pdo->prepare("INSERT INTO thread 
    		(user_uuid, header, content, publish_date, is_news, view_num, tag)
    		VALUES 
    		(:user_uuid, :header, :content, NOW(), 0, 0, :tag)");
		$stmt->execute(array(
			'user_uuid' => $user_uuid,
			'header' => htmlspecialchars($header),
			'content' => htmlspecialchars($content),
			'tag' => $tag
		));
		return $data;
	}

}