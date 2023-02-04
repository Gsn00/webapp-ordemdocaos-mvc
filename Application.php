<?php
class Application {
    function execute() {
        include('views/pages/templates/header.php');

        if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            $class = new Controllers\MainController();
            $class->execute();
        } else {
            $class = new Controllers\LoginController();
            $class->execute();
        }

        include('views/pages/templates/footer.php');
    }

    static function includeCurrentPage() {
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