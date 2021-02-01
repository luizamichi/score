<?php
// CARREGA AS FUNÇÕES GLOBAIS
require_once(__DIR__ . "/functions.php");


// ELIMINA ESPAÇOS EXCESSIVOS E TAGS CHAVE (|$*|)
function remove_excessive_spaces(array $questions): array {
	$responses = [];
	foreach($questions as $question => $response) {

		if(is_array($response)) { // A RESPOSTA É UM VETOR
			$responses[$question] = [];

			foreach($response as $value) {
				array_push($responses[$question], str_replace("|$*|", "", clean_text($value)));
			}
		}

		else { // A RESPOSTA É UM TEXTO
			$responses[$question] = str_replace("|$*|", "", clean_text($response));
		}
	}

	return $responses;
}


// PREENCHE AS RESPOSTAS QUE ESTÃO EM BRANCO E SERIALIZA
function fills_in_empty_responses(array $fields, array $responses): string {
	$text = "";

	foreach($fields as $key => $value) {
		if(isset($responses[$key])) {

			if(is_array($responses[$key])) {
				foreach($responses[$key] as $response) {
					$text .= $response . "||";
				}

				$text .= "|$*|";
			}

			else {
				$text .= $responses[$key] . "|$*|";
				$fields[$key] = $responses[$key];
			}
		}

		else {
			$text .= "|$*|";
			$fields[$key] = "";
		}
	}

	return $text;
}


// RECUPERA OS ALUNOS DE ACORDO COM A QUANTIDADE EXIGIDA
function list_students(int $state=3, int $quantity=1): array {
	if($state === 0) { // ALUNOS QUE NÃO INICIARAM O FORMULÁRIO
		$query = "select distinct users.`id`, users.`name`, users.`alias`, users.`registration_date`, students.`id` `ref_id` from users inner join students on users.`id`=students.`user` where students.`id` not in (select distinct `student` from forms) order by users.`id` desc limit " . $quantity . ";";
	}

	elseif($state === 1) { // ALUNOS QUE INICIARAM O FORMULÁRIO
		$query = "select distinct users.`id`, users.`name`, users.`alias`, users.`registration_date`, students.`id` `ref_id` from users inner join students on users.`id`=students.`user` left join forms on students.`id`=forms.`student` where students.`id` in (";
		$query .= "select `student` from forms where `stage`=(";
		$query .= "select min(`id`) from stages)) and students.`id` not in (";
		$query .= "select `student` from forms where `stage`=(";
		$query .= "select max(`id`) from stages)) order by users.`id` desc limit " . $quantity . ";";
	}

	elseif($state === 2) { // ALUNOS QUE FINALIZARAM O FORMULÁRIO
		$query = "select distinct users.`id`, users.`name`, users.`alias`, users.`registration_date`, students.`id` `ref_id` from users inner join students on users.`id`=students.`user` left join forms on students.`id`=forms.`student` where students.`id` in (";
		$query .= "select `student` from forms where `stage`=(";
		$query .= "select max(`id`) from stages)) order by users.`id` desc limit " . $quantity . ";";
	}

	else { // TODOS OS ALUNOS
		$query = "select distinct users.`id`, users.`name`, users.`alias`, users.`registration_date`, students.`id` `ref_id` from users inner join students on users.`id`=students.`user` left join forms on students.`id`=forms.`student` order by users.`id` desc limit" . $quantity . ";";
	}

	return sql_query($query);
}


// CAPTURA A HORA DE INÍCIO DE UMA ETAPA POR UM ALUNO
function start_time(int $student, int $stage): string {
	// PROCURA NO BANCO DE DADOS SE O USUÁRIO POSSUI ALGUMA RESPOSTA ENVIADA ANTERIORMENTE
	$query = "select `start_time` from forms where `student`=" . $student . " and `stage`=" . $stage . ";";
	$rows = sql_query($query);

	if(!empty($rows)) { // ENCONTROU UMA RESPOSTA
		return $rows[0]["start_time"];
	}
	return date("Y-m-d H:i:s");
}


// CAPTURA A HORA DE TÉRMINO DE UMA ETAPA POR UM ALUNO
function end_time(int $student, int $stage): ?string {
	// PROCURA NO BANCO DE DADOS SE O USUÁRIO POSSUI ALGUMA RESPOSTA ENVIADA ANTERIORMENTE
	$query = "select `end_time` from forms where `student`=" . $student . " and `stage`=" . $stage . ";";
	$rows = sql_query($query);

	if(!empty($rows)) { // ENCONTROU UMA RESPOSTA
		return $rows[0]["end_time"];
	}
	return date("Y-m-d H:i:s");
}


// VERIFICA SE O USUÁRIO TERMINOU UMA ETAPA
function form_finished(int $student, int $stage): bool {
	// PROCURA NO BANCO DE DADOS SE O USUÁRIO FINALIZOU A ETAPA
	$query = "select `end_time` from forms where `student`=" . $student . " and `stage`=" . $stage . " and `end_time` is not null;";
	$rows = sql_query($query);

	if(!empty($rows)) { // ENCONTROU UMA RESPOSTA
		return true;
	}
	return false;
}


// RETORNA O IDENTIFICADOR DE UMA ETAPA, A PARTIR DO NOME
function step_identifier(string $name, int $stage): int {
	$query = "select * from stages where `name`='" . $name . "';";
	$rows = sql_query($query);

	// PROCURA NO BANCO DE DADOS O VALOR CORRETO DO MÓDULO
	$stage = !empty($rows) ? $rows[0]["id"] : $stage;

	return $stage;
}


// MONTA AS RESPOSTAS DE UM FORMULÁRIO DE UM ALUNO
function response(int $student, int $stage): array {
	// PROCURA NO BANCO DE DADOS SE O USUÁRIO POSSUI ALGUMA RESPOSTA ENVIADA ANTERIORMENTE
	$query = "select `response` from forms where `student`=" . $student . " and `stage`=" . $stage . ";";
	$rows = sql_query($query);

	switch($stage) { // CAPTURA AS PERGUNTAS DA ETAPA
		case 1:
			$questions = initial_registration_form(true);
			break;
		case 2:
			$questions = role_knowledge_form(true);
			break;
		case 3:
			$questions = specific_technical_knowledge_form(true);
			break;
		case 4:
			$questions = operational_safety_and_regulation_form(true);
			break;
		case 5:
			$questions = previous_experiences_form(true);
			break;
		case 6:
			$questions = medium_english_form(true);
			break;
		case 7:
			$questions = first_step_form(true);
			break;
		case 8:
			$questions = second_step_form(true);
			break;
		case 9:
			$questions = third_step_form(true);
			break;
		case 10:
			$questions = fourth_step_form(true);
			break;
		default:
			$questions = [];
			break;
	}


	if(!empty($rows)) { // ENCONTROU UMA RESPOSTA
		$responses = explode("|$*|", $rows[0]["response"]);
		$index = 0;

		// MONTA UM VETOR COM PERGUNTAS (CHAVE) E RESPOSTAS (VALOR)
		foreach(array_keys($questions) as $question) {
			$questions[$question] = $responses[$index];
			$index++;
		}
	}

	return $questions;
}


// DEIXA TODOS OS CAMPOS DE VALORES DO VETOR EM BRANCO
function make_empty_values(array $fields): array {
	$fields = array_map(function(): string {
		return "";
	}, $fields);

	return $fields;
}


// MONTA O QUESTIONÁRIO DE CADASTRO INICIAL (DADOS PESSOAIS)
function initial_registration_form(bool $empty=false): array {
	$fields = [
		"question-1" => "1. Nome",
		"question-2" => "2. Sobrenome",
		"question-3" => "3. E-mail",
		"question-4" => "4. Telefone",
		"question-5" => "5. Data de nascimento",
		"question-6" => "6. Escolaridade",
		"question-6-1" => "Qual curso?",
		"question-6-2" => "Qual campo?",
		"question-6-3" => "Universidade",
		"question-6-4" => "Data de conclusão",
		"question-7" => "7. Para qual cargo e função você gostaria de ser avaliado?",
		"question-8" => "8. Qual seu nível atual de experiência?",
		"question-9" => "9. Quais línguas você fala?",
		"question-9-1" => "Inglês",
		"question-9-2" => "Espanhol",
		"question-9-3" => "Francês",
		"question-9-4" => "Alemão",
		"question-9-5" => "Outros",
		"question-9-5-1" => "Quais?",
		"question-10" => "10. Você tem experiência na área que pretende desenvolver no futuro?",
		"question-11" => "11. Pretende mudar de área?",
		"question-11-1" => "Porquê?",
		"question-12" => "12. Considerando as respostas da perguntas 7 e 8, onde você se imagina daqui a 5 anos?",
		"question-13" => "13. Qual o emprego dos seus sonhos?",
		"question-14" => "14. Conte-nos algo mais sobre você:"
	];

	if($empty) { // DEIXA TODOS OS CAMPOS EM BRANCO
		$fields = make_empty_values($fields);
	}

	return $fields;
}


// MONTA AS RESPOSTAS DO CADASTRO INICIAL (DADOS PESSOAIS)
function initial_registration_response(int $student): array {
	return response($student, 1);
}


// VERIFICA SE O ALUNO TERMINOU A ETAPA CADASTRO INICIAL (DADOS PESSOAIS)
function initial_registration_finished(int $student): bool {
	return form_finished($student, 1);
}


// CAPTURA A HORA DE INÍCIO DA ETAPA CADASTRO INICIAL (DADOS PESSOAIS)
function initial_registration_start_time(int $student): string {
	return start_time($student, 1);
}


// CAPTURA A HORA DE TÉRMINO DA ETAPA CADASTRO INICIAL (DADOS PESSOAIS)
function initial_registration_end_time(int $student): ?string {
	return end_time($student, 1);
}


// MONTA O QUESTIONÁRIO DE AVALIAÇÃO TÉCNICA (CONHECIMENTO DA FUNÇÃO)
function role_knowledge_form(bool $empty=false): array {
	$fields = [
		"question-1" => "1. Qual sua última experiência/cargo na função pretendida?",
		"question-2" => "2. Quanto tempo trabalhou nesta função?",
		"question-3" => "3. Descreva sua rotina diária, semanal ou mensal na função:",
		"question-4" => "4. Quais tipos de conhecimentos desenvolveu executando a função?",
		"question-5" => "5. Quais habilidades desenvolveu desempenhando a função?",
		"question-6" => "6. Qual o tamanho da equipe de trabalho que atuava com você na execução das tarefas?",
		"question-7" => "7. Qual o seu nível hierárquico dentro da equipe?",
		"question-8" => "8. Descreva seus maiores desafios na rotina da função:",
		"question-9" => "9. O que você acha que poderia ter feito diferente?",
		"question-10" => "10. Qual sua maior conquista durante seu tempo nesta função?",
		"question-11" => "11. Já trabalhou com metas?",
		"question-11-1" => "Cite as metas e sua performance nas últimas funções",
		"question-12" => "12. Quantos manuais eram empregados nas tarefas que você executava? Quais?",
		"question-13" => "13. Você ajudou no desenvolvimento de algum desses manuais? Quais?",
		"question-14" => "14. Você já trabalhou seguindo procedimentos operacionais padronizados pela empresa?",
		"question-14-1" => "Quais?",
		"question-15" => "15. Você teve contato com manuais relativos a:",
		"question-15-1" => "Operação de aeronaves",
		"question-15-2" => "Manutenção de aeronaves",
		"question-15-3" => "Operação de solo",
		"question-15-4" => "Operação de cargas",
		"question-15-5" => "SGSO ou Safety",
		"question-15-6" => "Atendimento a Pax",
		"question-15-7" => "AVSEC",
		"question-15-8" => "Outros procedimentos",
		"question-15-8-1" => "Quais?",
		"question-16" => "16. Algum desses manuais eram em inglês?",
		"question-16-1" => "Quais?",
		"question-17" => "17. Descreva como esses manuais influenciavam sua rotina diária:",
		"question-18" => "18. Qual o manual mais utilizado?",
		"question-19" => "19. Você teve ou possui alguma dificuldade em relação aos manuais que trabalhou? Descreva:",
		"question-20" => "20. Você propôs alguma melhoria nos procedimentos descritos enquanto trabalhava na função?",
		"question-20-1" => "Quais?",
		"question-21" => "21. Com qual manual você tinha mais facilidade de manuseio e entendimento? Por quê?",
		"question-22" => "22. Com qual manual você tinha mais dificuldade de manuseio e entendimento? Por quê?",
		"question-23" => "23. Com quais manuais você teve contato que não eram diretamente ligados à sua função, mas influenciavam sua rotina devido às tarefas executadas por pessoas que estavam envolvidas nos seus processos diários?",
		"question-24" => "24. Descreva como esses manuais e processos influenciavam sua rotina diária:",
		"question-25" => "25. Algum desses manuais eram em inglês?",
		"question-25-1" => "Quais?",
		"question-26" => "26. Você teve alguma dificuldade com procedimentos “não compatíveis” entre os setores?",
		"question-26-1" => "Quais?",
		"question-27" => "27. Por que julga que os procedimentos não eram compatíveis?",
		"question-28" => "28. Com quais autoridades regulatórias, normas ou procedimentos você teve mais contato na função?",
		"question-28-1" => "ICAO",
		"question-28-2" => "ANAC",
		"question-28-3" => "FAA",
		"question-28-4" => "EASA",
		"question-28-5" => "IATA",
		"question-28-6" => "IOSA",
		"question-28-7" => "Infraero",
		"question-28-8" => "Receita Federal",
		"question-28-9" => "Jurídico",
		"question-28-10" => "Seis Sigma",
		"question-28-11" => "ISSO",
		"question-28-12" => "Anvisa",
		"question-28-13" => "Polícia Federal",
		"question-28-14" => "Forças Armadas (Marinha, Exército e/ou Aeronáutica)",
		"question-28-15" => "Forças Armadas Estrangeiras (Quais)?",
		"question-28-15-1" => "Quais?",
		"question-28-16" => "Outros",
		"question-28-16-1" => "Quais?",
		"question-29" => "29. Qual a regulação (lei, norma, procedimento, etc.) aplicável à sua função?",
		"question-30" => "30. Você fez algum curso relativo a essa regulação?",
		"question-30-1" => "Qual?",
		"question-31" => "31. Quais procedimentos executados por você estavam ligados a essas autoridades?",
		"question-32" => "32. Como esses procedimentos influenciavam sua rotina diária?",
		"question-33" => "33. Qual a maior dificuldade que você tinha no relacionamento com a Autoridade?",
		"question-34" => "34. Você tinha contato direto com alguma agência do item 28?",
		"question-34-1" => "Qual o nível hierárquico do contato?",
		"question-35" => "35. Você esteve envolvido em algum processo de certificação ligado a Autoridade?",
		"question-35-1" => "Quais?",
		"question-36" => "36. Em algum momento você teve atrito (discussão, processo administrativo ou jurídico) com a Autoridade?"
	];

	if($empty) { // DEIXA TODOS OS CAMPOS EM BRANCO
		$fields = make_empty_values($fields);
	}

	return $fields;
}


// MONTA AS RESPOSTAS DA AVALIAÇÃO TÉCNICA (CONHECIMENTO DA FUNÇÃO)
function role_knowledge_response(int $student): array {
	$questions = response($student, 2);

	// MONTA AS RESPOSTAS DOS VETORES
	$questions["question-15"] = explode("||", $questions["question-15"]);
	array_pop($questions["question-15"]);

	return $questions;
}


// VERIFICA SE O ALUNO TERMINOU A ETAPA AVALIAÇÃO TÉCNICA (CONHECIMENTO DA FUNÇÃO)
function role_knowledge_finished(int $student): bool {
	return form_finished($student, 2);
}


// CAPTURA A HORA DE INÍCIO DA ETAPA AVALIAÇÃO TÉCNICA (CONHECIMENTO DA FUNÇÃO)
function role_knowledge_start_time(int $student): string {
	return start_time($student, 2);
}


// CAPTURA A HORA DE TÉRMINO DA ETAPA AVALIAÇÃO TÉCNICA (CONHECIMENTO DA FUNÇÃO)
function role_knowledge_end_time(int $student): ?string {
	return end_time($student, 2);
}


// MONTA O QUESTIONÁRIO DE AVALIAÇÃO TÉCNICA (CONHECIMENTO TÉCNICO ESPECÍFICO)
function specific_technical_knowledge_form(bool $empty=false): array {
	$fields = [
		"question-1" => "1. Você possui alguma carteira de habilitação específica da sua área de atuação? Se sim, quais?",
		"question-1-1" => "FAA",
		"question-1-2" => "EASA",
		"question-1-3" => "Outros",
		"question-2-1" => "RBAC 91",
		"question-2-2" => "RBAC 121",
		"question-2-3" => "RBAC 135",
		"question-2-4" => "RBAC 145",
		"question-2-5" => "RBAC 153",
		"question-2-6" => "RBAC 107",
		"question-2-7" => "RBAC 108",
		"question-2-8" => "RBAC 110",
		"question-2-9" => "RBAC 175",
		"question-2-10" => "RESOLUÇÃO ANAC 130",
		"question-2-11" => "RESOLUÇÃO ANAC 280",
		"question-3" => "3. Sua habilitação tem validade? Se sim, até quando?",
		"question-4" => "4. Você tem alguma formação (curso superior, cursos, treinamentos) específica na área? Se sim, quais? Onde? Data de conclusão?",
		"question-5" => "5. Todas possuem certificados?",
		"question-6" => "6. Alguma dessas foram feitas no exterior?",
		"question-7" => "7. Qual a formação citada acima que mais ajudou a desenvolver sua carreira? Por quê?",
		"question-8" => "8. Qual curso você mais se identificou? Por quê?",
		"question-9" => "9. Qual o maior desafio que você enfrentou durante sua formação?",
		"question-10" => "10. Qual curso ou treinamento você ainda pretende fazer? Por quê?",
		"question-11" => "11. Você teve algum mentor durante sua formação? Se sim, em qual área? Quem foi?",
		"question-12-1-1" => "Aeronaves - Projetos",
		"question-12-1-1-1" => "Quais?",
		"question-12-1-2" => "Aeronaves - Manutenção",
		"question-12-1-2-1" => "Quais?",
		"question-12-1-3" => "Aeronaves - Piloto",
		"question-12-1-4" => "Aeronaves - Comissário",
		"question-12-1-5" => "Aeronaves - Outros",
		"question-12-1-5-1" => "Quais?",
		"question-12-2" => "Operações de Solo",
		"question-12-2-1" => "Quais?",
		"question-12-3" => "Operações de Voo",
		"question-12-3-1" => "Quais?",
		"question-12-4" => "Suprimentos",
		"question-12-4-1" => "Quais?",
		"question-12-5" => "Contabilidade",
		"question-12-5-1" => "Quais?",
		"question-12-6-1" => "Comercial - Vendas",
		"question-12-6-2" => "Comercial - Marketing",
		"question-12-6-2-1" => "Quais?",
		"question-12-6-3" => "Comercial - Prospecção",
		"question-12-6-4" => "Comercial - Telemarketing",
		"question-12-6-5" => "Comercial - Pós-venda",
		"question-12-6-6" => "Comercial - Atendimento ao Cliente",
		"question-12-6-7" => "Comercial - Outros",
		"question-12-6-7-1" => "Quais?",
		"question-12-7-1" => "Jurídico - Civil",
		"question-12-7-1-1" => "Quais?",
		"question-12-7-2" => "Jurídico - Tributário",
		"question-12-7-2-1" => "Quais?",
		"question-12-7-3" => "Jurídico - Penal",
		"question-12-7-3-1" => "Quais?",
		"question-12-8-1" => "TI - Linguagem",
		"question-12-8-1-1" => "Quais?",
		"question-12-8-2" => "TI - Banco de Dados",
		"question-12-8-2-1" => "Quais?",
		"question-12-8-3" => "TI - HelpDesk",
		"question-12-8-4" => "TI - Redes",
		"question-12-8-5" => "TI - Servidores",
		"question-12-8-5-1" => "Quais?",
		"question-12-9-1" => "Engenharia - Aeronáutica",
		"question-12-9-1-1" => "Quais?",
		"question-12-9-2" => "Engenharia - Mecânica",
		"question-12-9-2-1" => "Quais?",
		"question-12-9-3" => "Engenharia - Civil",
		"question-12-9-3-1" => "Quais?",
		"question-12-10" => "Administração",
		"question-12-10-1" => "Quais?",
		"question-12-11" => "Recursos Humanos",
		"question-12-11-1" => "Quais?",
		"question-12-12" => "Treinamento",
		"question-12-12-1" => "Quais?",
		"question-12-13" => "Outros?",
		"question-12-13-1" => "Quais?",
		"question-13" => "13. Algum desses treinamentos é certificado pelo Fabricante? Se sim, quais?",
		"question-14" => "14. Algum desses treinamentos é validado pela Autoridade da área de atuação? Se sim, quais?",
		"question-15" => "15. Você possui treinamento em alguma ferramenta específica para realização de tarefas na função?",
		"question-16" => "16. Você já utilizou os conhecimentos adquiridos nesse(s) treinamento(s) na realização de tarefas na função? Se sim, quais?",
		"question-17" => "17. Qual o treinamento você considera de maior relevância para a função? Por quê?",
		"question-18" => "18. Você planeja fazer mais algum treinamento no futuro? Se sim, quais? Por quê?",
		"question-19" => "19. Na sua opinião, em quais aspectos o treinamento que você quer fazer, lhe ajudaria no desenvolvimento da sua carreira?",
		"question-20" => "20. Qual treinamento que você já fez você considera que foi menos proveitoso para a função?",
		"question-21" => "21. Qual treinamento você considera que precisa fazer para dar o próximo passo na sua carreira?",
		"question-22" => "22. Você possui contatos com os quais mantém relacionamento nas seguintes áreas?",
		"question-22-1" => "Quais?",
		"question-23" => "23. Qual seu nível de relacionamento com as empresas citadas acima?",
		"question-24" => "24. Em quais setores das empresas citadas acima você possui relacionamento?",
		"question-24-1" => "Quais?",
		"question-25" => "25. Quais desses contatos você considera mais importantes para a função?",
		"question-26" => "26. Descreva seu nível de relacionamentos com os contatos citados no item iv:",
		"question-27" => "27. Esses contatos podem fornecer boas referências a seu respeito? Se sim informe nome e contato.",
		"question-28" => "28. Em qual área da aviação você julga ter o melhor nível de relacionamento?",
		"question-29" => "29. Quais características profissionais você acredita que esses contatos poderiam citar a seu respeito?",
		"question-30" => "30. Você já teve ou possui atualmente algum atrito, divergência ou disputa judicial com alguma empresa ligada a Aviação? Se sim, quais?",
		"question-31" => "31. Você já teve algum conflito de maior proporção com alguma pessoa ligada a aviação que poderia influenciar sua carreira em alguma empresa da aviação? Se sim, quais?"
	];

	if($empty) { // DEIXA TODOS OS CAMPOS EM BRANCO
		$fields = make_empty_values($fields);
	}

	return $fields;
}


// MONTA AS RESPOSTAS DA AVALIAÇÃO TÉCNICA (CONHECIMENTO TÉCNICO ESPECÍFICO)
function specific_technical_knowledge_response(int $student): array {
	$questions = response($student, 3);

	// MONTA AS RESPOSTAS DOS VETORES
	$questions["question-1"] = explode("||", $questions["question-1"]);
	array_pop($questions["question-1"]);
	$questions["question-12-1-1"] = explode("||", $questions["question-12-1-1"]);
	array_pop($questions["question-12-1-1"]);
	$questions["question-12-1-2"] = explode("||", $questions["question-12-1-2"]);
	array_pop($questions["question-12-1-2"]);
	$questions["question-12-1-3"] = explode("||", $questions["question-12-1-3"]);
	array_pop($questions["question-12-1-3"]);
	$questions["question-12-1-4"] = explode("||", $questions["question-12-1-4"]);
	array_pop($questions["question-12-1-4"]);
	$questions["question-12-1-5"] = explode("||", $questions["question-12-1-5"]);
	array_pop($questions["question-12-1-5"]);
	$questions["question-12-10"] = explode("||", $questions["question-12-10"]);
	array_pop($questions["question-12-10"]);
	$questions["question-12-11"] = explode("||", $questions["question-12-11"]);
	array_pop($questions["question-12-11"]);
	$questions["question-12-12"] = explode("||", $questions["question-12-12"]);
	array_pop($questions["question-12-12"]);
	$questions["question-12-13"] = explode("||", $questions["question-12-13"]);
	array_pop($questions["question-12-13"]);
	$questions["question-12-2"] = explode("||", $questions["question-12-2"]);
	array_pop($questions["question-12-2"]);
	$questions["question-12-3"] = explode("||", $questions["question-12-3"]);
	array_pop($questions["question-12-3"]);
	$questions["question-12-4"] = explode("||", $questions["question-12-4"]);
	array_pop($questions["question-12-4"]);
	$questions["question-12-5"] = explode("||", $questions["question-12-5"]);
	array_pop($questions["question-12-5"]);
	$questions["question-12-6-1"] = explode("||", $questions["question-12-6-1"]);
	array_pop($questions["question-12-6-1"]);
	$questions["question-12-6-2"] = explode("||", $questions["question-12-6-2"]);
	array_pop($questions["question-12-6-2"]);
	$questions["question-12-6-3"] = explode("||", $questions["question-12-6-3"]);
	array_pop($questions["question-12-6-3"]);
	$questions["question-12-6-4"] = explode("||", $questions["question-12-6-4"]);
	array_pop($questions["question-12-6-4"]);
	$questions["question-12-6-5"] = explode("||", $questions["question-12-6-5"]);
	array_pop($questions["question-12-6-5"]);
	$questions["question-12-6-6"] = explode("||", $questions["question-12-6-6"]);
	array_pop($questions["question-12-6-6"]);
	$questions["question-12-6-7"] = explode("||", $questions["question-12-6-7"]);
	array_pop($questions["question-12-6-7"]);
	$questions["question-12-7-1"] = explode("||", $questions["question-12-7-1"]);
	array_pop($questions["question-12-7-1"]);
	$questions["question-12-7-2"] = explode("||", $questions["question-12-7-2"]);
	array_pop($questions["question-12-7-2"]);
	$questions["question-12-7-3"] = explode("||", $questions["question-12-7-3"]);
	array_pop($questions["question-12-7-3"]);
	$questions["question-12-8-1"] = explode("||", $questions["question-12-8-1"]);
	array_pop($questions["question-12-8-1"]);
	$questions["question-12-8-2"] = explode("||", $questions["question-12-8-2"]);
	array_pop($questions["question-12-8-2"]);
	$questions["question-12-8-3"] = explode("||", $questions["question-12-8-3"]);
	array_pop($questions["question-12-8-3"]);
	$questions["question-12-8-4"] = explode("||", $questions["question-12-8-4"]);
	array_pop($questions["question-12-8-4"]);
	$questions["question-12-8-5"] = explode("||", $questions["question-12-8-5"]);
	array_pop($questions["question-12-8-5"]);
	$questions["question-12-9-1"] = explode("||", $questions["question-12-9-1"]);
	array_pop($questions["question-12-9-1"]);
	$questions["question-12-9-2"] = explode("||", $questions["question-12-9-2"]);
	array_pop($questions["question-12-9-2"]);
	$questions["question-12-9-3"] = explode("||", $questions["question-12-9-3"]);
	array_pop($questions["question-12-9-3"]);
	$questions["question-22"] = explode("||", $questions["question-22"]);
	array_pop($questions["question-22"]);
	$questions["question-24"] = explode("||", $questions["question-24"]);
	array_pop($questions["question-24"]);

	return $questions;
}


// VERIFICA SE O ALUNO TERMINOU A ETAPA AVALIAÇÃO TÉCNICA (CONHECIMENTO TÉCNICO ESPECÍFICO)
function specific_technical_knowledge_finished(int $student): bool {
	return form_finished($student, 3);
}


// CAPTURA A HORA DE INÍCIO DA ETAPA AVALIAÇÃO TÉCNICA (CONHECIMENTO TÉCNICO ESPECÍFICO)
function specific_technical_knowledge_start_time(int $student): string {
	return start_time($student, 3);
}


// CAPTURA A HORA DE TÉRMINO DA ETAPA AVALIAÇÃO TÉCNICA (CONHECIMENTO TÉCNICO ESPECÍFICO)
function specific_technical_knowledge_end_time(int $student): ?string {
	return end_time($student, 3);
}


// MONTA O QUESTIONÁRIO DE AVALIAÇÃO TÉCNICA (SEGURANÇA OPERACIONAL E REGULAÇÃO)
function operational_safety_and_regulation_form(bool $empty=false): array {
	$fields = [
		"question-1" => "1. Você possui algum conhecimento sobre SGSO? Se sim, escreva em poucas palavras o que você entende sobre SGSO:",
		"question-2" => "2. Alguma de suas tarefas e procedimentos tem relacionamento direto com os itens cobertos por Manuais de SGSO? Se sim, quais?",
		"question-3" => "3. Você teve contato direto com os manuais de SGSO no desempenho da função? Se sim, em quais procedimentos?",
		"question-4" => "4. Você teve dificuldade com os procedimentos de Segurança Operacional no exercício da função? Se sim, quais?",
		"question-5" => "5. Você já desenvolveu procedimentos ou manuais de SGSO? Se sim, quais?",
		"question-6" => "6. Você teve contato com manuais e procedimentos de SGSO em inglês?",
		"question-7" => "7. Você já executou tarefas relacionadas diretamente a Segurança Operacional nos seguintes tipos de empresa?",
		"question-8" => "8. Você já executou tarefas que poderiam influenciar na Segurança Operacional? Se sim, quais?",
		"question-9" => "9. Qual seu grau de envolvimento direto na Segurança Operacional?",
		"question-10" => "10. Havia regulação específica ou supervisionamento de alguma autoridade aeronáutica nessas tarefas? Se sim, quais?",
		"question-11" => "11. Você já teve alguma dificuldade para manter a Segurança Operacional devido ao atrito com alguma pessoa ou autoridade? Se sim, quais?"
	];

	if($empty) { // DEIXA TODOS OS CAMPOS EM BRANCO
		$fields = make_empty_values($fields);
	}

	return $fields;
}


// MONTA AS RESPOSTAS DA AVALIAÇÃO TÉCNICA (SEGURANÇA OPERACIONAL E REGULAÇÃO)
function operational_safety_and_regulation_response(int $student): array {
	$questions = response($student, 4);

	// MONTA AS RESPOSTAS DOS VETORES
	$questions["question-7"] = explode("||", $questions["question-7"]);
	array_pop($questions["question-7"]);

	return $questions;
}


// VERIFICA SE O ALUNO TERMINOU A ETAPA AVALIAÇÃO TÉCNICA (SEGURANÇA OPERACIONAL E REGULAÇÃO)
function operational_safety_and_regulation_finished(int $student): bool {
	return form_finished($student, 4);
}


// CAPTURA A HORA DE INÍCIO DA ETAPA AVALIAÇÃO TÉCNICA (SEGURANÇA OPERACIONAL E REGULAÇÃO)
function operational_safety_and_regulation_start_time(int $student): string {
	return start_time($student, 4);
}


// CAPTURA A HORA DE TÉRMINO DA ETAPA AVALIAÇÃO TÉCNICA (SEGURANÇA OPERACIONAL E REGULAÇÃO)
function operational_safety_and_regulation_end_time(int $student): ?string {
	return end_time($student, 4);
}


// MONTA O QUESTIONÁRIO DE AVALIAÇÃO TÉCNICA (EXPERIÊNCIAS ANTERIORES)
function previous_experiences_form(bool $empty=false): array {
	$fields = [
		"question-1" => "1. Cite as empresas e período trabalhado em cada uma de suas experiências anteriores",
		"question-2" => "2. Nas experiências anteriores, cite o cenário encontrado quando chegou na empresa e como você trabalhou para melhorar o que encontrou?",
		"question-3" => "3. Em quais tipos de empresa você já desempenhou tarefas relativas a função?",
		"question-4" => "4. Você já trabalhou em mais de uma empresa ou cargo relativo a função?",
		"question-4-1" => "Se sim, quais?",
		"question-5" => "5. Em qual nível você já trabalhou na função?",
		"question-6" => "6. Em qual nível você já desempenhou tarefas relativas a função indiretamente?",
		"question-7" => "7. Quais setores internos da empresa você teve relacionamento ao longo de sua carreira? (mais de uma alternativa pode ser marcada)",
		"question-8" => "8. Qual o maior desafio que você enfrentou na construção de sua carreira?",
		"question-9" => "9. Qual o maior desafio profissional que você enfrentou desempenhando a função?",
		"question-10" => "10. Qual foi sua maior conquista profissional desempenhando a função?",
		"question-11" => "11. Qual foi a melhor empresa que você já trabalhou? Por quê?",
		"question-12" => "12. Qual foi a pior empresa que você trabalhou? Por quê?",
		"question-13" => "13. Você já teve algum chefe/gerente que considerasse tóxico?",
		"question-13-1" => "Se sim, conte-nos sobre isso sem mencionar o nome da pessoa.",
		"question-14" => "14. Qual foi a pessoa que mais influenciou sua carreira positivamente dentro de uma empresa?",
		"question-15-1" => "Aeronaves",
		"question-15-1-1" => "Quais?",
		"question-15-2" => "Motores",
		"question-15-2-1" => "Quais?",
		"question-15-3" => "Marque os aviônicos que tem mais familiarização ou já equiparam aeronaves que operou/trabalhou:",
		"question-15-3-1" => "Cite modelos",
		"question-15-3-2" => "Cite modelos",
		"question-15-3-3" => "Cite modelos",
		"question-15-3-4" => "Cite fabricante e modelos",
		"question-16-1-1" => "Estruturas",
		"question-16-1-2" => "Motores",
		"question-16-1-3" => "Aviônica",
		"question-16-1-4" => "Sistemas",
		"question-16-1-5" => "Ferramental",
		"question-16-2-1" => "Coordenação",
		"question-16-2-2" => "Climatologia",
		"question-16-2-3" => "Rotas",
		"question-16-2-4" => "Peso e Balanceamento",
		"question-16-2-5" => "AOG",
		"question-16-2-6" => "SGSO",
		"question-16-2-7" => "AVSEC",
		"question-16-3-1" => "Planejamento",
		"question-16-3-2" => "Projetos",
		"question-16-3-3" => "Manutenção",
		"question-16-3-4" => "Reparos",
		"question-16-3-5" => "Qualidade",
		"question-16-3-6" => "CTM",
		"question-16-4-1" => "Compras",
		"question-16-4-2" => "Reparos",
		"question-16-4-3" => "Almoxarifado",
		"question-16-4-4" => "Logística",
		"question-16-4-5" => "Vendas",
		"question-16-4-6" => "Prospecção",
		"question-16-4-7" => "Marketing",
		"question-16-4-8" => "Design",
		"question-16-4-9" => "Contabilidade",
		"question-16-4-10" => "RH",
		"question-16-5-1" => "Programação",
		"question-16-5-2" => "Help Desk",
		"question-16-5-3" => "Redes",
		"question-16-5-4" => "Banco de Dados",
		"question-16-5-5" => "Projetos",
		"question-16-6-1" => "Excel",
		"question-16-6-2" => "Word",
		"question-16-6-3" => "PowerPoint",
		"question-16-6-4" => "Access",
		"question-16-6-5" => "Totvs",
		"question-16-6-6" => "SAP",
		"question-16-6-7" => "Photoshop",
		"question-16-6-8" => "Premiere",
		"question-16-6-9" => "Illustrator",
		"question-16-6-10" => "Salesforce",
		"question-16-6-11" => "PowerBI",
		"question-16-6-12" => "Notes",
		"question-16-6-13" => "Outros",
		"question-17" => "17. Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto mais forte?",
		"question-18" => "18. Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto de melhoria?",
		"question-19" => "19. Você se considera um expert em algo?",
		"question-19-1" => "Se sim, qual(is)?",
		"question-20" => "20. Descreva algum conhecimento técnico específico que você adquiriu no desempenho da função não descrito acima",
		"question-21" => "21. Descreva algum conhecimento técnico específico que você adquiriu na sua carreira e que julga de importância, mas não descrito acima"
	];

	if($empty) { // DEIXA TODOS OS CAMPOS EM BRANCO
		$fields = make_empty_values($fields);
	}

	return $fields;
}


// MONTA AS RESPOSTAS DA AVALIAÇÃO TÉCNICA (EXPERIÊNCIAS ANTERIORES)
function previous_experiences_response(int $student): array {
	$questions = response($student, 5);

	// MONTA AS RESPOSTAS DOS VETORES
	$questions["question-3"] = explode("||", $questions["question-3"]);
	array_pop($questions["question-3"]);
	$questions["question-7"] = explode("||", $questions["question-7"]);
	array_pop($questions["question-7"]);
	$questions["question-15-1"] = explode("||", $questions["question-15-1"]);
	array_pop($questions["question-15-1"]);
	$questions["question-15-2"] = explode("||", $questions["question-15-2"]);
	array_pop($questions["question-15-2"]);
	$questions["question-15-3"] = explode("||", $questions["question-15-3"]);
	array_pop($questions["question-15-3"]);

	return $questions;
}


// VERIFICA SE O ALUNO TERMINOU A ETAPA AVALIAÇÃO TÉCNICA (EXPERIÊNCIAS ANTERIORES)
function previous_experiences_finished(int $student): bool {
	return form_finished($student, 5);
}


// CAPTURA A HORA DE INÍCIO DA ETAPA AVALIAÇÃO TÉCNICA (EXPERIÊNCIAS ANTERIORES)
function previous_experiences_start_time(int $student): string {
	return start_time($student, 5);
}


// CAPTURA A HORA DE TÉRMINO DA ETAPA AVALIAÇÃO TÉCNICA (EXPERIÊNCIAS ANTERIORES)
function previous_experiences_end_time(int $student): ?string {
	return end_time($student, 5);
}


// MONTA O QUESTIONÁRIO DE NÍVEL DE INGLÊS (INGLÊS MÉDIO)
function medium_english_form(bool $empty=false): array {
	$fields = [
		"question-1" => "1. Charlie! Good to see you, man. It’s ____ a long time we don’t chat! How ____ Lisa doing?",
		"question-2" => "2. The Catering is waiting but I can’t open the door, L5 door is jammed. ____ you please help me ____ it? I’ll call the engineers to come check it out.",
		"question-3" => "3. The outbreak of Coronavirus disease (COVID-19) has acted as a massive restraint on the commercial aircraft manufacturing market in 2020, as supply chains were disrupted due to trade restrictions and manufacturing was affected by extensive lockdowns globally.",
		"question-4" => "4. Scarcely ______ taken off, we were forced to make an emergency landing.",
		"question-5" => "5. Aircraft manufacturers are using machine-learning techniques such as artificial intelligence (AI) to enhance aircraft safety and quality, as well as the manufacturing productivity.",
		"question-6" => "6. Susan: Hey Mike, just to let you know, I got a flat tire and I probably _____________ late for the meeting. I’m on my way there though.",
		"question-7" => "7. You’d better take these tools with you _______ you need to make a repair.",
		"question-8" => "8. Would you mind _________ the Section 7.3 of the Manual to me, please? There’s a procedure I want to review with the team today.",
		"question-9" => "9. Boeing has successfully built machine-learning algorithms to design aircraft and automate factory operations.",
		"question-10" => "10. The other day I ran into Juliet on the way to the office and she told me about the new policies to be implemented.",
		"question-11" => "11. I can’t wait to see my father. He’s arriving tomorrow.",
		"question-12" => "12. Flight Attendant: Which one do you prefer, coffee or tea?",
		"question-13" => "13. Machine learning algorithms collect data from machine-to-machine and machine-tohuman interfaces and use data analytics to drive effective decision making. These technologies optimize manufacturing operations and lower costs. For example, GE Aviation uses machine learning and data analytics to identify faults in engines, which increases components’ lives and reduces maintenance costs.",
		"question-14" => "14. I need to _____ a word with Oscar about my license expiration, I’ll _____ on a break in an hour.",
		"question-15" => "15. _____ can I get to the main station from here? _____ I go up or down this street?"
	];

	if($empty) { // DEIXA TODOS OS CAMPOS EM BRANCO
		$fields = make_empty_values($fields);
	}

	return $fields;
}


// MONTA AS RESPOSTAS DO NÍVEL DE INGLÊS (INGLÊS MÉDIO)
function medium_english_response(int $student): array {
	return response($student, 6);
}


// VERIFICA SE O ALUNO TERMINOU A ETAPA NÍVEL DE INGLÊS (INGLÊS MÉDIO)
function medium_english_finished(int $student): bool {
	return form_finished($student, 6);
}


// CAPTURA A HORA DE INÍCIO DA ETAPA NÍVEL DE INGLÊS (INGLÊS MÉDIO)
function medium_english_start_time(int $student): string {
	return start_time($student, 6);
}


// CAPTURA A HORA DE TÉRMINO DA ETAPA NÍVEL DE INGLÊS (INGLÊS MÉDIO)
function medium_english_end_time(int $student): ?string {
	return end_time($student, 6);
}


// CALCULA A MÉDIA DO ALUNO NA ETAPA NÍVEL DE INGLÊS (INGLÊS MÉDIO)
function medium_english_feedback(int $student): float {
	// PROCURA NO BANCO DE DADOS SE O USUÁRIO POSSUI ALGUMA RESPOSTA ENVIADA ANTERIORMENTE
	$responses = medium_english_response($student);

	// GABARITO DAS PERGUNTAS
	$feedback = [
		"Been / is",
		"Would / push",
		"The economic impact of COVID-19 and its preventative measures on commercial negotiations in the aircraft manufacturing market and industry development in 2020.",
		"had we",
		"Improve",
		"will be running / Do you need a ride?",
		"in case",
		"forwarding",
		"Artificial Intelligence has been employed in the aircraft manufacturing industry.",
		"Bumped into",
		"I’m looking forward to it.",
		"I’ll have",
		"The learning capacity of machines is highly effective for factory operation, as it can be used in various segments of manufacturing and assist in decision making.",
		"have / go",
		"How / Should"
	];

	// PESOS DE CADA PERGUNTA
	$weights = [2, 2, 3, 2, 2, 1, 1, 2, 3, 2, 1, 2, 3, 2, 1];

	// CALCULA A NOTA DO ALUNO
	$index = 0;
	$sum = 0;
	foreach($responses as $response) {
		if($response === $feedback[$index]) {
			$sum += $weights[$index];
		}
		$index++;
	}

	return ($sum / array_sum($weights)) * 100;
}


// MONTA O QUESTIONÁRIO DE AVALIAÇÃO COMPORTAMENTAL (PRIMEIRA ETAPA)
function first_step_form(bool $empty=false): array {
	$fields = [
		"question-1" => "Me preocupo com as coisas",
		"question-2" => "Faço amigos com facilidade",
		"question-3" => "Tenho imaginação vívida",
		"question-4" => "Confio nos outros",
		"question-5" => "Completo as tarefas que me são passadas",
		"question-6" => "Me irrito facilmente",
		"question-7" => "Amo festas grandes",
		"question-8" => "Acredito na importância da arte",
		"question-9" => "Uso os outros para alcançar meus fins",
		"question-10" => "Gosta de organizar as coisas",
		"question-11" => "Costumo me sentir desanimado(a)",
		"question-12" => "Assumo a liderança",
		"question-13" => "Expresso minhas emoções intensamente",
		"question-14" => "Adoro ajudar aos outros",
		"question-15" => "Mantenho minhas promessas",
		"question-16" => "Tenho dificuldade de me aproximar dos outros",
		"question-17" => "Estou sempre ocupado(a)",
		"question-18" => "Prefiro variedade à rotina",
		"question-19" => "Adoro uma boa luta",
		"question-20" => "Trabalho duro",
		"question-21" => "Cometo exageros",
		"question-22" => "Busco adrenalina",
		"question-23" => "Gosto de ler textos desafiadores",
		"question-24" => "Acredito ser melhor que os outros",
		"question-25" => "Estou sempre preparado",
		"question-26" => "Entro em pânico facilmente",
		"question-27" => "Irradio alegria",
		"question-28" => "Tendo a votar em candidatos progressistas",
		"question-29" => "Me preocupo com os desabrigados",
		"question-30" => "Faço sem pensar"
	];

	if($empty) { // DEIXA TODOS OS CAMPOS EM BRANCO
		$fields = make_empty_values($fields);
	}

	return $fields;
}


// MONTA AS RESPOSTAS DA AVALIAÇÃO COMPORTAMENTAL (PRIMEIRA ETAPA)
function first_step_response(int $student): array {
	return response($student, 7);
}


// CAPTURA A HORA DE INÍCIO DA ETAPA AVALIAÇÃO COMPORTAMENTAL (PRIMEIRA ETAPA)
function first_step_start_time(int $student): string {
	return start_time($student, 7);
}


// CAPTURA A HORA DE TÉRMINO DA ETAPA AVALIAÇÃO COMPORTAMENTAL (PRIMEIRA ETAPA)
function first_step_end_time(int $student): ?string {
	return end_time($student, 7);
}


// MONTA O QUESTIONÁRIO DE AVALIAÇÃO COMPORTAMENTAL (SEGUNDA ETAPA)
function second_step_form(bool $empty=false): array {
	$fields = [
		"question-1" => "Temo o pior",
		"question-2" => "Me sinto confortável no meio das pessoas",
		"question-3" => "Adoro histórias fantásticas",
		"question-4" => "Acredito que os outros são bem intencionados",
		"question-5" => "Sou muito bom no que faço(a)",
		"question-6" => "Me irrito facilmente",
		"question-7" => "Converso com muitas pessoas diferentes em festas",
		"question-8" => "Vejo beleza em coisas que os outros não veem",
		"question-9" => "Trapaceio para tirar vantagem",
		"question-10" => "Frequentemente esqueço de colocar as coisas de volta em seu lugar",
		"question-11" => "Não gosto de mim",
		"question-12" => "Tento liderar os outros",
		"question-13" => "Sinto as emoções dos outros",
		"question-14" => "Me preocupo com os outros",
		"question-15" => "Digo a verdade",
		"question-16" => "Tenho medo de chamar a atenção",
		"question-17" => "Estou sempre preparado(a)",
		"question-18" => "Prefiro fazer apenas o que sei",
		"question-19" => "Grito com os outros",
		"question-20" => "Supero as expectativas",
		"question-21" => "Dificilmente exagero",
		"question-22" => "Busco aventura",
		"question-23" => "Evito discussões filosóficas",
		"question-24" => "Me tenho em grande estima",
		"question-25" => "Transformo meus planos em realidade",
		"question-26" => "Me sinto sobrecarregado em eventos",
		"question-27" => "Me divirto bastante",
		"question-28" => "Acredito que certo e errado são relativos",
		"question-29" => "Sinto pena dos que são piores do que eu",
		"question-30" => "Tomo decisões difíceis"
	];

	if($empty) { // DEIXA TODOS OS CAMPOS EM BRANCO
		$fields = make_empty_values($fields);
	}

	return $fields;
}


// MONTA AS RESPOSTAS DA AVALIAÇÃO COMPORTAMENTAL (SEGUNDA ETAPA)
function second_step_response(int $student): array {
	return response($student, 8);
}


// CAPTURA A HORA DE INÍCIO DA ETAPA AVALIAÇÃO COMPORTAMENTAL (SEGUNDA ETAPA)
function second_step_start_time(int $student): string {
	return start_time($student, 8);
}


// CAPTURA A HORA DE TÉRMINO DA ETAPA AVALIAÇÃO COMPORTAMENTAL (SEGUNDA ETAPA)
function second_step_end_time(int $student): ?string {
	return end_time($student, 8);
}


// MONTA O QUESTIONÁRIO DE AVALIAÇÃO COMPORTAMENTAL (TERCEIRA ETAPA)
function third_step_form(bool $empty=false): array {
	$fields = [
		"question-1" => "Tenho medo de muitas coisas",
		"question-2" => "Evito encontrar outras pessoas",
		"question-3" => "Amo ficar no mundo da lua",
		"question-4" => "Confio no que dizem",
		"question-5" => "Executo as tarefas sem maiores problemas",
		"question-6" => "Perco a cabeça",
		"question-7" => "Prefiro ficar sozinho(a)",
		"question-8" => "Não gosto de poesia",
		"question-9" => "Tiro vantagem dos outros",
		"question-10" => "Meu quarto é uma bagunça",
		"question-11" => "Estou sempre deprimido",
		"question-12" => "Assumo controle das coisas",
		"question-13" => "Raramente percebo minha própria reação emocional",
		"question-14" => "Sou indiferente ao sentimento dos outros",
		"question-15" => "Quebro as regras",
		"question-16" => "Só me sinto bem com meus amigos(as)",
		"question-17" => "Faço muitas coisas no tempo livre",
		"question-18" => "Sou avesso a mudanças",
		"question-19" => "Insulto os outros",
		"question-20" => "Faço apenas o necessário",
		"question-21" => "Resisto a tentações facilmente",
		"question-22" => "Gosto de ser inconsequente",
		"question-23" => "Tenho dificuldade com ideias abstratas",
		"question-24" => "Me considero muito bom(boa)",
		"question-25" => "Fico perdendo tempo",
		"question-26" => "Acho que sou incapaz de lidar com as coisas",
		"question-27" => "Amo a vida",
		"question-28" => "Tende a votar em políticos conservadores",
		"question-29" => "Não me interesso pelos problemas dos outros",
		"question-30" => "Já saio fazendo"
	];

	if($empty) { // DEIXA TODOS OS CAMPOS EM BRANCO
		$fields = make_empty_values($fields);
	}

	return $fields;
}


// MONTA AS RESPOSTAS DA AVALIAÇÃO COMPORTAMENTAL (TERCEIRA ETAPA)
function third_step_response(int $student): array {
	return response($student, 9);
}


// CAPTURA A HORA DE INÍCIO DA ETAPA AVALIAÇÃO COMPORTAMENTAL (TERCEIRA ETAPA)
function third_step_start_time(int $student): string {
	return start_time($student, 9);
}


// CAPTURA A HORA DE TÉRMINO DA ETAPA AVALIAÇÃO COMPORTAMENTAL (TERCEIRA ETAPA)
function third_step_end_time(int $student): ?string {
	return end_time($student, 9);
}


// MONTA O QUESTIONÁRIO DE AVALIAÇÃO COMPORTAMENTAL (QUARTA ETAPA)
function fourth_step_form(bool $empty=false): array {
	$fields = [
		"question-1" => "Me irrito facilmente",
		"question-2" => "Mantenho distância dos outros",
		"question-3" => "Me perco nos pensamentos",
		"question-4" => "Desconfio das pessoas",
		"question-5" => "Sei como fazer as coisas",
		"question-6" => "Não sou incomodado facilmente",
		"question-7" => "Evito multidões",
		"question-8" => "Não gosto de ir ao museu de arte",
		"question-9" => "Atrapalho os planos dos outros",
		"question-10" => "Deixo minhas coisas espalhadas",
		"question-11" => "Me sinto confortável comigo",
		"question-12" => "Aguardo outras pessoas tomarem a liderança",
		"question-13" => "Não entendo pessoas que agem emocionalmente",
		"question-14" => "Não tiro tempo para os outros",
		"question-15" => "Quebro minhas promessas",
		"question-16" => "Não sou incomodado(a) por situações sociais difíceis",
		"question-17" => "Gosto de pegar leve",
		"question-18" => "Sou tradicional",
		"question-19" => "Entro em contato com os outros",
		"question-20" => "Dedico pouco tempo e esforço no meu trabalho",
		"question-21" => "Controlo minhas vontades",
		"question-22" => "Ajo de forma descontrolada",
		"question-23" => "Não me interesso por discussões teóricas",
		"question-24" => "Gosto de falar das minhas virtudes",
		"question-25" => "Tenho dificuldade para começar as tarefas",
		"question-26" => "Fico calmo(a) sob pressão",
		"question-27" => "Vejo o lado bom da vida",
		"question-28" => "Acredito que precisamos ser rígidos com o crime",
		"question-29" => "Tento não pensar nos necessitados",
		"question-30" => "Ajo sem pensar"
	];

	if($empty) { // DEIXA TODOS OS CAMPOS EM BRANCO
		$fields = make_empty_values($fields);
	}

	return $fields;
}


// MONTA AS RESPOSTAS DA AVALIAÇÃO COMPORTAMENTAL (QUARTA ETAPA)
function fourth_step_response(int $student): array {
	return response($student, 10);
}


// CAPTURA A HORA DE INÍCIO DA ETAPA AVALIAÇÃO COMPORTAMENTAL (QUARTA ETAPA)
function fourth_step_start_time(int $student): string {
	return start_time($student, 10);
}


// CAPTURA A HORA DE TÉRMINO DA ETAPA AVALIAÇÃO COMPORTAMENTAL (QUARTA ETAPA)
function fourth_step_end_time(int $student): ?string {
	return end_time($student, 10);
}


// MONTA O QUESTIONÁRIO DE AVALIAÇÃO COMPORTAMENTAL
function behavioral_assessment_form(bool $empty=false): array {
	$i = 1;
	$fields = [];

	foreach(first_step_form($empty) as $fs) {
		$fields["question-" . $i] = $fs;
		$i++;
	}
	foreach(second_step_form($empty) as $ss) {
		$fields["question-" . $i] = $ss;
		$i++;
	}
	foreach(third_step_form($empty) as $ts) {
		$fields["question-" . $i] = $ts;
		$i++;
	}
	foreach(fourth_step_form($empty) as $fs) {
		$fields["question-" . $i] = $fs;
		$i++;
	}

	return $fields;
}


// MONTA AS RESPOSTAS DA AVALIAÇÃO COMPORTAMENTAL
function behavioral_assessment_response(int $student): array {
	$first = first_step_response($student);
	$second = second_step_response($student);
	$third = third_step_response($student);
	$fourth = fourth_step_response($student);

	if(!empty($first) && !empty($second) && !empty($third) && !empty($fourth)) { // ENCONTROU RESPOSTA PARA TODAS AS ETAPAS
		$i = 1;
		$responses = array_merge(array_values($first), array_values($second), array_values($third), array_values($fourth));

		foreach($responses as $r) {
			unset($responses[$i - 1]);
			$responses["question-" . $i++] = $r;
		}

		return $responses;
	}

	return array_map(function(): string {
		return "";
	}, range(0, 119));
}


// VERIFICA SE O ALUNO TERMINOU O MÓDULO AVALIAÇÃO COMPORTAMENTAL
function behavioral_assessment_finished(int $student): bool {
	$first_step = form_finished($student, 7);
	$second_step = form_finished($student, 8);
	$third_step = form_finished($student, 9);
	$fourth_step = form_finished($student, 10);

	return $first_step && $second_step && $third_step && $fourth_step;
}


// CAPTURA O TEMPO EM MINUTOS DE REALIZAÇÃO DA AVALIAÇÃO COMPORTAMENTAL
function behavioral_assessment_time(int $student): int {
	$start = first_step_start_time($student);
	$end = fourth_step_end_time($student);

	$start = strtotime($start);
	$end = strtotime($end);

	return round(abs($start - $end) / 60, 2);
}


// RETORNA AS POSSÍVEIS RESPOSTAS DA AVALIAÇÃO COMPORTAMENTAL
function behavioral_assessment_alternatives(): array {
	return [
		"Muito inadequado",
		"Relativamente inadequado",
		"Nem adequado, nem inadequado",
		"Relativamente adequado",
		"Muito adequado"
	];
}


// MONTA O VETOR DE RESPOSTAS PARA ENVIAR PARA A API DO BIGFIVE
function behavioral_assessment_api(int $student): array {
	$array = behavioral_assessment_response($student) ?: array_map(function(int $value): int {
		return $value;
	}, range(0, 119));

	$questions = [
		"43c98ce8-a07a-4dc2-80f6-c1b2a2485f06", "d50a597f-632b-4f7b-89e6-6d85b50fd1c9", "888dd864-7449-4e96-8d5c-7a439603ea91",
		"ce2fbbf8-7a97-4199-bda5-117e4ecdf3b6", "c7f53c3c-2e77-432f-bb71-7470b67d3aa9", "48ad12ce-470e-4339-90ac-ea8c43a0103e",
		"458f3957-2359-4077-ade1-34525d633063", "58d571e5-d725-4cf8-a438-32c16ee28eb6", "0cf79e27-e702-45c2-9471-04ac96b58e0e",
		"cda1ca17-b599-4561-a6cd-ff9d36062d27", "5e8550d7-b8ef-4905-950a-f81d735d39e2", "8af754f2-68e9-48f3-8c5d-2e6633d4472c",
		"0727def6-3d18-4221-bf38-86b58f9f3eed", "ccf3a5c8-fb50-4bd4-8e7a-22af3d657279", "73d84e5d-cbf5-47f0-b8cb-4d2159a52e32",
		"b2d9ef74-73f5-4ea8-b00c-7aaca15937df", "48a761ef-438e-409b-ae59-ea2ce8f84414", "cae55842-8957-4e3b-83b3-ceff98fb9dcf",
		"e2028ad3-b128-4f76-be57-398bfe2aff22", "b7fc949b-02b6-4cb9-a3e2-dbb3d824b55f", "481efd08-c810-43b1-a952-f8ac9052f96b",
		"987efee2-899f-4a65-b9b5-1589ef0460d7", "e1e804c7-4a1d-498f-8610-f95147af9d1d", "71029381-3908-4c68-91e1-e41fb45542a2",
		"f6076eea-56ae-4b46-97f1-5f94a7676c96", "2f519935-92e8-48ad-9746-4a0f8b38466a", "899c3f66-51d0-46ea-963a-6fc36d3b3cb9",
		"79186f48-e7fa-4df4-b74b-b0627ee244e1", "fd50e1ca-d9e0-4037-a7a1-a191d4db2d96", "bd9eec0a-b68b-472c-8803-7db29c308cdb",
		"7f92ab2c-265c-4b84-8c74-09f9bb9d41a7", "af55f014-788c-4b6e-92c4-b2b59dc8a28d", "08ff6dca-02a5-4aeb-aaa4-2ecf2526f143",
		"6f66cdc0-9044-457b-b40d-501ecae15ee7", "f110fc66-2e9e-413c-920b-19f05e63d7ac", "7dab2a37-8635-4fc7-86b7-0abf13c183c9",
		"28ab59a0-e7cd-4fce-94e3-bba2ecc023b6", "b5919f2f-cded-4745-a9ce-c02703cee807", "5a5fa975-d024-4ac8-8845-2823f957c21b",
		"adf33f9f-45bd-43e3-af25-4c491176d97f", "f0a14e16-d726-47e9-a2c1-647fd3d7d52e", "0b38e3d3-c15c-454c-b034-f4eb7ae1580a",
		"5631b856-ff34-4f76-a0cd-edc7104c3bfa", "ada867af-4db1-4e3d-a604-2b695c1806e5", "c55e3958-00c4-4fc3-9118-47d8f31bfde1",
		"acd8fadc-5399-4a67-b5ff-9d1ada049c01", "d07b6c67-0d02-4948-a997-bb84ac234cd8", "33b81fd0-7e32-4cd8-a13a-d5f5f754f998",
		"d9a9a180-29c9-4ec5-8621-2256d411def7", "f12c3d9d-1d12-4aa6-ad2e-009cd0651cbb", "9891b7ba-a494-4307-aafe-301d8db506c6",
		"f1675af6-88bf-4376-a946-0281e762b39c", "95a3f20c-f933-4d19-a2c1-a7dbdf63c562", "7df44711-4cd4-4b05-8830-73fcc3ebdab5",
		"9d3cb5c7-955c-43a4-b6c7-b07ed01dcbd9", "13c58810-3864-42ba-aa87-d4166f858756", "961376e0-16a1-4c14-b059-789e63d11b63",
		"f08e1b27-3673-4898-9cae-896482d0d9f9", "c2038c12-7a37-47a8-9983-831bd6692aab", "956f3e17-ff17-4af5-a52f-9222b8968106",
		"4d81238b-5407-47d4-88e5-dc0e38aa14f5", "9f9166f0-fa94-4c14-a91d-3eecd8395794", "23a1034f-fab7-4887-a66e-5ef4eaafb25e",
		"c63e6121-c3ed-40cc-abc2-c1e6ea1e0858", "02ee1930-36a7-4caa-b10c-c93efb682a44", "da8e6ed1-2296-4c58-8fdb-66f2f591989b",
		"03c10b30-b88f-4c63-8acc-71251ca24615", "751a04bc-5adf-485a-8ea4-4308406ae85b", "982e83c2-d34e-48da-9c71-78494ab05c85",
		"f4891687-0ff0-47af-a4f6-d1202c8f6676", "743d8973-1de1-4485-91b4-8a5cf63e7d44", "2452f034-8273-4f71-9122-a40f5ead31ba",
		"2a300001-6e05-4c79-b8b5-2ccae4c3d463", "cd54bd76-ca9c-4030-b325-bb8d896bcb3f", "4e6e3a34-176f-4e6e-8730-1341611f972b",
		"20062533-a33d-4c1e-9cd9-bff868015b3f", "b2a077d5-1fe0-4b06-ab63-35455e001e54", "0d2e65ab-95d9-482f-beb4-3239a3a4944a",
		"0de0f900-cede-4538-9c00-5da4f830b028", "a9c97d6b-6721-4150-8d84-64ef3082f164", "9f2e7f90-0ca5-4ed0-9fe5-e060238a9b5e",
		"7dd6cf2d-5c14-48c2-8ae5-633a7a596c71", "fecc35f7-681e-4889-a404-4a973a3dfef0", "1d686958-6fe7-432f-85e6-186b99e4e232",
		"c7db0ed8-df7d-49bf-942f-59e46ef743c4", "b7e0e393-9b21-4e0d-adf3-8f28fb5b9d87", "79d956e8-1118-402a-a0e2-9380af18243e",
		"96ba77b2-1a44-4dfd-95f9-ae4d1f714460", "77f54ab4-0fba-4efb-8700-066c7490eb87", "a354cf7c-8d11-46ac-acc5-da90d2048637",
		"43b03992-3f32-4ed1-a6f8-5d6d3e7ed246", "41702602-08e4-4e2b-9a19-291d9efc581a", "935a7413-abac-4f54-9169-d1fbd39da752",
		"432dbde8-8756-4ff0-80d5-f47018235139", "5727c93f-317b-4af1-a686-77fc9fbc5033", "d32bd062-4eb2-401b-99b2-e7afea39ca9b",
		"9a47184f-6046-4e68-a61b-3d9b357b86ea", "87c5b27e-59a8-4c48-8ba8-f5413d735693", "11b20adb-abed-4363-894c-3dd823ae0540",
		"50418d86-712c-45d9-adc4-ea0231c93cf5", "f40e421f-6c24-4be2-bd9f-28d33358d8c6", "8791f37b-686f-47c3-9db7-74c009951321",
		"4fd25155-9cc2-4cd6-8852-3e0ca2d5e95d", "b68af20d-24f9-4c27-85cc-fe0858994888", "54423933-0ebb-44a7-bdd9-2a9b100c70f2",
		"7317848c-3e1b-422f-bb16-02efc504f677", "7d93e1ca-46e8-4a30-9623-42a80c9b420c", "a7f43928-8982-4ed5-8656-7a80346fe979",
		"17910a55-a64a-4ed0-8b46-293e2fa2fe03", "3890bb43-2695-4b8d-b289-ee10d11cc884", "49a85680-53aa-4208-86b5-dccc7a6f8e37",
		"10f90fa9-649c-4631-ac4c-3dd3f751597d", "b86de003-c3c4-4cc8-9385-5ac8a0142c34", "80c1d149-7050-481a-9953-aefb441642e7",
		"51403620-968c-42fa-a772-65ba5ad8396f", "88a3c2fe-3aa4-4f46-9322-da656332268a", "e7b31bdc-5f6b-40ec-ba91-f5919b0f170e",
		"580b08d1-3c94-46e9-9d07-d6d80c698127", "48bee420-60c0-45cd-be43-3893dbc1969a", "ea3327ea-3529-4be4-8e2d-2174731ae4d7"
	];

	$url = BIGFIVE_API . "questions/pt-br";
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
	$response = curl_exec($curl);
	curl_close($curl);

	$domain = [
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C",
		"N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C", "N", "E", "O", "A", "C"
	];

	$facet = [
		1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 5, 5, 5, 5, 5, 6, 6, 6, 6, 6,
		1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 5, 5, 5, 5, 5, 6, 6, 6, 6, 6,
		1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 5, 5, 5, 5, 5, 6, 6, 6, 6, 6,
		1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 5, 5, 5, 5, 5, 6, 6, 6, 6, 6
	];

	$response = $response ? json_decode($response) : array_map(function(int $index) use ($questions, $domain, $facet): object {
		return (object) ["id" => $questions[$index], "domain" => $domain[$index], "facet" => $facet[$index]];
	}, range(0, 119));

	$i = 0;
	$answers = [];

	foreach($array as $a) {
		switch($a) {
			case "Muito inadequado":
				$value = 1;
				break;
			case "Relativamente inadequado":
				$value = 2;
				break;
			case "Nem adequado, nem inadequado":
				$value = 3;
				break;
			case "Relativamente adequado":
				$value = 4;
				break;
			case "Muito adequado":
				$value = 5;
				break;
			default:
				$value = 1;
				break;
		}

		array_push($answers, (object) [
			"questionID" => $response[$i]->id,
			"score" => $value,
			"domain" => $response[$i]->domain,
			"facet" => $response[$i]->facet
		]);
		$i++;
	}

	return $answers;
}
