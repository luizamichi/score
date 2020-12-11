<?php

require_once("util.php");

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] != HOST . "formulario-3.php") {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Não enviou nenhum dado
if(empty($_POST)) {
	header("Location: ../formulario-3.php");
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
	"pergunta-1" => "Você possui alguma carteira de habilitação específica da sua área de atuação? Se sim, quais?",
	"pergunta-1-1" => "FAA",
	"pergunta-1-2" => "EASA",
	"pergunta-1-3" => "Outros",
	"pergunta-2-1" => "RBAC 91",
	"pergunta-2-2" => "RBAC 121",
	"pergunta-2-3" => "RBAC 135",
	"pergunta-2-4" => "RBAC 145",
	"pergunta-2-5" => "RBAC 153",
	"pergunta-2-6" => "RBAC 107",
	"pergunta-2-7" => "RBAC 108",
	"pergunta-2-8" => "RBAC 110",
	"pergunta-2-9" => "RBAC 175",
	"pergunta-2-10" => "RESOLUÇÃO ANAC 130",
	"pergunta-2-11" => "RESOLUÇÃO ANAC 280",
	"pergunta-3" => "Sua habilitação tem validade? Se sim, até quando?",
	"pergunta-4" => "Você tem alguma formação (curso superior, cursos, treinamentos) específica na área? Se sim, quais? Onde? Data de conclusão?",
	"pergunta-5" => "Todas possuem certificados?",
	"pergunta-6" => "Alguma dessas foram feitas no exterior?",
	"pergunta-7" => "Qual a formação citada acima que mais ajudou a desenvolver sua carreira? Por quê?",
	"pergunta-8" => "Qual curso você mais se identificou? Por quê?",
	"pergunta-9" => "Qual o maior desafio que você enfrentou durante sua formação?",
	"pergunta-10" => "Qual curso ou treinamento você ainda pretende fazer? Por quê?",
	"pergunta-11" => "Você teve algum mentor durante sua formação? Se sim, em qual área? Quem foi?",
	"pergunta-12-1-1" => "Aeronaves - Projetos",
	"pergunta-12-1-1-1" => "Quais?",
	"pergunta-12-1-2" => "Aeronaves - Manutenção",
	"pergunta-12-1-2-1" => "Quais?",
	"pergunta-12-1-3" => "Aeronaves - Piloto",
	"pergunta-12-1-4" => "Aeronaves - Comissário",
	"pergunta-12-1-5" => "Aeronaves - Outros",
	"pergunta-12-1-5-1" => "Quais?",
	"pergunta-12-2" => "Operações de Solo",
	"pergunta-12-2-1" => "Quais?",
	"pergunta-12-3" => "Operações de Voo",
	"pergunta-12-3-1" => "Quais?",
	"pergunta-12-4" => "Suprimentos",
	"pergunta-12-4-1" => "Quais?",
	"pergunta-12-5" => "Contabilidade",
	"pergunta-12-5-1" => "Quais?",
	"pergunta-12-6-1" => "Comercial - Vendas",
	"pergunta-12-6-2" => "Comercial - Marketing",
	"pergunta-12-6-2-1" => "Quais?",
	"pergunta-12-6-3" => "Comercial - Prospecção",
	"pergunta-12-6-4" => "Comercial - Telemarketing",
	"pergunta-12-6-5" => "Comercial - Pós-venda",
	"pergunta-12-6-6" => "Comercial - Atendimento ao Cliente",
	"pergunta-12-6-7" => "Comercial - Outros",
	"pergunta-12-6-7-1" => "Quais?",
	"pergunta-12-7-1" => "Jurídico - Civil",
	"pergunta-12-7-1-1" => "Quais?",
	"pergunta-12-7-2" => "Jurídico - Tributário",
	"pergunta-12-7-2-1" => "Quais?",
	"pergunta-12-7-3" => "Jurídico - Penal",
	"pergunta-12-7-3-1" => "Quais?",
	"pergunta-12-8-1" => "TI - Linguagem",
	"pergunta-12-8-1-1" => "Quais?",
	"pergunta-12-8-2" => "TI - Banco de Dados",
	"pergunta-12-8-2-1" => "Quais?",
	"pergunta-12-8-3" => "TI - HelpDesk",
	"pergunta-12-8-4" => "TI - Redes",
	"pergunta-12-8-5" => "TI - Servidores",
	"pergunta-12-8-5-1" => "Quais?",
	"pergunta-12-9-1" => "Engenharia - Aeronáutica",
	"pergunta-12-9-1-1" => "Quais?",
	"pergunta-12-9-2" => "Engenharia - Mecânica",
	"pergunta-12-9-2-1" => "Quais?",
	"pergunta-12-9-3" => "Engenharia - Civil",
	"pergunta-12-9-3-1" => "Quais?",
	"pergunta-12-10" => "Administração",
	"pergunta-12-10-1" => "Quais?",
	"pergunta-12-11" => "Recursos Humanos",
	"pergunta-12-11-1" => "Quais?",
	"pergunta-12-12" => "Treinamento",
	"pergunta-12-12-1" => "Quais?",
	"pergunta-12-13" => "Outros?",
	"pergunta-12-13-1" => "Quais?",
	"pergunta-13" => "Algum desses treinamentos é certificado pelo Fabricante? Se sim, quais?",
	"pergunta-14" => "Algum desses treinamentos é validado pela Autoridade da área de atuação? Se sim, quais?",
	"pergunta-15" => "Você possui treinamento em alguma ferramenta específica para realização de tarefas na função?",
	"pergunta-16" => "Você já utilizou os conhecimentos adquiridos nesse(s) treinamento(s) na realização de tarefas na função? Se sim, quais?",
	"pergunta-17" => "Qual o treinamento você considera de maior relevância para a função? Por quê?",
	"pergunta-18" => "Você planeja fazer mais algum treinamento no futuro? Se sim, quais? Por quê?",
	"pergunta-19" => "Na sua opinião, em quais aspectos o treinamento que você quer fazer, lhe ajudaria no desenvolvimento da sua carreira?",
	"pergunta-20" => "Qual treinamento que você já fez você considera que foi menos proveitoso para a função?",
	"pergunta-21" => "Qual treinamento você considera que precisa fazer para dar o próximo passo na sua carreira?",
	"pergunta-22" => "Você possui contatos com os quais mantém relacionamento nas seguintes áreas?",
	"pergunta-22-1" => "Quais?",
	"pergunta-23" => "Qual seu nível de relacionamento com as empresas citadas acima?",
	"pergunta-24" => "Em quais setores das empresas citadas acima você possui relacionamento?",
	"pergunta-24-1" => "Quais?",
	"pergunta-25" => "Quais desses contatos você considera mais importantes para a função?",
	"pergunta-26" => "Descreva seu nível de relacionamentos com os contatos citados no item iv:",
	"pergunta-27" => "Esses contatos podem fornecer boas referências a seu respeito? Se sim informe nome e contato.",
	"pergunta-28" => "Em qual área da aviação você julga ter o melhor nível de relacionamento?",
	"pergunta-29" => "Quais características profissionais você acredita que esses contatos poderiam citar a seu respeito? ",
	"pergunta-30" => "Você já teve ou possui atualmente algum atrito, divergência ou disputa judicial com alguma empresa ligada a Aviação? Se sim, quais?",
	"pergunta-31" => "Você já teve algum conflito de maior proporção com alguma pessoa ligada a aviação que poderia influenciar sua carreira em alguma empresa da aviação? Se sim, quais?",
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
$consulta = "select id from formularios where modulo=3 and usuario=" . $_SESSION["id"] . ";";

// Atualiza os dados
if(count(mysql($consulta)) > 0)
	$consulta = "update formularios set resposta='" . $texto . "' where modulo=3 and usuario=" . $_SESSION["id"] . ";";
// Insere os dados
else
	$consulta = "insert into formularios(usuario, modulo, resposta) values (" . $_SESSION["id"] . ", 3, '" . $texto . "');";

// Salva no banco de dados
$envio = mysql($consulta);

// Redireciona o usuário para o próximo (ou anterior) formulário
if(isset($_POST["pagina"]) && !empty($_POST["pagina"])) {
	$pagina = trim($_POST["pagina"]);
	if(in_array($pagina, ["formulario-0.php", "formulario-1.php", "formulario-2.php", "formulario-4.php", "formulario-5.php", "formulario-6.php"]))
		header("Location: ../" . $pagina);
	elseif($pagina == "php/sair.php") {
		unset($_SESSION["id"]);
		session_destroy();
		header("Location: ../index.php?mensagem=Você+realizou+o+logout.+Suas+respostas+foram+salvas.");
		return false;
	}
}
elseif(isset($_POST["anterior"]) && !empty($_POST["anterior"]))
	header("Location: ../formulario-2.php");
else
	header("Location: ../formulario-4.php");
return true;
?>