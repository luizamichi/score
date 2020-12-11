<?php

require_once("util.php");

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] != HOST . "formulario-1.php") {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Não enviou nenhum dado
if(empty($_POST)) {
	header("Location: ../formulario-1.php");
	return false;
}

// Usuário não está autenticado
if(empty($_SESSION) && !isset($_SESSION["id"])) {
	header("Location: ../index.php");
	return false;
}

$respostas = [];

// Elimina espaços excessivos e as tags chave
foreach($_POST as $pergunta => $resposta)
	$respostas[$pergunta] = str_replace("|$*|", "", trim($resposta));

$campos = [
	"pergunta-1" => "1. Nome",
	"pergunta-2" => "2. Sobrenome",
	"pergunta-3" => "3. E-mail",
	"pergunta-4" => "4. Telefone",
	"pergunta-5" => "5. Data de nascimento",
	"pergunta-6" => "6. Escolaridade",
	"pergunta-6-1" => "Qual curso?",
	"pergunta-6-2" => "Qual campo?",
	"pergunta-6-3" => "Universidade",
	"pergunta-6-4" => "Data de conclusão",
	"pergunta-7" => "7. Para qual cargo e função você gostaria de ser avaliado?",
	"pergunta-8" => "8. Qual seu nível atual de experiência?",
	"pergunta-9" => "9. Quais línguas você fala?",
	"pergunta-9-1" => "Inglês",
	"pergunta-9-2" => "Espanhol",
	"pergunta-9-3" => "Francês",
	"pergunta-9-4" => "Alemão",
	"pergunta-9-5" => "Outros",
	"pergunta-9-5-1" => "Quais?",
	"pergunta-10" => "10. Você tem experiência na área que pretende desenvolver no futuro?",
	"pergunta-11" => "11. Pretende mudar de área?",
	"pergunta-11-1" => "Porque?",
	"pergunta-12" => "12. Considerando as respostas da perguntas 7 e 8, onde você se imagina daqui a 5 anos?",
	"pergunta-13" => "13. Qual o emprego dos seus sonhos?",
	"pergunta-14" => "14. Conte-nos algo mais sobre você:"
];

$texto = "";

// Preenche as respostas que estão em branco
foreach($campos as $chave => $valor) {
	if(isset($respostas[$chave])) {
		$texto .= $respostas[$chave] . "|$*|";
		$campos[$chave] = $respostas[$chave];
	}
	else {
		$texto .= "|$*|";
		$campos[$chave] = "";
	}
}

// Verifica se já respondeu o formulário
$consulta = "select id from formularios where modulo=1 and usuario=" . $_SESSION["id"] . ";";

// Atualiza os dados
if(count(mysql($consulta)) > 0)
	$consulta = "update formularios set resposta='" . $texto . "' where modulo=1 and usuario=" . $_SESSION["id"] . ";";
// Insere os dados
else
	$consulta = "insert into formularios(usuario, modulo, resposta) values (" . $_SESSION["id"] . ", 1, '" . $texto . "');";

// Salva no banco de dados
$envio = mysql($consulta);

// Redireciona o usuário para o próximo (ou anterior) formulário
if(isset($_POST["pagina"]) && !empty($_POST["pagina"])) {
	$pagina = trim($_POST["pagina"]);
	if(in_array($pagina, ["formulario-0.php", "formulario-2.php", "formulario-3.php", "formulario-4.php", "formulario-5.php", "formulario-6.php"]))
		header("Location: ../" . $pagina);
	elseif($pagina == "php/sair.php") {
		unset($_SESSION["id"]);
		session_destroy();
		header("Location: ../index.php?mensagem=Você+realizou+o+logout.+Suas+respostas+foram+salvas.");
		return false;
	}
}
elseif(isset($_POST["anterior"]) && !empty($_POST["anterior"]))
	header("Location: ../formulario-0.php");
else
	header("Location: ../formulario-2.php");
return true;
?>