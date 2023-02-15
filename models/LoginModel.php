<?php
namespace Models;
class LoginModel extends Model {

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
            return 'O usuário deve conter no mínimo 5 caracteres.';
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

        $sql = \MySQL::connect()->prepare ("INSERT INTO `tb_usuarios` VALUES (null,?,?,?)");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql->execute(array($user, $email, $password));
        return 'Sucesso';
    }
}
?>