<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ALUNOS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../student.php");

// MÓDULO NECESSÁRIO, ESTÁGIO NECESSÁRIO E TÍTULO DA PÁGINA
define("PAGE_MODULE", FORM_MODULES[3]);
define("PAGE_STAGE", FORM_STAGES[7]);
define("PAGE_TITLE", PAGE_MODULE . " (" . PAGE_STAGE . ")");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA TODAS AS PERGUNTAS E RESPOSTAS DO USUÁRIO
$questions = second_step_form();
$r = second_step_response(get_user()["student"]);

// DEFINE O TEMPO PARA EXIBIR EM TELA
$time = initial_registration_start_time(get_user()["student"]);
$i = 1;

// DEFINE AS POSSÍVEIS RESPOSTAS PARA AS PERGUNTAS
$alternatives = behavioral_assessment_alternatives();

// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);

// CARREGA O MENU SUPERIOR DA PÁGINA
require_once(INC_ROUTES["navbar"]);

// CARREGA A ETAPA DA PÁGINA
require_once(INC_ROUTES["step"]);
?>

	<div class="container grid-lg py-4">
		<div class="text-center">
			<h6 class="display-6 text-blue"><?=PAGE_STAGE?></h6>
		</div>

		<form action="<?=ACTION_NAME?>behavioral-assessment/second-step" class="form-horizontal" data-save="true" method="post">
			<?php foreach($questions as $q => $question): ?>
			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="<?=$q?>"><?=$i++ . ". " . $question?></label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<?php foreach($alternatives as $index => $a): ?>
					<label class="form-inline form-radio">
						<input <?=$r[$q] === $a ? "checked" : ""?> id="<?=$a === "Muito inadequado" ? $q : $q . "-" . $index?>" name="<?=$q?>" required="required" type="radio" value="<?=$a?>"/>
						<i class="form-icon"></i>
						<?=$a?>
					</label>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endforeach; ?>

			<div class="text-right">
				<input class="btn btn-green btn-lg" type="submit" value="Próximo"/>
			</div>
		</form>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

</body>

</html>
