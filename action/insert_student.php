<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS E CONFIGURAÇÕES DE ADMINISTRADORES
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../administrator.php");


if(request_method() === "POST" && isset($_POST["name"], $_POST["alias"], $_POST["password"], $_POST["type"]) && user_is_logined() && user_is_administrator()) { // VALIDA SE O MÉTODO ENVIADO ESTÁ CORRETO, SE OS DADOS NECESSÁRIOS FORAM ENVIADOS E SE O USUÁRIO (ADMINISTRADOR) ESTÁ LOGADO NO SISTEMA
	// FILTRA OS VALORES PASSADOS VIA POST
	$name = clean_text($_POST["name"]);
	$alias = clean_text($_POST["alias"]);
	$password = clean_text($_POST["password"]);
	$type = clean_text($_POST["type"]);
	$registration_date = date("Y-m-d H:i:s");

	// VERIFICA SE HÁ ALGUM USUÁRIO COM O MESMO CPF
	$query = "select * from users where `alias`='" . $alias . "';";
	$rows = sql_query($query);

	if((strlen($name) < 6 || strlen($name) > 64) || (strlen($alias) < 6 || strlen($alias) > 16) || strlen($password) < 6) { // O TAMANHO DOS DADOS É ILEGAL
		$error = true;
		set_message("Verifique o tamanho dos dados informados.");
	}

	elseif(!validate_cpf($alias)) { // O CPF É INVÁLIDO
		$error = true;
		set_message("O CPF informado é inválido.");
	}

	elseif(!empty($rows)) { // O CPF JÁ ESTÁ VINCULADO A UM USUÁRIO
		$error = true;
		set_message("Já existe um usuário cadastrado com o CPF informado.");
	}

	else { // CADASTRA O USUÁRIO NO BANCO DE DADOS
		$query = "insert into users (`name`, `alias`, `password`, `registration_date`) values (";
		$query .= "'" . $name . "', '" . $alias . "', '" . md5($password) . "', '" . $registration_date . "');";
		$rows = sql_query($query);

		// BUSCA O IDENTIFICADOR DO USUÁRIO E VINCULA A UM ADMINISTRADOR OU A UM ALUNO
		$query = "select * from users where `registration_date`='" . $registration_date . "' order by `id` desc limit 1;";
		$rows = sql_query($query);
		$id = isset($rows[0]["id"]) ? $rows[0]["id"] : 0;

		if($type === "administrator") { // CADASTRA O USUÁRIO COMO ADMINISTRADOR
			$query = "insert into administrators (`user`) values (";
			$query .= $id . ");";
		}

		else { // CADASTRA O USUÁRIO COMO ALUNO
			$query = "insert into students (`user`) values (";
			$query .= $id . ");";
		}

		$rows = sql_query($query);

		if($rows) { // A OPERAÇÃO DE CADASTRO FOI EFETUADA COM SUCESSO
			// GRAVA A OPERAÇÃO DE INSERÇÃO NO LOG
			record_log("Administrator (" . get_user()["id"] . "-" . get_user()["administrator"] . ":" . get_user()["name"] . ") registered a new " . $type . " user (" . $id . "-" . $name . ":" . $password . ")");

			set_color("blue");
			set_message("Usuário cadastrado com sucesso.");
		}

		else { // HOUVE UM ERRO INTERNO NO MYSQL AO SALVAR
			$error = true;
			strlen(get_message(false)) > 0 ?: set_message("Ocorreu um erro com o banco de dados ao cadastrar o usuário.");
		}
	}
}


if(isset($error)) { // USUÁRIO INFORMOU DADOS INCORRETOS, ENTÃO SALVA OS DADOS NA SESSÃO PARA NÃO SER NECESSÁRIO REDIGITÁ-LOS NOVAMENTE
	set_data("name", $name);
	set_data("alias", $alias);
	set_data("password", $password);
	set_data("type", $type);
}

// REDIRECIONA PARA A PÁGINA DE CADASTRO DE USUÁRIO
redirect(BASE_NAME . "admin/insert");
