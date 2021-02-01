<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ALUNOS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../student.php");


if(request_method() === "POST" && user_is_logined() && user_is_student()) { // VALIDA SE O MÉTODO ENVIADO ESTÁ CORRETO E SE O USUÁRIO (ALUNO) ESTÁ LOGADO NO SISTEMA
	$level = what_is_the_level();
	$stage = step_identifier(FORM_STAGES[9], 10);

	// CRIA UM FORMULÁRIO EM BRANCO
	$questions = fourth_step_form($empty=true);

	// VALIDADOR SE DEVE SALVAR E SAIR
	$logout = isset($_POST["logout"]) ? (bool) clean_text($_POST["logout"]) : false;

	if($level["module"] === FORM_MODULES[3] && !$level["started"]) { // USUÁRIO DESEJA INICIAR O FORMULÁRIO (AVALIAÇÃO COMPORTAMENTAL - QUARTA ETAPA)
		// INSERE AS RESPOSTAS EM CADA PERGUNTA CORRESPONDENTE
		$response = fills_in_empty_responses($questions, $questions);

		// INSERE NO BANCO DE DADOS QUE O USUÁRIO INICIOU O PREENCHIMENTO DA AVALIAÇÃO COMPORTAMENTAL - QUARTA ETAPA
		$rows = insert_form($stage, $response);

		if($rows) { // GRAVA A OPERAÇÃO DE INSERÇÃO NO LOG
			record_log("Student (" . get_user()["id"] . "-" . get_user()["student"] . ":" . get_user()["name"] . ") started the form 'Behavioral Assessment - Fourth Step' (" . $stage . ":" . $response . ")");
		}
	}

	elseif($level["module"] === FORM_MODULES[3] && !$level["finished"]) { // USUÁRIO INICIOU O FORMULÁRIO (AVALIAÇÃO COMPORTAMENTAL - QUARTA ETAPA) E DESEJA TERMINAR A ETAPA OU SAIR
		// INSERE AS RESPOSTAS EM CADA PERGUNTA CORRESPONDENTE
		$responses = remove_excessive_spaces($_POST);
		$response = fills_in_empty_responses($questions, $responses);

		// ATUALIZA AS INFORMAÇÕES NO BANCO DE DADOS
		update_form($stage, $response, !$logout);

		// GRAVA A OPERAÇÃO DE ALTERAÇÃO NO LOG
		record_log("Student (" . get_user()["id"] . "-" . get_user()["student"] . ":" . get_user()["name"] . ") " . ($logout ? "changed" : "finished") . " the form 'Behavioral Assessment - Fourth Step' (" . $stage . ":" . $response . ")");

		if(!$logout) { // O USUÁRIO FINALIZOU TODAS AS QUESTÕES
			// COMUNICA-SE COM A API DO BIGFIVE PARA SALVAR AS PERGUNTAS
			$url = BIGFIVE_API . "save";
			$curl = curl_init($url);

			$json = http_build_query([
				"testId" => "b5-120",
				"lang" => "pt-br",
				"invalid" => "false",
				"answers" => behavioral_assessment_api(get_user()["student"]),
				"timeElapsed" => behavioral_assessment_time(get_user()["student"]),
				"dateStamp" => strtotime(fourth_step_end_time(get_user()["student"])),
				"userId" => (string) get_user()["student"]
			]);

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
			$response = curl_exec($curl);

			$response = json_decode($response);
			$response = isset($response->id) ? $response->id : null;
			curl_close($curl);

			// CRIA UM NOVO CAMPO NO BANCO DE DADOS DE ANÁLISE
			$query = "insert into analysis (`student`, `situation`, `certificate`, `link`, `identifier`) values (";
			$query .= get_user()["student"] . ", 1, null, " . ($response ? "'" . $response . "'" : "null") . ", '" . date("Ymd") . strtoupper(bin2hex(random_bytes(2))) . "');";
			$rows = sql_query($query);

			if($rows && $response) { // GRAVA A OPERAÇÃO DE CÁLCULO NO LOG
				$json = get_bigfive($response);
				record_log("Student (" . get_user()["id"] . "-" . get_user()["student"] . ":" . get_user()["name"] . ") calculated your score (" . $response . ":" . json_encode($json) . ")");
			}

			// ENVIA UM E-MAIL COMUNICANDO QUE O USUÁRIO FINALIZOU O TESTE
			$subject = "Mais um aluno acaba de concluir o questionário do SCORE";
			$headers = "From: " . MAIL_FROM;

			$message = "Olá, o(a) aluno(a) " . get_user()["name"] . " finalizou o questionário do SCORE. As respostas estão disponíveis no painel admistrativo da plataforma.";
			if(!$response) {
				$message .= " É necessário calcular a avaliação comportamental, pois não foi possível comunicar-se com o servidor do BigFive.";
			}
			mail(MAIL_TO, $subject, $message, $headers);
		}
	}
}


if(isset($logout) && $logout) { // VERIFICA SE DEVE REALIZAR LOGOUT
	redirect(ACTION_NAME . "logout");
}

else { // REDIRECIONA PARA A PÁGINA PRINCIPAL, QUE IRÁ REDIRECIONAR PARA A PÁGINA CORRETA (PRÓXIMA PÁGINA: AVALIAÇÃO FINALIZADA)
	redirect(BASE_NAME);
}
