<?php

require_once("php/util.php");

// Usuário não está autenticado
if(empty($_SESSION) && !isset($_SESSION["id"])) {
	header("Location: index.php");
	return false;
}

// Verifica se o usuário já respondeu todo o questionário
$consulta = "select * from respostas where usuario=" . $_SESSION["id"] . ";";
if(!mysql($consulta)["fim"]) {
	// Redireciona o usuário para a primeira página
	header("Location: formulario-0.php");
	return true;
}

// Acabou o formulário
if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] == HOST . "formulario-6.php")
	$terminou = false;
else
	$terminou = true;
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
</head>

<body>
	<div class="container grid-lg">
		<img alt="SCORE" class="img-responsive" src="img/logo.png" style="margin-bottom: 20px; margin-top: 50px; margin-left: auto; margin-right: auto; display: block; width: 300px;"/>

		<ul class="step pb-2">
			<li class="step-item">
				<a href="#" class="tooltip" data-tooltip="Cadastro inicial">Cadastro inicial</a>
			</li>
			<li class="step-item">
				<a href="#" class="tooltip" data-tooltip="Avaliação técnica - Conhecimento da função">Avaliação técnica - Conhecimento da função</a>
			</li>
			<li class="step-item">
				<a href="#" class="tooltip" data-tooltip="Avaliação técnica - Conhecimento técnico específico">Avaliação técnica - Conhecimento técnico específico</a>
			</li>
			<li class="step-item">
				<a href="#" class="tooltip" data-tooltip="Avaliação técnica - Segurança operacional e regulação">Avaliação técnica - Segurança operacional e regulação</a>
			</li>
			<li class="step-item">
				<a href="#" class="tooltip" data-tooltip="Avaliação técnica - Experiências anteriores">Avaliação técnica - Experiências anteriores</a>
			</li>
		</ul>

		<div class="text-center mt-2">
			<?php if($terminou) { ?>
			<!--<p>Já recebemos suas respostas, elas estão sendo avalidas e em breve entraremos em contato contigo.</p>-->
			<p>Você concluiu a primeira etapa do SCORE. Agora você pode realizar a avaliação de personalidade e comportamento.</p>
			<?php } else { ?>
			<!--<p>Parabéns, você finalizou o SCORE. Suas respostas serão avalidas e em breve entraremos em contato contigo. Boa sorte!</p>-->
			<p>Parabéns, você concluiu a primeira etapa do SCORE. Agora você pode realizar a avaliação de personalidade e comportamento, ou descansar e realizá-la mais tarde.</p>
			<?php } ?>
		</div>

		<div class="text-center">
			<a class="btn btn-error input-group-btn" href="php/sair.php">Sair</a>
		</div>
	</div>
</body>

</html>