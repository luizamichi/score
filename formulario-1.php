<?php

require_once("php/util.php");

// Páginas acessíveis de encaminhamento
$paginas = [HOST . "formulario-0.php", HOST . "formulario-2.php", HOST . "formulario-3.php", HOST . "formulario-4.php", HOST . "formulario-5.php", HOST . "formulario-6.php"];

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
	$campos = ["pergunta-1", "pergunta-2", "pergunta-3", "pergunta-4", "pergunta-5", "pergunta-6", "pergunta-6-1", "pergunta-6-2", "pergunta-6-3", "pergunta-6-4", "pergunta-7", "pergunta-8", "pergunta-9", "pergunta-9-1", "pergunta-9-2", "pergunta-9-3", "pergunta-9-4", "pergunta-9-5", "pergunta-9-5-1", "pergunta-10", "pergunta-11", "pergunta-11-1", "pergunta-12", "pergunta-13", "pergunta-14"];
	$consulta = mysql("select resposta from formularios where modulo=1 and usuario=" . $_SESSION["id"] . ";");

	$vetor = [];
	for($i = 0; $i < 25; $i++)
		array_push($vetor, "");

	$respostas = $consulta ? explode("|$*|", $consulta["resposta"]) : $vetor;
	$r = [];
	// Deixa os dados esteticamente bonitos
	foreach($campos as $indice => $campo) {
		$r[$campo] = $respostas[$indice];
	}
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
	<title>AirTalent - Cadastro inicial</title>
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
				<a class="active" href="#"><span style="font-size: 10px;">DADOS PESSOAIS</span><br/>Cadastro inicial</a>
			</li>
			<li class="tab-item text-gray">
				<a data-anchor="formulario-2.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Conhecimento da função</a>
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
			<h1 class="mt-2">Cadastro inicial</h1>
		</div>

		<form action="php/formulario-1.php" class="form-horizontal" method="post">
			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-1">1. Nome</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-1" name="pergunta-1" placeholder="Nome" type="text" value="<?=$r["pergunta-1"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-2">2. Sobrenome</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-2" name="pergunta-2" placeholder="Sobrenome" type="text" value="<?=$r["pergunta-2"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-3">3. E-mail</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-3" name="pergunta-3" placeholder="E-mail" type="email" value="<?=$r["pergunta-3"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-4">4. Telefone</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-4" name="pergunta-4" placeholder="Telefone" type="tel" value="<?=$r["pergunta-4"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-5">5. Data de nascimento</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-5" name="pergunta-5" type="date" value="<?=$r["pergunta-5"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-6">6. Escolaridade</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<select class="form-select" id="pergunta-6" name="pergunta-6">
						<option disabled="disabled" <?=$r["pergunta-6"] ? "" : "selected=\"selected\""?>>Escolha uma opção</option>
						<option <?=$r["pergunta-6"] == "Ensino básico incompleto" ? "selected=\"selected\"" : ""?> value="Ensino básico incompleto">Ensino básico incompleto</option>
						<option <?=$r["pergunta-6"] == "Ensino básico completo" ? "selected=\"selected\"" : ""?> value="Ensino básico completo">Ensino básico completo</option>
						<option <?=$r["pergunta-6"] == "Ensino médio incompleto" ? "selected=\"selected\"" : ""?> value="Ensino médio incompleto">Ensino médio incompleto</option>
						<option <?=$r["pergunta-6"] == "Ensino médio completo" ? "selected=\"selected\"" : ""?> value="Ensino médio completo">Ensino médio completo</option>
						<option <?=$r["pergunta-6"] == "Ensino superior incompleto" ? "selected=\"selected\"" : ""?> value="Ensino superior incompleto">Ensino superior incompleto</option>
						<option <?=$r["pergunta-6"] == "Ensino superior completo" ? "selected=\"selected\"" : ""?> value="Ensino superior completo">Ensino superior completo</option>
						<option <?=$r["pergunta-6"] == "Especialização" ? "selected=\"selected\"" : ""?> value="Especialização">Especialização</option>
						<option <?=$r["pergunta-6"] == "Mestrado" ? "selected=\"selected\"" : ""?> value="Mestrado">Mestrado</option>
						<option <?=$r["pergunta-6"] == "Doutorado" ? "selected=\"selected\"" : ""?> value="Doutorado">Doutorado</option>
					</select>
				</div>
			</div>

			<div class="form-group py-2" id="pergunta-6-1-hide">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-6-1">Qual curso?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-6-1" list="cursos" name="pergunta-6-1" placeholder="Qual curso?" type="text" value="<?=$r["pergunta-6-1"]?>"/>
					<datalist id="cursos">
						<option value="Administração Pública">
						<option value="Agronegócios">
						<option value="Agronomia">
						<option value="Antropologia">
						<option value="Arqueologia">
						<option value="Arquitetura">
						<option value="Arquivologia">
						<option value="Artes Cênicas">
						<option value="Artes Plásticas">
						<option value="Artes Visuais">
						<option value="Astronomia">
						<option value="Biblioteconomia">
						<option value="Biologia">
						<option value="Biomedicina">
						<option value="Biotecnologia">
						<option value="Cinema">
						<option value="Ciência da Computação">
						<option value="Ciências Ambientais">
						<option value="Ciências Atuárias">
						<option value="Ciências Biológicas">
						<option value="Ciências Contábeis">
						<option value="Ciências Exatas">
						<option value="Ciências Naturais">
						<option value="Ciências Políticas">
						<option value="Ciências Sociais">
						<option value="Comunicação Social">
						<option value="Comércio Exterior">
						<option value="Dança">
						<option value="Desenho Industrial">
						<option value="Design Gráfico">
						<option value="Design de Games">
						<option value="Direito">
						<option value="Economia">
						<option value="Educação Física">
						<option value="Enfermagem">
						<option value="Engenharia Aeronáutica">
						<option value="Engenharia Aerospacial">
						<option value="Engenharia Agrícola">
						<option value="Engenharia Ambiental">
						<option value="Engenharia Biomédica">
						<option value="Engenharia Civil">
						<option value="Engenharia Elétrica">
						<option value="Engenharia Florestal">
						<option value="Engenharia Mecatrônica">
						<option value="Engenharia Mecânica">
						<option value="Engenharia Metalúrgica">
						<option value="Engenharia Naval">
						<option value="Engenharia Nuclear">
						<option value="Engenharia Química">
						<option value="Engenharia da Computação">
						<option value="Engenharia de Agrimensura">
						<option value="Engenharia de Alimentos">
						<option value="Engenharia de Controle e Automação">
						<option value="Engenharia de Energia">
						<option value="Engenharia de Materiais">
						<option value="Engenharia de Minas">
						<option value="Engenharia de Pesca">
						<option value="Engenharia de Petróleo">
						<option value="Engenharia de Produção">
						<option value="Engenheria de Telecomunicações">
						<option value="Estética">
						<option value="Farmácia">
						<option value="Filosofia">
						<option value="Fisioterapia">
						<option value="Fonoaudiologia">
						<option value="Fotografia">
						<option value="Física">
						<option value="Gastronomia">
						<option value="Geografia">
						<option value="Geologia">
						<option value="Gestão Ambiental">
						<option value="Gestão Comercial">
						<option value="Gestão Financeira">
						<option value="Gestão Hospitalar">
						<option value="Gestão de Recursos Humanos">
						<option value="Hotelaria e Turismo">
						<option value="Jornalismo">
						<option value="Letras">
						<option value="Logística">
						<option value="Matemática">
						<option value="Mecânica Industrial">
						<option value="Medicina">
						<option value="Medicina Veterinária">
						<option value="Meteorologia">
						<option value="Moda">
						<option value="Multimídia">
						<option value="Música">
						<option value="Negócios Imobiliários">
						<option value="Nutrição">
						<option value="Oceanografia">
						<option value="Odontologia">
						<option value="Pedagogia">
						<option value="Processos Gerenciais">
						<option value="Psicologia">
						<option value="Publicidade e Propaganda">
						<option value="Química">
						<option value="Radiologia">
						<option value="Relações Internacionais">
						<option value="Relações Públicas">
						<option value="Rádio e TV">
						<option value="Secretariado">
						<option value="Segurança do Trabalho">
						<option value="Serviço Social">
						<option value="Sistemas de Informação">
						<option value="Teatro">
						<option value="Tecnologia da Informação">
						<option value="Teologia">
						<option value="Terapia Ocupacional">
						<option value="Zootecnia">
					</datalist>
				</div>
			</div>

			<div class="form-group py-2" id="pergunta-6-2-hide">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-6-2">Qual campo?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-6-2" name="pergunta-6-2" placeholder="Qual campo?" type="text" value="<?=$r["pergunta-6-2"]?>"/>
				</div>
			</div>

			<div class="form-group py-2" id="pergunta-6-3-hide">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-6-3">Universidade</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-6-3" list="universidades" name="pergunta-6-3" placeholder="Universidade" type="text" value="<?=$r["pergunta-6-3"]?>"/>
					<datalist id="universidades">
						<option value="FURB - Universidade Regional de Blumenau">
						<option value="PUC-MG - Pontifícia Universidade Católica de Minas Gerais">
						<option value="PUC-PR - Pontifícia Universidade Católica do Paraná">
						<option value="PUC-RJ- Pontifícia Universidade Católica do Rio de Janeiro">
						<option value="PUC-RS - Pontifícia Universidade Católica do Rio Grande do Sul">
						<option value="PUC-SP - Pontifícia Universidade Católica de São Paulo">
						<option value="PUCCAMP - Pontifícia Universidade Católica de Campinas">
						<option value="UA - Universidade do Amazonas">
						<option value="UAM - Universidade Anhembi Morumbi">
						<option value="UBC - Universidade Braz Cubas">
						<option value="UCB - Universidade Castelo Branco">
						<option value="UCB - Universidade Católica de Brasília">
						<option value="UCDB - Universidade Católica Dom Bosco">
						<option value="UCG - Universidade Católica do Goiás">
						<option value="UCP - Universidade Católica de Petrópolis">
						<option value="UCPEL - Universidade Católica de Pelotas">
						<option value="UCS - Universidade de Caxias do Sul">
						<option value="UCSAL - Universidade Católica do Salvador">
						<option value="UDESC - Universidade do Estado de Santa Catarina">
						<option value="UECE - Universidade Estadual do Ceará">
						<option value="UEFS - Universidade Estadual de Feira de Santana">
						<option value="UEL - Universidade Estadual de Londrina">
						<option value="UEM - Universidade Estadual de Maringá">
						<option value="UEMA - Universidade Estadual do Maranhão">
						<option value="UEMG - Universidade do Estado de Minas Gerais">
						<option value="UEMS - Universidade Estadual de Mato Grosso do Sul.">
						<option value="UEPB - Universidade Estadual da Paraíba">
						<option value="UEPG - Universidade Estadual de Ponta Grossa">
						<option value="UERJ - Universidade do Estado do Rio de Janeiro">
						<option value="UESB - Universidade Estadual do Sudoeste da Bahia">
						<option value="UFAC - Universidade Federal do Acre">
						<option value="UFAL - Universidade Federal de Alagoas">
						<option value="UFBA - Universidade Federal da Bahia">
						<option value="UFC - Universidade Federal do Ceará">
						<option value="UFES - Universidade Federal do Espírito Santo">
						<option value="UFF - Universidade Estadual do Norte Fluminense">
						<option value="UFF - Universidade Federal Fluminense">
						<option value="UFG - Universidade Federal de Goiás">
						<option value="UFJF - Universidade Federal de Juiz de Fora">
						<option value="UFLA - Universidade Federal de Lavras">
						<option value="UFMA - Universidade Federal do Maranhão">
						<option value="UFMA - Universidade Federal do Maranhão">
						<option value="UFMG - Universidade Federal de Minas Gerais">
						<option value="UFMS - Universidade Federal de Mato Grosso do Sul">
						<option value="UFMT - Universidade Federal de Mato Grosso">
						<option value="UFOP - Universidade Federal de Ouro Preto">
						<option value="UFPA - Universidade Federal do Pará">
						<option value="UFPB - Universidade Federal da Paraíba">
						<option value="UFPE - Universidade Federal de Pernambuco">
						<option value="UFPEL - Universidade Federal de Pelotas">
						<option value="UFPI - Universidade Federal do Piauí">
						<option value="UFPR - Universidade Federal do Paraná">
						<option value="UFRGS - Universidade Federal do Rio Grande do Sul">
						<option value="UFRJ - Universidade Federal do Rio de Janeiro">
						<option value="UFRN - Universidade Federal do Rio Grande do Norte">
						<option value="UFRPE - Universidade Federal Rural de Pernambuco">
						<option value="UFRR - Universidade Federal de Roraima">
						<option value="UFRRJ - Universidade Federal Rural do Rio de Janeiro">
						<option value="UFS - Universidade Federal de Sergipe">
						<option value="UFSC - Universidade Federal de Santa Catarina">
						<option value="UFSC - Universidade Planalto Catarinense">
						<option value="UFSCAR - Universidade Federal de São Carlos">
						<option value="UFSM - Universidade Federal de Santa Maria">
						<option value="UFU - Universidade Federal de Uberaba">
						<option value="UFU - Universidade Federal de Uberlândia">
						<option value="UFV - Universidade Federal de Viçosa">
						<option value="UGF - Universidade Gama Filho">
						<option value="ULBRA - Universidade Luterana do Brasil">
						<option value="UM - Universidade Mackenzie">
						<option value="UMC - Universidade de Mogi das Cruzes">
						<option value="UNAERP - Universidade de Ribeirão Preto">
						<option value="UNAMA - Universidade da Amazônia">
						<option value="UNESA - Universidade Estácio de Sá">
						<option value="UNESP - Universidade Paulista Júlio de Mesquita Filho">
						<option value="UNG - Universidade de Guarulhos">
						<option value="UNIABC - Universidade do ABC">
						<option value="UNIANA - Universidade Estadual de Anápolis">
						<option value="UNIARA - Centro Universitário de Araraquara">
						<option value="UNIB - Universidade Ibirapuera">
						<option value="UNIBAN - Universidade Bandeirantes de São Paulo">
						<option value="UNICAMP - Universidade Estadual de Campinas">
						<option value="UNICAP - Universidade Católica de Pernambuco">
						<option value="UNICID - Universidade Cidade de São Paulo">
						<option value="UNICSUL - Universidade Cruzeiro do Sul">
						<option value="UNIDERP - Universidade para o Desenvolvimento do Estado e da Região do Pantanal">
						<option value="UNIFENAS - Universidade de Alfenas">
						<option value="UNIFESP - Universidade Federal de São Paulo">
						<option value="UNIFOR - Universidade de Fortaleza">
						<option value="UNIFRAN - Universidade de Franca">
						<option value="UNIG - Universidade de Nova Iguaçu">
						<option value="UNIGRANRIO - Universidade do Grande Rio">
						<option value="UNIJUÍ - Universidade Regional do Noroeste do Estado do Rio Grande do Sul">
						<option value="UNIMAR - Universidade de Marília">
						<option value="UNIMARCO - Universidade São Marcos">
						<option value="UNIMEP - Universidade Metodista de Piracicaba">
						<option value="UNIMES - Universidade Metropolitana de Santos">
						<option value="UNIOESTE - Universidade Estadual do Oeste do Paraná">
						<option value="UNIP - Universidade Paulista">
						<option value="UNIPE - Universidade de Ensino Superior do IPE">
						<option value="UNIR - Fundação Universidade Federal de Rondônia">
						<option value="UNIRIO - Universidade do Rio de Janeiro">
						<option value="UNISA - Universidade Santo Amaro">
						<option value="UNISANTA - Universidade de Santa Cecília">
						<option value="UNISANTOS - Universidade Católica de Santos">
						<option value="UNISC - Universidade de Santa Cruz do Sul">
						<option value="UNISINOS - Universidade do Vale do Rio dos Sinos">
						<option value="UNISUL - Universidade do Extremo Sul de Santa Catarina">
						<option value="UNISUL - Universidade do Sul de Santa Catarina">
						<option value="UNIT - Universidade Tiradentes">
						<option value="UNITAU - Universidade de Taubaté">
						<option value="UNIVALI - Universidade do Vale do Itajaí">
						<option value="UNIVAP - Universidade do Vale do Paraíba">
						<option value="UNIVERSO - Universidade Salgado de Oliveira">
						<option value="UNOESTE - Universidade do Oeste Paulista">
						<option value="UPE - Fundação Universidade de Pernambuco">
						<option value="UPF - Universidade de Passo Fundo">
						<option value="URCA - Universidade Regional do Cariri">
						<option value="URCAMP - Universidade da Região de Campanha">
						<option value="URG - Universidade do Rio Grande">
						<option value="URI - Universidade Regional Integrada do Alto Uruguai e das Missões">
						<option value="URRN - Universidade Regional do Rio Grande do Norte">
						<option value="USC - Universidade do Sagrado Coração">
						<option value="USF - Universidade São Francisco">
						<option value="USJT - Universidade São Judas Tadeu">
						<option value="USP - Universidade de São Paulo">
						<option value="USU - Universidade Santa Úrsula">
						<option value="UVA - Universidade Estadual do Vale do Acaraú">
						<option value="UVA - Universidade Veiga de Almeida">
						<option value="UnB - Universidade de Brasília">
					</datalist>
				</div>
			</div>

			<div class="form-group py-2" id="pergunta-6-4-hide">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-6-4">Data de conclusão</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-6-4" name="pergunta-6-4" type="date" value="<?=$r["pergunta-6-4"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-7">7. Para qual cargo e função você gostaria de ser avaliado?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-7" name="pergunta-7" placeholder="Para qual cargo e função você gostaria de ser avaliado?" type="text" value="<?=$r["pergunta-7"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-8">8. Qual seu nível atual de experiência?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-8"] == "Estagiário" ? "checked" : ""?> id="pergunta-8" name="pergunta-8" type="radio" value="Estagiário"/>
						<i class="form-icon"></i>
						Estagiário
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-8"] == "Junior" ? "checked" : ""?> name="pergunta-8" type="radio" value="Junior"/>
						<i class="form-icon"></i>
						Junior
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-8"] == "Pleno" ? "checked" : ""?> name="pergunta-8" type="radio" value="Pleno"/>
						<i class="form-icon"></i>
						Pleno
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-8"] == "Sênior" ? "checked" : ""?> name="pergunta-8" type="radio" value="Sênior"/>
						<i class="form-icon"></i>
						Sênior
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-8"] == "Gerencial" ? "checked" : ""?> name="pergunta-8" type="radio" value="Gerencial"/>
						<i class="form-icon"></i>
						Gerencial
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-8"] == "Diretoria" ? "checked" : ""?> name="pergunta-8" type="radio" value="Diretoria"/>
						<i class="form-icon"></i>
						Diretoria
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-9-1">9. Quais línguas você fala?</label>
				</div>
				<div class="col-8 col-sm-12 pb-2 pl-1">
					<label class="form-label" for="pergunta-9-1"><strong>Inglês</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-1"] == "Nenhum" ? "checked" : ""?> id="pergunta-9-1" name="pergunta-9-1" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-1"] == "Básico" ? "checked" : ""?> name="pergunta-9-1" type="radio" value="Básico"/>
						<i class="form-icon"></i>
						Básico
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-1"] == "Médio" ? "checked" : ""?> name="pergunta-9-1" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-1"] == "Avançado" ? "checked" : ""?> name="pergunta-9-1" type="radio" value="Avançado"/>
						<i class="form-icon"></i>
						Avançado
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-1"] == "Fluente" ? "checked" : ""?> name="pergunta-9-1" type="radio" value="Fluente"/>
						<i class="form-icon"></i>
						Fluente
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-9-2"><strong>Espanhol</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-2"] == "Nenhum" ? "checked" : ""?> id="pergunta-9-2" name="pergunta-9-2" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-2"] == "Básico" ? "checked" : ""?> name="pergunta-9-2" type="radio" value="Básico"/>
						<i class="form-icon"></i>
						Básico
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-2"] == "Médio" ? "checked" : ""?> name="pergunta-9-2" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-2"] == "Avançado" ? "checked" : ""?> name="pergunta-9-2" type="radio" value="Avançado"/>
						<i class="form-icon"></i>
						Avançado
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-2"] == "Fluente" ? "checked" : ""?> name="pergunta-9-2" type="radio" value="Fluente"/>
						<i class="form-icon"></i>
						Fluente
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-9-3"><strong>Francês</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-3"] == "Nenhum" ? "checked" : ""?> id="pergunta-9-3" name="pergunta-9-3" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-3"] == "Básico" ? "checked" : ""?> name="pergunta-9-3" type="radio" value="Básico"/>
						<i class="form-icon"></i>
						Básico
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-3"] == "Médio" ? "checked" : ""?> name="pergunta-9-3" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-3"] == "Avançado" ? "checked" : ""?> name="pergunta-9-3" type="radio" value="Avançado"/>
						<i class="form-icon"></i>
						Avançado
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-3"] == "Fluente" ? "checked" : ""?> name="pergunta-9-3" type="radio" value="Fluente"/>
						<i class="form-icon"></i>
						Fluente
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2">
					<label class="form-label" for="pergunta-9-4"><strong>Alemão</strong></label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-4"] == "Nenhum" ? "checked" : ""?> id="pergunta-9-4" name="pergunta-9-4" type="radio" value="Nenhum"/>
						<i class="form-icon"></i>
						Nenhum
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-4"] == "Básico" ? "checked" : ""?> name="pergunta-9-4" type="radio" value="Básico"/>
						<i class="form-icon"></i>
						Básico
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-4"] == "Médio" ? "checked" : ""?> name="pergunta-9-4" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-4"] == "Avançado" ? "checked" : ""?> name="pergunta-9-4" type="radio" value="Avançado"/>
						<i class="form-icon"></i>
						Avançado
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-4"] == "Fluente" ? "checked" : ""?> name="pergunta-9-4" type="radio" value="Fluente"/>
						<i class="form-icon"></i>
						Fluente
					</label>
				</div>

				<div class="col-4 col-sm-12">
					<label class="form-label"></label>
				</div>
				<div class="col-8 col-sm-12 pl-1 py-2" id="pergunta-9-5-disabled">
					<label class="form-label" for="pergunta-9-5"><strong>Outros</strong></label>
					<label class="form-inline pr-2">
						<input class="form-input" id="pergunta-9-5" name="pergunta-9-5" placeholder="Quais?" type="text" value="<?=$r["pergunta-9-5"]?>"/>
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-5-1"] == "Básico" ? "checked" : ""?> id="pergunta-9-5-1" name="pergunta-9-5-1" type="radio" value="Básico"/>
						<i class="form-icon"></i>
						Básico
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-5-1"] == "Médio" ? "checked" : ""?> name="pergunta-9-5-1" type="radio" value="Médio"/>
						<i class="form-icon"></i>
						Médio
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-5-1"] == "Avançado" ? "checked" : ""?> name="pergunta-9-5-1" type="radio" value="Avançado"/>
						<i class="form-icon"></i>
						Avançado
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9-5-1"] == "Fluente" ? "checked" : ""?> name="pergunta-9-5-1" type="radio" value="Fluente"/>
						<i class="form-icon"></i>
						Fluente
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-10">10. Você tem experiência na área que pretende desenvolver no futuro?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<select class="form-select" id="pergunta-10" name="pergunta-10">
						<option disabled="disabled" <?=$r["pergunta-10"] ? "" : "selected=\"selected\""?>>Escolha uma opção</option>
						<option <?=$r["pergunta-10"] == "Não tenho experiência" ? "selected=\"selected\"" : ""?> value="Não tenho experiência">Não tenho experiência</option>
						<option <?=$r["pergunta-10"] == "Menos de 1 ano de experiência" ? "selected=\"selected\"" : ""?> value="Menos de 1 ano de experiência">Menos de 1 ano de experiência</option>
						<option <?=$r["pergunta-10"] == "Entre 1 e 3 anos de experiência" ? "selected=\"selected\"" : ""?> value="Entre 1 e 3 anos de experiência">Entre 1 e 3 anos de experiência</option>
						<option <?=$r["pergunta-10"] == "Entre 3 e 5 anos de experiência" ? "selected=\"selected\"" : ""?> value="Entre 3 e 5 anos de experiência">Entre 3 e 5 anos de experiência</option>
						<option <?=$r["pergunta-10"] == "Acima de 5 anos de experiência" ? "selected=\"selected\"" : ""?> value="Acima de 5 anos de experiência">Acima de 5 anos de experiência</option>
					</select>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-11">11. Pretende mudar de área?</label>
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
						Sim, porque?
					</label>
					<label class="form-inline" id="pergunta-11-1-disabled">
						<input class="form-input" id="pergunta-11-1" name="pergunta-11-1" placeholder="Porque?" type="text" value="<?=$r["pergunta-11-1"]?>"/>
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-12">12. Considerando as respostas da perguntas 7 e 8, onde você se imagina daqui a 5 anos?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-12" name="pergunta-12" placeholder="Considerando as respostas da perguntas 7 e 8, onde você se imagina daqui a 5 anos?" rows="2" style="resize: none;"><?=$r["pergunta-12"]?></textarea>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-13">13. Qual o emprego dos seus sonhos?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<input class="form-input" id="pergunta-13" name="pergunta-13" placeholder="Qual o emprego dos seus sonhos?" type="text" value="<?=$r["pergunta-13"]?>"/>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-14">14. Conte-nos algo mais sobre você:</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<textarea class="form-input" id="pergunta-14" name="pergunta-14" placeholder="Conte-nos algo mais sobre você" rows="3" style="resize: none;"><?=$r["pergunta-14"]?></textarea>
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
			// Desabilitar campos de escolaridade
			$("div[id*='hide'] input[value='']").parentsUntil("div[id*='hide']").parent().hide();

			// Desabilitar os botões de outros idiomas
			if($("input[id='pergunta-9-5']").val().length == 0) {
				$("input[id='pergunta-9-5-1']").prop("checked", false);
				$("input[name='pergunta-9-5-1']").prop("disabled", true); // $("div[id*='disabled'] input[type='radio']").prop("disabled", true);
			}
			else
				$("input[id='pergunta-9-5-1']").prop("disabled", false);

			// Desabilitar mudança de área
			$("label[id*='disabled'] input[type='text']").prop("disabled", true);
			if($("input[name='pergunta-11']:checked").val() == "Sim")
				$("label[id*='disabled'] input[type='text']").prop("disabled", false);

			// Mostrar campos adicionais de acordo com a escolaridade
			$("select[name='pergunta-6']").on("change", function() {
				if($.inArray($(this).val(), ["Ensino superior completo", "Ensino superior incompleto"]) >= 0) {
					$("div[id=pergunta-6-2-hide]").hide().val("");
					$("div[id=pergunta-6-1-hide], div[id=pergunta-6-3-hide], div[id=pergunta-6-4-hide]").show();
				}
				else if($.inArray($(this).val(), ["Especialização", "Mestrado", "Doutorado"]) >= 0) {
					$("div[id=pergunta-6-1-hide]").hide().val("");
					$("div[id=pergunta-6-2-hide], div[id=pergunta-6-3-hide], div[id=pergunta-6-4-hide]").show();
				}
				else
					$("div[id*='hide']").hide().val("");
			});

			// Habilitar outros idiomas
			$("input[name='pergunta-9-5']").on("keyup keydown", function() {
				if($(this).val().length > 0)
					$("div[id*='disabled'] input[type='radio']").prop("disabled", false);
				else {
					$("div[id*='disabled'] input[type='radio']").prop("disabled", true).prop("checked", false);
				}
			});

			// Habilitar o campo de mudança de área
			$("input[name='pergunta-11']").on("change click", function() {
				if($(this).val() == "Sim")
					$("input[name='pergunta-11-1']").prop("disabled", false);
				else
					$("input[name='pergunta-11-1']").prop("disabled", true).val("");
			});

			// Salva a página requerida no formulário
			$("input[name='anterior']").click(function() {
				$("input[name='proximo']").val("");
			});
			$("input[name='proximo']").click(function() {
				$("input[name='anterior'] input[name='anterior']").val("");
			});

			// Validar alguns campos
			$("input[name='proximo'][name='anterior']").click(function() {
				$("input[name='anterior']").val("");
			});

			// Direcionadores dos links do menu superior
			$("a[data-anchor='formulario-0.php'], a[data-anchor='formulario-2.php'], a[data-anchor='formulario-3.php'], a[data-anchor='formulario-4.php'], a[data-anchor='formulario-5.php'], a[data-anchor='formulario-6.php'], a[data-anchor='php/sair.php']").click(function() {
				$("input[name='pagina']").val($(this).data("anchor"));
				$("form[action='php/formulario-1.php']").submit();
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