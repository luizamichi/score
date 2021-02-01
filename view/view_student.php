<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS E FORMULÁRIOS GLOBAIS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../forms.php");

// TÍTULO DA PÁGINA
define("PAGE_TITLE", "Visualizar Usuário");
define("PAGE_MODULE", PAGE_TITLE);

// PROCURA PELO USUÁRIO NO BANCO DE DADOS
$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? clean_text($_GET["id"]) : 0;
$administrators = get_administrator($id);
$students = get_student($id);

$rows = !empty($administrators) ? $administrators : (!empty($students) ? $students : []);
if(!empty($rows)) { // ENCONTROU UM USUÁRIO
	$u = $rows[0];
	if(!empty($administrators)) {
		$u["ref_id"] = 0;
	}

	// VERIFICA SE O USUÁRIO É UM ALUNO E SE TERMINOU O FORMULÁRIO
	$query = "select situations.`name`, analysis.`certificate`, analysis.`link`, analysis.`identifier` from analysis inner join situations on analysis.`situation`=situations.`id` where analysis.`student`=" . $u["ref_id"] . ";";
	$rows = sql_query($query);
	$certificate = (!empty($rows) ? $rows[0]["certificate"] : null);
	$link = (!empty($rows) ? $rows[0]["link"] : null);
	$situation = (!empty($rows) ? $rows[0]["name"] : "Indefinido");
	$identifier = (!empty($rows) ? $rows[0]["identifier"] : null);

	// CARREGA TODAS AS PERGUNTAS E RESPOSTAS DO ALUNO
	if($situation !== "Indefinido" || !empty($students)) {
		$initial_registration_question = initial_registration_form();
		$ir = initial_registration_response($u["ref_id"]);
		if(!initial_registration_finished($u["ref_id"])) {
			unset($ir);
		}

		$role_knowledge_question = role_knowledge_form();
		$rk = role_knowledge_response($u["ref_id"]);
		if(!role_knowledge_finished($u["ref_id"])) {
			unset($rk);
		}

		$specific_technical_knowledge_question = specific_technical_knowledge_form();
		$stk = specific_technical_knowledge_response($u["ref_id"]);
		if(!specific_technical_knowledge_finished($u["ref_id"])) {
			unset($stk);
		}

		$operational_safety_and_regulation_question = operational_safety_and_regulation_form();
		$osar = operational_safety_and_regulation_response($u["ref_id"]);
		if(!operational_safety_and_regulation_finished($u["ref_id"])) {
			unset($osar);
		}

		$previous_experiences_question = previous_experiences_form();
		$pe = previous_experiences_response($u["ref_id"]);
		if(!previous_experiences_finished($u["ref_id"])) {
			unset($pe);
		}

		$medium_english_question = medium_english_form();
		$me = medium_english_response($u["ref_id"]);
		if(!medium_english_finished($u["ref_id"])) {
			unset($me);
		}
		$mef = medium_english_feedback($u["ref_id"]);

		$behavioral_assessment_question = behavioral_assessment_form();
		$ba = behavioral_assessment_response($u["ref_id"]);
		if(!behavioral_assessment_finished($u["ref_id"])) {
			unset($ba);
		}
		$bai = 1;
	}
}

else {
	redirect(BASE_NAME . "admin");
}

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);

// CARREGA MENU SUPERIOR DA PÁGINA
require_once(INC_ROUTES["tab"]);
?>

	<div class="container grid-lg py-4">
		<div class="text-center">
			<h6 class="display-6 text-blue"><?=PAGE_MODULE?></h6>
		</div>

		<h5 class="mb-0"><strong><?=$u["name"]?></strong></h5>
		<p class="mb-3"><small><?=!empty($administrators) ? "Administrador" : "Aluno"?></small></p>
		<p><strong>CPF:</strong> <?=preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $u["alias"])?></p>
		<p><strong>Data de Cadastro:</strong> <?=ucfirst(DATE_FORMAT->format(strtotime($u["registration_date"])))?></p>

		<?php if($situation !== "Indefinido" || !empty($students)): ?>
		<?php if($situation !== "Indefinido"): ?>
		<p><strong>Data de Início:</strong> <?=ucfirst(DATE_FORMAT->format(strtotime(initial_registration_start_time($u["ref_id"]))))?></p>
		<p><strong>Data de Término:</strong> <?=ucfirst(DATE_FORMAT->format(strtotime(fourth_step_end_time($u["ref_id"]))))?></p>
		<p><strong>Tempo de Resolução:</strong> <?=calculate_time(initial_registration_start_time($u["ref_id"]), fourth_step_end_time($u["ref_id"]))?></p>
		<p><strong>Tempo Efetivo:</strong> <?=total_time([initial_registration_start_time($u["ref_id"]), initial_registration_end_time($u["ref_id"])], [role_knowledge_start_time($u["ref_id"]), role_knowledge_end_time($u["ref_id"])], [specific_technical_knowledge_start_time($u["ref_id"]), specific_technical_knowledge_end_time($u["ref_id"])], [operational_safety_and_regulation_start_time($u["ref_id"]), operational_safety_and_regulation_end_time($u["ref_id"])], [previous_experiences_start_time($u["ref_id"]), previous_experiences_end_time($u["ref_id"])], [medium_english_start_time($u["ref_id"]), medium_english_end_time($u["ref_id"])], [first_step_start_time($u["ref_id"]), first_step_end_time($u["ref_id"])], [second_step_start_time($u["ref_id"]), second_step_end_time($u["ref_id"])], [third_step_start_time($u["ref_id"]), third_step_end_time($u["ref_id"])], [fourth_step_start_time($u["ref_id"]), fourth_step_end_time($u["ref_id"])])?></p>
		<?php if($certificate): ?>
		<p><strong>Situação:</strong> <a class="text-black tooltip tooltip-right" data-tooltip="Visualizar arquivo" href="<?=FILE_NAME . $certificate?>" target="_blank"><?=$situation?></a></p>
		<p><strong>Identificador:</strong> <?=$identifier?></p>
		<?php else: ?>
		<p><strong>Situação:</strong> <?=$situation?></p>
		<?php endif; ?>
		<?php endif; ?>

		<div class="text-justify">
			<h3 class="mt-5 text-center">Cadastro Inicial</h3>
			<?php if(isset($ir)): ?>
			<div class="divider mb-1 text-center" data-content="Dados Pessoais"></div>
			<p class="mb-3 text-center"><small><?=calculate_time(initial_registration_start_time($u["ref_id"]), initial_registration_end_time($u["ref_id"]))?></small></p>
			<?php foreach($initial_registration_question as $i => $irq): ?>
			<p>
				<?php if(is_numeric(explode(".", $irq)[0])): ?>
				<strong><?=in_array(substr($irq, -1), ["?", ":", "."]) ? $irq . "" : $irq . ":"?></strong>
				<?php elseif(!empty($ir[$i])): ?>
				<strong class="ml-3"><?=in_array(substr($irq, -1), ["?", ":", "."]) ? $irq . "" : $irq . ":"?></strong>
				<?php endif; ?>
				<?=is_array($ir[$i]) ? implode(", ", $ir[$i]) : nl2br($ir[$i])?>
			</p>
			<?php endforeach; ?>

			<?php else: ?>
			<p class="text-center tooltip" data-tooltip="Aluno ainda não iniciou esta etapa"><span class="chip">Dados Pessoais</span></p>
			<?php endif; ?>

			<h3 class="mt-5 text-center">Avaliação Técnica</h3>
			<?php if(isset($rk)): ?>
			<div class="divider mb-1 text-center" data-content="Conhecimento da Função"></div>
			<p class="mb-3 text-center"><small><?=calculate_time(role_knowledge_start_time($u["ref_id"]), role_knowledge_end_time($u["ref_id"]))?></small></p>
			<?php foreach($role_knowledge_question as $i => $rkq): ?>
			<p>
				<?php if(is_numeric(explode(".", $rkq)[0])): ?>
				<strong><?=in_array(substr($rkq, -1), ["?", ":", "."]) ? $rkq . "" : $rkq . ":"?></strong>
				<?php elseif(!empty($rk[$i])): ?>
				<strong class="ml-3"><?=in_array(substr($rkq, -1), ["?", ":", "."]) ? $rkq . "" : $rkq . ":"?></strong>
				<?php endif; ?>
				<?=is_array($rk[$i]) ? implode(", ", $rk[$i]) : nl2br($rk[$i])?>
			</p>
			<?php endforeach; ?>

			<?php else: ?>
			<p class="text-center tooltip" data-tooltip="Aluno ainda não iniciou esta etapa"><span class="chip">Conhecimento da Função</span></p>
			<?php endif; ?>

			<?php if(isset($stk)): ?>
			<div class="divider mb-0 mt-5 text-center" data-content="Conhecimento Técnico Específico"></div>
			<p class="mb-3 text-center"><small><?=calculate_time(specific_technical_knowledge_start_time($u["ref_id"]), specific_technical_knowledge_end_time($u["ref_id"]))?></small></p>
			<?php foreach($specific_technical_knowledge_question as $i => $stkq): ?>
			<?php if($i === "question-2-1"): ?>
			<p><strong>2. Nível de conhecimento dos regulamentos abaixo:</strong></p>
			<?php elseif($i === "question-12-1-1"): ?>
			<p><strong>12. Você possui algum treinamento específico nas seguintes áreas?</strong></p>
			<?php else: ?>
			<p>
				<?php if(is_numeric(explode(".", $stkq)[0])): ?>
				<strong><?=in_array(substr($stkq, -1), ["?", ":", "."]) ? $stkq . "" : $stkq . ":"?></strong>
				<?php elseif(!empty($stk[$i])): ?>
				<strong class="ml-3"><?=in_array(substr($stkq, -1), ["?", ":", "."]) ? $stkq . "" : $stkq . ":"?></strong>
				<?php endif; ?>
				<?=is_array($stk[$i]) ? implode(", ", $stk[$i]) : nl2br($stk[$i])?>
			</p>
			<?php endif; ?>
			<?php endforeach; ?>

			<?php else: ?>
			<p class="text-center tooltip" data-tooltip="Aluno ainda não iniciou esta etapa"><span class="chip">Conhecimento Técnico Específico</span></p>
			<?php endif; ?>

			<?php if(isset($osar)): ?>
			<div class="divider mb-0 mt-5 text-center" data-content="Segurança Operacional e Regulação"></div>
			<p class="mb-3 text-center"><small><?=calculate_time(operational_safety_and_regulation_start_time($u["ref_id"]), operational_safety_and_regulation_end_time($u["ref_id"]))?></small></p>
			<?php foreach($operational_safety_and_regulation_question as $i => $osarq): ?>
			<p>
				<?php if(is_numeric(explode(".", $osarq)[0])): ?>
				<strong><?=in_array(substr($osarq, -1), ["?", ":", "."]) ? $osarq . "" : $osarq . ":"?></strong>
				<?php elseif(!empty($osar[$i])): ?>
				<strong class="ml-3"><?=in_array(substr($osarq, -1), ["?", ":", "."]) ? $osarq . "" : $osarq . ":"?></strong>
				<?php endif; ?>
				<?=is_array($osar[$i]) ? implode(", ", $osar[$i]) : nl2br($osar[$i])?>
			</p>
			<?php endforeach; ?>

			<?php else: ?>
			<p class="text-center tooltip" data-tooltip="Aluno ainda não iniciou esta etapa"><span class="chip">Segurança Operacional e Regulação</span></p>
			<?php endif; ?>

			<?php if(isset($pe)): ?>
			<div class="divider mb-0 mt-5 text-center" data-content="Experiências Anteriores"></div>
			<p class="mb-3 text-center"><small><?=calculate_time(previous_experiences_start_time($u["ref_id"]), previous_experiences_end_time($u["ref_id"]))?></small></p>
			<?php foreach($previous_experiences_question as $i => $peq): ?>
			<?php if($i === "question-15-1"): ?>
			<p><strong>15. Com quais tipos de aeronaves você já desempenhou tarefas relativas a função?</strong></p>
			<?php elseif($i === "question-16-1-1"): ?>
			<p><strong>16. Qual o seu nível de conhecimento nos seguintes campos?</strong></p>
			<?php elseif(is_numeric(explode(".", $peq)[0]) || !empty($pe[$i])): ?>
			<p>
				<?php if(is_numeric(explode(".", $peq)[0])): ?>
				<strong><?=in_array(substr($peq, -1), ["?", ":", "."]) ? $peq . "" : $peq . ":"?></strong>
				<?php elseif(!empty($pe[$i])): ?>
				<strong class="ml-3"><?=in_array(substr($peq, -1), ["?", ":", "."]) ? $peq . "" : $peq . ":"?></strong>
				<?php endif; ?>
				<?=is_array($pe[$i]) ? implode(", ", $pe[$i]) : nl2br($pe[$i])?>
			</p>
			<?php endif; ?>
			<?php endforeach; ?>

			<?php else: ?>
			<p class="text-center tooltip" data-tooltip="Aluno ainda não iniciou esta etapa"><span class="chip">Experiências Anteriores</span></p>
			<?php endif; ?>

			<h3 class="mt-5 text-center">Nível de Inglês</h3>
			<?php if(isset($me)): ?>
			<div class="divider mb-1 text-center" data-content="Inglês Médio"></div>
			<p class="mb-3 text-center"><small><?=calculate_time(medium_english_start_time($u["ref_id"]), medium_english_end_time($u["ref_id"]))?></small></p>
			<p><strong>Nota</strong> <?=number_format($mef, 2)?></p>
			<?php foreach($medium_english_question as $i => $meq): ?>
			<p>
				<?php if(is_numeric(explode(".", $meq)[0])): ?>
				<strong><?=in_array(substr($meq, -1), ["?", ":", "."]) ? $meq . "" : $meq . ":"?></strong>
				<?php elseif(!empty($me[$i])): ?>
				<strong class="ml-3"><?=in_array(substr($meq, -1), ["?", ":", "."]) ? $meq . "" : $meq . ":"?></strong>
				<?php endif; ?>
				<?=is_array($me[$i]) ? implode(", ", $me[$i]) : nl2br($me[$i])?>
			</p>
			<?php endforeach; ?>

			<?php else: ?>
			<p class="text-center tooltip" data-tooltip="Aluno ainda não iniciou esta etapa"><span class="chip">Inglês Médio</span></p>
			<?php endif; ?>

			<h3 class="mt-5 text-center">Avaliação Comportamental</h3>
			<?php if(isset($ba)): ?>
			<a class="tooltip tooltip-right" data-tooltip="<?=$link ? "Visualizar resultados" : "Calcular personalidade"?>" href="<?=$link ? "javascript:void(0)" : ACTION_NAME . "admin/student/calculate?student=" . $u["ref_id"]?>">
				<div class="divider mb-1 text-center" data-content="Big Five" onclick="<?=$link ? "change();" : ""?>"></div>
			</a>
			<p class="mb-3 text-center"><small><?=calculate_time(first_step_start_time($u["ref_id"]), fourth_step_end_time($u["ref_id"]))?></small></p>
			<div id="behavioral-assessment-questions">
				<?php foreach($behavioral_assessment_question as $i => $baq): ?>
				<p>
					<strong><?=$bai++?>. <?=$baq?>:</strong>
					<?=$ba[$i]?>
				</p>
				<?php endforeach; ?>
			</div>
			<div id="behavioral-assessment-results">
				<?=bigfive_results($link)?>
			</div>

			<?php else: ?>
			<p class="text-center tooltip" data-tooltip="Aluno ainda não iniciou este módulo"><span class="chip">Avaliação Comportamental</span></p>
			<?php endif; ?>

		</div>
		<?php endif; ?>

		<p class="text-center text-<?=get_color()?>" id="message"><?=get_message()?></p>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

	<script>
		// MUDANÇA DE RESULTADOS E PERGUNTAS DA AVALIAÇÃO COMPORTAMENTAL
		$("div[id='behavioral-assessment-results'").hide();
		let questions = true;
		function change() {
			if(questions) {
				$("div[id='behavioral-assessment-questions'").hide();
				$("div[id='behavioral-assessment-results'").show();
			}
			else {
				$("div[id='behavioral-assessment-questions'").show();
				$("div[id='behavioral-assessment-results'").hide();
			}
			questions = !questions;
		}
	</script>

</body>

</html>
