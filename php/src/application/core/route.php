<?php

class Route {

	static function addlog($str) {
		//$tempdir = 'c:\prog\docker\MotorbikeForum\src'; // если есть такой каталог
		$tempdir = '';
		//if (!file_exists($tempdir)) // иначе
		//	$tempdir = sys_get_temp_dir(); // системный - c:\windows\temp
		$logfile = $tempdir .'!log.txt';
		$fd = fopen($logfile, 'a+');
		if ($fd) {
			date_default_timezone_set("Europe/Moscow");
			fwrite($fd, date("Y-m-d H:i:s") . " " . $str . "\r\n");
			fclose($fd);
		}
	}

	/**
	 * @throws Exception
	 */
	static function start() {
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		// Route::addlog($_SERVER['REQUEST_URI']);
		$url = explode('?', $_SERVER['REQUEST_URI']);
		$routes = explode('/', $url[0]);
		
		// получаем имя контроллера (первый параметр)
		if (!empty($routes[1])) {   	
			$controller_name = $routes[1];
		}

		// получаем один идентификатор для API
		/*$id = '';
		if (!empty($routes[2])) {
			$id = $routes[2];
		}*/

		// получаем имя экшена (второй параметр)
		if (!empty($routes[2])) {
			$action_name = $routes[2];
		}

		// добавляем префиксы
		$model_name = 'Model_' . $controller_name;
		$controller_name = 'Controller_' . $controller_name;
		$action_name = 'action_' . $action_name;

		// подцепляем файл с классом модели (файла модели может и не быть, тогда цепляется Model_Main)
		$model_file = strtolower($model_name) . '.php';
		$model_path = "application/models/" . $model_file;
		if (file_exists($model_path)) {
			include "application/models/" . $model_file;
		}
		else {
			include "application/models/" . 'model_main.php';
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name) . '.php';
		$controller_path = "application/controllers/" . $controller_file;

		if (file_exists($controller_path)) {
			include "application/controllers/" . $controller_file;
		}
		else {
			// контроллер не найден
			throw new LogicException(404);
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		
		if (method_exists($controller, $action)) {
			// вызываем действие контроллера
			$controller->$action();
		}
		else {
			// экшен не найден
			throw new LogicException(404);
		}
	
	}
}

?>