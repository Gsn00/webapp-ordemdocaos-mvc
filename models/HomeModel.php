<?php
namespace Models;
class HomeModel extends Model {
    function load() {
        
    }

    function getVars() {
        return [
            'username' => $_SESSION['user']
        ];
    }
}
?>