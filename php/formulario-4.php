<?php

require_once("util.php");

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] != HOST . "formulario-4.php") {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Não enviou nenhum dado
if(empty($_POST)) {
	header("Location: ../formulario-4.php");
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
	"pergunta-1" => "1. Você possui algum conhecimento sobre SGSO? Se sim, escreva em poucas palavras o que você entende sobre SGSO:",
	"pergunta-2" => "2. Alguma de suas tarefas e procedimentos tem relacionamento direto com os itens cobertos por Manuais de SGSO? Se sim, quais?",
	"pergunta-3" => "3. Você teve contato direto com os manuais de SGSO no desempenho da função? Se sim, em quais procedimentos?",
	"pergunta-4" => "4. Você teve dificuldade com os procedimentos de Segurança Operacional no exercício da função? Se sim, quais?",
	"pergunta-5" => "5. Você já desenvolveu procedimentos ou manuais de SGSO? Se sim, quais?",
	"pergunta-6" => "6. Você teve contato com manuais e procedimentos de SGSO em inglês?",
	"pergunta-7" => "7. Você já executou tarefas relacionadas diretamente a Segurança Operacional nos seguintes tipos de empresa?",
	"pergunta-8" => "8. Você já executou tarefas que poderiam influenciar na Segurança Operacional? Se sim, quais?",
	"pergunta-9" => "9. Qual seu grau de envolvimento direto na Segurança Operacional?",
	"pergunta-10" => "10. Havia regulação específica ou supervisionamento de alguma autoridade aeronáutica nessas tarefas? Se sim, quais?",
	"pergunta-11" => "11. Você já teve alguma dificuldade para manter a Segurança Operacional devido ao atrito com alguma pessoa ou autoridade? Se sim, quais?"
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
$consulta = "select id from formularios where modulo=4 and usuario=" . $_SESSION["id"] . ";";

// Atualiza os dados
if(count(mysql($consulta)) > 0)
	$consulta = "update formularios set resposta='" . $texto . "' where modulo=4 and usuario=" . $_SESSION["id"] . ";";
// Insere os dados
else
	$consulta = "insert into formularios(usuario, modulo, resposta) values (" . $_SESSION["id"] . ", 4, '" . $texto . "');";

// Salva no banco de dados
$envio = mysql($consulta);

// Redireciona o usuário para o próximo (ou anterior) formulário
if(isset($_POST["pagina"]) && !empty($_POST["pagina"])) {
	$pagina = trim($_POST["pagina"]);
	if(in_array($pagina, ["formulario-0.php", "formulario-1.php", "formulario-2.php", "formulario-3.php", "formulario-5.php", "formulario-6.php"]))
		header("Location: ../" . $pagina);
	elseif($pagina == "php/sair.php") {
		unset($_SESSION["id"]);
		session_destroy();
		header("Location: ../index.php?mensagem=Você+realizou+o+logout.+Suas+respostas+foram+salvas.");
		return false;
	}
}
elseif(isset($_POST["anterior"]) && !empty($_POST["anterior"]))
	header("Location: ../formulario-3.php");
else
	header("Location: ../formulario-5.php");
return true;
?>