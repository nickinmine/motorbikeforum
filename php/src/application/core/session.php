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
	public static function auth($role = null) {
		if (!array_key_exists('token', $_COOKIE)) {
			// Токен не найден в куках
			throw new LogicException(403);
		}
		$token = $_COOKIE['token'];
		$pdo = self::get_sql_connection();
		if ($role) {
			$query = "SELECT user_uuid FROM token 
				WHERE token = :token AND role = :role AND ipv4 = :ipv4 AND expires_on > NOW()";
			$stmt = $pdo->prepare($query);
			$stmt->execute(array(
				'token' => $token,
				'role' => $role,
				'ipv4' => $_SERVER['REMOTE_ADDR']
			));
		}
		else {
			$query = "SELECT user_uuid FROM token 
				WHERE token = :token AND ipv4 = :ipv4 AND expires_on > NOW()";
			$stmt = $pdo->prepare($query);
			$stmt->execute(array(
				'token' => $token,
				'ipv4' => $_SERVER['REMOTE_ADDR']
			));
		}
		$user = $stmt->fetchAll();
		if (count($user) == 0) {
			// Токен неактивен или не найден
			throw new LogicException(403);
		}
		return $user[0]['user_uuid'];
	}

}