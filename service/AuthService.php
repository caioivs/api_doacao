<?php
namespace service;
use dao\mysql\UsuarioDAO;
use generic\JWTAuth;

class AuthService {
    public function autenticar($email, $senha) {
        try {
            $dao = new UsuarioDAO();
            $usuario = $dao->buscarPorEmailSenha($email, $senha);

            if ($usuario) {
                $jwt = new JWTAuth();
                $token = $jwt->criarChave($usuario['id']);
                return ['token' => $token, 'sucesso' => true];
            }
            return ['erro' => 'Credenciais inválidas'];
        } catch (\Exception $e) {
            return ['erro' => $e->getMessage()];
        }
    }
}