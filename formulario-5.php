<?php

require_once("php/util.php");

// Páginas acessíveis de encaminhamento
$paginas = [HOST . "formulario-0.php", HOST . "formulario-1.php", HOST . "formulario-2.php", HOST . "formulario-3.php", HOST . "formulario-4.php", HOST . "formulario-6.php"];

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
	$campos = ["pergunta-1", "pergunta-2", "pergunta-3", "pergunta-4", "pergunta-4-1", "pergunta-5", "pergunta-6", "pergunta-7", "pergunta-8", "pergunta-9", "pergunta-10", "pergunta-11", "pergunta-12", "pergunta-13", "pergunta-13-1", "pergunta-14", "pergunta-15-1", "pergunta-15-1-1", "pergunta-15-2", "pergunta-15-2-1", "pergunta-15-3", "pergunta-15-3-1", "pergunta-15-3-2", "pergunta-15-3-3", "pergunta-15-3-4", "pergunta-16-1-1", "pergunta-16-1-2", "pergunta-16-1-3", "pergunta-16-1-4", "pergunta-16-1-5", "pergunta-16-2-1", "pergunta-16-2-2", "pergunta-16-2-3", "pergunta-16-2-4", "pergunta-16-2-5", "pergunta-16-2-6", "pergunta-16-2-7", "pergunta-16-3-1", "pergunta-16-3-2", "pergunta-16-3-3", "pergunta-16-3-4", "pergunta-16-3-5", "pergunta-16-3-6", "pergunta-16-4-1", "pergunta-16-4-2", "pergunta-16-4-3", "pergunta-16-4-4", "pergunta-16-4-5", "pergunta-16-4-6", "pergunta-16-4-7", "pergunta-16-4-8", "pergunta-16-4-9", "pergunta-16-4-10", "pergunta-16-5-1", "pergunta-16-5-2", "pergunta-16-5-3", "pergunta-16-5-4", "pergunta-16-5-5", "pergunta-16-6-1", "pergunta-16-6-2", "pergunta-16-6-3", "pergunta-16-6-4", "pergunta-16-6-5", "pergunta-16-6-6", "pergunta-16-6-7", "pergunta-16-6-8", "pergunta-16-6-9", "pergunta-16-6-10", "pergunta-16-6-11", "pergunta-16-6-12", "pergunta-16-6-13", "pergunta-17", "pergunta-18", "pergunta-19", "pergunta-19-1", "pergunta-20", "pergunta-21"];
	$consulta = mysql("select resposta from formularios where modulo=5 and usuario=" . $_SESSION["id"] . ";");

	$vetor = [];
	for($i = 0; $i < 77; $i++)
		array_push($vetor, "");

	$respostas = $consulta ? explode("|$*|", $consulta["resposta"]) : $vetor;
	$r = [];

	// Deixa os dados esteticamente bonitos
	foreach($campos as $indice => $campo)
		$r[$campo] = $respostas[$indice];

	// Obtém os valores a partir dos SELECTS das perguntas 3, 7, 15
	$r["pergunta-3"] = explode("||", $r["pergunta-3"]);
	$r["pergunta-7"] = explode("||", $r["pergunta-7"]);
	$r["pergunta-15-1"] = explode("||", $r["pergunta-15-1"]);
	$r["pergunta-15-2"] = explode("||", $r["pergunta-15-2"]);
	$r["pergunta-15-3"] = explode("||", $r["pergunta-15-3"]);
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
	<title>AirTalent - Avaliação técnica (Experiências anteriores)</title>
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
				<a data-anchor="formulario-3.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Conhecimento técnico específico</a>
			</li>
			<li class="tab-item">
				<a data-anchor="formulario-4.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Segurança operacional</a>
			</li>
			<li class="tab-item">
				<a class="active" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Experiências anteriores</a>
			</li>
			<li class="tab-item text-gray">
				<a data-anchor="formulario-6.php" href="#"><span style="font-size: 10px;">NÍVEL DE INGLÊS</span><br/>Inglês intermediário</a>
			</li>
		</ul>
	</div>

	<div class="container grid-lg">
		<div class="pt-2 text-center" style="color: #195596;">
			<h1 class="mt-2">Avaliação técnica</h1>
			<h3>Experiências anteriores</h3>
		</div>

		<form action="php/formulario-5.php" class="form-horizontal" method="post">
			<div class="divider"></div>
			<h5 class="text-center">Funções e cargos de relevância</h5>
			<div class="divider"></div>
			<!--<div class="divider text-center" data-content="Funções e cargos de relevância"></div>-->

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-1">1. Cite as empresas e período trabalhado em cada uma de suas experiências anteriores:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-1" name="pergunta-1" placeholder="Cite as empresas e período trabalhado em cada uma de suas experiências anteriores" rows="2" style="resize: none;"><?=$r["pergunta-1"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-2">2. Nas experiências anteriores, cite o cenário encontrado quando chegou na empresa e como você trabalhou para melhorar o que encontrou?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-2" name="pergunta-2" placeholder="Nas experiências anteriores, cite o cenário encontrado quando chegou na empresa e como você trabalhou para melhorar o que encontrou?" rows="3" style="resize: none;"><?=$r["pergunta-2"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-3">3. Em quais tipos de empresa você já desempenhou tarefas relativas a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Aeroportos", $r["pergunta-3"]) ? "checked" : ""?> id="pergunta-3" name="pergunta-3[]" type="checkbox" value="Aeroportos"/>
							<i class="form-icon"></i>
							Aeroportos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Passageiros", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Empresas de Transporte Aéreo de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Transporte Aéreo de Cargas", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Empresas de Transporte Aéreo de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Transporte Aéreo de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Passageiros", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Empresas de Serviços Auxiliares de Passageiros"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Serviços Auxiliares de Cargas", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Empresas de Serviços Auxiliares de Cargas"/>
							<i class="form-icon"></i>
							Empresas de Serviços Auxiliares de Cargas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Aeronaves", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Fabricantes de Aeronaves"/>
							<i class="form-icon"></i>
							Fabricantes de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Motores", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Fabricantes de Motores"/>
							<i class="form-icon"></i>
							Fabricantes de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Componentes", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Fabricantes de Componentes"/>
							<i class="form-icon"></i>
							Fabricantes de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Químicos", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Fabricantes de Químicos"/>
							<i class="form-icon"></i>
							Fabricantes de Químicos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Fabricantes de Ferramentas", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Fabricantes de Ferramentas"/>
							<i class="form-icon"></i>
							Fabricantes de Ferramentas
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Distribuidores de Partes e Componentes", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Distribuidores de Partes e Componentes"/>
							<i class="form-icon"></i>
							Distribuidores de Partes e Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Aeronaves", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Empresas de Manutenção de Aeronaves"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Aeronaves
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Motores", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Empresas de Manutenção de Motores"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Motores
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Componentes", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Empresas de Manutenção de Componentes"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Componentes
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Equipamentos Auxiliares", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Empresas de Manutenção de Equipamentos Auxiliares"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Equipamentos Auxiliares
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Empresas de Manutenção de Ferramentas", $r["pergunta-3"]) ? "checked" : ""?> name="pergunta-3[]" type="checkbox" value="Empresas de Manutenção de Ferramentas"/>
							<i class="form-icon"></i>
							Empresas de Manutenção de Ferramentas
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-4">4. Você já trabalhou em mais de uma empresa ou cargo relativo a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-4"] == "Não" ? "checked" : ""?> id="pergunta-4" name="pergunta-4" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-4"] == "Sim" ? "checked" : ""?> name="pergunta-4" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, quais?
					</label>
					<input class="form-input" id="pergunta-4-1-disabled" name="pergunta-4-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-4-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-5">5. Em qual nível você já trabalhou na função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-radio">
						<input <?=$r["pergunta-5"] == "Estágio" ? "checked" : ""?> id="pergunta-5" name="pergunta-5" type="radio" value="Estágio"/>
						<i class="form-icon"></i>
						Estágio
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-5"] == "Trainee" ? "checked" : ""?> name="pergunta-5" type="radio" value="Trainee"/>
						<i class="form-icon"></i>
						Trainee
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-5"] == "Junior" ? "checked" : ""?> name="pergunta-5" type="radio" value="Junior"/>
						<i class="form-icon"></i>
						Junior
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-5"] == "Pleno" ? "checked" : ""?> name="pergunta-5" type="radio" value="Pleno"/>
						<i class="form-icon"></i>
						Pleno
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-5"] == "Sênior" ? "checked" : ""?> name="pergunta-5" type="radio" value="Sênior"/>
						<i class="form-icon"></i>
						Sênior
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-5"] == "Supervisão" ? "checked" : ""?> name="pergunta-5" type="radio" value="Supervisão"/>
						<i class="form-icon"></i>
						Supervisão
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-5"] == "Coordenação" ? "checked" : ""?> name="pergunta-5" type="radio" value="Coordenação"/>
						<i class="form-icon"></i>
						Coordenação
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-5"] == "Gerência" ? "checked" : ""?> name="pergunta-5" type="radio" value="Gerência"/>
						<i class="form-icon"></i>
						Gerência
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-5"] == "Diretoria" ? "checked" : ""?> name="pergunta-5" type="radio" value="Diretoria"/>
						<i class="form-icon"></i>
						Diretoria
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-5"] == "Presidência" ? "checked" : ""?> name="pergunta-5" type="radio" value="Presidência"/>
						<i class="form-icon"></i>
						Presidência
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-6">6. Em qual nível você já desempenhou tarefas relativas a função indiretamente?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-radio">
						<input <?=$r["pergunta-6"] == "Estágio" ? "checked" : ""?> id="pergunta-6" name="pergunta-6" type="radio" value="Estágio"/>
						<i class="form-icon"></i>
						Estágio
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-6"] == "Trainee" ? "checked" : ""?> name="pergunta-6" type="radio" value="Trainee"/>
						<i class="form-icon"></i>
						Trainee
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-6"] == "Junior" ? "checked" : ""?> name="pergunta-6" type="radio" value="Junior"/>
						<i class="form-icon"></i>
						Junior
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-6"] == "Pleno" ? "checked" : ""?> name="pergunta-6" type="radio" value="Pleno"/>
						<i class="form-icon"></i>
						Pleno
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-6"] == "Sênior" ? "checked" : ""?> name="pergunta-6" type="radio" value="Sênior"/>
						<i class="form-icon"></i>
						Sênior
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-6"] == "Supervisão" ? "checked" : ""?> name="pergunta-6" type="radio" value="Supervisão"/>
						<i class="form-icon"></i>
						Supervisão
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-6"] == "Coordenação" ? "checked" : ""?> name="pergunta-6" type="radio" value="Coordenação"/>
						<i class="form-icon"></i>
						Coordenação
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-6"] == "Gerência" ? "checked" : ""?> name="pergunta-6" type="radio" value="Gerência"/>
						<i class="form-icon"></i>
						Gerência
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-6"] == "Diretoria" ? "checked" : ""?> name="pergunta-6" type="radio" value="Diretoria"/>
						<i class="form-icon"></i>
						Diretoria
					</label>
					<label class="form-radio">
						<input <?=$r["pergunta-6"] == "Presidência" ? "checked" : ""?> name="pergunta-6" type="radio" value="Presidência"/>
						<i class="form-icon"></i>
						Presidência
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-7">7. Quais setores internos da empresa você teve relacionamento ao longo de sua carreira? (mais de uma alternativa pode ser marcada)</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Comercial", $r["pergunta-7"]) ? "checked" : ""?> id="pergunta-7" name="pergunta-7[]" type="checkbox" value="Comercial"/>
							<i class="form-icon"></i>
							Comercial
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Compras/suprimentos", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Compras/suprimentos"/>
							<i class="form-icon"></i>
							Compras/suprimentos
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Marketing", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Marketing"/>
							<i class="form-icon"></i>
							Marketing
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("RH", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="RH"/>
							<i class="form-icon"></i>
							RH
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Engenharia", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Engenharia"/>
							<i class="form-icon"></i>
							Engenharia
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Manutenção", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Manutenção"/>
							<i class="form-icon"></i>
							Manutenção
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Operações (Tripulação)", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Operações (Tripulação)"/>
							<i class="form-icon"></i>
							Operações (Tripulação)
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Atendimento aeroportuário (Ground Handling)", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Atendimento aeroportuário (Ground Handling)"/>
							<i class="form-icon"></i>
							Atendimento aeroportuário (Ground Handling)
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Cliente externo e/ou passageiros", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Cliente externo e/ou passageiros"/>
							<i class="form-icon"></i>
							Cliente externo e/ou passageiros
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Qualidade", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Qualidade"/>
							<i class="form-icon"></i>
							Qualidade
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Segurança Operacional (Safety)", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Segurança Operacional (Safety)"/>
							<i class="form-icon"></i>
							Segurança Operacional (Safety)
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Segurança patrimonial (Security)", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Segurança patrimonial (Security)"/>
							<i class="form-icon"></i>
							Segurança patrimonial (Security)
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Jurídico", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Jurídico"/>
							<i class="form-icon"></i>
							Jurídico
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Financeiro", $r["pergunta-7"]) ? "checked" : ""?> name="pergunta-7[]" type="checkbox" value="Financeiro"/>
							<i class="form-icon"></i>
							Financeiro
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-8">8. Qual o maior desafio que você enfrentou na construção de sua carreira?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-8" name="pergunta-8" placeholder="Qual o maior desafio que você enfrentou na construção de sua carreira?" rows="2" style="resize: none;"><?=$r["pergunta-8"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-9">9. Qual o maior desafio profissional que você enfrentou desempenhando a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-9" name="pergunta-9" placeholder="Qual o maior desafio profissional que você enfrentou desempenhando a função?" rows="2" style="resize: none;"><?=$r["pergunta-9"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-10">10. Qual foi sua maior conquista profissional desempenhando a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-10" name="pergunta-10" placeholder="Qual foi sua maior conquista profissional desempenhando a função?" rows="2" style="resize: none;"><?=$r["pergunta-10"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-11">11. Qual foi a melhor empresa que você já trabalhou? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-11" name="pergunta-11" placeholder="Qual foi a melhor empresa que você já trabalhou? Por quê?" rows="2" style="resize: none;"><?=$r["pergunta-11"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-12">12. Qual foi a pior empresa que você trabalhou? Por quê?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-12" name="pergunta-12" placeholder="Qual foi a pior empresa que você trabalhou? Por quê?" rows="2" style="resize: none;"><?=$r["pergunta-12"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-13">13. Você já teve algum chefe/gerente que considerasse tóxico?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-13"] == "Não" ? "checked" : ""?> id="pergunta-13" name="pergunta-13" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-13"] == "Sim" ? "checked" : ""?> name="pergunta-13" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, conte-nos sobre isso sem mencionar o nome da pessoa.
					</label>
					<input class="form-input" id="pergunta-13-1-disabled" name="pergunta-13-1" placeholder="Conte-nos sobre isso sem mencionar o nome da pessoa." type="text" value="<?=$r["pergunta-13-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-14">14. Qual foi a pessoa que mais influenciou sua carreira positivamente dentro de uma empresa?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-14" name="pergunta-14" placeholder="Qual foi a pessoa que mais influenciou sua carreira positivamente dentro de uma empresa?" rows="2" style="resize: none;"><?=$r["pergunta-14"]?></textarea>
				</div>
			</div>

			<div class="divider"></div>
			<h5 class="text-center">Conhecimento adquirido (competências específicas e gerais)</h5>
			<div class="divider"></div>
			<!--<div class="divider text-center" data-content="Conhecimento adquirido (competências específicas e gerais)"></div>-->

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-15-1">15. Com quais tipos de aeronaves você já desempenhou tarefas relativas a função?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-15-1"><strong>Aeronaves</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Airbus 320", $r["pergunta-15-1"]) ? "checked" : ""?> id="pergunta-15-1" name="pergunta-15-1[]" type="checkbox" value="Airbus 320"/>
							<i class="form-icon"></i>
							Airbus 320
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Airbus 330", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Airbus 330"/>
							<i class="form-icon"></i>
							Airbus 330
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Airbus 340", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Airbus 340"/>
							<i class="form-icon"></i>
							Airbus 340
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Airbus 380", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Airbus 380"/>
							<i class="form-icon"></i>
							Airbus 380
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("ATR 42/72 – 200/300/500", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="ATR 42/72 – 200/300/500"/>
							<i class="form-icon"></i>
							ATR 42/72 – 200/300/500
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("ATR 42/72 – 600", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="ATR 42/72 – 600"/>
							<i class="form-icon"></i>
							ATR 42/72 – 600
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 737CL", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Boeing 737CL"/>
							<i class="form-icon"></i>
							Boeing 737CL
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 737NG", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Boeing 737NG"/>
							<i class="form-icon"></i>
							Boeing 737NG
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 747", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Boeing 747"/>
							<i class="form-icon"></i>
							Boeing 747
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 757", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Boeing 757"/>
							<i class="form-icon"></i>
							Boeing 757
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 767", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Boeing 767"/>
							<i class="form-icon"></i>
							Boeing 767
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 777", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Boeing 777"/>
							<i class="form-icon"></i>
							Boeing 777
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Boeing 787", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Boeing 787"/>
							<i class="form-icon"></i>
							Boeing 787
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Dash8", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Dash8"/>
							<i class="form-icon"></i>
							Dash8
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Embraer 110", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Embraer 110"/>
							<i class="form-icon"></i>
							Embraer 110
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Embraer 120", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Embraer 120"/>
							<i class="form-icon"></i>
							Embraer 120
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Embraer 135/145", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Embraer 135/145"/>
							<i class="form-icon"></i>
							Embraer 135/145
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Embraer E1", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Embraer E1"/>
							<i class="form-icon"></i>
							Embraer E1
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Embraer E2", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Embraer E2"/>
							<i class="form-icon"></i>
							Embraer E2
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Pilatus PC12", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Pilatus PC12"/>
							<i class="form-icon"></i>
							Pilatus PC12
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Cessna Caravan", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Cessna Caravan"/>
							<i class="form-icon"></i>
							Cessna Caravan
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Sikorsky S76", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Sikorsky S76"/>
							<i class="form-icon"></i>
							Sikorsky S76
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Sikorsky S92", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Sikorsky S92"/>
							<i class="form-icon"></i>
							Sikorsky S92
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Sikorsky Blackhawk", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Sikorsky Blackhawk"/>
							<i class="form-icon"></i>
							Sikorsky Blackhawk
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Mil Mi 35 - Sabre", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Mil Mi 35 - Sabre"/>
							<i class="form-icon"></i>
							Mil Mi 35 - Sabre
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 206", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Bell 206"/>
							<i class="form-icon"></i>
							Bell 206
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 406", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Bell 406"/>
							<i class="form-icon"></i>
							Bell 406
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 212", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Bell 212"/>
							<i class="form-icon"></i>
							Bell 212
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 412", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Bell 412"/>
							<i class="form-icon"></i>
							Bell 412
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 429", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Bell 429"/>
							<i class="form-icon"></i>
							Bell 429
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 407", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Bell 407"/>
							<i class="form-icon"></i>
							Bell 407
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Bell 430", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Bell 430"/>
							<i class="form-icon"></i>
							Bell 430
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Agusta A 109", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Agusta A 109"/>
							<i class="form-icon"></i>
							Agusta A 109
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Agusta A 129", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Agusta A 129"/>
							<i class="form-icon"></i>
							Agusta A 129
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Agusta AW139", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Agusta AW139"/>
							<i class="form-icon"></i>
							Agusta AW139
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Agusta AW 169", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Agusta AW 169"/>
							<i class="form-icon"></i>
							Agusta AW 169
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter Tiger", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Eurocopter Tiger"/>
							<i class="form-icon"></i>
							Eurocopter Tiger
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter EC-155", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Eurocopter EC-155"/>
							<i class="form-icon"></i>
							Eurocopter EC-155
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter EC-725", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Eurocopter EC-725"/>
							<i class="form-icon"></i>
							Eurocopter EC-725
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter AS350", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Eurocopter AS350"/>
							<i class="form-icon"></i>
							Eurocopter AS350
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter AS350 B2", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Eurocopter AS350 B2"/>
							<i class="form-icon"></i>
							Eurocopter AS350 B2
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter EC120", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Eurocopter EC120"/>
							<i class="form-icon"></i>
							Eurocopter EC120
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter Super Puma", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Eurocopter Super Puma"/>
							<i class="form-icon"></i>
							Eurocopter Super Puma
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter H145", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Eurocopter H145"/>
							<i class="form-icon"></i>
							Eurocopter H145
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Eurocopter Cougar", $r["pergunta-15-1"]) ? "checked" : ""?> name="pergunta-15-1[]" type="checkbox" value="Eurocopter Cougar"/>
							<i class="form-icon"></i>
							Eurocopter Cougar
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros procedimentos", $r["pergunta-15-1"]) ? "checked" : ""?> id="pergunta-15-1-other" name="pergunta-15-1[]" type="checkbox" value="Outros procedimentos"/>
							<i class="form-icon"></i>
							Outros procedimentos
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-15-1-1" name="pergunta-15-1-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-15-1-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-15-2"><strong>Motores</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Lycoming", $r["pergunta-15-2"]) ? "checked" : ""?> id="pergunta-15-2" name="pergunta-15-2[]" type="checkbox" value="Lycoming"/>
							<i class="form-icon"></i>
							Lycoming
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Continental", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="Continental"/>
							<i class="form-icon"></i>
							Continental
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PT6", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="PT6"/>
							<i class="form-icon"></i>
							PT6
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PW100", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="PW100"/>
							<i class="form-icon"></i>
							PW100
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CFM56", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="CFM56"/>
							<i class="form-icon"></i>
							CFM56
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CF6", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="CF6"/>
							<i class="form-icon"></i>
							CF6
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("RR Trent", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="RR Trent"/>
							<i class="form-icon"></i>
							RR Trent
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("RR 300", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="RR 300"/>
							<i class="form-icon"></i>
							RR 300
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("R 250", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="R 250"/>
							<i class="form-icon"></i>
							R 250
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("GE90/9X", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="GE90/9X"/>
							<i class="form-icon"></i>
							GE90/9X
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("GEnx", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="GEnx"/>
							<i class="form-icon"></i>
							GEnx
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("LEAP", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="LEAP"/>
							<i class="form-icon"></i>
							LEAP
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("CF34", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="CF34"/>
							<i class="form-icon"></i>
							CF34
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("JT8", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="JT8"/>
							<i class="form-icon"></i>
							JT8
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("JT15", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="JT15"/>
							<i class="form-icon"></i>
							JT15
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("TPE", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="TPE"/>
							<i class="form-icon"></i>
							TPE
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("TFE", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="TFE"/>
							<i class="form-icon"></i>
							TFE
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("RB211", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="RB211"/>
							<i class="form-icon"></i>
							RB211
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("LM2500", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="LM2500"/>
							<i class="form-icon"></i>
							LM2500
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("V2500", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="V2500"/>
							<i class="form-icon"></i>
							V2500
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("T700", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="T700"/>
							<i class="form-icon"></i>
							T700
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PW1000", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="PW1000"/>
							<i class="form-icon"></i>
							PW1000
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PW4000", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="PW4000"/>
							<i class="form-icon"></i>
							PW4000
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("PW300/500", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="PW300/500"/>
							<i class="form-icon"></i>
							PW300/500
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("T56", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="T56"/>
							<i class="form-icon"></i>
							T56
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("H80", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="H80"/>
							<i class="form-icon"></i>
							H80
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Turbomeca", $r["pergunta-15-2"]) ? "checked" : ""?> name="pergunta-15-2[]" type="checkbox" value="Turbomeca"/>
							<i class="form-icon"></i>
							Turbomeca
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros procedimentos", $r["pergunta-15-2"]) ? "checked" : ""?> id="pergunta-15-2-other" name="pergunta-15-2[]" type="checkbox" value="Outros procedimentos"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-15-2-1" name="pergunta-15-2-1" placeholder="Quais?" type="text" value="<?=$r["pergunta-15-2-1"]?>"/>
						</label>
					</div>

					<label class="form-label" for="pergunta-15-3"><strong>Marque os aviônicos que tem mais familiarização ou já equiparam aeronaves que operou/trabalhou:</strong></label>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Rockwell Collins", $r["pergunta-15-3"]) ? "checked" : ""?> id="pergunta-15-3" name="pergunta-15-3[]" type="checkbox" value="Rockwell Collins"/>
							<i class="form-icon"></i>
							Rockwell Collins
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-15-3-1" name="pergunta-15-3-1" placeholder="Cite modelos" type="text" value="<?=$r["pergunta-15-3-1"]?>"/>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Honeywell", $r["pergunta-15-3"]) ? "checked" : ""?> id="pergunta-15-3-honeywell" name="pergunta-15-3[]" type="checkbox" value="Honeywell"/>
							<i class="form-icon"></i>
							Honeywell
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-15-3-2" name="pergunta-15-3-2" placeholder="Cite modelos" type="text" value="<?=$r["pergunta-15-3-2"]?>"/>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Garmin", $r["pergunta-15-3"]) ? "checked" : ""?> id="pergunta-15-3-garmin" name="pergunta-15-3[]" type="checkbox" value="Garmin"/>
							<i class="form-icon"></i>
							Garmin
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-15-3-3" name="pergunta-15-3-3" placeholder="Cite modelos" type="text" value="<?=$r["pergunta-15-3-3"]?>"/>
						</label>
					</div>
					<div class="form-group">
						<label class="form-checkbox">
							<input <?=in_array("Outros", $r["pergunta-15-3"]) ? "checked" : ""?> id="pergunta-15-3-other" name="pergunta-15-3[]" type="checkbox" value="Outros"/>
							<i class="form-icon"></i>
							Outros
						</label>
						<label class="form-inline">
							<input class="form-input" id="pergunta-15-3-4" name="pergunta-15-3-4" placeholder="Cite fabricante e modelos" type="text" value="<?=$r["pergunta-15-3-4"]?>"/>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-16-1-1">16. Qual o seu nível de conhecimento nos seguintes campos?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-1-1"><strong>Aeronaves</strong></label>
					<label class="form-label" for="pergunta-16-1-1">Estruturas</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-1-1" max="10" min="0" name="pergunta-16-1-1" type="range" value="<?=$r["pergunta-16-1-1"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-1-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-1-2">Motores</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-1-2" max="10" min="0" name="pergunta-16-1-2" type="range" value="<?=$r["pergunta-16-1-2"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-1-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-1-3">Aviônica</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-1-3" max="10" min="0" name="pergunta-16-1-3" type="range" value="<?=$r["pergunta-16-1-3"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-1-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-1-4">Sistemas</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-1-4" max="10" min="0" name="pergunta-16-1-4" type="range" value="<?=$r["pergunta-16-1-4"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-1-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-1-5">Ferramental</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-1-5" max="10" min="0" name="pergunta-16-1-5" type="range" value="<?=$r["pergunta-16-1-5"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-1-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-2-1"><strong>Operações</strong></label>
					<label class="form-label" for="pergunta-16-2-1">Coordenação</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-2-1" max="10" min="0" name="pergunta-16-2-1" type="range" value="<?=$r["pergunta-16-2-1"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-2-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-2-2">Climatologia</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-2-2" max="10" min="0" name="pergunta-16-2-2" type="range" value="<?=$r["pergunta-16-2-2"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-2-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-2-3">Rotas</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-2-3" max="10" min="0" name="pergunta-16-2-3" type="range" value="<?=$r["pergunta-16-2-3"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-2-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-2-4">Peso & Balanceamento</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-2-4" max="10" min="0" name="pergunta-16-2-4" type="range" value="<?=$r["pergunta-16-2-4"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-2-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-2-5">AOG</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-2-5" max="10" min="0" name="pergunta-16-2-5" type="range" value="<?=$r["pergunta-16-2-5"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-2-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-2-6">SGSO</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-2-6" max="10" min="0" name="pergunta-16-2-6" type="range" value="<?=$r["pergunta-16-2-6"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-2-6"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-2-7">AVSEC</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-2-7" max="10" min="0" name="pergunta-16-2-7" type="range" value="<?=$r["pergunta-16-2-7"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-2-7"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-3-1"><strong>Engenharia</strong></label>
					<label class="form-label" for="pergunta-16-3-1">Planejamento</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-3-1" max="10" min="0" name="pergunta-16-3-1" type="range" value="<?=$r["pergunta-16-3-1"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-3-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-3-2">Projetos</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-3-2" max="10" min="0" name="pergunta-16-3-2" type="range" value="<?=$r["pergunta-16-3-2"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-3-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-3-3">Manutenção</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-3-3" max="10" min="0" name="pergunta-16-3-3" type="range" value="<?=$r["pergunta-16-3-3"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-3-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-3-4">Reparos</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-3-4" max="10" min="0" name="pergunta-16-3-4" type="range" value="<?=$r["pergunta-16-3-4"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-3-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-3-5">Qualidade</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-3-5" max="10" min="0" name="pergunta-16-3-5" type="range" value="<?=$r["pergunta-16-3-5"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-3-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-3-6">CTM</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-3-6" max="10" min="0" name="pergunta-16-3-6" type="range" value="<?=$r["pergunta-16-3-6"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-3-6"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-4-1"><strong>Administração</strong></label>
					<label class="form-label" for="pergunta-16-4-1">Compras</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-4-1" max="10" min="0" name="pergunta-16-4-1" type="range" value="<?=$r["pergunta-16-4-1"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-4-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-4-2">Reparos</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-4-2" max="10" min="0" name="pergunta-16-4-2" type="range" value="<?=$r["pergunta-16-4-2"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-4-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-4-3">Almoxarifado</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-4-3" max="10" min="0" name="pergunta-16-4-3" type="range" value="<?=$r["pergunta-16-4-3"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-4-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-4-4">Logística</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-4-4" max="10" min="0" name="pergunta-16-4-4" type="range" value="<?=$r["pergunta-16-4-4"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-4-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-4-5">Vendas</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-4-5" max="10" min="0" name="pergunta-16-4-5" type="range" value="<?=$r["pergunta-16-4-5"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-4-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-4-6">Prospecção</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-4-6" max="10" min="0" name="pergunta-16-4-6" type="range" value="<?=$r["pergunta-16-4-6"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-4-6"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-4-7">Marketing</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-4-7" max="10" min="0" name="pergunta-16-4-7" type="range" value="<?=$r["pergunta-16-4-7"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-4-7"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-4-8">Design</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-4-8" max="10" min="0" name="pergunta-16-4-8" type="range" value="<?=$r["pergunta-16-4-8"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-4-8"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-4-9">Contabilidade</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-4-9" max="10" min="0" name="pergunta-16-4-9" type="range" value="<?=$r["pergunta-16-4-9"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-4-9"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-4-10">RH</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-4-10" max="10" min="0" name="pergunta-16-4-10" type="range" value="<?=$r["pergunta-16-4-10"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-4-10"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-5-1"><strong>TI</strong></label>
					<label class="form-label" for="pergunta-16-5-1">Programação</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-5-1" max="10" min="0" name="pergunta-16-5-1" type="range" value="<?=$r["pergunta-16-5-1"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-5-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-5-2">Help Desk</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-5-2" max="10" min="0" name="pergunta-16-5-2" type="range" value="<?=$r["pergunta-16-5-2"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-5-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-5-3">Redes</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-5-3" max="10" min="0" name="pergunta-16-5-3" type="range" value="<?=$r["pergunta-16-5-3"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-5-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-5-4">Banco de Dados</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-5-4" max="10" min="0" name="pergunta-16-5-4" type="range" value="<?=$r["pergunta-16-5-4"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-5-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-5-5">Projetos</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-5-5" max="10" min="0" name="pergunta-16-5-5" type="range" value="<?=$r["pergunta-16-5-5"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-5-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-1"><strong>Softwares</strong></label>
					<label class="form-label" for="pergunta-16-6-1">Excel</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-1" max="10" min="0" name="pergunta-16-6-1" type="range" value="<?=$r["pergunta-16-6-1"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-1"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-2">Word</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-2" max="10" min="0" name="pergunta-16-6-2" type="range" value="<?=$r["pergunta-16-6-2"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-2"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-3">PowerPoint</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-3" max="10" min="0" name="pergunta-16-6-3" type="range" value="<?=$r["pergunta-16-6-3"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-3"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-4">Access</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-4" max="10" min="0" name="pergunta-16-6-4" type="range" value="<?=$r["pergunta-16-6-4"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-4"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-5">Totvs</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-5" max="10" min="0" name="pergunta-16-6-5" type="range" value="<?=$r["pergunta-16-6-5"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-5"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-6">SAP</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-6" max="10" min="0" name="pergunta-16-6-6" type="range" value="<?=$r["pergunta-16-6-6"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-6"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-7">Photoshop</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-7" max="10" min="0" name="pergunta-16-6-7" type="range" value="<?=$r["pergunta-16-6-7"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-7"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-8">Premiere</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-8" max="10" min="0" name="pergunta-16-6-8" type="range" value="<?=$r["pergunta-16-6-8"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-8"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-9">Illustrator</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-9" max="10" min="0" name="pergunta-16-6-9" type="range" value="<?=$r["pergunta-16-6-9"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-9"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-10">Salesforce</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-10" max="10" min="0" name="pergunta-16-6-10" type="range" value="<?=$r["pergunta-16-6-10"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-10"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-11">PowerBI</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-11" max="10" min="0" name="pergunta-16-6-11" type="range" value="<?=$r["pergunta-16-6-11"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-11"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-12">Notes</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-12" max="10" min="0" name="pergunta-16-6-12" type="range" value="<?=$r["pergunta-16-6-12"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-12"]?></p>
					</div>
				</div>

				<div class="col-4 col-sm-12"></div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-label" for="pergunta-16-6-13">Outros</label>
					<div class="columns">
						<div class="column col-mx-auto col-6 text-left">0</div>
						<div class="column col-mx-auto col-6 text-right">10</div>
					</div>
					<div class="col-12 col-sm-12">
						<input class="slider" id="pergunta-16-6-13" max="10" min="0" name="pergunta-16-6-13" type="range" value="<?=$r["pergunta-16-6-13"]?>"/>
						<p class="text-bold text-center"><?=$r["pergunta-16-6-13"]?></p>
					</div>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-17">17. Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto mais forte?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-17" name="pergunta-17" placeholder="Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto mais forte?" rows="2" style="resize: none;"><?=$r["pergunta-17"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-18">18. Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto de melhoria?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-18" name="pergunta-18" placeholder="Com base na sua experiência na função e nas respostas acima, qual característica/área você considera seu ponto de melhoria?" rows="2" style="resize: none;"><?=$r["pergunta-18"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-19">19. Você se considera um expert em algo?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-19"] == "Não" ? "checked" : ""?> id="pergunta-19" name="pergunta-19" type="radio" value="Não"/>
						<i class="form-icon"></i>
						Não
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-19"] == "Sim" ? "checked" : ""?> name="pergunta-19" type="radio" value="Sim"/>
						<i class="form-icon"></i>
						Sim, qual(is)?
					</label>
					<input class="form-input" id="pergunta-19-1-disabled" name="pergunta-19-1" placeholder="Qual(is)?" type="text" value="<?=$r["pergunta-19-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-20">20. Descreva algum conhecimento técnico específico que você adquiriu no desempenho da função não descrito acima:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-20" name="pergunta-20" placeholder="Descreva algum conhecimento técnico específico que você adquiriu no desempenho da função não descrito acima" rows="2" style="resize: none;"><?=$r["pergunta-20"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-21">21. Descreva algum conhecimento técnico específico que você adquiriu na sua carreira e que julga de importância, mas não descrito acima:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-21" name="pergunta-21" placeholder="Descreva algum conhecimento técnico específico que você adquiriu na sua carreira e que julga de importância, mas não descrito acima" rows="2" style="resize: none;"><?=$r["pergunta-21"]?></textarea>
				</div>
			</div>

			<!--<div class="divider"></div>
			<h5 class="text-center">Potencial de dificuldade futura</h5>
			<div class="divider"></div>-->
			<!--<div class="divider text-center" data-content="Potencial de dificuldade futura"></div>-->

			<div class="text-right">
				<input class="btn btn-primary input-group-btn" name="anterior" type="submit" value="Anterior"/>
				<input class="btn btn-success input-group-btn" name="sair" type="submit" value="Salvar e Continuar depois"/>
				<input class="btn btn-error input-group-btn" name="proximo" type="submit" value="Finalizar e Enviar"/>
			</div>

			<input name="pagina" type="hidden" value=""/>
		</form>
	</div>

	<script src="js/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function() {
			// Desabilitar mudança de outros procedimentos
			if($("input[id='pergunta-15-1-other']").is(":checked"))
				$("input[name='pergunta-15-1-1']").prop("disabled", false);
			else
				$("input[name='pergunta-15-1-1']").prop("disabled", true);
			if($("input[id='pergunta-15-2-other']").is(":checked"))
				$("input[name='pergunta-15-2-1']").prop("disabled", false);
			else
				$("input[name='pergunta-15-2-1']").prop("disabled", true);

			// Desabilitar campos de aeronaves que já operou
			if($("input[id='pergunta-15-3']").is(":checked"))
				$("input[name='pergunta-15-3-1']").prop("disabled", false);
			else
				$("input[name='pergunta-15-3-1']").prop("disabled", true);
			if($("input[id='pergunta-15-3-honeywell']").is(":checked"))
				$("input[name='pergunta-15-3-2']").prop("disabled", false);
			else
				$("input[name='pergunta-15-3-2']").prop("disabled", true);
			if($("input[id='pergunta-15-3-garmin']").is(":checked"))
				$("input[name='pergunta-15-3-3']").prop("disabled", false);
			else
				$("input[name='pergunta-15-3-3']").prop("disabled", true);
			if($("input[id='pergunta-15-3-other']").is(":checked"))
				$("input[name='pergunta-15-3-4']").prop("disabled", false);
			else
				$("input[name='pergunta-15-3-4']").prop("disabled", true);

			// Habilitar o campo de outros procedimentos
			$("input[id='pergunta-15-1-other']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='pergunta-15-1-1']").prop("disabled", false);
				else
					$("input[name='pergunta-15-1-1']").prop("disabled", true).val("");
			});
			$("input[id='pergunta-15-2-other']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='pergunta-15-2-1']").prop("disabled", false);
				else
					$("input[name='pergunta-15-2-1']").prop("disabled", true).val("");
			});

			// Habilitar campos de aeronaves que já operou
			$("input[id='pergunta-15-3']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='pergunta-15-3-1']").prop("disabled", false);
				else
					$("input[name='pergunta-15-3-1']").prop("disabled", true).val("");
			});
			$("input[id='pergunta-15-3-honeywell']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='pergunta-15-3-2']").prop("disabled", false);
				else
					$("input[name='pergunta-15-3-2']").prop("disabled", true).val("");
			});
			$("input[id='pergunta-15-3-garmin']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='pergunta-15-3-3']").prop("disabled", false);
				else
					$("input[name='pergunta-15-3-3']").prop("disabled", true).val("");
			});
			$("input[id='pergunta-15-3-other']").on("change click", function() {
				if($(this).is(":checked"))
					$("input[name='pergunta-15-3-4']").prop("disabled", false);
				else
					$("input[name='pergunta-15-3-4']").prop("disabled", true).val("");
			});

			// Desabilitar os "se sim, quais?"
			$("input[id*='disabled'][type='text']").each(function() {
				var nome = $(this).attr("name");
				if($("input[name='" + nome.substr(nome, nome.length-2) + "']:checked").val() == "Sim")
					$("input[name='" + nome + "']").prop("disabled", false);
				else
					$("input[name='" + nome + "']").prop("disabled", true).val("");
			})

			// Habilitar o campo de cargos relativos a função
			$("input[name='pergunta-4']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-4-1']").prop("disabled", false);
				else
					$("input[name='pergunta-4-1']").prop("disabled", true).val("");
			});

			// Habilitar o campo de gerente tóxico
			$("input[name='13']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='13-1']").prop("disabled", false);
				else
					$("input[name='13-1']").prop("disabled", true).val("");
			});

			// Habilitar o campo de expert em algo
			$("input[name='pergunta-19']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-19-1']").prop("disabled", false);
				else
					$("input[name='pergunta-19-1']").prop("disabled", true).val("");
			});

			// Anima a barra de controle deslizante
			$("input[type='range']").each(function() {
				$(this).next().text($(this).val());
			});
			$("input[type='range']").on("click mousemove", function() {
				$(this).next().text($(this).val());
			});

			// Salva a página requerida no formulário
			$("input[name='anterior']").click(function() {
				$("input[name='proximo']").val("");
			});
			$("input[name='proximo']").click(function() {
				$("input[name='anterior']").val("");
			});

			// Direcionadores dos links do menu superior
			$("a[data-anchor='formulario-0.php'], a[data-anchor='formulario-1.php'], a[data-anchor='formulario-2.php'], a[data-anchor='formulario-3.php'], a[data-anchor='formulario-4.php'], a[data-anchor='formulario-6.php'], a[data-anchor='php/sair.php']").click(function() {
				$("input[name='pagina']").val($(this).data("anchor"));
				$("form[action='php/formulario-5.php']").submit();
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