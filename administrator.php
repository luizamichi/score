<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS
require_once(__DIR__ . "/configurations.php");


// DEFINE AS ROTAS DAS AÇÕES DO PAINEL ADMINISTRATIVO
define("ACTION_ROUTES", [
	// CÁLCULO COMPORTAMENTAL DO USUÁRIO (ALUNO)
	"action/admin/student/calculate" => ACTION_PATH . "calculate_student.php",

	// CONSULTA DE USUÁRIO
	"action/admin/student/search" => ACTION_PATH . "search_student.php",

	// CADASTRO DE USUÁRIO
	"action/admin/student/insert" => ACTION_PATH . "insert_student.php",

	// ALTERAÇÃO DE USUÁRIO
	"action/admin/student/update" => ACTION_PATH . "update_student.php",

	// REMOÇÃO DE USUÁRIO
	"action/admin/student/remove" => ACTION_PATH . "remove_student.php",

	// LOGOUT
	"action/logout" => ACTION_PATH . "logout.php"
]);


// DEFINE AS ROTAS DAS PÁGINAS DO PAINEL ADMINISTRATIVO
define("VIEW_ROUTES", [
	// TELA INICIAL
	"" => VIEW_PATH . "list_student.php",
	"list" => VIEW_PATH . "list_student.php",
	"list/" => VIEW_PATH . "list_student.php",
	"admin/list" => VIEW_PATH . "list_student.php",

	// TELA DE CONSULTA
	"search" => VIEW_PATH . "search_student.php",
	"search/" => VIEW_PATH . "search_student.php",
	"admin/search" => VIEW_PATH . "search_student.php",

	// TELA DE INSERÇÃO
	"insert" => VIEW_PATH . "insert_student.php",
	"insert/" => VIEW_PATH . "insert_student.php",
	"admin/insert" => VIEW_PATH . "insert_student.php",

	// TELA DE ALTERAÇÃO
	"update" => VIEW_PATH . "update_student.php",
	"update/" => VIEW_PATH . "update_student.php",
	"admin/update" => VIEW_PATH . "update_student.php",

	// TELA DE VISUALIZAÇÃO
	"view" => VIEW_PATH . "view_student.php",
	"view/" => VIEW_PATH . "view_student.php",
	"admin/view" => VIEW_PATH . "view_student.php"
]);
