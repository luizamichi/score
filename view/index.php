<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");

// TÍTULO DA PÁGINA
define("PAGE_TITLE", "Início");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);
?>

	<div class="container grid-lg py-4">
		<div class="columns">
			<div class="col-7 col-md-12 px-3">
				<h6 class="display-6 text-blue">Sistema de Competências e Relacionamentos</h6>
				<div class="text-justify">
					<p>O SCORE é uma avaliação individual que mede, por meio de uma nota, as habilidades <em>soft</em> e <em>hard skills</em>. Por meio do SCORE, você poderá identificar seus pontos fortes e fracos e canalizar seus recursos para melhorar sua empregabilidade.</p>
					<p>A sua nota no SCORE poderá ser usada pelos empregadores nos processos seletivos, aumentando ainda mais as suas chances de ser alocado para a vaga certa.</p>
					<p>O teste aplicado no SCORE avalia 5 aspectos técnicos e 5 aspectos comportamentais, com notas que variam de 0 a 10, totalizando 100 pontos.</p>
					<p>O SCORE foi desenvolvido por profissionais com vasta experiência na aviação e é uma ferramenta específica para o meio aeronáutico.</p>
					<p>Por meio de uma única aplicação, o seu SCORE poderá ser usado por várias empresas em vários processos seletivos, sem a necessidade de testes repetitivos para cada vaga.</p>
				</div>
			</div>

			<div class="col-5 col-md-12 p-3">
				<img alt="SCORE" class="img-center img-responsive" src="<?=MEDIA_NAME?>logo.png" width="500"/>
			</div>
		</div>

		<div class="columns">
			<div class="col-7 col-md-12 px-3">
				<form action="<?=ACTION_NAME?>personal-data" method="post">
					<input name="page" type="hidden" value="index"/>
					<?php if(get_message(false) === "Não foi possível estabelecer conexão com o banco de dados."): ?>
					<a class="btn btn-block btn-red btn-lg" href="<?=BASE_NAME?>">Tentar Novamente</a>
					<?php else: ?>
					<button class="btn btn-block btn-green btn-lg" type="submit">Informar Dados Pessoais</button>
					<?php endif; ?>
				</form>
			</div>
		</div>

		<p class="mt-3 text-center text-<?=get_color()?>" id="message"><?=get_message()?></p>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

</body>

</html>
