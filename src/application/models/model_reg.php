<?php

class Model_Reg extends Model {

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
	public function registration($user) {
		// Удаление пустых полей пользователя
		foreach ($user as $key => $value) {
			if ($value == '') unset($user[$key]);
		}
		// Проверка заполненности обязательных полей
		if (!array_key_exists('name', $user) ||
			!array_key_exists('nickname', $user) ||
			!array_key_exists('password', $user) ||
			!array_key_exists('experience', $user ) ||
			!array_key_exists('email', $user)) {
			throw new LogicException('Обязательные поля не заполнены');
		}

		$pdo = Session::get_sql_connection();
		$pdo->beginTransaction();

		// Добавление пользователя в таблицу пользователей
		$stmt = $pdo->prepare("INSERT INTO user (name, nickname, password, experience, email, motorbike) 
			VALUES (:name, :nickname, :password, :experience, :email, :motorbike)");
		$stmt->execute(array(
			'name' => htmlspecialchars($user['name']),
			'nickname' => htmlspecialchars($user['nickname']),
			'password' => password_hash($user['password'], PASSWORD_DEFAULT),
			'experience' => $user['experience'],
			'email' => htmlspecialchars($user['email']),
			'motorbike' => htmlspecialchars($user['motorbike'])
		));

		// Добавление пользователя в лист ожидания
		$stmt = $pdo->prepare("INSERT INTO wait_list (SELECT user_uuid FROM user WHERE nickname = :nickname)");
		$stmt->execute(array('nickname' => htmlspecialchars($user['nickname'])));

		$pdo->commit();
	}

}