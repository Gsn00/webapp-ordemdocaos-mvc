<?php
namespace Models;
class LoginModel {
    function load() {
        //
    }

    function login($user, $password) {
        if (empty($user) || empty($password)) {
            return 'Nenhum campo pode ficar vazio.';
        }

        $sql = \MySQL::connect()->prepare("SELECT * FROM `tb_usuarios` WHERE usuario=?");
        $sql->execute(array($user));

        if ($sql->rowCount() > 0) {
            $info = $sql->fetch();
            if (password_verify($password, $info['senha'])) {
                $_SESSION['id'] = $info['id'];
                $_SESSION['user'] = $info['usuario'];
                $_SESSION['email'] = $info['email'];
                $_SESSION['password'] = $info['senha'];
                $_SESSION['login'] = true;
                header('Refresh: 0');  
            } else {
                return 'O usuário ou a senha está incorreto.';
            }
        } else {
            return 'Este usuário não existe.';
        }

        $_SESSION['rpg-list'] = array();
        $sql = \MySQL::connect()->prepare("SELECT * FROM `tb_rpg.ordemdocaos.players` WHERE jogador=?");
        $sql->execute(array($user));
        if ($sql->rowCount() > 0) {
            array_push($_SESSION['rpg-list'], 'ordemdocaos');

            $info = $sql->fetch();
            $_SESSION['ordemdocaos']['id'] = $info['id'];
            $_SESSION['ordemdocaos']['user_id'] = $info['user_id'];
            $_SESSION['ordemdocaos']['nome'] = $info['nome'];
            $_SESSION['ordemdocaos']['classe'] = $info['classe'];
            $_SESSION['ordemdocaos']['idade'] = $info['idade'];
            $_SESSION['ordemdocaos']['nacionalidade'] = $info['nacionalidade'];
            $_SESSION['ordemdocaos']['deslocamento'] = $info['deslocamento'];
            $_SESSION['ordemdocaos']['jogador'] = $info['jogador'];
            $_SESSION['ordemdocaos']['exposicao'] = $info['exposicao'];
            $_SESSION['ordemdocaos']['origem'] = $info['origem'];
            $_SESSION['ordemdocaos']['trilha'] = $info['trilha'];
            $_SESSION['ordemdocaos']['pe'] = $info['pe'];
            $_SESSION['ordemdocaos']['imagem'] = $info['imagem'];
            $_SESSION['ordemdocaos']['vida'] = $info['vida'];
            $_SESSION['ordemdocaos']['max_vida'] = $info['max_vida'];
            $_SESSION['ordemdocaos']['energia'] = $info['energia'];
            $_SESSION['ordemdocaos']['max_energia'] = $info['max_energia'];
            $_SESSION['ordemdocaos']['stamina'] = $info['stamina'];
            $_SESSION['ordemdocaos']['max_stamina'] = $info['max_stamina'];
        }

        return 'Sucesso';
    }

    function register($user, $email, $password, $passwordRepeat) {
        if (empty($user) || empty($email) || empty($password) || empty($passwordRepeat)) {
            return 'Nenhum campo pode ficar vazio.';
        }
        if (!str_contains($email, '@') || !str_contains($email, '.')) {
            return 'Insira um email válido.';
        }
        if (strlen($user) < 5) {
            return 'O usuário deve conter no mínimo 3 caracteres.';
        } 
        if (strlen($password) < 5) {
            return 'A senha deve conter no mínimo 5 caracteres.';
        } 
        if ($password !== $passwordRepeat) {
            return 'As senhas devem ser idênticas.';
        }

        $sql = \MySQL::connect()->prepare
            ("SELECT id FROM `tb_usuarios` WHERE usuario=?");
        $sql->execute(array($user));
        if ($sql->rowCount() > 0) {
            return 'Este usuário já está sendo utilizado.';
        }

        $sql = \MySQL::connect()->prepare
            ("SELECT id FROM `tb_usuarios` WHERE email=?");
        $sql->execute(array($email));
        if ($sql->rowCount() > 0) {
            return 'Este email já está sendo utilizado.';
        }

        $sql = \MySQL::connect()->prepare
            ("INSERT INTO `tb_usuarios` (id, usuario, email, senha) VALUES (null,?,?,?)");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql->execute(array($user, $email, $password));
        return 'Sucesso';
    }
}
?>