<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS E CONFIGURAÇÕES DE ADMINISTRADORES
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../administrator.php");


if(request_method() === "POST" && isset($_POST["id"], $_POST["name"], $_POST["alias"], $_POST["password"]) && user_is_logined() && user_is_administrator()) { // VALIDA SE O MÉTODO ENVIADO ESTÁ CORRETO, SE OS DADOS NECESSÁRIOS FORAM ENVIADOS E SE O USUÁRIO (ADMINISTRADOR) ESTÁ LOGADO NO SISTEMA
	// FILTRA OS VALORES PASSADOS VIA POST
	$id = is_numeric($_POST["id"]) ? clean_text($_POST["id"]) : 0;
	$name = clean_text($_POST["name"]);
	$alias = clean_text($_POST["alias"]);
	$password = clean_text($_POST["password"]);
	$situation = isset($_POST["situation"]) ? clean_text($_POST["situation"]) : "";

	// VERIFICA SE HÁ ALGUM USUÁRIO COM O MESMO CPF
	$query = "select * from users where `alias`='" . $alias . "' and `id`!=" . $id . ";";
	$rows = sql_query($query);

	// VERIFICA O ÚLTIMO USUÁRIO CADASTRADO
	$query = "select max(`id`) from users;";
	$max = sql_query($query);
	$max = !empty($max) ? $max[0]["max(`id`)"] : 0;

	if($id <= 0 || $id > $max) { // O IDENTIFICADOR É INVÁLIDO
		set_message("O usuário não existe.");
	}

	elseif((strlen($name) < 6 || strlen($name) > 64) || (strlen($alias) < 6 || strlen($alias) > 16) || (strlen($password) > 0 && strlen($password) < 6)) { // O TAMANHO DOS DADOS É ILEGAL
		set_message("Verifique o tamanho dos dados informados.");
	}

	elseif(!validate_cpf($alias)) { // O CPF É INVÁLIDO
		set_message("O CPF informado é inválido.");
	}

	elseif(!empty($rows)) { // O CPF JÁ ESTÁ VINCULADO A UM USUÁRIO
		set_message("Já existe um usuário cadastrado com o CPF informado.");
	}

	else { // ALTERA O USUÁRIO NO BANCO DE DADOS
		$situations = ["Formulário Finalizado" => 1, "Avaliação Devolutiva" => 2, "Certificado de Conclusão" => 3];

		$query = "update users set `name`='" . $name . "', `alias`='" . $alias . "'";
		if(strlen($password) !== 0) {
			$query .= ", `password`='" . md5($password) . "'";
		}
		$query .= " where `id`=" . $id . ";";

		if($situation && in_array($situation, array_keys($situations))) {
			if($situation === "Certificado de Conclusão" && isset($_FILES["certificate"]) && !empty($_FILES["certificate"]["name"])) { // ENVIA O ARQUIVO DO CERTIFICADO
				$explode = explode(".", $_FILES["certificate"]["name"]);
				$filename = str_shuffle($alias) . "-" . date("YmdHis") . "." . end($explode);

				if(!is_dir(FILE_PATH)) { // NÃO EXISTE UM DIRETÓRIO PARA UPLOAD DE CERTIFICADOS
					mkdir(FILE_PATH);
				}
				move_uploaded_file($_FILES["certificate"]["tmp_name"], FILE_PATH . $filename);

				$query .= "update analysis set `situation`=" . $situations[$situation] . ", `certificate`='" . $filename . "' where `student`=" . get_student($id)[0]["ref_id"] . ";";
			}
			else {
				$query .= "update analysis set `situation`=" . $situations[$situation] . " where `student`=" . get_student($id)[0]["ref_id"] . ";";
			}
		}

		$rows = sql_query($query);

		if($rows) { // A OPERAÇÃO DE ALTERAÇÃO FOI EFETUADA COM SUCESSO
			set_color("blue");
			set_message("Usuário alterado com sucesso.");

			// GRAVA A OPERAÇÃO DE ALTERAÇÃO NO LOG
			record_log("Administrator (" . get_user()["id"] . "-" . get_user()["administrator"] . ":" . get_user()["name"] . ") updated a existent user (" . $id . ":" . $name . ":" . $alias . (strlen($password) !== 0 ? ":" . $password : "") . ")");

			// PROCURA OS CERTIFICADOS QUE ESTÃO VINCULADOS A REGISTROS NO BANCO DE DADOS
			$query = "select `certificate` from analysis;";
			$rows = sql_query($query);

			if(!empty($rows)) { // REMOVE OS ARQUIVOS QUE NÃO ESTÃO ASSOCIADOS A MAIS NENHUM REGISTRO
				$certificates = array_reduce($rows, function(?array $carry, array $item): array {
					$carry = $carry ?? [];
					array_push($carry, FILE_PATH . $item["certificate"]);
					return $carry;
				});

				$files = array_map(function(string $filename): string {
					return FILE_PATH . $filename;
				}, tree(FILE_PATH));

				remove_files(array_difference($certificates, $files));
			}
		}
	}
}


// REDIRECIONA PARA A PÁGINA DE ATUALIZAÇÃO DE USUÁRIO
redirect(BASE_NAME . "admin/update?id=" . $id);
