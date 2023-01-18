<?php
namespace Controllers;
class NotFoundController extends Controller {
    function __construct() {
        $this->view = new \Views\View('templates/404');
    }

    function execute() {
        $this->view->render();
    }
}
?>