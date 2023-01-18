<?php 

include('config.php');

include('pages/templates/header.php');

$app = new Application();
$app->execute();

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
	include('pages/templates/main.php');
} else {
	include('pages/templates/login.php');
}
include('pages/templates/footer.php');

?>