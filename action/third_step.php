<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ALUNOS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../student.php");


if(request_method() === "POST" && user_is_logined() && user_is_student()) { // VALIDA SE O MÉTODO ENVIADO ESTÁ CORRETO E SE O USUÁRIO (ALUNO) ESTÁ LOGADO NO SISTEMA
	$level = what_is_the_level();
	$stage = step_identifier(FORM_STAGES[8], 9);

	// CRIA UM FORMULÁRIO EM BRANCO
	$questions = third_step_form($empty=true);

	// VALIDADOR SE DEVE SALVAR E SAIR
	$logout = isset($_POST["logout"]) ? (bool) clean_text($_POST["logout"]) : false;

	if($level["module"] === FORM_MODULES[3] && !$level["started"]) { // USUÁRIO DESEJA INICIAR O FORMULÁRIO (AVALIAÇÃO COMPORTAMENTAL - TERCEIRA ETAPA)
		// INSERE AS RESPOSTAS EM CADA PERGUNTA CORRESPONDENTE
		$response = fills_in_empty_responses($questions, $questions);

		// INSERE NO BANCO DE DADOS QUE O USUÁRIO INICIOU O PREENCHIMENTO DA AVALIAÇÃO COMPORTAMENTAL - TERCEIRA ETAPA
		$rows = insert_form($stage, $response);

		if($rows) { // GRAVA A OPERAÇÃO DE INSERÇÃO NO LOG
			record_log("Student (" . get_user()["id"] . "-" . get_user()["student"] . ":" . get_user()["name"] . ") started the form 'Behavioral Assessment - Third Step' (" . $stage . ":" . $response . ")");
		}
	}

	elseif($level["module"] === FORM_MODULES[3] && !$level["finished"]) { // USUÁRIO INICIOU O FORMULÁRIO (AVALIAÇÃO COMPORTAMENTAL - TERCEIRA ETAPA) E DESEJA TERMINAR A ETAPA OU SAIR
		// INSERE AS RESPOSTAS EM CADA PERGUNTA CORRESPONDENTE
		$responses = remove_excessive_spaces($_POST);
		$response = fills_in_empty_responses($questions, $responses);

		// ATUALIZA AS INFORMAÇÕES NO BANCO DE DADOS
		update_form($stage, $response, !$logout);

		// GRAVA A OPERAÇÃO DE ALTERAÇÃO NO LOG
		record_log("Student (" . get_user()["id"] . "-" . get_user()["student"] . ":" . get_user()["name"] . ") " . ($logout ? "changed" : "finished") . " the form 'Behavioral Assessment - Third Step' (" . $stage . ":" . $response . ")");

		if(!$logout) { // CRIA UM NOVO CAMPO NO BANCO DE DADOS DO PRÓXIMO FORMULÁRIO, CASO O USUÁRIO DESEJA AVANÇAR PARA A PRÓXIMA ETAPA (AVALIAÇÃO COMPORTAMENTAL - QUARTA ETAPA)
			$questions = fourth_step_form($empty=true);
			$response = fills_in_empty_responses($questions, $questions);

			$rows = insert_form($stage + 1, $response);
			if($rows) { // GRAVA A OPERAÇÃO DE INSERÇÃO NO LOG
				record_log("Student (" . get_user()["id"] . "-" . get_user()["student"] . ":" . get_user()["name"] . ") started the form 'Behavioral Assessment - Fourth Step' (" . ($stage + 1) . ":" . $response . ")");
			}
		}
	}
}


if(isset($logout) && $logout) { // VERIFICA SE DEVE REALIZAR LOGOUT
	redirect(ACTION_NAME . "logout");
}

else { // REDIRECIONA PARA A PÁGINA PRINCIPAL, QUE IRÁ REDIRECIONAR PARA A PÁGINA CORRETA (PRÓXIMA PÁGINA: AVALIAÇÃO COMPORTAMENTAL - QUARTA ETAPA)
	redirect(BASE_NAME);
}
