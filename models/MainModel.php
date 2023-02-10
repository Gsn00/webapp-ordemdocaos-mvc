<?php
namespace Models;
class MainModel extends Model {
    function load() {
        
    }

    function getVars() {
        return [
            'username' => $_SESSION['user']
        ];
    }
}
?>