<?php

class Model_Profile extends Model {

	public function get_data($message = null) {
		$data = array(
			'code' => 200,
			'message' => $message,
			'user' => array()
		);
		$user_uuid = Session::auth();
		$pdo = Session::get_sql_connection();
		$query = "SELECT name, nickname, email, motorbike, experience FROM user WHERE user_uuid = :user_uuid";
		$stmt = $pdo->prepare($query);
		$stmt->execute(array('user_uuid' => $user_uuid));
		$data['user'] = $stmt->fetch();
		return $data;
	}

	/**
	 * Редактирование данных пользователя
	 * Возвращает токен для входа пользователя
	 * @throws exception
	 */
	public function edit_profile($user) {
		// Удаление пустых полей пользователя
		/*foreach ($user as $key => $value) {
			if ($value == '') unset($user[$key]);
		}*/
		// Проверка заполненности обязательных полей
		if (!array_key_exists('name', $user) ||
			!array_key_exists('nickname', $user) ||
			!array_key_exists('email', $user)) {
			throw new LogicException('Обязательные поля не заполнены');
		}
		// Пароль введен и повторен верно
		if (array_key_exists('password', $user) ||
			array_key_exists('password2', $user)) {
			if (array_key_exists('password', $user) &&
				array_key_exists('password2', $user) &&
				$user['password'] != $user['password2']) {
				throw new LogicException('Пароли не совпадают');
			}
		}
		$pdo = Session::get_sql_connection();
		Route::addlog(print_r($user, true));
		// Обновление данных пользователя
		$stmt = $pdo->prepare("UPDATE user SET name = :name, nickname = :nickname, password = :password, 
            experience = :experience, email = :email, motorbike = :motorbike
            WHERE user_uuid = :user_uuid");
		$stmt->execute(array(
			'user_uuid' => Session::auth(),
			'name' => htmlspecialchars($user['name']),
			'nickname' => htmlspecialchars($user['nickname']),
			'password' => password_hash($user['password'], PASSWORD_DEFAULT),
			'experience' => $user['experience'],
			'email' => htmlspecialchars($user['email']),
			'motorbike' => htmlspecialchars($user['motorbike'])
		));
		Route::addlog('++');
	}

}