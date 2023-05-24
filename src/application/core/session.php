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

	public static function safe_session_start() {
		if (!isset($_SESSION)) {
			session_start();
		}
	}

	/**
	 * Проверка авторизации по токену
	 * @throws Exception
	 */
	public static function auth($token) {
		$pdo = self::get_sql_connection();
		$stmt = $pdo->prepare("SELECT user_uuid FROM token 
			WHERE token = :token AND ipv4 = :ipv4 AND expires_on > NOW()");
		$stmt->execute(array(
			'token' => $token,
			'ipv4' => $_SERVER['REMOTE_ADDR']
		));
		$user = $stmt->fetchAll();
		if (count($user) == 0) {
			throw new LogicException(403);
		}
		return $user[0];
	}

}