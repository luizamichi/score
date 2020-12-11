<?php

require_once("php/util.php");

// Páginas acessíveis de encaminhamento
$paginas = [HOST . "formulario-0.php", HOST . "formulario-1.php", HOST . "formulario-2.php", HOST . "formulario-4.php", HOST . "formulario-5.php", HOST . "formulario-6.php"];

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
	$campos = ["pergunta-1", "pergunta-1-1", "pergunta-1-2", "pergunta-1-3", "pergunta-2-1", "pergunta-2-2", "pergunta-2-3", "pergunta-2-4", "pergunta-2-5", "pergunta-2-6", "pergunta-2-7", "pergunta-2-8", "pergunta-2-9", "pergunta-2-10", "pergunta-2-11", "pergunta-3", "pergunta-4", "pergunta-5", "pergunta-6", "pergunta-7", "pergunta-8", "pergunta-9", "pergunta-10", "pergunta-11", "pergunta-12-1-1", "pergunta-12-1-1-1", "pergunta-12-1-2", "pergunta-12-1-2-1", "pergunta-12-1-3", "pergunta-12-1-4", "pergunta-12-1-5", "pergunta-12-1-5-1", "pergunta-12-2", "pergunta-12-2-1", "pergunta-12-3", "pergunta-12-3-1", "pergunta-12-4", "pergunta-12-4-1", "pergunta-12-5", "pergunta-12-5-1", "pergunta-12-6-1", "pergunta-12-6-2", "pergunta-12-6-2-1", "pergunta-12-6-3", "pergunta-12-6-4", "pergunta-12-6-5", "pergunta-12-6-6", "pergunta-12-6-7", "pergunta-12-6-7-1", "pergunta-12-7-1", "pergunta-12-7-1-1", "pergunta-12-7-2", "pergunta-12-7-2-1", "pergunta-12-7-3", "pergunta-12-7-3-1", "pergunta-12-8-1", "pergunta-12-8-1-1", "pergunta-12-8-2", "pergunta-12-8-2-1", "pergunta-12-8-3", "pergunta-12-8-4", "pergunta-12-8-5", "pergunta-12-8-5-1", "pergunta-12-9-1", "pergunta-12-9-1-1", "pergunta-12-9-2", "pergunta-12-9-2-1", "pergunta-12-9-3", "pergunta-12-9-3-1", "pergunta-12-10", "pergunta-12-10-1", "pergunta-12-11", "pergunta-12-11-1", "pergunta-12-12", "pergunta-12-12-1", "pergunta-12-13", "pergunta-12-13-1", "pergunta-13", "pergunta-14", "pergunta-15", "pergunta-16", "pergunta-17", "pergunta-18", "pergunta-19", "pergunta-20", "pergunta-21", "pergunta-22", "pergunta-22-1", "pergunta-23", "pergunta-24", "pergunta-24-1", "pergunta-25", "pergunta-26", "pergunta-27", "pergunta-28", "pergunta-29", "pergunta-30", "pergunta-31"];
	$consulta = mysql("select resposta from formularios where modulo=3 and usuario=" . $_SESSION["id"] . ";");

	$vetor = [];
	for($i = 0; $i < 98; $i++)
		array_push($vetor, "");

	$respostas = $consulta ? explode("|$*|", $consulta["resposta"]) : $vetor;
	$r = [];

	// Deixa os dados esteticamente bonitos
	foreach($campos as $indice => $campo)
		$r[$campo] = $respostas[$indice];

	// Obtém os valores a partir dos SELECTS
	$r["pergunta-1"] = explode("||", $r["pergunta-1"]);
	$r["pergunta-12-1-1"] = explode("||", $r["pergunta-12-1-1"]);
	$r["pergunta-12-1-2"] = explode("||", $r["pergunta-12-1-2"]);
	$r["pergunta-12-1-3"] = explode("||", $r["pergunta-12-1-3"]);
	$r["pergunta-12-1-4"] = explode("||", $r["pergunta-12-1-4"]);
	$r["pergunta-12-1-5"] = explode("||", $r["pergunta-12-1-5"]);
	$r["pergunta-12-10"] = explode("||", $r["pergunta-12-10"]);
	$r["pergunta-12-11"] = explode("||", $r["pergunta-12-11"]);
	$r["pergunta-12-12"] = explode("||", $r["pergunta-12-12"]);
	$r["pergunta-12-13"] = explode("||", $r["pergunta-12-13"]);
	$r["pergunta-12-2"] = explode("||", $r["pergunta-12-2"]);
	$r["pergunta-12-3"] = explode("||", $r["pergunta-12-3"]);
	$r["pergunta-12-4"] = explode("||", $r["pergunta-12-4"]);
	$r["pergunta-12-5"] = explode("||", $r["pergunta-12-5"]);
	$r["pergunta-12-6-1"] = explode("||", $r["pergunta-12-6-1"]);
	$r["pergunta-12-6-2"] = explode("||", $r["pergunta-12-6-2"]);
	$r["pergunta-12-6-3"] = explode("||", $r["pergunta-12-6-3"]);
	$r["pergunta-12-6-4"] = explode("||", $r["pergunta-12-6-4"]);
	$r["pergunta-12-6-5"] = explode("||", $r["pergunta-12-6-5"]);
	$r["pergunta-12-6-6"] = explode("||", $r["pergunta-12-6-6"]);
	$r["pergunta-12-6-7"] = explode("||", $r["pergunta-12-6-7"]);
	$r["pergunta-12-7-1"] = explode("||", $r["pergunta-12-7-1"]);
	$r["pergunta-12-7-2"] = explode("||", $r["pergunta-12-7-2"]);
	$r["pergunta-12-7-3"] = explode("||", $r["pergunta-12-7-3"]);
	$r["pergunta-12-8-1"] = explode("||", $r["pergunta-12-8-1"]);
	$r["pergunta-12-8-2"] = explode("||", $r["pergunta-12-8-2"]);
	$r["pergunta-12-8-3"] = explode("||", $r["pergunta-12-8-3"]);
	$r["pergunta-12-8-4"] = explode("||", $r["pergunta-12-8-4"]);
	$r["pergunta-12-8-5"] = explode("||", $r["pergunta-12-8-5"]);
	$r["pergunta-12-9-1"] = explode("||", $r["pergunta-12-9-1"]);
	$r["pergunta-12-9-2"] = explode("||", $r["pergunta-12-9-2"]);
	$r["pergunta-12-9-3"] = explode("||", $r["pergunta-12-9-3"]);
	$r["pergunta-22"] = explode("||", $r["pergunta-22"]);
	$r["pergunta-24"] = explode("||", $r["pergunta-24"]);
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
	<title>AirTalent - Avaliação técnica (Conhecimento técnico específico)</title>
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
			<li class="tab-item">
				<a data-anchor="formulario-2.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Conhecimento da função</a>
			</li>
			<li class="tab-item">
				<a class="active" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Conhecimento técnico específico</a>
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
			<h3>Conhecimento técnico específico</h3>
		</div>

		<form action="php/formulario-3.php" class="form-horizontal" method="post">
			<div class="divider"></div>
			<h5 class="text-center">Formações e qualificações</h5>
			<div class="divider"></div>
			<!--<div class="divider text-center" data-content="Formações e qualificações"></div>-->

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-1">1. Você possui alguma carteira de habilitação específica da sua área de atuação? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-1"><strong>ANAC Pilotos</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PPA", $r["pergunta-1"]) ? "checked" : ""?> id="pergunta-1" name="pergunta-1[]" type="checkbox" value="PPA"/>
							<i class="form-icon"></i>
							PPA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PPH", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="PPH"/>
							<i class="form-icon"></i>
							PPH
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PCA", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="PCA"/>
							<i class="form-icon"></i>
							PCA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PCH", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="PCH"/>
							<i class="form-icon"></i>
							PCH
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PLA", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="PLA"/>
							<i class="form-icon"></i>
							PLA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PLH", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="PLH"/>
							<i class="form-icon"></i>
							PLH
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Mono", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="Mono"/>
							<i class="form-icon"></i>
							Mono
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Multi", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="Multi"/>
							<i class="form-icon"></i>
							Multi
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("IFR", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="IFR"/>
							<i class="form-icon"></i>
							IFR
						</label>
					</div>

					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("ANAC Comissários", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="ANAC Comissários"/>
							<i class="form-icon"></i>
							<strong>ANAC Comissários</strong>
						</label>
					</div>

					<label class="form-label" for="pergunta-1-mecanico"><strong>ANAC Mecânico</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("GMP", $r["pergunta-1"]) ? "checked" : ""?> id="pergunta-1-mecanico" name="pergunta-1[]" type="checkbox" value="GMP"/>
							<i class="form-icon"></i>
							GMP
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CEL", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="CEL"/>
							<i class="form-icon"></i>
							CEL
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("AVI", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="AVI"/>
							<i class="form-icon"></i>
							AVI
						</label>
					</div>
					<label class="form-label" for="pergunta-1-cenipa"><strong>CENIPA</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-PREV", $r["pergunta-1"]) ? "checked" : ""?> id="pergunta-1-cenipa" name="pergunta-1[]" type="checkbox" value="EC-PREV"/>
							<i class="form-icon"></i>
							EC-PREV
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-FHM", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="EC-FHM"/>
							<i class="form-icon"></i>
							EC-FHM
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-FHP", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="EC-FHP"/>
							<i class="form-icon"></i>
							EC-FHP
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-FM", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="EC-FM"/>
							<i class="form-icon"></i>
							EC-FM
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-MA", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="EC-MA"/>
							<i class="form-icon"></i>
							EC-MA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-CEA", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="EC-CEA"/>
							<i class="form-icon"></i>
							EC-CEA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-AA", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="EC-AA"/>
							<i class="form-icon"></i>
							EC-AA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("ASV", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="ASV"/>
							<i class="form-icon"></i>
							ASV
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("OSV", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="OSV"/>
							<i class="form-icon"></i>
							OSV
						</label>
					</div>

					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("FAA", $r["pergunta-1"]) ? "checked" : ""?> data-check="pergunta-1-1" name="pergunta-1[]" type="checkbox" value="FAA"/>
							<i class="form-icon"></i>
							<strong>FAA</strong>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-1-1" name="pergunta-1-1" placeholder="Qual?" type="text" value="<?=$r["pergunta-1-1"]?>"/>
						</label>
					</div>

					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EASA", $r["pergunta-1"]) ? "checked" : ""?> data-check="pergunta-1-2" name="pergunta-1[]" type="checkbox" value="EASA"/>
							<i class="form-icon"></i>
							<strong>EASA</strong>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-1-2" name="pergunta-1-2" placeholder="Qual?" type="text" value="<?=$r["pergunta-1-2"]?>"/>
						</label>
					</div>

					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CREA", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="CREA"/>
							<i class="form-icon"></i>
							<strong>CREA</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("OAB", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="OAB"/>
							<i class="form-icon"></i>
							<strong>OAB</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CRM", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="CRM"/>
							<i class="form-icon"></i>
							<strong>CRM</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CRP", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="CRP"/>
							<i class="form-icon"></i>
							<strong>CRP</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("SGSO", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="SGSO"/>
							<i class="form-icon"></i>
							<strong>SGSO</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("AVSEC", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="AVSEC"/>
							<i class="form-icon"></i>
							<strong>AVSEC</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("DGR", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="DGR"/>
							<i class="form-icon"></i>
							<strong>DGR</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("IATA", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="IATA"/>
							<i class="form-icon"></i>
							<strong>IATA</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Receita Federal Brasileira - RFB", $r["pergunta-1"]) ? "checked" : ""?> name="pergunta-1[]" type="checkbox" value="Receita Federal Brasileira - RFB"/>
							<i class="form-icon"></i>
							<strong>Receita Federal Brasileira - RFB</strong>
						</label>
					</div>

					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-1"]) ? "checked" : ""?> data-check="pergunta-1-3" name="pergunta-1[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<strong>Outros</strong>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-1-3" name="pergunta-1-3" placeholder="Quais?" type="text" value="<?=$r["pergunta-1-3"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-2-1">2. Nível de conhecimento dos regulamentos abaixo:</label>
				</div>
				<div class="col-8 col-sm-12 pb-2 pl-1">
					<label class="form-label" for="pergunta-2-1"><strong>RBAC 91</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-1"] == "Nenhum" ? "checked" : ""?> id="pergunta-2-1" name="pergunta-2-1" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-1"] == "Superficial" ? "checked" : ""?> name="pergunta-2-1" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-1"] == "Médio" ? "checked" : ""?> name="pergunta-2-1" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-1"] == "Alto" ? "checked" : ""?> name="pergunta-2-1" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-2-2"><strong>RBAC 121</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-2"] == "Nenhum" ? "checked" : ""?> id="pergunta-2-2" name="pergunta-2-2" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-2"] == "Superficial" ? "checked" : ""?> name="pergunta-2-2" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-2"] == "Médio" ? "checked" : ""?> name="pergunta-2-2" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-2"] == "Alto" ? "checked" : ""?> name="pergunta-2-2" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-2-3"><strong>RBAC 135</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-3"] == "Nenhum" ? "checked" : ""?> id="pergunta-2-3" name="pergunta-2-3" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-3"] == "Superficial" ? "checked" : ""?> name="pergunta-2-3" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-3"] == "Médio" ? "checked" : ""?> name="pergunta-2-3" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-3"] == "Alto" ? "checked" : ""?> name="pergunta-2-3" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-2-4"><strong>RBAC 145</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-4"] == "Nenhum" ? "checked" : ""?> id="pergunta-2-4" name="pergunta-2-4" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-4"] == "Superficial" ? "checked" : ""?> name="pergunta-2-4" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-4"] == "Médio" ? "checked" : ""?> name="pergunta-2-4" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-4"] == "Alto" ? "checked" : ""?> name="pergunta-2-4" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-2-5"><strong>RBAC 153</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-5"] == "Nenhum" ? "checked" : ""?> id="pergunta-2-5" name="pergunta-2-5" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-5"] == "Superficial" ? "checked" : ""?> name="pergunta-2-5" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-5"] == "Médio" ? "checked" : ""?> name="pergunta-2-5" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-5"] == "Alto" ? "checked" : ""?> name="pergunta-2-5" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-2-6"><strong>RBAC 107</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-6"] == "Nenhum" ? "checked" : ""?> id="pergunta-2-6" name="pergunta-2-6" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-6"] == "Superficial" ? "checked" : ""?> name="pergunta-2-6" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-6"] == "Médio" ? "checked" : ""?> name="pergunta-2-6" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-6"] == "Alto" ? "checked" : ""?> name="pergunta-2-6" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-2-7"><strong>RBAC 108</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-7"] == "Nenhum" ? "checked" : ""?> id="pergunta-2-7" name="pergunta-2-7" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-7"] == "Superficial" ? "checked" : ""?> name="pergunta-2-7" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-7"] == "Médio" ? "checked" : ""?> name="pergunta-2-7" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-7"] == "Alto" ? "checked" : ""?> name="pergunta-2-7" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-2-8"><strong>RBAC 110</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-8"] == "Nenhum" ? "checked" : ""?> id="pergunta-2-8" name="pergunta-2-8" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-8"] == "Superficial" ? "checked" : ""?> name="pergunta-2-8" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-8"] == "Médio" ? "checked" : ""?> name="pergunta-2-8" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-8"] == "Alto" ? "checked" : ""?> name="pergunta-2-8" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-2-9"><strong>RBAC 175</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-9"] == "Nenhum" ? "checked" : ""?> id="pergunta-2-9" name="pergunta-2-9" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-9"] == "Superficial" ? "checked" : ""?> name="pergunta-2-9" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-9"] == "Médio" ? "checked" : ""?> name="pergunta-2-9" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-9"] == "Alto" ? "checked" : ""?> name="pergunta-2-9" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-2-10"><strong>RESOLUÇÃO ANAC 130</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-10"] == "Nenhum" ? "checked" : ""?> id="pergunta-2-10" name="pergunta-2-10" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-10"] == "Superficial" ? "checked" : ""?> name="pergunta-2-10" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-10"] == "Médio" ? "checked" : ""?> name="pergunta-2-10" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-10"] == "Alto" ? "checked" : ""?> name="pergunta-2-10" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-2-11"><strong>RESOLUÇÃO ANAC 280</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-11"] == "Nenhum" ? "checked" : ""?> id="pergunta-2-11" name="pergunta-2-11" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-11"] == "Superficial" ? "checked" : ""?> name="pergunta-2-11" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-11"] == "Médio" ? "checked" : ""?> name="pergunta-2-11" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2-11"] == "Alto" ? "checked" : ""?> name="pergunta-2-11" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-3">3. Sua habilitação tem validade? Se sim, até quando?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-3" name="pergunta-3" type="date" value="<?=$r["pergunta-3"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-4">4. Você tem alguma formação (curso superior, cursos, treinamentos) específica na área? Se sim, quais? Onde? Data de conclusão?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-4" name="pergunta-4" placeholder="Você tem alguma formação (curso superior, cursos, treinamentos) específica na área? Se sim, quais? Onde? Data de conclusão?" rows="2" style="resize: none;"><?=$r["pergunta-4"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-5">5. Todas possuem certificados?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-5" name="pergunta-5" placeholder="Todas possuem certificados?" type="text" value="<?=$r["pergunta-5"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-6">6. Alguma dessas foram feitas no exterior?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-6" name="pergunta-6" placeholder="Alguma dessas foram feitas no exterior?" type="text" value="<?=$r["pergunta-6"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-7">7. Qual a formação citada acima que mais ajudou a desenvolver sua carreira? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-7" name="pergunta-7" placeholder="Qual a formação citada acima que mais ajudou a desenvolver sua carreira? Por quê?" rows="2" style="resize: none;"><?=$r["pergunta-7"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-8">8. Qual curso você mais se identificou? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-8" name="pergunta-8" placeholder="Qual curso você mais se identificou? Por quê?" rows="2" style="resize: none;"><?=$r["pergunta-8"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-9">9. Qual o maior desafio que você enfrentou durante sua formação?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-9" name="pergunta-9" placeholder="Qual o maior desafio que você enfrentou durante sua formação?" rows="2" style="resize: none;"><?=$r["pergunta-9"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-10">10. Qual curso ou treinamento você ainda pretende fazer? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-10" name="pergunta-10" placeholder="Qual curso ou treinamento você ainda pretende fazer? Por quê?" rows="2" style="resize: none;"><?=$r["pergunta-10"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-11">11. Você teve algum mentor durante sua formação? Se sim, em qual área? Quem foi?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-11" name="pergunta-11" placeholder="Você teve algum mentor durante sua formação? Se sim, em qual área? Quem foi?" rows="2" style="resize: none;"><?=$r["pergunta-11"]?></textarea>
				</div>
			</div>

			<div class="divider"></div>
			<h5 class="text-center">Treinamentos específicos e conhecimento de aeronaves, partes, componentes, ferramentas, linguagem, etc.</h5>
			<div class="divider"></div>
			<!--<div class="divider text-center" data-content="Treinamentos específicos e conhecimento de aeronaves, partes, componentes, ferramentas, linguagem, etc."></div>-->

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-12-1-1">12. Você possui algum treinamento específico nas seguintes áreas?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-12-1-1"><strong>Aeronaves</strong></label>
					<label class="form-label pl-2" for="pergunta-12-1-1"><em>Projetos</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Estruturas", $r["pergunta-12-1-1"]) ? "checked" : ""?> id="pergunta-12-1-1" name="pergunta-12-1-1[]" type="checkbox" value="Estruturas"/>
							<i class="form-icon"></i>
							Estruturas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Aviônica", $r["pergunta-12-1-1"]) ? "checked" : ""?> name="pergunta-12-1-1[]" type="checkbox" value="Aviônica"/>
							<i class="form-icon"></i>
							Aviônica
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Sistemas", $r["pergunta-12-1-1"]) ? "checked" : ""?> name="pergunta-12-1-1[]" type="checkbox" value="Sistemas"/>
							<i class="form-icon"></i>
							Sistemas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Motores", $r["pergunta-12-1-1"]) ? "checked" : ""?> name="pergunta-12-1-1[]" type="checkbox" value="Motores"/>
							<i class="form-icon"></i>
							Motores
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Engenharia", $r["pergunta-12-1-1"]) ? "checked" : ""?> name="pergunta-12-1-1[]" type="checkbox" value="Engenharia"/>
							<i class="form-icon"></i>
							Engenharia
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Planejamento", $r["pergunta-12-1-1"]) ? "checked" : ""?> name="pergunta-12-1-1[]" type="checkbox" value="Planejamento"/>
							<i class="form-icon"></i>
							Planejamento
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Qualidade", $r["pergunta-12-1-1"]) ? "checked" : ""?> name="pergunta-12-1-1[]" type="checkbox" value="Qualidade"/>
							<i class="form-icon"></i>
							Qualidade
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Segurança Operacional", $r["pergunta-12-1-1"]) ? "checked" : ""?> name="pergunta-12-1-1[]" type="checkbox" value="Segurança Operacional"/>
							<i class="form-icon"></i>
							Segurança Operacional
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Gestão", $r["pergunta-12-1-1"]) ? "checked" : ""?> name="pergunta-12-1-1[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							Gestão
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-1-1"]) ? "checked" : ""?> data-check="pergunta-12-1-1-1" name="pergunta-12-1-1[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-1-1-1" name="pergunta-12-1-1-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-1-1-1"]?>"/>
						</label>
					</div>

					<label class="form-label pl-2" for="pergunta-12-1-2"><em>Manutenção</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Estruturas", $r["pergunta-12-1-2"]) ? "checked" : ""?> id="pergunta-12-1-2" name="pergunta-12-1-2[]" type="checkbox" value="Estruturas"/>
							<i class="form-icon"></i>
							Estruturas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Aviônica", $r["pergunta-12-1-2"]) ? "checked" : ""?> name="pergunta-12-1-2[]" type="checkbox" value="Aviônica"/>
							<i class="form-icon"></i>
							Aviônica
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Sistemas", $r["pergunta-12-1-2"]) ? "checked" : ""?> name="pergunta-12-1-2[]" type="checkbox" value="Sistemas"/>
							<i class="form-icon"></i>
							Sistemas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Motores", $r["pergunta-12-1-2"]) ? "checked" : ""?> name="pergunta-12-1-2[]" type="checkbox" value="Motores"/>
							<i class="form-icon"></i>
							Motores
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("MCC", $r["pergunta-12-1-2"]) ? "checked" : ""?> name="pergunta-12-1-2[]" type="checkbox" value="MCC"/>
							<i class="form-icon"></i>
							MCC
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("AOG", $r["pergunta-12-1-2"]) ? "checked" : ""?> name="pergunta-12-1-2[]" type="checkbox" value="AOG"/>
							<i class="form-icon"></i>
							AOG
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("CTM", $r["pergunta-12-1-2"]) ? "checked" : ""?> name="pergunta-12-1-2[]" type="checkbox" value="CTM"/>
							<i class="form-icon"></i>
							CTM
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Engenharia", $r["pergunta-12-1-2"]) ? "checked" : ""?> name="pergunta-12-1-2[]" type="checkbox" value="Engenharia"/>
							<i class="form-icon"></i>
							Engenharia
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Planejamento", $r["pergunta-12-1-2"]) ? "checked" : ""?> name="pergunta-12-1-2[]" type="checkbox" value="Planejamento"/>
							<i class="form-icon"></i>
							Planejamento
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Qualidade", $r["pergunta-12-1-2"]) ? "checked" : ""?> name="pergunta-12-1-2[]" type="checkbox" value="Qualidade"/>
							<i class="form-icon"></i>
							Qualidade
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Segurança Operacional", $r["pergunta-12-1-2"]) ? "checked" : ""?> name="pergunta-12-1-2[]" type="checkbox" value="Segurança Operacional"/>
							<i class="form-icon"></i>
							Segurança Operacional
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Gestão", $r["pergunta-12-1-2"]) ? "checked" : ""?> name="pergunta-12-1-2[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							Gestão
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-1-2"]) ? "checked" : ""?> data-check="pergunta-12-1-2-1" name="pergunta-12-1-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-1-2-1" name="pergunta-12-1-2-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-1-2-1"]?>"/>
						</label>
					</div>

					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Piloto", $r["pergunta-12-1-3"]) ? "checked" : ""?> name="pergunta-12-1-3[]" type="checkbox" value="Piloto"/>
							<i class="form-icon"></i>
							<em>Piloto</em>
						</label>
					</div>

					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Comissário", $r["pergunta-12-1-4"]) ? "checked" : ""?> name="pergunta-12-1-4[]" type="checkbox" value="Comissário"/>
							<i class="form-icon"></i>
							<em>Comissário</em>
						</label>
					</div>

					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-12-1-5"]) ? "checked" : ""?> data-check="pergunta-12-1-5-1" name="pergunta-12-1-5[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-1-5-1" name="pergunta-12-1-5-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-1-5-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-12-2"><strong>Operações de Solo</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Pax", $r["pergunta-12-2"]) ? "checked": ""?> id="pergunta-12-2" name="pergunta-12-2[]" type="checkbox" value="Pax"/>
							<i class="form-icon"></i>
							<em>Pax</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Cargas", $r["pergunta-12-2"]) ? "checked": ""?> name="pergunta-12-2[]" type="checkbox" value="Cargas"/>
							<i class="form-icon"></i>
							<em>Cargas</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Movimentação de Aeronaves", $r["pergunta-12-2"]) ? "checked": ""?> name="pergunta-12-2[]" type="checkbox" value="Movimentação de Aeronaves"/>
							<i class="form-icon"></i>
							<em>Movimentação de Aer</em>onaves
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Aeroportos", $r["pergunta-12-2"]) ? "checked": ""?> name="pergunta-12-2[]" type="checkbox" value="Aeroportos"/>
							<i class="form-icon"></i>
							<em>Aeroportos</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Segurança Operacional", $r["pergunta-12-2"]) ? "checked": ""?> name="pergunta-12-2[]" type="checkbox" value="Segurança Operacional"/>
							<i class="form-icon"></i>
							<em>Segurança Operacion</em>al
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Coordenação", $r["pergunta-12-2"]) ? "checked": ""?> name="pergunta-12-2[]" type="checkbox" value="Coordenação"/>
							<i class="form-icon"></i>
							<em>Coordenação</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Gestão", $r["pergunta-12-2"]) ? "checked": ""?> name="pergunta-12-2[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							<em>Gestão</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-12-2"]) ? "checked": ""?> data-check="pergunta-12-2-1" name="pergunta-12-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-2-1" name="pergunta-12-2-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-2-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-12-3"><strong>Operações de Voo</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Peso & Balanceamento", $r["pergunta-12-3"]) ? "checked" : ""?> id="pergunta-12-3" name="pergunta-12-3[]" type="checkbox" value="Peso & Balanceamento"/>
							<i class="form-icon"></i>
							<em>Peso & Balanceamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Climatologia", $r["pergunta-12-3"]) ? "checked" : ""?> name="pergunta-12-3[]" type="checkbox" value="Climatologia"/>
							<i class="form-icon"></i>
							<em>Climatologia</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Planejamento", $r["pergunta-12-3"]) ? "checked" : ""?> name="pergunta-12-3[]" type="checkbox" value="Planejamento"/>
							<i class="form-icon"></i>
							<em>Planejamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Rotas", $r["pergunta-12-3"]) ? "checked" : ""?> name="pergunta-12-3[]" type="checkbox" value="Rotas"/>
							<i class="form-icon"></i>
							<em>Rotas</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Coordenação", $r["pergunta-12-3"]) ? "checked" : ""?> name="pergunta-12-3[]" type="checkbox" value="Coordenação"/>
							<i class="form-icon"></i>
							<em>Coordenação</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Gestão", $r["pergunta-12-3"]) ? "checked" : ""?> name="pergunta-12-3[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							<em>Gestão</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-12-3"]) ? "checked" : ""?> data-check="pergunta-12-3-1" name="pergunta-12-3[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-3-1" name="pergunta-12-3-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-3-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-12-4"><strong>Suprimentos</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Compras", $r["pergunta-12-4"]) ? "checked" : ""?> id="pergunta-12-4" name="pergunta-12-4[]" type="checkbox" value="Compras"/>
							<i class="form-icon"></i>
							<em>Compras</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Reparos", $r["pergunta-12-4"]) ? "checked" : ""?> name="pergunta-12-4[]" type="checkbox" value="Reparos"/>
							<i class="form-icon"></i>
							<em>Reparos</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("AOG", $r["pergunta-12-4"]) ? "checked" : ""?> name="pergunta-12-4[]" type="checkbox" value="AOG"/>
							<i class="form-icon"></i>
							<em>AOG</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Almoxarifado", $r["pergunta-12-4"]) ? "checked" : ""?> name="pergunta-12-4[]" type="checkbox" value="Almoxarifado"/>
							<i class="form-icon"></i>
							<em>Almoxarifado</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Logística", $r["pergunta-12-4"]) ? "checked" : ""?> name="pergunta-12-4[]" type="checkbox" value="Logística"/>
							<i class="form-icon"></i>
							<em>Logística</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Comex", $r["pergunta-12-4"]) ? "checked" : ""?> name="pergunta-12-4[]" type="checkbox" value="Comex"/>
							<i class="form-icon"></i>
							<em>Comex</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Gestão", $r["pergunta-12-4"]) ? "checked" : ""?> name="pergunta-12-4[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							<em>Gestão</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-12-4"]) ? "checked" : ""?> data-check="pergunta-12-4-1" name="pergunta-12-4[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-4-1" name="pergunta-12-4-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-4-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-12-5"><strong>Contabilidade</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Escrita Fiscal", $r["pergunta-12-5"]) ? "checked" : ""?> id="pergunta-12-5" name="pergunta-12-5[]" type="checkbox" value="Escrita Fiscal"/>
							<i class="form-icon"></i>
							<em>Escrita Fiscal</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Impostos", $r["pergunta-12-5"]) ? "checked" : ""?> name="pergunta-12-5[]" type="checkbox" value="Impostos"/>
							<i class="form-icon"></i>
							<em>Impostos</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Folha de Pagamento", $r["pergunta-12-5"]) ? "checked" : ""?> name="pergunta-12-5[]" type="checkbox" value="Folha de Pagamento"/>
							<i class="form-icon"></i>
							<em>Folha de Pagamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Comex", $r["pergunta-12-5"]) ? "checked" : ""?> name="pergunta-12-5[]" type="checkbox" value="Comex"/>
							<i class="form-icon"></i>
							<em>Comex</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Faturamento", $r["pergunta-12-5"]) ? "checked" : ""?> name="pergunta-12-5[]" type="checkbox" value="Faturamento"/>
							<i class="form-icon"></i>
							<em>Faturamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-12-5"]) ? "checked" : ""?> data-check="pergunta-12-5-1" name="pergunta-12-5[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-5-1" name="pergunta-12-5-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-5-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-12-6-1"><strong>Comercial</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Vendas", $r["pergunta-12-6-2"]) ? "checked" : ""?> id="pergunta-12-6-1" name="pergunta-12-6-1[]" type="checkbox" value="Vendas"/>
							<i class="form-icon"></i>
							<em>Vendas</em>
						</label>
					</div>

					<label class="form-label pl-2" for="pergunta-12-6-2"><em>Marketing</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Design", $r["pergunta-12-6-2"]) ? "checked" : ""?> id="pergunta-12-6-2" name="pergunta-12-6-2[]" type="checkbox" value="Design"/>
							<i class="form-icon"></i>
							Design
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Mídia Paga", $r["pergunta-12-6-2"]) ? "checked" : ""?> name="pergunta-12-6-2[]" type="checkbox" value="Mídia Paga"/>
							<i class="form-icon"></i>
							Mídia Paga
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Copy writing", $r["pergunta-12-6-2"]) ? "checked" : ""?> name="pergunta-12-6-2[]" type="checkbox" value="Copy writing"/>
							<i class="form-icon"></i>
							Copy writing
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Mídias sociais", $r["pergunta-12-6-2"]) ? "checked" : ""?> name="pergunta-12-6-2[]" type="checkbox" value="Mídias sociais"/>
							<i class="form-icon"></i>
							Mídias sociais
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Conteúdo", $r["pergunta-12-6-2"]) ? "checked" : ""?> name="pergunta-12-6-2[]" type="checkbox" value="Conteúdo"/>
							<i class="form-icon"></i>
							Conteúdo
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Edição Vídeo", $r["pergunta-12-6-2"]) ? "checked" : ""?> name="pergunta-12-6-2[]" type="checkbox" value="Edição Vídeo"/>
							<i class="form-icon"></i>
							Edição Vídeo
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Produção Vídeo", $r["pergunta-12-6-2"]) ? "checked" : ""?> name="pergunta-12-6-2[]" type="checkbox" value="Produção Vídeo"/>
							<i class="form-icon"></i>
							Produção Vídeo
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Modelagem 3D", $r["pergunta-12-6-2"]) ? "checked" : ""?> name="pergunta-12-6-2[]" type="checkbox" value="Modelagem 3D"/>
							<i class="form-icon"></i>
							Modelagem 3D
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-6-2"]) ? "checked" : ""?> data-check="pergunta-12-6-2-1" name="pergunta-12-6-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-6-2-1" name="pergunta-12-6-2-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-6-2-1"]?>"/>
						</label>
					</div>

					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Prospecção", $r["pergunta-12-6-3"]) ? "checked" : ""?> name="pergunta-12-6-3[]" type="checkbox" value="Prospecção"/>
							<i class="form-icon"></i>
							<em>Prospecção</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Telemarketing", $r["pergunta-12-6-4"]) ? "checked" : ""?> name="pergunta-12-6-4[]" type="checkbox" value="Telemarketing"/>
							<i class="form-icon"></i>
							<em>Telemarketing</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Pós-venda", $r["pergunta-12-6-5"]) ? "checked" : ""?> name="pergunta-12-6-5[]" type="checkbox" value="Pós-venda"/>
							<i class="form-icon"></i>
							<em>Pós-venda</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Atendimento ao Cliente", $r["pergunta-12-6-6"]) ? "checked" : ""?> name="pergunta-12-6-6[]" type="checkbox" value="Atendimento ao Cliente"/>
							<i class="form-icon"></i>
							<em>Atendimento ao Cliente</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-12-6-7"]) ? "checked" : ""?> data-check="pergunta-12-6-7-1" name="pergunta-12-6-7[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-6-7-1" name="pergunta-12-6-7-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-6-7-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-12-7-1"><strong>Jurídico</strong></label>
					<label class="form-label pl-2" for="pergunta-12-7-1"><em>Civil</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Empresarial", $r["pergunta-12-7-1"]) ? "checked" : ""?> id="pergunta-12-7-1" name="pergunta-12-7-1[]" type="checkbox" value="Empresarial"/>
							<i class="form-icon"></i>
							Empresarial
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Contratos", $r["pergunta-12-7-1"]) ? "checked" : ""?> name="pergunta-12-7-1[]" type="checkbox" value="Contratos"/>
							<i class="form-icon"></i>
							Contratos
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Regulatório", $r["pergunta-12-7-1"]) ? "checked" : ""?> name="pergunta-12-7-1[]" type="checkbox" value="Regulatório"/>
							<i class="form-icon"></i>
							Regulatório
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Internacional", $r["pergunta-12-7-1"]) ? "checked" : ""?> name="pergunta-12-7-1[]" type="checkbox" value="Internacional"/>
							<i class="form-icon"></i>
							Internacional
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Leasing de Aeronaves", $r["pergunta-12-7-1"]) ? "checked" : ""?> name="pergunta-12-7-1[]" type="checkbox" value="Leasing de Aeronaves"/>
							<i class="form-icon"></i>
							Leasing de Aeronaves
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Consumidor", $r["pergunta-12-7-1"]) ? "checked" : ""?> name="pergunta-12-7-1[]" type="checkbox" value="Consumidor"/>
							<i class="form-icon"></i>
							Consumidor
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-7-1"]) ? "checked" : ""?> data-check="pergunta-12-7-1-1" name="pergunta-12-7-1[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-7-1-1" name="pergunta-12-7-1-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-7-1-1"]?>"/>
						</label>
					</div>

					<label class="form-label pl-2" for="pergunta-12-7-2"><em>Tributário</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("ICMS", $r["pergunta-12-7-2"]) ? "checked" : ""?> id="pergunta-12-7-2" name="pergunta-12-7-2[]" type="checkbox" value="ICMS"/>
							<i class="form-icon"></i>
							ICMS
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Internacional", $r["pergunta-12-7-2"]) ? "checked" : ""?> name="pergunta-12-7-2[]" type="checkbox" value="Internacional"/>
							<i class="form-icon"></i>
							Internacional
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-7-2"]) ? "checked" : ""?> data-check="pergunta-12-7-2-1" name="pergunta-12-7-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-7-2-1" name="pergunta-12-7-2-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-7-2-1"]?>"/>
						</label>
					</div>

					<label class="form-label pl-2" for="pergunta-12-7-3"><em>Penal</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-7-3"]) ? "checked" : ""?> data-check="pergunta-12-7-3-1" id="pergunta-12-7-3" name="pergunta-12-7-3[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-7-3-1" name="pergunta-12-7-3-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-7-3-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-12-8-1"><strong>TI</strong></label>
					<label class="form-label pl-2" for="pergunta-12-8-1"><em>Linguagem</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("C", $r["pergunta-12-8-1"]) ? "checked" : ""?> id="pergunta-12-8-1" name="pergunta-12-8-1[]" type="checkbox" value="C"/>
							<i class="form-icon"></i>
							C
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("C++", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="C++"/>
							<i class="form-icon"></i>
							C++
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("C#", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="C#"/>
							<i class="form-icon"></i>
							C#
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Python", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="Python"/>
							<i class="form-icon"></i>
							Python
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Node", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="Node"/>
							<i class="form-icon"></i>
							Node
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Java", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="Java"/>
							<i class="form-icon"></i>
							Java
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Javascript", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="Javascript"/>
							<i class="form-icon"></i>
							Javascript
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("React", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="React"/>
							<i class="form-icon"></i>
							React
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("React Native", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="React Native"/>
							<i class="form-icon"></i>
							React Native
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("PHP", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="PHP"/>
							<i class="form-icon"></i>
							PHP
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Ruby", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="Ruby"/>
							<i class="form-icon"></i>
							Ruby
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("CSS", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="CSS"/>
							<i class="form-icon"></i>
							CSS
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("TypeScript", $r["pergunta-12-8-1"]) ? "checked" : ""?> name="pergunta-12-8-1[]" type="checkbox" value="TypeScript"/>
							<i class="form-icon"></i>
							TypeScript
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-8-1"]) ? "checked" : ""?> data-check="pergunta-12-8-1-1" name="pergunta-12-8-1[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-8-1-1" name="pergunta-12-8-1-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-8-1-1"]?>"/>
						</label>
					</div>

					<label class="form-label pl-2" for="pergunta-12-8-2"><em>Banco de Dados</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Oracle", $r["pergunta-12-8-2"]) ? "checked" : ""?> id="pergunta-12-8-2" name="pergunta-12-8-2[]" type="checkbox" value="Oracle"/>
							<i class="form-icon"></i>
							Oracle
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("SQL", $r["pergunta-12-8-2"]) ? "checked" : ""?> name="pergunta-12-8-2[]" type="checkbox" value="SQL"/>
							<i class="form-icon"></i>
							SQL
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("MySQL", $r["pergunta-12-8-2"]) ? "checked" : ""?> name="pergunta-12-8-2[]" type="checkbox" value="MySQL"/>
							<i class="form-icon"></i>
							MySQL
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("XML", $r["pergunta-12-8-2"]) ? "checked" : ""?> name="pergunta-12-8-2[]" type="checkbox" value="XML"/>
							<i class="form-icon"></i>
							XML
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-8-2"]) ? "checked" : ""?> data-check="pergunta-12-8-2-1" name="pergunta-12-8-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-8-2-1" name="pergunta-12-8-2-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-8-2-1"]?>"/>
						</label>
					</div>

					<label class="form-label pl-2" for="pergunta-12-8-3"><em>HelpDesk</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Suporte", $r["pergunta-12-8-3"]) ? "checked" : ""?> id="pergunta-12-8-3" name="pergunta-12-8-3[]" type="checkbox" value="Suporte"/>
							<i class="form-icon"></i>
							Suporte
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Periféricos", $r["pergunta-12-8-3"]) ? "checked" : ""?> name="pergunta-12-8-3[]" type="checkbox" value="Periféricos"/>
							<i class="form-icon"></i>
							Periféricos
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Configuração", $r["pergunta-12-8-3"]) ? "checked" : ""?> name="pergunta-12-8-3[]" type="checkbox" value="Configuração"/>
							<i class="form-icon"></i>
							Configuração
						</label>
					</div>

					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Redes", $r["pergunta-12-8-4"]) ? "checked" : ""?> name="pergunta-12-8-4[]" type="checkbox" value="Redes"/>
							<i class="form-icon"></i>
							<em>Redes</em>
						</label>
					</div>

					<label class="form-label pl-2" for="pergunta-12-8-5"><em>Servidores</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("AWS", $r["pergunta-12-8-5"]) ? "checked" : ""?> id="pergunta-12-8-5" name="pergunta-12-8-5[]" type="checkbox" value="AWS"/>
							<i class="form-icon"></i>
							AWS
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Web", $r["pergunta-12-8-5"]) ? "checked" : ""?> name="pergunta-12-8-5[]" type="checkbox" value="Web"/>
							<i class="form-icon"></i>
							Web
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Google", $r["pergunta-12-8-5"]) ? "checked" : ""?> name="pergunta-12-8-5[]" type="checkbox" value="Google"/>
							<i class="form-icon"></i>
							Google
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("IBM", $r["pergunta-12-8-5"]) ? "checked" : ""?> name="pergunta-12-8-5[]" type="checkbox" value="IBM"/>
							<i class="form-icon"></i>
							IBM
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-8-5"]) ? "checked" : ""?> data-check="pergunta-12-8-5-1" name="pergunta-12-8-5[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-8-5-1" name="pergunta-12-8-5-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-8-5-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-12-9-1"><strong>Engenharia</strong></label>
					<label class="form-label pl-2" for="pergunta-12-9-1"><em>Aeronáutica</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Materiais", $r["pergunta-12-9-1"]) ? "checked" : ""?> id="pergunta-12-9-1" name="pergunta-12-9-1[]" type="checkbox" value="Materiais"/>
							<i class="form-icon"></i>
							Materiais
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Estruturas", $r["pergunta-12-9-1"]) ? "checked" : ""?> name="pergunta-12-9-1[]" type="checkbox" value="Estruturas"/>
							<i class="form-icon"></i>
							Estruturas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Manutenção", $r["pergunta-12-9-1"]) ? "checked" : ""?> name="pergunta-12-9-1[]" type="checkbox" value="Manutenção"/>
							<i class="form-icon"></i>
							Manutenção
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Aviônica", $r["pergunta-12-9-1"]) ? "checked" : ""?> name="pergunta-12-9-1[]" type="checkbox" value="Aviônica"/>
							<i class="form-icon"></i>
							Aviônica
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Projetos", $r["pergunta-12-9-1"]) ? "checked" : ""?> name="pergunta-12-9-1[]" type="checkbox" value="Projetos"/>
							<i class="form-icon"></i>
							Projetos
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Propulsão", $r["pergunta-12-9-1"]) ? "checked" : ""?> name="pergunta-12-9-1[]" type="checkbox" value="Propulsão"/>
							<i class="form-icon"></i>
							Propulsão
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Física", $r["pergunta-12-9-1"]) ? "checked" : ""?> name="pergunta-12-9-1[]" type="checkbox" value="Física"/>
							<i class="form-icon"></i>
							Física
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Aerodinâmica", $r["pergunta-12-9-1"]) ? "checked" : ""?> name="pergunta-12-9-1[]" type="checkbox" value="Aerodinâmica"/>
							<i class="form-icon"></i>
							Aerodinâmica
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Motores", $r["pergunta-12-9-1"]) ? "checked" : ""?> name="pergunta-12-9-1[]" type="checkbox" value="Motores"/>
							<i class="form-icon"></i>
							Motores
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-9-1"]) ? "checked" : ""?> data-check="pergunta-12-9-1-1" name="pergunta-12-9-1[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-9-1-1" name="pergunta-12-9-1-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-9-1-1"]?>"/>
						</label>
					</div>

					<label class="form-label pl-2" for="pergunta-12-9-2"><em>Mecânica</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Materiais", $r["pergunta-12-9-2"]) ? "checked" : ""?> id="pergunta-12-9-2" name="pergunta-12-9-2[]" type="checkbox" value="Materiais"/>
							<i class="form-icon"></i>
							Materiais
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Estruturas", $r["pergunta-12-9-2"]) ? "checked" : ""?> name="pergunta-12-9-2[]" type="checkbox" value="Estruturas"/>
							<i class="form-icon"></i>
							Estruturas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Projetos", $r["pergunta-12-9-2"]) ? "checked" : ""?> name="pergunta-12-9-2[]" type="checkbox" value="Projetos"/>
							<i class="form-icon"></i>
							Projetos
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Dinâmica", $r["pergunta-12-9-2"]) ? "checked" : ""?> name="pergunta-12-9-2[]" type="checkbox" value="Dinâmica"/>
							<i class="form-icon"></i>
							Dinâmica
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-9-2"]) ? "checked" : ""?> data-check="pergunta-12-9-2-1" name="pergunta-12-9-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-9-2-1" name="pergunta-12-9-2-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-9-2-1"]?>"/>
						</label>
					</div>

					<label class="form-label pl-2" for="pergunta-12-9-3"><em>Civil</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Materiais", $r["pergunta-12-9-3"]) ? "checked" : ""?> id="pergunta-12-9-3" name="pergunta-12-9-3[]" type="checkbox" value="Materiais"/>
							<i class="form-icon"></i>
							Materiais
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Estruturas", $r["pergunta-12-9-3"]) ? "checked" : ""?> name="pergunta-12-9-3[]" type="checkbox" value="Estruturas"/>
							<i class="form-icon"></i>
							Estruturas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Projetos", $r["pergunta-12-9-3"]) ? "checked" : ""?> name="pergunta-12-9-3[]" type="checkbox" value="Projetos"/>
							<i class="form-icon"></i>
							Projetos
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["pergunta-12-9-3"]) ? "checked" : ""?> data-check="pergunta-12-9-3-1" name="pergunta-12-9-3[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-9-3-1" name="pergunta-12-9-3-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-9-3-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-12-10"><strong>Administração</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Finanças", $r["pergunta-12-10"]) ? "checked" : ""?> id="pergunta-12-10" name="pergunta-12-10[]" type="checkbox" value="Finanças"/>
							<i class="form-icon"></i>
							<em>Finanças</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Gestão", $r["pergunta-12-10"]) ? "checked" : ""?> name="pergunta-12-10[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							<em>Gestão</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Planejamento", $r["pergunta-12-10"]) ? "checked" : ""?> name="pergunta-12-10[]" type="checkbox" value="Planejamento"/>
							<i class="form-icon"></i>
							<em>Planejamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Projetos", $r["pergunta-12-10"]) ? "checked" : ""?> name="pergunta-12-10[]" type="checkbox" value="Projetos"/>
							<i class="form-icon"></i>
							<em>Projetos</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-12-10"]) ? "checked" : ""?> data-check="pergunta-12-10-1" name="pergunta-12-10[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-10-1" name="pergunta-12-10-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-10-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-12-11"><strong>Recursos Humanos</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Comportamental", $r["pergunta-12-11"]) ? "checked" : ""?> id="pergunta-12-11" name="pergunta-12-11[]" type="checkbox" value="Comportamental"/>
							<i class="form-icon"></i>
							<em>Comportamental</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Organizacional", $r["pergunta-12-11"]) ? "checked" : ""?> name="pergunta-12-11[]" type="checkbox" value="Organizacional"/>
							<i class="form-icon"></i>
							<em>Organizacional</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Desenvolvimento", $r["pergunta-12-11"]) ? "checked" : ""?> name="pergunta-12-11[]" type="checkbox" value="Desenvolvimento"/>
							<i class="form-icon"></i>
							<em>Desenvolvimento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Treinamento", $r["pergunta-12-11"]) ? "checked" : ""?> name="pergunta-12-11[]" type="checkbox" value="Treinamento"/>
							<i class="form-icon"></i>
							<em>Treinamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-12-11"]) ? "checked" : ""?> data-check="pergunta-12-11-1" name="pergunta-12-11[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-11-1" name="pergunta-12-11-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-11-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-12-12"><strong>Treinamento</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Operacional", $r["pergunta-12-12"]) ? "checked" : ""?> id="pergunta-12-12" name="pergunta-12-12[]" type="checkbox" value="Operacional"/>
							<i class="form-icon"></i>
							<em>Operacional</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Gestão", $r["pergunta-12-12"]) ? "checked" : ""?> name="pergunta-12-12[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							<em>Gestão</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Manutenção", $r["pergunta-12-12"]) ? "checked" : ""?> name="pergunta-12-12[]" type="checkbox" value="Manutenção"/>
							<i class="form-icon"></i>
							<em>Manutenção</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-12-12"]) ? "checked" : ""?> data-check="pergunta-12-12-1" name="pergunta-12-12[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-12-1" name="pergunta-12-12-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-12-1"]?>"/>
						</label>
					</div>

					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-12-13"]) ? "checked" : ""?> data-check="pergunta-12-13-1" name="pergunta-12-13[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<strong>Outros</strong>
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-12-13-1" name="pergunta-12-13-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-12-13-1"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-13">13. Algum desses treinamentos é certificado pelo Fabricante? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-13" name="pergunta-13" placeholder="Algum desses treinamentos é certificado pelo Fabricante? Se sim, quais?" rows="2" style="resize: none;"><?=$r["pergunta-13"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-14">14. Algum desses treinamentos é validado pela Autoridade da área de atuação? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-14" name="pergunta-14" placeholder="Exemplo 1: Familiarização Airbus A320 com certificado reconhecido pela ANAC. &#10;Exemplo 2: Treinamento de Psicologia Organizacional validado pelo CFP." rows="2" style="resize: none;"><?=$r["pergunta-14"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-15">15. Você possui treinamento em alguma ferramenta específica para realização de tarefas na função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-15" name="pergunta-15" placeholder="Você possui treinamento em alguma ferramenta específica para realização de tarefas na função?" rows="2" style="resize: none;"><?=$r["pergunta-15"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-16">16. Você já utilizou os conhecimentos adquiridos nesse(s) treinamento(s) na realização de tarefas na função? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-16" name="pergunta-16" placeholder="Você já utilizou os conhecimentos adquiridos nesse(s) treinamento(s) na realização de tarefas na função? Se sim, quais?" rows="2" style="resize: none;"><?=$r["pergunta-16"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-17">17. Qual o treinamento você considera de maior relevância para a função? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-17" name="pergunta-17" placeholder="Qual o treinamento você considera de maior relevância para a função? Por quê?" rows="2" style="resize: none;"><?=$r["pergunta-17"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-18">18. Você planeja fazer mais algum treinamento no futuro? Se sim, quais? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-18" name="pergunta-18" placeholder="Você planeja fazer mais algum treinamento no futuro? Se sim, quais? Por quê?" rows="2" style="resize: none;"><?=$r["pergunta-18"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-19">19. Na sua opinião, em quais aspectos o treinamento que você quer fazer, lhe ajudaria no desenvolvimento da sua carreira?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-19" name="pergunta-19" placeholder="Na sua opinião, em quais aspectos o treinamento que você quer fazer, lhe ajudaria no desenvolvimento da sua carreira?" rows="2" style="resize: none;"><?=$r["pergunta-19"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-20">20. Qual treinamento que você já fez você considera que foi menos proveitoso para a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-20" name="pergunta-20" placeholder="Qual treinamento que você já fez você considera que foi menos proveitoso para a função?" rows="2" style="resize: none;"><?=$r["pergunta-20"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-21">21. Qual treinamento você considera que precisa fazer para dar o próximo passo na sua carreira?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-21" name="pergunta-21" placeholder="Qual treinamento você considera que precisa fazer para dar o próximo passo na sua carreira?" rows="2" style="resize: none;"><?=$r["pergunta-21"]?></textarea>
				</div>
			</div>

			<div class="divider"></div>
			<h5 class="text-center">Relacionamento técnico com fornecedores, fabricantes, oficinas, contatos em geral na indústria aeronáutica</h5>
			<div class="divider"></div>
			<!--<div class="divider text-center" data-content="Relacionamento técnico com fornecedores, fabricantes, oficinas, contatos em geral na indústria aeronáutica"></div>-->

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-22">22. Você possui contatos com os quais mantém relacionamento nas seguintes áreas?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Passageiros", $r["pergunta-22"]) ? "checked" : ""?> id="pergunta-22" name="pergunta-22[]" type="checkbox" value="Empresas de Transporte Aéreo de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Cargas", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Transporte Aéreo de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Passageiros", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Serviços Auxiliares de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Cargas", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Serviços Auxiliares de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Aeroportos", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Aeroportos"/>
							<i class="form-icon"></i>
							Aeroportos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Aeronaves", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Fabricantes de Aeronaves"/>
							<i class="form-icon"></i>
							Fabricantes de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Motores", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Fabricantes de Motores"/>
							<i class="form-icon"></i>
							Fabricantes de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Componentes", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Fabricantes de Componentes"/>
							<i class="form-icon"></i>
							Fabricantes de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Químicos", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Fabricantes de Químicos"/>
							<i class="form-icon"></i>
							Fabricantes de Químicos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Ferramentas", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Fabricantes de Ferramentas"/>
							<i class="form-icon"></i>
							Fabricantes de Ferramentas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Distribuidores de Partes e Componentes", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Distribuidores de Partes e Componentes"/>
							<i class="form-icon"></i>
							Distribuidores de Partes e Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Aeronaves", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Manutenção de Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Motores", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Manutenção de Motores"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Componentes", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Manutenção de Componentes"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Equipamentos Auxiliares", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Manutenção de Equipamentos Auxiliares"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Equipamentos Auxiliares
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Ferramentas", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Manutenção de Ferramentas"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Ferramentas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Aeronaves", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Operações de Aeronaves", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Operações de Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Operações de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Operações de Aeroportos", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Operações de Aeroportos"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Operações de Aeroportos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Operações de Solo", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Operações de Solo"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Operações de Solo
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Operações de Voo", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Operações de Voo"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Operações de Voo
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Indústria Aeronáutica", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Indústria Aeronáutica"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Indústria Aeronáutica
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Manutenção de Aeronaves", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Manutenção de Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Manutenção de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Manutenção de Motores", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Manutenção de Motores"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Manutenção de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Manutenção de Componentes", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Manutenção de Componentes"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Manutenção de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Manutenção de Ferramentas", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Manutenção de Ferramentas"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Manutenção de Ferramentas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Ministério da Defesa do Brasil", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Ministério da Defesa do Brasil"/>
							<i class="form-icon"></i>
							Ministério da Defesa do Brasil
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Força Aérea Brasileira", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Força Aérea Brasileira"/>
							<i class="form-icon"></i>
							Força Aérea Brasileira
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Marinha do Brasil", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Marinha do Brasil"/>
							<i class="form-icon"></i>
							Marinha do Brasil
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Exército Brasileiro", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Exército Brasileiro"/>
							<i class="form-icon"></i>
							Exército Brasileiro
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Forças Armadas Estrangeiras", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Forças Armadas Estrangeiras"/>
							<i class="form-icon"></i>
							Forças Armadas Estrangeiras
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Organizações Governamentais", $r["pergunta-22"]) ? "checked" : ""?> name="pergunta-22[]" type="checkbox" value="Organizações Governamentais"/>
							<i class="form-icon"></i>
							Organizações Governamentais
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-22"]) ? "checked" : ""?> data-check="pergunta-22-1" name="pergunta-22[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-22-1" name="pergunta-22-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-22-1"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-23">23. Qual seu nível de relacionamento com as empresas citadas acima?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-23" name="pergunta-23" placeholder="Exemplo: Presidência, Diretoria, Gerência, Coordenação, etc." rows="2" style="resize: none;"><?=$r["pergunta-23"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-24">24. Em quais setores das empresas citadas acima você possui relacionamento?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Administração", $r["pergunta-24"]) ? "checked" : ""?> id="pergunta-24" name="pergunta-24[]" type="checkbox" value="Administração"/>
							<i class="form-icon"></i>
							Administração
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Contabilidade", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Contabilidade"/>
							<i class="form-icon"></i>
							Contabilidade
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Recursos Humanos", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Recursos Humanos"/>
							<i class="form-icon"></i>
							Recursos Humanos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Compras", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Compras"/>
							<i class="form-icon"></i>
							Compras
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Logística", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Logística"/>
							<i class="form-icon"></i>
							Logística
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Suprimentos Técnicos", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Suprimentos Técnicos"/>
							<i class="form-icon"></i>
							Suprimentos Técnicos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Comércio Exterior", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Comércio Exterior"/>
							<i class="form-icon"></i>
							Comércio Exterior
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Financeiro", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Financeiro"/>
							<i class="form-icon"></i>
							Financeiro
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Atendimento Aeroportuário/Apoio de solo", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Atendimento Aeroportuário/Apoio de solo"/>
							<i class="form-icon"></i>
							Atendimento Aeroportuário/Apoio de solo
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Comercial e Vendas", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Comercial e Vendas"/>
							<i class="form-icon"></i>
							Comercial e Vendas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Marketing", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Marketing"/>
							<i class="form-icon"></i>
							Marketing
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("TI", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="TI"/>
							<i class="form-icon"></i>
							TI
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Segurança Operacional", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Segurança Operacional"/>
							<i class="form-icon"></i>
							Segurança Operacional
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Operações", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Operações"/>
							<i class="form-icon"></i>
							Operações
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Engenharia", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Engenharia"/>
							<i class="form-icon"></i>
							Engenharia
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Treinamento", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Treinamento"/>
							<i class="form-icon"></i>
							Treinamento
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Qualidade", $r["pergunta-24"]) ? "checked" : ""?> name="pergunta-24[]" type="checkbox" value="Qualidade"/>
							<i class="form-icon"></i>
							Qualidade
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-24"]) ? "checked" : ""?> data-check="pergunta-24-1" name="pergunta-24[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-24-1" name="pergunta-24-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-24-1"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-25">25. Quais desses contatos você considera mais importantes para a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-25" name="pergunta-25" placeholder="Quais desses contatos você considera mais importantes para a função?" rows="2" style="resize: none;"><?=$r["pergunta-25"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-26">26. Descreva seu nível de relacionamentos com os contatos citados no item 25:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-26" name="pergunta-26" placeholder="Descreva seu nível de relacionamentos com os contatos citados no item 25" rows="2" style="resize: none;"><?=$r["pergunta-26"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-27">27. Esses contatos podem fornecer boas referências a seu respeito? Se sim informe nome e contato.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-27" name="pergunta-27" placeholder="Esses contatos podem fornecer boas referências a seu respeito? Se sim informe nome e contato." rows="2" style="resize: none;"><?=$r["pergunta-27"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-28">28. Em qual área da aviação você julga ter o melhor nível de relacionamento?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-28" name="pergunta-28" placeholder="Em qual área da aviação você julga ter o melhor nível de relacionamento?" rows="2" style="resize: none;"><?=$r["pergunta-28"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-29">29. Quais características profissionais você acredita que esses contatos poderiam citar a seu respeito?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-29" name="pergunta-29" placeholder="Quais características profissionais você acredita que esses contatos poderiam citar a seu respeito?" rows="2" style="resize: none;"><?=$r["pergunta-29"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-30">30. Você já teve ou possui atualmente algum atrito, divergência ou disputa judicial com alguma empresa ligada a Aviação? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-30" name="pergunta-30" placeholder="Você já teve ou possui atualmente algum atrito, divergência ou disputa judicial com alguma empresa ligada a Aviação? Se sim, quais?" rows="3" style="resize: none;"><?=$r["pergunta-30"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-31">31. Você já teve algum conflito de maior proporção com alguma pessoa ligada a aviação que poderia influenciar sua carreira em alguma empresa da aviação? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-31" name="pergunta-31" placeholder="Você já teve algum conflito de maior proporção com alguma pessoa ligada a aviação que poderia influenciar sua carreira em alguma empresa da aviação? Se sim, quais?" rows="4" style="resize: none;"><?=$r["pergunta-31"]?></textarea>
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
			// Desabilitar campos de textos não selecionados
			$("input[data-check*='pergunta']:not(:checked)").each(function(i) {
				$("input[id='" + $(this).data("check") + "']").prop("disabled", true);
			});

			// Habilitar o campo de mudança de meta
			$("input[data-check*='pergunta']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[id='" + $(this).data("check") + "']").prop("disabled", false);
				else {
					$("input[id='" + $(this).data("check") + "']").prop("disabled", true);
					$("input[id='" + $(this).data("check") + "']").val("");
				}
			});

			// Salva a página requerida no formulário
			$("input[name='anterior']").click(function() {
				$("input[name='proximo']").val("");
			});
			$("input[name='proximo']").click(function() {
				$("input[name='anterior']").val("");
			});

			// Direcionadores dos links do menu superior
			$("a[data-anchor='formulario-0.php'], a[data-anchor='formulario-1.php'], a[data-anchor='formulario-2.php'], a[data-anchor='formulario-4.php'], a[data-anchor='formulario-5.php'], a[data-anchor='formulario-6.php'], a[data-anchor='php/sair.php']").click(function() {
				$("input[name='pagina']").val($(this).data("anchor"));
				$("form[action='php/formulario-3.php']").submit();
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