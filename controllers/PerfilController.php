<?php
namespace Controllers;
class PerfilController extends Controller {
    function __construct() {
        $this->view = new \Views\View('perfil');
    }

    function execute() {
        $this->view->render();
    }
}
?>