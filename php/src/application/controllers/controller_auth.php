<?php

class Controller_Auth extends Controller {

	function __construct() {
		parent::__construct();
		$this->model = new Model_Auth();
	}

	/**
	 * @OA\Get(
	 *   path="/auth",
	 *   tags={"auth"},
	 *   summary="Страница авторизации",
	 *   operationId="auth",
	 *   description="Страница, позволяющая пользователю выполнить авторизацию или выйти из аккаунта.",
	 *
	 *   @OA\Response(
	 *      response=200,
	 *      description="Success",
	 *      @OA\MediaType(
	 *           mediaType="html",
	 *      )
	 *   )
	 *)
	 *
	 * @return null
	 * @throws Exception
	 */
	function action_index() {
		Session::safe_session_start();
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$data = $this->model->get_data($_SESSION['mbforum']['message']);
			unset($_SESSION['mbforum']['message']);
		}
		else {
			throw new Exception(405);
		}
		$this->view->generate('view_auth.php', $data);
		return null;
	}

	/**
	 * @OA\Post(
	 *   path="/auth/signin",
	 *   tags={"auth"},
	 *   summary="Вход",
	 *   operationId="auth_signin",
	 *   description="Функционал в виде формы, позволяющий пользователю выполнить авторизацию.",
	 *
	 *   @OA\Parameter(
	 *      name="login",
	 *      in="query",
	 *      required=true,
	 *      @OA\Schema(
	 *           type="string"
	 *      )
	 *   ),
	 *   @OA\Parameter(
	 *      name="password",
	 *      in="query",
	 *      required=true,
	 *      @OA\Schema(
	 *          type="string"
	 *      )
	 *   ),
	 *   @OA\Response(
	 *      response=200,
	 *      description="Success",
	 *      @OA\MediaType(
	 *           mediaType="application/json",
	 *      )
	 *   ),
	 *   @OA\Response(
	 *      response=403,
	 *      description="Wrong login or password",
	 *      @OA\MediaType(
	 *           mediaType="application/json",
	 *      )
	 *   )
	 *)
	 *
	 * @return null
	 * @throws Exception
	 */
	function action_signin() {
		Session::safe_session_start();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			try {
				// Если пользователь уже был авторизован, то сначала надо выйти
				if (array_key_exists('token', $_COOKIE)) {
					$this->action_signout();
				}
				$token = $this->model->signin($_POST['login'], $_POST['password']);
				// Кладем в куки токен пользователя, время жизни 7 дней
				setcookie('token', $token, time() + 60*60*24*7, '/');
				header('Location: /');
			}
			catch (LogicException $exception) {
				// Неверный пароль: вход не выполнен
				$_SESSION['mbforum']['message']['auth'] = $exception->getMessage();
				header('Location: /auth');
			}
		}
		else {
			throw new Exception(405);
		}
		return null;
	}

	/**
	 * @OA\Post(
	 *   path="/auth/signout",
	 *   tags={"auth"},
	 *   summary="Выход",
	 *   operationId="auth_signout",
	 *   description="Функционал в виде ссылки, позволяющий пользователю выйти из аккаунта.",
	 *
	 *   @OA\Response(
	 *      response=200,
	 *      description="Success",
	 *      @OA\MediaType(
	 *           mediaType="application/json",
	 *      )
	 *   )
	 *)
	 *
	 * @return null
	 * @throws Exception
	 */
	function action_signout() {
		Session::safe_session_start();
		unset($_SESSION);
		$this->model->signout($_COOKIE['token']);
		setcookie('token', '', 1, '/');
		header('Location: /auth');
		return null;
	}

}