<?php
namespace controller;
use service\DoacaoService;

class Doacao {
    private $service;

    public function __construct() {
        $this->service = new DoacaoService();
    }

    public function apiListar() {
        try {
            return ['sucesso' => true, 'dados' => $this->service->listar()];
        } catch (\Exception $e) {
            return ['sucesso' => false, 'erro' => $e->getMessage()];
        }
    }

   
    public function apiCriar($titulo, $descricao, $quantidade, $data_validade, $doador_id) {
        try {

            $this->service->criar($titulo, $descricao, $quantidade, $data_validade, $doador_id);
            return ['sucesso' => true, 'mensagem' => 'Doação criada com sucesso'];
        } catch (\Exception $e) {
            return ['sucesso' => false, 'erro' => $e->getMessage()];
        }
    }


    public function apiEditar($id, $titulo, $descricao, $quantidade, $data_validade) {
        try {
            $this->service->editar($id, $titulo, $descricao, $quantidade, $data_validade);
            return ['sucesso' => true, 'mensagem' => 'Doação atualizada com sucesso'];
        } catch (\Exception $e) {
            return ['sucesso' => false, 'erro' => $e->getMessage()];
        }
    }


    public function apiExcluir($id) {
        try {
            $this->service->excluir($id);
            return ['sucesso' => true, 'mensagem' => 'Doação excluída com sucesso'];
        } catch (\Exception $e) {
            return ['sucesso' => false, 'erro' => $e->getMessage()];
        }
    }
}