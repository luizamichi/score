<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS
require_once(__DIR__ . "/configurations.php");


// DEFINE AS ROTAS DAS AÇÕES DO SISTEMA
define("ACTION_ROUTES", [
	// LOGIN E LOGOUT
	"action/login" => ACTION_PATH . "login.php",
	"action/logout" => ACTION_PATH . "logout.php",

	// VALIDADOR DE CERTIFICADO
	"action/certificate" => ACTION_PATH . "validate_certificate.php",

	// DADOS PESSOAIS
	"action/personal-data" => ACTION_PATH . "initial_registration.php",
	"action/personal-data/initial-registration" => ACTION_PATH . "initial_registration.php",

	// AVALIAÇÃO TÉCNICA
	"action/technical-evaluation" => ACTION_PATH . "role_knowledge.php",
	"action/technical-evaluation/role-knowledge" => ACTION_PATH . "role_knowledge.php",
	"action/technical-evaluation/specific-technical-knowledge" => ACTION_PATH . "specific_technical_knowledge.php",
	"action/technical-evaluation/operational-safety-and-regulation" => ACTION_PATH . "operational_safety_and_regulation.php",
	"action/technical-evaluation/previous-experiences" => ACTION_PATH . "previous_experiences.php",

	// NÍVEL DE INGLÊS
	"action/english-level" => ACTION_PATH . "medium_english.php",
	"action/english-level/medium" => ACTION_PATH . "medium_english.php",

	// AVALIAÇÃO COMPORTAMENTAL
	"action/behavioral-assessment" => ACTION_PATH . "first_step.php",
	"action/behavioral-assessment/first-step" => ACTION_PATH . "first_step.php",
	"action/behavioral-assessment/second-step" => ACTION_PATH . "second_step.php",
	"action/behavioral-assessment/third-step" => ACTION_PATH . "third_step.php",
	"action/behavioral-assessment/fourth-step" => ACTION_PATH . "fourth_step.php"
]);


// DEFINE AS ROTAS DAS PÁGINAS DO SISTEMA
define("VIEW_ROUTES", [
	// PÁGINA INICIAL
	"index" => VIEW_PATH . "index.php",

	// TELA DE LOGIN
	"login" => VIEW_PATH . "login.php",

	// DADOS PESSOAIS
	"personal-data" => VIEW_PATH . "initial_registration.php",
	"personal-data/initial-registration" => VIEW_PATH . "initial_registration.php",

	// AVALIAÇÃO TÉCNICA
	"technical-evaluation" => VIEW_PATH . "technical_evaluation.php",
	"technical-evaluation/role-knowledge" => VIEW_PATH . "role_knowledge.php",
	"technical-evaluation/specific-technical-knowledge" => VIEW_PATH . "specific_technical_knowledge.php",
	"technical-evaluation/operational-safety-and-regulation" => VIEW_PATH . "operational_safety_and_regulation.php",
	"technical-evaluation/previous-experiences" => VIEW_PATH . "previous_experiences.php",

	// NÍVEL DE INGLÊS
	"english-level" => VIEW_PATH . "english_level.php",
	"english-level/medium" => VIEW_PATH . "medium_english.php",

	// AVALIAÇÃO COMPORTAMENTAL
	"behavioral-assessment" => VIEW_PATH . "behavioral_assessment.php",
	"behavioral-assessment/first-step" => VIEW_PATH . "first_step.php",
	"behavioral-assessment/second-step" => VIEW_PATH . "second_step.php",
	"behavioral-assessment/third-step" => VIEW_PATH . "third_step.php",
	"behavioral-assessment/fourth-step" => VIEW_PATH . "fourth_step.php",

	// PÁGINA FINAL
	"finished" => VIEW_PATH . "finished.php"
]);


// NÍVEIS DE PERGUNTAS
define("FORM_LEVELS", [
	"Cadastro Inicial" => [
		"Dados Pessoais"
	],

	"Avaliação Técnica" => [
		"Conhecimento da Função",
		"Conhecimento Técnico Específico",
		"Segurança Operacional e Regulação",
		"Experiências Anteriores"
	],

	"Nível de Inglês" => [
		"Inglês Médio"
	],

	"Avaliação Comportamental" => [
		"Primeira Etapa",
		"Segunda Etapa",
		"Terceira Etapa",
		"Quarta Etapa"
	]
]);


// MÓDULOS
define("FORM_MODULES", array_keys(FORM_LEVELS));


// ETAPAS
define("FORM_STAGES", array_reduce(FORM_LEVELS, function(?array $carry, array $item): array {
	$carry = $carry ? array_merge($carry, $item) : $item;
	return $carry;
}));


// CAMINHOS PARA CADA MÓDULO
define("MODULE_ROUTES", [
	"Cadastro Inicial" => VIEW_ROUTES["personal-data"],
	"Avaliação Técnica" => VIEW_ROUTES["technical-evaluation"],
	"Nível de Inglês" => VIEW_ROUTES["english-level"],
	"Avaliação Comportamental" => VIEW_ROUTES["behavioral-assessment"]
]);


// CAMINHOS PARA CADA ETAPA
define("STAGES_ROUTES", [
	"Dados Pessoais" => VIEW_ROUTES["personal-data/initial-registration"],
	"Conhecimento da Função" => VIEW_ROUTES["technical-evaluation/role-knowledge"],
	"Conhecimento Técnico Específico" => VIEW_ROUTES["technical-evaluation/specific-technical-knowledge"],
	"Segurança Operacional e Regulação" => VIEW_ROUTES["technical-evaluation/operational-safety-and-regulation"],
	"Experiências Anteriores" => VIEW_ROUTES["technical-evaluation/previous-experiences"],
	"Inglês Médio" => VIEW_ROUTES["english-level/medium"],
	"Primeira Etapa" => VIEW_ROUTES["behavioral-assessment/first-step"],
	"Segunda Etapa" => VIEW_ROUTES["behavioral-assessment/second-step"],
	"Terceira Etapa" => VIEW_ROUTES["behavioral-assessment/third-step"],
	"Quarta Etapa" => VIEW_ROUTES["behavioral-assessment/fourth-step"]
]);


// ETAPAS DE ANÁLISE PÓS ENVIO DO FORMULÁRIO
define("ANALYSIS", [
	"Formulário Finalizado",
	"Avaliação Devolutiva",
	"Certificado de Conclusão"
]);
