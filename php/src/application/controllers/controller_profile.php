<?php

/**
 * @OA\Schema(
 *     title="Controller_Profile",
 *     description="Контроллер для взаимодействия со страницей редактирования профиля",
 *     @OA\Xml(
 *         name="Controller_Profile"
 *     )
 * )
 */

class Controller_Profile extends Controller {

    public function __construct() {
        parent::__construct();
        $this->model = new Model_Profile();
    }

	/**
	 * @OA\Get(
	 *   path="/profile",
	 *   tags={"profile"},
	 *   summary="Страница редактирования профиля",
	 *   operationId="reg",
	 *   description="Страница, позволяющая пользователю выполнить редактирование профиля.",
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
			$data = $this->model->get_data();
			unset($_SESSION['mbforum']['message']);
		}
        $this->view->generate('view_profile.php', $data);
        return null;
    }

}