<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS E FUNÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");

// TÍTULO DA PÁGINA
define("PAGE_TITLE", "Cadastrar Usuário");
define("PAGE_MODULE", PAGE_TITLE);

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);

// CARREGA MENU SUPERIOR DA PÁGINA
require_once(INC_ROUTES["tab"]);
?>

	<div class="container grid-lg py-4">
		<div class="text-center">
			<h6 class="display-6 text-blue"><?=PAGE_MODULE?></h6>
		</div>

		<form action="<?=ACTION_NAME?>admin/student/insert" method="post">
			<div class="form-group">
				<label class="form-label" for="name">Nome</label>
				<input class="form-input" id="name" name="name" placeholder="Nome" required="required" type="text" value="<?=get_data("name")?>"/>
			</div>

			<div class="form-group">
				<label class="form-label" for="alias">CPF</label>
				<input class="form-input" id="alias" name="alias" placeholder="CPF" required="required" type="text" value="<?=get_data("alias")?>"/>
			</div>

			<div class="form-group">
				<label class="form-label" for="password">Senha</label>
				<input class="form-input" id="password" name="password" placeholder="Senha" required="required" type="text" value="<?=get_data("password")?>"/>
			</div>

			<div class="form-group">
				<label class="form-label" for="type">Tipo</label>
				<select class="form-select" id="type" name="type" required="required">
					<option disabled="disabled" value="">Escolha uma opção</option>
					<option <?=get_data("type", false) === "administrator" ? "selected='selected'" : ""?> value="administrator">Administrador</option>
					<option <?=get_data("type") !== "administrator" ? "selected='selected'" : ""?> value="student">Aluno</option>
				</select>
			</div>

			<div class="form-group pt-2">
				<button class="btn btn-blue" type="submit">Cadastrar</button>
			</div>

			<p class="text-center text-<?=get_color()?>" id="message"><?=get_message()?></p>
		</form>

	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

	<script>
		$(document).ready(function() {
			const form = $("form[method='post']");
			let input = $("input[name='alias']");
			let button = $("button[type='submit']");
			let valid = true;

			// VALIDAÇÃO DO CPF
			input.attr("maxlength", 14);
			input.mask("000.000.000-00", {reverse: false});
			input.keydown(function() {
				let cpf = $(this).val().replaceAll(".", "").replace("-", "");
				if(cpf.length === 11) {
					valid = validateCPF(cpf);
					$("#message").html(valid ? "" : "O CPF informado é inválido.");
					$("#message").addClass("text-red").removeClass("text-blue");
				}
				else
				$("#message").html("");
			});

			// VALIDAÇÃO DO FORMULÁRIO
			form.submit(function() {
				if(valid) {
					button.val("").addClass("loading");
					input.val(input.val().replaceAll(".", "").replace("-", ""));
					$("#message").html("Cadastrando usuário.").removeClass("text-red");
				}

				else {
					$("#message").html("Informe um CPF válido para cadastrar o usuário.");
					return false;
				}
			});
		});
	</script>

</body>

</html>
