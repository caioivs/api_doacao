<?php
namespace service;
use dao\mysql\InstituicaoDAO;

class InstituicaoService {
    private $dao;

    public function __construct() {
        $this->dao = new InstituicaoDAO();
    }

    public function listar() {
        return $this->dao->listar();
    }

    public function criar($nome, $email, $senha, $telefone, $endereco, $tipo) {
        if (empty($nome) || empty($email) || empty($senha)) {
            throw new \Exception("Nome, email e senha são obrigatórios");
        }
        return $this->dao->inserir($nome, $email, $senha, $telefone, $endereco, $tipo);
    }

    public function editar($id, $nome, $email, $telefone, $endereco, $tipo) {
        return $this->dao->atualizar($id, $nome, $email, $telefone, $endereco, $tipo);
    }

    public function excluir($id) {
        return $this->dao->excluir($id);
    }
}