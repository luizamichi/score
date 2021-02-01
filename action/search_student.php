<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS E CONFIGURAÇÕES DE ADMINISTRADORES
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../administrator.php");


if(request_method() === "GET" && isset($_GET["search"]) && user_is_logined() && user_is_administrator()) { // VALIDA SE O MÉTODO ENVIADO ESTÁ CORRETO, SE O DADO NECESSÁRIO FOI ENVIADO E SE O USUÁRIO (ADMINISTRADOR) ESTÁ LOGADO NO SISTEMA
	// FILTRA O VALOR PASSADO VIA GET
	$search = clean_text($_GET["search"]);

	// VERIFICA SE HÁ ALGUM USUÁRIO COM O MESMO NOME OU CPF INFORMADO
	$query = "select * from users where `alias` like concat('%" . $search . "%') or `name` like concat('%" . $search . "%') order by `name`;";
	$rows = sql_query($query);

	if(!empty($rows)) { // SALVA OS USUÁRIOS ENCONTRADOS NA SESSÃO
		set_users($rows);

		// GRAVA A OPERAÇÃO DE CONSULTA NO LOG
		record_log("Administrator (" . get_user()["id"] . "-" . get_user()["administrator"] . ":" . get_user()["name"] . ") searched for users with alias or name '" . $search . "'");
	}

	else {
		strlen(get_message(false)) > 0 ?: set_message("Não foi encontrado nenhum usuário.");
	}
}
