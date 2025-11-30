<?php
namespace service;
use dao\mysql\DoadorDAO;
use generic\JWTAuth;

class AuthService {
    
    public function autenticar($email, $senha) {
        try {
            $dao = new DoadorDAO();
            // Aplica MD5 na senha para bater com o banco fornecido
            $senhaMd5 = md5($senha);
            
            $usuario = $dao->buscarPorEmailSenha($email, $senhaMd5);

            if ($usuario) {
                $jwt = new JWTAuth();
                // Cria o token com o ID do doador
                $token = $jwt->criarChave($usuario['id']);
                return ['sucesso' => true, 'token' => $token, 'usuario' => $usuario['nome']];
            }
            
            return ['sucesso' => false, 'erro' => 'Credenciais inválidas'];
        } catch (\Exception $e) {
            return ['sucesso' => false, 'erro' => $e->getMessage()];
        }
    }
}