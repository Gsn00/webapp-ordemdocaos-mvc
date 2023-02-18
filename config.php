<?php

session_set_cookie_params(0, '/', 'localhost', true, true);
session_start();
session_regenerate_id(true);
define('PATH', 'http://localhost/Projetos%20Pessoais/OrdemDoCaos%20-%20MVC/');

$autoload = function ($class) {
	if ($class == 'MySQL') {
		require_once("classes/$class.php");
		return;
	}
	if ($class == "Utils") {
		require_once("classes/$class.php");
		return;
	}
	require_once("$class.php");
};
spl_autoload_register($autoload);

?>