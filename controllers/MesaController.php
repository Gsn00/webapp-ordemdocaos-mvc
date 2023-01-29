<?php
namespace Controllers;
class MesaController extends Controller {
    function __construct() {
        $this->view = new \Views\View('mesa');
    }

    function execute() {
        $this->view->render();
    }
}
?>