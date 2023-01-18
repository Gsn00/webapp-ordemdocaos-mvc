<?php
namespace Controllers;
class HomeController extends Controller {
    function __construct() {
        $this->view = new \Views\View('home');
    }

    function execute() {
        $this->view->render();
    }
}
?>