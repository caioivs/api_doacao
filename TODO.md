# TODO: Transformar Projeto para Sistema de Doações de Alimentos

## Etapas Principais
- [ ] Atualizar banco.sql para novas tabelas (Doadores, Doações, Instituições)
- [ ] Renomear e atualizar DAOs (IdeiaDAO -> DoacaoDAO, UsuarioDAO -> DoadorDAO, criar InstituicaoDAO)
- [ ] Renomear e atualizar Services (IdeiaService -> DoacaoService, ajustar AuthService)
- [ ] Renomear e atualizar Controllers (Ideia -> Doacao, ajustar Auth)
- [ ] Atualizar Rotas.php para novos endpoints
- [ ] Renomear e atualizar Templates e Views (ideia -> doacao)
- [ ] Renomear Interfaces (IIdeiaDAO -> IDoacaoDAO)
- [ ] Testar aplicação e ajustar autenticação

## Arquivos a Editar
- banco.sql
- dao/mysql/IdeiaDAO.php -> DoacaoDAO.php
- dao/mysql/UsuarioDAO.php -> DoadorDAO.php
- dao/IIdeiaDAO.php -> IDoacaoDAO.php
- service/IdeiaService.php -> DoacaoService.php
- controller/Ideia.php -> Doacao.php
- generic/Rotas.php
- public/ideia/ -> public/doacao/
- template/IdeiaTemp.php -> DoacaoTemp.php
- service/AuthService.php
- controller/Auth.php
