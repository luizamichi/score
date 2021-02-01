<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS E FUNÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");


if(request_method() === "POST" && isset($_POST["alias"], $_POST["password"]) && !user_is_logined()) { // VALIDA SE O MÉTODO ENVIADO ESTÁ CORRETO, SE OS DADOS NECESSÁRIOS FORAM ENVIADOS E SE O USUÁRIO ESTÁ LOGADO NO SISTEMA
	// FILTRA OS VALORES PASSADOS VIA POST
	$alias = clean_text($_POST["alias"]);
	$password = clean_text($_POST["password"]);

	// SALVA OS VALORES NA SESSÃO, CASO PRECISE COMPLETAR OS CAMPOS DE ENTRADA
	set_data("alias", $alias);
	set_data("password", $password);

	if($alias && $password) { // USUÁRIO INFORMOU O APELIDO E A SENHA CORRETOS
		$query = "select * from users where `alias`='" . $alias . "' and `password`='" . md5($password) . "';";
		$users = sql_query($query);

		if(!empty($users)) { // ENCONTROU UM USUÁRIO QUE CORRESPONDE COM OS DADOS INFORMADOS
			$user = $users[0];

			// VERIFICA SE O USUÁRIO É UM ADMINISTRADOR
			$query = "select * from administrators where `user`=" . $user["id"] . ";";
			$administrators = sql_query($query);

			// VERIFICA SE O USUÁRIO É UM ALUNO
			$query = "select * from students where `user`=" . $user["id"] . ";";
			$students = sql_query($query);

			if(!empty($administrators)) { // O USUÁRIO É UM ADMINISTRADOR
				$user["administrator"] = $administrators[0]["id"];
				start_administrator_session($user);
			}

			elseif(!empty($students)) { // O USUÁRIO É UM ALUNO
				$user["student"] = $students[0]["id"];
				start_student_session($user);
			}

			// GRAVA A OPERAÇÃO DE LOGIN NO LOG
			record_log((isset($user["administrator"]) ? "Administrator" : (isset($user["student"]) ? "Student" : "User")) . " (" . $user["id"] . "-" . (isset($user["administrator"]) ? $user["administrator"] : (isset($user["student"]) ? $user["student"] : "null")) . ":" . $user["name"] . ") logged in (" . $alias . ":" . $password . ")");

			// APAGA OS DADOS ARMAZENADOS NA SESSÃO
			get_data("alias");
			get_data("password");
		}

		else { // NÃO FOI ENCONTRADO NENHUM USUÁRIO (ALUNO OU ADMINISTRADOR)
			strlen(get_message(false)) > 0 ?: set_message("Os dados informados estão incorretos. Verifique o CPF e a senha.");
		}
	}
}


// REDIRECIONA PARA A PÁGINA PRINCIPAL, QUE IRÁ REDIRECIONAR PARA A PÁGINA CORRETA
redirect(BASE_NAME);
