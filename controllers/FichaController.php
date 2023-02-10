<?php
namespace Controllers;
class FichaController extends Controller {
    function __construct() {
        $this->view = new \Views\View('ficha');
        $this->model = new \Models\FichaModel();
    }

    function execute() {
        $this->view->render($this->model->getVars());
    }
}
?>