<?php

require_once("php/util.php");

// Páginas acessíveis de encaminhamento
$paginas = [HOST, HOST . "index.php", HOST . "index.php?mensagem=Voc%C3%AA+realizou+o+logout.", HOST . "index.php?mensagem=Os+dados+informados+est%C3%A3o+incorretos%2C+verifique+o+CPF+e+a+senha.", HOST . "index.php?mensagem=Voc%C3%AA+realizou+o+logout.+Suas+respostas+foram+salvas.", HOST . "formulario-1.php", HOST . "formulario-2.php", HOST . "formulario-3.php", HOST . "formulario-4.php", HOST . "formulario-5.php", HOST . "formulario-6.php"];

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
	<title>AirTalent - SCORE</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="css/spectre.min.css"/>
	<link rel="stylesheet" href="css/spectre-exp.min.css"/>
	<link rel="stylesheet" href="css/spectre-icons.min.css"/>
	<link rel="icon" href="img/logo.png"/>
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
				<a class="active" href="#"><span style="font-size: 10px;">INÍCIO</span><br/>SCORE</a>
			</li>
			<li class="tab-item text-gray">
				<a href="formulario-1.php"><span style="font-size: 10px;">DADOS PESSOAIS</span><br/>Cadastro inicial</a>
			</li>
			<li class="tab-item text-gray">
				<a href="formulario-2.php"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Conhecimento da função</a>
			</li>
			<li class="tab-item text-gray">
				<a href="formulario-3.php"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Conhecimento técnico específico</a>
			</li>
			<li class="tab-item text-gray">
				<a href="formulario-4.php"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Segurança operacional</a>
			</li>
			<li class="tab-item text-gray">
				<a href="formulario-5.php"><span style="font-size: 10px;">AVALIAÇÃO TÉCNICA</span><br/>Experiências anteriores</a>
			</li>
			<li class="tab-item text-gray">
				<a href="formulario-6.php"><span style="font-size: 10px;">NÍVEL DE INGLÊS</span><br/>Inglês intermediário</a>
			</li>
		</ul>
	</div>

	<div class="container grid-lg">
		<img alt="SCORE" class="img-responsive" src="img/logo.png" style="margin-bottom: 20px; margin-top: 20px; margin-left: auto; margin-right: auto; display: block; width: 150px;"/>

		<div class="text-justify">
			<p>O SCORE (Sistema de Competências e Relacionamentos) é uma avaliação individual que mede, por meio de uma nota, as habilidades <em>soft</em> e <em>hard skills</em>. Por meio do SCORE, você poderá identificar seus pontos fortes e fracos e canalizar seus recursos para melhorar sua empregabilidade.</p>
			<p>A sua nota no SCORE poderá ser usada pelos empregadores nos processos seletivos, aumentando ainda mais as suas chances de ser alocado para a vaga certa.</p>
			<p>O teste aplicado no SCORE avalia 5 aspectos técnicos e 5 aspectos comportamentais, com notas que variam de 0 a 10, totalizando 100 pontos.</p>
			<p>O SCORE foi desenvolvido por profissionais com vasta experiência na aviação e é uma ferramenta específica para o meio aeronáutico.</p>
			<p>Por meio de uma única aplicação, o seu SCORE poderá ser usado por várias empresas em vários processos seletivos, sem a necessidade de testes repetitivos para cada vaga.</p>
		</div>

		<div class="text-right">
			<a class="btn btn-error input-group-btn" href="php/sair.php">Sair</a>
			<a class="btn btn-primary input-group-btn" href="formulario-1.php">Próximo</a>
		</div>
	</div>

	<script src="js/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function() {
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