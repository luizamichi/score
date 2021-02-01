<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");

// TÍTULO DA PÁGINA
define("PAGE_TITLE", "Manutenção");

// CARREGA O TOPO DO CÓDIGO HTML
require_once(INC_ROUTES["head"]);
?>

<body style="background-attachment: fixed; background-image: url('media/background.png'); background-position: right; background-repeat: no-repeat; background-size: auto;">
	<div class="container grid-lg">
		<div style="margin-bottom: 20px; margin-top: 50px;">
			<img alt="Manutenção" class="img-center img-responsive" src="<?=MEDIA_NAME?>maintenance.png" width="300"/>
		</div>

		<div class="text-center">
			<h6 class="display-6 text-blue">Manutenção</h6>
			<p class="lead">Desculpe o transtorno, estamos realizando alguns ajustes e logo estaremos no ar novamente.</p>
			<small class="text-blue">AirTalent</small>
		</div>
	</div>

<?php
// CARREGA O RODAPÉ DA PÁGINA
require_once(INC_ROUTES["footer"]);
?>

</body>

</html>
