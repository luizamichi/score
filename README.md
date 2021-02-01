# Sistema de Competências e Relacionamentos
Plataforma de avaliação de alunos desenvolvida em PHP. Possui componentes de layout obtidos do framework [Spectre CSS](https://picturepan2.github.io/spectre/), além de funcionalidades aplicadas com [jQuery](https://jquery.com/) e gráficos gerados com [ApexCharts](https://apexcharts.com/).

O SCORE foi elaborado para avaliar profissionais da aviação. É capaz de identificar os pontos fortes e fracos do aluno, canalizando seus recursos para melhorar sua empregabilidade.

O sistema conta com a plataforma de avaliação de alunos e com um painel administrativo para gerenciar todos os dados de alunos e administradores. A autenticação é realizada na página principal e irá redirecionar o usuário para sua retrospectiva tela. Caso seja administrador, será redirecionado para o painel administrativo. Caso seja aluno, será redirecionado para a etapa da avaliação em que o aluno se encontra.


### Requisitos
1. Apache 2.4.46 (7 de agosto de 2020)

2. PHP 8.0 (26 de novembro de 2020)


### Instalação
1. Faça o download dos arquivos e coloque-os em um diretório do servidor.

2. Importe as tabelas do arquivo `persistence.sql` para o banco de dados MySQL. Caso deseje importar alguns dados, basta inserir os registros que estão no final do arquivo. É importante cadastrar ao menos um usuário que seja administrador (`insert into users values (1, 'Nome', 'CPF', md5('Senha'), now()); insert into administrators values (1, 1)`);

3. Altere a constante `ENVIRONMENT` do arquivo `config.php` para definir o ambiente (`DEVELOPMENT` ou `PRODUCTION`).

4. Ainda no arquivo `config.php`, altere a constante `BASE_NAME` para definir o caminho do servidor (caso seja na raiz, basta deixar como `/`). Também altere as constantes `WEB_HOST, SQL_HOST, SQL_PORT, SQL_USER, SQL_PASS, SQL_SCHEMA` com os respectivos valores relacionados ao servidor e ao banco de dados dos ambientes de desenvolvimento e de produção.


### Testes
A variável de ambiente `DEVELOPMENT` ativa o modo DEBUG do PHP para a visualização de possíveis alertas e erros. Caso deseje testar os formulários de forma eficiente sem o preenchimento dos campos, adicione o código `$("input[required='required']").removeAttr("required")` para remover o obrigação do preenchimento dos campos. Para não precisar clicar no botão utilize o código `$("input[type='submit'], button[type='submit']").click();`.


### Diretório
A estrutura é composta pelos seguintes diretórios (6) e arquivos (69):

```
score/
├── action/
│   ├── calculate_student.php
│   ├── first_step.php
│   ├── fourth_step.php
│   ├── initial_registration.php
│   ├── insert_student.php
│   ├── login.php
│   ├── logout.php
│   ├── medium_english.php
│   ├── operational_safety_and_regulation.php
│   ├── previous_experiences.php
│   ├── remove_student.php
│   ├── role_knowledge.php
│   ├── search_student.php
│   ├── second_step.php
│   ├── specific_technical_knowledge.php
│   ├── third_step.php
│   ├── update_student.php
│   └── validate_certificate.php
├── administrator.php
├── configurations.php
├── css/
│   ├── apexcharts.css
│   ├── score-reset.css
│   └── score-style.css
├── forms.php
├── functions.php
├── inc/
│   ├── footer.php
│   ├── header.php
│   ├── head.php
│   ├── navbar.php
│   ├── phase.php
│   ├── step.php
│   └── tab.php
├── index.php
├── js/
│   ├── apexcharts.min.js
│   ├── jquery.mask.js
│   └── jquery.min.js
├── media/
│   ├── airtalent.png
│   ├── background.png
│   ├── behavioral-assessment.png
│   ├── english-level.png
│   ├── logo.png
│   ├── logout.svg
│   ├── maintenance.png
│   └── technical-evaluation.png
├── persistence.sql
├── README.md
├── student.php
└── view/
    ├── behavioral_assessment.php
    ├── english_level.php
    ├── finished.php
    ├── first_step.php
    ├── fourth_step.php
    ├── index.php
    ├── initial_registration.php
    ├── insert_student.php
    ├── list_student.php
    ├── login.php
    ├── maintenance.php
    ├── medium_english.php
    ├── operational_safety_and_regulation.php
    ├── previous_experiences.php
    ├── role_knowledge.php
    ├── search_student.php
    ├── second_step.php
    ├── specific_technical_knowledge.php
    ├── technical_evaluation.php
    ├── third_step.php
    ├── update_student.php
    └── view_student.php
```
