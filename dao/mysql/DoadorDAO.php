<?php
namespace dao\mysql;
use generic\MysqlFactory;
use PDO;

class DoadorDAO extends MysqlFactory {
    
    public function buscarPorEmailSenha($email, $senha) {
        try {
            // O SQL fornecido usa MD5 na senha, então comparamos direto
            $sql = "SELECT * FROM doadores WHERE email = :e AND senha = :s";
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(':e', $email);
            $stmt->bindValue(':s', $senha);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao consultar banco de dados.");
        }
    }
}