<?php
namespace dao\mysql;
use generic\MysqlFactory;
use PDO;

class DoacaoDAO extends MysqlFactory {
    
    public function listar() {
        try {
            // Traz também o nome do doador fazendo JOIN
            $sql = "SELECT d.*, do.nome as nome_doador 
                    FROM doacoes d 
                    JOIN doadores do ON d.doador_id = do.id 
                    ORDER BY d.id DESC";
            return $this->banco->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar doações");
        }
    }

    public function inserir($titulo, $descricao, $quantidade, $data_validade, $doador_id) {
        try {
            $sql = "INSERT INTO doacoes (titulo, descricao, quantidade, data_validade, status, doador_id) 
                    VALUES (:ti, :de, :qt, :dt, 'disponivel', :do)";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':ti', $titulo);
            $stmt->bindValue(':de', $descricao);
            $stmt->bindValue(':qt', $quantidade);
            $stmt->bindValue(':dt', $data_validade);
            $stmt->bindValue(':do', $doador_id);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao inserir doação: " . $e->getMessage());
        }
    }

    public function atualizar($id, $titulo, $descricao, $quantidade, $data_validade) {
        try {
            $sql = "UPDATE doacoes SET titulo = :ti, descricao = :de, quantidade = :qt, data_validade = :dt 
                    WHERE id = :id";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':ti', $titulo);
            $stmt->bindValue(':de', $descricao);
            $stmt->bindValue(':qt', $quantidade);
            $stmt->bindValue(':dt', $data_validade);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar doação");
        }
    }

    public function excluir($id) {
        try {
            // Remove dependências primeiro (solicitações)
            $this->banco->query("DELETE FROM solicitacoes WHERE doacao_id = $id");
            
            $sql = "DELETE FROM doacoes WHERE id = :id";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir doação");
        }
    }
}