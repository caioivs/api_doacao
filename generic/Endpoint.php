<?php
namespace generic;

class Endpoint {
    public $classe;
    public $metodo;
    public $autenticar;

    public function __construct($classe, $metodo, $autenticar = false) {
        $this->classe = "controller\\" . $classe;
        $this->metodo = $metodo;
        $this->autenticar = $autenticar;
    }
}