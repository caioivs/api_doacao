<?php
namespace generic;
abstract class MysqlFactory {
    protected $banco;
    public function __construct() {
        $this->banco = MysqlSingleton::getInstance();
    }
}