<?php
namespace Controllers;
class PerfilController extends Controller {
    function __construct() {
        $this->view = new \Views\View('perfil');
        $this->model = new \Models\PerfilModel();
    }

    function execute() {
        $this->view->render($this->model->getVars());
    }
}
?>