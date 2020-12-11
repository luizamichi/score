<?php

require_once("../php/util.php");

// Usuário não está autenticado
if(!empty($_SESSION) && isset($_SESSION["admin"])) {
	header("Location: painel.php");
	return false;
}

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
	<div class="container grid-lg">
		<img alt="SCORE" class="img-responsive" src="../img/logo.png" style="margin-bottom: 20px; margin-top: 50px; margin-left: auto; margin-right: auto; display: block; width: 300px;"/>

		<div class="text-center">
			<form action="php/index.php" method="post">
				<div class="form-group pt-2 text-center" style="max-width: 350px; margin-left: auto; margin-right: auto;">
					<label class="form-label" for="login">Login</label>
					<input autofocus="autofocus" class="form-input" id="login" name="login" placeholder="Login" required="required" type="text"/>

					<label class="form-label" for="senha">Senha</label>
					<input class="form-input" id="senha" name="senha" placeholder="Senha" required="required" type="password"/>
				</div>
				<div class="form-group pt-2">
					<input class="btn btn-primary input-group-btn" type="submit" value="Entrar"/>
				</div>
				<p><?=$mensagem?></p>
			</form>
		</div>

	</div>
</body>

</html>