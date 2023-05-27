<?php

class Model_Auth extends Model {

	public function get_data($message = null) {
		$data = array(
			'code' => 200,
			'message' => $message
		);
		return $data;
	}

	/**
	 * Вход пользователя в систему по логину и паролю
	 * Возвращает токен для входа пользователя
	 * @throws exception
	 */
	public function signin($login, $password) {
		$pdo = Session::get_sql_connection();

		// Поиск пользователя с нужным логином и паролем
		$stmt = $pdo->prepare("SELECT user_uuid, password FROM user u WHERE nickname = :login
			 AND (SELECT COUNT(*) FROM wait_list w WHERE u.user_uuid = w.user_uuid) IS NOT NULL");
		$stmt->execute(array('login' => $login));
		$user = $stmt->fetch();

		$pdo->beginTransaction();

		// Проверка пароля на правильность
        if ($user['password'] == null || !(password_verify($password, $user['password']))) {
            throw new LogicException('Неверный логин или пароль');
        }
        if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
            Route::addlog('rehash');
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('UPDATE user SET password = :password WHERE user_uuid = :user_uuid');
            $stmt->execute(array(
                'password' => $newHash,
                'user_uuid' => $user['user_uuid'],
            ));
        }

		// Генерация и добавление нового токена, его длительность 7 дней
		$token = bin2hex(random_bytes(16));
		$stmt = $pdo->prepare("INSERT INTO token (user_uuid, token, ipv4, expires_on) 
			VALUES (:user_uuid, :token, :ipv4, DATE_ADD(NOW(), INTERVAL 7 DAY))");
		$stmt->execute(array(
			'user_uuid' => $user['user_uuid'],
			'ipv4' => $_SERVER['REMOTE_ADDR'],
			'token' => $token
		));

		$pdo->commit();

		return $token;
	}

	/**
	 * Выход пользователя из системы
	 * @throws exception
	 */
	public function signout($token) {
		$pdo = Session::get_sql_connection();
		$stmt = $pdo->prepare("DELETE FROM token WHERE token = :token");
		$stmt->execute(array('token' => $token));
		return null;
	}

}