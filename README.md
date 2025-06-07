
#projeto: Adivinhe a Música - Jogo Web Interativo

Jogo interativo online onde o usuário deve adivinhar músicas com base em pequenos trechos de áudio. Desenvolvido como projeto final para a disciplina de Desenvolvimento Web.


## Autores

- Artur Cristóvão Muhongo


## Funcionalidades

-Reprodução de trechos de músicas com HTML5 Audio

Sistema de login e cadastro de usuários

Três níveis de dificuldade: fácil, médio e difícil

Sistema de pontuação (5 pontos por resposta correta)

Feedback sonoro de acerto e erro

Ranking com os melhores jogadores

Tela de parabenização e reinício de jogo

## Instalação

Clone o repositório ou extraia os arquivos .zip

Copie para a pasta htdocs do XAMPP ou similar

Importe o banco de dados:

Acesse phpMyAdmin

Crie o banco e importe o arquivo sql/banco.sql

Acesse no navegador: http://localhost/adivinhe_musica
## Licença

Este projeto é de uso acadêmico e não possui licença comercial.


## Rodando localmente

Clone o projeto
Clone o repositório ou extraia o .zip deste projeto.

Mova a pasta adivinhe_musica para a pasta htdocs (ou www dependendo do servidor).

Inicie o servidor Apache e MySQL pelo painel do XAMPP/WAMP.

No navegador, acesse: http://localhost/adivinhe_musica

Acesse phpMyAdmin e importe o arquivo sql/banco.sql para criar a base de dados.




## Stack utilizada

Frontend (cliente)
HTML5 – estrutura das páginas

CSS3 – estilização e responsividade (com design moderno)

JavaScript – interatividade e controle de áudio e pontuação

HTML5 Audio API – reprodução de trechos musicais

Backend (servidor)
PHP (procedural) – lógica de funcionamento, sessões, pontuação, login/cadastro

Base de Dados
MySQL – armazenamento de usuários e ranking

PHPMyAdmin – (opcional, para gerenciamento visual do banco)

Ambiente de Desenvolvimento
XAMPP ou WAMP (servidores locais com Apache + MySQL)
## Aprendizados

O que você aprendeu construindo esse projeto? Quais desafios você enfrentou e como você superou-os?
1. Integração de Frontend e Backend
Aprendemos como o HTML, CSS e JavaScript se conectam com PHP para gerar páginas dinâmicas.

Utilizamos formulários com validação e sessões PHP para manter o estado do usuário.

2. Manipulação de Áudio com HTML5
Foi explorado o uso da <audio> tag e seus controles via JavaScript.

Implementamos lógica para reproduzir sons de resposta e faixas de música em cada nível.

3. Gerenciamento de Banco de Dados MySQL
Projetamos um banco relacional com usuários e pontuações.

Utilizamos comandos SQL e importação via phpMyAdmin.

4. Lógica de Jogo e Controle de Níveis
Criamos um sistema progressivo com pontuação e mudança de dificuldade.

Aplicamos estruturas condicionais para transições entre fases do jogo.

5. Boas Práticas de Organização
Separação por arquivos e pastas (includes, assets, audios)

Reutilização de código com include/require no PHP.

6. Trabalho Autônomo e Pesquisa
Consultamos documentação oficial e tutoriais para resolver erros.

## Roadmap

- Melhorar o suporte de navegadores

- Adicionar mais integrações

