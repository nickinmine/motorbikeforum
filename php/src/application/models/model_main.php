<?php

class Model_Main extends Model {

	/**
	 * @throws Exception
	 */
	public function get_data($message = null) {
		$data = array(
			'code' => 200,
			'message' => $message,
			'user' => array()
		);
		try {
			$user_uuid = Session::auth();
			$pdo = Session::get_sql_connection();
			$stmt = $pdo->prepare("SELECT nickname, (SELECT min_uri FROM image WHERE image_id = avatar_id) 
    			AS avatar_uri FROM user WHERE user_uuid = :user_uuid");
			$stmt->execute(array('user_uuid' => $user_uuid));
			$data['user'] = $stmt->fetch();
		}
		catch (LogicException $exception) {
			$data['user']['nickname'] = null;
		}
		return $data;
	}

}