<?php
namespace controller;
use service\DoacaoService;
use template\DoacaoTemp;

class Doacao {
    private $template;
    private $service;

    public function __construct() {
        $this->template = new DoacaoTemp();
        $this->service = new DoacaoService();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    // --- MVC WEB ---

    private function verificarLogin() {
        if (!isset($_SESSION['doador_id'])) {
            header("Location: /doacoes_alimentos/login/form");
            exit;
        }
    }

    public function listar() {
        try {
            $dados = ['lista' => $this->service->listarDoacoes()];
            $this->template->layout("public/doacao/listar.php", $dados);
        } catch (\Exception $e) {
            echo "Erro ao carregar dados: " . $e->getMessage();
        }
    }

    public function formulario() {
        $this->verificarLogin();
        $dados = [];
        if (isset($_GET['id'])) {
            try {
                $dados['doacao'] = $this->service->buscarDoacao($_GET['id']);
            } catch (\Exception $e) { echo $e->getMessage(); }
        }
        $this->template->layout("public/doacao/form.php", $dados);
    }

    public function salvar($titulo, $descricao, $quantidade, $data_validade) {
        $this->verificarLogin();
        $id = $_POST['id'] ?? null;
        try {
            $this->service->salvarDoacao($titulo, $descricao, $quantidade, $data_validade, $_SESSION['doador_id'], $id);
            header("Location: /doacoes_alimentos/doacao/listar");
        } catch (\Exception $e) {
            echo "<script>alert('".$e->getMessage()."'); history.back();</script>";
        }
    }

    public function excluir($id) {
        $this->verificarLogin();
        try {
            $this->service->excluirDoacao($id);
            header("Location: /doacoes_alimentos/doacao/listar");
        } catch (\Exception $e) {
            echo "<script>alert('".$e->getMessage()."'); history.back();</script>";
        }
    }

    // --- API ---

    public function apiListar() {
        try {
            return $this->service->listarDoacoes();
        } catch (\Exception $e) {
            // API Retorno JSON limpo em caso de erro
            return ['erro' => $e->getMessage()];
        }
    }

    public function apiCriar($titulo, $descricao, $quantidade, $data_validade) {
        // Pega ID do token JWT
        try {
            $doador_id = 1;
            $res = $this->service->salvarDoacao($titulo, $descricao, $quantidade, $data_validade, $doador_id);
            return ['sucesso' => true, 'mensagem' => 'Doação criada com sucesso'];
        } catch (\Exception $e) {
            return ['erro' => $e->getMessage()];
        }
    }

    public function apiEditar($id, $titulo, $descricao, $quantidade, $data_validade) {
        try {
            $doador_id = 1;

            $this->service->salvarDoacao($titulo, $descricao, $quantidade, $data_validade, $doador_id, $id);

            return ['sucesso' => true, 'mensagem' => 'Doação atualizada com sucesso'];
        } catch (\Exception $e) {
            return ['erro' => $e->getMessage()];
        }
    }

    public function apiExcluir($id) {
        try {
            $this->service->excluirDoacao($id);
            return ['sucesso' => true, 'mensagem' => 'Doação excluída com sucesso'];
        } catch (\Exception $e) {
            return ['erro' => $e->getMessage()];
        }
    }
}