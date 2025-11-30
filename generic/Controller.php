<?php
namespace generic;

class Controller {
    private $rotas;

    public function __construct() {
        $this->rotas = new Rotas();
    }

    public function verificarChamadas($rota) {
        $endpoint = $this->rotas->verificar($rota);

        if ($endpoint) {
            // Verifica autenticação
            if ($endpoint->autenticar) {
                $jwt = new JWTAuth();
                $tokenValido = $jwt->verificar();
                
                if (!$tokenValido) {
                    http_response_code(401);
                    echo json_encode(["erro" => "Acesso não autorizado. Token inválido ou expirado."]);
                    return; 
                }
            }

            // Executa a ação do Controller Específico
            $acao = new Acao($endpoint->classe, $endpoint->metodo);
            $retorno = $acao->executar();

            // Retorna JSON sempre
            header("Content-Type: application/json");
            if ($retorno instanceof Retorno) {
                echo $retorno->toJson();
            } else {
                echo json_encode($retorno);
            }

        } else {
            http_response_code(404);
            echo json_encode(["erro" => "Rota '$rota' não encontrada."]);
        }
    }
}