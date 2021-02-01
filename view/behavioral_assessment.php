<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ALUNOS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../student.php");

// MÓDULO NECESSÁRIO E TÍTULO DA PÁGINA
define("PAGE_MODULE", FORM_MODULES[3]);
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
					<p>Este teste de personalidade permitirá que você obtenha sua pontuação nas cinco características principais, bem como cruze os resultados com as descobertas da pesquisa em ciências sociais.</p>
					<p>O teste dos Cinco Grandes é o teste de personalidade mais amplamente usado nas ciências sociais e às vezes é chamado de “o único teste de personalidade verdadeiramente científico”.</p>
				</div>
			</div>

			<div class="col-5 col-md-12 p-3">
				<img alt="Avaliação Comportamental" class="img-responsive text-center" src="<?=MEDIA_NAME?>behavioral-assessment.png" width="500"/>
			</div>
		</div>

		<div class="columns">
			<div class="col-7 col-md-12 px-3">
				<form action="<?=ACTION_NAME?>behavioral-assessment" method="post">
					<input name="page" type="hidden" value="index"/>
					<button class="btn btn-block btn-green btn-lg" type="submit">Iniciar Avaliação Comportamental</button>
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
