# Sistema de Competências e Relacionamentos
O SCORE foi desenvolvido em PHP 7 e está em sua versão BETA, podendo apresentar erros.


### Utilização
1. É necessário criar um usuário com permissão de administrador para começar a utilizar o sistema. Ao final do arquivo `sql/sql.sql` encontra-se um exemplo de como criar o primeiro usuário.

2. No arquivo `php/util.php` é necessário alterar a constante HOST, além de alterar as configurações de login e senha do banco de dados.

3. O diretório raiz (exemplo: `localhost/score`) aponta para o login de estudantes e o diretório admin (exemplo: `localhost/score/admin`) aponta para o login de administradores.


### Diretório

```
score/
├── admin/
│   ├── consultar.php
│   ├── index.php
│   ├── painel.php
│   ├── php/
│   │   ├── index.php
│   │   ├── registrar.php
│   │   ├── remover.php
│   │   └── sair.php
│   ├── registrar.php
│   └── remover.php
├── css/
│   ├── spectre-exp.min.css
│   ├── spectre-icons.min.css
│   └── spectre.min.css
├── final.php
├── formulario-0.php
├── formulario-1.php
├── formulario-2.php
├── formulario-3.php
├── formulario-4.php
├── formulario-5.php
├── formulario-6.php
├── img/
│   ├── airtalent-b.png
│   ├── airtalent.png
│   ├── background.jpg
│   ├── logo.png
│   ├── sair-b.png
│   └── sair.png
├── index.php
├── js/
│   ├── jquery-3.5.1.min.js
│   └── jquery.mask.js
├── php/
│   ├── formulario-1.php
│   ├── formulario-2.php
│   ├── formulario-3.php
│   ├── formulario-4.php
│   ├── formulario-5.php
│   ├── formulario-6.php
│   ├── index.php
│   ├── sair.php
│   └── util.php
└── sql/
    └── sql.sql
```