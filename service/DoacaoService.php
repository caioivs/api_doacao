<?php
namespace service;
use dao\mysql\DoacaoDAO;

class DoacaoService {
    private $dao;

    public function __construct() {
        $this->dao = new DoacaoDAO();
    }

    public function listar() {
        return $this->dao->listar();
    }

    public function criar($titulo, $descricao, $quantidade, $data_validade, $doador_id) {
        if (empty($titulo) || empty($descricao)) {
            throw new \Exception("Título e descrição são obrigatórios");
        }
        return $this->dao->inserir($titulo, $descricao, $quantidade, $data_validade, $doador_id);
    }

    public function editar($id, $titulo, $descricao, $quantidade, $data_validade) {
        return $this->dao->atualizar($id, $titulo, $descricao, $quantidade, $data_validade);
    }

    public function excluir($id) {
        return $this->dao->excluir($id);
    }
}
