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
	 *   operationId="profile",
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

	/**
	 * @OA\Post(
	 *   path="/profile/edit",
	 *   tags={"profile"},
	 *   summary="Редактирование",
	 *   operationId="profile_edit",
	 *   description="Функционал в виде формы, позволяющий пользователю редактировать данные профиля.",
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
	function action_edit() {
		Session::safe_session_start();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			try {
				$this->model->edit_profile($_POST);
			}
			catch (LogicException $exception) {
				// Ошибка при редактировании данных
				$_SESSION['mbforum']['message']['profile'] = $exception->getMessage();

			}
			header('Location: /profile');
		}
		else {
			throw new Exception(405);
		}
		return null;
	}

}