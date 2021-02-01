<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS, FUNÇÕES GLOBAIS, FORMULÁRIOS GLOBAIS E CONFIGURAÇÕES DE ALUNOS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../forms.php");
require_once(__DIR__ . "/../student.php");

// MÓDULO NECESSÁRIO, ESTÁGIO NECESSÁRIO E TÍTULO DA PÁGINA
define("PAGE_MODULE", FORM_MODULES[1]);
define("PAGE_STAGE", FORM_STAGES[2]);
define("PAGE_TITLE", PAGE_MODULE . " (" . PAGE_STAGE . ")");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA TODAS AS RESPOSTAS DO USUÁRIO
$r = specific_technical_knowledge_response(get_user()["student"]);

// DEFINE O TEMPO PARA EXIBIR EM TELA
$time = initial_registration_start_time(get_user()["student"]);

// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);

// CARREGA O MENU SUPERIOR DA PÁGINA
require_once(INC_ROUTES["navbar"]);

// CARREGA A ETAPA DA PÁGINA
require_once(INC_ROUTES["step"]);
?>

	<div class="container grid-lg py-4">
		<div class="text-center">
			<h6 class="display-6 text-blue"><?=PAGE_STAGE?></h6>
		</div>

		<form action="<?=ACTION_NAME?>technical-evaluation/specific-technical-knowledge" class="form-horizontal" data-save="true" method="post">
			<div class="divider text-center" data-content="Formações e qualificações"></div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-1">1. Você possui alguma carteira de habilitação específica da sua área de atuação? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-1"><strong>ANAC Pilotos</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PPA", $r["question-1"]) ? "checked" : ""?> id="question-1" name="question-1[]" type="checkbox" value="PPA"/>
							<i class="form-icon"></i>
							PPA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PPH", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="PPH"/>
							<i class="form-icon"></i>
							PPH
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PCA", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="PCA"/>
							<i class="form-icon"></i>
							PCA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PCH", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="PCH"/>
							<i class="form-icon"></i>
							PCH
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PLA", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="PLA"/>
							<i class="form-icon"></i>
							PLA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PLH", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="PLH"/>
							<i class="form-icon"></i>
							PLH
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Mono", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="Mono"/>
							<i class="form-icon"></i>
							Mono
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Multi", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="Multi"/>
							<i class="form-icon"></i>
							Multi
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("IFR", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="IFR"/>
							<i class="form-icon"></i>
							IFR
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("ANAC Comissários", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="ANAC Comissários"/>
							<i class="form-icon"></i>
							<strong>ANAC Comissários</strong>
						</label>
					</div>

					<label class="form-label" for="question-1-mecanico"><strong>ANAC Mecânico</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("GMP", $r["question-1"]) ? "checked" : ""?> id="question-1-mecanico" name="question-1[]" type="checkbox" value="GMP"/>
							<i class="form-icon"></i>
							GMP
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CEL", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="CEL"/>
							<i class="form-icon"></i>
							CEL
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("AVI", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="AVI"/>
							<i class="form-icon"></i>
							AVI
						</label>
					</div>
					<label class="form-label" for="question-1-cenipa"><strong>CENIPA</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-PREV", $r["question-1"]) ? "checked" : ""?> id="question-1-cenipa" name="question-1[]" type="checkbox" value="EC-PREV"/>
							<i class="form-icon"></i>
							EC-PREV
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-FHM", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="EC-FHM"/>
							<i class="form-icon"></i>
							EC-FHM
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-FHP", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="EC-FHP"/>
							<i class="form-icon"></i>
							EC-FHP
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-FM", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="EC-FM"/>
							<i class="form-icon"></i>
							EC-FM
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-MA", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="EC-MA"/>
							<i class="form-icon"></i>
							EC-MA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-CEA", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="EC-CEA"/>
							<i class="form-icon"></i>
							EC-CEA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EC-AA", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="EC-AA"/>
							<i class="form-icon"></i>
							EC-AA
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("ASV", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="ASV"/>
							<i class="form-icon"></i>
							ASV
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("OSV", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="OSV"/>
							<i class="form-icon"></i>
							OSV
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("FAA", $r["question-1"]) ? "checked" : ""?> data-check="question-1-1" name="question-1[]" type="checkbox" value="FAA"/>
							<i class="form-icon"></i>
							<strong>FAA</strong>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-1-1" name="question-1-1" placeholder="Qual?" type="text" value="<?=$r["question-1-1"]?>"/>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("EASA", $r["question-1"]) ? "checked" : ""?> data-check="question-1-2" name="question-1[]" type="checkbox" value="EASA"/>
							<i class="form-icon"></i>
							<strong>EASA</strong>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-1-2" name="question-1-2" placeholder="Qual?" type="text" value="<?=$r["question-1-2"]?>"/>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CREA", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="CREA"/>
							<i class="form-icon"></i>
							<strong>CREA</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("OAB", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="OAB"/>
							<i class="form-icon"></i>
							<strong>OAB</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CRM", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="CRM"/>
							<i class="form-icon"></i>
							<strong>CRM</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CRP", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="CRP"/>
							<i class="form-icon"></i>
							<strong>CRP</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("SGSO", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="SGSO"/>
							<i class="form-icon"></i>
							<strong>SGSO</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("AVSEC", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="AVSEC"/>
							<i class="form-icon"></i>
							<strong>AVSEC</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("DGR", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="DGR"/>
							<i class="form-icon"></i>
							<strong>DGR</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("IATA", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="IATA"/>
							<i class="form-icon"></i>
							<strong>IATA</strong>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Receita Federal Brasileira - RFB", $r["question-1"]) ? "checked" : ""?> name="question-1[]" type="checkbox" value="Receita Federal Brasileira - RFB"/>
							<i class="form-icon"></i>
							<strong>Receita Federal Brasileira - RFB</strong>
						</label>
					</div>

					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-1"]) ? "checked" : ""?> data-check="question-1-3" name="question-1[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<strong>Outros</strong>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-1-3" name="question-1-3" placeholder="Quais?" type="text" value="<?=$r["question-1-3"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-2-1">2. Nível de conhecimento dos regulamentos abaixo:</label>
				</div>
				<div class="col-8 col-sm-12 pb-2 pl-1">
					<label class="form-label" for="question-2-1"><strong>RBAC 91</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-1"] === "Nenhum" ? "checked" : ""?> id="question-2-1" name="question-2-1" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-1"] === "Superficial" ? "checked" : ""?> name="question-2-1" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-1"] === "Médio" ? "checked" : ""?> name="question-2-1" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-1"] === "Alto" ? "checked" : ""?> name="question-2-1" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-2-2"><strong>RBAC 121</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-2"] === "Nenhum" ? "checked" : ""?> id="question-2-2" name="question-2-2" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-2"] === "Superficial" ? "checked" : ""?> name="question-2-2" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-2"] === "Médio" ? "checked" : ""?> name="question-2-2" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-2"] === "Alto" ? "checked" : ""?> name="question-2-2" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-2-3"><strong>RBAC 135</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-3"] === "Nenhum" ? "checked" : ""?> id="question-2-3" name="question-2-3" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-3"] === "Superficial" ? "checked" : ""?> name="question-2-3" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-3"] === "Médio" ? "checked" : ""?> name="question-2-3" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-3"] === "Alto" ? "checked" : ""?> name="question-2-3" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-2-4"><strong>RBAC 145</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-4"] === "Nenhum" ? "checked" : ""?> id="question-2-4" name="question-2-4" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-4"] === "Superficial" ? "checked" : ""?> name="question-2-4" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-4"] === "Médio" ? "checked" : ""?> name="question-2-4" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-4"] === "Alto" ? "checked" : ""?> name="question-2-4" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-2-5"><strong>RBAC 153</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-5"] === "Nenhum" ? "checked" : ""?> id="question-2-5" name="question-2-5" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-5"] === "Superficial" ? "checked" : ""?> name="question-2-5" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-5"] === "Médio" ? "checked" : ""?> name="question-2-5" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-5"] === "Alto" ? "checked" : ""?> name="question-2-5" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-2-6"><strong>RBAC 107</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-6"] === "Nenhum" ? "checked" : ""?> id="question-2-6" name="question-2-6" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-6"] === "Superficial" ? "checked" : ""?> name="question-2-6" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-6"] === "Médio" ? "checked" : ""?> name="question-2-6" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-6"] === "Alto" ? "checked" : ""?> name="question-2-6" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-2-7"><strong>RBAC 108</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-7"] === "Nenhum" ? "checked" : ""?> id="question-2-7" name="question-2-7" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-7"] === "Superficial" ? "checked" : ""?> name="question-2-7" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-7"] === "Médio" ? "checked" : ""?> name="question-2-7" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-7"] === "Alto" ? "checked" : ""?> name="question-2-7" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-2-8"><strong>RBAC 110</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-8"] === "Nenhum" ? "checked" : ""?> id="question-2-8" name="question-2-8" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-8"] === "Superficial" ? "checked" : ""?> name="question-2-8" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-8"] === "Médio" ? "checked" : ""?> name="question-2-8" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-8"] === "Alto" ? "checked" : ""?> name="question-2-8" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-2-9"><strong>RBAC 175</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-9"] === "Nenhum" ? "checked" : ""?> id="question-2-9" name="question-2-9" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-9"] === "Superficial" ? "checked" : ""?> name="question-2-9" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-9"] === "Médio" ? "checked" : ""?> name="question-2-9" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-9"] === "Alto" ? "checked" : ""?> name="question-2-9" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-2-10"><strong>RESOLUÇÃO ANAC 130</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-10"] === "Nenhum" ? "checked" : ""?> id="question-2-10" name="question-2-10" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-10"] === "Superficial" ? "checked" : ""?> name="question-2-10" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-10"] === "Médio" ? "checked" : ""?> name="question-2-10" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-10"] === "Alto" ? "checked" : ""?> name="question-2-10" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="question-2-11"><strong>RESOLUÇÃO ANAC 280</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-11"] === "Nenhum" ? "checked" : ""?> id="question-2-11" name="question-2-11" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-11"] === "Superficial" ? "checked" : ""?> name="question-2-11" type="radio" value="Superficial"/>
						<i class="form-icon"></i>
						Superficial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-11"] === "Médio" ? "checked" : ""?> name="question-2-11" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["question-2-11"] === "Alto" ? "checked" : ""?> name="question-2-11" type="radio" value="Alto"/>
						<i class="form-icon"></i>
						Alto
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-3">3. Sua habilitação tem validade? Se sim, até quando?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-3" name="question-3" type="date" value="<?=$r["question-3"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-4">4. Você tem alguma formação (curso superior, cursos, treinamentos) específica na área? Se sim, quais? Onde? Data de conclusão?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-4" name="question-4" placeholder="Você tem alguma formação (curso superior, cursos, treinamentos) específica na área? Se sim, quais? Onde? Data de conclusão?" rows="2" style="resize: none;"><?=$r["question-4"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-5">5. Todas possuem certificados?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-5" name="question-5" placeholder="Todas possuem certificados?" type="text" value="<?=$r["question-5"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-6">6. Alguma dessas foram feitas no exterior?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="question-6" name="question-6" placeholder="Alguma dessas foram feitas no exterior?" type="text" value="<?=$r["question-6"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-7">7. Qual a formação citada acima que mais ajudou a desenvolver sua carreira? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-7" name="question-7" placeholder="Qual a formação citada acima que mais ajudou a desenvolver sua carreira? Por quê?" rows="2" style="resize: none;"><?=$r["question-7"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-8">8. Qual curso você mais se identificou? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-8" name="question-8" placeholder="Qual curso você mais se identificou? Por quê?" rows="2" style="resize: none;"><?=$r["question-8"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-9">9. Qual o maior desafio que você enfrentou durante sua formação?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-9" name="question-9" placeholder="Qual o maior desafio que você enfrentou durante sua formação?" rows="2" style="resize: none;"><?=$r["question-9"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-10">10. Qual curso ou treinamento você ainda pretende fazer? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-10" name="question-10" placeholder="Qual curso ou treinamento você ainda pretende fazer? Por quê?" rows="2" style="resize: none;"><?=$r["question-10"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-11">11. Você teve algum mentor durante sua formação? Se sim, em qual área? Quem foi?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-11" name="question-11" placeholder="Você teve algum mentor durante sua formação? Se sim, em qual área? Quem foi?" rows="2" style="resize: none;"><?=$r["question-11"]?></textarea>
				</div>
			</div>

			<div class="divider text-center" data-content="Treinamentos específicos e conhecimento de aeronaves, partes, componentes, ferramentas, linguagem, etc."></div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-12-1-1">12. Você possui algum treinamento específico nas seguintes áreas?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="question-12-1-1"><strong>Aeronaves</strong></label>
					<label class="form-label pl-2" for="question-12-1-1"><em>Projetos</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Estruturas", $r["question-12-1-1"]) ? "checked" : ""?> id="question-12-1-1" name="question-12-1-1[]" type="checkbox" value="Estruturas"/>
							<i class="form-icon"></i>
							Estruturas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Aviônica", $r["question-12-1-1"]) ? "checked" : ""?> name="question-12-1-1[]" type="checkbox" value="Aviônica"/>
							<i class="form-icon"></i>
							Aviônica
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Sistemas", $r["question-12-1-1"]) ? "checked" : ""?> name="question-12-1-1[]" type="checkbox" value="Sistemas"/>
							<i class="form-icon"></i>
							Sistemas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Motores", $r["question-12-1-1"]) ? "checked" : ""?> name="question-12-1-1[]" type="checkbox" value="Motores"/>
							<i class="form-icon"></i>
							Motores
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Engenharia", $r["question-12-1-1"]) ? "checked" : ""?> name="question-12-1-1[]" type="checkbox" value="Engenharia"/>
							<i class="form-icon"></i>
							Engenharia
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Planejamento", $r["question-12-1-1"]) ? "checked" : ""?> name="question-12-1-1[]" type="checkbox" value="Planejamento"/>
							<i class="form-icon"></i>
							Planejamento
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Qualidade", $r["question-12-1-1"]) ? "checked" : ""?> name="question-12-1-1[]" type="checkbox" value="Qualidade"/>
							<i class="form-icon"></i>
							Qualidade
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Segurança Operacional", $r["question-12-1-1"]) ? "checked" : ""?> name="question-12-1-1[]" type="checkbox" value="Segurança Operacional"/>
							<i class="form-icon"></i>
							Segurança Operacional
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Gestão", $r["question-12-1-1"]) ? "checked" : ""?> name="question-12-1-1[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							Gestão
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-1-1"]) ? "checked" : ""?> data-check="question-12-1-1-1" name="question-12-1-1[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-1-1-1" name="question-12-1-1-1" placeholder="Quais?" type="text" value="<?=$r["question-12-1-1-1"]?>"/>
						</label>
					</div>
					<label class="form-label pl-2" for="question-12-1-2"><em>Manutenção</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Estruturas", $r["question-12-1-2"]) ? "checked" : ""?> id="question-12-1-2" name="question-12-1-2[]" type="checkbox" value="Estruturas"/>
							<i class="form-icon"></i>
							Estruturas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Aviônica", $r["question-12-1-2"]) ? "checked" : ""?> name="question-12-1-2[]" type="checkbox" value="Aviônica"/>
							<i class="form-icon"></i>
							Aviônica
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Sistemas", $r["question-12-1-2"]) ? "checked" : ""?> name="question-12-1-2[]" type="checkbox" value="Sistemas"/>
							<i class="form-icon"></i>
							Sistemas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Motores", $r["question-12-1-2"]) ? "checked" : ""?> name="question-12-1-2[]" type="checkbox" value="Motores"/>
							<i class="form-icon"></i>
							Motores
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("MCC", $r["question-12-1-2"]) ? "checked" : ""?> name="question-12-1-2[]" type="checkbox" value="MCC"/>
							<i class="form-icon"></i>
							MCC
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("AOG", $r["question-12-1-2"]) ? "checked" : ""?> name="question-12-1-2[]" type="checkbox" value="AOG"/>
							<i class="form-icon"></i>
							AOG
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("CTM", $r["question-12-1-2"]) ? "checked" : ""?> name="question-12-1-2[]" type="checkbox" value="CTM"/>
							<i class="form-icon"></i>
							CTM
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Engenharia", $r["question-12-1-2"]) ? "checked" : ""?> name="question-12-1-2[]" type="checkbox" value="Engenharia"/>
							<i class="form-icon"></i>
							Engenharia
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Planejamento", $r["question-12-1-2"]) ? "checked" : ""?> name="question-12-1-2[]" type="checkbox" value="Planejamento"/>
							<i class="form-icon"></i>
							Planejamento
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Qualidade", $r["question-12-1-2"]) ? "checked" : ""?> name="question-12-1-2[]" type="checkbox" value="Qualidade"/>
							<i class="form-icon"></i>
							Qualidade
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Segurança Operacional", $r["question-12-1-2"]) ? "checked" : ""?> name="question-12-1-2[]" type="checkbox" value="Segurança Operacional"/>
							<i class="form-icon"></i>
							Segurança Operacional
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Gestão", $r["question-12-1-2"]) ? "checked" : ""?> name="question-12-1-2[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							Gestão
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-1-2"]) ? "checked" : ""?> data-check="question-12-1-2-1" name="question-12-1-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-1-2-1" name="question-12-1-2-1" placeholder="Quais?" type="text" value="<?=$r["question-12-1-2-1"]?>"/>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Piloto", $r["question-12-1-3"]) ? "checked" : ""?> name="question-12-1-3[]" type="checkbox" value="Piloto"/>
							<i class="form-icon"></i>
							<em>Piloto</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Comissário", $r["question-12-1-4"]) ? "checked" : ""?> name="question-12-1-4[]" type="checkbox" value="Comissário"/>
							<i class="form-icon"></i>
							<em>Comissário</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-12-1-5"]) ? "checked" : ""?> data-check="question-12-1-5-1" name="question-12-1-5[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-1-5-1" name="question-12-1-5-1" placeholder="Quais?" type="text" value="<?=$r["question-12-1-5-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-12-2"><strong>Operações de Solo</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Pax", $r["question-12-2"]) ? "checked": ""?> id="question-12-2" name="question-12-2[]" type="checkbox" value="Pax"/>
							<i class="form-icon"></i>
							<em>Pax</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Cargas", $r["question-12-2"]) ? "checked": ""?> name="question-12-2[]" type="checkbox" value="Cargas"/>
							<i class="form-icon"></i>
							<em>Cargas</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Movimentação de Aeronaves", $r["question-12-2"]) ? "checked": ""?> name="question-12-2[]" type="checkbox" value="Movimentação de Aeronaves"/>
							<i class="form-icon"></i>
							<em>Movimentação de Aer</em>onaves
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Aeroportos", $r["question-12-2"]) ? "checked": ""?> name="question-12-2[]" type="checkbox" value="Aeroportos"/>
							<i class="form-icon"></i>
							<em>Aeroportos</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Segurança Operacional", $r["question-12-2"]) ? "checked": ""?> name="question-12-2[]" type="checkbox" value="Segurança Operacional"/>
							<i class="form-icon"></i>
							<em>Segurança Operacion</em>al
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Coordenação", $r["question-12-2"]) ? "checked": ""?> name="question-12-2[]" type="checkbox" value="Coordenação"/>
							<i class="form-icon"></i>
							<em>Coordenação</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Gestão", $r["question-12-2"]) ? "checked": ""?> name="question-12-2[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							<em>Gestão</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-12-2"]) ? "checked": ""?> data-check="question-12-2-1" name="question-12-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-2-1" name="question-12-2-1" placeholder="Quais?" type="text" value="<?=$r["question-12-2-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-12-3"><strong>Operações de Voo</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Peso e Balanceamento", $r["question-12-3"]) ? "checked" : ""?> id="question-12-3" name="question-12-3[]" type="checkbox" value="Peso e Balanceamento"/>
							<i class="form-icon"></i>
							<em>Peso e Balanceamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Climatologia", $r["question-12-3"]) ? "checked" : ""?> name="question-12-3[]" type="checkbox" value="Climatologia"/>
							<i class="form-icon"></i>
							<em>Climatologia</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Planejamento", $r["question-12-3"]) ? "checked" : ""?> name="question-12-3[]" type="checkbox" value="Planejamento"/>
							<i class="form-icon"></i>
							<em>Planejamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Rotas", $r["question-12-3"]) ? "checked" : ""?> name="question-12-3[]" type="checkbox" value="Rotas"/>
							<i class="form-icon"></i>
							<em>Rotas</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Coordenação", $r["question-12-3"]) ? "checked" : ""?> name="question-12-3[]" type="checkbox" value="Coordenação"/>
							<i class="form-icon"></i>
							<em>Coordenação</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Gestão", $r["question-12-3"]) ? "checked" : ""?> name="question-12-3[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							<em>Gestão</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-12-3"]) ? "checked" : ""?> data-check="question-12-3-1" name="question-12-3[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-3-1" name="question-12-3-1" placeholder="Quais?" type="text" value="<?=$r["question-12-3-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-12-4"><strong>Suprimentos</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Compras", $r["question-12-4"]) ? "checked" : ""?> id="question-12-4" name="question-12-4[]" type="checkbox" value="Compras"/>
							<i class="form-icon"></i>
							<em>Compras</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Reparos", $r["question-12-4"]) ? "checked" : ""?> name="question-12-4[]" type="checkbox" value="Reparos"/>
							<i class="form-icon"></i>
							<em>Reparos</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("AOG", $r["question-12-4"]) ? "checked" : ""?> name="question-12-4[]" type="checkbox" value="AOG"/>
							<i class="form-icon"></i>
							<em>AOG</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Almoxarifado", $r["question-12-4"]) ? "checked" : ""?> name="question-12-4[]" type="checkbox" value="Almoxarifado"/>
							<i class="form-icon"></i>
							<em>Almoxarifado</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Logística", $r["question-12-4"]) ? "checked" : ""?> name="question-12-4[]" type="checkbox" value="Logística"/>
							<i class="form-icon"></i>
							<em>Logística</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Comex", $r["question-12-4"]) ? "checked" : ""?> name="question-12-4[]" type="checkbox" value="Comex"/>
							<i class="form-icon"></i>
							<em>Comex</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Gestão", $r["question-12-4"]) ? "checked" : ""?> name="question-12-4[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							<em>Gestão</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-12-4"]) ? "checked" : ""?> data-check="question-12-4-1" name="question-12-4[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-4-1" name="question-12-4-1" placeholder="Quais?" type="text" value="<?=$r["question-12-4-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-12-5"><strong>Contabilidade</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Escrita Fiscal", $r["question-12-5"]) ? "checked" : ""?> id="question-12-5" name="question-12-5[]" type="checkbox" value="Escrita Fiscal"/>
							<i class="form-icon"></i>
							<em>Escrita Fiscal</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Impostos", $r["question-12-5"]) ? "checked" : ""?> name="question-12-5[]" type="checkbox" value="Impostos"/>
							<i class="form-icon"></i>
							<em>Impostos</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Folha de Pagamento", $r["question-12-5"]) ? "checked" : ""?> name="question-12-5[]" type="checkbox" value="Folha de Pagamento"/>
							<i class="form-icon"></i>
							<em>Folha de Pagamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Comex", $r["question-12-5"]) ? "checked" : ""?> name="question-12-5[]" type="checkbox" value="Comex"/>
							<i class="form-icon"></i>
							<em>Comex</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Faturamento", $r["question-12-5"]) ? "checked" : ""?> name="question-12-5[]" type="checkbox" value="Faturamento"/>
							<i class="form-icon"></i>
							<em>Faturamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-12-5"]) ? "checked" : ""?> data-check="question-12-5-1" name="question-12-5[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-5-1" name="question-12-5-1" placeholder="Quais?" type="text" value="<?=$r["question-12-5-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-12-6-1"><strong>Comercial</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Vendas", $r["question-12-6-2"]) ? "checked" : ""?> id="question-12-6-1" name="question-12-6-1[]" type="checkbox" value="Vendas"/>
							<i class="form-icon"></i>
							<em>Vendas</em>
						</label>
					</div>
					<label class="form-label pl-2" for="question-12-6-2"><em>Marketing</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Design", $r["question-12-6-2"]) ? "checked" : ""?> id="question-12-6-2" name="question-12-6-2[]" type="checkbox" value="Design"/>
							<i class="form-icon"></i>
							Design
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Mídia Paga", $r["question-12-6-2"]) ? "checked" : ""?> name="question-12-6-2[]" type="checkbox" value="Mídia Paga"/>
							<i class="form-icon"></i>
							Mídia Paga
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Copy writing", $r["question-12-6-2"]) ? "checked" : ""?> name="question-12-6-2[]" type="checkbox" value="Copy writing"/>
							<i class="form-icon"></i>
							Copy writing
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Mídias sociais", $r["question-12-6-2"]) ? "checked" : ""?> name="question-12-6-2[]" type="checkbox" value="Mídias sociais"/>
							<i class="form-icon"></i>
							Mídias sociais
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Conteúdo", $r["question-12-6-2"]) ? "checked" : ""?> name="question-12-6-2[]" type="checkbox" value="Conteúdo"/>
							<i class="form-icon"></i>
							Conteúdo
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Edição Vídeo", $r["question-12-6-2"]) ? "checked" : ""?> name="question-12-6-2[]" type="checkbox" value="Edição Vídeo"/>
							<i class="form-icon"></i>
							Edição Vídeo
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Produção Vídeo", $r["question-12-6-2"]) ? "checked" : ""?> name="question-12-6-2[]" type="checkbox" value="Produção Vídeo"/>
							<i class="form-icon"></i>
							Produção Vídeo
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Modelagem 3D", $r["question-12-6-2"]) ? "checked" : ""?> name="question-12-6-2[]" type="checkbox" value="Modelagem 3D"/>
							<i class="form-icon"></i>
							Modelagem 3D
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-6-2"]) ? "checked" : ""?> data-check="question-12-6-2-1" name="question-12-6-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-6-2-1" name="question-12-6-2-1" placeholder="Quais?" type="text" value="<?=$r["question-12-6-2-1"]?>"/>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Prospecção", $r["question-12-6-3"]) ? "checked" : ""?> name="question-12-6-3[]" type="checkbox" value="Prospecção"/>
							<i class="form-icon"></i>
							<em>Prospecção</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Telemarketing", $r["question-12-6-4"]) ? "checked" : ""?> name="question-12-6-4[]" type="checkbox" value="Telemarketing"/>
							<i class="form-icon"></i>
							<em>Telemarketing</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Pós-venda", $r["question-12-6-5"]) ? "checked" : ""?> name="question-12-6-5[]" type="checkbox" value="Pós-venda"/>
							<i class="form-icon"></i>
							<em>Pós-venda</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Atendimento ao Cliente", $r["question-12-6-6"]) ? "checked" : ""?> name="question-12-6-6[]" type="checkbox" value="Atendimento ao Cliente"/>
							<i class="form-icon"></i>
							<em>Atendimento ao Cliente</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-12-6-7"]) ? "checked" : ""?> data-check="question-12-6-7-1" name="question-12-6-7[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-6-7-1" name="question-12-6-7-1" placeholder="Quais?" type="text" value="<?=$r["question-12-6-7-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-12-7-1"><strong>Jurídico</strong></label>
					<label class="form-label pl-2" for="question-12-7-1"><em>Civil</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Empresarial", $r["question-12-7-1"]) ? "checked" : ""?> id="question-12-7-1" name="question-12-7-1[]" type="checkbox" value="Empresarial"/>
							<i class="form-icon"></i>
							Empresarial
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Contratos", $r["question-12-7-1"]) ? "checked" : ""?> name="question-12-7-1[]" type="checkbox" value="Contratos"/>
							<i class="form-icon"></i>
							Contratos
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Regulatório", $r["question-12-7-1"]) ? "checked" : ""?> name="question-12-7-1[]" type="checkbox" value="Regulatório"/>
							<i class="form-icon"></i>
							Regulatório
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Internacional", $r["question-12-7-1"]) ? "checked" : ""?> name="question-12-7-1[]" type="checkbox" value="Internacional"/>
							<i class="form-icon"></i>
							Internacional
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Leasing de Aeronaves", $r["question-12-7-1"]) ? "checked" : ""?> name="question-12-7-1[]" type="checkbox" value="Leasing de Aeronaves"/>
							<i class="form-icon"></i>
							Leasing de Aeronaves
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Consumidor", $r["question-12-7-1"]) ? "checked" : ""?> name="question-12-7-1[]" type="checkbox" value="Consumidor"/>
							<i class="form-icon"></i>
							Consumidor
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-7-1"]) ? "checked" : ""?> data-check="question-12-7-1-1" name="question-12-7-1[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-7-1-1" name="question-12-7-1-1" placeholder="Quais?" type="text" value="<?=$r["question-12-7-1-1"]?>"/>
						</label>
					</div>
					<label class="form-label pl-2" for="question-12-7-2"><em>Tributário</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("ICMS", $r["question-12-7-2"]) ? "checked" : ""?> id="question-12-7-2" name="question-12-7-2[]" type="checkbox" value="ICMS"/>
							<i class="form-icon"></i>
							ICMS
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Internacional", $r["question-12-7-2"]) ? "checked" : ""?> name="question-12-7-2[]" type="checkbox" value="Internacional"/>
							<i class="form-icon"></i>
							Internacional
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-7-2"]) ? "checked" : ""?> data-check="question-12-7-2-1" name="question-12-7-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-7-2-1" name="question-12-7-2-1" placeholder="Quais?" type="text" value="<?=$r["question-12-7-2-1"]?>"/>
						</label>
					</div>
					<label class="form-label pl-2" for="question-12-7-3"><em>Penal</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-7-3"]) ? "checked" : ""?> data-check="question-12-7-3-1" id="question-12-7-3" name="question-12-7-3[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-7-3-1" name="question-12-7-3-1" placeholder="Quais?" type="text" value="<?=$r["question-12-7-3-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-12-8-1"><strong>TI</strong></label>
					<label class="form-label pl-2" for="question-12-8-1"><em>Linguagem</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("C", $r["question-12-8-1"]) ? "checked" : ""?> id="question-12-8-1" name="question-12-8-1[]" type="checkbox" value="C"/>
							<i class="form-icon"></i>
							C
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("C++", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="C++"/>
							<i class="form-icon"></i>
							C++
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("C#", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="C#"/>
							<i class="form-icon"></i>
							C#
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Python", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="Python"/>
							<i class="form-icon"></i>
							Python
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Node", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="Node"/>
							<i class="form-icon"></i>
							Node
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Java", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="Java"/>
							<i class="form-icon"></i>
							Java
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("JavaScript", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="JavaScript"/>
							<i class="form-icon"></i>
							JavaScript
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("React", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="React"/>
							<i class="form-icon"></i>
							React
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("React Native", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="React Native"/>
							<i class="form-icon"></i>
							React Native
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("PHP", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="PHP"/>
							<i class="form-icon"></i>
							PHP
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Ruby", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="Ruby"/>
							<i class="form-icon"></i>
							Ruby
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("CSS", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="CSS"/>
							<i class="form-icon"></i>
							CSS
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("TypeScript", $r["question-12-8-1"]) ? "checked" : ""?> name="question-12-8-1[]" type="checkbox" value="TypeScript"/>
							<i class="form-icon"></i>
							TypeScript
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-8-1"]) ? "checked" : ""?> data-check="question-12-8-1-1" name="question-12-8-1[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-8-1-1" name="question-12-8-1-1" placeholder="Quais?" type="text" value="<?=$r["question-12-8-1-1"]?>"/>
						</label>
					</div>
					<label class="form-label pl-2" for="question-12-8-2"><em>Banco de Dados</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Oracle", $r["question-12-8-2"]) ? "checked" : ""?> id="question-12-8-2" name="question-12-8-2[]" type="checkbox" value="Oracle"/>
							<i class="form-icon"></i>
							Oracle
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("SQL", $r["question-12-8-2"]) ? "checked" : ""?> name="question-12-8-2[]" type="checkbox" value="SQL"/>
							<i class="form-icon"></i>
							SQL
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("MySQL", $r["question-12-8-2"]) ? "checked" : ""?> name="question-12-8-2[]" type="checkbox" value="MySQL"/>
							<i class="form-icon"></i>
							MySQL
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("XML", $r["question-12-8-2"]) ? "checked" : ""?> name="question-12-8-2[]" type="checkbox" value="XML"/>
							<i class="form-icon"></i>
							XML
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-8-2"]) ? "checked" : ""?> data-check="question-12-8-2-1" name="question-12-8-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-8-2-1" name="question-12-8-2-1" placeholder="Quais?" type="text" value="<?=$r["question-12-8-2-1"]?>"/>
						</label>
					</div>
					<label class="form-label pl-2" for="question-12-8-3"><em>HelpDesk</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Suporte", $r["question-12-8-3"]) ? "checked" : ""?> id="question-12-8-3" name="question-12-8-3[]" type="checkbox" value="Suporte"/>
							<i class="form-icon"></i>
							Suporte
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Periféricos", $r["question-12-8-3"]) ? "checked" : ""?> name="question-12-8-3[]" type="checkbox" value="Periféricos"/>
							<i class="form-icon"></i>
							Periféricos
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Configuração", $r["question-12-8-3"]) ? "checked" : ""?> name="question-12-8-3[]" type="checkbox" value="Configuração"/>
							<i class="form-icon"></i>
							Configuração
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Redes", $r["question-12-8-4"]) ? "checked" : ""?> name="question-12-8-4[]" type="checkbox" value="Redes"/>
							<i class="form-icon"></i>
							<em>Redes</em>
						</label>
					</div>
					<label class="form-label pl-2" for="question-12-8-5"><em>Servidores</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("AWS", $r["question-12-8-5"]) ? "checked" : ""?> id="question-12-8-5" name="question-12-8-5[]" type="checkbox" value="AWS"/>
							<i class="form-icon"></i>
							AWS
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Web", $r["question-12-8-5"]) ? "checked" : ""?> name="question-12-8-5[]" type="checkbox" value="Web"/>
							<i class="form-icon"></i>
							Web
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Google", $r["question-12-8-5"]) ? "checked" : ""?> name="question-12-8-5[]" type="checkbox" value="Google"/>
							<i class="form-icon"></i>
							Google
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("IBM", $r["question-12-8-5"]) ? "checked" : ""?> name="question-12-8-5[]" type="checkbox" value="IBM"/>
							<i class="form-icon"></i>
							IBM
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-8-5"]) ? "checked" : ""?> data-check="question-12-8-5-1" name="question-12-8-5[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-8-5-1" name="question-12-8-5-1" placeholder="Quais?" type="text" value="<?=$r["question-12-8-5-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-12-9-1"><strong>Engenharia</strong></label>
					<label class="form-label pl-2" for="question-12-9-1"><em>Aeronáutica</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Materiais", $r["question-12-9-1"]) ? "checked" : ""?> id="question-12-9-1" name="question-12-9-1[]" type="checkbox" value="Materiais"/>
							<i class="form-icon"></i>
							Materiais
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Estruturas", $r["question-12-9-1"]) ? "checked" : ""?> name="question-12-9-1[]" type="checkbox" value="Estruturas"/>
							<i class="form-icon"></i>
							Estruturas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Manutenção", $r["question-12-9-1"]) ? "checked" : ""?> name="question-12-9-1[]" type="checkbox" value="Manutenção"/>
							<i class="form-icon"></i>
							Manutenção
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Aviônica", $r["question-12-9-1"]) ? "checked" : ""?> name="question-12-9-1[]" type="checkbox" value="Aviônica"/>
							<i class="form-icon"></i>
							Aviônica
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Projetos", $r["question-12-9-1"]) ? "checked" : ""?> name="question-12-9-1[]" type="checkbox" value="Projetos"/>
							<i class="form-icon"></i>
							Projetos
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Propulsão", $r["question-12-9-1"]) ? "checked" : ""?> name="question-12-9-1[]" type="checkbox" value="Propulsão"/>
							<i class="form-icon"></i>
							Propulsão
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Física", $r["question-12-9-1"]) ? "checked" : ""?> name="question-12-9-1[]" type="checkbox" value="Física"/>
							<i class="form-icon"></i>
							Física
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Aerodinâmica", $r["question-12-9-1"]) ? "checked" : ""?> name="question-12-9-1[]" type="checkbox" value="Aerodinâmica"/>
							<i class="form-icon"></i>
							Aerodinâmica
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Motores", $r["question-12-9-1"]) ? "checked" : ""?> name="question-12-9-1[]" type="checkbox" value="Motores"/>
							<i class="form-icon"></i>
							Motores
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-9-1"]) ? "checked" : ""?> data-check="question-12-9-1-1" name="question-12-9-1[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-9-1-1" name="question-12-9-1-1" placeholder="Quais?" type="text" value="<?=$r["question-12-9-1-1"]?>"/>
						</label>
					</div>
					<label class="form-label pl-2" for="question-12-9-2"><em>Mecânica</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Materiais", $r["question-12-9-2"]) ? "checked" : ""?> id="question-12-9-2" name="question-12-9-2[]" type="checkbox" value="Materiais"/>
							<i class="form-icon"></i>
							Materiais
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Estruturas", $r["question-12-9-2"]) ? "checked" : ""?> name="question-12-9-2[]" type="checkbox" value="Estruturas"/>
							<i class="form-icon"></i>
							Estruturas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Projetos", $r["question-12-9-2"]) ? "checked" : ""?> name="question-12-9-2[]" type="checkbox" value="Projetos"/>
							<i class="form-icon"></i>
							Projetos
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Dinâmica", $r["question-12-9-2"]) ? "checked" : ""?> name="question-12-9-2[]" type="checkbox" value="Dinâmica"/>
							<i class="form-icon"></i>
							Dinâmica
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-9-2"]) ? "checked" : ""?> data-check="question-12-9-2-1" name="question-12-9-2[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-9-2-1" name="question-12-9-2-1" placeholder="Quais?" type="text" value="<?=$r["question-12-9-2-1"]?>"/>
						</label>
					</div>
					<label class="form-label pl-2" for="question-12-9-3"><em>Civil</em></label>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Materiais", $r["question-12-9-3"]) ? "checked" : ""?> id="question-12-9-3" name="question-12-9-3[]" type="checkbox" value="Materiais"/>
							<i class="form-icon"></i>
							Materiais
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Estruturas", $r["question-12-9-3"]) ? "checked" : ""?> name="question-12-9-3[]" type="checkbox" value="Estruturas"/>
							<i class="form-icon"></i>
							Estruturas
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Projetos", $r["question-12-9-3"]) ? "checked" : ""?> name="question-12-9-3[]" type="checkbox" value="Projetos"/>
							<i class="form-icon"></i>
							Projetos
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox ml-2">
							<input <?=in_array("Outros", $r["question-12-9-3"]) ? "checked" : ""?> data-check="question-12-9-3-1" name="question-12-9-3[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-9-3-1" name="question-12-9-3-1" placeholder="Quais?" type="text" value="<?=$r["question-12-9-3-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-12-10"><strong>Administração</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Finanças", $r["question-12-10"]) ? "checked" : ""?> id="question-12-10" name="question-12-10[]" type="checkbox" value="Finanças"/>
							<i class="form-icon"></i>
							<em>Finanças</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Gestão", $r["question-12-10"]) ? "checked" : ""?> name="question-12-10[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							<em>Gestão</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Planejamento", $r["question-12-10"]) ? "checked" : ""?> name="question-12-10[]" type="checkbox" value="Planejamento"/>
							<i class="form-icon"></i>
							<em>Planejamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Projetos", $r["question-12-10"]) ? "checked" : ""?> name="question-12-10[]" type="checkbox" value="Projetos"/>
							<i class="form-icon"></i>
							<em>Projetos</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-12-10"]) ? "checked" : ""?> data-check="question-12-10-1" name="question-12-10[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-10-1" name="question-12-10-1" placeholder="Quais?" type="text" value="<?=$r["question-12-10-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-12-11"><strong>Recursos Humanos</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Comportamental", $r["question-12-11"]) ? "checked" : ""?> id="question-12-11" name="question-12-11[]" type="checkbox" value="Comportamental"/>
							<i class="form-icon"></i>
							<em>Comportamental</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Organizacional", $r["question-12-11"]) ? "checked" : ""?> name="question-12-11[]" type="checkbox" value="Organizacional"/>
							<i class="form-icon"></i>
							<em>Organizacional</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Desenvolvimento", $r["question-12-11"]) ? "checked" : ""?> name="question-12-11[]" type="checkbox" value="Desenvolvimento"/>
							<i class="form-icon"></i>
							<em>Desenvolvimento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Treinamento", $r["question-12-11"]) ? "checked" : ""?> name="question-12-11[]" type="checkbox" value="Treinamento"/>
							<i class="form-icon"></i>
							<em>Treinamento</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-12-11"]) ? "checked" : ""?> data-check="question-12-11-1" name="question-12-11[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-11-1" name="question-12-11-1" placeholder="Quais?" type="text" value="<?=$r["question-12-11-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="question-12-12"><strong>Treinamento</strong></label>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Operacional", $r["question-12-12"]) ? "checked" : ""?> id="question-12-12" name="question-12-12[]" type="checkbox" value="Operacional"/>
							<i class="form-icon"></i>
							<em>Operacional</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Gestão", $r["question-12-12"]) ? "checked" : ""?> name="question-12-12[]" type="checkbox" value="Gestão"/>
							<i class="form-icon"></i>
							<em>Gestão</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Manutenção", $r["question-12-12"]) ? "checked" : ""?> name="question-12-12[]" type="checkbox" value="Manutenção"/>
							<i class="form-icon"></i>
							<em>Manutenção</em>
						</label>
					</div>
					<div class="form-group pl-2">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-12-12"]) ? "checked" : ""?> data-check="question-12-12-1" name="question-12-12[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<em>Outros</em>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-12-1" name="question-12-12-1" placeholder="Quais?" type="text" value="<?=$r["question-12-12-1"]?>"/>
						</label>
					</div>

					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-12-13"]) ? "checked" : ""?> data-check="question-12-13-1" name="question-12-13[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							<strong>Outros</strong>
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-12-13-1" name="question-12-13-1" placeholder="Quais?" type="text" value="<?=$r["question-12-13-1"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-13">13. Algum desses treinamentos é certificado pelo Fabricante? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-13" name="question-13" placeholder="Algum desses treinamentos é certificado pelo Fabricante? Se sim, quais?" rows="2" style="resize: none;"><?=$r["question-13"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-14">14. Algum desses treinamentos é validado pela Autoridade da área de atuação? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-14" name="question-14" placeholder="Exemplo 1: Familiarização Airbus A320 com certificado reconhecido pela ANAC. &#10;Exemplo 2: Treinamento de Psicologia Organizacional validado pelo CFP." rows="2" style="resize: none;"><?=$r["question-14"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-15">15. Você possui treinamento em alguma ferramenta específica para realização de tarefas na função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-15" name="question-15" placeholder="Você possui treinamento em alguma ferramenta específica para realização de tarefas na função?" rows="2" style="resize: none;"><?=$r["question-15"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-16">16. Você já utilizou os conhecimentos adquiridos nesse(s) treinamento(s) na realização de tarefas na função? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-16" name="question-16" placeholder="Você já utilizou os conhecimentos adquiridos nesse(s) treinamento(s) na realização de tarefas na função? Se sim, quais?" rows="2" style="resize: none;"><?=$r["question-16"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-17">17. Qual o treinamento você considera de maior relevância para a função? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-17" name="question-17" placeholder="Qual o treinamento você considera de maior relevância para a função? Por quê?" rows="2" style="resize: none;"><?=$r["question-17"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-18">18. Você planeja fazer mais algum treinamento no futuro? Se sim, quais? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-18" name="question-18" placeholder="Você planeja fazer mais algum treinamento no futuro? Se sim, quais? Por quê?" rows="2" style="resize: none;"><?=$r["question-18"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-19">19. Na sua opinião, em quais aspectos o treinamento que você quer fazer, lhe ajudaria no desenvolvimento da sua carreira?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-19" name="question-19" placeholder="Na sua opinião, em quais aspectos o treinamento que você quer fazer, lhe ajudaria no desenvolvimento da sua carreira?" rows="2" style="resize: none;"><?=$r["question-19"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-20">20. Qual treinamento que você já fez você considera que foi menos proveitoso para a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-20" name="question-20" placeholder="Qual treinamento que você já fez você considera que foi menos proveitoso para a função?" rows="2" style="resize: none;"><?=$r["question-20"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-21">21. Qual treinamento você considera que precisa fazer para dar o próximo passo na sua carreira?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-21" name="question-21" placeholder="Qual treinamento você considera que precisa fazer para dar o próximo passo na sua carreira?" rows="2" style="resize: none;"><?=$r["question-21"]?></textarea>
				</div>
			</div>

			<div class="divider text-center" data-content="Relacionamento técnico com fornecedores, fabricantes, oficinas, contatos em geral na indústria aeronáutica"></div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-22">22. Você possui contatos com os quais mantém relacionamento nas seguintes áreas?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Passageiros", $r["question-22"]) ? "checked" : ""?> id="question-22" name="question-22[]" type="checkbox" value="Empresas de Transporte Aéreo de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Cargas", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Transporte Aéreo de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Passageiros", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Serviços Auxiliares de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Cargas", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Serviços Auxiliares de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Aeroportos", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Aeroportos"/>
							<i class="form-icon"></i>
							Aeroportos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Aeronaves", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Fabricantes de Aeronaves"/>
							<i class="form-icon"></i>
							Fabricantes de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Motores", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Fabricantes de Motores"/>
							<i class="form-icon"></i>
							Fabricantes de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Componentes", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Fabricantes de Componentes"/>
							<i class="form-icon"></i>
							Fabricantes de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Químicos", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Fabricantes de Químicos"/>
							<i class="form-icon"></i>
							Fabricantes de Químicos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Ferramentas", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Fabricantes de Ferramentas"/>
							<i class="form-icon"></i>
							Fabricantes de Ferramentas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Distribuidores de Partes e Componentes", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Distribuidores de Partes e Componentes"/>
							<i class="form-icon"></i>
							Distribuidores de Partes e Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Aeronaves", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Manutenção de Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Motores", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Manutenção de Motores"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Componentes", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Manutenção de Componentes"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Equipamentos Auxiliares", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Manutenção de Equipamentos Auxiliares"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Equipamentos Auxiliares
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Ferramentas", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Manutenção de Ferramentas"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Ferramentas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Aeronaves", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Operações de Aeronaves", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Operações de Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Operações de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Operações de Aeroportos", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Operações de Aeroportos"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Operações de Aeroportos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Operações de Solo", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Operações de Solo"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Operações de Solo
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Operações de Voo", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Operações de Voo"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Operações de Voo
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Indústria Aeronáutica", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Indústria Aeronáutica"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Indústria Aeronáutica
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Manutenção de Aeronaves", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Manutenção de Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Manutenção de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Manutenção de Motores", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Manutenção de Motores"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Manutenção de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Manutenção de Componentes", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Manutenção de Componentes"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Manutenção de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Soluções Tecnológicas para Manutenção de Ferramentas", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Empresas de Soluções Tecnológicas para Manutenção de Ferramentas"/>
							<i class="form-icon"></i>
							Empresas de Soluções Tecnológicas para Manutenção de Ferramentas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Ministério da Defesa do Brasil", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Ministério da Defesa do Brasil"/>
							<i class="form-icon"></i>
							Ministério da Defesa do Brasil
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Força Aérea Brasileira", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Força Aérea Brasileira"/>
							<i class="form-icon"></i>
							Força Aérea Brasileira
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Marinha do Brasil", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Marinha do Brasil"/>
							<i class="form-icon"></i>
							Marinha do Brasil
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Exército Brasileiro", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Exército Brasileiro"/>
							<i class="form-icon"></i>
							Exército Brasileiro
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Forças Armadas Estrangeiras", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Forças Armadas Estrangeiras"/>
							<i class="form-icon"></i>
							Forças Armadas Estrangeiras
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Organizações Governamentais", $r["question-22"]) ? "checked" : ""?> name="question-22[]" type="checkbox" value="Organizações Governamentais"/>
							<i class="form-icon"></i>
							Organizações Governamentais
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-22"]) ? "checked" : ""?> data-check="question-22-1" name="question-22[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-22-1" name="question-22-1" placeholder="Quais?" type="text" value="<?=$r["question-22-1"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-23">23. Qual seu nível de relacionamento com as empresas citadas acima?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-23" name="question-23" placeholder="Exemplo: Presidência, Diretoria, Gerência, Coordenação, etc." rows="2" style="resize: none;"><?=$r["question-23"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-24">24. Em quais setores das empresas citadas acima você possui relacionamento?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Administração", $r["question-24"]) ? "checked" : ""?> id="question-24" name="question-24[]" type="checkbox" value="Administração"/>
							<i class="form-icon"></i>
							Administração
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Contabilidade", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Contabilidade"/>
							<i class="form-icon"></i>
							Contabilidade
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Recursos Humanos", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Recursos Humanos"/>
							<i class="form-icon"></i>
							Recursos Humanos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Compras", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Compras"/>
							<i class="form-icon"></i>
							Compras
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Logística", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Logística"/>
							<i class="form-icon"></i>
							Logística
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Suprimentos Técnicos", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Suprimentos Técnicos"/>
							<i class="form-icon"></i>
							Suprimentos Técnicos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Comércio Exterior", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Comércio Exterior"/>
							<i class="form-icon"></i>
							Comércio Exterior
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Financeiro", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Financeiro"/>
							<i class="form-icon"></i>
							Financeiro
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Atendimento Aeroportuário/Apoio de solo", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Atendimento Aeroportuário/Apoio de solo"/>
							<i class="form-icon"></i>
							Atendimento Aeroportuário/Apoio de solo
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Comercial e Vendas", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Comercial e Vendas"/>
							<i class="form-icon"></i>
							Comercial e Vendas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Marketing", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Marketing"/>
							<i class="form-icon"></i>
							Marketing
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("TI", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="TI"/>
							<i class="form-icon"></i>
							TI
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Segurança Operacional", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Segurança Operacional"/>
							<i class="form-icon"></i>
							Segurança Operacional
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Operações", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Operações"/>
							<i class="form-icon"></i>
							Operações
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Engenharia", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Engenharia"/>
							<i class="form-icon"></i>
							Engenharia
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Treinamento", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Treinamento"/>
							<i class="form-icon"></i>
							Treinamento
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Qualidade", $r["question-24"]) ? "checked" : ""?> name="question-24[]" type="checkbox" value="Qualidade"/>
							<i class="form-icon"></i>
							Qualidade
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["question-24"]) ? "checked" : ""?> data-check="question-24-1" name="question-24[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="question-24-1" name="question-24-1" placeholder="Quais?" type="text" value="<?=$r["question-24-1"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-25">25. Quais desses contatos você considera mais importantes para a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-25" name="question-25" placeholder="Quais desses contatos você considera mais importantes para a função?" rows="2" style="resize: none;"><?=$r["question-25"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-26">26. Descreva seu nível de relacionamentos com os contatos citados no item 25:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-26" name="question-26" placeholder="Descreva seu nível de relacionamentos com os contatos citados no item 25" rows="2" style="resize: none;"><?=$r["question-26"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-27">27. Esses contatos podem fornecer boas referências a seu respeito? Se sim informe nome e contato.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-27" name="question-27" placeholder="Esses contatos podem fornecer boas referências a seu respeito? Se sim informe nome e contato." rows="2" style="resize: none;"><?=$r["question-27"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-28">28. Em qual área da aviação você julga ter o melhor nível de relacionamento?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-28" name="question-28" placeholder="Em qual área da aviação você julga ter o melhor nível de relacionamento?" rows="2" style="resize: none;"><?=$r["question-28"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-29">29. Quais características profissionais você acredita que esses contatos poderiam citar a seu respeito?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-29" name="question-29" placeholder="Quais características profissionais você acredita que esses contatos poderiam citar a seu respeito?" rows="2" style="resize: none;"><?=$r["question-29"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-30">30. Você já teve ou possui atualmente algum atrito, divergência ou disputa judicial com alguma empresa ligada a Aviação? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-30" name="question-30" placeholder="Você já teve ou possui atualmente algum atrito, divergência ou disputa judicial com alguma empresa ligada a Aviação? Se sim, quais?" rows="3" style="resize: none;"><?=$r["question-30"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="question-31">31. Você já teve algum conflito de maior proporção com alguma pessoa ligada a aviação que poderia influenciar sua carreira em alguma empresa da aviação? Se sim, quais?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="question-31" name="question-31" placeholder="Você já teve algum conflito de maior proporção com alguma pessoa ligada a aviação que poderia influenciar sua carreira em alguma empresa da aviação? Se sim, quais?" rows="4" style="resize: none;"><?=$r["question-31"]?></textarea>
				</div>
			</div>

			<div class="text-right">
				<input class="btn btn-green btn-lg" type="submit" value="Próximo"/>
			</div>
		</form>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

	<script>
		$(document).ready(function() {
			// DESABILITAR CAMPOS DE TEXTOS NÃO SELECIONADOS
			$("input[data-check*='question']:not(:checked)").each(function(i) {
				$("input[id='" + $(this).data("check") + "']").prop("disabled", true);
			});

			// HABILITAR O CAMPO DE MUDANÇA DE META
			$("input[data-check*='question']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[id='" + $(this).data("check") + "']").prop("disabled", false);
				else {
					$("input[id='" + $(this).data("check") + "']").prop("disabled", true);
					$("input[id='" + $(this).data("check") + "']").val("");
				}
			});
		});
	</script>

</body>

</html>
