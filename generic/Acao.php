<?php
namespace generic;
use ReflectionMethod;

class Acao {
    private $classe;
    private $metodo;

    public function __construct($classe, $metodo) {
        $this->classe = $classe;
        $this->metodo = $metodo;
    }

    public function executar() {
        $obj = new $this->classe();
        $reflectMetodo = new ReflectionMethod($this->classe, $this->metodo);
        $parametros = $reflectMetodo->getParameters();
        $para = [];

        foreach ($parametros as $v) {
            $name = $v->getName();
            $valor = $_REQUEST[$name] ?? null;
            $para[$name] = $valor;
        }
        return $reflectMetodo->invokeArgs($obj, $para);
    }
}