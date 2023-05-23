<?php

class Session {

	private static $pdo = null;

	public static function get_sql_connection() {
		$dsn = "mysql:host=mysql;port=3306;dbname=motorbike_base";
		$opt = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		if (self::$pdo === null) {
			return new PDO($dsn, 'root', 'root', $opt);
		}
		/*$stmt = $pdo->query('SELECT * FROM emprole');
		while ($row = $stmt->fetch()) {
			Route::addlog($row['role'] . " " . $row['descript']);
		}*/
		return self::$pdo;
	}

	public static function request_uri() {
		return $_SERVER['REQUEST_URI'];
	}

}