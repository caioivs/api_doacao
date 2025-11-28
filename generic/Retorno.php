<?php
namespace generic;

class Retorno {
    public $sucesso;
    public $dados;
    public $erro;

    public function __construct($sucesso, $dados = null, $erro = null) {
        $this->sucesso = $sucesso;
        $this->dados = $dados;
        $this->erro = $erro;
    }

    public function toJson() {
        return json_encode($this);
    }
}