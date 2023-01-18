<?php

session_start();
define('PATH', 'http://localhost/Projetos%20Pessoais/OrdemDoCaos%20-%20MVC/');

$_SESSION['login'] = true; //Temporario (apenas para testes)

$autoload = function ($class) {
	require_once("$class.php");
};
spl_autoload_register($autoload);

?>