<?php
namespace dao\mysql;
use generic\MysqlFactory;
use PDO;

class UsuarioDAO extends MysqlFactory {
    public function buscarPorEmailSenha($email, $senha) {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = :e AND senha = :s";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':e', $email);
            $stmt->bindValue(':s', $senha);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erro na autenticação");
        }
    }
}