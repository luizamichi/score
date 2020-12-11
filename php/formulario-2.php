<?php

require_once("util.php");

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] != HOST . "formulario-2.php") {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Não enviou nenhum dado
if(empty($_POST)) {
	header("Location: ../formulario-2.php");
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
	"pergunta-1" => "Qual sua última experiência/cargo na função pretendida?",
	"pergunta-2" => "Quanto tempo trabalhou nesta função?",
	"pergunta-3" => "Descreva sua rotina diária, semanal ou mensal na função:",
	"pergunta-4" => "Quais tipos de conhecimentos desenvolveu executando a função?",
	"pergunta-5" => "Quais habilidades desenvolveu desempenhando a função?",
	"pergunta-6" => "Qual o tamanho da equipe de trabalho que atuava com você na execução das tarefas?",
	"pergunta-7" => "Qual o seu nível hierárquico dentro da equipe?",
	"pergunta-8" => "Descreva seus maiores desafios na rotina da função:",
	"pergunta-9" => "O que você acha que poderia ter feito diferente?",
	"pergunta-10" => "Qual sua maior conquista durante seu tempo nesta função?",
	"pergunta-11" => "Já trabalhou com metas?",
	"pergunta-11-1" => "Cite as metas e sua performance nas últimas funções",
	"pergunta-12" => "Quantos manuais eram empregados nas tarefas que você executava? Quais?",
	"pergunta-13" => "Você ajudou no desenvolvimento de algum desses manuais? Quais?",
	"pergunta-14" => "Você já trabalhou seguindo procedimentos operacionais padronizados pela empresa?",
	"pergunta-14-1" => "Quais?",
	"pergunta-15" => "Você teve contato com manuais relativos a:",
	"pergunta-15-1" => "Operação de aeronaves",
	"pergunta-15-2" => "Manutenção de aeronaves",
	"pergunta-15-3" => "Operação de solo",
	"pergunta-15-4" => "Operação de cargas",
	"pergunta-15-5" => "SGSO ou Safety",
	"pergunta-15-6" => "Atendimento a Pax",
	"pergunta-15-7" => "AVSEC",
	"pergunta-15-8" => "Outros procedimentos",
	"pergunta-15-8-1" => "Quais?",
	"pergunta-16" => "Algum desses manuais eram em inglês?",
	"pergunta-16-1" => "Quais?",
	"pergunta-17" => "Descreva como esses manuais influenciavam sua rotina diária:",
	"pergunta-18" => "Qual o manual mais utilizado?",
	"pergunta-19" => "Você teve ou possui alguma dificuldade em relação aos manuais que trabalhou? Descreva:",
	"pergunta-20" => "Você propôs alguma melhoria nos procedimentos descritos enquanto trabalhava na função?",
	"pergunta-20-1" => "Quais?",
	"pergunta-21" => "Com qual manual você tinha mais facilidade de manuseio e entendimento? Por quê?",
	"pergunta-22" => "Com qual manual você tinha mais dificuldade de manuseio e entendimento? Por quê?",
	"pergunta-23" => "Com quais manuais você teve contato que não eram diretamente ligados à sua função, mas influenciavam sua rotina devido as tarefas executadas por pessoas que estavam envolvidas nos seus processos diários?",
	"pergunta-24" => "Descreva como esses manuais e processos influenciavam sua rotina diária:",
	"pergunta-25" => "Algum desses manuais eram em inglês?",
	"pergunta-25-1" => "Quais?",
	"pergunta-26" => "Você teve alguma dificuldade com procedimentos “não compatíveis” entre os setores?",
	"pergunta-26-1" => "Quais?",
	"pergunta-27" => "Por que julga que os procedimentos não eram compatíveis?",
	"pergunta-28" => "Com quais autoridades regulatórias, normas ou procedimentos você teve mais contato na função?",
	"pergunta-28-1" => "ICAO",
	"pergunta-28-2" => "ANAC",
	"pergunta-28-3" => "FAA",
	"pergunta-28-4" => "EASA",
	"pergunta-28-5" => "IATA",
	"pergunta-28-6" => "IOSA",
	"pergunta-28-7" => "Infraero",
	"pergunta-28-8" => "Receita Federal",
	"pergunta-28-9" => "Jurídico",
	"pergunta-28-10" => "Seis Sigma",
	"pergunta-28-11" => "ISSO",
	"pergunta-28-12" => "Anvisa",
	"pergunta-28-13" => "Polícia Federal",
	"pergunta-28-14" => "Forças Armadas (Marinha, Exército e/ou Aeronáutica)",
	"pergunta-28-15" => "Forças Armadas Estrangeiras (Quais)?",
	"pergunta-28-15-1" => "Quais?",
	"pergunta-28-16" => "Outros",
	"pergunta-28-16-1" => "Quais?",
	"pergunta-29" => "Qual a regulação (lei, norma, procedimento, etc) aplicável à sua função?",
	"pergunta-30" => "Você fez algum curso relativos a essa regulação?",
	"pergunta-30-1" => "Qual?",
	"pergunta-31" => "Quais procedimentos executados por você estavam ligados a essas autoridades?",
	"pergunta-32" => "Como esses procedimentos influenciavam sua rotina diária?",
	"pergunta-33" => "Qual a maior dificuldade que você tinha no relacionamento com a Autoridade?",
	"pergunta-34" => "Você tinha contato direto com alguma agência do item 28?",
	"pergunta-34-1" => "Qual o nível hierárquico do contato?",
	"pergunta-35" => "Você esteve envolvido em algum processo de certificação ligado a Autoridade?",
	"pergunta-35-1" => "Quais?",
	"pergunta-36" => "Em algum momento você teve atrito (discussão, processo administrativo ou jurídico) com a Autoridade?"
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
$consulta = "select id from formularios where modulo=2 and usuario=" . $_SESSION["id"] . ";";

// Atualiza os dados
if(count(mysql($consulta)) > 0)
	$consulta = "update formularios set resposta='" . $texto . "' where modulo=2 and usuario=" . $_SESSION["id"] . ";";
// Insere os dados
else
	$consulta = "insert into formularios(usuario, modulo, resposta) values (" . $_SESSION["id"] . ", 2, '" . $texto . "');";

// Salva no banco de dados
$envio = mysql($consulta);

// Redireciona o usuário para o próximo (ou anterior) formulário
if(isset($_POST["pagina"]) && !empty($_POST["pagina"])) {
	$pagina = trim($_POST["pagina"]);
	if(in_array($pagina, ["formulario-0.php", "formulario-1.php", "formulario-3.php", "formulario-4.php", "formulario-5.php", "formulario-6.php"]))
		header("Location: ../" . $pagina);
	elseif($pagina == "php/sair.php") {
		unset($_SESSION["id"]);
		session_destroy();
		header("Location: ../index.php?mensagem=Você+realizou+o+logout.+Suas+respostas+foram+salvas.");
		return false;
	}
}
elseif(isset($_POST["anterior"]) && !empty($_POST["anterior"]))
	header("Location: ../formulario-1.php");
else
	header("Location: ../formulario-3.php");
return true;
?>