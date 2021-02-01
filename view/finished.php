<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS E FUNÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");
require_once(__DIR__ . "/../functions.php");

// TÍTULO DA PÁGINA
define("PAGE_TITLE", "Avaliação Finalizada");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body>

<?php
// CARREGA O CABEÇALHO DA PÁGINA
require_once(INC_ROUTES["header"]);

// ETAPA DE ANÁLISE ATUAL
define("ANALYZE", which_analysis_is());

// CARREGA A ETAPA DA PÁGINA
require_once(INC_ROUTES["phase"]);

// RECEBE O CERTIFICADO DO ALUNO E O IDENTIFICADOR
$certificate = issued_certificate();
$identifier = validator_key();

// RECEBE O IDENTIFICADOR DO USUÁRIO NA API DO BIGFIVE
$bigfive = bigfive_api_key();
$results = bigfive_results($bigfive);
?>

	<div class="container grid-lg py-4">
		<div class="text-center">
			<h6 class="display-6 text-blue"><?=ANALYZE?></h6>
		</div>

		<div class="text-center">
			<?php if(ANALYZE === "Formulário Finalizado"): ?>
			<p>Já recebemos as suas respostas, elas serão avaliadas pelos nossos profissionais.</p>
			<p>Em breve entraremos em contato contigo para a avaliação devolutiva. Boa sorte!</p>

			<?php elseif(ANALYZE === "Avaliação Devolutiva"): ?>
			<p>As suas respostas já foram avaliadas.</p>
			<p>Fique atento na sua caixa de e-mail. Entraremos em contato contigo para a realização da avaliação devolutiva!</p>
			<?php if($results): ?>
			<p>Você pode conferir abaixo o resultado da avaliação comportamental.</p>
			<div><?=$results?></div>
			<?php endif; ?>

			<?php elseif(ANALYZE === "Certificado de Conclusão"): ?>
			<p>Parabéns, você realizou todas as etapas do SCORE e acaba de concluir mais uma etapa em sua carreira.</p>
			<?php if($certificate): ?>
			<p>Você pode fazer o download do certificado clicando no botão abaixo. Utilize o código "<?=$identifier?>" para validar o certificado.</p>
			<a class="btn btn-green btn-lg" download href="<?=FILE_NAME . $certificate?>">Certificado</a>
			<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

</body>

</html>
