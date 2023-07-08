<?php
class View {

	function generate($view, $data = null) {
		include 'application/views/' . $view;
	}

}