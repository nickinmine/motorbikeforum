<?php

class Controller_Users extends Controller {

	public function __construct() {
		parent::__construct();
		$this->model = new Model_Users();
	}

	/**
	 * @OA\Get(
	 *   path="/",
	 *   tags={"users"},
	 *   summary="Страница со списком пользователей",
	 *   operationId="users",
	 *   description="Страница, позволяющая админу просмотреть список пользователей.",
	 *
	 *   @OA\Response(
	 *      response=200,
	 *      description="Success",
	 *      @OA\MediaType(
	 *           mediaType="html",
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
	public function action_index() {
		Session::safe_session_start();
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$data = $this->model->get_data();
			unset($_SESSION['mbforum']['message']);
		}
		else {
			throw new Exception(405);
		}
		$this->view->generate('view.php', $data);
		return null;
	}

}