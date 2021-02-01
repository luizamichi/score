<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS E FUNÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");

// TÍTULO DA PÁGINA
define("PAGE_TITLE", "Alterar Usuário");
define("PAGE_MODULE", PAGE_TITLE);

// PROCURA PELO USUÁRIO NO BANCO DE DADOS
$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? clean_text($_GET["id"]) : 0;
$administrators = get_administrator($id);
$students = get_student($id);

$rows = !empty($administrators) ? $administrators : (!empty($students) ? $students : []);
if(!empty($rows)) { // ENCONTROU UM USUÁRIO
	$u = $rows[0];

	// VERIFICA SE O USUÁRIO TERMINOU O FORMULÁRIO
	$query = "select situations.`name`, analysis.`certificate` from analysis inner join situations on analysis.`situation`=situations.`id` where analysis.`student`=" . $u["ref_id"] . ";";
	$rows = sql_query($query);
	$situation = (!empty($rows) && !empty($students) ? $rows[0]["name"] : "");
	$certificate = (!empty($rows) && !empty($students) ? $rows[0]["certificate"] : "");
}

else {
	redirect(BASE_NAME . "admin");
}

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

		<form action="<?=ACTION_NAME?>admin/student/update" enctype="multipart/form-data" method="post">
			<input id="id" name="id" type="hidden" value="<?=$u["id"]?>"/>

			<div class="form-group">
				<label class="form-label" for="name">Nome</label>
				<input class="form-input" id="name" name="name" placeholder="Nome" required="required" type="text" value="<?=$u["name"]?>"/>
			</div>

			<div class="form-group">
				<label class="form-label" for="alias">CPF</label>
				<input class="form-input" id="alias" name="alias" placeholder="CPF" required="required" type="text" value="<?=$u["alias"]?>"/>
			</div>

			<div class="form-group">
				<label class="form-label" for="password">Senha</label>
				<input class="form-input" id="password" name="password" placeholder="Senha (opcional)" type="text"/>
			</div>

			<?php if($situation): ?>
			<div class="form-group">
				<label class="form-label" for="situation">Situação</label>
				<select class="form-select" id="situation" name="situation" required="required">
					<option disabled="disabled" value="">Escolha uma opção</option>
					<option <?=$situation === "Formulário Finalizado" ? "selected='selected'" : ""?> value="Formulário Finalizado">Formulário Finalizado</option>
					<option <?=$situation === "Avaliação Devolutiva" ? "selected='selected'" : ""?> value="Avaliação Devolutiva">Avaliação Devolutiva</option>
					<option <?=$situation === "Certificado de Conclusão" ? "selected='selected'" : ""?> value="Certificado de Conclusão">Certificado de Conclusão</option>
				</select>
			</div>

			<div class="form-group" id="view-certificate">
				<label class="form-label" for="certificate">Certificado</label>
				<input accept="application/pdf,image/jpeg,image/png" class="form-input" id="certificate" name="certificate" type="file"/>
				<?php if($certificate): ?>
				<a class="text-black tooltip tooltip-right" data-tooltip="Visualizar arquivo" href="<?=FILE_NAME . $certificate?>" target="_blank"><em>Enviado</em></a>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<div class="form-group pt-2">
				<button class="btn btn-blue" type="submit">Alterar</button>
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

			// VISUALIZAÇÃO DO CERTIFICADO DE CONCLUSÃO
			if($("select[name='situation']").val() !== "Certificado de Conclusão")
					$("div[id=view-certificate]").hide();
			$("select[name='situation']").on("change", function() {
				if($(this).val() === "Certificado de Conclusão")
					$("div[id=view-certificate]").show();
				else
					$("div[id=view-certificate]").hide();
			});

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
					$("#message").html("Alterando usuário.").removeClass("text-red");
				}

				else {
					$("#message").html("Informe um CPF válido para alterar o usuário.");
					return false;
				}
			});
		});
	</script>

</body>

</html>
