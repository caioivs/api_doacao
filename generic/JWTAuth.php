<?php
namespace generic;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTAuth {
    // Chave privada
    private string $key = "fhsdiofhjçoisdHJFIOHjsioçfhjoiEWHFIPÇi0fohwejoçfnweçiofhjopuiEWHFOEOIWFHopwie~fhoipçHJWEFPO";

    public function criarChave($dados) {
        $hora = time();
        $payload = [
            'iat' => $hora,
            'exp' => $hora + 180000, // Tempo maior conforme foto
            'uid' => $dados
        ];
        // Algoritmo HS256
        $jwt = JWT::encode($payload, $this->key, 'HS256');
        return $jwt;
    }

    public function verificar() {
        try {
            // Verifica se o cabeçalho existe (Apache)
            if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
                // Tenta pegar do apache_request_headers se não estiver no SERVER (fix comum)
                $headers = apache_request_headers();
                if (isset($headers['Authorization'])) {
                    $_SERVER['HTTP_AUTHORIZATION'] = $headers['Authorization'];
                } else {
                    return false;
                }
            }

            $autorizacao = $_SERVER['HTTP_AUTHORIZATION'];
            $token = str_replace('Bearer ', '', $autorizacao);
            
            // Decodifica
            $decodificar = JWT::decode($token, new Key($this->key, 'HS256'));
            
            // Verifica expiração
            $hora = time();
            if ($hora > $decodificar->exp) {
                return false;
            }

            return $decodificar;

        } catch (Exception $e) {
            return false;
        }
    }
}