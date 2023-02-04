<?php
namespace Models;
class HomeModel {
    function load() {
        
    }

    function getVars() {
        return [
            'username' => $_SESSION['user']
        ];
    }
}
?>