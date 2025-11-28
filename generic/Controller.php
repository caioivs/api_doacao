<?php
namespace generic;

class Controller {
    private $rotas;

    public function __construct() {
        $this->rotas = new Rotas();
    }

    public function verificarChamadas($rota) {
        // 1. Busca a configuração da rota 
        $endpoint = $this->rotas->verificar($rota);

        if ($endpoint) {
            // 2. Verifica se a rota exige autenticação
            if ($endpoint->autenticar) {
                
                // Verifica se é uma chamada de API (pelo prefixo) ou Web
                
                if (strpos($rota, 'api/') === 0) {
                    $jwt = new JWTAuth();
                    $tokenValido = $jwt->verificar();
                    
                    if (!$tokenValido) {
                        http_response_code(401);
                        echo json_encode(["erro" => "Acesso não autorizado. Token inválido."]);
                        return; 
                    }
                } else {
                    // Lógica Sessão (WEB)
                    if (session_status() === PHP_SESSION_NONE) session_start();
                    if (!isset($_SESSION['usuario_id'])) {
                        header("Location: /mvc_votacao/login/form");
                        exit;
                    }
                }
            }

            // Se passou pela segurança, Executa a Ação
            $acao = new Acao($endpoint->classe, $endpoint->metodo);
            $retorno = $acao->executar();

            // 4. Se for API, retorna JSON
            if (strpos($rota, 'api/') === 0) {
                header("Content-Type: application/json");
                // Se o retorno for um objeto Retorno, usa toJson, senão encode normal
                if ($retorno instanceof Retorno) {
                    echo $retorno->toJson();
                } else {
                    echo json_encode($retorno);
                }
            }

        } else {
            echo "<h1>Erro 404</h1><p>Rota '$rota' não encontrada.</p>";
        }
    }
}