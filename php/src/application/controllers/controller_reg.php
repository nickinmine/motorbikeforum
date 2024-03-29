<?php

/**
 * @OA\Schema(
 *     title="Controller_Reg",
 *     description="Контроллер для взаимодействия со страницей регистрации",
 *     @OA\Xml(
 *         name="Controller_Reg"
 *     )
 * )
 */

class Controller_Reg extends Controller {

	function __construct() {
		parent::__construct();
		$this->model = new Model_Reg();
	}

	/**
	 * @OA\Get(
	 *   path="/reg",
	 *   tags={"reg"},
	 *   summary="Страница регистрации",
	 *   operationId="reg",
	 *   description="Страница, позволяющая пользователю выполнить регистрацию.",
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
		$this->view->generate('view_reg.php', $data);
		return null;
	}

	/**
	 * @OA\Post(
	 *   path="/reg/signup",
	 *   tags={"auth"},
	 *   summary="Вход",
	 *   operationId="auth_signin",
	 *   description="Функционал в виде формы, позволяющий пользователю выполнить регистрацию.",
	 *
	 *   @OA\Parameter(
	 *      name="name",
	 *      in="query",
	 *      required=true,
	 *      @OA\Schema(
	 *           type="string"
	 *      )
	 *   ),
	 *   @OA\Parameter(
	 *      name="nickname",
	 *      in="query",
	 *      required=true,
	 *      @OA\Schema(
	 *          type="string"
	 *      )
	 *   ),
	 *   @OA\Parameter(
	 *      name="experience",
	 *      in="query",
	 *      required=true,
	 *      @OA\Schema(
	 *          type="number"
	 *      )
	 *   ),
	 *   @OA\Parameter(
	 *      name="email",
	 *      in="query",
	 *      required=true,
	 *      @OA\Schema(
	 *          type="string"
	 *      )
	 *   ),
	 *   @OA\Parameter(
	 *      name="motorbike",
	 *      in="query",
	 *      required=false,
	 *      @OA\Schema(
	 *          type="string"
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
	 *     @OA\Parameter(
	 *      name="password2",
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
	 *      response=400,
	 *      description="Wrong data format",
	 *      @OA\MediaType(
	 *           mediaType="application/json",
	 *      )
	 *   )
	 *)
	 *
	 * @return null
	 * @throws Exception
	 */
	function action_signup() {
		Session::safe_session_start();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			try {
				$this->model->registration($_POST);
				header('Location: /auth');
			}
			catch (LogicException $exception) {
				// Ошибка при регистрации
				$_SESSION['mbforum']['message']['reg'] = $exception->getMessage();
				header('Location: /reg');
			}
		}
		else {
			throw new Exception(405);
		}
		return null;
	}

}