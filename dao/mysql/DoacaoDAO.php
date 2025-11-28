<?php
namespace dao\mysql;
use generic\MysqlFactory;
use PDO;

class IdeiaDAO extends MysqlFactory {
    
    public function listar() {
        try {
            $sql = "SELECT i.*, u.nome as autor, 
                    (SELECT COUNT(*) FROM votos v WHERE v.ideia_id = i.id) as total_votos 
                    FROM ideias i 
                    JOIN usuarios u ON i.usuario_id = u.id 
                    ORDER BY total_votos DESC";
            return $this->banco->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            // PDF: "Nenhum erro técnico deve ser exibido"
            throw new \Exception("Erro ao acessar banco de dados");
        }
    }

    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM ideias WHERE id = :id";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar ideia");
        }
    }

    public function inserir($titulo, $descricao, $usuario_id) {
        try {
            $sql = "INSERT INTO ideias (titulo, descricao, usuario_id) VALUES (:t, :d, :u)";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':t', $titulo);
            $stmt->bindValue(':d', $descricao);
            $stmt->bindValue(':u', $usuario_id);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar ideia");
        }
    }

    public function atualizar($id, $titulo, $descricao) {
        try {
            $sql = "UPDATE ideias SET titulo = :t, descricao = :d WHERE id = :id";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':t', $titulo);
            $stmt->bindValue(':d', $descricao);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar ideia");
        }
    }

    public function excluir($id) {
        try {
            $this->banco->query("DELETE FROM votos WHERE ideia_id = $id"); // Apaga votos antes
            $sql = "DELETE FROM ideias WHERE id = :id";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir ideia");
        }
    }

    public function registrarVoto($usuario_id, $ideia_id) {
        try {
            $sql = "INSERT INTO votos (usuario_id, ideia_id) VALUES (:u, :i)";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':u', $usuario_id);
            $stmt->bindValue(':i', $ideia_id);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Você já votou nesta ideia ou erro interno");
        }
    }
}