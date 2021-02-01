<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS E CONFIGURAÇÕES DE ADMINISTRADORES
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../administrator.php");


if(request_method() === "GET" && isset($_GET["id"]) && user_is_logined() && user_is_administrator()) { // VALIDA SE O MÉTODO ENVIADO ESTÁ CORRETO, SE O DADO NECESSÁRIO FOI ENVIADO E SE O USUÁRIO (ADMINISTRADOR) ESTÁ LOGADO NO SISTEMA
	// FILTRA O VALOR PASSADO VIA POST
	$id = is_numeric($_GET["id"]) ? clean_text($_GET["id"]) : 0;

	// PROCURA PELO USUÁRIO NO BANCO DE DADOS
	$query = "select users.`id`, users.`name`, users.`alias`, users.`password`, users.`registration_date`, administrators.`id` `ref_id` from users inner join administrators on users.`id`=administrators.`user` where users.`id`=" . $id . ";";
	$administrators = sql_query($query);
	$query = "select users.`id`, users.`name`, users.`alias`, users.`password`, users.`registration_date`, students.`id` `ref_id` from users inner join students on users.`id`=students.`user` where users.`id`=" . $id . ";";
	$students = sql_query($query);

	$rows = !empty($administrators) ? $administrators : (!empty($students) ? $students : []);
	if(!empty($rows)) { // O USUÁRIO EXISTE
		$user = $rows[0];

		if(!empty($administrators)) { // O USUÁRIO É UM ADMINISTRADOR
			$query = "delete from administrators where `user`=" . $user["id"] . ";";
		}

		elseif(!empty($students)) { // O USUÁRIO É UM ALUNO
			$query = "delete from students where `user`=" . $user["id"] . ";";

			$query .= "delete from forms where `student`=" . $user["ref_id"] . ";";
			$query .= "delete from analysis where `student`=" . $user["ref_id"] . ";";
		}

		$query .= "delete from users where `id`=" . $user["id"] . ";";
		$rows = sql_query($query);

		if(!$rows) {
			set_message("Não foi possível remover o usuário.");
		}

		else { // A OPERAÇÃO DE REMOÇÃO FOI EFETUADA COM SUCESSO
			// GRAVA A OPERAÇÃO DE REMOÇÃO NO LOG
			record_log("Administrator (" . get_user()["id"] . "-" . get_user()["administrator"] . ":" . get_user()["name"] . ") removed the " . (!empty($administrators) ? "administrator" : (!empty($students) ? "student" : "user")) . " (" . $users["id"] . "-" . $user["ref_id"] . ":" . $users["name"] . ")");

			set_color("blue");
			set_message("Usuário removido com sucesso.");
		}

		if($rows && $user["id"] === get_user()["id"]) { // O USUÁRIO É UM ADMINISTRADOR E SE REMOVEU
			$logout = true;
		}
	}

	else { // O USUÁRIO INFORMOU UM IDENTIFICADOR INVÁLIDO
		set_message("Não foi encontrado nenhum usuário.");
	}
}


if(isset($logout)) { // VERIFICA SE DEVE REALIZAR LOGOUT (USUÁRIO SE REMOVEU)
	redirect(ACTION_NAME . "logout");
}

else { // REDIRECIONA PARA A PÁGINA DE CONSULTA DE USUÁRIO
	$search = isset($_GET["search"]) ? "?search=" . $_GET["search"] : "";
	redirect(BASE_NAME . "admin/search" . $search);
}
