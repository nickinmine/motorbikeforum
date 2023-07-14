<?php

class Controller_Profile extends Controller {

    public function __construct() {
        parent::__construct();
        //$this->model = new Model_Profile();
    }

    public function action_index() {
        Session::safe_session_start();
        $this->view->generate('view_profile.php', $data = null);
        return null;
    }

}