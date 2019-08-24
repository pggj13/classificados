<?php

class homeController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['admins']) && empty($_SESSION['admins'])) {
            header("Location:" . BASE_URL . '/login');
        }
    }

    public function index() {

        $dados = array();
        $this->loadTemplate('home', $dados);
    }

    public function logout() {

        unset($_SESSION['admins']);
        header("Location:" . BASE_URL . '/login');
    }

}
