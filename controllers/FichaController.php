<?php
namespace Controllers;
class FichaController extends Controller {
    function __construct() {
        $this->view = new \Views\View('ficha');
    }

    function execute() {
        $this->view->render();
    }
}
?>