<?php 

include('config.php');

include('views/pages/templates/header.php');

$app = new Application();
$app->execute();

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
	include('views/pages/templates/main.php');
} else {
	include('views/pages/templates/login.php');
}
include('views/pages/templates/footer.php');

?>