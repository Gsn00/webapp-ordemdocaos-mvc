<?php
namespace Controllers;
class MainController extends Controller {
    function __construct() {
        $this->view = new \Views\View('templates/main');
        $this->model = new \Models\MainModel();
    }

    function execute() {
        $this->view->render($this->model->getVars());
        $this->model->load();
    }
}
?>