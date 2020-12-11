<?php

require_once("php/util.php");

// Páginas acessíveis de encaminhamento
$paginas = [HOST . "formulario-0.php", HOST . "formulario-1.php", HOST . "formulario-2.php", HOST . "formulario-3.php", HOST . "formulario-4.php", HOST . "formulario-5.php"];

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
	$campos = ["pergunta-1", "pergunta-2", "pergunta-3", "pergunta-4", "pergunta-5", "pergunta-6", "pergunta-7", "pergunta-8", "pergunta-9", "pergunta-10", "pergunta-11", "pergunta-12", "pergunta-13", "pergunta-14", "pergunta-15"];
	$consulta = mysql("select resposta from formularios where modulo=6 and usuario=" . $_SESSION["id"] . ";");

	$vetor = [];
	for($i = 0; $i < 15; $i++)
		array_push($vetor, "");

	$respostas = $consulta ? explode("|$*|", $consulta["resposta"]) : $vetor;
	$r = [];

	// Deixa os dados esteticamente bonitos
	foreach($campos as $indice => $campo)
		$r[$campo] = $respostas[$indice];
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
	<title>AirTalent - Inglês intermediário</title>
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
				<a data-anchor="formulario-3.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Conhecimento técnico</a>
			</li>
			<li class="tab-item">
				<a data-anchor="formulario-4.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Segurança operacional</a>
			</li>
			<li class="tab-item">
				<a data-anchor="formulario-5.php" href="#"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Experiências anteriores</a>
			</li>
			<li class="tab-item">
				<a class="active" href="#"><span style="font-size: 10px;">NÍVEL DE INGLÊS</span><br/>Inglês intermediário</a>
			</li>
		</ul>
	</div>

	<div class="container grid-lg">
		<div class="pt-2 text-center" style="color: #195596;">
			<h1 class="mt-2">Inglês intermediário</h1>
		</div>

		<form action="php/formulario-6.php" class="form-horizontal" method="post">

			<div>Fill in the blanks respectively with the correct alternative:</div>
			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-1">1. Charlie! Good to see you, man. It’s ____ a long time we don’t chat! How ____ Lisa doing?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-1"] == "Going / where" ? "checked" : ""?> id="pergunta-1" name="pergunta-1" type="radio" value="Going / where"/>
						<i class="form-icon"></i>
						Going / where
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-1"] == "Being / has" ? "checked" : ""?> name="pergunta-1" type="radio" value="Being / has"/>
						<i class="form-icon"></i>
						Being / has
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-1"] == "Doing / was" ? "checked" : ""?> name="pergunta-1" type="radio" value="Doing / was"/>
						<i class="form-icon"></i>
						Doing / was
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-1"] == "Been / is" ? "checked" : ""?> name="pergunta-1" type="radio" value="Been / is"/>
						<i class="form-icon"></i>
						Been / is
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-2">2. The Catering is waiting but I can’t open the door, L5 door is jammed. ____ you please help me ____ it? I’ll call the engineers to come check it out.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2"] == "Should / lock" ? "checked" : ""?> id="pergunta-2" name="pergunta-2" type="radio" value="Should / lock"/>
						<i class="form-icon"></i>
						Should / lock
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2"] == "Can / seal" ? "checked" : ""?> name="pergunta-2" type="radio" value="Can / seal"/>
						<i class="form-icon"></i>
						Can / seal
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2"] == "Would / push" ? "checked" : ""?> name="pergunta-2" type="radio" value="Would / push"/>
						<i class="form-icon"></i>
						Would / push
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-2"] == "Will / close" ? "checked" : ""?> name="pergunta-2" type="radio" value="Will / close"/>
						<i class="form-icon"></i>
						Will / close
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-3">3. The outbreak of Coronavirus disease (COVID-19) has acted as a massive restraint on the commercial aircraft manufacturing market in 2020, as supply chains were disrupted due to trade restrictions and manufacturing was affected by extensive lockdowns globally.</label>
					<div>What subject is the author discussing?</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-3"] == "The threat of the Coronavirus to the manufacturers of aircrafts and supplies, as it is a highly contagious and deadly virus." ? "checked" : ""?> id="pergunta-3" name="pergunta-3" type="radio" value="The threat of the Coronavirus to the manufacturers of aircrafts and supplies, as it is a highly contagious and deadly virus."/>
						<i class="form-icon"></i>
						The threat of the Coronavirus to the manufacturers of aircrafts and supplies, as it is a highly contagious and deadly virus.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-3"] == "The economic impact of COVID-19 and its preventative measures on commercial negotiations in the aircraft manufacturing market and industry development in 2020." ? "checked" : ""?> name="pergunta-3" type="radio" value="The economic impact of COVID-19 and its preventative measures on commercial negotiations in the aircraft manufacturing market and industry development in 2020."/>
						<i class="form-icon"></i>
						The economic impact of COVID-19 and its preventative measures on commercial negotiations in the aircraft manufacturing market and industry development in 2020.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-3"] == "The consequences of COVID-19 to the aircraft manufacturing professionals, potentially affected by the disruption in the market." ? "checked" : ""?> name="pergunta-3" type="radio" value="The consequences of COVID-19 to the aircraft manufacturing professionals, potentially affected by the disruption in the market."/>
						<i class="form-icon"></i>
						The consequences of COVID-19 to the aircraft manufacturing professionals, potentially affected by the disruption in the market.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-3"] == "The damaging ongoing outcome of Coronavirus in the aviation industry, causing companies to take extreme measures to protect their businesses." ? "checked" : ""?> name="pergunta-3" type="radio" value="The damaging ongoing outcome of Coronavirus in the aviation industry, causing companies to take extreme measures to protect their businesses."/>
						<i class="form-icon"></i>
						The damaging ongoing outcome of Coronavirus in the aviation industry, causing companies to take extreme measures to protect their businesses.
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-4">4. Scarcely ______ taken off, we were forced to make an emergency landing.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-4"] == "we have" ? "checked" : ""?> id="pergunta-4" name="pergunta-4" type="radio" value="we have"/>
						<i class="form-icon"></i>
						we have
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-4"] == "we had" ? "checked" : ""?> name="pergunta-4" type="radio" value="we had"/>
						<i class="form-icon"></i>
						we had
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-4"] == "have we" ? "checked" : ""?> name="pergunta-4" type="radio" value="have we"/>
						<i class="form-icon"></i>
						have we
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-4"] == "had we" ? "checked" : ""?> name="pergunta-4" type="radio" value="had we"/>
						<i class="form-icon"></i>
						had we
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-5">5. Aircraft manufacturers are using machine-learning techniques such as artificial intelligence (AI) to enhance aircraft safety and quality, as well as the manufacturing productivity.</label>
					<div>The word in bold could be replaced by:</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-5"] == "Improve" ? "checked" : ""?> id="pergunta-5" name="pergunta-5" type="radio" value="Improve"/>
						<i class="form-icon"></i>
						Improve
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-5"] == "Test" ? "checked" : ""?> name="pergunta-5" type="radio" value="Test"/>
						<i class="form-icon"></i>
						Test
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-5"] == "Innovate" ? "checked" : ""?> name="pergunta-5" type="radio" value="Innovate"/>
						<i class="form-icon"></i>
						Innovate
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-5"] == "Apply" ? "checked" : ""?> name="pergunta-5" type="radio" value="Apply"/>
						<i class="form-icon"></i>
						Apply
					</label>
				</div>
			</div><br/>
			<div>Fill in the blanks respectively with the correct alternative:</div>
			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-6">6. Susan: Hey Mike, just to let you know, I got a flat tire and I probably _____________ late for the meeting. I’m on my way there though.</label>
					<div>Mike: No worries, Susan! ______________</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-6"] == "will be / You alright?" ? "checked" : ""?> id="pergunta-6" name="pergunta-6" type="radio" value="will be / You alright?"/>
						<i class="form-icon"></i>
						will be / You alright?
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-6"] == "am / Take care." ? "checked" : ""?> name="pergunta-6" type="radio" value="am / Take care."/>
						<i class="form-icon"></i>
						am / Take care.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-6"] == "will be running / Do you need a ride?" ? "checked" : ""?> name="pergunta-6" type="radio" value="will be running / Do you need a ride?"/>
						<i class="form-icon"></i>
						will be running / Do you need a ride?
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-6"] == "will get / Have a nice day!" ? "checked" : ""?> name="pergunta-6" type="radio" value="will get / Have a nice day!"/>
						<i class="form-icon"></i>
						will get / Have a nice day!
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-7">7. You’d better take these tools with you _______ you need to make a repair.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-7"] == "otherwise" ? "checked" : ""?> id="pergunta-7" name="pergunta-7" type="radio" value="otherwise"/>
						<i class="form-icon"></i>
						otherwise
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-7"] == "unless" ? "checked" : ""?> name="pergunta-7" type="radio" value="unless"/>
						<i class="form-icon"></i>
						unless
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-7"] == "in case" ? "checked" : ""?> name="pergunta-7" type="radio" value="in case"/>
						<i class="form-icon"></i>
						in case
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-7"] == "because" ? "checked" : ""?> name="pergunta-7" type="radio" value="because"/>
						<i class="form-icon"></i>
						because
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-8">8. Would you mind _________ the Section 7.3 of the Manual to me, please? There’s a procedure I want to review with the team today.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-8"] == "to forward" ? "checked" : ""?> id="pergunta-8" name="pergunta-8" type="radio" value="to forward"/>
						<i class="form-icon"></i>
						to forward
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-8"] == "forwarding" ? "checked" : ""?> name="pergunta-8" type="radio" value="forwarding"/>
						<i class="form-icon"></i>
						forwarding
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-8"] == "to check" ? "checked" : ""?> name="pergunta-8" type="radio" value="to check"/>
						<i class="form-icon"></i>
						to check
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-8"] == "checking" ? "checked" : ""?> name="pergunta-8" type="radio" value="checking"/>
						<i class="form-icon"></i>
						checking
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-9">9. Boeing has successfully built machine-learning algorithms to design aircraft and automate factory operations.</label>
					<div>Which alternative best describes what you’ve read?</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9"] == "It’s a good project, however artificial intelligence is merely a projection into the future." ? "checked" : ""?> id="pergunta-9" name="pergunta-9" type="radio" value="It’s a good project, however artificial intelligence is merely a projection into the future."/>
						<i class="form-icon"></i>
						It’s a good project, however artificial intelligence is merely a projection into the future.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9"] == "Automated systems and robots are gradually replacing human labor." ? "checked" : ""?> name="pergunta-9" type="radio" value="Automated systems and robots are gradually replacing human labor."/>
						<i class="form-icon"></i>
						Automated systems and robots are gradually replacing human labor.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9"] == "Artificial Intelligence has been employed in the aircraft manufacturing industry." ? "checked" : ""?> name="pergunta-9" type="radio" value="Artificial Intelligence has been employed in the aircraft manufacturing industry."/>
						<i class="form-icon"></i>
						Artificial Intelligence has been employed in the aircraft manufacturing industry.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-9"] == "Boeing is a successful aerospace company that designs, manufactures and sells airplanes." ? "checked" : ""?> name="pergunta-9" type="radio" value="Boeing is a successful aerospace company that designs, manufactures and sells airplanes."/>
						<i class="form-icon"></i>
						Boeing is a successful aerospace company that designs, manufactures and sells airplanes.
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-10">10. The other day I ran into Juliet on the way to the office and she told me about the new policies to be implemented.</label>
					<div>The terms in bold could be replaced by:</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-10"] == "Asked" ? "checked" : ""?> id="pergunta-10" name="pergunta-10" type="radio" value="Asked"/>
						<i class="form-icon"></i>
						Asked
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-10"] == "Spoke with" ? "checked" : ""?> name="pergunta-10" type="radio" value="Spoke with"/>
						<i class="form-icon"></i>
						Spoke with
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-10"] == "Walked along" ? "checked" : ""?> name="pergunta-10" type="radio" value="Walked along"/>
						<i class="form-icon"></i>
						Walked along
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-10"] == "Bumped into" ? "checked" : ""?> name="pergunta-10" type="radio" value="Bumped into"/>
						<i class="form-icon"></i>
						Bumped into
					</label>
				</div>
			</div><br/>
			<div>Choose which alternative best describes the sentence below.</div>
			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-11">11. I can’t wait to see my father. He’s arriving tomorrow.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-11"] == "I’m looking forward to it." ? "checked" : ""?> id="pergunta-11" name="pergunta-11" type="radio" value="I’m looking forward to it."/>
						<i class="form-icon"></i>
						I’m looking forward to it.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-11"] == "I don’t like waiting." ? "checked" : ""?> name="pergunta-11" type="radio" value="I don’t like waiting."/>
						<i class="form-icon"></i>
						I don’t like waiting.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-11"] == "I don’t want to see my father." ? "checked" : ""?> name="pergunta-11" type="radio" value="I don’t want to see my father."/>
						<i class="form-icon"></i>
						I don’t want to see my father.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-11"] == "I don’t have time tomorrow." ? "checked" : ""?> name="pergunta-11" type="radio" value="I don’t have time tomorrow."/>
						<i class="form-icon"></i>
						I don’t have time tomorrow.
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-12">12. Flight Attendant: Which one do you prefer, coffee or tea?</label>
					<div>Mrs. Fox: ______ the tea, please. With milk, no sugar.</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-12"] == "I’d have" ? "checked" : ""?> id="pergunta-12" name="pergunta-12" type="radio" value="I’d have"/>
						<i class="form-icon"></i>
						I’d have
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-12"] == "I’d rather prefer" ? "checked" : ""?> name="pergunta-12" type="radio" value="I’d rather prefer"/>
						<i class="form-icon"></i>
						I’d rather prefer
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-12"] == "I’m having" ? "checked" : ""?> name="pergunta-12" type="radio" value="I’m having"/>
						<i class="form-icon"></i>
						I’m having
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-12"] == "I’ll have" ? "checked" : ""?> name="pergunta-12" type="radio" value="I’ll have"/>
						<i class="form-icon"></i>
						I’ll have
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-13">13. Machine learning algorithms collect data from machine-to-machine and machine-tohuman interfaces and use data analytics to drive effective decision making. These technologies optimize manufacturing operations and lower costs. For example, GE Aviation uses machine learning and data analytics to identify faults in engines, which increases components’ lives and reduces maintenance costs.</label>
					<div>Which alternative best describes what you’ve read?</div>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-13"] == "The learning capacity of machines is highly effective for factory operation, as it can be used in various segments of manufacturing and assist in decision making." ? "checked" : ""?> id="pergunta-13" name="pergunta-13" type="radio" value="The learning capacity of machines is highly effective for factory operation, as it can be used in various segments of manufacturing and assist in decision making."/>
						<i class="form-icon"></i>
						The learning capacity of machines is highly effective for factory operation, as it can be used in various segments of manufacturing and assist in decision making.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-13"] == "The advancement of technology is turning the manufacturing operations cost-effective by engaging artificial intelligence to diagnose and prevent shortcomings." ? "checked" : ""?> name="pergunta-13" type="radio" value="The advancement of technology is turning the manufacturing operations cost-effective by engaging artificial intelligence to diagnose and prevent shortcomings."/>
						<i class="form-icon"></i>
						The advancement of technology is turning the manufacturing operations cost-effective by engaging artificial intelligence to diagnose and prevent shortcomings.
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-13"] == "Data analytics help optimize the operations performance, assist in an effective decision making and reduces maintenance costs." ? "checked" : ""?> name="pergunta-13" type="radio" value="Data analytics help optimize the operations performance, assist in an effective decision making and reduces maintenance costs."/>
						<i class="form-icon"></i>
						Data analytics help optimize the operations performance, assist in an effective decision making and reduces maintenance costs.
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-14">14. I need to _____ a word with Oscar about my license expiration, I’ll _____ on a break in an hour.</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-14"] == "speak / take" ? "checked" : ""?> id="pergunta-14" name="pergunta-14" type="radio" value="speak / take"/>
						<i class="form-icon"></i>
						speak / take
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-14"] == "talk / come" ? "checked" : ""?> name="pergunta-14" type="radio" value="talk / come"/>
						<i class="form-icon"></i>
						talk / come
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-14"] == "have / go" ? "checked" : ""?> name="pergunta-14" type="radio" value="have / go"/>
						<i class="form-icon"></i>
						have / go
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-14"] == "get / talk" ? "checked" : ""?> name="pergunta-14" type="radio" value="get / talk"/>
						<i class="form-icon"></i>
						get / talk
					</label>
				</div>
			</div>

			<div class="form-group py-2">
				<div class="col-4 col-sm-12">
					<label class="form-label" for="pergunta-15">15. _____ can I get to the main station from here? _____ I go up or down this street?</label>
				</div>
				<div class="col-8 col-sm-12 pl-1">
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-15"] == "Where / Can" ? "checked" : ""?> id="pergunta-15" name="pergunta-15" type="radio" value="Where / Can"/>
						<i class="form-icon"></i>
						Where / Can
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-15"] == "What / Must" ? "checked" : ""?> name="pergunta-15" type="radio" value="What / Must"/>
						<i class="form-icon"></i>
						What / Must
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-15"] == "Who / Which" ? "checked" : ""?> name="pergunta-15" type="radio" value="Who / Which"/>
						<i class="form-icon"></i>
						Who / Which
					</label>
					<label class="form-inline form-radio">
						<input <?=$r["pergunta-15"] == "How / Should" ? "checked" : ""?> name="pergunta-15" type="radio" value="How / Should"/>
						<i class="form-icon"></i>
						How / Should
					</label>
				</div>
			</div>

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
			// Salva a página requerida no formulário
			$("input[name='anterior']").click(function() {
				$("input[name='proximo']").val("");
			});
			$("input[name='proximo']").click(function() {
				$("input[name='anterior']").val("");
			});

			// Direcionadores dos links do menu superior
			$("a[data-anchor='formulario-0.php'], a[data-anchor='formulario-1.php'], a[data-anchor='formulario-2.php'], a[data-anchor='formulario-3.php'], a[data-anchor='formulario-4.php'], a[data-anchor='formulario-5.php'], a[data-anchor='php/sair.php']").click(function() {
				$("input[name='pagina']").val($(this).data("anchor"));
				$("form[action='php/formulario-6.php']").submit();
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