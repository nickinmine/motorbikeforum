<?php

class Controller_Main extends Controller {

	public function __construct() {
		parent::__construct();
		$this->model = new Model_Main();
	}

	/**
	 * @OA\Get(
	 *   path="/",
	 *   tags={"main"},
	 *   summary="Главная страница",
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
	public function action_index() {
		Session::safe_session_start();
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$data = $this->model->get_data('hello world');
			unset($_SESSION['mbforum']['message']);
		}
		else {
			throw new Exception(405);
		}
		$this->view->generate('view.php', $data);
		return null;
	}

}