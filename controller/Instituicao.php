<?php
namespace controller;
use service\InstituicaoService;

class Instituicao {
    private $service;

    public function __construct() {
        $this->service = new InstituicaoService();
    }

    public function apiListar() {
        try {
            return ['sucesso' => true, 'dados' => $this->service->listar()];
        } catch (\Exception $e) {
            return ['sucesso' => false, 'erro' => $e->getMessage()];
        }
    }

    public function apiCriar($nome, $email, $senha, $telefone, $endereco, $tipo) {
        try {
            $this->service->criar($nome, $email, $senha, $telefone, $endereco, $tipo);
            return ['sucesso' => true, 'mensagem' => 'Instituição cadastrada com sucesso'];
        } catch (\Exception $e) {
            return ['sucesso' => false, 'erro' => $e->getMessage()];
        }
    }

    public function apiEditar($id, $nome, $email, $telefone, $endereco, $tipo) {
        try {
            $this->service->editar($id, $nome, $email, $telefone, $endereco, $tipo);
            return ['sucesso' => true, 'mensagem' => 'Instituição atualizada com sucesso'];
        } catch (\Exception $e) {
            return ['sucesso' => false, 'erro' => $e->getMessage()];
        }
    }

    public function apiExcluir($id) {
        try {
            $this->service->excluir($id);
            return ['sucesso' => true, 'mensagem' => 'Instituição excluída com sucesso'];
        } catch (\Exception $e) {
            return ['sucesso' => false, 'erro' => $e->getMessage()];
        }
    }
}