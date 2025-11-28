<?php
namespace dao;

interface IIdeiaDAO {
    public function listar();
    public function inserir($titulo, $descricao, $usuario_id);
    public function excluir($id);
}