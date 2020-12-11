<?php

require_once("php/util.php");

// Páginas acessíveis de encaminhamento
$paginas = [HOST . "formulario-0.php", HOST . "formulario-1.php", HOST . "formulario-3.php", HOST . "formulario-4.php", HOST . "formulario-5.php", HOST . "formulario-6.php"];

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && !in_array($_SERVER["HTTP_REFERER"], $paginas)) {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Usuário não está autenticado
if(empty($_SESSION) && !isset($_SESSION["id"])) {
	header("Location: index.php");
	return false;
}
// Captura os dados do banco, caso existam
else {
	$campos = ["pergunta-1", "pergunta-2", "pergunta-3", "pergunta-4", "pergunta-5", "pergunta-6", "pergunta-7", "pergunta-8", "pergunta-9", "pergunta-10", "pergunta-11", "pergunta-11-1", "pergunta-12", "pergunta-13", "pergunta-14", "pergunta-14-1", "pergunta-15", "pergunta-15-1", "pergunta-15-2", "pergunta-15-3", "pergunta-15-4", "pergunta-15-5", "pergunta-15-6", "pergunta-15-7", "pergunta-15-8", "pergunta-15-8-1", "pergunta-16", "pergunta-16-1", "pergunta-17", "pergunta-18", "pergunta-19", "pergunta-20", "pergunta-20-1", "pergunta-21", "pergunta-22", "pergunta-23", "pergunta-24", "pergunta-25", "pergunta-25-1", "pergunta-26", "pergunta-26-1", "pergunta-27", "pergunta-28", "pergunta-28-1", "pergunta-28-2", "pergunta-28-3", "pergunta-28-4", "pergunta-28-5", "pergunta-28-6", "pergunta-28-7", "pergunta-28-8", "pergunta-28-9", "pergunta-28-10", "pergunta-28-11", "pergunta-28-12", "pergunta-28-13", "pergunta-28-14", "pergunta-28-15", "pergunta-28-15-1", "pergunta-28-16", "pergunta-28-16-1", "pergunta-29", "pergunta-30", "pergunta-30-1", "pergunta-31", "pergunta-32", "pergunta-33", "pergunta-34", "pergunta-34-1", "pergunta-35", "pergunta-35-1", "pergunta-36"];

	$consulta = mysql("select resposta from formularios where modulo=2 and usuario=" . $_SESSION["id"] . ";");

	$vetor = [];
	for($i = 0; $i < 72; $i++)
		array_push($vetor, "");

	$respostas = $consulta ? explode("|$*|", $consulta["resposta"]) : $vetor;
	$r = [];

	// Deixa os dados esteticamente bonitos
	foreach($campos as $indice => $campo)
		$r[$campo] = $respostas[$indice];

	// Obtém os valores a partir do SELECT da pergunta 15
	$r["pergunta-15"] = explode("||", $r["pergunta-15"]);
}

// Verifica se o usuário já respondeu todo o questionário
$consulta = "select * from respostas where usuario=" . $_SESSION["id"] . ";";
$mysql = mysql($consulta);
if($mysql["fim"]) {
	header("Location: final.php");
	return true;
}

// Captura o horário de início do formulário
$tempo = $mysql["inicio"];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>AirTalent - Avaliação técnica (Conhecimento da função)</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="css/spectre.min.css"/>
	<link rel="stylesheet" href="css/spectre-exp.min.css"/>
	<link rel="stylesheet" href="css/spectre-icons.min.css"/>
</head>

<body>
	<div class="bg-gray">
		<header class="navbar" style="background: #195596; padding: 5px 15px;">
			<section class="navbar-section">
				<img alt="AirTalent" class="img-responsive" src="img/airtalent-b.png" style="width: 140px;"/>
			</section>
			<section class="navbar-center" style="color: #fff; flex-direction: column;">
				<a href="#" class="btn btn-link">
					<span style="color: #fff; font-size: 10px;">TEMPO DECORRIDO</span>
					<h4 id="tempo" style="color: #fff;"></h4>
					<span id="data" style="display: none;"><?=$tempo?></span>
				</a>
			</section>
			<section class="navbar-section">
				<a class="btn btn-link" href="php/sair.php" style="height: auto; color: #fff;">
					<span style="color: #fff; font-size: 10px;">SAIR</span><br/>
					<img alt="Sair" src="img/sair-b.png" style="width: 30px;"/>
				</a>
			</section>
		</header>

		<ul class="tab tab-block">
			<li class="tab-item">
				<a data-anchor="formulario-0.php" href="#"><span style="font-size: 10px;">INÍCIO</span><br/>SCORE</a>
			</li>
			<li class="tab-item">
				<a data-anchor="formulario-1.php" href="#"><span style="font-size: 10px;">DADOS PESSOAIS</span><br/>Cadastro inicial</a>
			</li>
			<li class="tab-item text-gray">
				<a class="active" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Conhecimento da função</a>
			</li>
			<li class="tab-item text-gray">
				<a data-anchor="formulario-3.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Conhecimento técnico específico</a>
			</li>
			<li class="tab-item text-gray">
				<a data-anchor="formulario-4.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Segurança operacional</a>
			</li>
			<li class="tab-item text-gray">
				<a data-anchor="formulario-5.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Experiências anteriores</a>
			</li>
			<li class="tab-item text-gray">
				<a data-anchor="formulario-6.php" href="#"><span style="font-size: 10px;">NÍVEL DE INGLÊS</span><br/>Inglês intermediário</a>
			</li>
		</ul>
	</div>

	<div class="container grid-lg">
		<div class="pt-2 text-center" style="color: #195596;">
			<h1 class="mt-2">Avaliação técnica</h1>
			<h3>Conhecimento da função</h3>
		</div>

		<!--<ul class="step">
			<li class="step-item">
				<a href="formulario-1.php" class="tooltip" data-tooltip="Cadastro inicial">Cadastro inicial</a>
			</li>
			<li class="step-item active">
				<a href="#" class="tooltip" data-tooltip="Avaliação técnica - Conhecimento da função">Avaliação técnica - Conhecimento da função</a>
			</li>
			<li class="step-item">
				<a href="formulario-3.php" class="tooltip" data-tooltip="Avaliação técnica - Conhecimento técnico específico">Avaliação técnica - Conhecimento técnico específico</a>
			</li>
			<li class="step-item">
				<a href="#" class="tooltip" data-tooltip="Avaliação técnica - Segurança operacional e regulação">Avaliação técnica - Segurança operacional e regulação</a>
			</li>
			<li class="step-item">
				<a href="#" class="tooltip" data-tooltip="Avaliação técnica - Experiências anteriores">Avaliação técnica - Experiências anteriores</a>
			</li>
		</ul>-->

		<form action="php/formulario-2.php" class="form-horizontal" method="post">
			<div class="divider"></div>
			<h5 class="text-center">Rotina de funções</h5>
			<div class="divider"></div>
			<!--<div class="divider text-center" data-content="Rotina de funções"></div>-->

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-1">1. Qual sua última experiência/cargo na função pretendida?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-1" name="pergunta-1" placeholder="Qual sua última experiência/cargo na função pretendida?" rows="2" style="resize: none;"><?=$r["pergunta-1"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-2">2. Quanto tempo trabalhou nesta função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-2" name="pergunta-2" placeholder="Quanto tempo trabalhou nesta função?" type="text" value="<?=$r["pergunta-2"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-3">3. Descreva sua rotina diária, semanal ou mensal na função:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-3" name="pergunta-3" placeholder="Descreva sua rotina diária, semanal ou mensal na função" rows="2" style="resize: none;"><?=$r["pergunta-3"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-4">4. Quais tipos de conhecimentos desenvolveu executando a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-4" name="pergunta-4" placeholder="Quais tipos de conhecimentos desenvolveu executando a função?" rows="2" style="resize: none;"><?=$r["pergunta-4"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-5">5. Quais habilidades desenvolveu desempenhando a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-5" name="pergunta-5" placeholder="Quais habilidades desenvolveu desempenhando a função?" rows="2" style="resize: none;"><?=$r["pergunta-5"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-6">6. Qual o tamanho da equipe de trabalho que atuava com você na execução das tarefas?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-6" name="pergunta-6" placeholder="Qual o tamanho da equipe de trabalho que atuava com você na execução das tarefas?" rows="2" style="resize: none;"><?=$r["pergunta-6"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-7">7. Qual o seu nível hierárquico dentro da equipe?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-7" name="pergunta-7" placeholder="Qual o seu nível hierárquico dentro da equipe?" type="text" value="<?=$r["pergunta-7"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-8">8. Descreva seus maiores desafios na rotina da função:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-8" name="pergunta-8" placeholder="Descreva seus maiores desafios na rotina da função" rows="2" style="resize: none;"><?=$r["pergunta-8"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-9">9. O que você acha que poderia ter feito diferente?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-9" name="pergunta-9" placeholder="O que você acha que poderia ter feito diferente?" rows="2" style="resize: none;"><?=$r["pergunta-9"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-10">10. Qual sua maior conquista durante seu tempo nesta função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-10" name="pergunta-10" placeholder="Qual sua maior conquista durante seu tempo nesta função?" rows="2" style="resize: none;"><?=$r["pergunta-10"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-11">11. Já trabalhou com metas?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-11"] == "Não" ? "checked" : ""?> id="pergunta-11" name="pergunta-11" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-11"] == "Sim" ? "checked" : ""?> name="pergunta-11" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, cite as metas e sua performance nas últimas funções:
					</label>
					<input class="form-input" id="pergunta-11-1-disabled" name="pergunta-11-1" placeholder="Cite as metas e sua performance nas últimas funções" type="text" value="<?=$r["pergunta-11-1"]?>"/>
				</div>
			</div>

			<div class="divider"></div>
			<h5 class="text-center">Familiaridade com manuais relativos a função</h5>
			<div class="divider"></div>
			<!--<div class="divider text-center" data-content="Familiaridade com manuais relativos a função"></div>-->

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-12">12. Quantos manuais eram empregados nas tarefas que você executava? Quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-12" name="pergunta-12" placeholder="Quantos manuais eram empregados nas tarefas que você executava? Quais?" rows="2" style="resize: none;"><?=$r["pergunta-12"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-13">13. Você ajudou no desenvolvimento de algum desses manuais? Quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-13" name="pergunta-13" placeholder="Você ajudou no desenvolvimento de algum desses manuais? Quais?" rows="2" style="resize: none;"><?=$r["pergunta-13"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-14">14. Você já trabalhou seguindo procedimentos operacionais padronizados pela empresa?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-14"] == "Não" ? "checked" : ""?> id="pergunta-14" name="pergunta-14" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-14"] == "Sim" ? "checked" : ""?> name="pergunta-14" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="pergunta-14-1-disabled" name="pergunta-14-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-14-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-15-1">15. Você teve contato com manuais relativos a:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Operação de aeronaves", $r["pergunta-15"]) ? "checked": ""?> id="pergunta-15-1" name="pergunta-15[]" type="checkbox" value="Operação de aeronaves"/>
							<i class="form-icon"></i>
							Operação de aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Manutenção de aeronaves", $r["pergunta-15"]) ? "checked": ""?> id="pergunta-15-2" name="pergunta-15[]" type="checkbox" value="Manutenção de aeronaves"/>
							<i class="form-icon"></i>
							Manutenção de aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Operação de solo", $r["pergunta-15"]) ? "checked": ""?> id="pergunta-15-3" name="pergunta-15[]" type="checkbox" value="Operação de solo"/>
							<i class="form-icon"></i>
							Operação de solo
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Operação de cargas", $r["pergunta-15"]) ? "checked": ""?> id="pergunta-15-4" name="pergunta-15[]" type="checkbox" value="Operação de cargas"/>
							<i class="form-icon"></i>
							Operação de cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("SGSO ou Safety", $r["pergunta-15"]) ? "checked": ""?> id="pergunta-15-5" name="pergunta-15[]" type="checkbox" value="SGSO ou Safety"/>
							<i class="form-icon"></i>
							SGSO ou Safety
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Atendimento a Pax", $r["pergunta-15"]) ? "checked": ""?> id="pergunta-15-6" name="pergunta-15[]" type="checkbox" value="Atendimento a Pax"/>
							<i class="form-icon"></i>
							Atendimento a Pax
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("AVSEC", $r["pergunta-15"]) ? "checked": ""?> id="pergunta-15-7" name="pergunta-15[]" type="checkbox" value="AVSEC"/>
							<i class="form-icon"></i>
							AVSEC
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros procedimentos", $r["pergunta-15"]) ? "checked": ""?> id="pergunta-15-8" name="pergunta-15[]" type="checkbox" value="Outros procedimentos"/>
							<i class="form-icon"></i>
							Outros procedimentos
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-15-8-1" name="pergunta-15-8-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-15-8-1"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-16">16. Algum desses manuais eram em inglês?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-16"] == "Não" ? "checked" : ""?> id="pergunta-16" name="pergunta-16" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-16"] == "Sim" ? "checked" : ""?> name="pergunta-16" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="pergunta-16-1-disabled" name="pergunta-16-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-16-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-17">17. Descreva como esses manuais influenciavam sua rotina diária:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-17" name="pergunta-17" placeholder="Descreva como esses manuais influenciavam sua rotina diária" rows="2" style="resize: none;"><?=$r["pergunta-17"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-18">18. Qual o manual mais utilizado?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-18" name="pergunta-18" placeholder="Qual o manual mais utilizado?" type="text" value="<?=$r["pergunta-18"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-19">19. Você teve ou possui alguma dificuldade em relação aos manuais que trabalhou? Descreva:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-19" name="pergunta-19" placeholder="Você teve ou possui alguma dificuldade em relação aos manuais que trabalhou? Descreva" rows="2" style="resize: none;"><?=$r["pergunta-19"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-20">20. Você propôs alguma melhoria nos procedimentos descritos enquanto trabalhava na função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-20"] == "Não" ? "checked" : ""?> id="pergunta-20" name="pergunta-20" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-20"] == "Sim" ? "checked" : ""?> name="pergunta-20" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="pergunta-20-1-disabled" name="pergunta-20-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-20-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-21">21. Com qual manual você tinha mais facilidade de manuseio e entendimento? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-21" name="pergunta-21" placeholder="Com qual manual você tinha mais facilidade de manuseio e entendimento? Por quê?" rows="2" style="resize: none;"><?=$r["pergunta-21"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-22">22. Com qual manual você tinha mais dificuldade de manuseio e entendimento? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-22" name="pergunta-22" placeholder="Com qual manual você tinha mais dificuldade de manuseio e entendimento? Por quê?" rows="2" style="resize: none;"><?=$r["pergunta-22"]?></textarea>
				</div>
			</div>

			<div class="divider"></div>
			<h5 class="text-center">Familiaridade com manuais relativos aos setores envolvidos</h5>
			<div class="divider"></div>
			<!--<div class="divider text-center" data-content="Familiaridade com manuais relativos aos setores envolvidos"></div>-->

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-23">23. Com quais manuais você teve contato que não eram diretamente ligados à sua função, mas influenciavam sua rotina devido as tarefas executadas por pessoas que estavam envolvidas nos seus processos diários?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-23" name="pergunta-23" placeholder="Com quais manuais você teve contato que não eram diretamente ligados à sua função, mas influenciavam sua rotina devido as tarefas executadas por pessoas que estavam envolvidas nos seus processos diários?" rows="6" style="resize: none;"><?=$r["pergunta-23"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-24">24. Descreva como esses manuais e processos influenciavam sua rotina diária:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-24" name="pergunta-24" placeholder="Descreva como esses manuais e processos influenciavam sua rotina diária" rows="2" style="resize: none;"><?=$r["pergunta-24"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-25">25. Algum desses manuais eram em inglês?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-25"] == "Não" ? "checked" : ""?> id="pergunta-25" name="pergunta-25" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-25"] == "Sim" ? "checked" : ""?> name="pergunta-25" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="pergunta-25-1-disabled" name="pergunta-25-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-25-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-26">26. Você teve alguma dificuldade com procedimentos “não compatíveis” entre os setores?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-26"] == "Não" ? "checked" : ""?> id="pergunta-26" name="pergunta-26" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-26"] == "Sim" ? "checked" : ""?> name="pergunta-26" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="pergunta-26-1-disabled" name="pergunta-26-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-26-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-27">27. Por que julga que os procedimentos não eram compatíveis?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-27" name="pergunta-27" placeholder="Por que julga que os procedimentos não eram compatíveis?" rows="2" style="resize: none;"><?=$r["pergunta-27"]?></textarea>
				</div>
			</div>

			<div class="divider"></div>
			<h5 class="text-center">Familiaridade com legislação vigente, normas, requisitos e procedimentos gerais aplicáveis (ANAC, FAA, RF, Jurídico)</h5>
			<div class="divider"></div>
			<!--<div class="divider text-center" data-content="Familiaridade com legislação vigente, normas, requisitos e procedimentos gerais aplicáveis (ANAC, FAA, RF, Jurídico"></div>-->

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" id="pergunta-28" for="pergunta-28-1">28. Com quais autoridades regulatórias, normas ou procedimentos você teve mais contato na função?</label>
				</div>
				<div class="col-8 col-sm-12 pb-2 pl-1">
					<label class="form-label" for="pergunta-28-1">ICAO</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-1"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-1" name="pergunta-28-1" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-1"] == "Fraco" ? "checked" : ""?> name="pergunta-28-1" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-1"] == "Regular" ? "checked" : ""?> name="pergunta-28-1" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-1"] == "Bom" ? "checked" : ""?> name="pergunta-28-1" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-1"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-1" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-2">ANAC</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-2"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-2" name="pergunta-28-2" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-2"] == "Fraco" ? "checked" : ""?> name="pergunta-28-2" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-2"] == "Regular" ? "checked" : ""?> name="pergunta-28-2" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-2"] == "Bom" ? "checked" : ""?> name="pergunta-28-2" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-2"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-2" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-3">FAA</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-3"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-3" name="pergunta-28-3" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-3"] == "Fraco" ? "checked" : ""?> name="pergunta-28-3" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-3"] == "Regular" ? "checked" : ""?> name="pergunta-28-3" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-3"] == "Bom" ? "checked" : ""?> name="pergunta-28-3" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-3"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-3" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-4">EASA</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-4"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-4" name="pergunta-28-4" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-4"] == "Fraco" ? "checked" : ""?> name="pergunta-28-4" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-4"] == "Regular" ? "checked" : ""?> name="pergunta-28-4" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-4"] == "Bom" ? "checked" : ""?> name="pergunta-28-4" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-4"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-4" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-5">IATA</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-5"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-5" name="pergunta-28-5" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-5"] == "Fraco" ? "checked" : ""?> name="pergunta-28-5" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-5"] == "Regular" ? "checked" : ""?> name="pergunta-28-5" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-5"] == "Bom" ? "checked" : ""?> name="pergunta-28-5" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-5"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-5" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-6">IOSA</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-6"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-6" name="pergunta-28-6" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-6"] == "Fraco" ? "checked" : ""?> name="pergunta-28-6" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-6"] == "Regular" ? "checked" : ""?> name="pergunta-28-6" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-6"] == "Bom" ? "checked" : ""?> name="pergunta-28-6" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-6"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-6" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-7">Infraero</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-7"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-7" name="pergunta-28-7" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-7"] == "Fraco" ? "checked" : ""?> name="pergunta-28-7" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-7"] == "Regular" ? "checked" : ""?> name="pergunta-28-7" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-7"] == "Bom" ? "checked" : ""?> name="pergunta-28-7" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-7"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-7" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-8">Receita Federal</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-8"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-8" name="pergunta-28-8" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-8"] == "Fraco" ? "checked" : ""?> name="pergunta-28-8" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-8"] == "Regular" ? "checked" : ""?> name="pergunta-28-8" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-8"] == "Bom" ? "checked" : ""?> name="pergunta-28-8" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-8"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-8" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-9">Jurídico</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-9"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-9" name="pergunta-28-9" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-9"] == "Fraco" ? "checked" : ""?> name="pergunta-28-9" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-9"] == "Regular" ? "checked" : ""?> name="pergunta-28-9" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-9"] == "Bom" ? "checked" : ""?> name="pergunta-28-9" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-9"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-9" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-10">Seis Sigma</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-10"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-10" name="pergunta-28-10" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-10"] == "Fraco" ? "checked" : ""?> name="pergunta-28-10" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-10"] == "Regular" ? "checked" : ""?> name="pergunta-28-10" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-10"] == "Bom" ? "checked" : ""?> name="pergunta-28-10" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-10"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-10" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-11">ISSO</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-11"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-11" name="pergunta-28-11" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-11"] == "Fraco" ? "checked" : ""?> name="pergunta-28-11" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-11"] == "Regular" ? "checked" : ""?> name="pergunta-28-11" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-11"] == "Bom" ? "checked" : ""?> name="pergunta-28-11" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-11"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-11" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-12">Anvisa</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-12"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-12" name="pergunta-28-12" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-12"] == "Fraco" ? "checked" : ""?> name="pergunta-28-12" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-12"] == "Regular" ? "checked" : ""?> name="pergunta-28-12" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-12"] == "Bom" ? "checked" : ""?> name="pergunta-28-12" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-12"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-12" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-13">Polícia Federal</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-13"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-13" name="pergunta-28-13" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-13"] == "Fraco" ? "checked" : ""?> name="pergunta-28-13" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-13"] == "Regular" ? "checked" : ""?> name="pergunta-28-13" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-13"] == "Bom" ? "checked" : ""?> name="pergunta-28-13" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-13"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-13" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-28-14">Forças Armadas (Marinha, Exército e/ou Aeronáutica)</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-14"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-14" name="pergunta-28-14" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-14"] == "Fraco" ? "checked" : ""?> name="pergunta-28-14" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-14"] == "Regular" ? "checked" : ""?> name="pergunta-28-14" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-14"] == "Bom" ? "checked" : ""?> name="pergunta-28-14" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-14"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-14" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2" id="pergunta-28-15-disabled">
					<label class="form-label" for="pergunta-28-15">Forças Armadas Estrangeiras</label>
					<label class="form-inline pr-2">
						<input class="form-input" id="pergunta-28-15" name="pergunta-28-15" placeholder="Quais?" type="text" value="<?=$r["pergunta-28-15"]?>"/>
					</label><br/>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-15-1"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-15-1" name="pergunta-28-15-1" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-15-1"] == "Fraco" ? "checked" : ""?> name="pergunta-28-15-1" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-15-1"] == "Regular" ? "checked" : ""?> name="pergunta-28-15-1" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-15-1"] == "Bom" ? "checked" : ""?> name="pergunta-28-15-1" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-15-1"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-15-1" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2" id="pergunta-28-16-disabled">
					<label class="form-label" for="pergunta-28-16">Outros</label>
					<label class="form-inline pr-2">
						<input class="form-input" id="pergunta-28-16" name="pergunta-28-16" placeholder="Quais?" type="text" value="<?=$r["pergunta-28-16"]?>"/>
					</label><br/>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-16-1"] == "Nenhum" ? "checked" : ""?> id="pergunta-28-16-1" name="pergunta-28-16-1" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-16-1"] == "Fraco" ? "checked" : ""?> name="pergunta-28-16-1" type="radio" value="Fraco"/>
						<i class="form-icon"></i>
						Fraco
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-16-1"] == "Regular" ? "checked" : ""?> name="pergunta-28-16-1" type="radio" value="Regular"/>
						<i class="form-icon"></i>
						Regular
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-16-1"] == "Bom" ? "checked" : ""?> name="pergunta-28-16-1" type="radio" value="Bom"/>
						<i class="form-icon"></i>
						Bom
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-28-16-1"] == "Ótimo" ? "checked" : ""?> name="pergunta-28-16-1" type="radio" value="Ótimo"/>
						<i class="form-icon"></i>
						Ótimo
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-29">29. Qual a regulação (lei, norma, procedimento, etc) aplicável à sua função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-29" name="pergunta-29" placeholder="Qual a regulação (lei, norma, procedimento, etc) aplicável à sua função?" type="text" value="<?=$r["pergunta-29"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-30">30. Você fez algum curso relativo a essa regulação?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-30"] == "Não" ? "checked" : ""?> id="pergunta-30" name="pergunta-30" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-30"] == "Sim" ? "checked" : ""?> name="pergunta-30" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, qual?
					</label>
					<input class="form-input" id="pergunta-30-1-disabled" name="pergunta-30-1" placeholder="Qual?" type="text" value="<?=$r["pergunta-30-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-31">31. Quais procedimentos executados por você estavam ligados a essas autoridades?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-31" name="pergunta-31" placeholder="Quais procedimentos executados por você estavam ligados a essas autoridades?" rows="2" style="resize: none;"><?=$r["pergunta-31"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-32">32. Como esses procedimentos influenciavam sua rotina diária?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-32" name="pergunta-32" placeholder="Como esses procedimentos influenciavam sua rotina diária?" rows="2" style="resize: none;"><?=$r["pergunta-32"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-33">33. Qual a maior dificuldade que você tinha no relacionamento com a Autoridade?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-33" name="pergunta-33" placeholder="Qual a maior dificuldade que você tinha no relacionamento com a Autoridade?" rows="2" style="resize: none;"><?=$r["pergunta-33"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-34">34. Você tinha contato direto com alguma agência do item <a href="#pergunta-28">28</a>?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-34"] == "Não" ? "checked" : ""?> id="pergunta-34" name="pergunta-34" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-34"] == "Sim" ? "checked" : ""?> name="pergunta-34" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, qual o nível hierárquico do contato?
					</label>
					<input class="form-input" id="pergunta-34-1-disabled" name="pergunta-34-1" placeholder="Qual o nível hierárquico do contato?" type="text" value="<?=$r["pergunta-34-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-35">35. Você esteve envolvido em algum processo de certificação ligado a Autoridade?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-35"] == "Não" ? "checked" : ""?> id="pergunta-35" name="pergunta-35" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-35"] == "Sim" ? "checked" : ""?> name="pergunta-35" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="pergunta-35-1-disabled" name="pergunta-35-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-35-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-36">36. Em algum momento você teve atrito (discussão, processo administrativo ou jurídico) com a Autoridade?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-36" name="pergunta-36" placeholder="Em algum momento você teve atrito (discussão, processo administrativo ou jurídico) com a Autoridade?" rows="2" style="resize: none;"><?=$r["pergunta-36"]?></textarea>
				</div>
			</div>

			<div class="text-right">
				<input class="btn btn-primary input-group-btn" name="anterior" type="submit" value="Anterior"/>
				<input class="btn btn-primary input-group-btn" name="proximo" type="submit" value="Próximo"/>
			</div>

			<input name="pagina" type="hidden" value=""/>
		</form>
	</div>

	<script src="js/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function() {
			// Desabilitar as forças armadas estrangeiras
			if($("input[id='pergunta-28-15']").val().trim().length == 0) {
				$("input[id='pergunta-28-15-1']").prop("checked", false);
				$("input[name='pergunta-28-15-1']").prop("disabled", true);
			}
			else
				$("input[id='pergunta-28-15-1']").prop("disabled", false);

			// Desabilitar outras autoridades regulatórias
			if($("input[id='pergunta-28-16']").val().trim().length == 0) {
				$("input[id='pergunta-28-16-1']").prop("checked", false);
				$("input[name='pergunta-28-16-1']").prop("disabled", true);
			}
			else
				$("input[id='pergunta-28-16-1']").prop("disabled", false);

			// Desabilitar os "se sim, quais?"
			$("input[id*='disabled'][type='text']").each(function() {
				var nome = $(this).attr("name");
				if($("input[name='" + nome.substr(nome, nome.length-2) + "']:checked").val() == "Sim")
					$("input[name='" + nome + "']").prop("disabled", false);
				else
					$("input[name='" + nome + "']").prop("disabled", true).val("");
			})

			// Habilitar o campo de mudança de meta
			$("input[name='pergunta-11']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-11-1']").prop("disabled", false);
				else
					$("input[name='pergunta-11-1']").prop("disabled", true).val("");
			});

			// Habilitar o campo de procedimentos operacionais padronizados
			$("input[name='pergunta-14']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-14-1']").prop("disabled", false);
				else
					$("input[name='pergunta-14-1']").prop("disabled", true).val("");
			});

			// Habilitar o campo de manuais em inglês
			$("input[name='pergunta-16']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-16-1']").prop("disabled", false);
				else
					$("input[name='pergunta-16-1']").prop("disabled", true).val("");
			});

			// Habilitar o campo de mudança de melhorias nos procedimentos
			$("input[name='pergunta-20']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-20-1']").prop("disabled", false);
				else
					$("input[name='pergunta-20-1']").prop("disabled", true).val("");
			});

			// Habilitar o campo de mudança de procedimentos não compatíveis
			$("input[name='pergunta-26']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-26-1']").prop("disabled", false);
				else
					$("input[name='pergunta-26-1']").prop("disabled", true).val("");
			});

			// Habilitar o campo de mudança de curso relativo
			$("input[name='pergunta-30']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-30-1']").prop("disabled", false);
				else
					$("input[name='pergunta-30-1']").prop("disabled", true).val("");
			});

			// Habilitar o campo de mudança de contato direto com alguma agência
			$("input[name='pergunta-34']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-34-1']").prop("disabled", false);
				else
					$("input[name='pergunta-34-1']").prop("disabled", true).val("");
			});

			// Habilitar o campo de mudança de processo ligado a autoridade
			$("input[name='pergunta-35']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-35-1']").prop("disabled", false);
				else
					$("input[name='pergunta-35-1']").prop("disabled", true).val("");
			});

			// Habilitar o campo de mudança de manuais eram em inglês
			$("input[name='pergunta-25']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-25-1']").prop("disabled", false);
				else
					$("input[name='pergunta-25-1']").prop("disabled", true).val("");
			});

			// Desabilitar mudança de outros procedimentos
			if($("input[id='pergunta-15-8']").is(":checked"))
				$("input[name='pergunta-15-8-1']").prop("disabled", false);
			else
				$("input[name='pergunta-15-8-1']").prop("disabled", true);

			// Habilitar forças armadas estrangeiras
			$("input[name='pergunta-28-15']").on("keyup keydown", function() {
				if($(this).val().trim().length > 0)
					$("div[id*='disabled'] input[type='radio'][name='pergunta-28-15-1']").prop("disabled", false);
				else {
					$("div[id*='disabled'] input[type='radio'][name='pergunta-28-15-1']").prop("disabled", true).prop("checked", false);
				}
			});

			// Habilitar outras autoridades regulatórias
			$("input[name='pergunta-28-16']").on("keyup keydown", function() {
				if($(this).val().trim().length > 0)
					$("div[id*='disabled'] input[type='radio'][name='pergunta-28-16-1']").prop("disabled", false);
				else {
					$("div[id*='disabled'] input[type='radio'][name='pergunta-28-16-1']").prop("disabled", true).prop("checked", false);
				}
			});

			// Habilitar o campo de outros procedimentos
			$("input[id='pergunta-15-8']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='pergunta-15-8-1']").prop("disabled", false);
				else
					$("input[name='pergunta-15-8-1']").prop("disabled", true).val("");
			});

			// Salva a página requerida no formulário
			$("input[name='anterior']").click(function() {
				$("input[name='proximo']").val("");
			});
			$("input[name='proximo']").click(function() {
				$("input[name='anterior']").val("");
			});

			// Direcionadores dos links do menu superior
			$("a[data-anchor='formulario-0.php'], a[data-anchor='formulario-1.php'], a[data-anchor='formulario-3.php'], a[data-anchor='formulario-4.php'], a[data-anchor='formulario-5.php'], a[data-anchor='formulario-6.php'], a[data-anchor='php/sair.php']").click(function() {
				$("input[name='pagina']").val($(this).data("anchor"));
				$("form[action='php/formulario-2.php']").submit();
			});

			// Relógio
			var dataInicial = new Date($("span[id='data']").html());
			setInterval(function() {
				var dataAtual = new Date();
				var data = dataAtual.getTime() - dataInicial.getTime();
				var dias = Math.floor(data/(1000 * 3600 * 24)); // 86.400.000 milisegundos
				var horas = Math.abs(dataAtual.getHours() - dataInicial.getHours());
				var minutos = Math.abs(dataAtual.getMinutes() - dataInicial.getMinutes());

				var imprimeDias = dias > 1 ? dias + " dias" : dias + " dia";
				var imprimeHoras = horas > 10 ? horas : "0" + horas;
				var imprimeMinutos = minutos > 10 ? minutos : "0" + minutos;
				$("h4[id='tempo']").html(imprimeDias + " e " + imprimeHoras + ":" + imprimeMinutos + "h");
			}, 1000);
		});
	</script>

</body>

</html>