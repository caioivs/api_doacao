<?php
namespace template;
class IdeiaTemp implements ITemplate {
    public function layout($caminho, $dados = null) {
        if ($dados) extract($dados);
        if (session_status() === PHP_SESSION_NONE) session_start();
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <title>Votação MVC</title>
            <link rel="stylesheet" href="/mvc_votacao/public/css/style.css">
        </head>
        <body>
            <header>
                <h1>Sistema de Ideias</h1>
                <nav>
                    <a href="/mvc_votacao/home">Início</a>
                    <a href="/mvc_votacao/ideia/listar">Ver Ideias</a>
                    <?php if(isset($_SESSION['usuario_id'])): ?>
                        <a href="/mvc_votacao/ideia/formulario">Nova Ideia</a>
                        <span class="user-info">Olá, <?= $_SESSION['usuario_nome'] ?></span>
                        <a href="/mvc_votacao/login/sair" class="btn-logout">Sair</a>
                    <?php else: ?>
                        <a href="/mvc_votacao/login/form">Login</a>
                    <?php endif; ?>
                </nav>
            </header>
            <div class="container"><?php include $caminho; ?></div>
        </body>
        </html>
        <?php
    }
}