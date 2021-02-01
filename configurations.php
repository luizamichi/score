<?php
// DEFINE A LOCALIDADE PARA O FUSO HORÁRIO DO BRASIL
setlocale(LC_ALL, "pt_BR.utf-8", "pt_BR", "pt_BR.iso-8859-1", "portuguese");
date_default_timezone_set("America/Sao_Paulo");
define("DATE_FORMAT", new IntlDateFormatter("pt_BR", IntlDateFormatter::FULL, IntlDateFormatter::NONE, "America/Sao_Paulo", IntlDateFormatter::GREGORIAN, "EEEE, d 'de' MMMM 'de' yyyy 'às' HH:mm"));

// NOME DO SISTEMA
define("SYSTEM_NAME", "SCORE");


// AUTOR E DESENVOLVEDOR DO SISTEMA
define("SYSTEM_AUTHOR", "Luiz Joaquim Aderaldo Amichi");


// CONSTANTE DE AMBIENTE DE EXECUÇÃO (DESENVOLVIMENTO OU PRODUÇÃO)
define("ENVIRONMENT", "DEVELOPMENT");


// DEFINE O DOMÍNIO DO SITE E O SERVIDOR COM O BANCO DE DADOS
switch(ENVIRONMENT) {
	// AMBIENTE DE DESENVOLVIMENTO
	case "DEVELOPMENT":
	case "DESENVOLVIMENTO":
		define("BASE_NAME", "/score/");
		define("SQL_HOST", "2.57.91.5");
		define("SQL_PORT", 3306);
		define("SQL_USER", "u595154172_score2021");
		define("SQL_PASS", "Q8|pWf8g~nO5hhmmWFA;aN8=");
		define("SQL_SCHEMA", "u595154172_score2021");
		break;

	// AMBIENTE DE PRODUÇÃO
	case "PRODUCTION":
	case "PRODUÇÃO":
	default:
		define("BASE_NAME", isset($_SERVER["REQUEST_SCHEME"], $_SERVER["HTTP_HOST"], $_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] : "https://luizamichi.com.br/score/");
		define("SQL_HOST", "srv440.hstgr.io");
		define("SQL_PORT", 3306);
		define("SQL_USER", "u595154172_score");
		define("SQL_PASS", "2I>An~S/Vr~#aq>^=T1z*gHww8@L5k");
		define("SQL_SCHEMA", "u595154172_score");
		break;
}


// INICIA A SESSÃO E RENOMEIA O NOME DO COOKIE DE SESSÃO PARA O NOME DO SISTEMA
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_set_cookie_params(["samesite" => "Lax"]);
	session_name(SYSTEM_NAME);
	session_start();
}


// CAMINHO DOS DIRETÓRIOS ACESSÍVEIS DO WEBSITE
define("ACTION_NAME", BASE_NAME . "action/");
define("FILE_NAME", BASE_NAME . "certificate/");
define("MEDIA_NAME", BASE_NAME . "media/");
define("SCRIPT_NAME", BASE_NAME . "js/");
define("STYLE_NAME", BASE_NAME . "css/");


// MODO DE DEPURAÇÃO
if(in_array(ENVIRONMENT, ["DEVELOPMENT", "DESENVOLVIMENTO"])) {
	ini_set("display_errors", 1);
	ini_set("display_startup_errors", 1);
	error_reporting(E_ALL);
}


// DEFINE SE ATIVA O MODO DE MANUTENÇÃO (DESABILITA O ACESSO AO SISTEMA)
define("MAINTENANCE_MODE", false);


// DEFINE SE ATIVA O TEMA ESCURO
define("DARK_THEME", false);


// DEFINE O URL DA API DO BIGFIVE
define("BIGFIVE_API", "http://3.225.217.9:3001/");


// DEFINE AS CONFIGURAÇÕES DO SERVIDOR DE E-MAIL
define("MAIL_SMTP_ADDRESS", "smtp.mail.us-east-1.awsapps.com");
define("MAIL_SMTP_PORT", 465);
define("MAIL_TO", "contato@airtalent.com.br");
define("MAIL_FROM", "no-reply@airtalent.com.br");
define("MAIL_PASS", "efUxR7Vouj4SB16ReGShzD7x");


// DEFINE O CAMINHO PARA A RAIZ DO SISTEMA
define("ROOT_PATH", dirname(__FILE__) . DIRECTORY_SEPARATOR);


// CAMINHOS PARA AÇÕES (GET E POST), INCLUSÕES (TEMPLATES) E VISÕES (TELAS)
define("ACTION_PATH", ROOT_PATH . "action" . DIRECTORY_SEPARATOR);
define("INC_PATH", ROOT_PATH . "inc" . DIRECTORY_SEPARATOR);
define("VIEW_PATH", ROOT_PATH . "view" . DIRECTORY_SEPARATOR);


// CAMINHOS PARA ARQUIVOS FIXOS (CSS, MÍDIAS E SCRIPTS)
define("STYLE_PATH", ROOT_PATH . "css" . DIRECTORY_SEPARATOR);
define("MEDIA_PATH", ROOT_PATH . "media" . DIRECTORY_SEPARATOR);
define("SCRIPT_PATH", ROOT_PATH . "script" . DIRECTORY_SEPARATOR);


// CAMINHO DOS DIRETÓRIOS DE LOGS DE ERROS E CERTIFICADOS PDF
define("LOG_PATH", ROOT_PATH . "log" . DIRECTORY_SEPARATOR);
define("FILE_PATH", ROOT_PATH . "certificate" . DIRECTORY_SEPARATOR);


// DEFINE AS ROTAS PARA OS ARQUIVOS DE INCLUSÕES (TEMPLATES HTML)
define("INC_ROUTES", [
	// RODAPÉ COM IMPORTAÇÕES DE SCRIPTS
	"footer" => INC_PATH . "footer.php",

	// INÍCIO DO HTML COM AS INFORMAÇÕES DE SEO
	"head" => INC_PATH . "head.php",

	// CABEÇALHO DO SISTEMA
	"header" => INC_PATH . "header.php",

	// MENU SUPERIOR DOS MÓDULOS
	"navbar" => INC_PATH . "navbar.php",

	// MENU SUPERIOR DA CONCLUSÃO
	"phase" => INC_PATH . "phase.php",

	// MENU SUPERIOR DAS ETAPAS
	"step" => INC_PATH . "step.php",

	// MENU SUPERIOR DAS FUNÇÕES ADMINISTRATIVAS
	"tab" => INC_PATH . "tab.php"
]);
