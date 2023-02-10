<?php
include('../../config.php');

if ($_POST['action'] == 'disconnect') {
    session_destroy();
    die(json_encode(PATH));
}

if ($_POST['action'] == 'register') {
    $model = new \Models\LoginModel();
    $status = $model->register($_POST['user'], $_POST['email'], $_POST['password'], $_POST['passwordRepeat']);
    die(json_encode($status));
}

if ($_POST['action'] == 'login') {
    $model = new \Models\LoginModel();
    $status = $model->login($_POST['user'], $_POST['password']);
    die(json_encode($status));
}

if ($_POST['action'] == 'ficha-create') {
    $model = new \Models\FichaModel();

    $userId = $_SESSION['id'];
    $nome = $_POST['nome'];
    $classe = $_POST['classe'];
    $idade = $_POST['idade'];
    $nacionalidade = $_POST['nacionalidade'];
    $deslocamento = $_POST['deslocamento'];
    $jogador = $_SESSION['user'];
    $exposicao = $_POST['exposicao'];
    $origem = $_POST['origem'];
    $trilha = $_POST['trilha'];
    $pe = $_POST['pe'];
    $imagem = @$_FILES['imagem'];
    $vida = $_POST['vida'];
    $energia = $_POST['energia'];
    $stamina = $_POST['stamina'];

    $status = $model->createFicha($userId, $nome, $classe, $idade, $nacionalidade, $deslocamento,
        $jogador, $exposicao, $origem, $trilha, $pe, $imagem, $vida, $energia, $stamina);
    die(json_encode($status));
}

if ($_POST['action'] == 'attributes-update') {
    $model = new \Models\FichaModel();

    $attributes = json_decode($_POST['attributes'], true);
    $array = [];

    foreach($attributes as $key => $val) {
        foreach($attributes[$key] as $key2 => $value2) {
            $array[$key2] = $value2;
        }
    }
    
    $status = $model->updateAttributes($array);
    die(json_encode($status));
}

if ($_POST['action'] == 'skills-update') {
    $model = new \Models\FichaModel();

    $skills = json_decode($_POST['skills'], true);
    $array = [];

    foreach($skills as $key => $val) {
        foreach($skills[$key] as $key2 => $value2) {
            $array[$key2] = $value2;
        }
    }
    
    $status = $model->updateSkills($array);
    die(json_encode($status));
}

if ($_POST['action'] == 'power-add') {
    $model = new \Models\FichaModel();

    $name = $_POST['name'];
    $description = $_POST['description'];
    
    $status = $model->addPower($name, $description);
    die(json_encode($status));
}
?>