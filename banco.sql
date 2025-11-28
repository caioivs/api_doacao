CREATE DATABASE doacoes_alimentos;
USE doacoes_alimentos;

CREATE TABLE doadores (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(100) NOT NULL,
 email VARCHAR(100) UNIQUE NOT NULL,
 senha VARCHAR(255) NOT NULL,
 telefone VARCHAR(20),
 endereco TEXT
);

CREATE TABLE instituicoes (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(100) NOT NULL,
 email VARCHAR(100) UNIQUE NOT NULL,
 senha VARCHAR(255) NOT NULL,
 telefone VARCHAR(20),
 endereco TEXT,
 tipo VARCHAR(50) -- ex: abrigo, escola, hospital
);

CREATE TABLE doacoes (
 id INT AUTO_INCREMENT PRIMARY KEY,
 titulo VARCHAR(150) NOT NULL,
 descricao TEXT NOT NULL,
 quantidade VARCHAR(100),
 data_validade DATE,
 status ENUM('disponivel', 'solicitada', 'retirada') DEFAULT 'disponivel',
 doador_id INT,
 FOREIGN KEY (doador_id) REFERENCES doadores(id)
);

CREATE TABLE solicitacoes (
 id INT AUTO_INCREMENT PRIMARY KEY,
 doacao_id INT,
 instituicao_id INT,
 data_solicitacao DATETIME DEFAULT CURRENT_TIMESTAMP,
 status ENUM('pendente', 'aprovada', 'rejeitada') DEFAULT 'pendente',
 FOREIGN KEY (doacao_id) REFERENCES doacoes(id),
 FOREIGN KEY (instituicao_id) REFERENCES instituicoes(id)
);

-- Inserir dados de teste
INSERT INTO doadores (nome, email, senha, telefone, endereco) VALUES ('João Doador', 'joao@doador.com', '123', '11999999999', 'Rua das Flores, 123');
INSERT INTO instituicoes (nome, email, senha, telefone, endereco, tipo) VALUES ('Abrigo Esperança', 'abrigo@esperanca.com', '123', '11888888888', 'Av. Solidariedade, 456', 'abrigo');
