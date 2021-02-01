<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS E FUNÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");

// TÍTULO DA PÁGINA
define("PAGE_TITLE", "Início");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>
	<div class="container grid-lg">
		<div style="margin-bottom: 20px; margin-top: 50px;">
			<img alt="SCORE" class="img-center img-responsive" src="<?=MEDIA_NAME?>logo.png" width="300"/>
		</div>

		<div class="text-center">
			<form action="<?=ACTION_NAME?>login" method="post">
				<div class="form-group" style="max-width: 350px; margin-left: auto; margin-right: auto;">
					<label class="form-label" for="alias">CPF</label>
					<input autofocus="autofocus" class="form-input" id="alias" name="alias" placeholder="CPF" required="required" type="text" value="<?=get_data("alias")?>"/>

					<label class="form-label mt-1" for="password">Senha</label>
					<input class="form-input" id="password" name="password" placeholder="Senha" required="required" type="password" value="<?=get_data("password")?>"/>

					<button class="btn btn-block btn-blue mt-3" type="submit">Entrar</button>
				</div>

				<p class="text-center text-<?=get_color()?>" id="message"><?=get_message()?></p>

				<p><a class="text-black" href="#modal">Validar Certificado</a></p>
			</form>
		</div>
	</div>

	<div class="modal" id="modal">
		<div class="modal-container">
			<div class="modal-header">
				<div class="h5 modal-title">Validar Certificado de Conclusão</div>
			</div>
			<div class="modal-body">
				<div class="content">
					<form action="<?=ACTION_NAME?>certificate" method="get">
						<div class="form-group" style="margin-left: auto; margin-right: auto; max-width: 300px;">
							<label class="form-label" for="certificate">Identificador</label>
							<input class="form-input" id="certificate" name="certificate" placeholder="Identificador" required="required" type="text"/>
						</div>
					</form>
				</div>
				<p class="mt-2 text-center" id="verification"></p>
				<div class="text-center">
					<a class="btn btn-green" href="javascript:void(0)" id="link" style="display: none;" target="_blank">Certificado</a>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-blue" id="search-certificate">Pesquisar</button>
				<a class="btn btn-red" href="#close">Fechar</a>
			</div>
		</div>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

	<script>
		$(document).ready(function() {
			const form = $("form[method='post']");
			const get = $("form[method='get']");

			let input = $("input[name='alias']");
			let button = $("button[type='submit']");

			let search = $("button[id='search-certificate']");
			let verification = $("p[id='verification']");
			let link = $("a[id='link']");

			let message = $("p[id='message']");
			let valid = true;

			// VALIDAÇÃO DO CPF
			input.attr("maxlength", 14);
			input.mask("000.000.000-00", {reverse: false});
			input.keydown(function() {
				let cpf = $(this).val().replaceAll(".", "").replace("-", "");
				if(cpf.length === 11) {
					valid = validateCPF(cpf);
					message.html(valid ? "" : "O CPF informado é inválido.");
					message.addClass("text-red").removeClass("text-blue");
				}
				else
				message.html("");
			});

			// VALIDAÇÃO DO FORMULÁRIO
			form.submit(function() {
				if(valid) {
					button.val("").addClass("loading");
					input.val(input.val().replaceAll(".", "").replace("-", ""));
					message.html("Autenticando usuário.").removeClass("text-red");
				}

				else {
					message.html("Informe um CPF válido para liberar o acesso.");
					return false;
				}
			});

			// VALIDAÇÃO DO CERTIFICADO DE CONCLUSÃO
			search.click(function() {
				$.ajax({
					url: get.attr("action"),
					method: "get",
					assync: true,
					data: get.serialize(),
					timeout: 10000,

					beforeSend: function() {
						search.val("").addClass("loading");
						link.hide();
						verification.hide();
					},

					complete: function() {
						search.val("Procurar").removeClass("loading");
					},

					success: function(response) {
						response = JSON.parse(response);
						verification.html(response.message);
						verification.show();

						if(response.hasOwnProperty("link")) {
							link.attr("href", response.link);
							link.show();
							verification.removeClass("text-red");
						}
						else
							verification.addClass("text-red");
					}
				});
			});
		});
	</script>

</body>

</html>
