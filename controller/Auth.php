<?php
namespace controller;
use service\AuthService;
use template\IdeiaTemp;

class Auth {
    
    // API Endpoint
    public function login($email, $senha) {
        $service = new AuthService();
        return $service->autenticar($email, $senha);
    }

    // Web Login
    public function formLogin() {
        $template = new IdeiaTemp();
        $template->layout("public/login.php");
    }

    public function autenticarWeb($email, $senha) {
        $dao = new \dao\mysql\UsuarioDAO();
        try {
            $usuario = $dao->buscarPorEmailSenha($email, $senha);
            if ($usuario) {
                if (session_status() === PHP_SESSION_NONE) session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                header("Location: /mvc_votacao/ideia/listar");
            } else {
                echo "<script>alert('Login inválido'); window.location='/mvc_votacao/login/form';</script>";
            }
        } catch (\Exception $e) {
            echo "Erro de sistema: " . $e->getMessage();
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();
        header("Location: /mvc_votacao/home");
    }
}