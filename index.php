<?php

require_once("php/util.php");

// Usuário está autenticado
if(!empty($_SESSION) && isset($_SESSION["id"])) {
	header("Location: formulario-0.php");
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
	<link rel="stylesheet" href="css/spectre.min.css">
	<link rel="stylesheet" href="css/spectre-exp.min.css">
	<link rel="stylesheet" href="css/spectre-icons.min.css">
</head>

<body style="background-image: url('img/background.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-position: right; background-size: auto;">
	<div class="container grid-lg">
		<img alt="SCORE" class="img-responsive" src="img/logo.png" style="margin-bottom: 20px; margin-top: 50px; margin-left: auto; margin-right: auto; display: block; width: 300px;"/>

		<div class="text-center">
			<form action="php/index.php" method="post">
				<div class="form-group pt-2 text-center" style="max-width: 350px; margin-left: auto; margin-right: auto;">
					<label class="form-label" for="cpf">CPF</label>
					<input autofocus="autofocus" class="form-input" id="cpf" name="cpf" placeholder="CPF" required="required" type="text"/>
					<span class="text-error" id="cpf-validate"></span>

					<label class="form-label" for="senha">Senha</label>
					<input class="form-input" id="senha" name="senha" placeholder="Senha" required="required" type="password"/>
				</div>

				<div class="form-group pt-2">
					<input class="btn btn-primary input-group-btn" type="submit" value="Entrar"/>
				</div>

				<p id="mensagem"><?=$mensagem?></p>
			</form>
		</div>

	</div>

	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/jquery.mask.js"></script>
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
					$("#mensagem").html("Informe um CPF válido para liberar o acesso.");
					return false;
				}
				else {
					input.val(input.val().replaceAll(".", "").replace("-", ""));
					$("#mensagem").html("Autenticando usuário.");
				}
			});
		});
	</script>
</body>

</html>