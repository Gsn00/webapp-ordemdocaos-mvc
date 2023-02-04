<?php
class MySQL {
    private static $pdo;

    private const HOST = 'localhost';
    private const DB = 'ordemdocaos';
    private const USER = 'root';
    private const PASSWORD = '';

    public static function connect() {
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO
                    ('mysql:host='.self::HOST.';dbname='.self::DB, self::USER, self::PASSWORD);
            } catch (Exception $ex) {
                echo 'Ocorreu um erro ao tentar se conectar com o banco de dados';
            }
        }
        return self::$pdo;
    }
}
?>