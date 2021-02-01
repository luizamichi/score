<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ADMINISTRADORES
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../administrator.php");


if(request_method() === "GET" && isset($_GET["student"]) && user_is_logined() && user_is_administrator()) { // VALIDA SE O MÉTODO ENVIADO ESTÁ CORRETO, SE O DADO NECESSÁRIO FOI ENVIADO E SE O USUÁRIO (ADMINISTRADOR) ESTÁ LOGADO NO SISTEMA
	// FILTRA O VALOR PASSADO VIA GET
	$student = clean_text($_GET["student"]);
	$student = is_numeric($student) ? (int) $student : 0;

	// VERIFICA SE HÁ ALGUM ALUNO COM O IDENTIFICADOR INFORMADO
	$query = "select users.* from users inner join students on users.`id`=students.`user` where students.`id`=" . $student . ";";
	$rows = sql_query($query);
	$id = !empty($rows) ? $rows[0]["id"] : 0;

	if(!empty($rows)) { // ENCONTROU UM ALUNO
		$query = "select * from analysis where `student`=" . $student . " and `link` is null;";
		$rows = sql_query($query);

		if(!empty($rows)) { // O ALUNO FINALIZOU O QUESTIONÁRIO E NÃO CALCULOU A AVALIAÇÃO COMPORTAMENTAL
			// COMUNICA-SE COM A API DO BIGFIVE PARA SALVAR AS PERGUNTAS
			$url = BIGFIVE_API . "save";
			$curl = curl_init($url);

			$json = http_build_query([
				"testId" => "b5-120",
				"lang" => "pt-br",
				"invalid" => "false",
				"answers" => behavioral_assessment_api($student),
				"timeElapsed" => behavioral_assessment_time($student),
				"dateStamp" => strtotime(fourth_step_end_time($student)),
				"userId" => (string) $student
			]);

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
			$response = curl_exec($curl);

			$response = json_decode($response);
			$response = isset($response->id) ? $response->id : null;
			curl_close($curl);

			if($response) { // CONSEGUIU CALCULAR A AVALIAÇÃO COMPORTAMENTAL
				// ATUALIZA O CAMPO NO BANCO DE DADOS DE ANÁLISE
				$query = "update analysis set `link`='" . $response . "' where `student`=" . $student . ";";
				$rows = sql_query($query);

				// OBTÉM O RESULTADO DO BIGFIVE PARA SALVAR NO LOG
				$json = get_bigfive($response);

				// GRAVA A OPERAÇÃO DE CÁLCULO NO LOG
				record_log("Administrator (" . get_user()["id"] . "-" . get_user()["administrator"] . ":" . get_user()["name"] . ") calculated the student's score (" . $student . "-" . $response . ":" . json_encode($json) . ")");

				set_color("blue");
				set_message("A avaliação comportamental foi calculada.");
			}

			else { // NÃO CONSEGUIU SE COMUNICAR COM O BIGFIVE
				set_color("red");
				set_message("Não foi possível estabelecer comunicação com o servidor.");
			}
		}

		else { // O ALUNO AINDA NÃO TERMINOU O QUESTIONÁRIO
			set_color("red");
			set_message("O aluno ainda não terminou o questionário.");
		}
	}

	else { // INFORMOU UM IDENTIFICADOR INEXISTENTE
		set_color("red");
		set_message("O aluno não existe.");
	}

	// REDIRECIONA PARA A PÁGINA DE VISUALIZAÇÃO DE USUÁRIO
	redirect(BASE_NAME . "admin/view?id=" . $id);
}


else { // REDIRECIONA PARA A PÁGINA DE CONSULTA DE USUÁRIO
	redirect(BASE_NAME . "admin/search");
}
