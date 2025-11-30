# Trabalho - Aplicações para Internet: Sistema de Votação de Ideias

Este repositório contém o projeto desenvolvido para a disciplina de Aplicações para Internet. O objetivo foi criar um aplicativo web utilizando **PHP** e o padrão de arquitetura **MVC (Model-View-Controller)**, integrando também uma **API RESTful** com autenticação **JWT**.

O sistema segue boas práticas de desenvolvimento, como modularidade, reutilização de código e uso de padrões de projeto (DAO, Service, Singleton, Factory).

## 📋 Funcionalidades Implementadas

### 1. Interface Web (MVC)
- **CRUD Completo:** Cadastro, Leitura, Atualização e Exclusão de Ideias.
- **Votação:** Usuários autenticados podem votar em ideias.
- **Autenticação:** Sistema de Login/Logout com sessões PHP.
- **Interface:** Visualização dinâmica utilizando HTML e CSS.

### 2. API RESTful
- **Endpoints JSON:** Acesso aos dados para integrações externas.
- **Autenticação JWT:** Implementação de JSON Web Token para segurança.
- **Rotas Protegidas:** Validação de token no cabeçalho `Authorization: Bearer` para operações de escrita.
- **Tratamento de Erros:** Uso de blocos `try...catch` nas camadas DAO e Service para garantir respostas JSON limpas e ocultar erros técnicos (SQL).

---

## 📂 Estrutura do Projeto

A estrutura de pastas foi organizada conforme solicitado nas instruções:

- **`controller/`**: Recebe as requisições, orquestra o fluxo chamando a Service e decide a resposta (View ou JSON).
- **`service/`**: Camada intermediária contendo regras de negócio e validações.
- **`dao/`**: (Data Access Object) Camada responsável exclusivamente pelo acesso ao banco de dados.
- **`generic/`**: Núcleo do framework didático (Roteamento, Configuração JWT, Conexão Singleton).
- **`public/`**: Arquivos públicos (Views, CSS).
- **`template/`**: Layouts reutilizáveis (Cabeçalho, Rodapé).
- **`index.php`**: Front Controller que centraliza as requisições.

---

## 🚀 Configuração do Ambiente

### Pré-requisitos
- PHP 7.4 ou superior.
- Servidor Apache (XAMPP/WAMP) com `mod_rewrite` habilitado.
- MySQL.
- Composer.

### Instalação
1. **Banco de Dados:**
   - Crie um banco chamado `mvc_votacao`.
   - Importe o arquivo `banco.sql` fornecido na raiz do projeto para criar as tabelas (`usuarios`, `ideias`, `votos`).

2. **Dependências:**
   - Na raiz do projeto, execute o comando para instalar a biblioteca JWT:
     ```bash
     composer require firebase/php-jwt
     ```

3. **Execução:**
   - Coloque a pasta do projeto no diretório do servidor (ex: `htdocs`).
   - Acesse pelo navegador: `http://localhost/mvc_votacao`.

---

## 🔌 Documentação da API (Endpoints)

Para testar a API, utilize o **Postman**.

### 1. Autenticação (Login)
Gera o Token JWT necessário para as rotas protegidas.
- **Método:** `POST`
- **URL:** `/api/login`
- **Body (x-www-form-urlencoded):** `email`, `senha`
- **Retorno:** `{ "token": "...", "sucesso": true }`

### 2. Listar Ideias
Retorna a lista de ideias cadastradas.
- **Método:** `GET`
- **URL:** `/api/ideias`
- **Header:** `Authorization: Bearer <SEU_TOKEN>`

### 3. Criar Ideia
- **Método:** `POST`
- **URL:** `/api/ideias/criar`
- **Header:** `Authorization: Bearer <SEU_TOKEN>`
- **Body:** `titulo`, `descricao`

### 4. Editar Ideia
- **Método:** `POST`
- **URL:** `/api/ideias/editar`
- **Header:** `Authorization: Bearer <SEU_TOKEN>`
- **Body:** `id`, `titulo`, `descricao`

### 5. Excluir Ideia
- **Método:** `POST`
- **URL:** `/api/ideias/excluir`
- **Header:** `Authorization: Bearer <SEU_TOKEN>`
- **Body:** `id`

---

## 🛡️ Segurança e Erros

Conforme requisitado na Parte II do trabalho da API:
- Todas as operações de banco estão protegidas por `try...catch`.
- Erros de conexão ou SQL não são exibidos na tela; a API retorna um JSON com mensagem amigável e código HTTP adequado (401 para não autorizado, 500 para erro interno).