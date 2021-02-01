<?php
// CARREGA AS CONFIGURAÇÕES GLOBAIS
require_once(__DIR__ . "/../configurations.php");
?>

	<header class="bg-blue navbar py-2">
		<section class="navbar-section px-3">
			<a class="c-disabled" href="javascript:void(0)">
				<img alt="AirTalent" class="img-responsive" src="<?=MEDIA_NAME?>airtalent.png" width="150"/>
			</a>
		</section>

		<section class="navbar-center px-3">
			<?php if(isset($time)): ?>
			<span><small>TEMPO DECORRIDO</small></span>
			<h5 id="time"></h5>
			<span id="date" style="display: none;"><?=$time?></span>
			<span id="system-date" style="display: none;"><?=date("Y-m-d H:i:s")?></span>

			<?php elseif(isset($username)): ?>
			<span><small>BEM-VINDO</small></span>
			<h5><?=$username?></h5>
			<?php endif; ?>
		</section>

		<section class="navbar-section px-3">
			<a class="btn btn-blue tooltip tooltip-bottom" data-anchor="<?=ACTION_NAME?>logout" data-tooltip="Sair" href="javascript:void(0)">
				<img alt="Sair" src="<?=MEDIA_NAME?>logout.svg" width="25"/>
			</a>
		</section>
	</header>
