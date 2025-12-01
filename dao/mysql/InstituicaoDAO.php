<?php
namespace dao\mysql;
use generic\MysqlFactory;
use PDO;

class InstituicaoDAO extends MysqlFactory {
    
    public function listar() {
        try {
            $sql = "SELECT id, nome, email, telefone, endereco, tipo FROM instituicoes ORDER BY nome ASC";
            return $this->banco->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar instituições");
        }
    }

    public function inserir($nome, $email, $senha, $telefone, $endereco, $tipo) {
        try {
            $sql = "INSERT INTO instituicoes (nome, email, senha, telefone, endereco, tipo) 
                    VALUES (:n, :e, :s, :t, :end, :tip)";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':n', $nome);
            $stmt->bindValue(':e', $email);
            $stmt->bindValue(':s', md5($senha)); // Criptografa senha
            $stmt->bindValue(':t', $telefone);
            $stmt->bindValue(':end', $endereco);
            $stmt->bindValue(':tip', $tipo);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao cadastrar instituição: " . $e->getMessage());
        }
    }

    public function atualizar($id, $nome, $email, $telefone, $endereco, $tipo) {
        try {
            $sql = "UPDATE instituicoes SET nome = :n, email = :e, telefone = :t, endereco = :end, tipo = :tip 
                    WHERE id = :id";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':n', $nome);
            $stmt->bindValue(':e', $email);
            $stmt->bindValue(':t', $telefone);
            $stmt->bindValue(':end', $endereco);
            $stmt->bindValue(':tip', $tipo);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar instituição");
        }
    }

    public function excluir($id) {
        try {
            // Remove solicitações vinculadas antes (conforme seu banco)
            $this->banco->query("DELETE FROM solicitacoes WHERE instituicao_id = $id");
            
            $sql = "DELETE FROM instituicoes WHERE id = :id";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir instituição");
        }
    }
}