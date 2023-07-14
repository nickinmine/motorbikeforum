<?php

class Model_Main extends Model {

	/**
	 * @throws Exception
	 */
	public function get_data($message = null) {
		$data = array(
			'code' => 200,
			'message' => $message,
			'user' => null,
		);
		$user_uuid = Session::auth();
		$pdo = Session::get_sql_connection();
		$stmt = $pdo->prepare("SELECT nickname FROM user WHERE user_uuid = :user_uuid");
		$stmt->execute(array('user_uuid' => $user_uuid));
		$data['nickname'] = $stmt->fetch()['nickname'];
		return $data;
	}

}