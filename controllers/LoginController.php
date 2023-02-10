<?php
namespace Controllers;
class LoginController extends Controller {
    function __construct() {
        $this->view = new \Views\View('templates/login');
        $this->model = new \Models\LoginModel();
    }

    function execute() {
        $this->view->render();
    }
}
?>