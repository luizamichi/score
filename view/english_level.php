<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ALUNOS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../student.php");

// MÓDULO NECESSÁRIO E TÍTULO DA PÁGINA
define("PAGE_MODULE", FORM_MODULES[2]);
define("PAGE_TITLE", PAGE_MODULE);

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// DEFINE O TEMPO PARA EXIBIR EM TELA
$time = initial_registration_start_time(get_user()["student"]);

// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);

// CARREGA O MENU SUPERIOR DA PÁGINA
require_once(INC_ROUTES["navbar"]);
?>

	<div class="container grid-lg py-4">
		<div class="columns">
			<div class="col-7 col-md-12 px-3">
				<h6 class="display-6 text-blue"><?=PAGE_MODULE?></h6>
				<div class="text-justify">
					<p>O exame de inglês que propomos é simples e rápido, pois, consiste em responder a uma série de perguntas de escolha múltipla que somente levarão alguns minutos.</p>
					<p>A ideia deste teste de nível é avaliar seus conhecimentos em diferentes aspetos da língua, como a gramática e o vocabulário, entre outros.</p>
				</div>
			</div>

			<div class="col-5 col-md-12 p-3">
				<img alt="Avaliação de Inglês" class="img-responsive text-center" src="<?=MEDIA_NAME?>english-level.png" width="500"/>
			</div>
		</div>

		<div class="columns">
			<div class="col-7 col-md-12 px-3">
				<form action="<?=ACTION_NAME?>english-level" method="post">
					<input name="page" type="hidden" value="index"/>
					<button class="btn btn-block btn-green btn-lg" type="submit">Iniciar Avaliação de Inglês</button>
				</form>
			</div>
		</div>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

</body>

</html>
