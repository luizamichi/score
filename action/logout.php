<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS E FUNÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");


if(user_is_logined()) { // VALIDA SE O USUÁRIO ESTÁ LOGADO NO SISTEMA
	// GRAVA A OPERAÇÃO DE LOGOUT NO LOG
	record_log((user_is_administrator() ? "Administrator" : (user_is_student() ? "Student" : "User")) . " (" . get_user()["id"] . "-" . (user_is_administrator() ? get_user()["administrator"] : (user_is_student() ? get_user()["student"] : "null")) . ":" . get_user()["name"] . ") logged out");

	// REMOVE TODOS OS DADOS DA SESSÃO
	destroy_all_sessions($message=false, $color=false);

	set_color("blue");
	set_message("Logout efetuado.");
}


// REDIRECIONA PARA A PÁGINA PRINCIPAL, QUE IRÁ REDIRECIONAR PARA A PÁGINA DE LOGIN
redirect(BASE_NAME);
