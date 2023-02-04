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
    //Salvar apenas o diretorio no banco de dados e fazer upload da imagem no server
    $imagem = $_POST['imagem'];
    $vida = $_POST['vida'];
    $energia = $_POST['energia'];
    $stamina = $_POST['stamina'];

    $status = $model->createFicha($userId, $nome, $classe, $idade, $nacionalidade, $deslocamento,
        $jogador, $exposicao, $origem, $trilha, $pe, $imagem, $vida, $energia, $stamina);
    die(json_encode($status));
}
?>