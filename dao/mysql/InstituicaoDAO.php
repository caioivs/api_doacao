<?php
namespace dao\mysql;
use generic\MysqlFactory;
use PDO;

class InstituicaoDAO extends MysqlFactory {

    public function buscarPorEmailSenha($email, $senha) {
        try {
            $sql = "SELECT * FROM instituicoes WHERE email = :e AND senha = :s";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':e', $email);
            $stmt->bindValue(':s', $senha);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar instituição");
        }
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM instituicoes";
            return $this->banco->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar instituições");
        }
    }

    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM instituicoes WHERE id = :id";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar instituição");
        }
    }

    public function inserir($nome, $email, $senha, $telefone = null, $endereco = null, $tipo = null) {
        try {
            $sql = "INSERT INTO instituicoes (nome, email, senha, telefone, endereco, tipo) VALUES (:n, :e, :s, :t, :end, :tipo)";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':n', $nome);
            $stmt->bindValue(':e', $email);
            $stmt->bindValue(':s', $senha);
            $stmt->bindValue(':t', $telefone);
            $stmt->bindValue(':end', $endereco);
            $stmt->bindValue(':tipo', $tipo);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao cadastrar instituição");
        }
    }

    public function solicitarDoacao($doacao_id, $instituicao_id) {
        try {
            $sql = "INSERT INTO solicitacoes (doacao_id, instituicao_id) VALUES (:d, :i)";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':d', $doacao_id);
            $stmt->bindValue(':i', $instituicao_id);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao solicitar doação");
        }
    }

    public function listarSolicitacoes($instituicao_id) {
        try {
            $sql = "SELECT s.*, d.titulo, d.descricao, d.quantidade, d.data_validade, do.nome as doador_nome
                    FROM solicitacoes s
                    JOIN doacoes d ON s.doacao_id = d.id
                    JOIN doadores do ON d.doador_id = do.id
                    WHERE s.instituicao_id = :i
                    ORDER BY s.data_solicitacao DESC";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':i', $instituicao_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar solicitações");
        }
    }
}
