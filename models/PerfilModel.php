<?php
namespace Models;
class PerfilModel extends Model {
    function load() {
        //
    }

    function getVars() {
        return [
            'username' => $_SESSION['user'],
            'email' => $_SESSION['email']
        ];
    }
}
?>