<?php
namespace Models;
class PerfilModel {
    function load() {
        
    }

    function getVars() {
        return [
            'username' => $_SESSION['user'],
            'email' => $_SESSION['email']
        ];
    }
}
?>