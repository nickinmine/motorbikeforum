<?php

class Model_Main extends Model {

	/**
	 * @throws Exception
	 */
	public function get_data($message = null) {
		$pdo = Session::get_sql_connection();
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