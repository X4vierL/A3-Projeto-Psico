# A3 Projeto Psico

Este é um sistema desenvolvido para gerenciamento de sessões e informações de pacientes para psicólogos. O projeto inclui funcionalidades como login, registro de pacientes, prontuários e listagem de sessões.

## Funcionalidades

- **Login do Administrador**: Página para login seguro do administrador.
- **Cadastro de Pacientes**: Interface para registrar novos pacientes no sistema.
- **Gerenciamento de Prontuários**: Registro e salvamento de prontuários médicos.
- **Listagem de Pacientes**: Visualização de todos os pacientes cadastrados.
- **Controle de Sessões**: Registro de sessões realizadas e listagem das sessões.

## Estrutura do Projeto

Abaixo estão os principais arquivos e pastas do projeto:

- `config.php`: Arquivo de configuração para conexão com o banco de dados.
- `A3_Psico.sql`: Script SQL para criação e inicialização do banco de dados.
- `login/`: Contém a página de login e seus recursos (CSS, JS e imagens).
- `main/`: Página principal do sistema com estilos e imagens.
- `paciente/`: Contém funcionalidades relacionadas ao gerenciamento de pacientes.
- `prontuario/`: Inclui scripts para criação e edição de prontuários.
- `sessao/`: Página para registro de sessões.
- `sessoes_lst/`: Scripts para listagem das sessões.

## Configuração e Instalação

1. Clone ou baixe este repositório.
2. Configure o servidor local (recomendado: XAMPP) e mova os arquivos para o diretório do servidor (`htdocs` no XAMPP).
3. Importe o arquivo `A3_Psico.sql` no seu gerenciador de banco de dados (ex.: phpMyAdmin).
4. Configure o arquivo `config.php` com as credenciais do banco de dados.
5. Acesse o sistema pelo navegador através do endereço local configurado (ex.: `http://localhost/A3-Projeto-Psico-main/`).

## Tecnologias Utilizadas

- **Linguagens**: PHP, SQL, HTML, CSS, JavaScript.
- **Banco de Dados**: MySQL.
- **Servidor Local**: XAMPP.

## Créditos

Este projeto foi desenvolvido para fins acadêmicos e demonstração de habilidades em desenvolvimento web.
