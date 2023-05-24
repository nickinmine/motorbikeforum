<?php

class Controller_Main extends Controller {

	public function __construct() {
		parent::__construct();
		$this->model = new Model_Main();
	}

	/**
	 * @OA\Get(
	 *   path="/",
	 *   tags={""},
	 *   summary="Главная страница",
	 *   operationId="auth",
	 *   description="Страница, позволяющая оператору выполнить авторизацию или выйти из аккаунта.",
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
		$data = $this->model->get_data();
		$this->view->generate('view.php', $data);
		return null;
	}

}