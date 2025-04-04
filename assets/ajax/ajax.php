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
    $imagem = @$_FILES['imagem'];

    $status = $model->createFicha($userId, $nome, $classe, $idade, $nacionalidade, $deslocamento,
        $jogador, $exposicao, $origem, $trilha, $imagem);
    die(json_encode($status));
}

if ($_POST['action'] == 'ficha-update') {
    $model = new \Models\FichaModel();

    $userId = $_SESSION['id'];
    $nome = $_POST['nome'];
    $classe = $_POST['classe'];
    $idade = $_POST['idade'];
    $nacionalidade = $_POST['nacionalidade'];
    $deslocamento = $_POST['deslocamento'];
    $exposicao = $_POST['exposicao'];
    $origem = $_POST['origem'];
    $trilha = $_POST['trilha'];
    $imagem = @$_FILES['imagem'];

    $status = $model->updateFicha($userId, $nome, $classe, $idade, 
        $nacionalidade, $deslocamento, $exposicao, $origem, $trilha, $imagem);
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

if ($_POST['action'] == 'power-delete') {
    $model = new \Models\FichaModel();

    $powerId = $_POST['powerid'];
    
    $status = $model->deletePower($powerId);
    die(json_encode($status));
}

if ($_POST['action'] == 'power-update') {
    $model = new \Models\FichaModel();

    $powerId = $_POST['powerid'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    $status = $model->updatePower($powerId, $name, $description);
    die(json_encode($status));
}

if ($_POST['action'] == 'attack-add') {
    $model = new \Models\FichaModel();

    $userId = $_SESSION['id'];

    $arma = $_POST['arma'];
    $tipo = $_POST['tipo'];
    $ataque = $_POST['ataque'];
    $alcance = $_POST['alcance'];
    $dano = $_POST['dano'];
    $critico = $_POST['critico'];
    $especial = $_POST['especial'];

    $arr = array($userId, $arma, $tipo, $ataque, $alcance, $dano, $critico, $especial);

    $status = $model->addAttack($arr);
    die(json_encode($status));
}

if ($_POST['action'] == 'attack-delete') {
    $model = new \Models\FichaModel();

    $ataqueId = $_POST['ataqueid'];
    
    $status = $model->deleteAttack($ataqueId);
    die(json_encode($status));
}

if ($_POST['action'] == 'attack-update') {
    $model = new \Models\FichaModel();

    $arma = $_POST['arma'];
    $tipo = $_POST['tipo'];
    $ataque = $_POST['ataque'];
    $alcance = $_POST['alcance'];
    $dano = $_POST['dano'];
    $critico = $_POST['critico'];
    $especial = $_POST['especial'];
    $ataqueId = $_POST['ataqueid'];
    $userId = $_SESSION['id'];

    $arr = array($arma, $tipo, $ataque, $alcance, $dano, $critico, $especial, 
    $ataqueId, $userId);
     
    $status = $model->updateAttack($arr);
    die(json_encode($status));
}

if ($_POST['action'] == 'inventory-add') {
    $model = new \Models\FichaModel();

    $userId = $_SESSION['id'];

    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $tipo = $_POST['tipo'];

    $arr = array($userId, $nome, $quantidade, $categoria, $tipo);

    $status = $model->addInventory($arr);
    die(json_encode($status));
}

if ($_POST['action'] == 'inventory-delete') {
    $model = new \Models\FichaModel();

    $inventarioId = $_POST['inventarioid'];
    
    $status = $model->deleteInventory($inventarioId);
    die(json_encode($status));
}

if ($_POST['action'] == 'inventory-update') {
    $model = new \Models\FichaModel();

    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $tipo = $_POST['tipo'];
    $inventarioId = $_POST['inventarioid'];
    $userId = $_SESSION['id'];

    $arr = array($nome, $quantidade, $categoria, $tipo, $inventarioId, $userId);
     
    $status = $model->updateInventory($arr);
    die(json_encode($status));
}

if ($_POST['action'] == 'update-bar') {
    $model = new \Models\FichaModel();

    $bar = $_POST['bar'];
    $current = $_POST['current'];
     
    $status = $model->updateBar($bar, $current);
    die(json_encode($status));
}

?>