<?php

require_once("../php/util.php");

// Páginas acessíveis de encaminhamento
$paginas = [HOST . "admin/", HOST . "admin/index.php", HOST . "admin/consultar.php", HOST . "admin/index.php?mensagem=Voc%C3%AA+realizou+o+logout.", HOST . "admin/index.php?mensagem=Os+dados+informados+est%C3%A3o+incorretos%2C+verifique+o+login+e+a+senha.", HOST . "admin/registrar.php", HOST . "admin/registrar.php?mensagem=Usu%C3%A1rio+j%C3%A1+est%C3%A1+cadastrado+no+sistema.", HOST . "admin/registrar.php?mensagem=Usu%C3%A1rio+cadastrado+com+sucesso.", HOST . "admin/remover.php", HOST . "admin/remover.php?mensagem=Usu%C3%A1rio+removido+com+sucesso.", HOST . "admin/remover.php?mensagem=Usu%C3%A1rio+n%C3%A3o+est%C3%A1+cadastrado+no+sistema."];

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

// Pesquisa os usuários que não começaram o formulário
$consulta = "select * from usuarios as u left join respostas as r on u.id=r.usuario inner join senhas as s on u.id = s.usuario where r.usuario is null;";
$registraram = mysql($consulta, true); // $registraram = isset($registraram["id"]) ? [$registraram] : $registraram;

// Pesquisa os usuários que começaram o formulário
$consulta = "select * from usuarios as u inner join respostas as r on u.id=r.usuario where r.fim is null;";
$comecaram = mysql($consulta, true); // $comecaram = isset($comecaram["id"]) ? [$comecaram] : $comecaram;

// Pesquisa os usuários que terminaram o formulário
$consulta = "select * from usuarios as u inner join respostas as r on u.id=r.usuario where r.fim;";
$finalizaram = mysql($consulta, true); // $finalizaram = isset($finalizaram["id"]) ? [$finalizaram] : $finalizaram;
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
				<a class="active" href="#">Painel</a>
			</li>
			<li class="tab-item">
				<a href="registrar.php">Cadastrar usuário</a>
			</li>
			<li class="tab-item">
				<a href="consultar.php">Consultar usuário</a>
			</li>
			<li class="tab-item">
				<a href="remover.php">Remover usuário</a>
			</li>
		</ul>
	</div>

	<div class="container grid-lg">
		<div class="pt-2 text-center" style="color: #195596;">
			<h1 class="mt-2">Painel administrativo</h1>
		</div>

		<div class="text-justify pt-2">
			<h3>Formulários finalizados</h3>
			<?php foreach($finalizaram as $f) {
				$inicio = new DateTime($f["inicio"]);
				$fim = new DateTime($f["fim"]);
				$diferenca = $inicio->diff($fim);
			?>
			<p><b>CPF:</b> <?=$f["cpf"]?></p>
			<p><b>Início:</b> <?=$inicio->format("d/m/Y H:i:s")?></p>
			<p><b>Término:</b> <?=$fim->format("d/m/Y H:i:s")?></p>
			<p><b>Tempo:</b> <?=$diferenca->format("%d dia(s) e %H:%I:%S")?></p>
			<?php
			}
			?>

			<hr/>
			<h3>Formulários inicializados</h3>
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

			<hr/>
			<h3>Formulários não inicializados</h3>
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

</body>

</html>