<?php

require_once("util.php");

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] != HOST . "formulario-5.php") {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Não enviou nenhum dado
if(empty($_POST)) {
	header("Location: ../formulario-5.php");
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
	"pergunta-1" => "Cite as empresas e período trabalhado em cada uma de suas experiências anteriores",
	"pergunta-2" => "Nas experiências anteriores, cite o cenário encontrado quando chegou na empresa e como você trabalhou para melhorar o que encontrou?",
	"pergunta-3" => "Em quais tipos de empresa você já desempenhou tarefas relativas a função?",
	"pergunta-4" => "Você já trabalhou em mais de uma empresa ou cargo relativo a função?",
	"pergunta-4-1" => "Se sim, quais?",
	"pergunta-5" => "Em qual nível você já trabalhou na função?",
	"pergunta-6" => "Em qual nível você já desempenhou tarefas relativas a função indiretamente?",
	"pergunta-7" => "Quais setores internos da empresa você teve relacionamento ao longo de sua carreira? (mais de uma alternativa pode ser marcada)",
	"pergunta-8" => "Qual o maior desafio que você enfrentou na construção de sua carreira?",
	"pergunta-9" => "Qual o maior desafio profissional que você enfrentou desempenhando a função?",
	"pergunta-10" => "Qual foi sua maior conquista profissional desempenhando a função?",
	"pergunta-11" => "Qual foi a melhor empresa que você já trabalhou? Por quê?",
	"pergunta-12" => "Qual foi a pior empresa que você trabalhou? Por quê?",
	"pergunta-13" => "Você já teve algum chefe/gerente que considerasse tóxico?",
	"pergunta-13-1" => "Se sim, conte-nos sobre isso sem mencionar o nome da pessoa.",
	"pergunta-14" => "Qual foi a pessoa que mais influenciou sua carreira positivamente dentro de uma empresa?",
	"pergunta-15-1" => "Aeronaves",
	"pergunta-15-1-1" => "Quais?",
	"pergunta-15-2" => "Motores",
	"pergunta-15-2-1" => "Quais?",
	"pergunta-15-3" => "Marque os aviônicos que tem mais familiarização ou já equiparam aeronaves que operou/trabalhou:",
	"pergunta-15-3-1" => "Cite modelos",
	"pergunta-15-3-2" => "Cite modelos",
	"pergunta-15-3-3" => "Cite modelos",
	"pergunta-15-3-4" => "Cite fabricante e modelos",
	"pergunta-16-1-1" => "Estruturas",
	"pergunta-16-1-2" => "Motores",
	"pergunta-16-1-3" => "Aviônica",
	"pergunta-16-1-4" => "Sistemas",
	"pergunta-16-1-5" => "Ferramental",
	"pergunta-16-2-1" => "Coordenação",
	"pergunta-16-2-2" => "Climatologia",
	"pergunta-16-2-3" => "Rotas",
	"pergunta-16-2-4" => "Peso & Balanceamento",
	"pergunta-16-2-5" => "AOG",
	"pergunta-16-2-6" => "SGSO",
	"pergunta-16-2-7" => "AVSEC",
	"pergunta-16-3-1" => "Planejamento",
	"pergunta-16-3-2" => "Projetos",
	"pergunta-16-3-3" => "Manutenção",
	"pergunta-16-3-4" => "Reparos",
	"pergunta-16-3-5" => "Qualidade",
	"pergunta-16-3-6" => "CTM",
	"pergunta-16-4-1" => "Compras",
	"pergunta-16-4-2" => "Reparos",
	"pergunta-16-4-3" => "Almoxarifado",
	"pergunta-16-4-4" => "Logística",
	"pergunta-16-4-5" => "Vendas",
	"pergunta-16-4-6" => "Prospecção",
	"pergunta-16-4-7" => "Marketing",
	"pergunta-16-4-8" => "Design",
	"pergunta-16-4-9" => "Contabilidade",
	"pergunta-16-4-10" => "RH",
	"pergunta-16-5-1" => "Programação",
	"pergunta-16-5-2" => "Help Desk",
	"pergunta-16-5-3" => "Redes",
	"pergunta-16-5-4" => "Banco de Dados",
	"pergunta-16-5-5" => "Projetos",
	"pergunta-16-6-1" => "Excel",
	"pergunta-16-6-2" => "Word",
	"pergunta-16-6-3" => "PowerPoint",
	"pergunta-16-6-4" => "Access",
	"pergunta-16-6-5" => "Totvs",
	"pergunta-16-6-6" => "SAP",
	"pergunta-16-6-7" => "Photoshop",
	"pergunta-16-6-8" => "Premiere",
	"pergunta-16-6-9" => "Illustrator",
	"pergunta-16-6-10" => "Salesforce",
	"pergunta-16-6-11" => "PowerBI",
	"pergunta-16-6-12" => "Notes",
	"pergunta-16-6-13" => "Outros",
	"pergunta-17" => "Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto mais forte?",
	"pergunta-18" => "Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto de melhoria?",
	"pergunta-19" => "Você se considera um expert em algo?",
	"pergunta-19-1" => "Se sim, qual(is)?",
	"pergunta-20" => "Descreva algum conhecimento técnico específico que você adquiriu no desempenho da função não descrito acima",
	"pergunta-21" => "Descreva algum conhecimento técnico específico que você adquiriu na sua carreira e que julga de importância, mas não descrito acima"
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
$consulta = "select id from formularios where modulo=5 and usuario=" . $_SESSION["id"] . ";";

// Atualiza os dados
if(count(mysql($consulta)) > 0)
	$consulta = "update formularios set resposta='" . $texto . "' where modulo=5 and usuario=" . $_SESSION["id"] . ";";
// Insere os dados
else
	$consulta = "insert into formularios(usuario, modulo, resposta) values (" . $_SESSION["id"] . ", 5, '" . $texto . "');";

// Salva no banco de dados
$envio = mysql($consulta);

// Redireciona o usuário para o próximo (ou anterior) formulário
if(isset($_POST["pagina"]) && !empty($_POST["pagina"])) {
	$pagina = trim($_POST["pagina"]);
	if(in_array($pagina, ["formulario-0.php", "formulario-1.php", "formulario-2.php", "formulario-3.php", "formulario-4.php", "formulario-6.php"]))
		header("Location: ../" . $pagina);
	elseif($pagina == "php/sair.php") {
		unset($_SESSION["id"]);
		session_destroy();
		header("Location: ../index.php?mensagem=Você+realizou+o+logout.+Suas+respostas+foram+salvas.");
		return false;
	}
}
elseif(isset($_POST["anterior"]) && !empty($_POST["anterior"]))
	header("Location: ../formulario-4.php");
else
	header("Location: ../formulario-6.php");
return true;
?>