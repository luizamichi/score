<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS E FORMULÁRIOS GLOBAIS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../forms.php");

// MÓDULO NECESSÁRIO E TÍTULO DA PÁGINA
define("PAGE_MODULE", FORM_MODULES[1]);
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
					<p>A avaliação técnica é uma prova sobre conhecimentos técnicos da área da aviação.</p>
					<p>Ela irá medir o seu conhecimento técnico individual em 4 etapas.</p>
					<p>As suas notas valem em processos seletivos da sua respectiva área.</p>
				</div>
			</div>

			<div class="col-5 col-md-12 p-3">
				<img alt="Avaliação Técnica" class="img-responsive text-center" src="<?=MEDIA_NAME?>technical-evaluation.png"/>
			</div>
		</div>

		<div class="columns">
			<div class="col-7 col-md-12 px-3">
				<form action="<?=ACTION_NAME?>technical-evaluation" method="post">
					<input name="page" type="hidden" value="technical_evaluation"/>
					<button class="btn btn-block btn-green btn-lg" type="submit">Iniciar Avaliação Técnica</button>
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
