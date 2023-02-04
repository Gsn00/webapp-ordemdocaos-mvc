<?php
namespace Controllers;
class HomeController extends Controller {
    function __construct() {
        $this->view = new \Views\View('home');
        $this->model = new \Models\HomeModel();
    }

    function execute() {
        $this->view->render($this->model->getVars());
    }
}
?>