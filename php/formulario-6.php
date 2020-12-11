<?php

require_once("util.php");

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] != HOST . "formulario-6.php") {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Não enviou nenhum dado
if(empty($_POST)) {
	header("Location: ../formulario-6.php");
	return false;
}

// Usuário não está autenticado
if(empty($_SESSION) && !isset($_SESSION["id"])) {
	header("Location: ../index.php");
	return false;
}

$respostas = [];

// Elimina espaços excessivos e as tags chave
foreach($_POST as $pergunta => $resposta) {
	if(is_array($resposta)) {
		$respostas[$pergunta] = [];
		foreach ($resposta as $valor)
			array_push($respostas[$pergunta], str_replace("|$*|", "", trim($valor)));
	}
	else
		$respostas[$pergunta] = str_replace("|$*|", "", trim($resposta));
}

$campos = [
	"pergunta-1" => "Charlie! Good to see you, man. It’s ____ a long time we don’t chat! How ____ Lisa doing?",
	"pergunta-2" => "The Catering is waiting but I can’t open the door, L5 door is jammed. ____ you please help me ____ it? I’ll call the engineers to come check it out.",
	"pergunta-3" => "The outbreak of Coronavirus disease (COVID-19) has acted as a massive restraint on the commercial aircraft manufacturing market in 2020, as supply chains were disrupted due to trade restrictions and manufacturing was affected by extensive lockdowns globally.",
	"pergunta-4" => "Scarcely ______ taken off, we were forced to make an emergency landing.",
	"pergunta-5" => "Aircraft manufacturers are using machine-learning techniques such as artificial intelligence (AI) to enhance aircraft safety and quality, as well as the manufacturing productivity.",
	"pergunta-6" => "Susan: Hey Mike, just to let you know, I got a flat tire and I probably _____________ late for the meeting. I’m on my way there though.",
	"pergunta-7" => "You’d better take these tools with you _______ you need to make a repair.",
	"pergunta-8" => "Would you mind _________ the Section 7.3 of the Manual to me, please? There’s a procedure I want to review with the team today.",
	"pergunta-9" => "Boeing has successfully built machine-learning algorithms to design aircraft and automate factory operations.",
	"pergunta-10" => "The other day I ran into Juliet on the way to the office and she told me about the new policies to be implemented.",
	"pergunta-11" => "I can’t wait to see my father. He’s arriving tomorrow.",
	"pergunta-12" => "Flight Attendant: Which one do you prefer, coffee or tea?",
	"pergunta-13" => "Machine learning algorithms collect data from machine-to-machine and machine-tohuman interfaces and use data analytics to drive effective decision making. These technologies optimize manufacturing operations and lower costs. For example, GE Aviation uses machine learning and data analytics to identify faults in engines, which increases components’ lives and reduces maintenance costs.",
	"pergunta-14" => "I need to _____ a word with Oscar about my license expiration, I’ll _____ on a break in an hour.",
	"pergunta-15" => "_____ can I get to the main station from here? _____ I go up or down this street?"
];

$texto = "";

// Preenche as respostas que estão em branco
foreach($campos as $chave => $valor) {
	if(isset($respostas[$chave])) {
		if(is_array($respostas[$chave])) {
			foreach ($respostas[$chave] as $resposta) {
				$texto .= $resposta . "||";
			}
			$texto .= "|$*|";
		}
		else {
			$texto .= $respostas[$chave] . "|$*|";
			$campos[$chave] = $respostas[$chave];
		}
	}
	else {
		$texto .= "|$*|";
		$campos[$chave] = "";
	}
}

// Verifica se já respondeu o formulário
$consulta = "select id from formularios where modulo=6 and usuario=" . $_SESSION["id"] . ";";

// Atualiza os dados
if(count(mysql($consulta)) > 0)
	$consulta = "update formularios set resposta='" . $texto . "' where modulo=6 and usuario=" . $_SESSION["id"] . ";";
// Insere os dados
else
	$consulta = "insert into formularios(usuario, modulo, resposta) values (" . $_SESSION["id"] . ", 6, '" . $texto . "');";

// Salva no banco de dados
$envio = mysql($consulta);

// Redireciona o usuário para o próximo (ou anterior) formulário
if(isset($_POST["pagina"]) && !empty($_POST["pagina"])) {
	$pagina = trim($_POST["pagina"]);
	if(in_array($pagina, ["formulario-0.php", "formulario-1.php", "formulario-2.php", "formulario-3.php", "formulario-4.php", "formulario-5.php"]))
		header("Location: ../" . $pagina);
	elseif($pagina == "php/sair.php") {
		unset($_SESSION["id"]);
		session_destroy();
		header("Location: ../index.php?mensagem=Você+realizou+o+logout.+Suas+respostas+foram+salvas.");
		return false;
	}
}
elseif(isset($_POST["anterior"]) && !empty($_POST["anterior"]))
	header("Location: ../formulario-5.php");
// Encerra a sessão e salva os dados
elseif(isset($_POST["sair"]) && !empty($_POST["sair"])) {
	unset($_SESSION["id"]);
	session_destroy();
	header("Location: ../index.php?mensagem=Você+realizou+o+logout.+Suas+respostas+foram+salvas.");
	return false;
}
// Redireciona o usuário para a página final
else {
	// Encerra o questionário
	$consulta = "update respostas set fim='" . date("Y-m-d H:m:i") . "' where usuario=" . $_SESSION["id"] . ";";
	$envio = mysql($consulta);
	header("Location: ../final.php");
}
return true;
?>