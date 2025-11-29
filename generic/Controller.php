<?php
namespace generic;

class Controller {
    private $rotas;

    public function __construct() {
        $this->rotas = new Rotas();
    }

    public function verificarChamadas($rota) {
        // 1. Busca a configuração da rota
        $retorno = $this->rotas->executar($rota);

        if ($retorno) {
            // 2. Verifica se a rota exige autenticação
            // Nota: A autenticação agora é verificada dentro do Acao->executar(), mas mantemos a lógica aqui para compatibilidade
            // Para rotas API, assumimos que o endpoint tem autenticar
            if (strpos($rota, 'api/') === 0) {
                // Verifica autenticação JWT para API
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

            // 3. Se for API, retorna JSON
            if (strpos($rota, 'api/') === 0) {
                header("Content-Type: application/json");
                echo $retorno->toJson();
            } else {
                // Para web, echo os dados
                echo $retorno->dados;
            }

        } else {
            echo "<h1>Erro 404</h1><p>Rota '$rota' não encontrada.</p>";
        }
    }
}