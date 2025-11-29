<?php

namespace generic;

class Rotas
{
    private $endpoints = [];

    public function __construct()
    {
        // rotas para o acesso as chamadas
        $this->endpoints = [
            "cliente" => new Acao([
                Acao::POST => new Endpoint("Cliente", "inserir"),
                Acao::GET => new Endpoint("Cliente", "listar")
            ]),
            "alunos" => new Acao([
                
                Acao::GET => new Endpoint("Aluno", "teste")
            ]),
            // --- WEB (MVC) ---
            "home" => new Acao([
                Acao::GET => new Endpoint("Home", "index", false)
            ]),
            "login/form" => new Acao([
                Acao::GET => new Endpoint("Auth", "formLogin", false)
            ]),
            "login/autenticar" => new Acao([
                Acao::POST => new Endpoint("Auth", "autenticarWeb", false)
            ]),
            "login/sair" => new Acao([
                Acao::GET => new Endpoint("Auth", "logout", false)
            ]),
            // Ideias (Listar é público, o resto requer login = true)
            "ideia/listar" => new Acao([
                Acao::GET => new Endpoint("Ideia", "listar", false)
            ]),
            "ideia/formulario" => new Acao([
                Acao::GET => new Endpoint("Ideia", "formulario", true)
            ]),
            "ideia/salvar" => new Acao([
                Acao::POST => new Endpoint("Ideia", "salvar", true)
            ]),
            "ideia/excluir" => new Acao([
                Acao::DELETE => new Endpoint("Ideia", "excluir", true)
            ]),
            "ideia/votar" => new Acao([
                Acao::POST => new Endpoint("Ideia", "votar", true)
            ]),
            // --- API (REST) ---
            "api/login" => new Acao([
                Acao::POST => new Endpoint("Auth", "login", false) // Login é público
            ]),
            "api/doacoes" => new Acao([
                Acao::GET => new Endpoint("Doacao", "apiListar", true), // Listar via API é protegido
                Acao::POST => new Endpoint("Doacao", "apiCriar", true) // Criar é protegido
            ]),
            "api/doacoes/editar" => new Acao([
                Acao::PUT => new Endpoint("Doacao", "apiEditar", true)
            ]),
            "api/doacoes/excluir" => new Acao([
                Acao::DELETE => new Endpoint("Doacao", "apiExcluir", true)
            ]),
            "api/instituicoes/solicitar" => new Acao([
                Acao::POST => new Endpoint("Instituicao", "solicitar", true)
            ])
        ];
    }

    public function executar($rota)
    {
        // verifica o array associativo se a rota existe
        if (isset($this->endpoints[$rota])) {
            
            $endpoint = $this->endpoints[$rota];
            $dados = $endpoint->executar();
            $retorno = new Retorno();
            $retorno ->dados = $dados;
            return $retorno;
        }

        return null;
    }
}
