<?php
namespace service;
use dao\mysql\IdeiaDAO;

class IdeiaService {
    private $dao;

    public function __construct() {
        $this->dao = new IdeiaDAO();
    }

    public function listarIdeias() {
        try {
            return $this->dao->listar();
        } catch (\Exception $e) {
            throw $e; // Repassa exceção para o Controller tratar
        }
    }

    public function buscarIdeia($id) {
        try {
            return $this->dao->buscarPorId($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function salvarIdeia($titulo, $descricao, $usuario_id, $id = null) {
        if (empty($titulo) || empty($descricao)) {
            throw new \Exception("Campos obrigatórios não preenchidos");
        }
        try {
            if ($id) {
                return $this->dao->atualizar($id, $titulo, $descricao);
            } else {
                return $this->dao->inserir($titulo, $descricao, $usuario_id);
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function excluirIdeia($id) {
        try {
            return $this->dao->excluir($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function votar($usuario_id, $ideia_id) {
        try {
            return $this->dao->registrarVoto($usuario_id, $ideia_id);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}