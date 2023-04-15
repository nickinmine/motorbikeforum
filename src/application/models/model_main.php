<?php

class Model_Main extends Model {

	/**
	 * @throws exception
	 */
	public function get_data() {
		$pdo = Session::get_sql_connection();
		$data = array(
			'code' => 200,
			'message' => 'hello world'
		);
		$stmt = $pdo->query('SELECT * FROM user');
		while ($row = $stmt->fetch()) {
			$data['db'][] = $row;
			//Route::addlog($row['role'] . " " . $row['descript']);
		}
		return $data;
	}

}