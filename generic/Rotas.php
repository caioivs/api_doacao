<?php
namespace generic;

class Rotas {
    private $arrChamadas = [];

    public function __construct() {
        // --- API DOADORES / LOGIN ---
        $this->arrChamadas["api/login"] = new Endpoint("Auth", "login", false); 
        $this->arrChamadas["api/doacoes"] = new Endpoint("Doacao", "apiListar", true); 
        $this->arrChamadas["api/doacoes/criar"] = new Endpoint("Doacao", "apiCriar", true); 
        $this->arrChamadas["api/doacoes/editar"] = new Endpoint("Doacao", "apiEditar", true);
        $this->arrChamadas["api/doacoes/excluir"] = new Endpoint("Doacao", "apiExcluir", true);

        // --- API INSTITUIÇÕES (NOVO) ---
        // Vamos deixar público (false) para facilitar o cadastro inicial, ou protegido (true) se preferir
        $this->arrChamadas["api/instituicoes"] = new Endpoint("Instituicao", "apiListar", true); 
        $this->arrChamadas["api/instituicoes/criar"] = new Endpoint("Instituicao", "apiCriar", true); 
        $this->arrChamadas["api/instituicoes/editar"] = new Endpoint("Instituicao", "apiEditar", true);
        $this->arrChamadas["api/instituicoes/excluir"] = new Endpoint("Instituicao", "apiExcluir", true);
    }

    public function verificar($rota) {
        if (isset($this->arrChamadas[$rota])) {
            return $this->arrChamadas[$rota];
        }
        return null;
    }
}