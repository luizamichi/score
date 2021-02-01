<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FORMULÁRIO GLOBAIS E FUNÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../functions.php");

// TÍTULO DA PÁGINA
define("PAGE_TITLE", "Painel Administrativo");
define("PAGE_MODULE", PAGE_TITLE);

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);

// CARREGA MENU SUPERIOR DA PÁGINA
require_once(INC_ROUTES["tab"]);

// CARREGA OS 5 ÚLTIMOS ALUNOS QUE TERMINARAM, COMEÇARAM E NÃO COMEÇARAM O QUESTIONÁRIO
$ff = list_students(2, 5);
$fi = list_students(1, 5);
$fni = list_students(0, 5);
?>

	<div class="container grid-lg py-4">
		<div class="text-center">
			<h6 class="display-6 text-blue"><?=PAGE_MODULE?></h6>
		</div>

		<?php if($ff): ?>
		<div class="divider mt-4 text-center" data-content="Formulários finalizados"></div>
		<?php endif; ?>

		<?php foreach($ff as $f): ?>
		<h5 class="mb-0"><strong><a class="text-blue" href="view?id=<?=$f["id"]?>"><?=$f["name"]?></a></strong></h5>
		<p class="mb-0"><strong>CPF:</strong> <?=preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $f["alias"])?></p>
		<p><strong>Término:</strong> <?=ucfirst(DATE_FORMAT->format(strtotime(fourth_step_end_time($f["ref_id"]))))?></p>
		<?php endforeach; ?>

		<?php if($fi): ?>
		<div class="divider mt-4 text-center" data-content="Formulários inicializados"></div>
		<?php endif; ?>

		<?php foreach($fi as $f): ?>
			<h5 class="mb-0"><strong><a class="text-blue" href="view?id=<?=$f["id"]?>"><?=$f["name"]?></a></strong></h5>
		<p class="mb-0"><strong>CPF:</strong> <?=preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $f["alias"])?></p>
		<p><strong>Início:</strong> <?=ucfirst(DATE_FORMAT->format(strtotime(initial_registration_start_time($f["ref_id"]))))?></p>
		<?php endforeach; ?>

		<?php if($fni): ?>
		<div class="divider mt-4 text-center" data-content="Formulários não inicializados"></div>
		<?php endif; ?>

		<?php foreach($fni as $f): ?>
			<h5 class="mb-0"><strong><a class="text-blue" href="view?id=<?=$f["id"]?>"><?=$f["name"]?></a></strong></h5>
		<p class="mb-0"><strong>CPF:</strong> <?=preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $f["alias"])?></p>
		<p><strong>Cadastro:</strong> <?=ucfirst(DATE_FORMAT->format(strtotime($f["registration_date"])))?></p>
		<?php endforeach; ?>

		<p class="text-center text-<?=get_color()?>" id="message"><?=get_message()?></p>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

</body>

</html>
