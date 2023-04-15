<?php
class View {
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	
	function generate($view, $data = null) {
		if (is_array($data)) {
			// преобразуем элементы массива в переменные
			extract($data);
		}
		include 'application/views/' . $view;
	}
}
?>