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

// Pesquisa os usuários cadastrados
$consulta = "select * from usuarios;";
$usuarios = mysql($consulta, true);

$admin = mysql("select * from administradores where id=" . $_SESSION["admin"] . ";");
$mensagem = !empty($_GET) && isset($_GET["mensagem"]) ? $_GET["mensagem"] : "";
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
				<a href="consultar.php">Consultar usuário</a>
			</li>
			<li class="tab-item">
				<a class="active" href="#">Remover usuário</a>
			</li>
		</ul>
	</div>

	<div class="container grid-lg">
		<div class="pt-2 text-center" style="color: #195596;">
			<h1 class="mt-2">Remover usuário</h1>
		</div>

		<p id="mensagem"><?=$mensagem?></p>

		<div class="text-justify pt-2">
			<?php foreach($usuarios as $i => $u) {
			?>
			<div class="<?=$i % 2 ? "bg-gray" : ""?>">
				<form action="php/remover.php" class="pb-2 pt-2" id="<?=$i?>" method="post">
					<b>CPF:</b> <?=$u["cpf"]?>
					<input class="form-input" id="cpf" name="cpf" placeholder="CPF" type="hidden" value="<?=$u["cpf"]?>"/>
					<input class="btn btn-error input-group-btn" type="submit" value="Remover"/>
				</form>
			</div>
			<?php
			}
			?>
		</div>

	</div>

	<script src="../js/jquery-3.5.1.min.js"></script>
	<script src="../js/jquery.mask.js"></script>
	<script>
		$(document).ready(function() {
			// Validação do formulário
			$("form").submit(function() {
				let resposta = confirm("Deseja mesmo remover o usuário?");
				if(!resposta)
					return false;
				else
					$("#mensagem").html("Removendo usuário."); // $(this).children("input").val();
			});
		});
	</script>

</body>

</html>