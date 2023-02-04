<?php
namespace Models;
class MainModel {
    function load() {
        
    }

    function getVars() {
        return [
            'username' => $_SESSION['user']
        ];
    }
}
?>