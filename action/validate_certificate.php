<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS E FUNÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");

// CONFIGURA O ACESSO VIA AJAX
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: X-Requested-With");


if(request_method() === "GET" && isset($_GET["certificate"])) { // VALIDA SE O MÉTODO ENVIADO ESTÁ CORRETO E SE O DADO NECESSÁRIO FOI ENVIADO
	// FILTRA OS VALORES PASSADOS VIA GET
	$certificate = strtoupper(clean_text($_GET["certificate"]));

	if($certificate) { // USUÁRIO INFORMOU O IDENTIFICADOR CORRETO
		$query = "select * from analysis where `identifier`='" . $certificate . "'";
		$query .= " and `certificate` is not null and `situation`=(select `id` from situations where `name`='Certificado de Conclusão');";
		$certificates = sql_query($query);

		if(!empty($certificates)) { // ENCONTROU UM CERTIFICADO VINCULADO A UM ALUNO
			$certificate = $certificates[0];
			$link = $certificate["certificate"];

			// CARREGAR OS DADOS DO ALUNO PARA EXIBIR
			$query = "select users.`name` from users inner join students on users.`id`=students.`user` where students.`id`=" . $certificate["student"] . ";";
			$student = sql_query($query);

			if(!empty($student)) { // GRAVA A OPERAÇÃO DE VALIDAÇÃO NO LOG
				record_log("User has validated the student certificate '" . $student[0]["name"] . "' (" . $link . ")");
			}

			echo json_encode(["message" => "Certificado validado, vinculado a(o) aluno(a) " . $student[0]["name"] . ".", "link" => FILE_NAME . $link]);
		}

		else {
			echo json_encode(["message" => "Não foi encontrado nenhum certificado."]);
		}
	}

	else {
		echo json_encode(["message" => "Identificador inválido."]);
	}
}

else {
	echo json_encode(["message" => "Não foi informado nenhum identificador."]);
}
