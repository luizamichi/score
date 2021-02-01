<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");

// TÍTULO DA PÁGINA
define("PAGE_TITLE", "Erro");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body style="background-attachment: fixed; background-image: url('media/background.png'); background-position: right; background-repeat: no-repeat; background-size: auto;">
	<div class="container grid-lg">
		<div style="margin-bottom: 20px; margin-top: 50px;">
			<img alt="Erro" class="img-center img-responsive" src="<?=MEDIA_NAME?>error.png" width="300"/>
		</div>

		<div class="text-center">
			<h6 class="display-6 text-red">Erro</h6>
			<p class="lead">Ocorreu um erro no processamento da sua requisição. Por favor, entre em contato imediatamente com o nosso suporte.</p>
			<small class="text-red">AirTalent</small>
		</div>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

</body>

</html>
