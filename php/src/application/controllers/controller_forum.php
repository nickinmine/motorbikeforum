<?php

class Controller_Forum extends Controller {

	function __construct() {
		parent::__construct();
		$this->model = new Model_Forum();
	}

	/**
	 * @OA\Get(
	 *   path="/forum",
	 *   tags={"forum"},
	 *   summary="Страница форума",
	 *   operationId="forum",
	 *   description="Страница, позволяющая пользователю просмотреть список форумов.",
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
	/*function action_index() {
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
	}*/

	/**
	 * @OA\Post(
	 *   path="/forum/create",
	 *   tags={"forum"},
	 *   summary="Создать тему",
	 *   operationId="forum_create",
	 *   description="Функционал в виде формы, позволяющий пользователю создать тему.",
	 *
	 *   @OA\Parameter(
	 *      name="user_uuid",
	 *      in="query",
	 *      required=true,
	 *      @OA\Schema(
	 *           type="string"
	 *      )
	 *   ),
	 *   @OA\Parameter(
	 *      name="header",
	 *      in="query",
	 *      required=true,
	 *      @OA\Schema(
	 *          type="string"
	 *      )
	 *   ),
	 *   @OA\Parameter(
	 *      name="content",
	 *      in="query",
	 *      required=true,
	 *      @OA\Schema(
	 *          type="string"
	 *      )
	 *   ),
	 *   @OA\Parameter(
	 *      name="tag",
	 *      in="query",
	 *      required=false,
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
	 *   )
	 *)
	 *
	 * @return null
	 * @throws Exception
	 */
	function action_create() {
		Session::safe_session_start();
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$data = $this->model->get_tag_list($_SESSION['mbforum']['message']);
			unset($_SESSION['mbforum']['message']);
			$this->view->generate('view_forum_create.php', $data);
		}
		else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->model->add_theme(Session::auth(), $_POST['header'], $_POST['content'], $_POST['tag']);
			header('Location: /forum');
		}
		else {
			throw new Exception(405);
		}
		return null;
	}

}