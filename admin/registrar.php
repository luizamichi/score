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
				<a class="active" href="#">Cadastrar usuário</a>
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
			<h1 class="mt-2">Cadastrar usuário</h1>
		</div>

		<div class="text-justify pt-2">
			<form action="php/registrar.php" method="post">
				<div class="form-group">
					<label class="form-label" for="cpf">CPF</label>
					<input class="form-input" id="cpf" name="cpf" placeholder="CPF" type="text"/>
					<span class="text-error" id="cpf-validate"></span>
				</div>
				<div class="form-group">
					<label class="form-label" for="senha">Senha</label>
					<input class="form-input" id="senha" name="senha" type="text" placeholder="Senha"/>
				</div>

				<div class="form-group pt-2">
					<input class="btn btn-primary input-group-btn" type="submit" value="Cadastrar"/>
				</div>

				<p id="mensagem"><?=$mensagem?></p>
			</form>

		</div>

	</div>

	<script src="../js/jquery-3.5.1.min.js"></script>
	<script src="../js/jquery.mask.js"></script>
	<script>
		$(document).ready(function() {
			let input = $("input[name='cpf']");
			let valido = true;

			// Validação do CPF
			input.attr("maxlength", 14);
			input.mask("000.000.000-00", {reverse: false}); // input.attr("pattern", "\d{3}\.\d{3}\.\d{3}-\d{2}");
			input.keydown(function() {
				let cpf = $(this).val().replaceAll(".", "").replace("-", "");
				valido = validaCPF(cpf);
				$("#cpf-validate").html(valido ? "" : "O CPF informado é inválido.");
			});

			function validaCPF(cpf) {
				if(cpf.length == 11) {
					var soma;
					var resto;
					soma = 0;
					if(cpf == "00000000000")
						return false;

					for(i = 1; i <= 9; i++)
						soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
					resto = (soma * 10) % 11;

					if(resto == 10 || resto == 11)
						resto = 0;
					if(resto != parseInt(cpf.substring(9, 10)))
						return false;

					soma = 0;
					for(i = 1; i <= 10; i++)
						soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
					resto = (soma * 10) % 11;

					if((resto == 10) || (resto == 11))
						resto = 0;
					if(resto != parseInt(cpf.substring(10, 11)))
						return false;
					return true;
				}
				return true;
			}

			// Validação do formulário
			$("form").submit(function() {
				if(!valido) {
					$("#mensagem").html("Informe um CPF válido para cadastrar o usuário.");
					return false;
				}
				else {
					input.val(input.val().replaceAll(".", "").replace("-", ""));
					$("#mensagem").html("Cadastrando usuário.");
				}
			});
		});
	</script>

</body>

</html>