<?php
namespace generic;
use PDO;

class MysqlSingleton {
    private static $instance = null;

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance == null) {
            try {
                // ALTERADO: dbname=api_doacoes
                self::$instance = new PDO('mysql:host=localhost;dbname=api_doacoes', 'root', '');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Exception $e) {
                die('Erro fatal de conexão: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}