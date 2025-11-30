<?php
namespace controller;
use service\AuthService;

class Auth {
    
    // O Acao.php vai injetar o que vier no JSON aqui
    public function login($email, $senha) {
        $service = new AuthService();
        return $service->autenticar($email, $senha);
    }
}