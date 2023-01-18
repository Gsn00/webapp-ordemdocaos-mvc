<?php
class Application {
    function execute() {
        $url = isset($_GET['url']) ? explode('/', $_GET['url'])[0] : 'home';
        ucfirst($url);
        $url .= "Controller";
        if (file_exists("controllers/$url.php")) {
            $classPath = "Controllers\\$url";
            $class = new $classPath();
            $class->execute(); 
        } else {
            $class = new Controllers\NotFoundController();
            $class->execute(); 
        }
    }
}
?>