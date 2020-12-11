<?php

require_once("../php/util.php");

// Páginas acessíveis de encaminhamento
$paginas = [HOST . "admin/painel.php", HOST . "admin/consultar.php", HOST . "admin/registrar.php", HOST . "admin/registrar.php?mensagem=Usu%C3%A1rio+j%C3%A1+est%C3%A1+cadastrado+no+sistema.", HOST . "admin/registrar.php?mensagem=Usu%C3%A1rio+cadastrado+com+sucesso.", HOST . "admin/remover.php", HOST . "admin/remover.php?mensagem=Usu%C3%A1rio+removido+com+sucesso.", HOST . "admin/remover.php?mensagem=Usu%C3%A1rio+n%C3%A3o+est%C3%A1+cadastrado+no+sistema."];

// Não está acessando pelo formulário original
if(isset($_SERVER["HTTP_REFERER"]) && !in_array($_SERVER["HTTP_REFERER"], $paginas)) {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	return false;
}

// Usuário não está autenticado
if(empty($_SESSION) && !isset($_SESSION["admin"])) {
	header("Location: index.php");
	return false;
}

$admin = mysql("select * from administradores where id=" . $_SESSION["admin"] . ";");
$mensagem = "";

$registraram = [];
$comecaram = [];
$finalizaram = [];

if(!empty($_POST) && isset($_POST["cpf"])) {
	// Verifica se o(s) usuário(s) existe(m)
	$consulta = "select id from usuarios where cpf like concat('%" . $_POST["cpf"] . "%');";
	$registros = mysql($consulta, true, "id");

	if(count($registros) > 0) {
		// Pesquisa os usuários que não começaram o formulário
		$consulta = "select * from usuarios as u left join respostas as r on u.id=r.usuario inner join senhas as s on u.id = s.usuario where r.usuario is null and u.id in (" . implode(",", $registros) . ");";
		$registraram = mysql($consulta, true);

		// Pesquisa os usuários que começaram o formulário
		$consulta = "select * from usuarios as u inner join respostas as r on u.id=r.usuario where r.fim is null and u.id in (" . implode(",", $registros) . ");";
		$comecaram = mysql($consulta, true);

		// Pesquisa os usuários que terminaram o formulário
		$consulta = "select * from usuarios as u inner join respostas as r on u.id=r.usuario where r.fim and u.id in (" . implode(",", $registros) . ");";
		$finalizaram = mysql($consulta, true);

		if($finalizaram) {
			// Pesquisa as respostas de inglês
			foreach($finalizaram as $finalizou => $f) {
				// Gabarito das respostas do inglês intermediário
				$gabarito = [
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

				$pesos = [2, 2, 3, 2, 2, 1, 1, 2, 3, 2, 1, 2, 3, 2, 1];

				$consulta = mysql("select * from formularios where usuario=" . $f["id"] . " and modulo=6;");
				$respostas = $consulta ? explode("|$*|", $consulta["resposta"]) : ["", "", "", "", "", "", "", "", "", "", "", "", "", "", ""];

				$soma = 0;
				for($x = 0; $x < 15; $x++) {
					if($respostas[$x] == $gabarito[$x])
						$soma += $pesos[$x];
				}

				$finalizaram[$finalizou]["ingles"] = ($soma / array_sum($pesos)) * 100;
			}
		}

		$mensagem = "Foram encontrados os seguintes usuários no sistema.";
	}
	else
		$mensagem = "Não foram encontrados usuários no sistema.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>AirTalent - SCORE</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="../css/spectre.min.css"/>
	<link rel="stylesheet" href="../css/spectre-exp.min.css"/>
	<link rel="stylesheet" href="../css/spectre-icons.min.css"/>
	<link rel="icon" href="../img/logo.png"/>
</head>

<body>
	<div class="bg-gray">
		<header class="navbar">
			<section class="navbar-section">
				<a href="#" class="btn btn-link">
					<span class="text-dark" id="dias" style="font-size: 10px;">BEM-VINDO</span>
					<h4 class="text-dark"><?=$admin["nome"]?></h4>
				</a>
			</section>
			<section class="navbar-center">
				<img alt="AirTalent" class="img-responsive" src="../img/airtalent.png" style="margin-top: 15px; width: 200px;"/>
			</section>
			<section class="navbar-section">
				<a class="btn btn-link" href="php/sair.php">
					<span class="text-dark" style="font-size: 10px;">SAIR</span><br/>
					<img alt="Sair" src="../img/sair.png" style="width: 30px;"/>
				</a>
			</section>
		</header>

		<ul class="tab tab-block">
			<li class="tab-item">
				<a href="painel.php">Painel</a>
			</li>
			<li class="tab-item">
				<a href="registrar.php">Cadastrar usuário</a>
			</li>
			<li class="tab-item">
				<a class="active" href="#">Consultar usuário</a>
			</li>
			<li class="tab-item">
				<a href="remover.php">Remover usuário</a>
			</li>
		</ul>
	</div>

	<div class="container grid-lg">
		<div class="pt-2 text-center" style="color: #195596;">
			<h1 class="mt-2">Consultar usuário</h1>
		</div>

		<div class="text-justify pt-2">
			<form action="consultar.php" method="post">
				<div class="form-group">
					<label class="form-label" for="cpf">CPF</label>
					<input class="form-input" id="cpf" name="cpf" placeholder="CPF" type="text"/>
					<span class="text-error" id="cpf-validate"></span>
				</div>

				<div class="form-group pt-2">
					<input class="btn btn-primary input-group-btn" type="submit" value="Consultar"/>
				</div>

				<p id="mensagem"><?=$mensagem?></p>
			</form>

		</div>

		<div class="text-justify pt-2">
			<?php if($finalizaram) { ?>
			<h3>Formulários finalizados</h3>
			<?php } ?>
			<?php foreach($finalizaram as $f) {
				$inicio = new DateTime($f["inicio"]);
				$fim = new DateTime($f["fim"]);
				$diferenca = $inicio->diff($fim);
				$ingles = number_format($f["ingles"], 2, ",", ".");
			?>
			<p><b>CPF:</b> <?=$f["cpf"]?></p>
			<p><b>Início:</b> <?=$inicio->format("d/m/Y H:i:s")?></p>
			<p><b>Término:</b> <?=$fim->format("d/m/Y H:i:s")?></p>
			<p><b>Tempo:</b> <?=$diferenca->format("%d dia(s) e %H:%I:%S")?></p>
			<p><b>Inglês Intermediário:</b> <?=$ingles?></p>
			<?php
			}
			?>

			<?php if($comecaram) { ?>
			<hr/>
			<h3>Formulários inicializados</h3>
			<?php } ?>
			<?php foreach($comecaram as $c) {
				$inicio = new DateTime($c["inicio"]);
				$fim = new DateTime();
				$diferenca = $inicio->diff($fim);
			?>
			<p><b>CPF:</b> <?=$c["cpf"]?></p>
			<p><b>Início:</b> <?=$inicio->format("d/m/Y H:i:s")?></p>
			<p><b>Tempo:</b> <?=$diferenca->format("%d dia(s) e %H:%I:%S")?></p><br/>
			<?php
			}
			?>

			<?php if($registraram) { ?>
			<hr/>
			<h3>Formulários não inicializados</h3>
			<?php } ?>
			<?php foreach($registraram as $r) {
				$inscricao = new DateTime($r["horario"]);
				$atual = new DateTime();
				$diferenca = $inscricao->diff($atual);
			?>
			<p><b>CPF:</b> <?=$r["cpf"]?></p>
			<p><b>Inscrição:</b> <?=$inscricao->format("d/m/Y H:i:s")?></p>
			<p><b>Tempo:</b> <?=$diferenca->format("%d dia(s) e %H:%I:%S")?></p><br/>
			<?php
			}
			?>

		</div>

	</div>

	<script src="../js/jquery-3.5.1.min.js"></script>
	<script src="../js/jquery.mask.js"></script>
	<script>
		$(document).ready(function() {
			// Remoção dos pontos e traços do CPF
			$("form").submit(function() {
				let input = $("input[name='cpf']");
				input.val(input.val().replaceAll(".", "").replace("-", ""));
				$("#mensagem").html("Consultando usuário.");
			});
		});
	</script>

</body>

</html>