<?php
namespace generic;
use PDO;

class MysqlSingleton {
    private static $instance = null;

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance == null) {
            try {
                self::$instance = new PDO('mysql:host=localhost;dbname=mvc_votacao', 'root', '');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Exception $e) {
                die('Erro fatal de conexão.');
            }
        }
        return self::$instance;
    }
}