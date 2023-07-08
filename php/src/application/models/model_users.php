<?php

class Model_Users extends Model {

	/**
	 * @throws Exception
	 */
	public function get_data($message = null) {
		$pdo = Session::get_sql_connection();
		Session::auth($_COOKIE['token']);
		$data = array(
			'code' => 200,
			'message' => $message
		);
		$stmt = $pdo->query('SELECT * FROM user');
		while ($row = $stmt->fetch()) {
			$data['db'][] = $row;
		}
		return $data;
	}

}