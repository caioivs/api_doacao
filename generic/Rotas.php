<?php
namespace generic;

class Rotas {
    private $arrChamadas = [];

    public function __construct() {
        // "Rota" => new Endpoint("ClasseController", "metodo", PRECISA_LOGIN?)
        
        // --- WEB (MVC) ---
        $this->arrChamadas["home"] = new Endpoint("Home", "index", false);
        
        $this->arrChamadas["login/form"] = new Endpoint("Auth", "formLogin", false);
        $this->arrChamadas["login/autenticar"] = new Endpoint("Auth", "autenticarWeb", false);
        $this->arrChamadas["login/sair"] = new Endpoint("Auth", "logout", false);

        // Ideias (Listar é público, o resto requer login = true)
        $this->arrChamadas["ideia/listar"] = new Endpoint("Ideia", "listar", false);
        $this->arrChamadas["ideia/formulario"] = new Endpoint("Ideia", "formulario", true);
        $this->arrChamadas["ideia/salvar"] = new Endpoint("Ideia", "salvar", true);
        $this->arrChamadas["ideia/excluir"] = new Endpoint("Ideia", "excluir", true);
        $this->arrChamadas["ideia/votar"] = new Endpoint("Ideia", "votar", true);

        // --- API (REST) ---
        $this->arrChamadas["api/login"] = new Endpoint("Auth", "login", false); // Login é público
        $this->arrChamadas["api/doacoes"] = new Endpoint("Doacao", "apiListar", true); // Listar via API é protegido
        $this->arrChamadas["api/doacoes/criar"] = new Endpoint("Doacao", "apiCriar", true); // Criar é protegido
        $this->arrChamadas["api/doacoes/editar"] = new Endpoint("Doacao", "apiEditar", true);
        $this->arrChamadas["api/doacoes/excluir"] = new Endpoint("Doacao", "apiExcluir", true);
        $this->arrChamadas["api/instituicoes/solicitar"] = new Endpoint("Instituicao", "solicitar", true);
    }

    // Retorna o OBJETO Endpoint, não executa mais direto
    public function verificar($rota) {
        if (isset($this->arrChamadas[$rota])) {
            return $this->arrChamadas[$rota];
        }
        return null;
    }
}