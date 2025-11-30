<?php
namespace generic;

class Rotas {
    private $arrChamadas = [];

    public function __construct() {
        // --- API (REST) ---
        
        // Rota de Login (Pública) -> Controller: Auth, Método: login
        $this->arrChamadas["api/login"] = new Endpoint("Auth", "login", false); 

        // Rota de Listar Doações (Protegida) -> Controller: Doacao, Método: apiListar
        $this->arrChamadas["api/doacoes"] = new Endpoint("Doacao", "apiListar", true); 
        
        // Rota de Criar Doação (Protegida) -> Controller: Doacao, Método: apiCriar
        $this->arrChamadas["api/doacoes/criar"] = new Endpoint("Doacao", "apiCriar", true); 
        
        // Rota de Editar Doação (Protegida) -> Controller: Doacao, Método: apiEditar
        $this->arrChamadas["api/doacoes/editar"] = new Endpoint("Doacao", "apiEditar", true);
        
        // Rota de Excluir Doação (Protegida) -> Controller: Doacao, Método: apiExcluir
        $this->arrChamadas["api/doacoes/excluir"] = new Endpoint("Doacao", "apiExcluir", true);
    }

    public function verificar($rota) {
        if (isset($this->arrChamadas[$rota])) {
            return $this->arrChamadas[$rota];
        }
        return null;
    }
}